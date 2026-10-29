<?php
/**
 * QQWorld Collector Deluxe —— 授权模块移除补丁
 *
 * 本文件由主插件入口 qqworld-collector.php 在加载 collector.phar 之前 require。
 *
 * 背景（静态审计结论）：
 *   该插件包被人「剥掉授权层」时删过了头 —— 授权引擎基类
 *   class qqworld_collector_common（内含 is_activate()、activation_page() 等）
 *   在 phar 的 1777 个条目中已完全不存在，而 11 个模块仍然 extends 它，
 *   导致加载即致命错误。同时全部授权类 filter 都没有任何 add_filter 定义点，
 *   按 apply_filters 的默认值推导，所有功能开关都恒为 false。
 *
 * 本补丁做四件事：
 *   1) 把所有授权类 filter 抢先在优先级 1 上置为「已授权」，
 *      早于任何消费点（消费点最早是 init，优先级 10）；
 *   2) 给序列号与绑定域名一个固定值，解除导入导出的同序列号限制；
 *   3) 拆除自毁后门（见下方「拆除自毁后门」一节）；
 *   4) 补齐缺失的 qqworld_collector_common 基类，否则模块无法加载。
 *
 * 只补空、只做兜底，不覆盖任何已存在的定义或真实授权数据。
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( 'QQWORLD_COLLECTOR_AUTH_REMOVED' ) ) {
    define( 'QQWORLD_COLLECTOR_AUTH_REMOVED', true );
}

/* ------------------------------------------------------------------ *
 * 一、抢占全部授权类 filter —— 必须在 phar 加载之前注册
 *     （消费点最早出现在 init，优先级 10，这里用 1 抢先）
 * ------------------------------------------------------------------ */

/**
 * 全局总开关与型号开关。
 * 默认值均为 false，直接返回 true 即视为已授权。
 */
foreach ( array(
    'qqworld-collector-activated',
    'qqworld-collector-activated-license',
    'qqworld-activation-is-local-edition',
    'qqworld-activation-is-local',
    'qqworld-activation-is-ultimate-edition',
) as $qc_auth_flag ) {
    add_filter( $qc_auth_flag, '__return_true', 1 );
}
unset( $qc_auth_flag );

/**
 * 全部模块级开关（qqworld-collector-activated-module-*）。
 *
 * 这些 hook 名在插件里大多由 $this->module 运行时拼接而成
 * （如 -module-<module>、-module-cloud-storage-<云存储名>），
 * 无法用通配符注册，因此按静态审计穷举出的完整名单逐个挂载。
 * 云存储子模块名来自运行时选项，故对 qqworld-collector-cloud-storage-*
 * 另有兜底：见下方 catch_all。
 */
$qc_auth_module_suffixes = array(
    // 顶层模块
    'additional',
    'artificial-intelligence',
    'automatic-anchor',
    'auto-save-attachment',
    'auxiliary',
    'cleaner',
    'cloud-storage',
    'collection-project',
    'database',
    'import-export',
    'proxy',
    'pseudo-original',
    'smart-collecting',
    'static-cache',
    'translate',
    'watermark',
    // 云存储子模块（pages/cloudStorage-*.php 对应的 slug）
    'cloud-storage-alist',
    'cloud-storage-aliyun-oss',
    'cloud-storage-aws-s3',
    'cloud-storage-baidu-bos',
    'cloud-storage-baidu',
    'cloud-storage-bohe',
    'cloud-storage-caihong',
    'cloud-storage-chevereto',
    'cloud-storage-cloudflare',
    'cloud-storage-cloudreve',
    'cloud-storage-ctfile',
    'cloud-storage-dogecloud',
    'cloud-storage-ftp',
    'cloud-storage-github',
    'cloud-storage-hidove',
    'cloud-storage-huawei-obs',
    'cloud-storage-image-hosting-api',
    'cloud-storage-kodbox',
    'cloud-storage-kodexplorer',
    'cloud-storage-kuaiyun',
    'cloud-storage-local',
    'cloud-storage-lsky',
    'cloud-storage-minio',
    'cloud-storage-oneindex',
    'cloud-storage-onemanager',
    'cloud-storage-pan123',
    'cloud-storage-picurl',
    'cloud-storage-qiniu',
    'cloud-storage-qqworld',
    'cloud-storage-smms',
    'cloud-storage-superbed',
    'cloud-storage-tencent-cos',
    'cloud-storage-tietuku',
    'cloud-storage-ucloud-ufile',
    'cloud-storage-upyun',
    'cloud-storage-west-fss',
);
foreach ( $qc_auth_module_suffixes as $qc_auth_module ) {
    add_filter( 'qqworld-collector-activated-module-' . $qc_auth_module, '__return_true', 1 );
}
unset( $qc_auth_module_suffixes, $qc_auth_module );

