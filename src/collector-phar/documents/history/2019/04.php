<dl>
	<dt>30日 - <em>v3.2.0 beta1</em></dt>
	<dd><strong>云存储</strong>：新增聚合云存储。</dd>
	<dd><strong>自动锚点</strong> -&gt; <strong>保存到数据库</strong>：记录已经保存了多少个锚点，如果没有超过，还可以再次保存。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>常规</strong>：新增批量设置特色图片和清除特色图片。</dd>
	<dt>29日 - <em>v3.1.2 beta5</em></dt>
	<dd><strong>自动保存附件</strong> -&gt; <strong>常规</strong> -&gt; <strong>不使用媒体库</strong>：修复无法刷新缓存的Bug。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>常规</strong> -&gt; <strong>不使用媒体库</strong>：修复强制给Gif图片加水印的Bug。</dd>
	<dd><strong>设置</strong> -&gt; <strong>收藏项目</strong>：新增检测重复标题开关。</dd>
	<dt>26日 - <em>v3.1.2 beta5</em></dt>
	<dd><strong>云存储</strong>：新增 <strong>上传时覆盖云存储上的已存在文件</strong> 开关。</dd>
	<dt>22日 - <em>v3.1.2 beta5</em></dt>
	<dd><strong>翻译</strong> -&gt; <strong>谷歌付费翻译</strong>：修复印度旁遮普语的代码 <em>ma</em> 为 <em>pa</em>。</dd>
	<dd><strong>核心</strong> -&gt; <strong>脚本</strong>：修复浮动面板会重复启用导致一些按钮重复执行的Bug。</dd>
	<dt>20日 - <em>v3.1.2 beta5</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>内容格式化</strong>：内容结构支持 <strong>(content)</strong> 变量。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>自动改名，获取文章标题</strong>：兼容5.0编辑器。</dd>
	<dd><strong>自动保存附件</strong>：有些 Header里的文件类型是大写的，会导致判断失误。</dd>
	<dt>19日 - <em>v3.1.2 beta5</em></dt>
	<dd><strong>自动保存附件</strong> -&gt; <strong>Custom Upload Dir</strong>：兼容5.0编辑器。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong>：优化了执行速度。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>内容格式化</strong>：把内容结构的 <em>input</em> 改为 <em>textarea</em>，以支持HTML标签。</dd>
	<dt>18日 - <em>v3.1.2 beta5</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>已收藏的文章</strong>：修复重新采集导致文章状态变为草稿的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>已收藏的文章</strong>：修复高级选项中无法保存每页显示的文章数的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>分类法</strong>：修复不兼容字符串转数组过滤器的Bug。</dd>
	<dt>17日 - <em>v3.1.2 beta4</em></dt>
	<dd><strong>核心</strong>：支持子域名激活。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>导入链接</strong>：修复文章链接导入出错的Bug。</dd>
	<dt>16日 - <em>v3.1.2 beta3</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>伪原创</strong>：新增段落重组类型。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong>：新增插入模板过滤器。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>列表</strong>：加速计算已采集的文章数量。</dd>
	<dt>15日 - <em>v3.1.2 beta2</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong>：修复如果采集到的内容为空依然进行过滤的Bug。</dd>
	<dd><strong>伪原创</strong>：移除内置词库，新增内容选择和自动模式。</dd>
	<dt>14日 - <em>v3.1.2 beta2</em></dt>
	<dd><strong>代理服务器</strong>：完全移除动态代理，修复数无法使用除HTTP代理之外的代理方式的Bug。</dd>
	<dt>12日 - <em>v3.1.2 beta2</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>列表</strong>：修复无法筛选收藏项目分类的Bug。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>简繁互转（本地）</strong>：禁止翻译链接中的字符。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>翻译文章名</strong>：将翻译后仍保留的空格自动转换为-。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>翻译分类别名 (Slug)</strong>：将翻译后仍保留的空格自动转换为-。</dd>
	<dt>11日 - <em>v3.1.2 beta1</em></dt>
	<dd><strong>收藏项目</strong>：新增定时采集设置，可以批量错开设置定时采集任务。</dd>
	<dd><strong>收藏项目</strong>：新增可以设置收藏项目发布状态，未发布的收藏项目将被排除在批量设置定时采集任务之外。</dd>
	<dd><strong>云存储</strong>：修复重复处理云存储地址导致出错的Bug。</dd>
	<dt>10日 - <em>v3.1.2 beta1</em></dt>
	<dd><strong>自动保存附件</strong>：修复云存储版下仍然会执行抓图程序导致出错的Bug。</dd>
	<dt>9日 - <em>v3.1.2 beta1</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>滤镜</strong> -&gt; <strong>字符串转数组</strong>：新增类型切换脚本。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>定时采集</strong>：修复无法获取正在采集的状态的Bug。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>新浪图床</strong>：新增自动获取Cookie。</dd>
	<dt>7日 - <em>v3.1.1 beta7</em></dt>
	<dd><strong>自动锚点</strong> -&gt; <strong>自动标签</strong>：去掉检测标签名是否在标签内的Bug。</dd>
	<dt>6日 - <em>v3.1.1 beta7</em></dt>
	<dd><strong>翻译</strong> -&gt; <strong>免费谷歌翻译</strong>：升级到最新版。</dd>
	<dt>5日 - <em>v3.1.1 beta7</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>清除HTML标签</strong>：修复不兼容PHP7.x+的bug</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>按选择器清除</strong>：修复不兼容PHP7.x+的bug</dd>
	<dt>4日 - <em>v3.1.1 beta7</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong>：增加伪静态过滤器，结合替换关键词、随机字符串、随机段落预设。</dd>
	<dt>3日 - <em>v3.1.1 beta7</em></dt>
	<dd><strong>核心</strong> -&gt; <strong>相对地址转绝对地址</strong>：修复相对地址重组的Bug，有些列表地址是.html结尾的，必须删掉。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong> -&gt; <strong>字符串</strong>：增加随机字符串功能。</dd>
	<dd><strong>伪静态</strong>：增加随机字符串预设和随机段落预设。</dd>
	<dt>1日 - <em>v3.1.1 beta6</em></dt>
	<dd><strong>水印</strong>：修复检测水印使用场景的Bug。</dd>
	<dd><strong>设置</strong> -&gt; <strong>服务器</strong> -&gt; <strong>速度</strong>：增加超高性能服务器的速度选项。</dd>
</dl>