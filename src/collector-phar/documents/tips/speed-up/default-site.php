<p>建立默认站点有利于降低性能损耗，以宝塔面板为例：</p>
<h2>新建站点</h2>
<p>使用二级域名比如 <em>default.xxx.com</em>，新建站点，并在站点列表上方的 <strong>默认站点</strong> 按钮，选择该站点并提交。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/speed-up/default-site/1.png" /></p>
<h2>禁止访问默认站点</h2>
<p>打开站点设置，加入一行 <em>return 444;</em> 即可，如下图所示。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/speed-up/default-site/2.png" /></p>