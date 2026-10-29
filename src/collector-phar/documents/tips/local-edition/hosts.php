<h2>修改hosts文件</h2>
<p>本地局域网版必须使用 q.c 及其子域名，这种域名必须通过修改hosts文件来解析，方法如下：</p>
<h3>新建批处理文件</h3>
<p>打开记事本，输入：</p>
<pre class="prism"><code class="language-php">%WINDIR%\system32\notepad %WINDIR%\System32\drivers\etc\hosts</code></pre>
<p>保存为 <em>hosts.bat</em> 文件。</p>
<h3>以管理员身份运行</h3>
<p>因为 <em>hosts</em> 是系统文件，所以需要以管理员身份运行 <em>hosts.bat</em>，即可打开载入 <em>hosts</em> 文件的记事本程序。</p>
<h3>添加本地解析记录</h3>
<p>在hosts文件的最下方添加：</p>
<pre class="prism"><code class="language-php">127.0.0.1 q.c
127.0.0.1 www.q.c</code></pre>
<p>并保存即可，如果有很多网站需要推送，可以添加更多二级域名，如 <em>127.0.0.1 1.q.c</em>。</p>
<h2>删除hosts记录</h2>
<p>在某些阿里云或腾讯云服务器上，默认会把域名解析到127.0.0.1，这会让插件将网络识别为局域网而无法激活。</p>
<p>解决方法是在hosts文件中删除你的域名项目，如下图所示，在宝塔的文件管理器中打开 <em>/etc/hosts</em> 文件：</p>
<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/local-edition/hosts/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/local-edition/hosts/1.png" /></a></p>
<p>假设你的域名是 <em>yourdomain.com</em>，在hosts文件里将相关域名删除后保存即可。</p>