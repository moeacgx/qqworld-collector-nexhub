<p>正则表达式是用于匹配字符串中字符组合的模式。<br />但是因为正则表达式对于大多数人来说还比较复杂难懂，所以本系统将其简化，方便大家使用。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collecting-manual/by-regex/1.png" /></p>
<h2>变量</h2>
<p>可以看到在方法值下方有很多变量，下面介绍一下这些变量所代表的的意义。</p>
<h4>非贪婪模式</h4>
<p>所谓的非贪婪模式是指在整个表达式匹配成功的前提下，尽可能少的匹配。</p>
<p>注意如果没有指定 <em>(content)</em>，则是采集或替换表达式所匹配的全部内容。</p>
<dl>
	<dt>(*)</dt>
	<dd>匹配任意字符。</dd>
	<dt>(d)</dt>
	<dd>匹配数字。</dd>
	<dt>(n)</dt>
	<dd>匹配换行符。</dd>
	<dt>(w)</dt>
	<dd>匹配字母数字下划线。</dd>
	<dt>(.)</dt>
	<dd>匹配不包含换行符的所有字符。</dd>
	<dt>(c)</dt>
	<dd>匹配中文字符</dd>
	<dt>(content)</dt>
	<dd>指定要采集或替换的内容，匹配任意字符</dd>
	<dt>(content:d)</dt>
	<dd>指定要采集或替换的内容，匹配数字。</dd>
	<dt>(content:w)</dt>
	<dd>指定要采集或替换的内容，匹配字母数字下划线。</dd>
	<dt>(content:.)</dt>
	<dd>指定要采集或替换的内容，匹配不包含换行符的所有字符。</dd>
	<dt>(content:c)</dt>
	<dd>指定要采集或替换的内容，匹配中文字符。</dd>
</dl>
<h4>贪婪模式</h4>
<p>贪婪模式在整个表达式匹配成功的前提下，尽可能多的匹配。</p>
<p>方法很简单，就是在非贪婪模式括号内的变量后面加上 <strong>:*</strong></p>
<dl>
	<dt>(*:*)</dt>
	<dd>匹配任意字符。</dd>
	<dt>(d:*)</dt>
	<dd>匹配数字。</dd>
	<dt>(n:*)</dt>
	<dd>匹配换行符。</dd>
	<dt>(w:*)</dt>
	<dd>匹配字母数字下划线。</dd>
	<dt>(.:*)</dt>
	<dd>匹配不包含换行符的所有字符。</dd>
	<dt>(c:*)</dt>
	<dd>匹配中文字符</dd>
	<dt>(content:*)</dt>
	<dd>指定要采集的内容，匹配任意字符</dd>
	<dt>(content:d:*)</dt>
	<dd>指定要采集的内容，匹配数字。</dd>
	<dt>(content:w:*)</dt>
	<dd>指定要采集的内容，匹配字母数字下划线。</dd>
	<dt>(content:.:*)</dt>
	<dd>指定要采集的内容，匹配不包含换行符的所有字符。</dd>
	<dt>(content:c:*)</dt>
	<dd>指定要采集或替换的内容，匹配中文字符。</dd>
</dl>
<h4>特殊</h4>
<dl>
	<dt>(o:1|x)</dt>
	<dd>匹配数字1或字母x，仅仅匹配单个字符</dd>
</dl>
<p>在较少的情况下必须要用到。比如在一篇文章结尾有个广告，我们要把广告删掉，用如下正则</p>
<pre class="prism"><code class="language-markup">&lt;div class="ads"&gt;(*)</code></pre>
<p>结果，因为非贪婪模式的最小匹配原则，在这个ads标签后面的内容并没有被删除，好气人喔，怎么办？改成贪婪模式就好了：</p>
<pre class="prism"><code class="language-markup">&lt;div class="ads"&gt;(*:*)</code></pre>
<h4>匹配逻辑非</h4>
<p>有时候需要匹配不包含某字符的内容，使用双!包裹，只支持单字符</p>
<dl>
	<dt>(!(!)</dt>
	<dd>匹配非左括号的字符，非贪婪模式</dd>
	<dt>(!p!:*)</dt>
	<dd>匹配不包含字母p的字符，贪婪模式</dd>
	<dt>(content:!e!)</dt>
	<dd>匹配要采集的内容是不包含字母e的字符，非贪婪模式（注意不能是<strong>右括号</strong>，会有冲突）</dd>
	<dt>(content:!p!:*)</dt>
	<dd>匹配要采集的内容是不包含字母p的字符，贪婪模式</dd>
</dl>
<p>下面的例子中将匹配左侧没有<strong>左括号</strong>的 <em>.emphricepart</em> 后面的内容</p>
<pre class="prism"><code class="language-markup">(!(!)&lt;span class="emphricepart"(*)&gt;(content:*)($)</code></pre>
<h4>匹配位置</h4>
<p>有时候需要输入匹配位置来精确定位。</p>
<dl>
	<dt>(^)</dt>
	<dd>匹配开头的字符</dd>
	<dt>($)</dt>
	<dd>匹配结尾的字符</dd>
</dl>
<p>下面的例子只会匹配最前面的 <em>.asd</em>，之后出现的将被忽略掉。</p>
<pre class="prism"><code class="language-markup">(^)&lt;div class="ads"&gt;(content)&lt;/div&gt;(*)</code></pre>
<p>下面的例子只会匹配最后的 <em>.asd</em>，之前出现的将被忽略掉。</p>
<pre class="prism"><code class="language-markup">(*)&lt;div class="ads"&gt;(content)&lt;/div&gt;($)</code></pre>