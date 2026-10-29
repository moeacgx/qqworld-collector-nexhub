<p>将以下代码放到主题的 functions.php 中即可对获取到的自动分词就行过滤。</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-automatic-tags-filter', function($data) {
	if (!empty($data)) {
		// 此处加入你的代码
		// .......
	}
	return $data;
});</code></pre>