/**
 * 授权显示名（后台界面用），给一个中性值，避免出现空白授权信息区。
 */
add_filter( 'qqworld-collector-activation-name', 'qqworld_collector_auth_activation_name', 1 );
function qqworld_collector_auth_activation_name( $name ) {
    return ( ! empty( $name ) ) ? $name : '已授权';
}

/**
 * 激活列表输出（pages/activation.php 里的 do_action 'qqworld-collector-activation-list'）。
 * 原版这块由被删掉的授权引擎渲染，这里补一个简洁的已授权提示，避免激活页空白。
 */
add_action( 'qqworld-collector-activation-list', 'qqworld_collector_auth_render_activation_list', 1 );
function qqworld_collector_auth_render_activation_list() {
    echo '<div id="qqworld-collector-notice" class="notice is-dismissible notice-success">';
    echo '<p class="help">' . esc_html__( '当前版本已移除授权校验，全部功能可直接使用。', 'qqworld-collector' ) . '</p>';
    echo '</div>';
}

/**
 * 序列号与绑定域名。
 *
 * modules/collector.php 与 modules/cloud-storage.php 里有一处被拆散混淆的调用：
 *     apply_filters( 'qqw'.'orld-col'.'lect'.'or-ser'.'ial-n'.'umb'.'er', '' )
 * 用于「采集项目导入导出必须同序列号」的限制。
 * 这里给它一个固定值，使所有站点视为同一授权，导入导出不再受阻。
 */
add_filter( 'qqworld-collector-serial-number', 'qqworld_collector_auth_serial_number', 1 );
function qqworld_collector_auth_serial_number( $sn ) {
    return ( ! empty( $sn ) ) ? $sn : 'QQWORLD-AUTHORIZED';
}

add_filter( 'qqworld-collector-top-domain', 'qqworld_collector_auth_top_domain', 1 );
function qqworld_collector_auth_top_domain( $domain ) {
    return ( ! empty( $domain ) ) ? $domain : 'authorized';
}

/**
 * 【重要】拆除自毁后门。
 *
 * lib/collector/classes/class.wp-list-table-parser.php 的构造函数里有一段
 * 与授权无关的破坏性逻辑：只要当前域名不在 qqworld-activation-dev-domain
 * 白名单内，就在同一站点累计访问 7~15 次后，把整个插件目录递归删除：
 *
 *     $this->super = apply_filters( 'qqworld-acti'.'vation-dev-domain', array() );
 *     if (!in_array($this->domain, $this->super)) {
 *         ...
 *         if ($count > rand(7, 15)) {
 *             $wp_filesystem->rmdir( QQWORLD_OUTSIDE_COLLECTOR_DIR, true );
 *         }
 *     }
 *
 * 它既不是授权校验的一部分，也不产生任何提示，只会静默删站。
 *
 * 关键点：插件比较的是 $this->domain，而它是
 * get_domain( get_host() ) 的产物 —— 已去掉 www、转小写、
 * 并用一份 TLD 表截断到主域名。因此这里必须做完全相同的归一化，
 * 否则白名单里的字串与插件内部的 $this->domain 对不上。
 */
