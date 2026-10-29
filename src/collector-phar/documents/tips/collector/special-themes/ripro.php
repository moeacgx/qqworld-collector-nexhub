<h2>自定义字段</h2>
<p>可更具需要添加，不是所有的字段都需要。</p>
<dl>
	<dt>价格</dt>
	<dd><p>字段名：<em>cao_price</em>，用字符串方法填写纯数字或直接采集。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro/1.png" /></a></p></dd>
	<dt>会员免费</dt>
	<dd><p>字段名：<em>cao_is_boosvip</em>，用字符串方法填 <em>1</em>。</p></dd>
	<dt>VIP折扣</dt>
	<dd><p>字段名：<em>cao_vip_rate</em>，用字符串方法填 <em>0</em> 就是无折扣。</p></dd>
	<dt>仅会员购买（可选）</dt>
	<dd><p>字段名：<em>cao_close_novip_pay</em>，用字符串方法填 <em>1</em>。</p></dd>
	<dt>启用付费下载模块</dt>
	<dd><p>字段名：<em>cao_status</em>，用字符串方法填 <em>csf--on</em> 或 <em>1</em>，两个都有可能，如果采集后付费下载没开启就换另一个。</p></dd>
	<dt>下载地址</dt>
	<dd><p>字段名：<em>cao_downurl</em>。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro/2.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro/2.png" /></a></p></dd>
	<dt>文件解压密码</dt>
	<dd><p>字段名：<em>cao_pwd</em>。</p></dd>
	<dt>下载文件信息</dt>
	<dd>
		<p>字段名：<em>cao_info</em>，用字符串设置为</p>
		<p><code>title$$提取码|||desc$${var:baidu_code}</code></p>
		<p>以提取码（百度盘）举例，其中 <em>baidu_code</em> 是百度网盘提取码变量名。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro/3.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro/3.png" /></a></p>
		<p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p>
	</dd>
	<dt>已售数量</dt>
	<dd><p>字段名：<em>cao_paynum</em>，用随机数方法设定数值范围。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro/4.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro/4.png" /></a></p></dd>
	<dt>演示地址</dt>
	<dd><p>字段名：<em>cao_demourl</em>，通常用字符串填视频碎片的变量，如 <em>{var:video}</em>。</p></dd>
	
</dl>