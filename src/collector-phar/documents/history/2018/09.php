<dl>
	<dt>30日 - <em>v3.0.1 beta5</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>来源地址采集</strong>：除非勾选了无序采集，否则将倒序采集。</dd>
	<dd><strong>设置</strong> -&gt; <strong>图像</strong> -&gt; <strong>图片压缩选项</strong>：完善扫描功能。</dd>
	<dd><strong>设置</strong> -&gt; <strong>熊掌号</strong>：修复无法推送的Bug。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>格式化</strong>：修复无法删除丢失或无法下载的图像HTML代码的Bug。</dd>
	<dt>28日 - <em>v3.0.1 beta5</em></dt>
	<dd><strong>收藏项目</strong>：新增纠错判断，如果没有填写来源地址，会报错（之前是卡死无反应）。</dd>
	<dt>24日 - <em>v3.0.1 beta5</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong> -&gt; <strong>正则表达式</strong>：新增逻辑非变量。</dd>
	<dt>23日 - <em>v3.0.1 beta4</em></dt>
	<dd><strong>试用系统</strong>：恢复试用，未购买的用户直接激活即可免费试用15天。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>简繁互转</strong>：更新请求地址。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong> -&gt; <strong>正则表达式</strong>：新增前后匹配的变量。</dd>
	<dt>21日 - <em>v3.0.1 beta3</em></dt>
	<dd><strong>自动锚点</strong>：新增将锚点链接写入数据库选项。</dd>
	<dd><strong>导入 &amp; 导出</strong>：新增导出到处功能，方便备份和搬家。</dd>
	<dd><strong>自动保存附件</strong>：修复自定义文章类型下无法使用手动模式的Bug</dd>
	<dt>20日 - <em>v3.0.1 beta2</em></dt>
	<dd><strong>自动锚点</strong>：修复手动锚点无法识别文章中的关键词是否已经有链接而无差别替换的Bug。</dd>
	<dd><strong>自动锚点</strong>：锚点数量限制对手动锚点也有效了。</dd>
	<dd><strong>自动锚点</strong>：手动设置的锚点关键词支持多链接，用 | 隔开，将随机输出。</dd>
	<dt>19日 - <em>v3.0.1 beta2</em></dt>
	<dd><strong>自动锚点</strong> -&gt; <strong>自动标签</strong>：新增批量导入标签功能。</dd>
	<dt>19日 - <em>v3.0.1 beta2</em></dt>
	<dd><strong>自动保存附件</strong>：新增支持 <strong>设置</strong> -&gt; <strong>服务器压力</strong> -&gt; <strong>抓取时间间隔</strong>，以降低服务器压力。</dd>
	<dt>17日 - <em>v3.0.1 beta1</em></dt>
	<dd><strong>云存储</strong>：修复其他非可控云存储可能找不到正确缩略图尺寸的Bug</dd>
	<dd><strong>收藏项目</strong>：新增采集列表时可以看到采集到的回调HTML内容。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>高级请求</strong>：新增自动将解析出的地址进行绝对地址检测，并且将非ASCII字符进行URL编码，防止json_encode失败。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章标题</strong>：采集最后阶段自动清除文章标题里的HTML标签。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong>：修复没有分页时无法使用伪原创的Bug。</dd>
	<dt>16日 - <em>v3.0.1 beta1</em></dt>
	<dd><strong>收藏项目</strong>：新增魔法采集：天猫。</dd>
	<dt>14日 - <em>v3.0.0</em></dt>
	<dd><strong>自动锚点</strong>：修复无法保存自动标签数量的Bug。</dd>
	<dt>12日 - <em>v3.0.0 Beta25</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong>：新增随机数，通常用来生成随机的阅读量保存到自定义字段中去。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong>：新增自定义用户栏目，用于采集作者信息。</dd>
	<dt>11日 - <em>v3.0.0 Beta25</em></dt>
	<dd><strong>收藏项目</strong>：修复自动采集时可能无法设置特色图的Bug。</dd>
	<dd><strong>收藏项目</strong>：修复用户名转拼音时的命名空间错误。</dd>
	<dd><strong>收藏项目</strong>：修复采集作者不兼容多站点模式的Bug（如果主站已经存在的用户，在分站采集时不会新建用户）。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong>：新增伪原创，将段落乱序输出，可能会影响阅读体验。</dd>
	<dt>10日 - <em>v3.0.0 Beta24</em></dt>
	<dd><strong>水印</strong>：修复无法预览水印的Bug。</dd>
	<dd><strong>自动保存附件</strong>：修复自动模式会自动消除空行的Bug。</dd>
	<dd><strong>收藏项目</strong>：修复XPath方法抓取指定内容包含自身标签代码的Bug。</dd>
	<dt>7日 - <em>v3.0.0 Beta24</em></dt>
	<dd><strong>自动保存附件</strong>：修复无法抓取内容类型是 application/octet-stream 的地址。</dd>
	<dd><strong>自动保存附件</strong>：修复无法抓取链接中带有空格的地址。</dd>
	<dt>7日 - <em>v3.0.0 Beta23</em></dt>
	<dd><strong>自动保存附件</strong>：修复可能无法正确获取文章标题作为图片标题和Alt的Bug</dd>
	<dd><strong>收藏项目</strong>：修复定时采集时，从文章中获取特色图片，所有文章的特色图都是一样的Bug。</dd>
	<dd><strong>收藏项目</strong>：修复定时采集时，无法正确获取文章标题作为图片标题和Alt的Bug。</dd>
	<dt>5日 - <em>v3.0.0 Beta22</em></dt>
	<dd><strong>云存储</strong>：新增亚马逊网络服务S3云存储（AWS S3）。</dd>
	<dt>2日 - <em>v3.0.0 Beta21</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>Uclode UFile</strong>：简化设置，去掉了地区域名和Bucket，通过CDN域名自动识别。</dd>
	<dt>1日 - <em>v3.0.0 Beta21</em></dt>
	<dd><strong>自动保存附件</strong>：修复无法抓取网易新闻特色图的Bug。</dd>
	<dd><strong>收藏项目</strong>：修复可能会导致采集时出现500错误的Bug。</dd>
</dl>