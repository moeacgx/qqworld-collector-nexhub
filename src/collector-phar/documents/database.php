<p>数据库功能可以帮助你快速地替换数据库中的内容。</p>
<h4>主要用途</h4>
<p>批量将阿里云OSS、七牛等云存储的地址批量转换为本地地址，方便迁移到其他云存储。或将本地地址转换为云存储地址。</p>
<dl>
	<dt>案例2</dt>
	<dd>
		<p>将七牛云存储的地址替换成本地地址，以方便迁移到其他云存储。</p>
		<p>比如你的云存储地址是：<br /><em>http://7xiit2.com1.z0.glb.clouddn.com/2018/04/example.jpg</em></p>
		<p>要替换成的本地图片地址：<br /><em>https://www.example.com/wp-content/uploads/2018/04/example.jpg</em></p>
		<p>那么只需要如下所示进行替换即可：</p>
		<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>database/1.png" /><br />之所以前面要加引号是为了防止误伤。</p>
	</dd>
	<dt>案例2</dt>
	<dd>
		<p>你的文章里的本地地址是相对地址，所以插件无法通过扫描自动替换成云存储地址，这时候就需要用到数据库工具了</p>
		<p>比如你的本地图片地址如下：<br /><em>/wp-content/uploads/2018/04/example.jpg</em></p>
		<p>需要替换成：<br /><em>http://7xiit2.com1.z0.glb.clouddn.com/2018/04/example.jpg</em></p>
		<p>那么只需要如下所示进行替换即可：</p>
		<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>database/2.png" /><br />之所以前面要加引号是为了防止误伤。</p>
	</dd>
</dl>
<h2>注意事项</h2>
<h4>自定义字段</h4>
<p>批量替换自定义字段中的内容需要小心，因为有些内容是将数组序列化后的字符串，如果替换前后的字符长度不一样，会导致该内容无法还原为数组。</p>