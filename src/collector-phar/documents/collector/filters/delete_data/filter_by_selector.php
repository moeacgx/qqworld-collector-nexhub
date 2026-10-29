<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/filters/delete_data/filter_by_selector/1.png" /></p>
<p>根据选择器进行过滤，注意，不仅仅清除标签哦，还会删除其内容。</p>
<p>每行一个选择器，可以是HTML标签、class、也可以是ID。不过一般不会用HTML标签的，除非你想大开杀戒。：）</p>
<h2>索引</h2>
<p>如果只想删除多个选择器中的一个元素，可以添加索引，比如只想删除第一张图片：</p>
<pre class="prism"><code class="language-php">img:eq(0)</code></pre>
<p>只想删除最后第一张图片：</p>
<pre class="prism"><code class="language-php">img:eq(-1)</code></pre>