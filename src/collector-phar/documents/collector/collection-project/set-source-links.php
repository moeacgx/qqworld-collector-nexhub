<p>因为同一个网站不同分类的采集方法是一样的，只是列表地址和保存的分类的不一样，所以在3.0版中，同一个收藏项目里可以设置多组来源地址和保存设置。</p>
<p>点击添加来源地址采集，新建常规采集，这里还有个魔法采集，可能会在将来转换为专门使用其他采集接口的设置，比如神箭手什么的。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/set-source-links/1.png" /></p>
<h1>常规采集</h1>
<h2>设置采集地址</h2>
<p>有静态地址和批量地址两种方法，可以混用，一般来说静态地址放第1页的地址，而批量地址放之后的分页地址。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/set-source-links/2.png" /></p>
<dl>
	<dt>静态地址</dt>
	<dd>直接复制粘贴到输入框即可，每行1个。<br />通常只用来采集第一页，不是必填的，如果只想在批量地址里采集历史文章，可以删掉静态地址。</dd>
	<dt>批量地址</dt>
	<dd>复制分页地址进来，将页码数字用变量 <strong>(*)</strong> 代替，然后规定页码的初始位数，以及页码的范围。<br />有的页码是offset位移形式的，需要用到 <strong>(*20)</strong>，意思是每次递增的数值乘以20.</dd>
</dl>
<h2>高级请求</h2>
<p>用于动态采集文章列表地址，来源地址应该填写包含文章列表的列表地址。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/set-source-links/5.png" /></p>
<h4>请求方法</h4>
<p>用来采集设置的来源地址或经过高级请求处理过的地址的HTML代码。<br />用什么方法请求URL地址？极少数地址是需要用POST请求的。</p>
<h4>请求页头（Headers）</h4>
<p>有些地址是需要特殊的页头才能获取到需要的数据，比较常用的是Cookie。<br />如何获得 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--get-request-headers'); ?>" target="_blank">请求页头（Headers）</a>？</p>
<h4>新链接</h4>
<p>从静态地址中采集文章列表的链接，相当于批量地址的智能加强版。</p>
<h2>保存设置</h2>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/set-source-links/4.png" /></p>
<p>对应输入的来源地址，设置需要将其保存到的文章类型、分类法以及作者。</p>
<h1>接口采集</h1>
<p>使用API进行采集，比如神箭手。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/set-source-links/3.png" /></p><dl>
	<dt>接口地址</dt>
	<dd>通常填写接口的请求地址。</dd>
	<dt>接口参数</dt>
	<dd>有文本参数和分页参数两种。</dd>
</dl>
<h2>保存设置</h2>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collection-project/set-source-links/4.png" /></p>