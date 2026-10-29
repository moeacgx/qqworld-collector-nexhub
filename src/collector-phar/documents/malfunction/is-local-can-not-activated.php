<p>在某些阿里云服务器上，会提示局域网无法激活，因为阿里云服务器上把IP解析到本地局域网。</p>
<h2>解决方法</h2>
<h3>修改HOSTS</h3>
<p>各操作系统下 <em>hosts</em> 文件的路径：</p>
<dl>
	<dt>Linux服务器</dt>
	<dd><em>/etc/hosts</em></dd>
	<dt>Windows服务器</dt>
	<dd><em>C:\Windows\System32\drivers\etc\hosts</em></dd>
</dl>
<p>打开该文件，在最后面加入一行，注意把 <em>123.456.789.123</em> 改成你的服务器IP：</p>
<pre class="prism"><code class="language-php">123.456.789.123 <?php print $_SERVER['SERVER_NAME']?></code></pre>