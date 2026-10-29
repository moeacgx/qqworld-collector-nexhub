<p>设置定时采集，每隔一段时间就会自动采集一次。设置好收藏项目后，就可以当甩手掌柜啦。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/collecting/schedule-collecting/1.png" /></p>
<h2>定时方法</h2>
<h4>单次任务</h4>
<p>只会采集一次，一般用来快速启动采集程序，比如设置 <strong>0.1</strong> 分钟后执行 <strong>单次任务</strong>，则会在6秒后开始自动采集。</p>
<h4>循环任务</h4>
<p>除了单次任务就是循环任务，选择循环的时间间隔，每隔一段时间就会自动采集一次。</p>
<h2>Wordpress的计划任务</h2>
<p>Wordpress的计划任务运行原理是，当有用户访问网站时，系统会自动检查是否有计划任务，如果有就运行，如果没有就继续排队。</p>
<p>也就是说如果没有人访问你的网站，计划任务也就不会运行了。不过这种情况也少见，就算是搜索引擎也会时不时地来爬一下的，或者可以用 <a href="https://ce.baidu.com/" target="_blank">百度云观测</a> 服务定期访问你的网站，确保定时服务完美运行。</p>