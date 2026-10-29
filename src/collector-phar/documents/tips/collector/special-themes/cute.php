<h2>自定义字段</h2>
<dl>
	<dt>启用下载</dt>
	<dd><p>字段名：<em>tt_embed_down_info</em>，用字符串设置为<br /><code>0$$1|||1$$演示地址|||2$$当前版本|||3$$文件格式|||4$$文件大小|||5$$安装要求</code><br />其中5个中文词换成采集到的变量即可，如果个别不需要，直接留空，比如<br /><code>0$$1|||1$$|||2$$当前版本|||3$$文件格式|||4$$文件大小|||5$$</code><br />如果5个都不需要，可以直接写 <em>0$$1</em> 即可。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/1.png" /></a></p><p class="qc-icon info">不要忘记勾选 <em>保存到数组</em>。</p></dd>
	<dt>文章来源</dt>
	<dd><p>字段名：<em>tt_post_copyright</em>，用字符串设置为<br /><code>source_title$${var:post_title}|||source_link$${var:post_link}</code><br />注意，如果你在采集的时候就对标题进行了伪原创，就需要重新采集一个没有伪原创的标题变量替换到 <em>{var:post_title}</em>。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/2.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/2.png" /></a></p><p class="qc-icon info">不要忘记勾选 <em>保存到数组</em>。</p></dd>
	<dt>SEO</dt>
	<dd><p>字段名：<em>tt_post_seo</em>，用字符串设置为<br /><code>post_title$$SEO标题|||post_keywords$$SEO关键词|||post_description$$SEO描述</code><br />其中3个中文词换成采集到的变量即可。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/3.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/3.png" /></a></p><p class="qc-icon info">不要忘记勾选 <em>保存到数组</em>。</p></dd>
	<dt>币种</dt>
	<dd>
		<p>字段名：<em>tt_sale_content_currency</em>，用字符串设置为 <em>0</em>即可。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/4.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/4.png" /></a></p>
		<h5>可选币种权限：</h5>
		<ul>
			<li>0：虚拟币</li>
			<li>1：人民币</li>
		</ul>
	</dd>
	<dt>价格</dt>
	<dd><p>字段名：<em>tt_sale_content_price</em>，用字符串设置为价格，比如 <em>20</em>。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/5.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/5.png" /></a></p></dd>
	<dt>文章视频地址</dt>
	<dd><p>字段名：<em>kriesi_preview_pic_input</em>，用字符串设置为采集到的视频地址的变量。</p></dd>
	<dt>免费资源</dt>
	<dd><p>字段名：<em>tt_free_dl</em>，用字符串设置为<br /><code>百度网盘|{var:baidu_url}|{var:baidu_code}|{var:jieya}</code><br />其中3个变量分别是 <em>百度网盘地址</em>、<em>提取码</em> 和 <em>解压密码</em>。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/6.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/6.png" /></a></p></dd>
	<dt>付费资源</dt>
	<dd>
		<p>字段名：<em>tt_sale_dl2</em>，用字符串设置为<br /><code>百度网盘|{var:baidu_url}|{var:baidu_code}|20|credit|{var:jieya}</code><br />其中3个变量分别是 <em>百度网盘地址</em>、<em>提取码</em> 和 <em>解压密码</em>，<em>20</em> 是价格，<em>credit</em> 是购买方式。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/7.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/cute/7.png" /></a></p>
		<h5>可选购买方式：</h5>
		<ul>
			<li>credit：虚拟币</li>
			<li>cash：人民币</li>
			<li>vip1：1级会员</li>
			<li>vip2：2级会员</li>
			<li>vip3：3级会员</li>
		</ul>
	</dd>
</dl>