<p>本插件对服务器的硬件配置要求较高，如果你用不起高性能服务器，可以使用本地局域网模式，利用家用电脑相对强悍的性能采集文章和图片并推送到远程站点。</p>
<p class="qc-icon info">注意：本地版会加密本地文章内容，所以无法直接转成线上站点，只能用于远程发布。</p>
<h1>安装、激活和使用方法</h1>
<h3>一、修改hosts文件</h3>
<p>本地局域网版必须使用 <em>q.c</em> 及其子域名，这种域名必须通过修改hosts文件来解析，方法如下：</p>
<ol>
	<li>以管理员身份运行记事本；</li>
	<li>打开 <em>C:\Windows\System32\drivers\etc\hosts</em> 文件；</li>
	<li>在最下面添加：<br />
<strong>127.0.0.1 q.c<br />
127.0.0.1 www.q.c</strong><br />
并保存即可，如果有很多网站需要推送，可以使用其他二级域名，如 <em>1.q.c</em>。</li>
</ol>
<h3>二、安装本地服务器</h3>
<p>有很多种，比如 <strong>宝塔</strong>、<strong>Visual-AMP</strong>、<strong>phpStudy</strong> 等等，使用任何一种都可以。</p>
<p>安装好服务器环境后，新建站点和数据库，绑定 <em>q.c</em> 域名。</p>
<h3>三、激活本地服务器版</h3>
<p>安装 <strong>WordPress</strong> 和包括 <strong>QQWorld收藏家豪华版</strong> 在内的必要插件后，使用购买的 <strong>站长版</strong> 或 <strong>旗舰版</strong> 的序列号激活即可。</p>
<h3>四、添加远程站点</h3>
<p>在 <strong>设置</strong> - <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings#home'); ?>" target="_blank"><strong>远程站点</strong></a> 中添加，注意网站域名必须和产品序列号中的域名匹配。请看 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#settings--remote-website'); ?>" target="_blank">远程站点</a> 详解。</p>
<h3>五、绑定远程站点</h3>
<p>在每个收藏项目的 <strong>采集设置</strong> 中可以绑定添加的远程站点，保存后就可以愉快地采集并推送了。</p>
<h2>注意事项</h2>
<h3>主题加密</h3>
<p>如果因为加密的原因，本地无法使用付费主题，可以在安装有付费主题的远程站点上利用插件的 <strong>导入 &amp; 导出</strong> 功能把主题配置导出，然后在本地局域网导入。</p>
<h3>使用Apache</h3>
<p>推荐使用 <strong>Apache</strong>，限制比Nginx会小一点，虽然更占资源，但是本地有的是资源。</p>
<h3>PHP版本</h3>
<p>插件是在最新版上开发的，所以PHP的版本越高越好。</p>
<h3>MySQL版本</h3>
<p>推荐5.6以上。</p>
<h1>详细教程</h1>
<p><a class="button button-primary button-large qc-icon link" href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--local-edition'); ?>" target="_blank">部署本地局域网版</p>