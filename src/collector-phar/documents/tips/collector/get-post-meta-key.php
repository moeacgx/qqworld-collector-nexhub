<p>以阅读量为例，打开一篇文章的编辑页，可以找到 <strong>自定义字段</strong> 模块，如果没有，则可以在页面右上方的 <strong>显示选项</strong> 中开启。</p>
<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/get-post-meta-key/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/get-post-meta-key/1.png" /></a></p>
<p>按照值96来判断其，<em>views</em> 就是该文章的阅读量自定义字段名。</p>
<h2>注意</h2>
<p>有些字段的值是数组类型，或者字段名前面有下划线（如 <em>_views</em>），这些字段是不会显示的，要获取这些字段，就得利用一些数据库工具，如 <strong>phpMyAdmin</strong>，在 <em>wp_postmeta</em> 表中搜索和该文章ID有关的所有项目，并获取自定义字段名。</p>
<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/get-post-meta-key/2.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/get-post-meta-key/2.png" /></a></p>
<h3>自定义字段表</h3>
<ul>
	<li>（文章）自定义字段：<strong>wp_postmeta</strong></li>
	<li>用户自定义字段：<strong>wp_usermeta</strong></li>
	<li>评论自定义字段：<strong>wp_commentmeta</strong></li>
</ul>
<h2>问题自查</h2>
<p>如果设置的字段无效，建议在 <strong>phpmyadmin</strong> 里对比 <strong>没问题的文章</strong> 和 <strong>有问题的文章</strong> 的字段和值，找出差异。</p>