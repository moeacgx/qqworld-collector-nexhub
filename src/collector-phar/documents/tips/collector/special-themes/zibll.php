<h2>自定义字段</h2>
<h3>文章</h3>
<dl>
	<dt>付费模式</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_type]</em>，用字符串设置为 <em>2</em> 就是付费下载。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/zibll/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/zibll/1.png" /></a></p>
		<h5>可选模式：</h5>
		<ul>
			<li>1：付费阅读</li>
			<li>2：付费下载</li>
			<li>5：付费图片</li>
			<li>6：付费视频</li>
		</ul>
	</dd>
	<dt>下载地址（用于付费下载）</dt>
	<dd>
		<p>字段名：<em>posts_zibpay[pay_download]</em>，用字符串设置为<br /><code>link$${var:baidu_url}|||more$$提取码：{var:baidu_code}|||name$$百度网盘</code><br />其中 <strong>baidu_url</strong> 是百度网盘地址变量，<strong>baidu_code</strong> 是提取码变量。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/zibll/2.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/zibll/2.png" /></a></p><p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p>
	</dd>
	<dt>属性（用于付费下载）</dt>
	<dd>
		<p>字段名：<em>posts_zibpay[attributes]</em>，用字符串设置为<br /><code>key$$文件大小|||value$${var:size}</code><br />其中 <strong>size</strong> 是文件大小变量，多个属性分多行写。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/zibll/3.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/zibll/3.png" /></a></p><p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p>
	</dd>
	<dt>演示地址（用于付费下载）（可选）</dt>
	<dd>
		<p>字段名：<em>posts_zibpay[demo_link]</em>，用字符串设置为<br /><code>url$${var:demo_url}|||text$${var:demo_text}|||target$$_blank</code><br />其中 <strong>demo_url</strong> 是演示地址变量名，<strong>demo_text</strong> 是演示标题，勾选 <em>保存到数组</em> 即可。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/zibll/4.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/zibll/4.png" /></a></p>
	</dd>
	<dt>付费视频（用于付费视频）</dt>
	<dd><p>字段名：<em>posts_zibpay[video_url]</em>，采集 <em>视频地址</em> 即可。</p></dd>
	<dt>视频封面地址（用于付费视频）</dt>
	<dd><p>字段名：<em>posts_zibpay[video_pic]</em>，采集 <em>视频封面地址</em> 即可。</p></dd>
	<dt>本集标题(如需添加剧集则需填写此处)（用于付费视频）</dt>
	<dd><p>字段名：<em>posts_zibpay[video_title]</em>，采集 <em>视频标题</em> 即可。</p></dd>
	<dt>购买权限</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_limit]</em>，用字符串设置为 <em>0</em> 即可。</p>
		<h5>可选权限：</h5>
		<ul>
			<li>0：所有人可购买</li>
			<li>1：黄金会员及以上会员可购买</li>
			<li>2：仅砖石会员可购买</li>
		</ul>
	</dd>
	<dt>支付类型</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_modo]</em></p>
		<h5>可选类型：</h5>
		<ul>
			<li>0：普通商品（金钱购买）</li>
			<li>points：积分商品（积分购买）</li>
		</ul>
	</dd>
	<dt>积分售价（如果选择积分支付类型，必须设置，否则就是免费资源）</dt>
	<dd><p>字段名：<em>posts_zibpay[points_price]</em>，用字符串设置价格数字即可，，必须设置。</p></dd>
	<dt>黄金会员积分售价（可选）</dt>
	<dd><p>字段名：<em>posts_zibpay[vip_1_points]</em>，用字符串设置价格数字即可。</p></dd>
	<dt>钻石会员积分售价（可选）</dt>
	<dd><p>字段名：<em>posts_zibpay[vip_2_points]</em>，用字符串设置价格数字即可。</p></dd>
	<dt>执行价（如果选择金钱支付类型，必须设置，否则就是免费资源）</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_price]</em>，用字符串设置价格数字即可，如果设置下面的 <strong>原价</strong>，这个就是 <strong>促销价</strong>。</p></dd>
	<dt>原价</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_original_price]</em>，用字符串设置价格数字即可。</p></dd>
	<dt>额外隐藏内容</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_extra_hide]</em>，用字符串设置即可，。</p></dd>
	<dt>促销标签（可选）</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_original_price]</em>，用字符串设置 <em>&lt;i class="fa fa-fw fa-bolt"&gt;&lt;/i&gt; 限时特惠</em> 即可。</p></dd>
	<dt>黄金会员价格（可选）</dt>
	<dd><p>字段名：<em>posts_zibpay[vip_1_price]</em>，用字符串设置价格数字即可。</p></dd>
	<dt>钻石会员价格（可选）</dt>
	<dd><p>字段名：<em>posts_zibpay[vip_2_price]</em>，用字符串设置价格数字即可。</p></dd>
	<dt>推广折扣（可选）</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_rebate_discount]</em>，用字符串设置价格数字即可。</p></dd>
	<dt>销量浮动（可选）</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_cuont]</em>，用字符串设置销量数字即可。</p></dd>
	<dt>商品标题（可选）如需要单独显示商品标题请填写此项</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_title]</em>，用字符串采集商品标题即可。</p></dd>
	<dt>商品简介（可选）如需要单独显示商品介绍请填写此项</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_doc]</em>，用字符串采集商品标题即可。</p></dd>
	<dt>更多详情（可选）显示在商品卡片下方的内容（支持HTML代码，请注意代码规范）</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_details]</em>，用字符串采集商品标题即可。</p></dd>
	<dt>额外隐藏内容（可选）付费后显示的额外隐藏内容（支持HTML代码，请注意代码规范）</dt>
	<dd><p>字段名：<em>posts_zibpay[pay_extra_hide]</em>，用字符串采集商品标题或：<strong>激活码：{var:game_code}</strong>。</p></dd>
</dl>
<h3>论坛帖子</h3>
<dt>设置板块</dt>
<dd>
	<p>字段名：<em>plate_id</em>，用字符串设置为板块的ID即可。</p>
</dd>