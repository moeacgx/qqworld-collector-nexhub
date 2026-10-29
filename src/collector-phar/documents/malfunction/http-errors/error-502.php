<h2>无效网关</h2>
<p>一般出现了这个问题是由于不良的IP之间的沟通后端计算机，包括您可能尝试访问的在Web服务器上的网站。在分析这个问题，您应该先完全清除浏览器缓存。</p>
<p>如果您上网时在您尝试访问的所有网站上都看这个问题，就有5种可能</p>
<ol>
	<li>宝塔的软件商店 -&gt; 已安装软件 -&gt; PHP管理 -&gt; 性能调整：将连接方式改成 <strong>Tcp套接字</strong> 就好了</li>
	<li>开启了某些CDN，因为超时返回502，建议参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#malfunction--http-errors--tencent-cdn-564'); ?>" target="_blank">腾讯CDN564</a> 的解决方案。</li>
	<li>服务器出了重大设备故障</li>
	<li>向服务器发送请求，由于服务器当前链接太多，导致服务器方面无法给于正常的响应</li>
	<li>有问题的内部互联网连接如您的防火墙无法正常运作。</li>
</ol>
<p>在第一种情况下，只有您的ISP可以帮助您。在第二种情况下，就需您自己解决任何阻止您进入互联网的问题。　如果您只有在部分尝试访问的网站中出现此问题，那就很可能是一个问题，即这些网站之一，其设备故障或超载。你赶紧联系网站的管理员。</p>
<h2>解决方法</h2>
<p>用Ctrl+F5刷新浏览器并重试。</p>
<h3>Nginx</h3>
<p>适当调大 <em>php-fpm.conf</em> 中的以下参数数值（如果没有可以自行添加，建议全部在原有基础上翻番）：</p>
<pre class="prism"><code class="language-php">pm.max_children = 50
pm.start_servers = 10
pm.min_spare_servers = 10
pm.max_spare_servers = 20
pm.max_requests = 10240</code></pre>
<p>适当调大 <em>nginx.conf</em> 中 <em>http{...}</em> 中的以下参数数值，可以全部翻倍或翻两倍试试：</p>
<pre class="prism"><code class="language-php">fastcgi_buffers 8 16k;      # FastCGI缓冲区数量与大小
fastcgi_buffer_size 32k;     # 响应头缓冲区
proxy_buffers 8 16k;         # 反向代理缓冲区
client_max_body_size 20M;    # 允许上传的最大文件体积（需与PHP配置同步）</code></pre>
<h3>PHP</h3>
<p>​​调整PHP内存限制，修改 <em>php.ini</em> 里的以下参数：</p>
<pre class="prism"><code class="language-php">memory_limit = 128M             # 避免内存不足导致进程崩溃
max_execution_time = 300        # 脚本最长执行时间</code></pre>
<p>建议把504也优化一下。</p>
<p>还有个很低的可能性：Nginx 版本太高，可以略微降低一个版本，比如从 <em>1.19</em> 降低到 <em>1.18</em> 试试。</p>
<p>如宝塔地址：/www/server/php/{php版本}/etc/php-fpm.conf</p>
<h3>MySQL</h3>
<p>MySQL的内存设置也可以调大一点，比如宝塔里选优化方案：<strong>4-8GB</strong>。</p>
<h3>更多答案</h3>
<p>请在百度中搜索 <a href="https://www.baidu.com/s?wd=nginx+502" target="_blank">Nginx 502</a>。</p>