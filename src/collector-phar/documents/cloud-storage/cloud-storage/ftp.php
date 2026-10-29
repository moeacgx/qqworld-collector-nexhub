<p>大家都很熟悉FTP了，如果你有速度还不错的FTP空间，完全可以将其当做云存储来使用。</p>
<h2>设置方法</h2>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/ftp/1.png" /></p>
<h3>域名 &amp; 目录</h3>
<p>先填写FTP的域名和目录，这里表达的是FTP里文件的路径格式。</p>
<p>注意，域名要填FTP根目录的地址，有时候不仅仅是域名，还可能带目录。</p>
<h3>FTP参数</h2>
<p>然后选择类型，一般默认FTP就行，填写IP地址（可以是域名），端口（通常是21，SFTP通常是22）以及用户名和密码，这些都很简单。</p>
<h2>范例</h2>
<p>FTP根目录的访问地址是 <strong>http://localhost.gov/ftp</strong>，所以在 <strong>域名 &amp; 目录</strong> 那应该填写 <strong>localhost.gov/ftp</strong>.</p>
<h3>被动模式 (仅用于FTP类型)</h3>
<p>什么是被动模式？这个不用管了，默认的连接方式是主动模式，如果连不上就用被动模式试试吧。</p>
<h3>同步网站资源</h3>
<p>FTP并没有回源功能，所以必须扫描网站的文件进行主动同步，如果有些文件并不是通过媒体库上传的，就不支持了。</p>