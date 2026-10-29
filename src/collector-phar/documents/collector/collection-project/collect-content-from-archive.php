<p>对来源地址进行采集操作。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/collect-content-from-archive/1.png" /></p>
<h2>高级请求</h2>
<p>主要用来对付AJAX加载的网站，需要将来源地址转换成AJAX的地址，然后提供给采集项目设置进行处理。</p>
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
<h4>采集整个列表项目</h4>
<p>列表页采集的流程是，先将列表中每个项目的代码都采集下来，然后从每个项目中分别获取文章链接，文章标题等。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/collect-content-from-archive/2.png" /></p>
<h4>新建采集项目</h4>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/collect-content-from-archive/3.png" /></p>
<p>一般至少要添加文章链接（即正文页，用于从正文采集内容）和文章标题，如果有文章摘要、特色图或标签也可以添加。</p>
<p>这其中，文章链接和文章标题是会进行排重检查，如果在数据库中有重复的内容，就会认为已经采集过了，并自动忽略。</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--collect-item'); ?>" target="_blank" class="button button-primary button-large qc-icon link">采集项目手册</a></p>