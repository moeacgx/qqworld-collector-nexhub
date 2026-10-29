<p>在收藏项目中的很多地方可以使用变量。</p>
<h1>变量种类</h1>
<h2>系统变量 {$:*}</h2>
<dl>
	<dt>时间戳变量 </dt>
	<dd><ul>
		<li><strong>{$:time}</strong>：格林威治当前UNIX时间戳（0时区）</li>
		<li><strong>{$:current_time}</strong>：本地当前UNIX时间戳</li>
		<li><strong>{$:today}</strong>：当天的日期，格式为 <?php print date('Y-m-d', current_time('timestamp')); ?></li>
	</ul></dd>
</dl>
<h2>采集变量 {var:*}</h2>
<dl>
	<dt>碎片变量 </dt>
	<dd>将碎片的内容作为变量给其他采集项目调用，请使用英文字母、数字和下划线来设置，如 <strong>title_1</strong>，变量的调用方法是 <strong>{var:title_1}</strong>。</dd>
	<dt>自定义字段和用户自定义字段变量</dt>
	<dd>将自定义字段或用户自定义字段的内容作为变量给其他采集项目调用，变量名即要保存的栏目名，请使用英文字母、数字和下划线来设置，如 <strong>title_1</strong>，变量的调用方法是 <strong>{var:title_1}</strong>。</dd>
	<dt>常规变量 </dt>
	<dd>
		<p>除了碎片、自定义字段和用户自定义字段可以设置变量名外，还有一些常规变量可以使用:</p>
		<p><strong>以下变量仅用于采集内容（从列表页）</strong></p>
		<ul>
			<li><strong>{var:original_source_link}</strong>：从来源地址处输入的来源链接</li>
			<li><strong>{var:source_link}</strong>：经过采集内容（从列表页）的高级请求处理过的来源链接，如果没有使用高级请求，则等同于上一个变量</li>
			<li><strong>{var:source_url_args}</strong>：经过采集内容（从列表页）的高级请求处理过的来源链接，如果是POST，就会生成来源地址的URL参数。</li>
			<li><strong>{var:source_html}</strong>：列表页或正文页的经过过滤器预处理的HTML代码，主要用于采集列表和评论时获取列表整体代码以外的内容。</li>
		</ul>
		<p><strong>以下变量在采集内容（从列表页）和采集内容（从正文页）都可使用</strong></p>
		<ul>
			<li><strong>{var:post_id}</strong>：文章ID（仅支持<strong>自定义数据表字段</strong>）</li>
			<li><strong>{var:post_link}</strong>：文章链接</li>
			<li><strong>{var:post_title}</strong>：文章标题</li>
			<li><strong>{var:post_excerpt}</strong>：文章摘要</li>
			<li><strong>{var:featured_image}</strong>：特色图</li>
			<li><strong>{var:post_author}</strong>：作者</li>
			<li><strong>{var:post_date}</strong>：发布日期</li>
			<li><strong>{var:post_name}</strong>：文章名（slug）</li>
			<li>
				<strong>分类法</strong>
				<ul>
					<li><strong>{var:category}</strong>：分类目录</li>
					<li><strong>{var:post_tag}</strong>：文章标签</li>
					<li><strong>{var:product_cat}</strong>：商品分类（WooCommerce）</li>
					<li><strong>{var:product_tag}</strong>：商品标签（WooCommerce）</li>
				</ul>
			</li>
		</ul>
		<p><strong>收藏项目模板变量</strong></p>
		<ul>
			<li><strong>{tpl:99}</strong>：ID为99的收藏项目模板文章内容</li>
		</ul>
	</dd>
	<dt>随机作者变量</dt>
	<dd><strong>{author}</strong>：需要 <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings#download'); ?>" target="_blank">设置随机作者</a> 才能使用。</dd>
</dl>
<h2>索引变量 {index:*}</h2>
<p>应用于数组值（自定义字段或用户自定义字段），输出数组的索引值，默认是0开始输出，冒号后面的参数是偏移量，如果是1，则索引值是0+1，就从1开始输出了。</p>
<h2>函数变量 (f:*:*)</h2>
<dl>
	<dt>(f:urlencode:*)</dt>
	<dd>URL编码，*号可以是其他变量，多个参数之间用|分隔</dd>
	<dt>(f:urldecode:*)</dt>
	<dd>URL解码，*号可以是其他变量，多个参数之间用|分隔</dd>
	<dt>(f:rand:1000|9999)</dt>
	<dd>1000-9999的随机数</dd>
	<dt>(f:*:*)</dt>
	<dd>其他可用函数，中间的*号可以是其他函数名。</dd>
</dl>
<h1>使用范围</h1>
<dl>
	<dt>采集方法</dt>
	<dd>字符串<p><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/variables/1.png" /></p></dd>
	<dt>过滤器</dt>
	<dd><p>按正则表达式过滤（仅用于<strong>替换成</strong>）</p><p><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/variables/2.png" /></p></dd>
	<dd><p>前后缀</p><p><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/variables/3.png" /></p></dd>
	<dd><p>内容格式化（仅用于<strong>结构</strong>）</p><p><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/variables/4.png" /></p></dd>
</dl>