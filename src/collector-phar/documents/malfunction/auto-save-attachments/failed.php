<h2>原因1：已忽略</h2>
<ol>
	<li>图片地址失效或不完整（缺http:）。</li>
	<li>被封IP了。</li>
	<li>可能是因为无法自动转换WEBP图片格式造成的，建议安装完美支持WEBP的Imagemagick，或者支持WEBP库的GD。</li>
	<li>如果实在无法支持WEBP格式，就在 <strong>自动保存附件</strong> 的 <a href="<?php print admin_url('admin.php?page=qqworld-collector-auto-save-attachment#filter'); ?>" target="_blank">过滤</a> 设置中关闭和WEBP有关的文件格式自动转换功能。</li>
	<li>可能是因为POST被防火墙拦截。</li>
	<li>使用了无效的代理服务器。</li>
</ol>
<h2>原因2：失败</h2>
<ol>
	<li>可能是因为Opcache缓存问题，建议清空试试。</li>
	<li>可能是因为防盗链，建议试试其他网站的图能否采集。解决方法请看 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--auto-save-attachments--grab-remote-attachments'); ?>" target="_blank">抓不到远程附件？(防采集，防盗链)</a>。</li>
	<li>如果破解了防采集仍然无法采集，可以考虑网站服务器IP被封，以及下面几条的可能性。</li>
	<li>可能是因为上传目录不可写，建议改成 <em>777</em> 后再试试，最好是改成和 <strong>Nginx</strong> 一样的用户组，通常是 <em>www:www</em>，可以使用更安全的 <em>755</em>。</li>
	<li>可能是因为防火墙不允许写操作的原因。</li>
	<li>可能HTTP请求被防火墙拦截：400 - Request blocked by OpenRASP</li>
	<li>可能是因为没有安装 <strong>PHP</strong> 的 <em>fileinfo</em> 扩展，很多图床需要。</li>
	<li>如果关闭抓图就好了，可能是因为文章里的图片太大，超出 <strong>自动保存附件</strong> 的 <strong>最大图片尺寸</strong> 限制，被自动缩小时造成的内存不足。解决方法要么 <strong>增大内存</strong>，要么将 <strong>最大图片尺寸</strong> 调得更大以禁止自动缩图。</li>
	<li>因为内存不足，修改 <strong>php.ini</strong> 里的 <em>memory_limit</em> 数值，翻番试试。</li>
</ol>
<h2>原因3：成功了，但是图片无法打开</h2>
<p>可能是防采集造成的数据损坏，建议开启 设置 - 图像 - <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings#image'); ?>" target="_blank">校验图像文件格式</a> 并重试。</p>
<h2>原因4：致命错误</h2>
<ol>
	<li>可能是因为内存不足，<strong>php.ini</strong> 里的 <strong>memory_limit</strong> 调大一点试试，建议 <strong>1024M</strong>。</li>
	<li>可能是因为PHP的Imagemagick扩展的兼容性问题导致的，可以卸载后再试试。</li>
</ol>