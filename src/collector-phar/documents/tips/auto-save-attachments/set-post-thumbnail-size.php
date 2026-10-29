<p>将以下内容放到主题的 <em>functions.php</em> 中：</p>
<pre class="prism"><code class="language-php">set_post_thumbnail_size( 220, 180, true );</code></pre>
<p>其中 <em>220</em> 和 <em>180</em> 是特色图片的宽度和高度，<em>true</em> 是裁剪到该尺寸，而不只是等比例缩放。</p>