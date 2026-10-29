<h2>自定义字段</h2>
<dl>
	<dt>价格</dt>
	<dd><p>字段名：<em>_riplus_price</em>，需要的话可以采集。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus/1.png" /></a></p></dd>
	<dt style="display: none;">权限</dt>
	<dd style="display: none;"><p>字段名：<em>_edit_last</em>，用字符串设置为 <em>1</em> 就是VIP免费，其他数值可以参考编辑页的设置。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus/2.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus/2.png" /></a></p></dd>
	<dt>VIP免费</dt>
	<dd><p>字段名：<em>_riplus_free_authority</em>，用字符串设置为 <em>month_free</em>，必须添加这个，否则VIP免费设置无效。</p></dd>
	<dt>下载字段</dt>
	<dd>
		<p>字段名：<em>_riplus_down_info</em>，用字符串设置为</p>
		<p><code>name$$百度网盘|||url$${var:download_url}|||pwd$$</code></p>
		<p>其中 <em>download_url</em> 是百度网盘下载地址的碎片变量名。</p>
		<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus/3.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus/3.png" /></a></p>
		<p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p>
	</dd>
	<dt>资源其他信息</dt>
	<dd>
		<p>字段名：<em>_riplus_other_info</em>，用字符串设置为</p>
		<p><code>title$$解压密码：|||desc$${var:jieya}</code></p>
		<p>其中 <em>download_url</em> 是解压密码的碎片变量名。</p>
		<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus/4.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus/4.png" /></a></p>
		<p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p>
	</dd>
</dl>