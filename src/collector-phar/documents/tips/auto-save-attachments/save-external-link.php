<p>在 <a href="<?php print admin_url('admin.php?page=qqworld-collector-auto-save-attachment#format'); ?>" target="_blank">自动保存附件 - 格式化</a> 中，可以自定义保存外链的内容：</p>
<pre class="prism"><code class="language-php">add_filter('qqworld-collector-save-remove-image-external-link', 'save_external_link', 10, 2);
function save_external_link($content, $link) {
	$content = '&lta href="'.$link.'" target="_blank" rel="nofollow"&gt;Original Link&lt;/a&gt;';
	return $content;
}</code></pre>