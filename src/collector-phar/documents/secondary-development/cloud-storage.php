<h2>上传单个附件到云存储</h2>
<p>保存到媒体库的资源会自动上传到媒体库，一般不需要添加该接口。</p>
<pre class="prism"><code class="language-php">&lt;?php
/**
 * $url		string		图片http地址，可以本地附件地址，也可以是远程图像地址
**/
// 返回云存储地址
$url = apply_filters( 'qqworld-collector-cloud-storage-upload-single-file', $url );
?&gt;</code></pre>
<h2>删除某附件的云存储资源</h2>
<p>删除附件的时候会自动删除云存储上的资源，一般不需要添加该接口。</p>
<pre class="prism"><code class="language-php">&lt;?php
/**
 * $attachment_id		int		附件ID
**/
// 删除该ID的云存储资源
do_action( 'qqworld-collector-cloud-storage-delete-attachment', $attachment_id );
?&gt;</code></pre>