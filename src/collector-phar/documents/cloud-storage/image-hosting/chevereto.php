<p>使用自己的图床作为云存储。</p>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#video-course--cloud-storage--chevereto'); ?>" target="_blank" class="button button-primary button-large qc-icon link">视频教程</a></p>
<p>DEMO地址：<a href="https://demo.chevereto.com/" target="_blank">https://demo.chevereto.com/</a></p>
<h2>安装方法</h2>
<h3>新建网站</h3>
<p>建立网盘的网站，并配置好二级域名。</p>
<h3>设置伪静态（Nginx）</h3>
<p>以宝塔为例，打开网站设置，在伪静态中输入：</p>
<pre class="prism"><code class="language-php">try_files $uri $uri/ /index.php?$query_string;</code></pre>
<p>非宝塔面板可修改网站配置文件，在 <strong>server</strong> 中加入以下代码：</p>
<pre class="prism"><code class="language-php">location / {
	try_files $uri $uri/ /index.php?$query_string;
}</code></pre>
<h3>下载并解压</h3>
<p>下载地址：<a href="https://github.com/Chevereto/Chevereto-Free" target="_blank">https://github.com/Chevereto/Chevereto-Free</a></p>
<p>在 <strong>Release</strong> 栏中下载最新版源文件（Source code），解压到网盘网站根目录。</p>
<h3>安装网盘</h3>
<p>打开网盘首页，输入包括数据库设置在内的信息即可完成安装。</p>
<h2>设置方法</h2>
<p>安装好Chevereto开源图床之后，输入首页地址，保存后去媒体库列表页手动同步1个附件试试，如果成功了，再回到设置页扫描媒体库。</p>
<h1>接口</h1>
<p>有的用户希望为不同的用户指定不通的API v1 key，将如下代码放到主题的 <em>functions.php</em> 文件中，并且进行二次开发：</p>
<pre class="prism"><code class="language-php">/**
 * 为不同的用户指定不同的 API v1 key
 * $api_v1_key			string		默认的 API v1 key
 * $current_user_id		int			当前用户的ID
**/
add_filter( 'qqworld-collector-cloud-storage-chevereto-api', function($api_v1_key, $current_user_id) {
	// 根据 $current_user_id 返回用户的api key，如果为空，则调用默认API v1 Key
	return $api_v1_key;
}, 10, 2 );</code></pre>