<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collect-item/post_content/1.png" /></p>
<p>采集正文的内容。</p>
<h2>额外的表单</h2>
<dl>
	<dt>分页</dt>
	<dd>正文的内容可能有分页，这里需要采集分页的链接。</dd>
</dl>
<h2>额外设置</h2>
<dl>
	<dt>智能分页</dt>
	<dd>某些页面包含的分页链接不全或者有其他杂质，开启智能分页也许可以解决。</dd>
	<dt>页眉模板</dt>
	<dd>如果你想给文章内容加上统一的页眉，可以在 <a href="<?php print admin_url('edit.php?post_type=collection-template'); ?>" target="_blank">模板 </a>中建立页眉模板并在这里调用。</dd>
	<dt>页脚模板</dt>
	<dd>如果你想给文章内容加上统一的页脚，可以在 <a href="<?php print admin_url('edit.php?post_type=collection-template'); ?>" target="_blank">模板 </a>中建立页脚模板并在这里调用。</dd>
	<dt>分页</dt>
	<dd>如果采集的内容有分页，则自动添加 <em><!--nextpage--></em> 进行分页。</dd>
	<dt>更多</dt>
	<dd>自动添加 <em><!--more--></em> 到文章内容第1段末尾。</dd>
</dl>
<h2>过滤器</h2>
<p>你可以对采集到的内容进行各种过滤</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--filters'); ?>" target="_blank" class="button button-primary button-large qc-icon link">过滤器手册</a></p>
<h2>注意事项</h2>
<p>默认会删除内容中的HTML注释，可以用将以下接口放置到主题的 <em>functions.php</em> 中关闭：</p>
<pre class="prism"><code class="language-php">add_filter('qqworld-collector-wipe-tag-comment-from-post-content', '__return_false');</code></pre>
<p>默认会删除内容中的内联JS脚本，可以用将以下接口放置到主题的 <em>functions.php</em> 中关闭：</p>
<pre class="prism"><code class="language-php">add_filter('qqworld-collector-wipe-script-from-post-content', '__return_false');</code></pre>
<p>默认会删除内容中的空标签，可以用将以下接口放置到主题的 <em>functions.php</em> 中关闭：</p>
<pre class="prism"><code class="language-php">add_filter('qqworld-collector-wipe-empty-tags-from-post-content', '__return_false');</code></pre>
<p>默认会删除内容中的链接，可以用将以下接口放置到主题的 <em>functions.php</em> 中关闭：</p>
<pre class="prism"><code class="language-php">add_filter('qqworld-collector-wipe-links-from-post-content', '__return_false');</code></pre>