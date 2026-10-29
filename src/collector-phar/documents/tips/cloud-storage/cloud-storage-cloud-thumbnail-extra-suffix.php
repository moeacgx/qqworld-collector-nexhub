<p>假如你想在OSS上使用webp自动转换功能，可以将以下代码放到主题的 functions.php 里：</p>
<!--<h3>给缩略图尺寸加上后缀</h3>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-cloud-storage-cloud-thumbnail-extra-suffix', 'my_cloud_thumbnail_extra_suffix' );
function my_cloud_thumbnail_extra_suffix($url) {
	$suffix = 'imageMogr2/format/webp'; // 这里填写后缀，最前面不要带?或,
	$url .= strstr($url, '?') !== false ? ',' . $suffix : '?' . $suffix;
	return $url;
}</code></pre>-->
<h3>给完整尺寸加上后缀</h3>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-cloud-storage-cloud-thumbnail-extra-suffix-for-full-size', 'my_cloud_thumbnail_extra_suffix_for_full_size' );
function my_cloud_thumbnail_extra_suffix_for_full_size($url) {
	$suffix = '?x-oss-process=imageMogr2/format/webp'; // 这里填写后缀，必须写完整的后缀
	$url .= strstr($url, '?') !== false ? '' : $suffix;
	return $url;
}</code></pre>
<p>注意，如果不需要云缩略图功能，也要勾上云缩略图，然后清空设置即可。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/cloud-storage/cloud-storage-cloud-thumbnail-extra-suffix/1.png" /></p>