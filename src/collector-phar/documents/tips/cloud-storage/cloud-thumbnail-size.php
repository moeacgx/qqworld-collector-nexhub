<p>将以下代码放到主题的 <em>functions.php</em> 中去，即可将云缩略图的尺寸写死为宽度400px和高度300px。</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-cloud-storage-resize-size', 'my_resize', 10, 2 );
function my_resize($size, $url=null) {
	$size = array(400, 300);
	return $size;
}</code></pre>