<p>移动端 <strong>Safari浏览器</strong> 不支持 <strong>WEBP格式</strong>，如果你的云缩略图支持自动转WEBP，可以将下面的代码放到主题的 <strong>functions.php</strong> 里，会自动在 <strong>Safari浏览器</strong> 下删除云缩略图后缀以达到输出原格式的目的。</p>
<pre class="prism"><code>if ((preg_match('/iPhone/i', $_SERVER['HTTP_USER_AGENT']) || preg_match('/Macintosh/i', $_SERVER['HTTP_USER_AGENT'])) && preg_match('/Safari/i', $_SERVER['HTTP_USER_AGENT'])) {
	ob_start('remove_cdn_suffix');
	add_action( 'wp_after_admin_bar_render', function() {
		ob_end_flush();
	});
}
function remove_cdn_suffix($buffer) {
	// 请将 ?iopcmd=convert&amp;amp;dst=webp 替换为你的云缩略图后缀，注意有时候要去查看源代码才能知道正确的代码
	$buffer = str_replace('?iopcmd=convert&amp;amp;dst=webp', '', $buffer);
	return $buffer;
}</code></pre>
<h2>用户代理参考</h2>
<dl>
	<dt>iPad</dt>
	<dd>Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.2 Safari/605.1.15</dd>
	<dt>iPhone</dt>
	<dd>Mozilla/5.0 (iPhone; CPU iPhone OS 13_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.2 Mobile/15E148 Safari/604.1</dd>
</dl>