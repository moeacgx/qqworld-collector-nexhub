<p>以下方法将强制开启评论。</p>
<h2>仅适用于采集</h2>
<p>将以下代码放到主题的 functions.php 中：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-collection-project-format-post-content', function($post) {
	$post['comment_status'] = 'open';
	return $post;
});</code></pre>
<h2>仅适用任何情况</h2>
<p>将以下代码放到主题的 functions.php 中：</p>
<pre class="prism"><code class="language-php">add_filter( 'wp_insert_post_data', function($post) {
	$post['comment_status'] = 'open';
	return $post;
});</code></pre>