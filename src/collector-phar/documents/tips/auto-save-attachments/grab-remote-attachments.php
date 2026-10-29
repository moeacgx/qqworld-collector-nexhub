<p>在 <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings#server'); ?>" target="_blank">设置 - 服务器 - HTTP文件头</a> 中，可以进行一些设置：</p>
<h3>文件头 - 用户代理（User-Agent）</h3>
<p>有些远程图片是需要用户代理来抓取的，这里推荐谷歌Chome浏览器。</p>
<h3>文件头 - 参照地址（HTTP-Referer）</h3>
<p>通常自动即可，但有些远程图片需要的参照地址和图片的域名不一致，需要单独订制。</p>
<p><span class="qc-icon info">有个无脑的方法：前面是图片的域名，后面是网站的地址，用 <em>|</em> 隔开。</span><br />如果不行，请继续往下看。</p>
<h3>文件头 - Cookies</h3>
<p>极少数图片是防采集的，需要获取网站首页的Cookie才行，获取Cookie的方法可以在帮助文档中找到。</p>
<h1>范例</h1>
<h2>获取加密方法</h2>
<p>碰到无法采集的远程图片，排除网络问题后，就可以在当前网站所在的浏览器窗口下按F12开启开发者模式，然后切换到 <strong>Network</strong> 选项卡，点击 <strong>Img</strong> 分类，刷新页面后就可以在左侧看到要采集的图片，选中其中一个，在右侧的Headers窗口中可以看到以下内容：</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/auto-save-attachments/grab-remote-attachments/1.png" /></p>
<p>其中 <strong>Referer</strong> 是参照地址，明显和图片地址不一样，<strong>User-Agent</strong> 是用户代理，用的是Chrome浏览器。</p>
<p>就是说该图片需要这两项内容符合才能访问。</p>
<h2>破解加密</h2>
<p>打开 <strong>设置</strong> - <strong>服务器</strong> - <a href="<?php print admin_url('/admin.php?page=qqworld-collector-settings#server'); ?>" target="_blank"><strong>HTTP文件头</strong></a>，首先设置用户代理，选择谷歌Chrome浏览器。然后在才找地址中设置自定义，输入 <em>kanmengmei.com|http://www.99mm.me/</em> 即可。有些图片甚至需要Cookie才能采集，也可以在开发者工具中获取。如下图所示：</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/auto-save-attachments/grab-remote-attachments/2.png" /></p>
<p>然后就可以愉快地采集该网站的远程图片了。</p>