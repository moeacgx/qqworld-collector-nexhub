<h2>未允许的的方法</h2>
<p>如果你是远程发布到 <strong>WordPress</strong> 遇到该错误，是因为你安装了的优化插件禁用了 <strong>XMLRPC</strong> 所致。</p>
<h2>解决方案</h2>
<h2>方法1</h2>
<p>解除优化插件中 <strong>XMLRPC</strong> 的禁用。</p>
<h2>方法2</h2>
<p>将以下代码放到主题的 functions.php 中去：</p>
<pre class="prism"><code class="language-php">add_filter('xmlrpc_enabled', '__return_true');</code></pre>