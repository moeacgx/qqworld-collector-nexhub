<h4>删除丢失的图片</h4>
<p>自动删除丢失或无法下载的图像HTML代码。</p>
<h4>更改图片文件名</h4>
<p>有两种模式，其中一种适用于Windows服务器，因为Windows服务器对中文的支持不好，因为Windows的默认编码不是UTF8。<br />另一种功能比较强，适合Linux，可以对文件名结构进行自定义。</p>
<h4>文件名来源及其优先级</h4>
<p>自动更名的获取顺序。</p>
<h4>自定文件名结构</h4>
<p>可以对文件名进行更加复杂的结构订制。</p>
<h4>更改标题和替代文本</h4>
<p>自动依照文章标题或自定义文本添加图片的标题和替代文本。</p>
<h4>保留图片样式</h4>
<p>有些用户希望保留图片的样式属性代码。</p>
<h4>保留链接</h4>
<p>保留远程图片的链接，如果有的话。</p>
<h4>保存外链</h4>
<p>保存外部链接到附件的描述。</p>
<p>如果想自定义该内容，加入类似以下代码到 functions.php 中：</p>
<pre class="prism"><code class="language-php">add_filter('qqworld-collector-save-remove-image-external-link', 'save_external_link', 10, 2);
function save_external_link($content, $link) {
	$content = '<a href="'.$link.'" target="_blank" rel="nofollow">Original Link</a>';
	return $content;
}</code></pre>
<h4>宽度和高度</h4>
<p>自动设置图片的真实高度和宽度。</p>
<h4>图像尺寸</h4>
<p>替换成你想要显示的尺寸的图像，如果选择不使用媒体库，则只会输出完整尺寸。</p>
<h4>链接到</h4>
<p>给图片添加链接。如果你勾选了保留外链，本项将不起作用。</p>
<h4>对齐方式</h4>
<p>很多人喜欢设置为居中对齐。：）</p>
<h4>自动图说</h4>
<p>自动添加图说短代码。很多人都还不知道媒体库中的图片附件是可以输出图片说明的。</p>
<h4>额外的内容</h4>
<p>此内容将显示在每个远程图片的前面或后面。比如输出购买按钮，这个需要一定的编程能力。</p>
<p>额外的内容（之前）</p>
<pre class="prism"><code class="language-php">// 输出源图add_filter( 'qqworld-collector-save-remote-image-additional-content-before', 'additional_content_before', 10, 4 );
function additional_content_before($content, $attachment_id, $post_id, $orginal_url ) {
	$content = '<img src="' . $orginal_url . '">';
	return $content;
}</code></pre>
<p>额外的内容（之后）</p>
<pre class="prism"><code class="language-php">// 输出源图add_filter( 'qqworld-collector-save-remote-image-additional-content-after', 'additional_content_after', 10, 4 );
function additional_content_after($content, $attachment_id, $post_id, $orginal_url ) {
	$content = '<img src="' . $orginal_url . '">';
	return $content;
}</code></pre>