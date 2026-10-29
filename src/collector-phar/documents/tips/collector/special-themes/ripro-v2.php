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
	<dd><p>字段名：<em>cao_status</em>，用字符串方法填 <em>1</em>。</p></dd>
	<dt>下载地址</dt>
	<dd>
		<p>字段名：<em>cao_downurl_new</em>，用字符串设置为</p>
		<p><code>name$$百度网盘|||url$${var:baidu_url}|||pwd$${var:baidu_code}</code></p>
		<p>其中 <em>baidu_url</em> 和 <em>baidu_code</em> 是百度网盘下载地址和提取码的碎片变量名。</p>
		<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro-v2/2.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro-v2/2.png" /></a></p>
		<p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p></dd>
	<dt>下载资源其他信息</dt>
	<dd>
		<p>字段名：<em>cao_info</em>，用字符串设置为</p>
		<p><code>title$$类型|||desc$${var:type}</code></p>
		<p>其中 <em>type</em> 是采集到的文件类型变量名。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro-v2/3.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro-v2/3.png" /></a></p>
		<p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p>
	</dd>
	<dt>已售数量</dt>
	<dd><p>字段名：<em>cao_paynum</em>，用随机数方法设定数值范围。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro/4.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/ripro/4.png" /></a></p></dd>
	<dt>视频</dt>
	<dd>
		<ul>
			<li>启用视频，字段名：<em>cao_video</em>，用字符串设置为1即可；</li>
			<li>免费视频，字段名：<em>cao_is_video_free</em>，用字符串设置为1即可免费播放；</li>
			<li>视频地址，字段名：<em>video_url</em>，采集视频的地址；</li>
		</ul>
	</dd>
</ul>