<p>景安快云对象存储是高效、稳定、安全、海量、易用、低成本的高可靠分布式云存储服务，提供99.999999999%的数据可靠性。具备标准Restful API接口，可存储任意类型数据。针对资源站、短视频教育站有超高的带宽、IOPS吞吐量、低延时的支持。 BGP多线公网接入，按需付费，支持多种存储类型，满足各类场景的存储需求。。</p>
<h2>设置方法</h2>
<p>去<a href="https://www.zzidc.com/storage/kystorageindex" target="_blank">景安网络</a>注册一个账号，并新建一个对象存储的空间。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/kuaiyun/1.png" /></p>
<p>需要注意的是，如果使用免费域名，就必须自定义上传目录，让整个地址和云存储上的文件地址结构相匹配。</p>
<dl>
	<dt>访问密钥（Access Key）</dt>
	<dd>可在 <strong>会员中心</strong> -&gt; <strong>对象存储</strong> -&gt; <strong>获取Key值</strong>，获取。</dd>
	<dt>私有密钥（Secret Key）</dt>
	<dd>可在 <strong>会员中心</strong> -&gt; <strong>对象存储</strong> -&gt; <strong>获取Key值</strong>，获取。</dd>
	<dt>Voucher 设置（获取凭证）</dt>
	<dd>用户通过 <strong>accesskey</strong> 和 <strong>secretkey</strong> 获取的，可在 <strong>会员中心</strong> -&gt; <strong>对象存储</strong> -&gt; <strong>获取Key值</strong> -&gt;  <strong>获取凭证</strong>，<br />以邮件形式获取。会发送邮件到景安账户邮箱。</dd>
	<dt>Resource 来源参数</dt>
	<dd>API调用来源，可在 <strong>会员中心</strong> -&gt; <strong>对象存储</strong> -&gt; <strong>获取Key值</strong> -&gt; <strong>获取resource（来源）</strong>，点击获取。</dd>
	<dt>空间名</dt>
	<dd>创建 <strong>空间名称</strong> 。示例: qqworld</dd>
</dl>
<p>填好之后保存设置，如果连接成功，系统会给你盖个绿色的章。：）</p>
<h3>同步网站资源</h3>
<p>不要忘记在快云的管理控制台中设置回源地址。</p>
<p><em class="qc-icon info">提示：如果你的网站中包含字体，你需要按照下面所描述的方法做才能上传和访问这些字体：</em></p>
<ol>
	<li>不要勾选请求携带参数（如果有），可能会导致某些图片无法访问。</li>
</ol>
<p>很遗憾的是，快云并没有CROS跨域设置，必须提交工单，把Bucket，CDN域名，源站地址以及访问方法告诉售后添加，非常麻烦。</p>
<p><em class="qc-icon info">如果无法扫描，提示 Internal Server Error 错误，则需要检查 php.ini 里 open_basedir 是否包含了你的网站根目录，如果有就需要删掉。（也可能在你的网站根目录下的 .htaccess 或 .user.ini 文件里。）</em></p>