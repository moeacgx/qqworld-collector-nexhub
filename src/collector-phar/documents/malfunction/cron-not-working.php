<h1>原因1</h1>
<p>某些插件造成的冲突，比如 <strong>Auto Post Pro</strong>，禁用即可。</p>
<h1>原因2</h1>
<p>可能是服务器时区问题，对于WordPress这种全世界都使用的CMS来说，系统时区必须设置为格林威治时间（UTC），相对时区在WP的后台设置。</p>
<h2>解决方法</h2>
<h3>检测时区</h3>
<p>使用Linux命令行检测当前时区</p>
<pre class="prism"><code class="language-php">date -R</code></pre>
<p>如果显示：</p>
<pre class="prism"><code class="language-php">Wed, 10 Jun 2020 09:30:52 +0800</code></pre>
<p>+8小时是北京时间，这里必须改成UTC时间。</p>
<h3>去掉本地时间</h3>
<p>下命的命令将删除本地时间设置，系统时间将变会UTC时间。</p>
<pre class="prism"><code class="language-php">rm /etc/localtime -rf</code></pre>
<p>再次运行 date -R</p>
<pre class="prism"><code class="language-php">Wed, 10 Jun 2020 01:36:41 +0000</code></pre>
<p>然后重启服务器。</p>
<p class="qc-icon info">注意：<a href="<?php print admin_url('options-general.php'); ?>">常规选项</a> 里的时区要改成 <em>UTC+8</em>，不要用 <em>上海</em> 等字符，会导致兼容性出错。</p>
