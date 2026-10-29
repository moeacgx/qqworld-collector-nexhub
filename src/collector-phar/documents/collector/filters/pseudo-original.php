<p>使用替换指定的关键词、插入随机关键词或插入随机段落来伪造原创。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/filters/pseudo-original/1.png" /></p>
<h2>类型</h2>
<h4>替换关键词</h4>
<p>自动替换内容中指定的关键词。</p>
<h4>随机关键词</h4>
<p>在内容的前后位置插入随机的关键词。</p>
<h4>随机段落</h4>
<p>在内容中插入随机的段落，仅适用于多段落的内容。</p>
<h4>段落重组</h4>
<p>将段落进行重新排序以达到伪原创的效果，但有可能破坏阅读体验。</p>
<h2>位置</h2>
<p>替换关键词是没有位置设置的。</p>
<h4>随机位置</h4>
<p>随机关键词的随机位置是指内容前后位置，随机段落的随机位置是指插入段落随机行数，并且插入的前后位置也随机。</p>
<h4>前面</h4>
<p>在内容的前面插入随机关键词或段落。</p>
<h4>后面</h4>
<p>在内容的前面插入随机关键词或段落。</p>
<h2>值</h2>
<p>留空则调用 <a href="<?php print admin_url('admin.php?page=pseudo-original-settings'); ?>" target="_blank">伪静态</a> 的设置，随机段落支持变量 <em>{var:cat:1}</em>，仅调用 <a href="<?php print admin_url('admin.php?page=pseudo-original-settings#random-paragraph'); ?>" target="_blank">随机段落</a> 设置中 <strong>&lt;cat:1&gt;...&lt;/cat:1&gt;</strong> 中的内容。</p>
<p>也可以为这个采集项目设置独特的值，关键词每行一个，段落使用 <!--s--> 隔开。</p>
<p>具体格式请参考 <a href="<?php print admin_url('admin.php?page=pseudo-original-settings'); ?>" target="_blank">伪静态</a> 的设置。</p>