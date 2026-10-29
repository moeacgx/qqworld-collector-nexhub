<h2>调用方法</h2>
<h3>简单调用</h3>
<p>在主题的模板的循环中使用以下代码输出特色图代码：</p>
<pre class="prism"><code class="language-php">if (has_post_thumbnail()) the_post_thumbnail();</code></pre>
<h3>调用自定义尺寸</h3>
<p>有些主题使用了自定义尺寸，如 <em>custom-size</em>，可以直接调用：</p>
<pre class="prism"><code class="language-php">if (has_post_thumbnail()) the_post_thumbnail('custom-size');</code></pre>
<h3>控制默认缩略图的尺寸</h3>
<p>默认使用 <strong>post-thumbnail</strong> 尺寸，有些主题自定义了 <strong>post-thumbnail</strong>，如果没有，在主题的 <em>functions.php</em> 中加入以下代码：</p>
<pre class="prism"><code class="language-php">set_post_thumbnail_size( 400, 300, false);</code></pre>
<p>其中 <em>400</em> 是宽度，<em>300</em> 是高度，<em>false</em> 是不裁剪，如果要裁剪可以写 <em>true</em>。</p>