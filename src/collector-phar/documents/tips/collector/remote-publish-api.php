<p>如果想在远程发布时，本地保留草稿，而发布站设置状态为已发布。</p>
<h2>采集设置</h2>
<p>首先，收藏项目的 <strong>采集设置</strong> 里将 <strong>发布状态</strong> 设置为 <strong>草稿</strong>。</p>
<h2>使用接口</h2>
<p>仅用于采集，将以下代码放置到主题的 <em>functions.php</em> 里：</p>
<pre class="prism"><code class="language-php">add_filter('qqworld-collector-xmlrpc-post', 'xmlrpc_post_processing', 9, 2);
function xmlrpc_post_processing($post, $config) {
	$post['post_status'] = 'publish'; // 将远程发布的状态改成已发布
	return $post;
}</code></pre>
<p>仅用于远程发布到WordPress，将以下代码放置到主题的 <em>functions.php</em> 里：</p>
<pre class="prism"><code class="language-php">add_filter('qqworld-collector-xmlrpc-data', 'xmlrpc_post_data');
function xmlrpc_post_data($data) {
	$data['post_status'] = 'publish'; // 将远程发布的状态改成已发布
	return $data;
}</code></pre>