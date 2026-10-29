<p>XPath即为XML路径语言（XML Path Language），它是一种用来确定XML文档中某部分位置的语言。 XPath基于XML的树状结构，提供在数据结构树中找寻节点的能力。 起初XPath的提出的初衷是将其作为一个通用的、介于XPointer与XSL间的语法模型。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collecting-manual/by-xpath/1.png" /></p>
<p>设置界面如上图所示。</p>
<h4>获取方法</h4>
<p>按F12开启开发者工具，在要采集的标签上点鼠标右键，依次选择 <strong>Copy</strong> -&gt; <strong>Copy XPath</strong>，即可复制到剪贴板，然后粘贴到<strong>方法值</strong>中去。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collecting-manual/by-xpath/2.png" /></p>
<h2>XPath常用案例</h2>
<dl>
	<dt>匹配所有标签</dt>
	<dd><p>匹配这个路径下的所有li标签的内容。</p><pre class="prism"><code class="language-markup">/html/body/aside/ul/li/ul/li</code></pre></dd>
	<dt>匹配指定索引的标签</dt>
	<dd><p>匹配这个路径下的第二个li标签的内容。</p><pre class="prism"><code class="language-markup">/html/body/aside/ul/li/ul/li[2]</code></pre></dd>
	<dt>匹配标签属性</dt>
	<dd><p>匹配这个路径下的第二个li标签的class属性。</p><pre class="prism"><code class="language-markup">/html/body/aside/ul/li/ul/li[2]/@class</code></pre></dd>
	<dt>匹配包含某属性的标签</dt>
	<dd><p>匹配这个路径下的包含ddost类的li标签的内容。</p><pre class="prism"><code class="language-markup">/html/body/aside/ul/li/ul/li[contains(@class, 'ddost')]</code></pre></dd>
	<dt>匹配不等于某属性的标签</dt>
	<dd><p>匹配这个路径下的不等于ddost类的li标签的内容。</p><pre class="prism"><code class="language-markup">/html/body/aside/ul/li/ul/li[@class!='ddost']</code></pre></dd>
	<dt>匹配不等于某属性的标签</dt>
	<dd><p>匹配这个路径下的不包含great类的li标签的内容。</p><pre class="prism"><code class="language-markup">not /html/body/aside/ul/li/ul/li[@class!='great']</code></pre></dd>
	<dt>双重匹配不等于某属性的标签</dt>
	<dd><p>匹配这个路径下的类不等于ddost且不包含great的li标签的内容。</p><pre class="prism"><code class="language-markup">/html/body/aside/ul/li/ul/li[@class!='ddost'] not /html/body/aside/ul/li/ul/li[@class!='great']</code></pre></dd>
</dl>
<h2>匹配XML</h2>
<pre class="prism"><code class="language-xml"><item>
	<title>亲属关系匹配</title>
	<description>XML文档可归结为树型结构，因此任何一个节点都不是孤立的。通常我们把节点之 间的归属关系归结为一种亲属关系，如父亲、孩子、祖先、后代、兄弟等等。在对 元素进行匹配时，同样可以用到这些概念。</description>
</item></code></pre>
<dl>
	<dt>匹配标题</dt>
	<dd><pre class="prism"><code class="language-markup">*/item/title</code></pre></dd>
	<dt>匹配描述</dt>
	<dd><pre class="prism"><code class="language-markup">*/item/description</code></pre></dd>
</dl>
<h2>XPath文档</h2>
<h4>实例</h4>
<table class="wp-list-table widefat striped">
	<thead>
		<tr>
			<th>路径表达式</th>
			<th>结果</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>boookstore</td>
			<td>选取 boookstore 元素的所有子节点。</td>
		</tr>
		<tr>
			<td>/bookstore</td>
			<td>
			<p>选取根元素 bookstore。</p>
			<p>注释：假如路径起始于正斜杠( / )，则此路径始终代表到某元素的绝对路径！</p>
			</td>
		</tr>
		<tr>
			<td>bookstore/book</td>
			<td>选取属于 bookstore 的子元素的所有 book 元素。</td>
		</tr>
		<tr>
			<td>//book</td>
			<td>选取所有 book 子元素，而不管它们在文档中的位置。</td>
		</tr>
		<tr>
			<td>bookstore//book</td>
			<td>选择属于 bookstore 元素的后代的所有 book 元素，而不管它们位于 bookstore 之下的什么位置。</td>
		</tr>
		<tr>
			<td>//@lang</td>
			<td>选取名为 lang 的所有属性。</td>
		</tr>
	</tbody>
</table>
<h4>路径表达式</h4>
<table class="wp-list-table widefat striped">
	<thead>
		<tr>
			<th>表达式</th>
			<th>描述</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>nodename</td>
			<td>选取此节点的所有子节点。</td>
		</tr>
		<tr>
			<td>/</td>
			<td>从根节点选取。</td>
		</tr>
		<tr>
			<td>//</td>
			<td>从匹配选择的当前节点选择文档中的节点，而不考虑它们的位置。</td>
		</tr>
		<tr>
			<td>.</td>
			<td>选取当前节点。</td>
		</tr>
		<tr>
			<td>..</td>
			<td>选取当前节点的父节点。</td>
		</tr>
		<tr>
			<td>@</td>
			<td>选取属性。</td>
		</tr>
	</tbody>
</table>