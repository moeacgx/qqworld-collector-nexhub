<h3>自定义关键词</h3>
<p>如果你想从自定义字段中获取自定义关键词，将下面的代码放到主题的 <em>functions.php</em> 里去：</p>
<pre class="prism"><code class="language-php">/**
 * $keywords		array		插件获取的标签关键词
 * $post_id			id			当前文章的ID
**/
add_filter( 'qqworld-collector-pseudo-original-random-strings', function($random_strings, $post_id) {
	// 从 keywords 自定义字段中获取关键词，必须是数组类型
	$new_random_strings = get_post_meta($post_id, 'random_strings', true);
	// 如果不为空，则将新的关键词替换自定义字符串
	if ($new_random_strings) $random_strings = $new_random_strings;
	return $random_strings;
}, 10, 2);</code></pre>
<h3>随机推荐关键词</h3>
<p>如果你不想从标签中获取关键词，可以用以下接口从自定义字段中获取，将下面的代码放到主题的 <em>functions.php</em> 里去：</p>
<pre class="prism"><code class="language-php">/**
 * $keywords		array		插件获取的标签关键词
 * $post_id			id			当前文章的ID
**/
add_filter( 'qqworld-collector-pseudo-original-suggestion-keywords', function($keywords, $post_id) {
	// 从 keywords 自定义字段中获取关键词，必须是数组类型
	$new_keywords = get_post_meta($post_id, 'keywords', true);
	// 如果不为空，则将新的关键词替换标签关键词
	if ($new_keywords) $keywords = $new_keywords;
	return $keywords;
}, 10, 2);</code></pre>