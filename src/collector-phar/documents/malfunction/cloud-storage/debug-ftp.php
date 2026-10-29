<pre class="prism"><code class="language-php">&lt;?php
/**
 * 调试方法：
 *
 * 新建一个 ftp.php 文件到网站根目录，将以下代码保存到ftp.php文件
 * 注意要填写必要的FTP服务参数，放个 test.jpg 文件到根目录
 * 然后后用 <?php print home_url('ftp.php'); ?> 访问
 *
 * 注意：FTP服务器开了防火墙可能会导致无法同步（大多因为端口问题）
**/
error_reporting(E_ALL);

$host = '127.0.0.1'; // FTP主机
$port = 21; // 端口
$username = ''; // 用户名
$password = ''; // 密码
$passive_mode = false; // 是否被动模式

// 不要改下面的内容
$dst_path = '/test.jpg'; // 上传到FTP的文件路径
$src_path = './test.jpg'; // 本地文件路径，请复制test.jpg文件到ftp.php的相同目录

$file = fopen($src_path, 'r');
if (!$file) {
	die('本地文件不存在');
}

$conn = ftp_connect($host, $port);
if ($conn) {
	if (ftp_login($conn, $username, $password)) {
		if ($passive_mode) ftp_pasv($conn, true);
		if ( ftp_fput($conn, $dst_path, $file, FTP_BINARY) ) {
			print '成功上传';
		} else {
			print '上传失败';
		}
	} else {
		print '登录失败';
	}
} else {
	print '连接FTP失败';
}
?&gt;</code></pre>
<p><?php _e('If you can not connect to FTP, use the above codes to test if your server supports FTP.', $this->text_domain); ?></p>
<p><?php _e('You may need to turn on PHP error reporting.', $this->text_domain); ?></p>