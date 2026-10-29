<p>这是因为Nginx的站点设置中有相关文件扩展名的缓存设置。</p>
<h3>解决方法</h3>
<p>删掉站点设置中的如下字符：</p>
<pre class="prism"><code class="language-php">error_page 404 /404.html;</code></pre>
<p>和</p>
<pre class="prism"><code class="language-php">location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
{
    expires      30d;
    error_log off;
    access_log /dev/null;
}</code></pre>