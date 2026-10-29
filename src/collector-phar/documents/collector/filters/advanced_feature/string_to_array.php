<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/filters/advanced_feature/string_to_array/1.png" /></p>
<p>将字符串转为数组。通常用于在json字符串中获取分类法。</p>
<p>比如有时候采集标签的时候，不得不在JSON字符串中采集到一堆字符串，可以使用这个方法将标签提取出来并转换为数组。</p>
<h2>类型</h2>
<h4>使用字符串分割另一个字符串。（explode函数）</h4>
<p>利用explode函数使用1个字符串来分割字符串。</p>
<p>如果采集到的内容是：</p>
<pre class="prism"><code class="language-markup">比特币，索尼，盈利</code></pre>
<p>就可以用 <em>，</em> 来分割。</p>
<h4>使用正则表达式提取字符串。（preg_match_all函数）</h4>
<pre class="prism"><code class="language-markup">{["比特币",2],["索尼",6],["盈利",2]}</code></pre>
<p>就可以用正则表达式 <em>["(content)"</em> 来提取。</p>