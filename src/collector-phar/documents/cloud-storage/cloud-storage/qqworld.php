<p>该云存储系统用于替代不稳定的FTP。</p>
<h2>设置方法</h2>
<h3>域名 &amp; 目录</h3>
<p>先在你的 <strong>云存储服务器</strong> 上新建一个 <strong>站点</strong>，支持PHP，不需要数据库，然后绑定一个云存储域名。</p>
<p>将该域名设置到 <strong>域名 &amp; 目录</strong> 中，并且填写该域名的访问地址到 <strong>根URL</strong>。</p>
<h3>准入密钥（token）</h3>
<p>生成 <strong>准入密钥（token）</strong>后，先 <strong>保存设置</strong>，然后点击 <a href="<?php print admin_url('admin-ajax.php?action=qqworld-collector-cloud-stoarge-qqworld-api-file'); ?>">这里</a> 下载 <strong>接口文件</strong> 上传到云存储的 <strong>根目录</strong>。</p>
<p>然后 <strong>启用云存储</strong>，看到 <strong>连接成功</strong> 即可。</p>