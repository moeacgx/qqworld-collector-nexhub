<h1>方法一：ImageMagick篇（推荐）</h1>
<p>假如你的PHP版本是 <strong>7.3.26</strong>：</p>
<h2>1、卸载宝塔的ImageMagick扩展</h2>
<h3>首先在PHP设置里卸载 ImageMagick 扩展，然后为避免版本冲突，删除 PHP 的 ImageMagick 扩展:</h3>
<p>方法1：在宝塔文件管理器里删除 <strong>/www/server/php/73/lib/php/extensions/no-debug-non-zts-20180731/imagick.so</strong> 文件</p>
<p>方法2：用命令行：</p>
<pre class="prism"><code class="language-markup">rm -f /www/server/php/73/lib/php/extensions/no-debug-non-zts-20180731/imagick.so</code></pre>
<p class="qc-icon info">注意这里的73要匹配你的PHP版本。</p>
<h2>2、安装webp库</h2>
<pre class="prism"><code class="language-markup">yum install libwebp</code></pre>
<h2>3、编译安装ImageMagick</h2>
<p class="qc-icon info">注：如果之前有过yum安装的先卸载，卸载命令为：</p>
<pre class="prism"><code class="language-markup">yum remove ImageMagick</code></pre>
<h3>貌似宝塔不认新版本ImageMagick，所以要安装老版本</h3>
<p>以下代码一行一行执行：</p>
<pre class="prism"><code class="language-markup">wget https://imagemagick.org/archive/releases/ImageMagick-6.8.7-10.tar.xz
tar -xvJf ImageMagick-6.8.7-10.tar.xz
cd ImageMagick-6.8.7-10
./configure --with-webp
make && make install
cd ..</code></pre>
<p class="qc-icon info">注意上面的代码在有些服务器上可能会显示 <em>make &amp;amp;&amp;amp; make install</em>，应该是 <em>make &amp;&amp; make install</em>。</p>
<h2>4、编译安装 PHP 的 ImageMagick 扩展</h2>
<p>以下代码一行一行执行：</p>
<pre class="prism"><code class="language-markup">wget http://pecl.php.net/get/imagick-3.4.3.tgz
tar -zxvf imagick-3.4.3.tgz
cd imagick-3.4.3
/www/server/php/73/bin/phpize
./configure --with-php-config=/www/server/php/73/bin/php-config
make && make install</code></pre>
<p><span class="qc-icon info">注意上面的代码在有些服务器上可能会显示 <em>make &amp;amp;&amp;amp; make install</em>，应该是 <em>make &amp;&amp; make install</em>。</span><br />
<span class="qc-icon info">注意这里的两个73要匹配你的PHP版本。</span></p>
<h2>5、重载 PHP 服务</h2>
<pre class="prism"><code class="language-markup">service php-fpm-73 reload</code></pre>
<p class="qc-icon info">注意这里的73要匹配你的PHP版本。</p>
<p>此方法由 <strong>W'</strong> 用户提供。</p>
<p class="qc-icon info">有些用户无法重现这个结果，但是失败后在宝塔里重装ImageMagick后也能支持WEBP，我猜可能是 <em>yum install libwebp</em> 的作用。</p>
<h1>方法二：GD篇（不推荐）</h1>
<p>假如你的PHP版本是 <strong>7.2.28</strong>，在SSH里运行一下命令即可安装GD的WEBP支持。</p>
<pre class="prism"><code class="language-markup">wget -O php.sh http://download.bt.cn/tools/php.sh
bash php.sh install 7.2</code></pre>
<p>先运行第一个命令，再运行第二个哦。</p>
<p class="qc-icon info">如果Imagemagick不支持WEBP，必须卸载掉，否则不会优先调用GD库来处理图像的。</p>
<p class="qc-icon info">PHP7.4以上的版本通常自带支持WEBP的GD，不需要手动安装。</p>