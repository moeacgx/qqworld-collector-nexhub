<p>将采集到的链接转换成加密链接，可以防采集。</p>
<h3>高级加密链接</h3>
<p>通过接口即时生成加密链接，有1小时的时效性，过期失效，接口如下：</p>
<pre class="prism"><code class="language-php">$link = 'https://www.baidu.com';
// 转换为加密地址
$link = apply_filters('qqworld-collector-super-encrypt-link', $link);</code></pre>
<h1>自定义接口名</h1>
<h3>过滤器加密链接</h3>
<pre class="prism"><code class="language-php">add_filter('qqworld-collector-decrypt-link-api', function($api) {
	$api = '你的接口名'; // 只能用英文，数字、横杠和下划线
	return $api;
});</code></pre>
<h3>高级加密链接</h3>
<pre class="prism"><code class="language-php">add_filter('qqworld-collector-super-decrypt-link-api', function($api) {
	$api = '你的接口名'; // 只能用英文，数字、横杠和下划线
	return $api;
});</code></pre>