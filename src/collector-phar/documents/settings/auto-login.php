<p>有些网站需要频繁更换Cookie，使用自动登录功能会比较方便自动更换Cookie。</p>
<p><em class="qc-icon info">如果登录某些网站需要填验证码，请直接放弃。</em></p>
<h1>设置详解</h1>
<p>点击 <strong>添加站点</strong> 按钮，会新建一个表单。</p>
<h2>标题</h2>
<p>用于在收藏项目的采集设置中快速识别要自动登录的网站。</p>
<h2>请求URL</h2>
<p>请输入登陆表单的action地址。</p>
<h2>请求页头（Headers）</h2>
<p>通常留空即可。</p>
<h2>过期</h2>
<p>自动获取的Cookie的缓存时间，逾期则重新登录并再次获取Cookie。<br /><em class="qc-icon info">如果有些网站不需要频繁更换，可以设置长一点。</em></p>
<h2>表单字段</h2>
<h3>字段类型</h3>
<dl>
	<dt>表单数据</dt>
	<dd>最常见的方式，通过表单提交的数据。</dd>
	<dt>原始数据</dt>
	<dd>有些登录方式是AJAX的，提交的内容类似 <em>{"username":"用户名","password":"密码"}</em>，就需要用这种方法。</dd>
</dl>
<p>通常只需要用户名和密码。</p>
<h1>如何获取表单参数</h1>
<h3>准备工作</h3>
<p>首先打开登录表单，填写错误的登录信息。</p>
<h3>开发者工具</h3>
<p>按 <strong>F12</strong> 开启 <strong>开发者工具</strong>，切换到 <em>Network</em> 选项，勾选上方的 <em>Preserve log</em>。</p>
<h3>登录</h3>
<p>点击登录按钮，在 <em>Network</em> 列表中会显示所有请求，在 <em>Name</em> 列表找到正确的请求项目，就可以获取到 <strong>请求URL</strong> 和 <strong>表单字段</strong>。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>settings/auto-login/1.png" /></p>
<p>其中 <strong>Request URL</strong> 就是 <strong>请求URL</strong>，最下面的 <strong>Form Data</strong> 就是 <strong>表单字段</strong>，如果是 <strong>Request Payload</strong> 则要使用 <strong>原始数据</strong>。</p>
<p><em class="qc-icon info">注意，最下面的 <strong>btn-save</strong> 是空值，通常不需要设置。</em></p>