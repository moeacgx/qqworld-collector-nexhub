<h2>使用方法</h2>
<p>在主题的 <em>functions.php</em> 里加入以下代码：</p>
<h3>只排除本站</h3>
<?php $parser = parse_url(home_url()); ?>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-save-attachments-exclude-domain', function() {
	return array('<?php print $parser['host']; ?>');
}, 99);</code></pre>
<h3>不排除任何域名</h3>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-save-attachments-exclude-domain', function() {
	return array();
}, 99);</code></pre>
<p><em class="qc-icon info">注意，这里的接口将覆盖网站的相关设置。</em></p>