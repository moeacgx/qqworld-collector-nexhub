<p>如果你不需要交互功能，只需要用最快的速度展示网站，你会喜欢这个类似于帝国CMS等国产系统的静态缓存系统。</p>
<h2>注意事项</h2>
<h3>首页兼容</h3>
<p>服务器的默认设置通常是 <strong>PHP</strong> 文件优先，这会导致首页的缓存无法被优先调用，解决方法：</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>static-cache/1.png" /><br />在网站设置中，要将 <strong>index.html</strong> 放到 <strong>index.php</strong> 的上面去。</p>
<h3>计划任务失效</h3>
<p>因为WP的计划任务需要访问网站来触发，如果用户不再访问PHP文件而直接读取HTML缓存，会导致计划任务全部失效，解决方法是，使用 <a href="https://ce.baidu.com/" target="_blank">百度云观测</a> 每隔1分钟访问网站的管理地址：<em><?php print admin_url(); ?></em>。</p>
<h3>不兼容</h3>
<dl>
	<dt>多站点模式</dt>
	<dd>只支持主站，子站的静态缓存会覆盖主站数据。</dd>
	<dt>.html 结尾的固定链接</dt>
	<dd>无法使用 <strong>智能刷新</strong>，会导致404的问题</dd>
	<dt>编辑预览</dt>
	<dd>除非禁止缓存首页，否则预览时会跳转到首页。</dd>
</dl>