<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collect-item/user_meta/1.png" /></p>
<p>采集内容保存到自定义用户栏目，可以用来保存个人说明，甚至是WooCommerce的账单地址。</p>
<h2>额外设置</h2>
<dl>
	<dt>保存到</dt>
	<dd>输入自定义字段的名称，也就是所谓的 <em>Meta Key</em>。比如 <em>description</em> 或者 <em>user_data[name]</em> (用于数组，仅支持1层)。</dd>
	<dt>名称</dt>
	<dd>用于文章内容格式化，或帮助自己记住这个采集内容是什么。</dd>
	<dt>保存到数组</dt>
	<dd>默认是会将采集到的多个项目整合成字符串，如果需要保存数组，开启此项即可。<br />可以直接采集多个数据生成简单的数组，也可以用碎片变量组合并指定键名生成复杂的数组，例如：<br /><em>key$$value|||key$$value|||key$$value</em></dd>
	<dt>二维数组</dt>
	<dd>将数组转换为二维数组，多个键值使用字符串 <!--d--> 隔开，例如：<br /><em>key$$value|||key$$value|||key$$value<br />&lt;!--d--&gt;<br />key$$value|||key$$value|||key$$value</em></dd>
</dl>
<h3>常用自定义用户栏目名</h3>
<dl>
	<dt>个人说明</dt>
	<dd>description</dd>
	<dt>名字</dt>
	<dd>first_name</dd>
	<dt>姓氏</dt>
	<dd>last_name</dd>
</dl>
<h3>其他自定义用户栏目名</h3>
<dl>
	<dt>QQWorld通行证头像地址</dt>
	<dd>QQWorld Passport Avatar</dd>
	<dt>QQWorld运营官头像地址</dt>
	<dd>avatar</dd>
</dl>
<h3>WooCommerce自定义用户栏目名</h3>
<dl>
	<dt>账单名字</dt>
	<dd>billing_first_name</dd>
	<dt>账单姓氏</dt>
	<dd>billing_last_name</dd>
	<dt>账单公司名</dt>
	<dd>billing_company</dd>
	<dt>账单邮箱地址</dt>
	<dd>billing_email</dd>
	<dt>账单电话号码</dt>
	<dd>billing_phone</dd>
	<dt>账单国家</dt>
	<dd>billing_country</dd>
	<dt>账单地址1</dt>
	<dd>billing_address_1</dd>
	<dt>账单地址2</dt>
	<dd>billing_address_2</dd>
	<dt>账单城市名</dt>
	<dd>billing_city</dd>
	<dt>账单省名</dt>
	<dd>billing_state</dd>
	<dt>账单邮编</dt>
	<dd>billing_postcode</dd>
</dl>
<h2>过滤器</h2>
<p>你可以对采集到的内容进行各种过滤</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--filters'); ?>" target="_blank" class="button button-primary button-large qc-icon link">过滤器手册</a></p>