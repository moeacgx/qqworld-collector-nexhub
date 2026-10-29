<h2>自定义字段</h2>
<dl>
	<dt>开启下载</dt>
	<dd><p>字段名：b2_open_download，用字符串设置为 <em>1</em>。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/b2/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/b2/1.png" /></a></p></dd>
	<dt>允许游客购买（可选）</dt>
	<dd><p>字段名：b2_down_guest_buy，用字符串设置为 <em>1</em>。</p></dd>
	<dt>下载字段</dt>
	<dd>
		<p>字段名：<em>b2_single_post_download_group</em>，用字符串设置为</p>
		<p><code>url$$百度网盘|{var:download_url}|tq={var:baidu_code},jy={var:password}|||rights$$vip0|free</code></p>
		<p>如果没有解压密码可以这么设置：</p>
		<p><code>url$$百度网盘|{var:download_url}|tq={var:baidu_code}|||rights$$vip0|free</code></p>
		<p>其中 <em>download_url</em> 是百度网盘下载地址的碎片变量名，<em>baidu_code</em> 是百度网盘提取码的碎片变量名，<em>password</em> 是文件解压密码，更多参数可以看下面的 <a href="#advanced"><strong>下载字段进阶</strong></a>，自己拼成更复杂的字符串。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/b2/2.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/b2/2.png" /></a></p><p>注意，最后要勾选 <em>保存到数组</em> 和 <em>二维数组</em>，如果你对这个功能不太了解，可以参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank" class="button button-primary qc-icon link">自定义字段</a>。</p>
	</dd>
	<dt>限制等级可见</dt>
	<dd>
		<p>用于隐藏文章里的内容，只允许指定等级的人可见。</p>
		<p>字段名：<em>b2_post_reading_role</em>，以 <em>限制等级可见</em> 为例，用字符串设置为：</p>
		<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/b2/3.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/b2/3.png" /></a></p>
		<p>其他可选：</p>
		<ul>
			<li><strong>money</strong>：支付费用可见</li>
			<li><strong>credit</strong>：支付积分可见</li>
			<li><strong>roles</strong>：限制等级可见</li>
			<li><strong>login</strong>：登录可见</li>
			<li><strong>comment</strong>：评论可见</li>
		</ul>
	</dd>
	<dt id="b2-post-roles">可见的等级</dt>
	<dd>
		<p>配合上面的字段使用，用于隐藏文章里的内容，设置可见的指定等级。</p>
		<p>字段名：<em>b2_post_roles</em>，假如只允许永久VIP和永久SVIP查看，用字符串设置为 <em>0$$vip1|||1$$vip2</em>，然后勾选 <em>保存到数组</em>：</p>
		<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/b2/4.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/b2/4.png" /></a></p>
		<p class="qc-icon info">最后不要忘记加上 <em>字符串转数组</em> 过滤器。</p>
	</dd>
</dl>
<h2 id="advanced">下载字段进阶</h2>
<p>这个下载字段比较复杂，包含多个项目，但通常只需要 <em>url</em> 和 <em>rights</em> 即可。</p>
<table class="wp-list-table widefat striped posts">
	<thead>
		<tr>
			<th>键名</th>
			<th>参考</th>
			<th>说明</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>url</td>
			<td>百度网盘|https://pan.baidu.com/s/1-sUiJrCeb0Oswq2YQz2CDQ|tq=1234,jy=password</td>
			<td>下载地址，包含三部分，用|隔开，第一个是资源平台，第二个是资源地址，第三个分两部分，第一个是提取码，第二个是解压密码。</td>
		</tr>
		<tr>
			<td>thumb</td>
			<td>https://www.xxx.com/wp-content/uploads/2020/08/1594220015-10ce068dcdfdab9-300x176-1.jpg</td>
			<td>资源缩略图地址。</td>
		</tr>
		<tr>
			<td>name</td>
			<td>资源名称</td>
			<td>如果不设置，将获取文章标题当作资源名称</td>
		</tr>
		<tr>
			<td>attr</td>
			<td>大小|50kb<br />尺寸|800x600</td>
			<td>资源属性，格式为属性名|属性值，每组占一行。</td>
		</tr>
		<tr>
			<td>rights</td>
			<td>
				<p>格式为等级|权限，比如：</p>
				<pre class="prism"><code class="language-php">lv1|free
