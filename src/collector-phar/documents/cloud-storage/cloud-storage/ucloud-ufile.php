<p>对象存储（UFile）是为互联网应用提供非结构化文件存储的服务；相对于传统硬盘存储，UFile具有存储无上限、支持高并发访问、成本更低等优势；解决业务架构的文件存储问题，有效降低海量文件的存储成本，支持热点数据的高并发访问，提升终端用户访问体验。</p>
<h2>设置方法</h2>
<p>去<a href="https://www.ucloud.cn/" target="_blank">UCould</a>注册一个账号，并新建一个对象存储UFile的空间。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/ucloud-ufile/1.png" /></p>
<p>先填写UFile的域名和目录，这里表达的是UFile存储里文件的路径格式。</p>
<p>这里不仅可以填UFile提供的免费域名，也可以填写绑定的CDN域名。</p>
<p>然后填写域名后缀、公钥（Public KEY）、密钥（Private Key）和空间名。</p>
<p>填好之后保存设置，如果连接成功，系统会给你盖个绿色的章。：）</p>
<h3>同步网站资源</h3>
<p>不要忘记在对象存储（UFile）的管理控制台中设置回源地址。</p>
<p><em class="qc-icon info">提示：如果你的网站中包含字体，你需要按照下面所描述的方法做才能上传和访问这些字体：</em></p>
<ol>
	<li>不要勾选请求携带参数（如果有），可能会导致某些图片无法访问。</li>
</ol>
<p>很遗憾的是，UFile并没有CROS跨域设置，必须提交工单，把Bucket，CDN域名，源站地址以及访问方法告诉售后添加，非常麻烦。</p>
<p><em class="qc-icon info">如果无法扫描，提示 Internal Server Error 错误，则需要检查 php.ini 里 open_basedir 是否包含了你的网站根目录，如果有就需要删掉。（也可能在你的网站根目录下的 .htaccess 或 .user.ini 文件里。）</em></p>