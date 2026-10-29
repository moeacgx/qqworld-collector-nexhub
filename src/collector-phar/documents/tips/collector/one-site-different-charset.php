<p>有些奇葩网站，列表和正文虽然标示了gb2312编码，但是正文却是utf-8编码，导致无法正常采集，需要用到接口来指定编码。</p>
<h3>修改列表页编码</h3>
<p>将如下代码放到主题的 <strong>functions.php</strong> 中：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collctor-collection-project-grab-source-link-download-args', function($download_args, $source_link, $archive, $settings) {
	// 如果列表地址包含 680.com，则将编码改为 UTF-8
	if (strstr($source_link, '680.com') !== false) $download_args['charset'] = 'UTF-8';
	return $download_args;
}, 10, 4 );</code></pre>
<h3>修改正文页编码</h3>
<p>将如下代码放到主题的 <strong>functions.php</strong> 中：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collctor-collection-project-grab-source-content-download-args', function($download_args, $source, $singular, $settings) {
	// 如果正文地址包含 680.com，则将编码改为 UTF-8
	if (strstr($source['post_link'], '680.com') !== false) $download_args['charset'] = 'UTF-8';
	return $download_args;
}, 10, 4 );</code></pre>
<h3>修改评论页编码</h3>
<p>将如下代码放到主题的 <strong>functions.php</strong> 中：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collctor-collection-project-grab-source-comments-download-args', function($download_args, $results, $source, $comments, $settings) {
	// 如果评论地址包含 680.com，则将编码改为 UTF-8
	if (strstr($source['post_link'], '680.com') !== false) $download_args['charset'] = 'UTF-8';
	return $download_args;
}, 10, 5 );</code></pre>