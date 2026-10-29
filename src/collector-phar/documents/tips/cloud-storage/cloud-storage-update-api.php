<p>本插件默认只能将媒体库中的附件同步到云存储，有些没经过媒体库的图片可以使用以下接口进行适配：</p>
<pre class="prism"><code class="language-php">&lt;?php
$url = '<?php print home_url(); ?>/test.xml';
// 使用接口同步云存储并返回云地址 (云存储中设置的自定义目录无效)
// null 也可以是要保存的路径，比如 wp-content/uploads/2022/10/example.jpg
$url = apply_filters( 'qqworld-collector-cloud-storage-upload-single-file', $url, null );
?&gt;</code></pre>