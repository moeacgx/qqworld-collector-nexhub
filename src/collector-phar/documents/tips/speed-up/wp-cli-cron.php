<p class="qc-icon info">该方法兼容性低，部署难度较高，建议使用 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--speed-up--linux-cron'); ?>" target="_blank">操作系统激活计划任务</a>。</p>
<h1>前言</h2>
<p>Wordpress内置wp-cron的模块，可以用来执行定时任务，比如定时检查更新，定时发布文章等都需要用到，属于必备功能。但是该模块的特点是：它只能在用户发起请求时检查定时任务。这个特点导致了一个问题：</p>
<ol>
	<li>没有用户访问时，那定时任务就得不到执行；</li>
	<li>有用户访问时，某个用户会因为定时任务在执行而响应很慢甚至超时；</li>
	<li>可能会同时多次执行同一个任务。</li>
</ol>
<p>因此，在生产环境下使用wp-cron是不明智的。</p>
<p>更好的做法是开启一个独立的进程执行这些定时任务——这里使用crontab + wp-cli实现这种做法。(如果你不使用wp-cli，也可以，但是在有wp-cli的情况下，你可以方便地查看各个任务的具体执行情况，和对任务做精确的控制。没有命令行工具的情况下就有点要靠猜了）</p>
<p class="qc-icon info">注意：不支持WordPress的多站点模式下的子站。</p>
<h1>使用方法</h2>
<h2>下载WP CLI</h2>
<p>WP-CLI是PHP归档文件(.phar)。你可以使用 <em>curl</em> 或 <em>wget</em> 命令下载它：</p>
<pre class="prism"><code class="language-php">curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar</code></pre>
<p>或者</p>
<pre class="prism"><code class="language-php">wget https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar</code></pre>
<p class="qc-icon info">如果无法下载，可以在本地下载后上传到服务器的 <em>/usr/local/bin</em> 目录，并执行下面的这条命令转到该目录继续下一步。</p>
<pre class="prism"><code class="language-php">cd /usr/local/bin</code></pre>
<h2>安装WP CLI</h2>
<p>你需要使.phar文件可执行，并将其移动到 <em>/usr/local/bin</em> 可以直接运行：</p>
<pre class="prism"><code class="language-php">chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp</code></pre>
<p>检查它是否安装正确：</p>
<pre class="prism"><code class="language-php">wp --info</code></pre>
<p>你应该看到类似的输出，如下所示，这意味着你可以继续：</p>
<pre class="prism"><code class="language-php">PHP binary: /usr/bin/php5
PHP version:    7.3.11-1ubuntu3.1
php.ini used:   /etc/php7/cli/php.ini
WP-CLI root dir:    phar://wp-cli.phar
WP-CLI global config:
WP-CLI project config:
WP-CLI version: 0.21.1</code></pre>
<h2>禁用WP的计划任务（wp-cron）</h2>
<p>打开网站根目录的 <em>wp-config.php</em>，加入以下代码：</p>
<pre><code>define('DISABLE_WP_CRON', true);
if (defined('WP_CLI') && WP_CLI) {
	$_SERVER['HTTP_HOST'] = 'localhost';
}</code></pre>
<h2>通过crontab定期执行任务</h2>
<p>添加以下任务到宝塔的计划任务中每分钟检查过期任务，如果有就执行，如下图所示：</p>
<p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/speed-up/wp-cli-cron/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/speed-up/wp-cli-cron/1.png" /></a></p>
<pre class="prism"><code class="language-php">wp cron event run --path=`/www/wwwroot/xxx.com` --due-now --allow-root</code></pre>
<p>注意其中 <em>/www/wwwroot/xxx.com</em> 是网站所在的目录完整路径。设置好之后就可以测试执行一次，并查看日志是否正常。</p>
<h1>其他</h1>
<h2>升级WP CLI</h2>
<pre class="prism"><code class="language-php">/usr/local/bin/wp cli update</code></pre>
