<h1>安装方法</h1>
<h3>步骤</h3>
<ol>
	<li>下载图床源代码：<a href="https://github.com/wisp-x/lsky-pro/releases" target="_blank">https://github.com/wisp-x/lsky-pro/releases</a>；</li>
	<li>新建 <em>lsky</em> 数据库，编码 <em>utf8_general_ci</em>；</li>
	<li>将源代码解压到web运行环境，将图床域名绑定到 <em>public</em> 目录，然后访问图床域名自动跳转到安装界面，根据页面提示安装即可；</li>
	<li>安装完成以后请设置 <em>runtime</em> 目录 <em>0755</em> 权限，如果你使用本地存储，<em>public</em> 目录也需要设置为 <em>0755</em> 权限。</li>
</ol>
<h3>配置图床</h3>
<p>安装之后，登录管理员账号，建议执行以下动作：</p>
<dl>
	<dt>必须</dt>
	<dd>在 <strong>系统设置</strong> - <strong>其他配置</strong> 中启用 <strong>开启API（是否开放接口）</strong>。</dd>
	<dt>可选</dt>
	<dd>在 <strong>系统设置</strong> - <strong>基础配置</strong> 中开启 <strong>关闭注册</strong>。</dd>
	<dd>在 <strong>系统设置</strong> - <strong>上传配置</strong> 中关闭 <strong>允许游客上传（是否允许游客上传）</strong>。</dd>
	<dd>将 <strong>系统设置</strong> - <strong>上传配置</strong> 中的 <strong>允许上传的文件后缀(逗号隔开)</strong> 改为 <em>jpg,jpeg,gif,png,ico,bmp,webp,svg</em>。</dd>
</dl>
<h3>配置Rewrite规则</h3>
<h5>Nginx:</h5>
<pre>location / {
    if (!-e $request_filename) {
    	rewrite ^(.*)$ /index.php?s=$1 last; break;
    }
}</pre>
<p>Apache直接使用 <em>.htaccess</em> 即可</p>