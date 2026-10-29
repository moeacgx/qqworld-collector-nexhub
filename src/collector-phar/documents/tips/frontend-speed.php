<p>打开插件根目录的 <em>qqworld-collector.php</em>，将最后一行的：</p>
<pre class="prism"><code class="language-php">require 'phar://'.__DIR__.'/phar/collector.phar/index.php';</code></pre>
<p>改成：</p>
<pre class="prism"><code class="language-php">if (is_admin()) require 'phar://'.__DIR__.'/phar/collector.phar/index.php';</code></pre>
<h2>副作用</h2>
<ul>
	<li>定时采集可能会出问题，无法被前端访问激活。</li>
	<li>无法使用前端采集器。</li>
	<li>无法显示特色图云存储地址。</li>
</ul>