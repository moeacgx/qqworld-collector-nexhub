<dl>
	<dt>31日 - <em>v3.2.3 beta4</em></dt>
	<dd><strong>自动锚点</strong> -&gt; <strong>自动标签</strong>：修复无法批量编辑的Bug。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>翻译文章名（Slug）</strong>：修复无法批量编辑的Bug。</dd>
	<dt>30日 - <em>v3.2.3 beta4</em></dt>
	<dd><strong>翻译</strong>：新增阿里云机器翻译。</dd>
	<dt>29日 - <em>v3.2.3 beta4</em></dt>
	<dd><strong>核心</strong>：增强采集证书有问题的https站点的能力。</dd>
	<dd><strong>云存储</strong>：增加过滤器不允许在主机名里填入目录，只能填域名。</dd>
	<dt>27日 - <em>v3.2.3 beta4</em></dt>
	<dd><strong>自动保存附件</strong> -&gt; <strong>常规</strong> -&gt; <strong>自动模式</strong>：修复会自动去转义的Bug（但有可能导致其他问题，待证实）。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>重新采集</strong>：可以切换收藏项目，防止某些收藏项目被删导致无法重新采集。</dd>
	<dd><strong>收藏项目</strong>：非发布状态自动清除可能存在的定时采集任务。</dd>
	<dd><strong>核心</strong>：支持 Memcached。</dd>
	<dd><strong>自动锚点</strong> -&gt; <strong>自动标签</strong>：新增自动分词系统。</dd>
	<dt>26日 - <em>v3.2.3 beta4</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>高级功能</strong>：新增WordPress过滤器。</dd>
	<dt>25日 - <em>v3.2.3 beta3</em></dt>
	<dd><strong>翻译</strong> -&gt; <strong>免费谷歌翻译</strong>：更换新翻译类。</dd>
	<dt>23日 - <em>v3.2.3 beta3</em></dt>
	<dd><strong>自动保存附件</strong>：修复无法正确处理丢失的图片的Bug。</dd>
	<dt>22日 - <em>v3.2.3 beta3</em></dt>
	<dd><strong>设置</strong> -&gt; <strong>调试</strong>：新增伪原创。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集设置</strong> -&gt; <strong>时间间隔</strong>：修复无效的Bug。</dd>
	<dt>21日 - <em>v3.2.3 beta3</em></dt>
	<dd><strong>伪原创</strong> -&gt; <strong>自动模式</strong>：新增两种接口。</dd>
	<dt>20日 - <em>v3.2.3 beta2</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>清除HTML标签属性</strong> -&gt; <strong>清除所有标签属性</strong>：不清理img和href的属性</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong>：默认清除HTML注释，可以用 <em>add_filter('qqworld-collector-wipe-tag-comment-from-post-content', '__return_false');</em> 关闭。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong>：默认清除内联JS脚本，可以用 <em>add_filter('qqworld-collector-wipe-script-from-post-content', '__return_false');</em> 关闭。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong>：默认清除空标签，可以用 <em>add_filter('qqworld-collector-wipe-empty-tags-from-post-content', '__return_false');</em> 关闭。</dd>
	<dt>19日 - <em>v3.2.3 beta2</em></dt>
	<dd><strong>云存储</strong>：新增编辑页开关。</dd>
	<dt>18日 - <em>v3.2.3 beta2</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>高级请求</strong>：新增 <em>(f:urlencode:*)</em> 函数变量。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>百度翻译</strong>：修复不支持https站点的bug。</dd>
	<dt>17日 - <em>v3.2.3 beta2</em></dt>
	<dd><strong>翻译</strong> -&gt; <strong>翻译文章名</strong>：可以自动判断是调用Google免费翻译或Google翻译。</dd>
	<dd><strong>水印</strong> -&gt; <strong>文字水印</strong>：修复无法启用背景马赛克的Bug。</dd>
	<dt>15日 - <em>v3.2.3 beta2</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>内容格式化</strong>：双行链接自动转POST方式。</dd>
	<dd><strong>设置</strong> -&gt; <strong>熊掌号</strong>：修复采集时不推送的Bug。</dd>
	<dt>13日 - <em>v3.2.3 beta1</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong>：默认清除链接，可以用 <em>add_filter('qqworld-collector-wipe-links-from-post-content', '__return_false');</em> 关闭。</dd>
	<dt>12日 - <em>v3.2.3 beta1</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>定时采集</strong>：新增排队线性定时采集。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集设置</strong>：新增文章限制设置，限制每一个来源地址设置可以采集的文章最大数目。</dd>
	<dt>11日 - <em>v3.2.3 beta1</em></dt>
	<dd><strong>翻译</strong> -&gt; <strong>翻译文章名（别名）</strong>：增强对采集的支持。</dd>
	<dt>10日 - <em>v3.2.3 beta1</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>魔法采集</strong> -&gt; <strong>天猫</strong>：增强对商品描述采集的正确率。</dd>
	<dt>9日 - <em>v3.2.3 beta1</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong>：新增华为云对象存储服务（OBS）。</dd>
	<dt>7日 - <em>v3.2.2 beta5</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集内容（从列表页）</strong>：修复前端采集的Bug。</dd>
	<dt>6日 - <em>v3.2.2 beta5</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>聚合模式</strong>：新增URL样式。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>按选择器过滤 &amp; 清除HTML标签</strong>：修复不支持PHP5.x的Bug。</dd>
	<dt>5日 - <em>v3.2.2 beta5</em></dt>
	<dd><strong>自动保存附件</strong> -&gt; <strong>自动模式</strong>：古腾堡编辑器下保存文章，即使没有远程图片，也会自动格式化区块。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>聚合模式</strong>：禁止输出full结尾的地址。</dd>
	<dd><strong>伪原创</strong>：更新接口。</dd>
	<dd><strong>环境</strong>：新增物理内存检测。</dd>
	<dt>4日 - <em>v3.2.2 beta5</em></dt>
	<dd><strong>收藏项目</strong>：优化手动采集记录最后采集时间的程序。</dd>
	<dt>3日 - <em>v3.2.2 beta4</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>聚合模式</strong>：聚合地址以 <em>.jpg</em> 结尾以模拟真实的图片地址，可以兼容灯箱程序。</dd>
	<dt>1日 - <em>v3.2.2 beta4</em></dt>
	<dd><strong>自动保存附件</strong> -&gt; <strong>批量设置特色图</strong>：新增强制扫描所有文章的开关。</dd>
</dl>