<p>以Chrome内核的浏览器为例，按F12打开开发者工具。切换到Networks选项卡。</p>
<p>刷新页面，点击第出现的1个项目，然后就可以在右边弹出的窗口中找到请求页头（<strong>Request headers</strong>）了。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/get-request-headers/1.png" /></p>
<p>页头里最重要的内容就是Cookie了。</p>
<h2>范例</h2>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/get-request-headers/2.png" /></p>
<p>将请求页头整个复制粘贴进来即可，当然也不一定全部都要，这里最重要的就是Cookie了，通常只需要保留Cookie行即可，注意前面的 <strong>Cookie:</strong> 不要删掉了。</p>
