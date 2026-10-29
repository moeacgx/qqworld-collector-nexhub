<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collect-item/fragment/1.png" /></p>
<p>碎片采集，可以用来采集任何东西，但除非你在文章内容格式化中调用，是不会被保存的。</p>
<h2>额外设置</h2>
<dl>
	<dt>名称</dt>
	<dd>用于文章内容格式化，或帮助自己记住这个采集内容是什么。</dd>
	<dt>变量</dt>
	<dd>
		将该内容作为变量给其他采集项目调用，请使用英文字母、数字和下划线来表示，如 <strong>title_1</strong>，变量的写法是 <strong>{var:title_1}</strong>。<br />有些特殊变量是可以被保存的，如：<br /><br />
		<ul>
			<li><strong>post_parent</strong>：父文章ID</li>
			<li><strong>post_password</strong>：文章密码</li>
			<li><strong>menu_order</strong>：菜单顺序</li>
			<li><strong>comment_count</strong>：评论数</li>
		</ul>
	</dd>
</dl>
<h2>过滤器</h2>
<p>你可以对采集到的内容进行各种过滤</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--filters'); ?>" target="_blank" class="button button-primary button-large qc-icon link">过滤器手册</a></p>