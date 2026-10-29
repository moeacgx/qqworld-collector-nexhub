<h2>自定义字段</h2>
<dl>
	<dt>价格</dt>
	<dd><p>字段名：<em>wppay_price</em>，需要的话可以采集。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus2/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus2/1.png" /></a></p></dd>
	<dt>资源类型</dt>
	<dd>
		<p>字段名：<em>wppay_type</em>，用字符串设置为 <em>3</em> 就是付费下载资源。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus2/2.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus2/2.png" /></a></p>
		<h5>数值参考</h5>
		<ul>
			<li>0：不启用</li>
			<li>3：付费下载资源</li>
			<li>4：免费下载资源</li>
			<li>2：付费隐藏内容</li>
			<li>1：付费查看全文</li>
			<li>5：付费观看视频</li>
			<li>6：付费图片相册</li>
		</ul>
	</dd>
	<dt>VIP会员权限</dt>
	<dd>
		<p>字段名：<em>wppay_vip_auth</em>，用字符串设置为 <em>3</em> 就是终身VIP会员免费。</p>
		<h5>数值参考</h5>
		<ul>
			<li>0：不启用</li>
			<li>1：包月VIP免费</li>
			<li>2：包年VIP免费</li>
			<li>3：终身VIP免费</li>
		</ul>
	</dd>
	<dt>下载字段</dt>
	<dd>
		<p>字段名：<em>wppay_down</em>，用字符串设置为</p>
		<p><code>name$$百度网盘|||url$${var:download_url}|||pwd$$</code></p>
		</p>其中 <em>download_url</em> 是百度网盘下载地址的碎片变量名。</p>
		<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus2/3.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus2/3.png" /></a></p>
		<p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p>
	</dd>
	<dt>资源其他信息</dt>
	<dd>
		<p>字段名：<em>wppay_info</em>，用字符串设置为</p>
		<p><code>title$$解压密码：|||desc$${var:jieya}</code></p
		><p>其中 <em>download_url</em> 是解压密码的碎片变量名。</p>
		<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus2/4.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/riplus2/4.png" /></a></p>
		<p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p>
	</dd>
</dl>