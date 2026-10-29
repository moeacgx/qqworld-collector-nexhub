<p>假如你在使用QQWorld收藏家之前已经使用了别家的云存储程序，成功将所有的附件都同步到云存储了，但是在QQWorld收藏家中又需要同步一次，非常浪费时间，以下代码就是告诉系统，所有附件都已经同步了。</p>
<pre class="prism"><code class="language-php">set_time_limit(0);
if (isset($_GET['gogogo'])) {
	$guid = 'ftp';
	$guid = str_replace('-', '_', $guid);
	for ($paged=0; $paged<1000; $paged++) {
		$args = array(
			'post_type' => 'attachment',
			'meta_key' => "_sync_{$guid}",
			'meta_value' => 1,
			'meta_compare' => 'NOT EXISTS',
			'posts_per_page' => 1000,
			'offset' => 1000*$paged
		);
		$attachments = get_posts($args);
		if (!empty($attachments)) {
			foreach ($attachments as $attachment) {
				$attachment_id = $attachment->ID;
				update_post_meta($attachment_id, "_sync_{$guid}", 1);
			}
		} else {
			break;
		}
	}
	print 'Done';
	exit;
}</code></pre>
<p>使用方法：首先将 <em>$guid</em> 的值改成你当前使用的云存储，默认是 <strong>ftp</strong>。然后将上述代码放置到主题的 <em>functions.php</em> 中，然后访问 <a href="<?php print home_url('?gogogo'); ?>" target="_blank"><strong><?php print home_url('?gogogo'); ?></strong></a> 即可执行强制同步程序，等运行完之后会显示 <strong>Done.</strong>，检查无误，就可以删掉了。</p>
<p>如果有很多附件，中途断掉了，可能需要多运行几次。</p>
<h2>云存储ID</h2>
<dl>
	<dt><?php _e('File Transfer Protocol (FTP)', $this->text_domain); ?></dt>
	<dd>ftp</dd>
	<dt><?php _e('Qiniu Cloud Storage', $this->text_domain); ?></dt>
	<dd>qiniu</dd>
	<dt><?php _e('Aliyun Open Storage Service (OSS)', $this->text_domain); ?></dt>
	<dd>aliyun-oss</dd>
	<dt><?php _e('Tencent Cloud Object Service (COS)', $this->text_domain); ?></dt>
	<dd>tencent-cos</dd>
	<dt><?php _e('UpYun Storage Service', $this->text_domain); ?></dt>
	<dd>upyun</dd>
	<dt><?php _e('Baidu Object Storage (BOS)', $this->text_domain); ?></dt>
	<dd>baidu-bos</dd>
	<dt><?php _e('Amazon Web Services S3 Cloud Storage (AWS S3)', $this->text_domain); ?></dt>
	<dd>aws-s3</dd>
	<dt><?php _e('UCloud File Storage Service (UFile)', $this->text_domain); ?></dt>
	<dd>ucloud-ufile</dd>
	<dt><?php _e('KuaiYun Storage Service', $this->text_domain); ?></dt>
	<dd>kuaiyun</dd>
	<!--
	<dt><?php _e('Super Bed', $this->text_domain); ?></dt>
	<dd>superbed</dd>
	<dt><?php _e('Sina Images Storage', $this->text_domain); ?></dt>
	<dd>sinaimg</dd>
	<dt><?php _e('TieTuKu Storage Service', $this->text_domain); ?></dt>
	<dd>tietuku</dd>
	<dt><?php _e('SM.MS', $this->text_domain); ?></dt>
	<dd>smms</dd>
	<dt><?php _e('Imgchr Image Storage', $this->text_domain); ?></dt>
	<dd>imgchr</dd>
	<dt><?php _e('Imgse Image Storage', $this->text_domain); ?></dt>
	<dd>imgse</dd>
	<dt><?php _e('Picb Image Storage', $this->text_domain); ?></dt>
	<dd>picbcc</dd>
	<dt><?php _e('Pic68 Image Storage', $this->text_domain); ?></dt>
	<dd>pic68</dd>
	<dt><?php _e('Mtkan Image Storage', $this->text_domain); ?></dt>
	<dd>mtkancc</dd>
	-->
</dl>