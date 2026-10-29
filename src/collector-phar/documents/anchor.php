<p>自动给文章中的关键词添加链接，自动给文章生成标签。</p>
<p>手动设置的锚点关键词支持多连接，使用 | 隔开，将随机输出其中的1个。</p>
<h3>排除某些分类</h3>
<p>系统不会给指定ID的分类添加锚点，接口代码如下，放置到主题的 <em>functions.php</em> 里：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-automatic-anchor-exclude-terms', function() {
	// 以数组的方式填写分类的ID
	return array(15, 19, 22);
} );</code></pre>