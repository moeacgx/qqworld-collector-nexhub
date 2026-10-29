<p>有些采集到的内容是JSON格式的，通过本方法可以非常方便地获取内容。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collecting-manual/by-jsonpath/1.png" /></p>
<h2>使用方法</h2>
<p>比如采集到的内容如下：</p>
<pre class="prism"><code class="language-markup">{
	"data": [
		{
			"title": "著名无节操人工智能/污妖王/值乎解惑/公众号：圣范锦意",
			"url": "http://www.zhihu.com/api/v4/answers/434595286",
		},
		{
			"title": "拯救人理之人/艾泽拉斯的守护者",
			"url": "http://www.zhihu.com/api/v4/answers/434529346",
		},
		{
			"title": "格瓦拉丨一段旅程改变了他，而他改变了世界",
			"url": "http://www.zhihu.com/api/v4/answers/434529378",
		}
	]
}</code></pre>
<h4>获取data下的所有内容</h4>
<pre class="prism"><code class="language-markup">$.data.*</code></pre>
<h4>获取所有标题</h4>
<pre class="prism"><code class="language-markup">$.data.*.title</code></pre>
<h4>获取所有链接</h4>
<pre class="prism"><code class="language-markup">$.data.*.url</code></pre>
<h2>文档</h2>
<h4>JSON路径范例</h4>
<table class="wp-list-table widefat fixed striped">
	<thead>
		<tr>
			<th>JSON路径</th>
			<th>匹配结果</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><code>$.store.books[*].author</code></td>
			<td>商店中的所有书籍作者</td>
		</tr>
		<tr>
			<td><code>$..author</code></td>
			<td>所有作者</td>
		</tr>
		<tr>
			<td><code>$.store..price</code></td>
			<td>任何价格</td>
		</tr>
		<tr>
			<td><code>$..books[2]</code></td>
			<td>第3本书</td>
		</tr>
		<tr>
			<td><code>$..books[(@.length-1)]</code></td>
			<td>序列中的最后一本书</td>
		</tr>
		<tr>
			<td><code>$..books[0,1]</code></td>
			<td>前两本书</td>
		</tr>
		<tr>
			<td><code>$..books[:2]</code></td>
			<td>前两本书</td>
		</tr>
		<tr>
			<td><code>$..books[?(@.isbn)]</code></td>
			<td>用isbn数字过滤所有书籍</td>
		</tr>
		<tr>
			<td><code>$..books[?(@.price&lt;10)]</code></td>
			<td>所有低于10元的书籍</td>
		</tr>
		<tr>
			<td><code>$..*</code></td>
			<td>数据中的所有元素（递归提取）</td>
		</tr>
	</tbody>
</table>
<h4>JSON路径语法</h4>
<table class="wp-list-table widefat fixed striped">
	<thead>
		<tr>
			<th>符号</th>
			<th>描述</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><code>$</code></td>
			<td>根对象/元素（非绝对必要）</td>
		</tr>
		<tr>
			<td><code>@</code></td>
			<td>当前对象/元素</td>
		</tr>
		<tr>
			<td><code>.</code> or <code>[]</code></td>
			<td>子操作符</td>
		</tr>
		<tr>
			<td><code>..</code></td>
			<td>递归向上一级</td>
		</tr>
		<tr>
			<td><code>*</code></td>
			<td>通配符。包含所有子元素，无论是什么索引。</td>
		</tr>
		<tr>
			<td><code>[,]</code></td>
			<td>指定索引范围作为新数组。</td>
		</tr>
		<tr>
			<td><code>[start:end:step]</code></td>
			<td>借用ES4/Python的数组切片运算符。</td>
		</tr>
		<tr>
			<td><code>?()</code></td>
			<td>通过脚本表达式过滤结果集。</td>
		</tr>
		<tr>
			<td><code>()</code></td>
			<td>使用脚本表达式的结果作为索引。</td>
		</tr>
	</tbody>
</table>