<h2>CPU占用率100%</h2>
<p>开启插件后，CPU占用率很快就飙升到100%，建议检查：</p>
<ol>
	<li>Nginx版本是否太低，如 <strong>1.8</strong>，建议升级到 <strong>1.14</strong> 以上。</li>
	<li>开启了 <strong>自动锚点</strong>，勾选 <strong>保存到数据库</strong> 可以解决。</li>
	<li>回忆一下最近开启了插件的什么功能，关掉试试，并将出问题的功能报告给插件作者。</li>
</ol>
<h2>磁盘占用</h2>
<p>在 <strong>/usr/local/mysql/var</strong> 目录中多了很多 <strong>mysql-bin.000xxx</strong> 文件，多达数GB甚至数十GB，这些都是MySQL的日志文件。</p>
<p>解决方法是在 <strong>/etc/my.cnf</strong> 中注释掉 <strong>log-bin</strong> 和 <strong>binlog_format</strong> 两行以禁用日志（在每行的开头加 #），然后重启MySQL服务。</p>
<p>然后删除这些日志文件即可。</p>