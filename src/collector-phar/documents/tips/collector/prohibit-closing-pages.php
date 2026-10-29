<p>在写采集规则时需要分析网站，尤其是某些下载按钮，点击之后会自动关闭当前页，就无法在 <strong>开发者工具</strong> 中获取想要的信息，将如下代码在 <strong>开发者工具</strong> 的 <em>Console</em> 里运行之后就不会自动关闭页面了。</p>
<pre class="prism"><code class="language-php">window.onbeforeunload = function() {
	return '要显示的提示内容';
}</code></pre>
<p>运行之后，关闭页面的时候，会弹出确认框，点取消按钮就可以留在当前页，并查看 <strong>开发者工具</strong> 里的 <em>Network</em> 信息来完善采集规则。</p>