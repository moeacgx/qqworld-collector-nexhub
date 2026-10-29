<p>正常情况下，用户访问你的网站，所有下载的图片都是带Cookies的，虽然数据量很小，但多多少少还是占了一定的带宽。</p>
<p>使用免Cookie域名就可以解决这个问题。</p>
<h2>设置方法</h2>
<h4>免Cookie域名</h4>
<p>比如你的网站地址是 <strong>www.example.com</strong>，解析1个二级域名到你的网站，比如 <strong>img.example.com</strong>。并将其填到域名设置中，保存设置，就可以看到使用说明了。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/others/local/1.png" /></p>
<h4>修改wp-config.php</h4>
<p>在 <em>wp-config.php</em> 中加入以下代码</p>
<pre class="prism"><code class="language-php">define( 'WP_CONTENT_URL', '//img.example.com/wp-content' );
define( 'COOKIE_DOMAIN', 'www.example.com' );</code></pre>
<p>这段代码的意思是，媒体库中的附件都是用 <strong>img.example.com</strong> 域名，只有 <strong>www.example.com</strong> 域名才是带Cookies的。</p>