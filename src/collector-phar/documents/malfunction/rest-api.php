<p>很多程序需要用到REST API，有些网站提示不支持。</p>
<h2>测试方法</h2>
<p>如果你可以正常访问 <a href="<?php print home_url('wp-json'); ?>" target="_blank">REST API</a>，则说明REST API是没问题的。</p>
<p>如果显示404，往下看。</p>
<h2>解决方法</h2>
<h3>1、REST API被禁用</h3>
<p>找到禁用REST API的插件或主题的设置，重新开启。排查方法是禁用不必要的插件或切换主题，然后保存一下 <a href="<?php print admin_url('options-permalink.php'); ?>">固定链接</a> 设置。</p>
<h3>2、确保支持伪静态</h3>
<p>在宝塔面板里可以轻松开启网站设置中的WordPress伪静态。</p>
<h3>3、固定链接不能选择朴素</h3>
<p>在 <a href="<?php print admin_url('options-permalink.php'); ?>">固定链接</a> 设置中不要选择 <strong>朴素</strong>。</p>