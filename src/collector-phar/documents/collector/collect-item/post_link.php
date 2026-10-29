<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collect-item/post_link/1.png" /></p>
<p>采集文章的链接，会提交给 <strong>采集内容（从正文页）</strong> 进行继续采集。</p>
<p>其结果会和数据库中的文章进行比对，如果有重复的记录则会被自动忽略。</p>
<h2>额外设置</h2>
<dl>
	<dt>保存到</dt>
	<dd>系统默认会将来源地址保存到 source-link 自定义字段中，填写这里可以保存到其他自定义字段。</dd>
</dl>
<h2>过滤器</h2>
<p>你可以对采集到的内容进行各种过滤</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--filters'); ?>" target="_blank" class="button button-primary button-large qc-icon link">过滤器手册</a></p>