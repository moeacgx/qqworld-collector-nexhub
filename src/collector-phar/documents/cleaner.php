<p>扫描媒体库，找出没有使用的附件并进行自动或手动的清除操作。</p>
<h3>禁止扫描管理员上传的附件</h3>
<p>把下面代码放到主题的 <strong>funcions.php</strong> 里任意地方，其中1是管理员的ID，多个ID用英文逗号分隔。</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-clearner-get-attachments-args', function($args) {
	$args['author__not_in'] = [1];
	return $args;
} );</code></pre>