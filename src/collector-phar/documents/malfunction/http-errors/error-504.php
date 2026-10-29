<h2>网关超时</h2>
<p>服务器设置中有很多地方都会设置运行时间限制，所以在使用大型应用程序的时候，需要将各种超时时间设置长一点，否则没等程序跑完就被系统掐断了。</p>
<p>不同性能的服务器，需要优化的参数值也不一样，所以需要自己摸索适合自己服务器的数值。</p>
<h3>Nginx（重要）</h3>
<p>在 <em>nginx.conf</em>，如宝塔地址：<em>/www/server/nginx/conf/nginx.conf</em>，其中找到以下参数：</p>
<dl>
	<dt>keepalive_timeout 3600</dt>
	<dd>保持连接的时间限制，推荐 <em>3600</em></dd>
	<dt>fastcgi_connect_timeout 3600</dt>
	<dd>指定nginx与后端fastcgi server连接超时时间，推荐 <em>3600</em></dd>
	<dt>fastcgi_send_timeout 3600</dt>
	<dd>指定nginx向后端传送请求超时时间，推荐 <em>3600</em></dd>
	<dt>fastcgi_read_timeout 3600</dt>
	<dd>指定nginx接受后端fastcgi响应请求超时时间，推荐 <em>3600</em></dd>
</dl>
<p>特别是这4个timeout（单位：秒），时间太短容易504，除非你的服务器性能超强，可以在规定时间内跑完程序，推荐 <strong>3600</strong>。</p>
<dl>
	<dt>fastcgi_buffer_size 128k</dt>
	<dd>指定nginx读取fastcgi响应第一部分需要用多大的缓冲区，可以设置为 <em>fastcgi_buffers</em> 缓存区大小，推荐 <em>128k</em></dd>
	<dt>fastcgi_buffers 8 128k</dt>
	<dd>指nginx需要用多大的缓冲区缓冲fastcgi的应答请求，推荐 <em>8 128k</em></dd>
	<dt>fastcgi_busy_buffers_size 256k</dt>
	<dd>整个数据请求需要多大的缓存区，建议设置为 <em>fastcgi_buffers</em> 值的2倍，推荐 <em>256k</em></dd>
	<dt>fastcgi_temp_file_write_size 512k</dt>
	<dd>在写入缓存文件时使用多大的数据块，默认值是 <em>fastcgi_buffers</em> 的2倍，推荐 <em>512k</em></dd>
	<dt>client_body_buffer_size 32k</dt>
	<dd>请求主体的缓冲区大小，太小会降低速度导致超时，推荐 <em>32k</em>，如果没有这条可以不管，也可以加上。</dd>
</dl>
<p>如果你使用的是nginx的<strong>负载均衡Proxying</strong>，调整：</p>
<dl>
	<dt>proxy_buffer_size 64k</dt>
	<dd>指定nginx读取代理响应第一部分需要用多大的缓冲区，可以设置为 <em>proxy_buffers</em> 缓存区大小，推荐 <em>64k</em></dd>
	<dt>proxy_buffers 4 64k</dt>
	<dd>指nginx需要用多大的缓冲区缓冲代理的应答请求，推荐 <em>4 64k</em></dd>
	<dt>proxy_busy_buffers_size 128k</dt>
	<dd>代理数据请求需要多大的缓存区，建议设置为 <em>proxy_buffers</em> 值的2倍，推荐 <em>128k</em></dd>
</dl>
<p>另外如果各缓冲区太小会导致fastcgi进程被挂起从而演变为 <strong>504</strong> 甚至 <strong>502</strong> 错误，所以可以将 <em>bufser_size</em> 适当调大，范例中推荐增大2倍，如果不够用可以 <strong>10</strong> 倍甚至更大。</p>
<p><em class="qc-icon info">为防止填错，建议把所有数值<strong>乘以相同倍数</strong>。</em></p>
<p><em class="qc-icon info">有些集成环境的 <strong>Nginx</strong> 设置中可以直接修改某些参数。</em></p>
<h3>CDN（重要）</h3>
<p>如果用了CDN，就需要 <a href="https://www.baidu.com/s?wd=%E4%BF%AE%E6%94%B9hosts" target="_blank">修改你电脑的<em>hosts</em>文件</a>，绕过CDN直连网站，否则通常CDN有1分钟的超时限制，而且无法修改。</p>
<h3>Apache（重要）</h3>
<p>如果用的是Nginx，就不需要修改这个了。在 <em>httpd.conf</em> 中找到以下参数：</p>
<ul>
	<li><strong>Timeout</strong>：接收和发送的超时限制，默认120秒，推荐3600。如果不存在，请自行添加。</li>
</ul>
<h3>PHP（不重要）</h3>
<p>在 <em>php.ini</em> 中找到以下参数：</p>
<p>注意：通常不需要修改这里，因为在 设置 - 服务器压力 - <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings#server'); ?>" target="_blank">超时</a> 中可以动态修改，推荐3600，即默认的1小时。</p>
<ul>
	<li><strong>max_execution_time</strong>：脚本解析允许的最大时间（单位：秒）</li>
	<li><strong>max_input_time</strong>：脚本解析输入数据（类似POST 和GET）允许的最大时间（单位：秒）</li>
</ul>
<h3>MySQL（不重要）</h3>
<p>在 <em>my.cnf</em> 中找到以下参数：</p>
<p>注意：通常不需要修改这里，除非你一次要保存到数据库的内容非常多。</p>
<ul>
	<li><strong>innodb_lock_wait_timeout</strong>：指的是事务等待获取资源等待的最长时间，超过这个时间还未分配到资源则会返回应用失败</li>
</ul>
<h2>总结</h2>
<p>以上配置是作者和用户的经验，应该还有其他的参数可以影响504的发生，可以去百度搜索更多结果，如：<a href="https://www.baidu.com/s?wd=nginx+504" target="_blank">Nginx 504</a>。</p>