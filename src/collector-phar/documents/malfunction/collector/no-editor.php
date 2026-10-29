<h1>原因一：和CorePress主题不兼容</h1>
<p>解决方法是讲以下代码放到主题的 function.php 中，注意要将<strong>"你的域名"</strong>改成你的域名。</p>
<pre class="prism"><code class="language-php">add_action( 'admin_enqueue_scripts', function() {
	wp_enqueue_script( 'jquery-sprintf', QQWORLD_COLLECTOR_URL . 'js/jquery.sprintf.js', array('jquery'), '0.0.6', true );
} );</code></pre>