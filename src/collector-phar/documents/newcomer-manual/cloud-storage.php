<h1>云存储</h1>
<h2>使用建议</h2>
<p>设置好云存储并确认连接成功后，先去 <a href="<?php print admin_url('upload.php?mode=list'); ?>" target="_blank">媒体库列表页 </a>手动同步一个附件，没问题了再执行扫描程序。</p>
<p>每个附件的详细页都可以查看和该附件有关的云存储同步情况。</p>
<h2>无需扫描媒体库（仅适用于可控云存储）</h2>
<p>以下两种情况可以不需要扫描：</p>
<dl>
	<dt>情况1：不需要删除本地附件</dt>
	<dd>开启插件的 <strong>同步网站资源</strong>（不要自定义云存储目录）并设置云存储管理中的 <strong>镜像回源</strong> 即可，详情请看 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#video-course--cloud-storage'); ?>" target="_blank">视频教程</a>。</dd>
	<dt>情况2：需要删除本地附件以节省空间</dt>
	<dd>如果可以将媒体库的图片使用更快捷的方式传到云存储对应的目录，比如使用FTP传到七牛云存储，就可以点击 <a href="<?php print admin_url('admin.php?page=qqworld-collector-cloud-storage'); ?>" target="_blank">云存储</a> 设置页的 <strong>模式</strong> 下拉菜单旁的 <strong>快速同步</strong> 按钮而不用扫描。</dd>
<dl>