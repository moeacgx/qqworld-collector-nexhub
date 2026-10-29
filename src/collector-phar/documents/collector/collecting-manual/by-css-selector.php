<p>在CSS中，选择器是一种模式，用于选择需要添加样式或脚本程序的元素。</p>
<h4>选择器的写法</h4>
<ul>
	<li><strong>HTML标签：</strong>直接写标签名即可，如 <em>div</em></li>
	<li><strong>Class类：</strong>在类名前加上"."，如 <em>.post</em></li>
	<li><strong>ID：</strong>在ID前加上"#"，如 <em>#article</em></li>
</ul>
<p>范例</p>
<pre class="prism"><code class="language-html"><div class="article" id="post-1">...</div></code></pre>
<p>选择器写 <strong>div</strong> 或 <strong>.article</strong> 或 <strong>#post-1</strong> 都是正确的，注意能用ID就不用Class，能用Class就不用标签名。</p>
<p>并且，就像目录一样，CSS选择器支持层级关系，可以用来精准定位。比如</p>
<pre class="prism"><code class="language-css">#article .post p</code></pre>
<h2>设置方法</h2>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collecting-manual/by-css-selector/1.png" /></p>
<h4>获取的对象</h4>
<ol>
	<li><strong>内部HTML：</strong>所选标签内部的内容</li>
	<li><strong>外部HTML：</strong>所选标签内部的内容，包括标签本身</li>
	<li><strong>标签属性：</strong>所选标签的属性值，需要填写属性名</li>
</ol>
<p>如果你要采集标签属性，这里选择内部HTML就会出错，所以如果采集不到内容可以检查一下这里。</p>
<h4>属性名</h4>
<p>如果选择了标签属性，属性名输入框就会显示，默认是href，就是a标签的超链接。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collecting-manual/by-css-selector/2.png" /></p>
<p>注意这里可以输入属性组，用符号 | 隔开，比如 <strong>src|data-src</strong>，系统会先搜索<strong>src</strong>属性，如果找不到内容就搜索<strong>data-src</strong>。</p>
<h4>索引</h4>
<p>默认是采集所匹配标签的全部内容，但也可以指定索引，比如你只想采集第2个标题，那么这里就选1好了，注意哦，0才是第1个。</p>
<h2>获取方法</h2>
<p>有3种方法，按F12开启开发者工具，然后选中要采集的标签。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collecting-manual/by-css-selector/3.png" /></p>
<h4>&#9312; 从样式文件中获取（如上图1所示）</h4>
<p>很多标签在网站的样式文件里已经有引用了，直接复制即可。注意事项：</p>
<ul>
	<li>有些包含逗号的，只需要获取其中1个就行</li>
	<li>有些不仅包含逗号，而且选择器是灰色的，灰色是无效的。</li>
</ul>
<h4>&#9313;	 直接复制（如上图2所示）</h4>
<p>在要采集的标签上点鼠标右键，依次点击 Copy -&gt; Copy selector，即可获取当前标签的选择器。<br />不过这个选择器可能会很复杂，需要人工精简一下，尤其是要去掉类似 <em>:nth-child(8)</em> 一样的尾巴，这个是索引。</p>
<h4>&#9314;	 自建层级关系（如上图3所示）</h4>
<p>如上图3所示，这里显示该标签的层级关系，只需要照葫芦画瓢顺着写即可，比如可以这么写：</p>
<pre class="prism"><code class="language-css">#refsect1-function.date-description thead th</code></pre>
<p>可以看到我故意漏掉了<em>table</em> 和 <em>tr</em>，加上也没错，只是我喜欢偷懒。：）</p>
<h2>高级应用</h2>
<pre class="prism"><code class="language-html"><meta name="keywords" content="HTML,ASP,PHP,SQL" /></code></pre>
<p>采集SEO信息，方法：<em>CSS选择器</em>，方法值：<em>[name="keywords"]</em>，标签属性：<em>content</em>，如下图所示。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collecting-manual/by-css-selector/4.png" /></p>