<h1>原因一</h1>
<p>被采集站是https，你的网站是http，SSL加密的网站是无法向http站点投送内容的，解决方法是将你的网站改成https协议。</p>
<h1>原因二</h1>
<p>被你的服务器的CC防火墙拦截了，关闭防火墙或将你本地的IP加入白名单即可。</p>
<h1>原因三</h1>
<p>在某些高内核版本的浏览器上，无法正常采集列表和正文，某些低版本浏览器反而可以。</p>
<p>这是因为自Chrome 85以来，为加强扩展的安全性，将 <em>Referrer Policy: no-referrer-when-downgrade</em> 改为了 <em>Referrer Policy: strict-origin-when-cross-origin</em>，默认不允许跨域请求。</p>
<h3>解除扩展跨域请求限制</h3>
<ol>
	<li>在地址栏输入 <em>chrome://flags/</em>，这里可以对Chrome的特性进行调整，可以关闭和开启一些隐藏的功能。</li>
	<li>搜索 <strong>cors</strong>，然后将 <strong>CORS for content scripts</strong> 设为 <strong>Disabled</strong>，如下图所示：<br /><br /><p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>malfunction/collector/frontend-not-working/1.png" /></p></li>
	<li>再点击右下方的 <strong>Relaunch</strong> 重启浏览器即可。</li>
</ol>
<h1>原因四</h1>
<p>服务器开了防盗链，导致 Rest API 无法正常访问（404）。</p>
<h1>原因五</h1>
<p>前端扩展的版本旧了，在360或谷歌应用商店的版本不一定是最新版，请去官方百度网盘下载最新版。</p>