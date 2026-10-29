<p>百度云BOS提供稳定、安全、高效、高可扩展的云存储服务。您可以将任意数量和形式的非结构化数据存入BOS，并对数据进行管理和处理。BOS支持标准、低频、冷存储等多种存储类型，满足您各类场景的存储需求。</p>
<p>如果你是用百度云的服务器，可以考虑将百度对象存储BOS做为首选。</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#video-course--cloud-storage--baidu-bos'); ?>" target="_blank" class="button button-primary button-large qc-icon link">视频教程</a></p>
<h2>设置方法</h2>
<p>去<a href="https://cloud.baidu.com" target="_blank">百度云</a>注册一个账号，并新建一个对象存储的空间。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/baidu-bos/1.png" /></p>
<p>先填写百度云BOS的域名和目录，这里表达的是百度云BOS存储里文件的路径格式。</p>
<p>这里不仅可以填百度云BOS提供的免费域名，也可以填写绑定的CDN域名。</p>
<p>然后填写Access Key ID、Secret Access Key、地区和Bucket（空间名）。</p>
<p>填好之后保存设置，如果连接成功，系统会给你盖个绿色的章。：）</p>
<h3>云缩略图</h3>
<p>不使用媒体库的缩略图，只会生成和同步完整尺寸，其他缩略图尺寸将由云存储自动生成。</p>
<p>建议不要在 <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings'); ?>" target="_blank">设置</a> 中 <strong>禁用缩略图尺寸</strong>，也不要在 <a href="<?php print admin_url('admin.php?page=qqworld-collector-auto-save-attachment'); ?>" target="_blank">自动保存附件</a> 中勾选 <strong>不使用媒体库</strong>，因为会有兼容性问题。</p>
<h3>同步网站资源</h3>
<p>不要忘记在百度云BOS的管理控制台中设置回源地址。</p>
<ol>
	<li>不要勾选请求携带参数（如果有），可能会导致某些图片无法访问。</li>
</ol>
<p><em class="qc-icon info">提示：如果你的网站中包含字体，你需要按照下面所描述的方法做才能上传和访问这些字体：</em></p>
<ol>
	<li>在CORS设置中新建规则，填上你的网站首页URL，并至少勾选GET方法。</li>
	<li>可能需要将你的网站域名添加到防盗链白名单中。</li>
</ol>
<p><em class="qc-icon info">如果无法扫描，提示 Internal Server Error 错误，则需要检查 php.ini 里 open_basedir 是否包含了你的网站根目录，如果有就需要删掉。（也可能在你的网站根目录下的 .htaccess 或 .user.ini 文件里。）</em></p>