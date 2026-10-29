<dl>
	<dt>29日 - <em>v3.0.0 Beta20</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集引擎</strong>：修复QueryList会自动生成 meta 标签导致执行 <em>按选择器过滤</em> 后删除所有内容。</dd>
	<dt>29日 - <em>v3.0.0 Beta19</em></dt>
	<dd><strong>清理</strong> -&gt; <strong>清理文章</strong> -&gt; <strong>空白文章</strong>：增加文章类型控制，避免可能导致附件被清理的Bug。</dd>
	<dd><strong>设置</strong> -&gt; <strong>服务器</strong> -&gt; <strong>HTTP文件头</strong>：修复无法保存的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>下载到本地</strong>：修复错误调用绝对地址函数的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集引擎</strong>：修复一个变量名错误导致无法采集。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>扫描</strong>：修复无法正确识别扫描到的文件数的Bug，不应该使用 <strong>number_format_i18n</strong>。</dd>
	<dd><strong>自动保存附件</strong>：支持file:///协议的图片地址。</dd>
	<dt>28日 - <em>v3.0.0 Beta18</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>按关键词忽略</strong>：新增忽略重复，如果数据库中对应的字段存在相同的值，则忽略整篇文章。<br />注意：仅对 文章内容、文章摘要、文章名 和 自定义字段 有效，文章链接 和 文章标题 会自动忽略。。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>下载到本地</strong>：完善其功能。</dd>
	<dd><strong>云存储</strong>：修复更新静默扫描选项后造成的无法正常扫描的Bug。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>WEBP</strong>：支持使用ImageMagick处理WEBP图片。</dd>
	<dt>27日 - <em>v3.0.0 Beta17</em></dt>
	<dd><strong>环境检测</strong>：修复无法正确检测 file_get_contents 是否有效的Bug。</dd>
	<dd><strong>AJAX内核</strong>：增加纠错系统，防止被其他插件干扰而导致AJAX请求进程终止。</dd>
	<dd><strong>云存储</strong>：增加静默扫描选项，勾选后，在扫描的时候可以关闭当前窗口，不用等待完成。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>翻译文章名（别名）</strong>：增加翻译分类别名和附件文件名。</dd>
	<dt>25日 - <em>v3.0.0 Beta17</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>特色图片</strong>：自动转换绝对地址。</dd>
	<dt>24日 - <em>v3.0.0 Beta16</em></dt>
	<dd><strong>清理</strong> -&gt; <strong>清理文章</strong>：新增批量删除空白文章。</dd>
	<dd><strong>设置</strong>：新增熊掌号自动推送。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong>：自动清理每一行的首尾空格。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong>：修复 <em>&lt;!--more--&gt;</em> 插入位置不对的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong> -&gt; <strong>特色图片</strong>：增加采集标签属性的默认值。</dd>
	<dt>23日 - <em>v3.0.0 Beta15</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章标题</strong>：将去标签的程序放到过滤器执行后。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>翻译文章名</strong>：修复无法保存设置的Bug。</dd>
	<dd><strong>翻译</strong>：为不支持HTML的翻译接口提供剔除标签再翻译功能。</dd>
	<dd><strong>翻译</strong>：新增有道付费翻译。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>翻译文章名</strong>：修复翻译文章名时出错的Bug。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>翻译文章名</strong>：新增截取文章名为指定长度的功能。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>手动模式</strong>：修复不支持页面和自定义文章类型的Bug。</dd>
	<dt>22日 - <em>v3.0.0 Beta14</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章链接</strong>：自动转换绝对地址。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>格式化</strong>：不论是否勾选了自动更名，都会使用文件名结构重命名文件。</dd>
	<dd><strong>自动保存附件</strong>：修复无法输出链接到的地址的Bug。</dd>
	<dd><strong>自动保存附件</strong>：修复无法正确输出宽度和高度导致图说失效的Bug。</dd>
	<dd><strong>自动保存附件</strong>：修复无法正确输出缩略图尺寸的URL的Bug。</dd>
	<dd><strong>伪原创</strong>：新增使用内置词库的开关。</dd>
	<dd><strong>伪原创</strong>：只对公开的文章类型使用伪原创。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>转换Unicode编码</strong>：解决某些服务器上不兼容的Bug。</dd>
	<dd><strong>翻译</strong> -&gt; <strong>简繁互转</strong>：修复手动模式翻译失败的Bug。</dd>
	<dt>21日 - <em>v3.0.0 Beta13</em></dt>
	<dd><strong>收藏项目</strong>：将列表采集和正文采集的新建采集项目的下拉菜单展开方向向上，防止向下时移除窗口导致页面跳动。</dd>
	<dd><strong>收藏项目</strong>：修复无法保存采集到的标签的Bug。</dd>
	<dd><strong>自动保存附件</strong>：修复当链接的图片比链接内部的图片大的时候抓取不能正常替换内容的Bug。</dd>
	<dd><strong>云存储</strong>：新增可自定义媒体库图片上传目录的开关，默认情况下是关闭的，会上传到 <em>wp-content/uploads</em>，（这个默认目录是可以用WP接口修改）。</dd>
	<dt>20日 - <em>v3.0.0 Beta12</em></dt>
	<dd><strong>自动保存附件</strong>：修复采集WP网站的图片会产生重复Class内容的Bug。</dd>
	<dd><strong>自动保存附件</strong>：修复如果碰到采集失败时导致卡住的Bug。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>手动模式</strong>：修复在可视化编辑器状态下会导致最后一张图覆盖前面的所有内容的Bug。</dd>
	<dd><strong>采集防盗链</strong>：增强采集防盗链的能力。</dd>
	<dd><strong>激活</strong>：修复云存储版无法使用水印和翻译的Bug</dd>
	<dt>19日 - <em>v3.0.0 Beta11</em></dt>
	<dd><strong>云存储</strong>：给各云存储的参数自动去空格，防止填错。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>同步网站资源</strong>：新增无法正常扫描的Bug（路径计算错误）。</dd>
	<dd><strong>自动保存附件</strong>：增加检测iframe的src中的视频。</dd>
	<dd><strong>伪原创</strong>：修复启动后无法发表新文章的Bug。</dd>
	<dt>18日 - <em>v3.0.0 Beta10</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>百度BOS云存储</strong>：新增地区香港和苏州。</dd>
	<dd><strong>自动保存附件</strong>：修复抓取应用和文本类型的速度慢的Bug。</dd>
	<dt>17日 - <em>v3.0.0 Beta9</em></dt>
	<dd><strong>自动保存附件</strong>：修复无法抓取阿里云OSS图片的Bug（获取到的文件类型居然是images/jpeg）。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong> -&gt; <strong>文章链接 和 文章内容的分页</strong>：增加采集标签属性的默认值。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>阿里云OSS</strong>：升级云缩略图功能。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>七牛云存储</strong>：新增云缩略图功能。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>腾讯云COS云存储</strong>：新增云缩略图功能。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>又拍云存储</strong>：新增云缩略图功能。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>百度BOS云存储</strong>：新增云缩略图功能。</dd>
	<dt>16日 - <em>v3.0.0 Beta8</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>定时采集</strong>：修复无法保存自定义分类法的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>定时采集</strong>：修复定时保存时间间隔无法生效的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>内容格式化</strong>：新增备注功能，方便帮助自己介绍该内容格式化是什么内容。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>内容格式化</strong>：如果获取不到关键词，则清空当前内容。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>文章内容</strong>：修复获取到的分页链接是 # 时导致死循环的Bug。</dd>
	<dd><strong>云存储</strong>：修复在 <strong>自动保存附件</strong> -&gt; <strong>不使用媒体库</strong> 的情况下无法同步的Bug。</dd>
	<dt>15日 - <em>v3.0.0 Beta7</em></dt>
	<dd><strong>收藏项目</strong>：修复无法通过关键词排除要采集的文章的Bug。</dd>
	<dd><strong>收藏项目</strong>：为从列表页采集内容增加碎片类型。</dd>
	<dd><strong>产品激活</strong>：修复不兼容Windows服务器的Bug。</dd>
	<dt>14日 - <em>v3.0.0 Beta6</em></dt>
	<dd><strong>自动保存附件</strong>：修复无法排除小尺寸的图的Bug。</dd>
	<dd><strong>自动保存附件</strong>：修复无法自动设置特色图的Bug。</dd>
	<dt>13日 - <em>v3.0.0 Beta5</em></dt>
	<dd><strong>自动保存附件</strong>：修复无法抓取复杂的带有URL参数的图片地址的Bug。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>扫描文章</strong>：修复自动扫描出现500错误的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>定时采集</strong>：修复定时采集无法保存分类法的Bug。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>腾讯云COS</strong>：修复V3连接的BUG（话说应该没人用V3了吧）。</dd>
	<dd><strong>云存储</strong>：支持回源镜像同步网站资源文件。</dd>
	<dt>12日 - <em>v3.0.0 Beta4</em></dt>
	<dd><strong>收藏项目</strong>：完善从正文页采集内容的高级请求。</dd>
	<dd><strong>收藏项目</strong>：修复多组来源地址采集卡住的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集设置</strong>：新增随机排序保存。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集设置</strong>：修复因为各行间的 \r 字符导致无法匹配排除链接的Bug。</dd>
	<dt>11日 - <em>v3.0.0 Beta3</em></dt>
	<dd><strong>收藏项目</strong>：为每一个来源地址添加标题，以方便知道该来源链接组所采集的内容。</dd>
	<dd><strong>云存储</strong>：提供接口可以将云缩略图的尺寸写死。</dd>
	<dt>10日 - <em>v3.0.0 Beta2</em></dt>
	<dd><strong>设置</strong> -&gt; <strong>禁止缩略图尺寸</strong>：新增禁止缩略图尺寸功能，可以选择要禁用的尺寸。</dd>
	<dd><strong>收藏项目</strong>：修复无法记录采集文章的源地址的bug，该bug导致采集前期无法排重。</dd>
	<dd><strong>自动保存附件</strong>：修复管理页 - 格式化 - 文件名来源及其优先级 各项目无法用鼠标拖拽的Bug。</dd>
	<dd><strong>自动保存附件</strong>：修复无法抓取301或302转向的图片地址的bug。</dd>
	<dd><strong>自动保存附件</strong>：修复在编辑器可视化模式下手动保存图片导致最后一幅图片前的所有代码丢失的Bug。</dd>
	<dd><strong>收藏项目</strong>：新增无法抓取并设置特色图的Bug。</dd>
	<dt>9日 - <em>v3.0.0 Beta1</em></dt>
	<dd><strong>云存储</strong>：修复扫描错误。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>阿里云OSS</strong>：新增云缩略图功能。</dd>
</dl>