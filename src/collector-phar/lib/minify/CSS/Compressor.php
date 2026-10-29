<?php
 class Minify_CSS_Compressor { public static function process($css, $options = array()) { $obj = new Minify_CSS_Compressor($options); return $obj->_process($css); } protected $_options = null; protected $_inHack = false; private function __construct($options) { $this->_options = $options; } protected function _process($css) { $css = str_replace("\r\n", "\n", $css); $css = preg_replace('@>/\\*\\s*\\*/@', '>/*keep*/', $css); $css = preg_replace('@/\\*\\s*\\*/\\s*:@', '/*keep*/:', $css); $css = preg_replace('@:\\s*/\\*\\s*\\*/@', ':/*keep*/', $css); $pattern = '@\\s*/\\*([\\s\\S]*?)\\*/\\s*@'; $css = preg_replace_callback($pattern, array($this, '_commentCB'), $css); $css = preg_replace('/\\s*{\\s*/', '{', $css); $css = preg_replace('/;?\\s*}\\s*/', '}', $css); $css = preg_replace('/\\s*;\\s*/', ';', $css); $pattern = '/
                url\\(      # url(
                \\s*
                ([^\\)]+?)  # 1 = the URL (really just a bunch of non right parenthesis)
                \\s*
                \\)         # )
            /x'; $css = preg_replace($pattern, 'url($1)', $css); $pattern = '/
                \\s*
                ([{;])              # 1 = beginning of block or rule separator
                \\s*
                ([\\*_]?[\\w\\-]+)  # 2 = property (and maybe IE filter)
                \\s*
                :
                \\s*
                (\\b|[#\'"-])        # 3 = first character of a value
            /x'; $css = preg_replace($pattern, '$1$2:$3', $css); $pattern = '/
                (?:              # non-capture
                    \\s*
                    [^~>+,\\s]+  # selector part
                    \\s*
                    [,>+~]       # combinators
                )+
                \\s*
                [^~>+,\\s]+      # selector part
                {                # open declaration block
            /x'; $css = preg_replace_callback($pattern, array($this, '_selectorsCB'), $css); $pattern = '/([^=])#([a-f\\d])\\2([a-f\\d])\\3([a-f\\d])\\4([\\s;\\}])/i'; $css = preg_replace($pattern, '$1#$2$3$4$5', $css); $pattern = '/font-family:([^;}]+)([;}])/'; $css = preg_replace_callback($pattern, array($this, '_fontFamilyCB'), $css); $css = preg_replace('/@import\\s+url/', '@import url', $css); $css = preg_replace('/[ \\t]*\\n+\\s*/', "\n", $css); $pattern = '/([\\w#\\.\\*]+)\\s+([\\w#\\.\\*]+){/'; $css = preg_replace($pattern, "$1\n$2{", $css); $pattern = '/
            ((?:padding|margin|border|outline):\\d+(?:px|em)?) # 1 = prop : 1st numeric value
            \\s+
            /x'; $css = preg_replace($pattern, "$1\n", $css); $css = preg_replace('/:first-l(etter|ine)\\{/', ':first-l$1 {', $css); return trim($css); } protected function _selectorsCB($m) { return preg_replace('/\\s*([,>+~])\\s*/', '$1', $m[0]); } protected function _commentCB($m) { $hasSurroundingWs = (trim($m[0]) !== $m[1]); $m = $m[1]; if ($m === 'keep') { return '/**/'; } if ($m === '" "') { return '/*" "*/'; } if (preg_match('@";\\}\\s*\\}/\\*\\s+@', $m)) { return '/*";}}/* */'; } if ($this->_inHack) { $pattern = '@
                    ^/               # comment started like /*/
                    \\s*
                    (\\S[\\s\\S]+?)  # has at least some non-ws content
                    \\s*
                    /\\*             # ends like /*/ or /**/
                @x'; if (preg_match($pattern, $m, $n)) { $this->_inHack = false; return "/*/{$n[1]}/**/"; } } if (substr($m, -1) === '\\') { $this->_inHack = true; return '/*\\*/'; } if ($m !== '' && $m[0] === '/') { $this->_inHack = true; return '/*/*/'; } if ($this->_inHack) { $this->_inHack = false; return '/**/'; } return $hasSurroundingWs ? ' ' : ''; } protected function _fontFamilyCB($m) { $flags = PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY; $pieces = preg_split('/(\'[^\']+\'|"[^"]+")/', $m[1], null, $flags); $out = 'font-family:'; while (null !== ($piece = array_shift($pieces))) { if ($piece[0] !== '"' && $piece[0] !== "'") { $piece = preg_replace('/\\s+/', ' ', $piece); $piece = preg_replace('/\\s?,\\s?/', ',', $piece); } $out .= $piece; } return $out . $m[2]; } } 