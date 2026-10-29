<h2>程序加速</h2>
<p>本插件是大型应用程序，每次运行都进行即时编译会感觉速度很慢，安装PHP的 <strong>Opcache扩展</strong> 之后就会快如闪电，在宝塔的PHP设置里可以轻松安装。</p>
<h2>超时问题</h2>
<p>服务器默认设置不予许长时间跑应用程序，大多数进程会在运行1分钟后被强制关闭，1分钟之内可能连一篇文章里的远程图都无法全部抓下来。</p>
<p>解决方法是在本帮助文档里搜索 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#malfunction--http-errors--error-502'); ?>" target="_blank"><strong>502</strong></a>、<a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#malfunction--http-errors--error-504'); ?>" target="_blank"><strong>504</strong></a> 和 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#malfunction--http-errors--error-404'); ?>" target="_blank"><strong>404</strong></a>，并且根据需要适当调整相关参数。</p>
<h2>环境</h2>
<p>刚装好插件的用户请检查 <a href="<?php print admin_url('admin.php?page=qqworld-collector#environment'); ?>" target="_blank">环境</a>，尽量都满足吧，尤其是那个 <strong>ImageMagick</strong> 组件，抓图必装的哦。</p>
<h2>采集减负</h2>
<p>采集的压力主要来自抓图，差不多会占80%，原因是抓图入库，WP会把图片切成很多缩略图尺寸，尺寸越多，速度越慢，耗资源越多。</p>
<h3>解决方法（两种选其一，推荐第2种）</h3>
<dl>
	<dt>不使用媒体库</dt>
	<dd>在 <a href="<?php print admin_url('admin.php?page=qqworld-collector-auto-save-attachment#qqworld-collector-auto-save-attachment-settings-no-media-library'); ?>" target="_blank">自动保存附件 - 常规</a> 设置中勾选 <strong>不使用媒体库</strong>，这样就只有特色图会保存到媒体库，其他图片只保存完整尺寸，会大大降低压力。</dd>
	<dt>禁用不需要的缩略图尺寸</dt>
	<dd>很多缩略图尺寸并没有被主题使用，白白地浪费服务器资源。在 <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings'); ?>" target="_blank">设置 - 图像</a> 设置中开启 <strong>禁用缩略图尺寸</strong>，然后 <strong>勾选不需要</strong> 的缩略图尺寸，保存即可。<br />建议：设置好之后建议发一篇文章试试，如果主题在列表页显示该图的特色图没问题，就是OK了，如果安装了 <em>Woocommerce</em> 还需要考虑产品图缩略图尺寸。<br />如果弄错了，可以 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--regenerate-thumbnails'); ?>" target="_blank">重建缩略图</a>。</dd>
</dl>