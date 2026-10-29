<h2>翻译内容</h2>
<p>返回翻译的内容，$from, $to 和 $mode 可以留空，默认调用翻译设置。<br />
也可以指定个性化的翻译，$from, $to 和 $mode 的值可以从 <a href="<?php print admin_url('admin.php?page=qqworld-collector-translate'); ?>" target="_blank"><strong>这里</strong></a> 的表单下拉菜单源代码中获取。</p>
<pre class="prism"><code class="language-php">&lt;?php
/**
 * 调用翻译设置
 * $content			string		要翻译的内容
**/
$content = apply_filters( 'qqworld-collector-translate', $content );
/**
 * 自定义翻译
 * $content			string		要翻译的内容
 * $from			string		源语言，如 zh
 * $to				string		目标语言，如 cht
 * $mode			string		翻译引擎，如 aliyun
**/
$content = apply_filters( 'qqworld-collector-translate', $content, $from, $to, $mode );
?&gt;</code></pre>