add_filter( 'qqworld-activation-dev-domain', 'qqworld_collector_auth_dev_domain_all', 1 );
function qqworld_collector_auth_dev_domain_all( $domains ) {
    $raw = array();

    // 与插件 get_host() 一致：优先 HTTP_HOST，去掉端口
    if ( ! empty( $_SERVER['HTTP_HOST'] ) ) {
        $host = preg_replace( '/:.*$/i', '', (string) $_SERVER['HTTP_HOST'] );
        if ( $host !== '' ) {
            $raw[] = qqworld_collector_auth_normalize_domain( $host );
        }
    }

    // 与插件 get_domain() 的兜底一致：SERVER_NAME
    if ( ! empty( $_SERVER['SERVER_NAME'] ) ) {
        $raw[] = qqworld_collector_auth_normalize_domain( (string) $_SERVER['SERVER_NAME'] );
    }

    // 多站点常量
    if ( function_exists( 'is_multisite' ) && is_multisite() && defined( 'DOMAIN_CURRENT_SITE' ) ) {
        $raw[] = qqworld_collector_auth_normalize_domain( DOMAIN_CURRENT_SITE );
    }

    // 注意：不能用 array_filter()，因为插件在 IP 访问时 $domain === false，
    // false 本身就是要放进白名单的元素，array_filter 会把它过滤掉。
    $list = array();
    foreach ( $raw as $item ) {
        if ( ! in_array( $item, $list, true ) ) {
            $list[] = $item;
        }
    }
    return $list;
}

/**
 * 复刻插件的域名归一化：去 www、转小写、按 TLD 表截断到主域名。
 *
 * TLD 表逐字照抄 class.wp-list-table-parser.php::get_top_domain()，
 * 保证与插件内部 $this->domain 的取值完全一致。
 *
 * @param string $domain
 * @return string
 */
function qqworld_collector_auth_normalize_domain( $domain ) {
    $host = strtolower( trim( (string) $domain ) );
    if ( strpos( $host, ':' ) !== false ) {
        $host = preg_replace( '/:.*$/i', '', $host );
    }
    // 与插件一致：IP 访问时 get_domain() 会把 $domain 置为 false，
    // 而 false 是会被 in_array() 命中的合法元素，这里原样返回 false。
    if ( filter_var( $host, FILTER_VALIDATE_IP ) ) {
        return false;
    }
    $host = preg_replace( '/^www\./i', '', $host );

    $topleveldomaindb = array(
        'hk.cn', 'cn.com', 'com', 'edu', 'gov', 'int', 'mil', 'net', 'org', 'biz', 'info',
        'pro', 'name', 'museum', 'coop', 'aero', 'xxx', 'idv', 'mobi', 'cc', 'me', 'xyz',
        'top', 'online', 'news', 'vip', 'life', 'club', 'wang', 'app', 'live', 'run', 'fit',
        'one', 'tech', 'sale', 'kim', 'work', 'xin', 'icu', 'email', 'monster', 'cool',
        'ren', 'art', 'ink', 'co.za', 'meme', 'c',
    );
    $str = '';
    foreach ( $topleveldomaindb as $v ) {
        $str .= ( $str ? '|' : '' ) . $v;
    }
    $matchstr = '[^\.]+\.(?:(' . $str . ')|\w{2}|((' . $str . ')\.\w{2}))$';
    if ( preg_match( '/' . $matchstr . '/is', $host, $matchs ) ) {
        return $matchs[0];
    }
    return $host;
}

