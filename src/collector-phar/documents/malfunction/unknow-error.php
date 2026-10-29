<p>或者 <em>提示此站点正遇到致命错误</em>，如果在使用插件的过程中出现这种提示，说明遇到致命错误了。</p>
<h2>解决方法</h2>
<h3>内存不足</h3>
<p>在 <em>php.ini</em> 里有个参数会限制内存使用，而本插件正需要大量内存：</p>
<pre class="prism"><code class="language-php">memory_limit = 128M</code></pre>
<p>将 <em>128M</em> 改为 <em>256M</em> 或更大试试。</p>
<h3>执行时间超时</h3>
<p>在 <em>php.ini</em> 里有个参数会限制PHP的执行时间：</p>
<pre class="prism"><code class="language-php">max_execution_time = 120
max_input_time = 60</code></pre>
<p>将 <em>120</em> 和 <em>60</em> 都改为 <em>3600</em> 或更大试试。</p>
<h3>数据库问题</h3>
<p>优化数据库试试。</p>
<h3>磁盘空间不足</h3>
<p>检查服务器磁盘空间，有可能是 MySQL 数据日志造成的，建议关闭，方法请看 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#newcomer-manual--problems'); ?>" target="_blank">新手必看常见问题</a>。</p>
<h3>问题依旧？</h3>
<p>如果依然无法解决，请联系开发者调试程序，有可能需要重装所有服务器软件。</p>