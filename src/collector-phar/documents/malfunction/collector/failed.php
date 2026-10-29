<h2>原因1：已忽略</h2>
<ol>
	<li>大多是因为采集设置中已排除的URL中有个<strong>h</strong>，这是旧版产生的Bug，删掉即可。</li>
	<li>因为采集设置中的 <em>避免空内容</em> 设置排除掉了，检查是否有勾选的内容没有采集到，一定要先测试采集列表，然后从列表中选一篇文章进行采集才算一次完整测试，基本上都是因为列表页没有采集到正确的 <strong>文章链接</strong> 所致。</li>
	<li>因为过滤器中的 <em>按关键词过滤</em> 和 采集设置中的 <em>已排除的URL</em> 设置排除掉了。</li>
	<li>可能是因为POST被防火墙拦截。</li>
	<li>使用了无效的代理服务器。</li>
</ol>
<h2>原因2：失败</h2>
<ol>
	<li>建议检查 <strong>设置</strong> - <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings#download'); ?>" target="_blank"><strong>收藏项目</strong></a> - <strong>收藏项目规则过滤器</strong>，看看是否勾了不应该勾的项目。</li>
	<li>可能是程序库兼容错误，建议将 <strong>设置</strong> - <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings#download'); ?>" target="_blank"><strong>收藏项目</strong></a> - <strong>采集方法核心</strong> 更换成 <strong>简单的HTML DOM解析器</strong> 试试。</li>
	<li>可能是因为Opcache缓存问题，建议清空试试。</li>
	<li>可能是因为数据库太大，MySQL内存不足，建议把MySQL的内存调大试试。</li>
	<li>可能是因为防采集，建议试试其他网站的文章能否采集。</li>
	<li>如果破解了防采集仍然无法采集，可以考虑网站服务器IP被封，以及下面几条的可能性。</li>
	<li>可能HTTP请求被防火墙拦截：400 - Request blocked by OpenRASP</li>
	<li>如果文章可以采集下来，但是图片采集不到，可能是因<strong>水印</strong>本地文件被删导致报错。</li>
	<li>如果关闭抓图就好了，可能是因为文章里的图片太大，超出 <strong>自动保存附件</strong> 的 <strong>最大图片尺寸</strong> 限制，被自动缩小时造成的内存不足。解决方法要么 <strong>增大内存</strong>，要么将 <strong>最大图片尺寸</strong> 调得更大以禁止自动缩图。</li>
	<li>因为内存不足，修改 <strong>php.ini</strong> 里的 <em>memory_limit</em> 数值，翻番试试。</li>
</ol>