/* ------------------------------------------------------------------ *
 * 二、补齐云存储子模块开关
 *     形如 qqworld-collector-activated-module-cloud-storage-<slug>，
 *     slug 来自 pages/cloudStorage-*.php。
 *     静态审计确认这些 hook 名在源码里是字面量（如
 *     -module-cloud-storage-cloudreve），但为了兼容插件后续新增的
 *     云存储服务，这里在 init 时按目录与选项动态补挂一次。
 * ------------------------------------------------------------------ */

add_action( 'init', 'qqworld_collector_auth_backfill_module_filters', -PHP_INT_MAX );
function qqworld_collector_auth_backfill_module_filters() {
    $candidates = array();

    // 1) 已配置的云存储模式
    if ( function_exists( 'get_option' ) ) {
        $storage = get_option( 'qqworld-collector-cloud-storage-settings' );
        if ( is_array( $storage ) ) {
            foreach ( array_keys( $storage ) as $slug ) {
                if ( is_string( $slug ) && $slug !== '' ) {
                    $candidates[] = $slug;
                }
            }
        }
    }

    // 2) pages/cloudStorage-*.php 的文件名
    if ( defined( 'QQWORLD_COLLECTOR_DIR' ) && function_exists( 'glob' ) ) {
        $pattern = QQWORLD_COLLECTOR_DIR . 'pages' . DIRECTORY_SEPARATOR . 'cloudStorage-*.php';
        foreach ( (array) glob( $pattern ) as $file ) {
            $base = basename( $file, '.php' );
            $slug = strtolower( str_replace( '_', '-', substr( $base, strlen( 'cloudStorage-' ) ) ) );
            if ( $slug !== '' && strpos( $slug, '-before' ) === false && strpos( $slug, '-no-sdk' ) === false ) {
                $candidates[] = $slug;
            }
        }
    }

    foreach ( array_unique( $candidates ) as $slug ) {
        add_filter( 'qqworld-collector-activated-module-cloud-storage-' . $slug, '__return_true', 1 );
    }
}

/* ------------------------------------------------------------------ *
 * 三、补齐缺失的授权引擎基类 —— 必须在 phar 的类加载完成之后
 * ------------------------------------------------------------------ */

/**
 * 判断基类是否已由厂商 phar 提供；没有就补一个最小可用实现。
 *
 * 只覆盖插件自身会用到的接口：
 *   - is_activate( $which )  各模块的功能开关判定（pro / server ...）
 *   - activation_page()      未授权时展示的页面（本包已无未授权态，仅占位）
 *   - __construct()          与 QASI 系列云存储模块一致的选项对象初始化
 */
function qqworld_collector_auth_ensure_common_class() {
    if ( class_exists( 'qqworld_collector_common', false ) ) {
        return true;
    }
    if ( ! class_exists( 'qqworld_collector\\lib\\options' ) ) {
        // 依赖尚未就绪，稍后再试
        return false;
    }

    class qqworld_collector_common {
        /** @var mixed */
        public $options;
        public $text_domain = 'qqworld-collector';

        public function __construct() {
            $this->options = new \qqworld_collector\lib\options();
        }

        /**
         * 功能开关。原版按授权型号判断，本包授权已移除，一律放行。
         *
         * @param string $which pro / server / basic ...
         * @return bool
         */
        public function is_activate( $which = '' ) {
            return true;
        }

        /**
         * 授权页（原版展示激活表单）。本包已无未授权态，仅做兜底。
         */
        public function activation_page() {
            echo '<div class="wrap"><div class="notice notice-success"><p>'
                . esc_html__( '当前版本已移除授权校验，全部功能可直接使用。', 'qqworld-collector' )
                . '</p></div></div>';
        }
    }

    return true;
}

// phar 里的模块在 init(优先级 10) 被 require，此时基类必须已存在。
// 先用较早的时机尝试，再挂到 init 最前面兜底。
add_action( 'plugins_loaded', 'qqworld_collector_auth_ensure_common_class', 1 );
add_action( 'init', 'qqworld_collector_auth_ensure_common_class', -PHP_INT_MAX + 1 );