lv2|comment
lv3|login
lv4|money=10
lv4|credit=30</code></pre>
				<p>权限参数：</p>
				<ul>
					<li>评论可见：<strong>comment</strong></li>
					<li>登录可见：<strong>login</strong></li>
					<li>无限制：<strong>free</strong></li>
					<li>付费下载：<strong>money=10</strong></li>
					<li>积分下载：<strong>credit=30</strong></li>
				</ul>
				<p>特殊权限：</p>
				<ul>
					<li>所有人免费：all|free（或者credit=10这种格式）</li>
					<li>普通用户组免费：lv|free（或者credit=10这种格式）</li>
					<li>VIP用户免费：vip|free（或者credit=10这种格式）</li>
				</ul>
			</td>
			<td>下载权限</td>
		</tr>
	</tbody>
</table>
<h2>圈子相关自定义字段</h2>
<dl>
	<dt>图片</dt>
	<dd><p>字段名：<em>b2_circle_image</em>，内容是媒体附件的ID数组，只能通过采集实现，需要加上 <strong>下载到本地</strong> 过滤器，选择返回<strong>媒体库的附件ID</strong>。</p>
	<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/b2/5.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/b2/5.png" /></a></p></dd>
</dl>
<h2>网址导航自定义字段</h2>
<dl>
	<dt>站长ID</dt>
	<dd><p>字段名：<em>b2_link_owner</em>，一般用 <strong>字符串</strong> 方法填管理员的ID就行，默认是1。</p>
	<dt>网址</dt>
	<dd><p>字段名：<em>b2_link_to</em>，用 <strong>字符串</strong> 方法调用采集到的链接碎片，例如 <strong>{var:link}</strong>。</p>
	<dt>网址图标</dt>
	<dd><p>字段名：<em>b2_link_icon</em>，用 <strong>字符串</strong> 方法调用采集到的图标碎片，例如 <strong>{var:icon}</strong>，别忘记加上下载到本地过滤器，返回URL。</p>
</dl>
<h2>隐藏内容阅读权限</h2>
<dl>
	<dt>阅读权限</dt>
	<dd>
		<p>字段名：<em>b2_post_reading_role</em>，以 <em>支付费用可见</em> 为例，用字符串设置为 <strong>money</strong>：</p>
		<p>其他权限：</p>
		<ul>
			<li>支付费用可见：<strong>money</strong></li>
			<li>支付积分可见：<strong>credit</strong></li>
			<li>限制等级可见：<strong>roles</strong></li>
			<li>登录可见：<strong>login</strong></li>
			<li>评论可见：<strong>comment</strong></li>
		</ul>
	</dd>
	<dt>是否允许游客购买</dt>
	<dd><p>字段名：<em>b2_hidden_guest_buy</em>，用 <strong>字符串</strong> 设置为 <em>1</em> 是允许，<em>0</em> 是禁止。</p>
	<dt>需要支付的金额</dt>
	<dd><p>字段名：<em>b2_post_money</em>，用 <strong>字符串</strong> 设置价格。</p>
	<dt>需要支付的积分</dt>
	<dd><p>字段名：<em>b2_post_credit</em>，用 <strong>字符串</strong> 设置积分。</p>
	<dt>允许查看的用户组</dt>
	<dd><p>字段名：<em>b2_post_roles</em>，参考上面的 <a href="#b2-post-roles">可见的等级</a>。</p>
	<dt>默认查看人数</dt>
	<dd><p>字段名：<em>b2_post_hidden_count</em>，用 <strong>字符串</strong> 设置人数。</p>
	<dt>时效设置</dt>
	<dd><p>字段名：<em>b2_post_hidden_times</em>，用 <strong>字符串</strong> 设置小时数。</p>
</dl>
<h2>其他自定义字段</h2>
<dl>
	<dt>文章来源网址</dt>
	<dd><p>字段名：<em>b2_post_from_url</em>，用字符串填 {var:post_link} 即可。</dd>
	<dt>文章来源站点名称</dt>
	<dd><p>字段名：<em>b2_post_from_name</em>，用字符串写死或采集皆可。</dd>
</dl>
<h2>用户自定义字段</h2>
<dl>
	<dt>用户头像</dt>
	<dd><p>字段名：<em>zrz_open</em>，用字符串填 <em>avatar_set$$default|||avatar$${var:avatar}</em>，然后勾选 <strong>保存倒数组</strong>，这里的 <em>{var:avatar}</em> 是采集到的头像图片地址的碎片变量，该碎片需要用 <strong>下载到本地</strong> 过滤器 <strong>返回媒体库附件的ID</strong>。</dd>
</dl>
