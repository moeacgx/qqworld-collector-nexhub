<?php
/** QQWorld 管理入口安全边界：权限与请求来源分别验证。 */
if (!defined('ABSPATH')) { exit; }
define('SN_QQWORLD_SECURITY_VERSION', '2026.10.28.2');

function sn_qc_is_plugin_action($action) {
    if (!is_string($action)) { return false; }
    if (strpos($action, 'qqworld-') === 0 || strpos($action, 'qqworld_') === 0) { return true; }
    global $wp_filter;
    foreach (array('wp_ajax_', 'wp_ajax_nopriv_') as $prefix) {
        $hook = isset($wp_filter[$prefix . $action]) ? $wp_filter[$prefix . $action] : null;
        if (!$hook || !isset($hook->callbacks)) { continue; }
        foreach ($hook->callbacks as $callbacks) {
            foreach ($callbacks as $entry) {
                $callback = $entry['function'];
                $owner = is_array($callback) ? (is_object($callback[0]) ? get_class($callback[0]) : $callback[0]) : $callback;
                if (is_string($owner) && stripos($owner, 'qqworld') !== false) { return true; }
            }
        }
    }
    return false;
}

function sn_qc_guard_admin_request() {
    $ajax = defined('DOING_AJAX') && DOING_AJAX;
    $action = isset($_REQUEST['action']) && is_string($_REQUEST['action']) ? $_REQUEST['action'] : '';
    $page = isset($_GET['page']) && is_string($_GET['page']) ? $_GET['page'] : '';
    if (($ajax && sn_qc_is_plugin_action($action)) || (!$ajax && strpos($page, 'qqworld-collector') === 0)) {
        if (!current_user_can('manage_options')) {
            wp_die('QQWorld: administrator access required.', '', array('response' => 403));
        }
        if (!$ajax) { return; }
        $nonce = isset($_SERVER['HTTP_X_QC_ADMIN_NONCE']) ? $_SERVER['HTTP_X_QC_ADMIN_NONCE'] : (isset($_REQUEST['qc_admin_nonce']) ? $_REQUEST['qc_admin_nonce'] : '');
        $valid = is_string($nonce) && wp_verify_nonce($nonce, 'sn-qc-admin');
        // 兼容原插件已使用的具体动作 nonce 和一小时内的时间戳 nonce。
        $legacy = isset($_REQUEST['nonce']) ? $_REQUEST['nonce'] : '';
        if (!$valid && is_string($legacy) && $legacy !== '') {
            $valid = wp_verify_nonce($legacy, $action);
            $timestamp = isset($_REQUEST['timestamp']) ? $_REQUEST['timestamp'] : '';
            if (!$valid && is_scalar($timestamp) && ctype_digit((string) $timestamp) && abs(time() - (int) $timestamp) <= 3600) {
                $valid = wp_verify_nonce($legacy, (string) $timestamp);
            }
        }
        if (!$valid) { wp_die('QQWorld: invalid request nonce.', '', array('response' => 403)); }
    }
}
add_action('admin_init', 'sn_qc_guard_admin_request', -PHP_INT_MAX);

function sn_qc_enqueue_admin_guard() {
    if (!current_user_can('manage_options')) { return; }
    wp_enqueue_script('jquery');
    $config = wp_json_encode(array('nonce' => wp_create_nonce('sn-qc-admin'), 'restNonce' => wp_create_nonce('wp_rest'), 'ajax' => admin_url('admin-ajax.php'), 'rest' => rest_url()));
    wp_enqueue_script('sn-qc-security', plugin_dir_url(__FILE__) . 'js/sn-qc-security.js', array('jquery'), SN_QQWORLD_SECURITY_VERSION, false);
    wp_add_inline_script('sn-qc-security', 'window.SN_QC_ADMIN=' . $config . ';', 'before');
}
add_action('admin_enqueue_scripts', 'sn_qc_enqueue_admin_guard', 0);

// 旧 AI 模块会在所有后台页面下发完整配置，必须阻止低权限账号读取密钥。
function sn_qc_protect_admin_script_data($data) {
    if (!current_user_can('manage_options')) {
        unset($data['fullProviderConfig'], $data['providerConfig'], $data['nonce'], $data['remote_website'], $data['auto_login_website']);
    }
    return $data;
}
add_filter('qqworld-collector-script-translation-array', 'sn_qc_protect_admin_script_data', PHP_INT_MAX);

function sn_qc_administrator_rest_permission($request) {
    return current_user_can('manage_options')
        ? true
        : new WP_Error('qc_rest_forbidden', 'Administrator access required.', array('status' => 403));
}

// 其他旧模块也必须验证管理员权限，包括会触发静态 PHP 缓存的云存储跳转。
add_filter('rest_endpoints', function ($routes) {
    foreach ($routes as &$handlers) {
        foreach ($handlers as &$handler) {
            if (!is_array($handler) || !isset($handler['callback'], $handler['permission_callback'])) { continue; }
            $callback = $handler['callback'];
            if (!is_array($callback) || !is_object($callback[0])) { continue; }
            $owner = get_class($callback[0]);
            if (stripos($owner, 'qqworld_collector') === false || $handler['permission_callback'] !== '__return_true') { continue; }
            $handler['permission_callback'] = 'sn_qc_administrator_rest_permission';
        }
        unset($handler);
    }
    unset($handlers);
    return $routes;
}, 100);

// 本地安全分支不能被供应商自动更新覆盖。
add_filter('auto_update_plugin', function ($update, $item) {
    return isset($item->plugin) && $item->plugin === 'qqworld-collector/qqworld-collector.php' ? false : $update;
}, 100, 2);
