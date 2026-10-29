<p>查看无法显示的特色图地址，大概你会获得类似于下面的地址：</p>
<pre class="prism"><code class="language-php"><?php print home_url('/wp-content/themes/xxxxxx/timthumb.php?url=//oss.wp.cn/2019/09/8d21a0934889f6-1.jpg_270x370'); ?></code></pre>
<p>这是因为你的主题使用第三方切图程序</p>
<h1>解决方法一</h1>
<p>在插件的云存储设置里打开云缩略图，填 <strong>&h=(h)&w=(w)&zc=1&a=c&q=100&s=1</strong> 试试，不同的主题参数可能不一样，但设置方法都一样，把高度(h)和宽度(w)的变量替换进去就行。</p>
<h1>解决方法二</h1>
<p>在主题设置里将第三方切图关掉，选择WP原生切图程序，如果找不到选项，请咨询主题作者，如果关不掉，就无法使用云存储。</p>
<h3>后遗症</h3>
<p>如果成功关掉了 <strong>timthumb.php</strong> 之类的切图程序，由于本地没有生成各种尺寸的缩略图，会导致显示的云存储图片尺寸有问题，这时候就需要使用 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--regenerate-thumbnails'); ?>" target="_blank">重建缩略图</a> 的插件重建所有缩略图，然后重新同步媒体库中的所有附件。</p>
<p>其他可能的原因请参考 <a class="qc-icon link button button-primary" target="_blank" href="<?php print admin_url('admin.php?page=qqworld-collector-documents#malfunction--cloud-storage--thumbnail-missing'); ?>">后台媒体库的缩略图无所显示</a></p>