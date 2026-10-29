<dl>
	<dt>31日 - <em>v3.0.2 beta9</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>阿里云OSS</strong>：可自定义节点域名。</dd>
	<dt>28日 - <em>v3.0.2 beta9</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>下载到本地</strong>：修复不支持自定义采集方法文件头的Bug。</dd>
	<dt>27日 - <em>v3.0.2 beta9</em></dt>
	<dd><strong>自动保存附件</strong> -&gt; <strong>扫描文章</strong>：新增日期范围选择。</dd>
	<dt>23日 - <em>v3.0.2 beta8</em></dt>
	<dd><strong>翻译</strong>：手动模式支持Wordpress5新编辑器。</dd>
	<dd><strong>保存远程附件</strong>：手动模式修复如果所有图像都采集错误时遇到的函数名错误，将 <em>Object</em> 错写成了 <em>Objece</em>。</dd>
	<dt>23日 - <em>v3.0.2 beta8</em></dt>
	<dd><strong>保存远程附件</strong>：手动模式支持Wordpress5新编辑器。</dd>
	<dt>20日 - <em>v3.0.2 Beta7</em></dt>
	<dd><strong>核心</strong>：去掉自动获取set-cookies给下一个地址使用，有极少数地址对cookies敏感，会导致采集错误。</dd>
	<dt>18日 - <em>v3.0.2 Beta7</em></dt>
	<dd><strong>保存远程附件</strong>：保存远程附件的手动模式下，如果所有远程附件都成功保存，则自动关闭保存界面。</dd>
	<dt>11日 - <em>v3.0.2 Beta6</em></dt>
	<dd><strong>保存远程附件</strong>：增强对无法获取到Header的附件的抓取能力。</dd>
	<dt>10日 - <em>v3.0.2 Beta6</em></dt>
	<dd><strong>保存远程附件</strong>：新增从Header中获取文件名的功能。</dd>
	<dt>7日 - <em>v3.0.2 Beta6</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>FTP</strong>：修复无法保存自定义目录设置状态的原因。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>FTP</strong>：修复同步到FTP的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集设置</strong>：新增设置特色图片开关。</dd>
	<dt>5日 - <em>v3.0.2 Beta5</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong> -&gt; <strong>选择器</strong>：修复某些html中无法过滤掉 <em>&lt;meta content="text/html; charset=UTF-8" http-equiv="Content-Type" /&gt;</em> 的bug，因为属性顺序的问题。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>按正则表达式过滤</strong>：修复方法中带有单引号而无法替换的Bug（在替换之前必须先转义，去掉单引号前面的斜杠）。</dd>
	<dt>2日 - <em>v3.0.2 Beta5</em></dt>
	<dd><strong>云存储</strong>：新增调试日志，在<a href="<?php print admin_url('admin.php?page=qqworld-collector-settings#debug'); ?>" target="_blank">设置</a>中开启。</dd>
	<dd><strong>云存储</strong>：修复重新同步后无法自动替换的Bug。</dd>
	<dt>1日 - <em>v3.0.2 Beta5</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>聚合图床</strong>：修复接口地址的协议问题，不支持http了。</dd>
</dl>