<p>对从列表页采集到的文章链接进行采集操作。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/collect-content-from-singular/1.png" /></p>
<h2>高级请求</h2>
<p>主要用来对付AJAX加载的网站，需要将正文地址转换成AJAX的地址，然后提供给采集项目设置进行处理。<br />不过，极少的网站在正文页采用AJAX加载，这个对SEO太不友好了。</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--advanced-request'); ?>" target="_blank" class="button button-primary button-large qc-icon link">高级请求手册</a></p>
<h2>如何请求</h2>
<h4>请求方法</h4>
<p>用来采集设置的来源地址或经过高级请求处理过的地址的HTML代码。<br />用什么方法请求URL地址？极少数地址是需要用POST请求的。</p>
<h4>请求页头（Headers）</h4>
<p>有些地址是需要特殊的页头才能获取到需要的数据，比较常用的是Cookie。<br />如何获得 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--get-request-headers'); ?>" target="_blank">请求页头（Headers）</a>？</p>
<h4>过滤器</h4>
<p>如果有需要，可以对采集到的网页HTML代码进行预先格式化，然后再交给各个采集项目进行处理。</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--filters'); ?>" target="_blank" class="button button-primary button-large qc-icon link">过滤器手册</a></p>
<h2>采集项目</h2>
<h4>新建采集项目</h4>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/collect-content-from-singular/2.png" /></p>
<p>正文页的采集项目少了文章链接，多了碎片。</p>
<p>每个项目设置还多了个覆盖开关。比如在文章标题上开启了覆盖，即使从列表页也采集到了文章标题，也会在正文页再次采集并将其内容覆盖。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/collect-content-from-singular/3.png" /></p>
<p>一般来说，从列表页采集到的内容，在正文页就不需要采集了，除非你需要用正文页采集到的内容覆盖列表页采集到的内容。</p>
<p>但仍然建议将文章标题等在列表页采集到的内容页设置一下，可以不勾选覆盖，因为你有可能会直接输入正文链接进行采集，这种采集是不会在列表页获取到文章标题等内容的。</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item'); ?>" target="_blank" class="button button-primary button-large qc-icon link">采集项目手册</a></p>