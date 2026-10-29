<?php
namespace qqworld_collector\security;

// 空配置不得开启远程控制，严格比较避免数值字符串被弱类型转换。
function token_valid($expected, $provided) {
    return is_string($expected) && is_string($provided)
        && trim($expected) !== '' && trim($provided) !== ''
        && strlen($expected) <= 4096 && strlen($provided) <= 4096
        && hash_equals($expected, $provided);
}

// 模板仅支持无文件、网络、回调或命令执行能力的格式函数。
function template_call($name, $arguments) {
    static $allowed = array(
        'trim', 'ltrim', 'rtrim', 'strtolower', 'strtoupper',
        'ucfirst', 'lcfirst', 'ucwords', 'strlen', 'mb_strlen',
        'substr', 'mb_substr', 'str_replace', 'str_ireplace',
        'urlencode', 'rawurlencode', 'urldecode', 'rawurldecode',
        'htmlentities', 'html_entity_decode', 'htmlspecialchars',
        'htmlspecialchars_decode', 'strip_tags', 'nl2br',
        'md5', 'sha1', 'base64_encode', 'base64_decode',
        'date', 'gmdate', 'strtotime', 'number_format',
        'round', 'ceil', 'floor', 'abs', 'intval', 'floatval'
    );
    if (!is_string($name) || !is_array($arguments) || count($arguments) > 8) {
        return '';
    }
    $name = strtolower(trim($name));
    if (!in_array($name, $allowed, true) || !function_exists($name)) {
        return '';
    }
    foreach ($arguments as $argument) {
        if (!is_scalar($argument) || strlen((string) $argument) > 65536) {
            return '';
        }
    }
    // 限制可被放大的数字参数，避免格式化造成无界内存消耗。
    if ($name === 'number_format' && isset($arguments[1])
        && (!is_numeric($arguments[1]) || abs((float) $arguments[1]) > 100)) {
        return '';
    }
    if (($name === 'str_replace' || $name === 'str_ireplace') && count($arguments) >= 3) {
        $search = (string) $arguments[0];
        $replacement = (string) $arguments[1];
        $subject = (string) $arguments[2];
        if ($search !== '' && strlen($replacement) > strlen($search)) {
            $occurrences = $name === 'str_ireplace'
                ? substr_count(strtolower($subject), strtolower($search))
                : substr_count($subject, $search);
            if (strlen($subject) + $occurrences * (strlen($replacement) - strlen($search)) > 1048576) {
                return '';
            }
        }
    }
    try {
        $result = @call_user_func_array($name, $arguments);
    } catch (\Throwable $exception) {
        return '';
    }
    return is_scalar($result) && strlen((string) $result) <= 1048576
        ? (string) $result : '';
}

// 仅返回同目录内已经安装的 PHP 文件；拒绝穿越、流包装器及外部符号链接。
function local_magic_path($directory, $name) {
    if (!is_string($name) || !preg_match('/\A[a-z][a-z0-9_]{0,63}\z/iD', $name)) {
        return false;
    }
    return installed_local_file($directory, $name . '.php');
}

// 目录只由本插件的 __DIR__ 传入；文件名由上述严格白名单产生。
function installed_local_file($directory, $filename) {
    if (!is_string($directory) || !is_string($filename)
        || strpos($directory, "\0") !== false || !preg_match('/\A[a-zA-Z0-9_.-]+\z/D', $filename)
        || strpos($filename, '..') !== false) return false;
    if (strncmp($directory, 'phar://', 7) === 0) {
        // realpath 不支持 PHAR；归档内部不接受任何点目录或路径跳转。
        $base = rtrim(str_replace('\\', '/', $directory), '/');
        if (preg_match('~(?:^|/)\.{1,2}(?:/|$)~', $base) || strpos($base, '?') !== false || strpos($base, '#') !== false) return false;
        $path = $base . '/' . $filename;
        return is_file($path) ? $path : false;
    }
    if (strpos($directory, '://') !== false) return false;
    $base = realpath($directory);
    if ($base === false) return false;
    $path = realpath($base . DIRECTORY_SEPARATOR . $filename);
    return $path !== false && dirname($path) === $base && is_file($path) ? $path : false;
}

// 数字表达式使用有限语法解析，不交给 PHP 解释器执行。
function arithmetic($expression) {
    if (!is_scalar($expression) || strlen((string) $expression) > 4096) return false;
    $expression = trim((string) $expression);
    if ($expression === '') return false;
    $tokens = array();
    $offset = 0;
    while ($offset < strlen($expression)) {
        if (!preg_match('/\G\s*(\d+(?:\.\d*)?(?:[eE][+-]?\d+)?|\.\d+(?:[eE][+-]?\d+)?|\*\*|[()+*\/%-])/A', $expression, $match, 0, $offset)) return false;
        $tokens[] = $match[1];
        $offset += strlen($match[0]);
        if (count($tokens) > 256) return false;
    }
    try {
        $parser = new ArithmeticParser($tokens);
        return $parser->run();
    } catch (\Throwable $exception) {
        return false;
    }
}

class ArithmeticParser {
    private $tokens;
    private $index = 0;
    public function __construct($tokens) { $this->tokens = $tokens; }
    public function run() {
        $result = $this->expression(0, 0);
        if ($this->index !== count($this->tokens)) throw new \RuntimeException('表达式未完整解析。');
        return $result;
    }
    private function expression($minimum, $depth) {
        if ($depth > 32 || !isset($this->tokens[$this->index])) throw new \RuntimeException('表达式无效。');
        $token = $this->tokens[$this->index++];
        if ($token === '+' || $token === '-') {
            $left = $this->expression(25, $depth + 1);
            if ($token === '-') $left = -$left;
        } elseif ($token === '(') {
            $left = $this->expression(0, $depth + 1);
            if (!isset($this->tokens[$this->index]) || $this->tokens[$this->index++] !== ')') throw new \RuntimeException('缺少括号。');
        } elseif (is_numeric($token)) {
            $left = $token + 0;
        } else {
            throw new \RuntimeException('无效数字。');
        }
        if (!is_finite((float) $left)) throw new \RuntimeException('数字超出范围。');
        $precedence = array('+' => 10, '-' => 10, '*' => 20, '/' => 20, '%' => 20, '**' => 30);
        while (isset($this->tokens[$this->index])) {
            $operator = $this->tokens[$this->index];
            if (!isset($precedence[$operator]) || $precedence[$operator] < $minimum) break;
            $this->index++;
            $right = $this->expression($precedence[$operator] + ($operator === '**' ? 0 : 1), $depth + 1);
            switch ($operator) {
                case '+': $left += $right; break;
                case '-': $left -= $right; break;
                case '*': $left *= $right; break;
                case '/': if ($right == 0) throw new \RuntimeException('除数为零。'); $left /= $right; break;
                case '%':
                    if (abs($left) > PHP_INT_MAX || abs($right) > PHP_INT_MAX || (int) $right === 0) throw new \RuntimeException('余数操作无效。');
                    $left = (int) $left % (int) $right; break;
                case '**':
                    if (abs($right) > 1024) throw new \RuntimeException('指数过大。');
                    $left = $left ** $right; break;
            }
            if (!is_finite((float) $left)) throw new \RuntimeException('计算超出范围。');
        }
        return $left;
    }
}

// 仅允许插件包中已存在的内容格式过滤器，不允许任意 WordPress 钩子。
function local_content_filter_path($directory, $name) {
    if (!is_string($name) || !preg_match('/\Aqqworld-collector-parse-[a-z0-9-]{1,100}\z/D', $name)) return false;
    return installed_local_file($directory, 'class.' . $name . '.php');
}
