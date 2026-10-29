<h2>动态修改价格</h2>
<p>动态修改采集的价格，比如要将采集的价格都乘以1.5，将以下代码放到主题的 <em>functions.php</em> 中即可：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-collection-project-magics-alibaba_1688-price', function($price) {
	return round($price * 1.5, 2);
} );</code></pre>
<p>后面的 <strong>2</strong> 代表保留两位小数，不要修改。</p>
<h2>动态修改规则名称</h2>
<p>如果采集到的规格名称和你已经存在的规格名不一致，可以用以下接口进行修改，比如，将 <strong>颜色</strong> 改为 <strong>color</strong>，将 <strong>尺码</strong> 改成 <strong>size</strong>：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-magics-alibaba_1688-attribute-name', function($name) {
	if ($name == '颜色') return 'color';
	elseif ($name == '尺码') return 'size';
	return $name;
} );</code></pre>
<h2>禁止采集商品属性</h2>
<p>如果你不希望采集商品属性，将以下代码放到主题的 <em>functions.php</em> 中即可：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-magics-alibaba_1688-is-get-attributes', '__return_false' );</code></pre>
<h2>自动生成SKU</h2>
<p>将以下代码放到主题的 <em>functions.php</em> 中即可：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-auto-add-sku-for-woo-products', '__return_true' );</code></pre>