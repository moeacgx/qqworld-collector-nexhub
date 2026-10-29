<dl>
	<dt>29日 - <em>v3.0.2 beta5</em></dt>
	<dd><strong>核心</strong> -&gt; <strong>抓换相对地址为绝对地址</strong>：修复无法转换 ./ 开头的相对地址的Bug。</dd>
	<dt>29日 - <em>v3.0.2 beta4</em></dt>
	<dd><strong>检测重复标题</strong>：新增检测重复标题的功能，在编辑页输入标题后自动检测。</dd>
	<dd><strong>自动锚点</strong> -&gt; <strong>扫描文章自动添加标签</strong>：修复可能会导致500错误的Bug。</dd>
	<dt>23日 - <em>v3.0.2 beta3</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集设置</strong>：修复当未设置抓取远程附件时可能会导致采集中断的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>保存文章</strong>：修复保存文章时可能会产生的一些Notice Bug。</dd>
	<dt>17日 - <em>v3.0.2 beta2</em></dt>
	<dd>修复了一些核心采集Bug。</dd>
	<dt>14日 - <em>v3.0.2 beta1</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>按关键词过滤</strong>：修复对空内容判断出错的Bug。</dd>
	<dt>10日 - <em>v3.0.1</em></dt>
	<dd><strong>内核</strong>：将菜单页用包含的方式提取出来。</dd>
	<dd><strong>收藏项目</strong>：修复采集时图片不能打水印的Bug。</dd>
	<dt>9日 - <em>v3.0.1 Beta13</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>删除网站资源缓存</strong>：修复JS的Bug。</dd>
	<dt>7日 - <em>v3.0.1 Beta13</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>已收藏的文章</strong>：修复指定文章状态情况下的分页错乱的Bug。</dd>
	<dt>6日 - <em>v3.0.1 Beta13</em></dt>
	<dd><strong>收藏项目</strong>：修复列表页不得不采集文章链接的Bug。
	<dd><strong>收藏项目</strong>：修复采集过非唯一采集项目后导致之后的采集项目无法使用选择器采集的Bug，因为$html变量被清空。
	<dd><strong>自动保存附件</strong>：修复错误获取文件头中的编码类型的Bug。
	<dt>4日 - <em>v3.0.1 Beta13</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>排除重复</strong> -&gt; <strong>排除URL</strong>：将排除的程序挪到Post Link采集中去，并且在get_source_links里加入更加精准的排除当前采集到的重复文章或链接的方法（先忽略disallowed的数据再进行比对）</dd>
	<dt>3日 - <em>v3.0.1 Beta12</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>排除重复</strong>：去掉source-link中的https?前缀进行比对。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集设置</strong> -&gt; <strong>排除URL</strong>：去掉URL中的https?前缀进行比对。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>文章内容</strong> -&gt; <strong>分页</strong>：对去掉分页URL的https?再进行重复比对。</dd>
	<dd><strong>自动锚点</strong> -&gt; <strong>设置锚点关键词</strong>：如果设置了自定义URL则不自动生成对应的分类法。</dd>
	<dd><strong>自动锚点</strong> -&gt; <strong>自动标签</strong>：增加扫描功能。</dd>
	<dt>2日 - <em>v3.0.1 Beta12</em></dt>
	<dd><strong>设置</strong> -&gt; <strong>服务器</strong> -&gt; <strong>HTTP文件头</strong>：新增Cookies。</dd>
	<dt>1日 - <em>v3.0.1 Beta12</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong>：新增解码淘宝客。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>文章内容格式化</strong>：修复不支持特色图片的Bug。</dd>
	<dd>支持Swoole Compiler. （使用 <strong>require</strong> 代替 <strong>require_once</strong> ）</dd>
</dl>