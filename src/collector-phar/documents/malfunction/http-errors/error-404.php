<h2>文件未找到</h2>
<p>在保存远程附件、扫描或采集的时候，速度非常慢，直到404错误。</p>
<h2>解决方案</h2>
<h3>方案1</h3>
<p>将 <strong>php-fpm.conf</strong> 中的 <strong>request_terminate_timeout = 0</strong> 然后 <strong class="qc-icon info">重启PHP服务</strong> 就好了。</p>
<p>如宝塔地址：/www/server/php/{php版本}/etc/php-fpm.conf</p>