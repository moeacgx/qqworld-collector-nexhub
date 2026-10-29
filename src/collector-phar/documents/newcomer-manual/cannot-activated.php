<p>请确保激活服务器可以正常访问你的网站。</p>
<h2>已知解决方案</h2>
<h3>LightSNS</h3>
<p>因为该主题默认不允许管理员之外的用户访问后台，所以导致激活服务器无法和你的网站握手，解决方法是删除主题的 <em>functions/base.php</em> 里的以下代码：</p>
<pre class="prism"><code class="language-php">//禁止访问后台
function stop_visit_admin() {
    if( !current_user_can( 'administrator' ) ) {
        wp_redirect( home_url() );
        die();
    }
}
add_action( 'admin_init', 'stop_visit_admin', 1 );</code></pre>