<dl>
	<dt>29 - <em>v4.0.0 beta4</em></dt>
	<dd><strong>自动保存附件</strong>：增加探测单独媒体地址的兼容性（识别有空格的地址）。</dd>
	<dt>28 - <em>v4.0.0 beta4</em></dt>
	<dd><strong>核心</strong>：增强系统稳定性，减少各种程序“脱靶”现象。</dd>
	<dt>26 - <em>v4.0.0 beta4</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong> -&gt; <strong>百度云BOS对象存储</strong>：更新SDK，兼容采集。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong> -&gt; <strong>华为云OBS对象存储</strong>：更新SDK，兼容采集。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong> -&gt; <strong>又拍云对象存储</strong>：更新SDK，兼容采集。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong> -&gt; <strong>七牛对象存储</strong>：更新程序。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>选择器采集方法核心程序</strong>：新增 简单的HTML DOM解析器，增强兼容性。</dd>
	<dt>25 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong> -&gt; <strong>腾讯云COS对象存储</strong>：更新SDK，兼容采集。</dd>
	<dt>24 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>内容格式化</strong>：修复因为输入框中的 <em>实体问题</em> 导致测试采集和正式采集的结果不一样。</dd>
	<dt>23 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>设置</strong> -&gt; <strong>收藏项目</strong>：新增 <em>收藏项目规则过滤器</em>。</dd>
	<dd><strong>设置</strong> -&gt; <strong>检测重复标题</strong>：新增显示 <em>自动检测出的重复文章</em>。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong> -&gt; <strong>清除链接</strong>：修复无法清理换行的链接的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>检查标题重复</strong>：如果同时检查自定义字段时，文章的自定义字段值为空，则直接返回否。</dd>
	<dt>22 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>替换HTML标签</strong>：修复替换过程中会清空标签内的HTML的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>内容格式化</strong>：支持 <em>(f:*:*)</em> 高级变量。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>有道翻译</strong>：修复无法翻译的Bug，因为 <em>CURL_TIMEOUT</em> 常量未定义。</dd>
	<dt>20 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>伪原创</strong> -&gt; <strong>模拟人工发布</strong>：自动排除重复的标题和自定义字段的文章。</dd>
	<dt>19 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>魔法采集</strong>：所有魔法采集项目外置。</dd>
	<dt>17 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>水印</strong>：<em>忽略GIF动画</em> 升级为 <em>忽略动画</em>，新增对WEBP格式动画进行识别。</dd>
	<dt>15 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>自动保存附件</strong>：修复重复抓取 <em>不在标签中的纯媒体地址</em> 的Bug。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>阿里云机器翻译</strong>：更新SDK，提高兼容性。</dd>
	<dt>14 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong>：新增 <em>MinIO 高性能原生对象存储</em>。</dd>
	<dt>13 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>云存储</strong>：新增 <em>常规模式分流</em>。</dd>
	<dd><strong>自动保存附件</strong>：支持抓取 <em>不在标签中的纯媒体地址</em>。</dd>
	<dt>11 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong>：新增 <em>OneManager云盘系统 (Onedrive)</em>。</dd>
	<dt>10 - <em>v4.0.0 beta3</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong>：新增 <em>Cloudreve云盘系统 (Onedrive)</em>。</dd>
	<dt>6 - <em>v4.0.0 beta2</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>按关键词忽略</strong>：允许和禁止的关键词都已支持 <em>变量</em>。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>选择器</strong>：SDK外置。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>选择器</strong>：移除针对低PHP版本使用的 <strong>simple_html_dom</strong> 库。</dd>
	<dd><strong>水印</strong>：修复 <em>ImageMagick</em> 模块下只开 <em>文字水印</em> 导致的致命错误Bug。</dd>
	<dt>5 - <em>v4.0.0 beta2</em></dt>
	<dd><strong>激活页</strong>：新增 <em>软件开发工具包</em>，可以自动或手动安装SDK。</dd>
	<dt>4 - <em>v4.0.0 beta2</em></dt>
	<dd><strong>伪原创</strong> -&gt; <strong>SEO作弊码</strong> -&gt; <strong>主题模板同质化</strong>：开关独立出 <em>SEO作弊码</em>。</dd>
	<dt>2 - <em>v4.0.0 beta2</em></dt>
	<dd><strong>自动保存附件</strong> -&gt; <strong>过滤</strong> -&gt; <strong>最大图像尺寸</strong>：修复无法缩图的Bug。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong> -&gt; <strong>华为云OBS</strong>：SDK外置。</dd>
	<dd><strong>伪原创</strong> -&gt; <strong>SEO作弊码</strong>：不在pre标签内生成seo作弊码，因为可能会被高亮插件给可视化了。</dd>
	<dt>1- <em>v4.0.0 beta2</em></dt>
	<dd><strong>翻译</strong> -&gt; <strong>阿里云机器翻译</strong>：SDK外置。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>腾讯云机器翻译</strong>：SDK外置。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong> -&gt; <strong>腾讯云COS</strong>：SDK外置。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong> -&gt; <strong>又怕云</strong>：SDK外置。</dd>
</dl>