<p>在主题的 functions.php 中加入以下代码，可以修改远程附件的文件名。</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-save-attachment-filename', 'my_save_attachment_filename', 10, 2 );
function my_save_attachment_filename($filename, $remote_attachment) {
	$filename = str_replace('_彼岸图网', '', $filename); // 删除文件名中的网站名
	return $filename;
}</code></pre>