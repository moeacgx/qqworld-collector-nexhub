<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>malfunction/tencent-cdn-564/1.png" /></p>
<p>腾讯CDN的默认超时时间是10秒，如果源站10秒内没有返回数据给节点的话，节点就会响应564状态码，虽然可以要求客服将超时延长到60秒，但是仍然不够用。</p>
<h3>解决方法</h3>
<p><a href="https://jingyan.baidu.com/article/9113f81b49ed2f2b3214c7fa.html" target="blank">修改系统hosts文件</a>，将网站的原始IP解析到域名，相当于本机绕过CDN直连网站。</p>