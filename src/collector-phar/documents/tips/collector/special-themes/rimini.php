<h2>自定义字段</h2>
<p>可更具需要添加，不是所有的字段都需要。</p>
<dl>
	<dt>下载权限</dt>
	<dd>
		<p>字段名：<em>rim_price</em>，用字符串方法填 <em>free</em> 或 <em>vip</em>，前者是 <strong>免费下载</strong>，后者是 <strong>VIP下载</strong>。</p>
		<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/rimini/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/rimini/1.png" /></a></p>
	</dd>
	<dt>下载资源</dt>
	<dd>
		<p>字段名：<em>rim_down_url</em>，用字符串设置为</p>
		<p><code>name$$百度网盘|||url$${var:baidu_url}|||pwd$${var:baidu_code}</code></p>
		<p>其中 <em>baidu_url</em> 和 <em>baidu_code</em> 是百度网盘下载地址和提取码的碎片变量名。</p>
		<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/rimini/2.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/rimini/2.png" /></a></p>
		<p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p></dd>
	<dt>资源信息</dt>
	<dd>
		<p>字段名：<em>rim_other_info</em>，用字符串设置为</p>
		<p><code>content$$软件|PowerPoint
&lt;!--d--&gt;
content$$格式|pptx</code></p>
		<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/rimini/3.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/rimini/3.png" /></a></p>
		<p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p>
	</dd>
</dl>