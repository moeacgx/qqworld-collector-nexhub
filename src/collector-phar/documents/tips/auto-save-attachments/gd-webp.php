<p>假如你的PHP版本是 <strong>7.2.28</strong>，在SSH里运行一下命令即可安装GD的WEBP支持。</p>
<pre class="prism"><code class="language-php">wget -O php.sh http://download.bt.cn/tools/php.sh
bash php.sh install 7.2</code></pre>
<p>先运行第一个命令，再运行第二个哦。</p>
<p class="qc-icon info">如果Imagemagick不支持WEBP，必须卸载掉，否则不会优先调用GD库来处理图像的。</p>