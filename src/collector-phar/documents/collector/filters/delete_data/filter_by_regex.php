<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/filters/delete_data/filter_by_regex/1.png" /></p>
<p>根据正则表达式来清除或替换内容。</p>
<h4>正则表达式</h4>
<p>本插件有一套自制正则表达式系统，通过一些简单的字符能够让不熟悉正则的用户编写复杂的正则表达式。</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collecting-manual--by-regex'); ?>" target="_blank" class="button button-primary qc-icon link">正则表达式手册</a></p>
<h1>关键词 (content) 的用法</h1>
<h2>特殊范例一</h2>
<h4>只替换(content)匹配到的内容。</h4>
<p>如果要把 <em>{"type":"video","type":"<strong>视频教程</strong>"},</em> 改成 <em>{"type":"video","type":"<strong>影音娱乐</strong>"},</em>。</p>
<p>比如将：</p>
<p><em>{"type":"video","type":"<strong>(content)</strong>"},</em></p>
<p>替换成：</p>
<p><strong>影音娱乐</strong></p>
<p>即是只更换type的值，保留其他内容。</p>
<h2>特殊范例二</h2>
<h4>从要替换的字符中提取内容，然后加上新的字符作为替换内容。</h4>
<p>如果要获取ID，并将匹配到的全部内容拼接成其他内容。</p>
<p>比如将：</p>
<p><em>{"type":"video","id":"<strong>(content)</strong>"},</em></p>
<p>替换成：</p>
<p><em>&lt;iframe frameborder="0" height="360" width="640" class="henzan-video-iframe" allowfullscreen="true" scrolling="no" src="http://www.henzan.com/video.html?<strong>(content)</strong>"&gt;&lt;/iframe&gt;</em></p>
<p>即是提取视频的id，组成iframe代码并替换之。</p>