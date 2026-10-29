<p>有些用户想把正在使用的阿里云OSS云存储换成FTP，但是这需要把庞大的媒体库再扫描一遍，太慢了，本教程将教大家免扫描极速切换云存储。</p>
<p>需要注意的是，这种方法只支持FTP和六大国内云存储和AWS S3，不支持图床型云存储。</p>
<p>下面以将阿里云OSS切换为FTP为例：</p>
<pre class="prism"><code class="language-php">&lt;?php
set_time_limit(0);
if (isset($_GET['gogogo'])) {
	global $wpdb;
	$from = 'aliyun-oss'; // 当前云存储ID
	$to = 'ftp'; // 准备使用的云存储ID
	$sql = "UPDATE `{$wpdb->postmeta}` SET `{$wpdb->postmeta}`=REPLACE(`meta_key`, '_sync_{$from}', '_sync_{$to}')";
	$wpdb->query($sql);
	print 'Done';
	exit;
}
?&gt;</code></pre>
<p>使用方法：首先将OSS上的图片全部按照网站目录结构传到FTP上，再上述代码中的 <em>$from</em> 的值改成你当前使用的云存储，默认是 <strong>aliyun-oss</strong>，将 <em>$to</em> 的值改成你准备要用的云存储，默认是 <strong>ftp</strong>。然后将上述代码放置到主题的 <em>functions.php</em> 中，然后在访问 <a href="<?php print home_url('?gogogo'); ?>" target="_blank"><strong><?php print home_url('?gogogo'); ?></strong></a> 即可执行转换程序，等运行完之后会显示 <strong>Done.</strong>，检查无误，就可以删掉了。</p>
<p>然后需要正确设置云存储中FTP的参数，并且使用 <a href="<?php print admin_url('admin.php?page=qqworld-collector-database'); ?>" target="_blank"><strong>数据库</strong></a> 工具将OSS的图片地址域名<a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#database'); ?>" target="_blank">批量换</a>成FTP的。</p>
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