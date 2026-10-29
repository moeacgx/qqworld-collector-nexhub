<p>从QQWorld收藏家3.1.0开始支持Zend OPcache，可以有效增强PHP的性能，显著降低CPU占用率。</p>
<p>可以在宝塔面板中轻松安装OPcache模块，下面将告诉大家关于OPcache的推荐配置，在php.ini中找到opcache的配置信息，然后修改以下参数：</p>
<pre class="prism"><code class="language-php">opcache.memory_consumption=256</code></pre>
<p>这个配置表示你想要分配给 OPcache 的内存空间（单位：MB），设置一个大于 64 的值即可。</p>
<pre class="prism"><code class="language-php">opcache.interned_strings_buffer=64</code></pre>
<p>这个配置表示你想要分配给实际字符串的空间（单位：MB），设置一个大于 16 的值即可。</p>
<pre class="prism"><code class="language-php">opcache.max_accelerated_files=32000</code></pre>
<p>这个配置表示可以缓存多少个脚本，将这个值尽可能设置为与项目包含的脚本数接近（或更大）。</p>
<pre class="prism"><code class="language-php">opcache.revalidate_freq=3600</code></pre>
<p>设置为3600，每隔1小时才会检查脚本是否更新。</p>
<pre class="prism"><code class="language-php">opcache.validate_timestamps=0</code></pre>
<p>改配置值用于重新验证脚本，推荐设置为<strong>0</strong>，该值速度最快，但如果升级WordPress核心、插件或主题后，应用手动清空Opcache缓存。</p>
<pre class="prism"><code class="language-php">opcache.save_comments=0</code></pre>
<p>推荐设置为<strong>0</strong>，脚本文件中的注释内容将不会被包含到操作码缓存文件，这样可以有效减小优化后的文件体积，禁用此配置指令可能会导致一些依赖注释或注解的应用或框架无法正常工作，比如：<em>Doctrine</em>、<em>Zend Framework2</em>等.</p>
<pre class="prism"><code class="language-php">opcache.load_comments=0</code></pre>
<p>推荐设置为<strong>0</strong>，即使文件中包含注释，也不会加载这些注释内容。</p>
<h2>手动清除方法</h2>
<p>在 <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings#server'); ?>" target="_blank">设置 -&gt; 服务器</a> 中开启重置OPcache，然后保存设置即可。（安装了OPcache才看得到。）</p>
<p>如果你不想要手动清除，可以将其设置为 1 并通过 <em>opcache.revalidate_freq=60</em> 配置重新验证间隔，这可能会消耗一些性能，因为需要每隔60秒检查更改。</p>