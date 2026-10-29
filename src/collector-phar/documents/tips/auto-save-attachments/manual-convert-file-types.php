<p>将以下代码放到主题的 functions.php 里，使用 <a href="<?php print home_url('?convert=1') ; ?>">这里</a> 即可运行。</p>
<pre class="prism"><code class="language-php">if (isset($_GET['convert'])) {
	function manual_convert_file_types() {
		// 这里更换要替换的内容，可选格式：image/jpeg | image/gif | image/webp
		$post_mime_type = 'image/jpeg';
		$attachments = get_posts( array(
			'post_type' => 'attachment',
			'posts_per_page' => 1000,
			'post_mime_type' => $post_mime_type
		) );
		if (count($attachments)) {
			$regex = array(
				'image/jpeg' => array('/\.jpe?g$/', '.webp'),
				'image/png' => array('/\.png$/', '.webp'),
				'image/gif' => array('/\.gif$/', '.webp')
			);
			foreach ($attachments as $attachment) {
				$metadata = wp_get_attachment_metadata($attachment->ID);
				$metadata['file'] = preg_replace($regex[$post_mime_type][0], $regex[$post_mime_type][1], $metadata['file']);
				if ($metadata['sizes']) foreach ($metadata['sizes'] as &$size) {
					$size['mime-type'] = 'image/webp';
					$size['file'] = preg_replace($regex[$post_mime_type][0], $regex[$post_mime_type][1], $size['file']);
				}
				wp_update_attachment_metadata($attachment->ID, $metadata);
				wp_update_post(array(
					'ID' => $attachment->ID,
					'post_mime_type' => 'image/webp',
					'guid' => preg_replace($regex[$post_mime_type][0], $regex[$post_mime_type][1], $attachment->guid)
				));
				print '<p>';
				print_r($attachment->ID);
				print '</p>';
				exit;
			}
		} else {
			print 'All done.';
		}
	}
	manual_convert_file_types();
	exit;
}</code></pre>
<p>然后你就可以把附件下载到本地转换成webp格式后再上传了。</p>