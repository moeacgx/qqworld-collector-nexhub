<h2>变量</h2>
<h3>自定义字段 {var:post_meta:meta_key}</h3>
<p>例如：<strong>{var:post_meta:source-link}</strong> 是调用当前文章的 <strong>source-link</strong> 自定义字段的内容。</p>
<P>支持数组，比如 <em>{var:post_meta:test[0]['desc']}</em>。</P>
<h3>钩子 {h:hook_name}</h3>
<p>有些具有二次开发能力的用户希望在变量中加入接口，写法是 <em>{h:hook_name}</em>，例如，想用一个 welcome 的钩子名，写法是：<em>{h:welcome}</em>，然后在主题的 functions.php 中加入以下代码即可调用接口：</p>
<pre class="prism"><code class="language-php">/**
 * $content			string		要加入的内容，默认为空
 * $post_content	string		已经插入随即段落的内容
 * $post_ID			string		当前文章的ID
 * $post			object		当前文章的对象
**/
add_filter('hook_name', function($content, $post_content, $post_ID, $post) {
	$content = '要加入的内容';
	return $content;
}, 10, 4);</code></pre>
<h2>分类</h2>
<h3>自定义分类</h3>
<p>用于在 <strong>收藏项目</strong> 的 <strong>伪原创</strong> 过滤器中调用，1是编号，也可以用英文字母。</p>
<pre class="prism"><code class="language-php">&lt;cat:1&gt;
... 这里写随机段落，多个段落用 &lt;!--s--&gt; 隔开 ...
&lt;/cat:1&gt;</code></pre>
<h3>分类法</h3>
<p>用于针对文章分类使用的变量，category是分类法名称，即分类目录，1是分类ID。</p>
<pre class="prism"><code class="language-php">&lt;tax:category:1&gt;
... 这里写随机段落，多个段落用 &lt;!--s--&gt; 隔开 ...
&lt;/tax:category:1&gt;</code></pre>
<p>多个分类可以用英文逗号(,)隔开，如：</p>
<pre class="prism"><code class="language-php">&lt;tax:category:15,16,17&gt;
... 这里写随机段落，多个段落用 &lt;!--s--&gt; 隔开 ...
&lt;/tax:category:15,16,17&gt;</code></pre>