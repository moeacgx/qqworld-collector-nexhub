<h2>自动保存附件</h2>
<pre class="prism"><code class="language-php">&lt;?php
// 当自动保存附件是手动模式时，用接口抓取文章内容里的远程图像
if ($GLOBALS['QC']->options->qc_asa_general_mode == 'manual') {
	/**
	 * $post_content	string		包含远程图像的文章内容
	 * $args			array		附加参数
	**/
	$args = array(
		'post_id' => 933, // 该文章内容所在的文章ID，作为抓到的图的父文章ID，如果无需绑定文章ID，请填0
		'thumbnail' => -1 // 特色图ID，如果没有请填-1
	);
	// 返回替换成本地图或云存储地址的文章内容
	$post_content = apply_filters( 'qqworld-collector-save-remote-attachment-from-content', $post_content, $args );
}
?&gt;</code></pre>