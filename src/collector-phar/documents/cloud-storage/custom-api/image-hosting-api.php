<p>使用自己的图床API将本地地址转换为图床地址。</p>
<h2>接口DEMO</h2>
<p>将以下代码放到主题的 <strong>functions.php</strong> 里去。</p>
<pre class="prism"><code class="language-php">/**
 * 为不同的用户指定不同的 API v1 key
 * $url				string		图床地址
 * $source_path		string		媒体本地路径
**/
add_filter( 'qqworld-collector-cloud-storage-image-hosting-api', function($url, $source_path) {
	// 如果你的程序只能处理http地址，请将 $source_path 转换为 http地址，否则请跳过，比如
	$source_path = str_replace('/www/wwwroot/example.com', 'https://www.example.com', $source_path);

	// 对 $source_path 地址进行处理，转换为图床地址赋值给 $url，如果无法生成图床地址，请返回false
	$url = my_parser($source_path); // 此处填写你的程序逻辑，my_parser 是你的自定义函数

	return $url;
}, 10, 2 );</code></pre>