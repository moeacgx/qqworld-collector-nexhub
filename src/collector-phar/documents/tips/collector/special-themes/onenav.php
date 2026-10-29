<h2>网址自定义字段</h2>
<dl>
	<dt>站点描述</dt>
	<dd>字段名：<em>_sites_sescribe</em><p>可以把 <strong>文章内容</strong> 转换为 <strong>自定义字段</strong>，然后填字段名到 <strong>保存到</strong> 即可。</p></dd>
</dl>
<dl>
	<dt>跳转链接</dt>
	<dd>字段名：<em>_sites_link</em><p>新建 <strong>自定义字段</strong>，用 <strong>字符串</strong> 方法填 <em>{var:link}</em> 到 <strong>方法值</strong>，然后填字段名到 <strong>保存到</strong> 即可。</p></dd>
</dl>
<dl>
	<dt>站点图标</dt>
	<dd>字段名：<em>_thumbnail</em><p>新建 <strong>自定义字段</strong>，用 <strong>字符串</strong> 方法填 <em>{var:featured_image}</em> 到 <strong>方法值</strong>，然后填字段名到 <strong>保存到</strong>，再加上一个 <strong>下载到本地过滤器</strong> 即可。</p></dd>
</dl>
<p class="qc-icon info">注意，如果跳转链接和站点图标获取不到变量，需要将其中一个碎片挪到所有自定义字段上方去优先采集。</p>
<h2>下载资源自定义字段</h2>
<p>由于该主题的下载字段内容过于复杂，多层数组嵌套，无法适配。</p>