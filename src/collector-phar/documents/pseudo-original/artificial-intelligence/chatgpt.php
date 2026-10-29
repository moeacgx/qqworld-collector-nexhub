<h2>ChatGPT</h2>
<h3>更换接口</h3>
<p>如果你有第三方接口地址，可以不需要开启代理服务器，将以下代码放到主题的 <em>functions.php</em> 里：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-pseudo-original-artificial-intelligence-chatgpt-api', function() {
	return 'https://openkey.cloud';
} );</code></pre>
<h2>更换模型</h2>
<p>如果想使用其他模型，将以下代码放到主题的 <em>functions.php</em> 里：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-pseudo-original-artificial-intelligence-chatgpt-args', function($args) {
	$args['model'] = 'gpt-3.5-turbo'; // 修改模型
	return $args;
} );</code></pre>