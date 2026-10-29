<p>可以使用接口将采集到的内容投送到其他的CMS，如DEDE、Discuz等。</p>
<p>将以下代码放到主题的 <strong>functions.php</strong> 中：</p>
<pre class="prism"><code class="language-php">add_action('qqworld-collector-action-after-collected', 'post_to_another_cms' );
function post_to_another_cms($post) {
	// $post 是采集到的的数据
	// 这里写投送到其他CMS的代码
}</code></pre>