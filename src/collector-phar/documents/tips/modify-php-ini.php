<p>很多情况下需要直接修改 <strong>php.ini</strong> 中的设置。</p>
<p>以宝塔为例，<strong>php.ini</strong> 的位置在：<em>/www/server/php/{PHP版本}/etc</em> 目录下。</p>
<p>以修改 <em>max_input_vars</em> 为例，在 <strong>php.ini</strong> 中搜索：</p>
<pre class="prism"><code class="language-php">; How many GET/POST/COOKIE input variables may be accepted
; max_input_vars = 1000</code></pre>
<p>首先去掉前面的<strong>分号</strong>，然后修改参数值为10000：</p>
<pre class="prism"><code class="language-php">; How many GET/POST/COOKIE input variables may be accepted
max_input_vars = 10000</code></pre>
<p>保存后在软件商店里重启PHP服务即可。</p>