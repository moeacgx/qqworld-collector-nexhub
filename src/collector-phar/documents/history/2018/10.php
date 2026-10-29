<dl>
	<dt>30日 - <em>v3.0.1 Beta11</em></dt>
	<dd>修复因为引用 QueryList 导致500错误的Bug。</dd>
	<dd><strong>水印</strong>：修复手动抓图无法打水印的Bug。</dd>
	<dd><strong>自动保存附件</strong> -&gt; <strong>过滤</strong> -&gt; <strong>最小图像尺寸</strong>：修改自动删除小图会清除该图片前面的所有图片的Bug。</dd>
	<dt>29日 - <em>v3.0.1 Beta11</em></dt>
	<dd>新增数据库版，包含除了云存储之外的全部功能的版本，适合采集使用。</dd>
	<dd><strong>水印</strong> -&gt; <strong>扫描</strong>：修复无法扫描的Bug。</dd>
	<dt>28日 - <em>v3.0.1 Beta10</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong>：所有过滤器都可以重复添加。</dd>
	<dt>25日 - <em>v3.0.1 Beta10</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>数据转换</strong>：新增Javascript解包，将 <em>eval(function(p,a,c,k,e,d){...})</em> or <em>eval(function(p,a,c,k,e,r){...})</em> 转换为JS明码。</dd>
	<dt>24日 - <em>v3.0.1 Beta10</em></dt>
	<dd><strong>自动保存附件</strong> -&gt; <strong>过滤</strong> -&gt; <strong>最小图像尺寸</strong>：修改为等于该尺寸也会被排除，否则要排除32x32的小图就得设置为33x33了。</dd>
	<dd><strong>激活页</strong> -&gt; <strong>Whois</strong>：修改错误获取域名创建日期的Bug。</dd>
	<dt>23日 - <em>v3.0.1 Beta10</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>数据转换</strong>：新增解码16进制，将 <em>\xe5\x8f\x91\xe7\x94\x9f\xe4\xba\x86\xe9\xa2</em> 转换为中文。</dd>
	<dt>21日 - <em>v3.0.1 Beta9</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong> -&gt; <strong>正则表达式</strong>：支持多个表达式。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集项目</strong> -&gt; <strong>碎片</strong>：新增变量，可被某些过滤器调用。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>变量</strong>：新增索引变量，给数组类型的值使用。</dd>
	<dd><strong>自动锚点</strong> -&gt; <strong>自动标签</strong>：新增检测文章已有的标签数，如果已经超过限制，则不自动设置标签。</dd>
	<dd><strong>自动保存附件</strong>：新增自动补齐"//"打头的图片地址。</dd>
	<dt>20日 - <em>v3.0.1 Beta8</em></dt>
	<dd><strong>设置</strong> -&gt; <strong>HTTP文件头 - 参照地址</strong>：更强的自定义功能，可以破解更多防采集的网站。</dd>
	<dt>19日 - <em>v3.0.1 Beta8</em></dt>
	<dd><strong>翻译</strong>：新增简繁互转（本地）</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>手动采集</strong> -&gt; <strong>排除URL</strong>：修复在采集列表中点排除按钮后获取错误的URL地址保存到排除URL设置中的Bug。</dd>
	<dt>18日 - <em>v3.0.1 Beta7</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong> -&gt; <strong>CSS选择器</strong>：修复PHP7.0以上版本不支持最后一个索引的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集类型</strong> -&gt; <strong>文章链接</strong>：不再对(disallowed)的数据进行绝对地址转换。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong>：不再对(disallowed)的数据进行过滤。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong> -&gt; <strong>索引</strong>：修复最后一个索引无法保存的Bug。</dd>
	<dd><strong>试用版</strong>：新增对限额的监控功能，如果超出限额便提醒用户购买正式版。</dd>
	<dt>16日 - <em>v3.0.1 Beta7</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>处理HTML实体</strong>：新增 &quot; 在 textarea 中的兼容性。</dd>
	<dd><strong>自动保存附件</strong>：修复有些图片的header是 image/jpg，不在允许的格式范围内的bug。</dd>
	<dd><strong>设置</strong> -&gt; <strong>熊掌号</strong>：升级$type的使用方法。</dd>
	<dt>15日 - <em>v3.0.1 Beta7</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>聚合图床</strong>：使用API来输出图片地址。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>阿里云OSS</strong>：新增更详细的检查，以防止填错节点和Bucket。</dd>
	<dt>11日 - <em>v3.0.1 Beta7</em></dt>
	<dd><strong>自动保存附件</strong> -&gt; <strong>特色图片</strong>：修复批量编辑时第一幅带有特色图片会覆盖之后保存的文章的特色图片。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>POST方法</strong>：修复既有\?又有\n时无法正确获取Post内容的Bug。</dd>
	<dt>10日 - <em>v3.0.1 Beta6</em></dt>
	<dd><strong>收藏项目</strong> -&gt; <strong>采集方法</strong> -&gt; <strong>随机数</strong>：修复无法正确输出的Bug</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>已收藏文章</strong>：新增重新采集功能。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>删除数据</strong> -&gt; <strong>按正则表达式过滤</strong>：修复被替换字符中包含"[]"的时候导致出错的Bug。</dd>
	<dd><strong>收藏项目</strong> -&gt; <strong>过滤器</strong> -&gt; <strong>删除数据</strong> -&gt; <strong>按正则表达式过滤</strong>：新增(content)内容替换。</dd>
	<dt>9日 - <em>v3.0.1 Beta6</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>非可控云存储</strong>：新增聚合图床（superbed.cn）。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>又拍云存储</strong>：修复无法使用的Bug。</dd>
	<dd><strong>云存储</strong> -&gt; <strong>非可控云存储</strong>：修复上传文件无法同步的Bug。</dd>
	<dt>8日 - <em>v3.0.1 Beta5</em></dt>
	<dd><strong>自动保存附件</strong> -&gt; <strong>常规设置</strong>：修复无法保存设置第N幅特色图像的Bug。</dd>
	<dt>7日 - <em>v3.0.1 Beta5</em></dt>
	<dd><strong>激活系统</strong>：支持Whois无限版。</dd>
	<dt>1日 - <em>v3.0.1 Beta5</em></dt>
	<dd><strong>云存储</strong> -&gt; <strong>可控云存储</strong>：新增配合同步网站资源使用的自定义替换功能。</dd>
</dl>