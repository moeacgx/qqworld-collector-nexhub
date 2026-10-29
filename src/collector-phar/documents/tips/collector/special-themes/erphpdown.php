<p>Modown和总裁（ceomax）主题是基于Erphpdown wordpress下载插件开发的一款全新的针对收费付费下载资源/付费查看内容/VIP会员免费下载查看/虚拟资源售卖的WordPress主题，为erphpdown而生的wp主题。</p>
<h2>自定义字段</h2>
<dl>
	<dt>收费价格</dt>
	<dd><p>字段名：<em>down_price</em>，需要的话可以采集。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/modown/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/modown/1.png" /></a></p></dd>
	<dt>收费模式</dt>
	<dd>
		<p>字段名：<em>start_down</em>，用字符串设置为 <em>yes</em>，如果没有这个，下面的 <em>erphp_down</em> 无法正常保存，</p>
		<p>字段名：<em>erphp_down</em>，用字符串设置为 <em>1</em> 就是启用，</p>
		<h3>其他数值</h3>
		<ul>
			<li>4：不启用</li>
			<li>1：启用</li>
			<li>5：免登录</li>
			<li>2：查看</li>
			<li>3：部分查看</li>
		</ul>
	</dd>
	<dt>VIP优惠</dt>
	<dd>
		<p>字段名：<em>member_down</em>，用字符串设置为 <em>3</em> 就是VIP免费，</p>
		<h3>其他数值</h3>
		<ul>
			<li>1：无</li>
			<li>4：专享</li>
			<li>8：年费专享</li>
			<li>9：终身专享</li>
			<li>3：免费</li>
			<li>6：年废免费</li>
			<li>7：终身免费</li>
			<li>1：5折</li>
			<li>5：8折</li>
			<li>10：专享购买</li>
			<li>11：专享购买年废5折</li>
			<li>12：专享购买年废8折</li>
		</ul>
	</dd>
	<dt>价格类型</dt>
	<dd>
		<p>字段名：<em>down_price_type</em>，用字符串设置为 <em>0</em> 就是单价格，</p>
		<h3>其他数值</h3>
		<ul>
			<li>0：单价格</li>
			<li>1：多价格</li>
		</ul>
	</dd>
	<dt>下载字段</dt>
	<dd>
		<p>字段名：<em>down_url</em>，用字符串设置为</p>
		<code>下载: {var:baidu_url} 提取码：{var:baidu_code}</code></p>
		<p>其中 <em>baidu_url</em> 和 <em>baidu_code</em> 是百度网盘下载地址和提取码的碎片变量名。</p>
		<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/modown/2.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/modown/2.png" /></a></p>
	</dd>
	<dt>免费下载地址（非必须）</dt>
	<dd><p>字段名：<em>down_url_free</em>，与上面的收费下载地址可同时存在，用户不用登录就能免费下载的地址，不记录下载次数，格式与上面一致。</p></dd>
	<dt>隐藏内容（非必须）</dt>
	<dd><p>字段名：<em>hidden_content</em>，收费下载模式的隐藏内容，一般填提取码或者解压密码。格式化的格式为提取码：xxxx，解压密码：oooo或提取码：oooo，注意是中文冒号与逗号。</p></dd>
	<dt>过期天数（非必须）</dt>
	<dd><p>字段名：<em>down_days</em>，用字符串设置数字。</p></dd>
</dl>
<h2>嵌入视频</h2>
<p>字段名：<em>my_post_video_options</em>，用字符串设置为</p>
<p><code>video_type$$1|||video_url$${var:video_url}</code></p>
<dl>
	<dt>嵌入iframe视频</dt>
	<dd>video_type，数值1，指爱奇艺、腾讯视频等视频分享地址，仅需填写分享代码里src的值，不是填整串代码</dd>
	<dt>视频收费</dt>
	<dd>video_erphpdown，数值1，基于商城属性里设置的收费信息</dd>
	<dt>视频地址</dt>
	<dd>video_url，字符串 {var:video_url} 是视频的地址变量</dd>
</dl>
<h2>资源属性</h2>
<p>这个需要在 <strong>phpMyAdmin</strong> 中查看，在 <strong>wp_postmeta</strong> 表中搜索一个已经编辑好的资源ID的所有字段，然后找到和资源属性有关的字段名和值：</p>
<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/modown/3.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/modown/3.png" /></a></p>
<p>找到6个相关自定义字段：</p>
<dl>
	<dt>字段名：update_date</dt>
	<dd>值：可以用字符串写死也可以采集。</dd>
	<dt>字段名：_update_date</dt>
	<dd>值：必须配合上面的字符使用，用字符串写 field_5f7a8f8567a2c，这是主题设置的，注意不同的资源可能不一样。</dd>
	<dt>字段名：update_size</dt>
	<dd>值：文件大小，应该只能采集。</dd>
	<dt>字段名：_update_size</dt>
	<dd>值：必须配合上面的字符使用，用字符串写 field_5f7a8fad17c45，这是主题设置的，注意不同的资源可能不一样。</dd>
	<dt>字段名：update_demo</dt>
	<dd>值：可以用字符串写死也可以采集。</dd>
	<dt>字段名：_update_demo</dt>
	<dd>值：必须配合上面的字符使用，用字符串写 field_5f7a8fc4fe3e1，这是主题设置的，注意不同的资源可能不一样。</dd>
</dl>