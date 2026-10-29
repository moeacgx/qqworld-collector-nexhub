<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/filters/advanced_feature/wp_filter/1.png" /></p>
<p>使用自定义的过滤器处理采集到的内容。</p>
<h2>使用方法</h2>
<h4>定义一个过滤器</h4>
<p>将以下内容放到主题的 <em>functions.php</em> 中去：</p>
<pre class="prism"><code class="language-php">add_filter('mynamespace-filtername', 'filtername');
function filtername($content) {
	// 在这里对采集到的内容 $content 进行处理
	return $content;
}</code></pre>
<p>其中 <strong>mynamespace-filtername</strong> 是过滤器的标签名，<strong>filtername</strong> 是过滤器的函数名，用于处理内容。</p>
<p>然后将该过滤器的标签名称填到过滤器的多行输入框中去即可（见顶图）。</p>