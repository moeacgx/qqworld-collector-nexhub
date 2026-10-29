<h2>修改接口</h2>
<h3>保存前新建草稿</h3>
<p>在火车头的接口中应该先保存草稿，然后再更新文章，方法是在接口文件里搜索 <em>wp_insert_post</em>，通常只有一个，然后将整行代码替换为以下代码。</p>
<pre class="prism"><code class="language-php">// 先保存草稿，模拟WP保存文章
$draft_id = wp_insert_post(array('post_title' => '自动草稿', 'post_status' => 'draft'));
// 将草稿ID加入要保存的内容数组中去
$post_data['ID'] = $draft_id;
// 保存文章并自动抓取图片和设置特色图
$postID = wp_update_post($post_data);</code></pre>
<p>注意，<em>$post_data</em> 和 <em>$postID</em> 必须和你接口里的变量一致。</p>
<h3>如果接口自带抓图功能</h3>
<p>比如以下代码，删掉即可：</p>
<pre class="prism"><code class="language-php">$post_content = fileHandle('fujian',$post_content);
fileHandle('thumb');</code></pre>
<h3>删除设置特色图片代码</h3>
<p>这个功能交给插件来处理，所以要删除接口设置特色图的代码：</p>
<pre class="prism"><code class="language-php">//设定缩略图
set_post_thumbnail( $postID, $thumbid );</code></pre>
<h2>注意事项</h2>
<h3>如果插件无法自动设置特色图片。</h3>
<p>在刚才替换代码的下方加上以下代码：</p>
<pre class="prism"><code class="language-php">foreach ($attachments as $attachment) {
	set_post_thumbnail( $postID, $attachment->ID );
	break;
}</code></pre>