<p>在文章的编辑页的QQWorld收藏家设置中会增加下列功能。</p>
<h2>设置文章作者</h2>
<p>可以从下拉菜单中选择常用的用户，如果要临时创建用户，或指定低权限的用户，可以直接输入用户的名称。</p>
<h2>设置文章类型</h2>
<p>你可以在这里更换文章的类型。</p>
<h2>使用当前日期</h2>
<p>如果你想将文章发布日期改成当前日期，请勾选这里。</p>
<p>默认时关闭的，如果要默认开启，将以下代码放到主题id <em>functions.php</em> 里去：</p>
<pre class="prism"><code class="language-php">// 使用当前日期默认开启
add_filter( 'qqworld-collector-auxiliary-use-current-date-default-value', function() {
	return 1;
} );</code></pre>