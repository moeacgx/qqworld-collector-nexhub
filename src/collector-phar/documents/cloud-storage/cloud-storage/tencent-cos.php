<p>腾讯云对象存储（Cloud Object Storage，COS）是腾讯云为企业和个人开发者们提供的一种能够存储海量数据的分布式存储服务，用户可随时通过互联网对您的大量数据进行批量存储和处理。腾讯云 COS 具有高扩展性、低成本、可靠和安全等特点，能为您提供专业的数据存储服务。您可以使用控制台、API、SDK 等多种方式连接到腾讯云对象存储，实时存储和管理您的业务数据。</p>
<p>如果你使用腾讯云的服务器，腾讯云COS可以作为你的首选。</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#video-course--cloud-storage--tencent-cos'); ?>" target="_blank" class="button button-primary button-large qc-icon link">视频教程</a></p>
<h2>设置方法</h2>
<p>去<a href="https://cloud.tencent.com" target="_blank">腾讯云</a>注册一个账号，或者直接用你的QQ号登录，什么？你没有QQ号？噗——！</p>
<p>登录后，新建一个对象存储的空间，注意腾讯云COS比较坑的地方在于，它有好几个版本，从最开始的V3已经到最新的V5，今后可能还有V678什么的，在设置之前要搞清楚你的版本，否则可能会导致程序崩溃。</p>
<p>大概的特征是V3的空间名叫Bucket，V4的标题有版本号最好识别，V5的空间名叫做存储桶。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/tencent-cos/1.png" /></p>
<p>先填写COS的域名和目录，这里表达的是COS对象存储里文件的路径格式。</p>
<p>这里不仅可以填COS提供的免费域名，也可以填写绑定的CDN域名。</p>
<p>然后选择版本，地区，并填写APP ID、secretID、secretKey和Bucket（空间名，或叫做存储桶）。</p>
<p>填好之后保存设置，如果连接成功，系统会给你盖个绿色的章。：）</p>
<h3>云缩略图</h3>
<p>不使用媒体库的缩略图，只会生成和同步完整尺寸，其他缩略图尺寸将由云存储自动生成。</p>
<p>需要使用腾讯云的<a href="https://cloud.tencent.com/product/ci" target="_blank">万象优图</a>。</p>
<p>建议不要在 <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings'); ?>" target="_blank">设置</a> 中 <strong>禁用缩略图尺寸</strong>，也不要在 <a href="<?php print admin_url('admin.php?page=qqworld-collector-auto-save-attachment'); ?>" target="_blank">自动保存附件</a> 中勾选 <strong>不使用媒体库</strong>，因为会有兼容性问题。</p>
<h3>同步网站资源</h3>
<p>不要忘记在腾讯云对象存储COS的管理控制台中设置回源地址。</p>
<ol>
	<li>不要勾选请求携带参数（如果有），可能会导致某些图片无法访问。</li>
</ol>
<p><em class="qc-icon info">提示：如果你的网站中包含字体，你需要按照下面所描述的方法做才能上传和访问这些字体：</em></p>
<ol>
	<li>在CORS设置中新建规则，填上你的网站首页URL，并至少勾选GET方法。</li>
	<li>可能需要将你的网站域名添加到防盗链白名单中。</li>
</ol>
<p><em class="qc-icon info">如果无法扫描，提示 Internal Server Error 错误，则需要检查 php.ini 里 open_basedir 是否包含了你的网站根目录，如果有就需要删掉。（也可能在你的网站根目录下的 .htaccess 或 .user.ini 文件里。）</em></p>