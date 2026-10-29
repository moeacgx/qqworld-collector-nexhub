<dl>
	<dt>31日 - <em>v3.3.1 beta3</em></dt>
	<dd><strong>静态缓存</strong>：支持压缩HTML。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong>：修复输入的方法值为0时会当作空值忽略的Bug。</dd>
	<dt>30日 - <em>v3.3.1 beta3</em></dt>
	<dd><strong>远程发布</strong>：修复无法正确显示已经采集了多少文章的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>导入链接</strong> -&gt; <strong>文章链接</strong>：修复因脚本错误导致无法更新采集到的内容到项目的Bug。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>聚合模式</strong> -&gt; <strong>测速</strong>：如果所有的云存储地址都无法访问，则调用本地地址。</dd>
	<dt>29日 - <em>v3.3.1 beta3</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>收藏项目列表</strong> -&gt; <strong>远程发布</strong>：修复推送到百度链接的接口调用错误的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>内容格式化</strong>：新增 <em>(*)</em> 变量，可循环输出内容。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>魔法采集</strong>：新增 <em>搜款网（vvic.com）</em></dd>
	<dd><strong>核心</strong>：自动创建新用户时，昵称不在赋值登录名，和显示名保持一致，因为有些主题优先显示昵称。</dd>
	<dt>28日 - <em>v3.3.1 beta2</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>收藏项目列表</strong> -&gt; <strong>定时采集设置</strong>：新增 <em>手动模式</em> 和 <em>自动模式</em>，支持无限循环手动批量采集。</dd>
	<dt>27日 - <em>v3.3.1 beta2</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>收藏项目列表</strong> -&gt; <strong>批量处理</strong>：新增 <em>采集</em> 菜单。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong> -&gt; <strong>清理</strong>：修复 <em>清理空标签</em> 会删除视频HTML的Bug。</dd>
	<dt>26日 - <em>v3.3.1 beta2</em></dt>
	<dd><strong>设置</strong> -&gt; <strong>百度</strong> -&gt; <strong>链接提交</strong>：支持 <em>MIP</em>。</dd>
	<dd><strong>静态缓存</strong>：自动模式只在发布文章时才生成缓存。</dd>
	<dt>25日 - <em>v3.3.1 beta2</em></dt>
	<dd><strong>伪原创</strong>：新增 <strong>小狗AI+</strong> 付费伪原创接口。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>不可控云存储</strong> -&gt; <strong>新浪图床</strong>：设置为 <em>不可用</em>。</dd>
	<dt>24日 - <em>v3.3.1 beta2</em></dt>
	<dd><strong>远程发布</strong> -&gt; <strong>初始化</strong>：如果只有1个远程站点，则自动选择。</dd>
	<dd><strong>设置</strong> -&gt; <strong>百度</strong>：如果开启远程站点，则只推送远程地址。</dd>
	<dd><strong>设置</strong> -&gt; <strong>百度</strong>：修复远程推送时无法推送URL到百度和熊掌号的Bug。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>扫描文章</strong>：修复无法获取分类目录的Bug。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>核心</strong>：修复接口钩子优先级错乱的Bug。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>不可控云存储</strong>：因为需要登录才能上传，所以移除 <em>京东CDN</em>。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>不可控云存储</strong>：修复 <em>SM.MS图床</em> 无法上传的Bug。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>不可控云存储</strong>：移除 <em>简单图床</em>。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>不可控云存储</strong>：因图床网站关闭，移除 <em>68图床</em>。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>不可控云存储</strong>：因uuid密钥加密，移除 <em>牛图网图床</em>。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>不可控云存储</strong>：因图床网站关闭，移除 <em>Upload.cc图床</em>。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>不可控云存储</strong> -&gt; <em>聚合图床</em>：更新 <em>API地址</em>。</dd>
	<dt>22日 - <em>v3.3.1 beta2</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>魔法采集</strong>：挪到 <em>采集设置</em> 里并优化性能。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>魔法采集</strong>：新增 <em>很赞（henzan.com）</em></dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>魔法采集</strong>：新增 <em>买买买（just998.com）</em></dd>
	<dt>21日 - <em>v3.3.1 beta2</em></dt>
	<dd><strong>自动锚点</strong>：更换标签库缓存，每10分钟更新一次。</dd>
	<dt>20日 - <em>v3.3.1 beta2</em></dt>
	<dd><strong>远程发布</strong>：新增控制面板。</dd>
	<dd><strong>远程发布</strong> -&gt; <strong>控制面板</strong>：支持百度链接提交。</dd>
	<dd><strong>远程发布</strong> -&gt; <strong>控制面板</strong>：支持百度熊掌号提交。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>翻译文章名（别名）</strong>：修复无法保存 <em>在发布文章时自动将附件文件名转换为拼音或翻译为英文</em> 设置的Bug。</dd>
	<dt>18日 - <em>v3.3.1 beta2</em></dt>
	<dd><strong>远程发布</strong> -&gt; <strong>高级远程发布</strong>：修复推送文章后无法定时推送和文章有关的分类法的Bug。</dd>
	<dt>16日 - <em>v3.3.1 beta1</em></dt>
	<dd><strong>远程发布</strong> -&gt; <strong>高级远程发布</strong>：移除 <em>SFTP</em> 类型，因为无法更换目录。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>手动模式</strong>：修复如果图片不存在依然会格式化图片代码的Bug。</dd>
	<dd><strong>远程发布</strong> -&gt; <strong>高级远程发布</strong>：修复发布的文件编码不是UTF-8的Bug。</dd>
	<dd><strong>远程发布</strong> -&gt; <strong>高级远程发布</strong>：修复不支持中文地址的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong> -&gt; <strong>清理</strong>：升级自动清理空标签的功能。</dd>
	<dd><strong>水印</strong> -&gt; <strong>上传</strong>：新增开关控制上传时是否打水印。</dd>
	<dt>15日 - <em>v3.3.1 beta1</em></dt>
	<dd><strong>设置</strong> -&gt; <strong>自动登录</strong>：完善检测功能，如果只采集到1条Cookie，则警告用户可能无效。</dd>
	<dd><strong>静态缓存</strong> -&gt; <strong>智能刷新</strong>：修复搜索页脚本错误导致无法再次搜索的Bug。</dd>
	<dd><strong>静态缓存</strong> -&gt; <strong>智能刷新</strong>：修复在未开启静态缓存的情况下，开启智能刷新就会在编辑列表页出现批量更新缓存菜单的Bug。</dd>
	<dt>14日 - <em>v3.3.1 beta1</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>远程发布</strong> -&gt; <strong>WordPress</strong>：可控制 <em>XMLRPC</em> 发送的超时时间，默认的15秒太短了。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章摘要</strong>：在运行过滤器之后自动去除内容中的标签。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong>：新增延迟加载，只需要输入标签属性即可自动将经过延迟加载预处理的图片HTML过滤为可正常显示的图片代码。</dd>
	<dt>13日 - <em>v3.3.1 beta1</em></dt>
	<dd><strong>自动保存附件</strong>：修复手动模式无法抓取 <em>base64</em> 图片的Bug。</dd>
	<dd><strong>收藏项目</strong>：支持通过 <em>FTP</em> 高级远程发布方式发布到纯静态远程站点。</dd>
	<dt>12日 - <em>v3.3.1 beta1</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>设置</strong>：如果选择了非 <em>Wordpress</em> 远程发布站点，则自动将文章发布状态设置为已发布，否则无法计算固定链接路径。</dd>
	<dt>11日 - <em>v3.3.1 beta1</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>测试采集内容（从正文页）</strong>：修复输出测试结果的HTML标签未收尾的Bug，虽然表面上看不出来。</dd>
	<dt>10日 - <em>v3.3.1 beta1</em></dt>
	<dd><strong>自动保存附件</strong>：修复本地抓取 <em>file:///</em> 协议的文件出错的Bug。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>转换文件格式</strong>：转 <em>JPEG</em> 格式自动白底。</dd>
	<dd><strong>核心</strong>：修复之前为兼容 <em>IPv6</em> 服务器而产生的导致网站运行速度超慢的Bug。</dd>
	<dt>9日 - <em>v3.3.1 beta1</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>自动登录</strong>：和所有请求方法对接。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集来源地址</strong>：修复重复策略变量未定义的Bug。</dd>
	<dt>8日 - <em>v3.3.1 beta1</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集设置</strong>：新增自动登录选项。</dd>
	<dt>7日 - <em>v3.3.1 beta1</em></dt>
	<dd><strong>自动锚点</strong> -&gt; <strong>自动标签</strong>：新增可以什么时候添加自动标签的设置。</dd>
	<dd><strong>设置</strong> -&gt; <strong>图片压缩</strong>：新增媒体库列表页批量压缩。</dd>
	<dd><strong>设置</strong>：新增自动登录网站设置，为需要经常更换Cookies的项目提供自动服务。</dd>
	<dt>6日 - <em>v3.3.0 beta5</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong>：修复众多无设置过滤器无法禁用的Bug。</dd>
	<dt>5日 - <em>v3.3.0 beta5</em></dt>
	<dd><strong>核心</strong>：新增辅助设置。</dd>
	<dd><strong>伪原创</strong> -&gt; <strong>SEO作弊器</strong>：新增位移设置，文章靠前的70个字符不添加seo作弊码。</dd>
	<dt>4日 - <em>v3.3.0 beta5</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>按正则表达式过滤</strong>：修复不支持特殊变量写法的Bug。</dd>
	<dd><strong>设置</strong> -&gt; <strong>图像</strong> -&gt; <strong>图片压缩选项</strong>：开启后，在保存远程附件的时候，如果没有缩图或打水印，依然会执行一次压缩图片程序。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong> -&gt; <strong>正则表达式</strong>：新增逻辑或变量 (o:1:x)，仅匹配单个字符，用于特殊定位。</dd>
	<dt>3日 - <em>v3.3.0 beta5</em></dt>
	<dd><strong>静态缓存</strong>：新增删除文章或分类时自动清除相关缓存。</dd>
	<dt>2日 - <em>v3.3.0 beta5</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>获取来源地址</strong>：支持选择性按标题或URL排除重复，防止过滤掉一些相同标题的文章。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>转换文件类型</strong>：修复无法转换的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>获取真实地址</strong>：增强可以获取多次跳转的地址的功能。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>测试采集内容</strong>：如果用户输入的测试链接不完整，发出警告。</dd>
</dl>