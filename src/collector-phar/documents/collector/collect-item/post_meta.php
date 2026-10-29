<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collect-item/post_meta/1.png" /></p>
<p>采集内容保存到自定义字段，懂Wordpress的人一定会非常喜欢自定义字段，这个功能可以非常方便地扩充文章的字段，使Wordpress几乎可以开发任何类型的网站。</p>
<h2>额外设置</h2>
<dl>
	<dt>保存到</dt>
	<dd>输入自定义字段的名称，也就是所谓的 <em>Meta Key</em>。比如 <em>readed</em> 或者 <em>post_function[info]</em> (用于数组，仅支持1层)。</dd>
	<dt>名称</dt>
	<dd>用于文章内容格式化，或帮助自己记住这个采集内容是什么。</dd>
	<dt>保存到数组</dt>
	<dd>默认是会将采集到的多个项目整合成字符串，如果需要保存数组，开启此项即可。<br />可以直接采集多个数据生成简单的数组，也可以用碎片变量组合并指定键名生成复杂的数组，例如：<br /><em>key$$value|||key$$value|||key$$value</em></dd>
	<dt>二维数组</dt>
	<dd>将数组转换为二维数组，多个键值使用字符串 <!--d--> 隔开，例如：<br /><em>key$$value|||key$$value|||key$$value<br />&lt;!--d--&gt;<br />key$$value|||key$$value|||key$$value</em></dd>
</dl>
<h2>过滤器</h2>
<p>你可以对采集到的内容进行各种过滤</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--filters'); ?>" target="_blank" class="button button-primary button-large qc-icon link">过滤器手册</a></p>
<h2>高级应用</h2>
<p>如果自定义字段的内容是数组，就一定要勾选 <strong>保存到数组</strong> 选项，设置方法如下：</p>
<h3>常规用法</h3>
<pre class="prism"><code class="language-php">array('cat')</code></pre>
<p>规则中的写法是用 <strong>字符串</strong> 方法，<strong>方法值</strong> 是：<em>0$$cat</em></p>
<pre class="prism"><code class="language-php">array(
	'download' => 1
)</code></pre>
<p>规则中的写法是用 <strong>字符串</strong> 方法，<strong>方法值</strong> 是：<em>download$$1</em></p>
<pre class="prism"><code class="language-php">array(
	'code' => 1,
	'desc' => 'great'
)</code></pre>
<p>规则中的写法是用 <strong>字符串</strong> 方法，<strong>方法值</strong> 是：<em>code$$1|||desc$$great</em></p>
<h3>进阶用法</h3>
<p>有些数组项目是需要通过采集获取，比如：</p>
<pre class="prism"><code class="language-php">array(
	'type' => 3, // 下载类型
	'download_url' => '<?php print home_url('wp-content/uploads/2020/02/example.webp'); ?>' // 下载地址
)</code></pre>
<p>首先要用碎片采集下载地址，并将其变量设置为 <em>download_url</em>。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collect-item/post_meta/2.png" /></p>
<p>然后用自定义字段来组合数组，注意这个自定义字段一定要放到碎片的后面。<br />规则中的写法是用 <strong>字符串</strong> 方法，<strong>方法值</strong> 是：<em>type$$3|||download_url$${var:download_url}</em></p></p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collect-item/post_meta/3.png" /></p>
<h2>高级应用</h2>
<p>如果自定义字段的内容是数组，就一定要勾选 <strong>保存到数组</strong> 选项，设置方法请参考 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item--post_meta'); ?>" target="_blank"><strong>自定义字段</strong></a>。</p>
<h3>三维数组</h3>
<p>默认只支持保存为二维数组，如果需要三维或更复杂的数组，需要使用WP的接口，范例，将 自定义字段 <strong>_post_function</strong> 中的 <strong>二维数组</strong> 改为 <strong>三维数组</strong>。：</p>
<pre class="prism"><code class="language-php">/**
 *
 * 之前：
 * $_meta_value = array(
 *		'0' => array( 't' => '硬盘', 'v' => '10'),
 *		'1' => array( 't' => '内存', 'v' => '2'),
 * );
 * 之后：
 * $_meta_value = array(
 *		'info' => array(
 *			'0' => array( 't' => '硬盘', 'v' => '10'),
 *			'1' => array( 't' => '内存', 'v' => '2'),
 *		)
 * );
 *
**/
add_action( 'add_post_meta', function($object_id, $meta_key, $_meta_value) {
	if ($meta_key == '_post_function' && !isset($_meta_value['info'])) {
		$_meta_value = array(
			'info' => $_meta_value
		);
		update_post_meta($object_id, $meta_key, $_meta_value);
	}
}, 10, 3);
add_action( 'update_post_meta', function($meta_id, $object_id, $meta_key, $_meta_value) {
	if ($meta_key == '_post_function' && !isset($_meta_value['info'])) {
		$_meta_value = array(
			'info' => $_meta_value
		);
		update_post_meta($object_id, $meta_key, $_meta_value);
	}
}, 10, 4);</code></pre>
<p>注意，<strong>_post_function</strong> 是要修改的自定义字段，改成你的。然后里面的 <strong>&amp;amp;&amp;amp;</strong> 要手动改成 <strong>&amp;&amp;</strong>，否则会出错。</p>