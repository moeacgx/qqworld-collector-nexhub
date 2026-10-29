<p>在 <a href="<?php print admin_url('admin.php?page=qqworld-collector-auto-save-attachment#format'); ?>" target="_blank">自动保存附件 - 格式化</a> 中，可以自定义输出附件的额外内容：</p>
<p><?php _e('Additional Content Before', $this->text_domain); ?></label></p>
<pre class="prism"><code class="language-php">// <?php _e('Output source image', $this->text_domain); ?>

add_filter( 'qqworld-collector-save-remote-image-additional-content-before', 'additional_content_before', 10, 4 );
function additional_content_before($content, $attachment_id, $post_id, $orginal_url ) {
	$content = '&lt;img src="' . $orginal_url . '"&gt;';
	return $content;
}</code></pre>
<p><?php _e('Additional Content After', $this->text_domain); ?></label></p>
<pre class="prism"><code class="language-php">// <?php _e('Output source image', $this->text_domain); ?>

add_filter( 'qqworld-collector-save-remote-image-additional-content-after', 'additional_content_after', 10, 4 );
function additional_content_after($content, $attachment_id, $post_id, $orginal_url ) {
	$content = '&lt;img src="' . $orginal_url . '"&gt;';
	return $content;
}</code></pre>
<p><?php _e("This content will be displayed before or after the each remote images code.", $this->text_domain); ?></p>