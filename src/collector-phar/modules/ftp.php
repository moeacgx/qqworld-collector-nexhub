<?php  namespace QASI\modules\ftp; class ftp extends \qqworld_collector_common { var $allowed_image_types = array('image/jpeg', 'image/gif', 'image/png'); var $slug = 'ftp'; var $ftp; var $ftp_connection; var $ip; var $port; var $username; var $password; var $directory; var $optimize_url; var $optimize_protocol; var $optimize_host; var $optimize_folder; public function __construct() { $this->ftp = get_option('qqworld-auto-save-images-ftp', array('ip' => '','port' => '21','username' => '','password' => '')); $this->ip = isset($this->ftp['ip']) ? $this->ftp['ip'] : ''; $this->port = isset($this->ftp['port']) ? $this->ftp['port'] : '21'; $this->username = isset($this->ftp['username']) ? $this->ftp['username'] : ''; $this->password = isset($this->ftp['password']) ? $this->ftp['password'] : ''; $this->directory = isset($this->ftp['directory']) ? $this->ftp['directory'] : ''; $this->passive_mode = isset($this->ftp['passive']); $this->protocol = isset($this->ftp['protocol']) ? $this->ftp['protocol'] : 'http://'; $this->host = isset($this->ftp['host']) ? $this->ftp['host'] : ''; $this->folder = isset($this->ftp['folder']) ? $this->ftp['folder'] : ''; add_filter( 'qqworld-auto-save-images-media-library-mode', array($this, 'add_media_library_mode') ); add_action( 'qqworld-auto-save-images-media-library-form', array($this, 'add_media_library_form') ); add_filter( 'qqworld-auto-save-images-exclude-domain-'.$this->slug, array($this, 'exclude_domain') ); add_filter( 'qqworld-auto-save-images-saving-'.$this->slug, array($this, 'saving'), 10, 4 ); add_action( 'wp_ajax_auto_save_images_test_ftp', array($this, 'test_ftp') ); add_action( 'wp_ajax_nopriv_auto_save_images_test_ftp', array($this, 'test_ftp') ); } public function exclude_domain($exclude_domain) { if (!is_array($exclude_domain)) $exclude_domain = array(); if (!empty($this->host)) $exclude_domain[] = $this->host; return $exclude_domain; } public function saving($file, $img_name, $width, $height) { $dirs = wp_upload_dir(); if (!$this->ftp_connection) $this->access_ftp(); $temp = tmpfile(); fwrite($temp, $file); fseek($temp, 0); $this->ftp_mksubdirs($this->ftp_connection, $this->ftp['directory'], $dirs['subdir']); ftp_chdir($this->ftp_connection, '/'); if ( ftp_fput($this->ftp_connection, $this->ftp['directory'] . $dirs['subdir'] . '/' . $img_name, $temp, FTP_BINARY) ) { $res = array( "file" => $dirs['subdir'] . '/' . $img_name, 'url' => $this->protocol . $this->host . $this->folder . $dirs['subdir'] . '/' . $img_name, 'width' => $width, 'height' => $height ); } else $res = false; return $res; } public function __destruct() { if ($this->ftp_connection) ftp_close($this->ftp_connection); } public function ftp_mksubdirs($ftpcon, $ftpbasedir, $ftpath){ if (!empty($ftpbasedir)) @ftp_chdir($ftpcon, $ftpbasedir); $parts = explode('/',$ftpath); if (count($parts)) foreach($parts as $part) { if (!@ftp_chdir($ftpcon, $part)){ @ftp_mkdir($ftpcon, $part); @ftp_chdir($ftpcon, $part); } } } public function access_ftp() { $conn = ftp_connect($this->ip, $this->port); if ($conn) { if (ftp_login($conn, $this->username, $this->password)) { $this->ftp_connection = $conn; if ($this->passive_mode) ftp_pasv($this->ftp_connection, true); } else $this->ftp_connection = false; } else $this->ftp_connection = false; } public function test_ftp() { $ip = $_POST['ip']; $port = $_POST['port']; $username = $_POST['username']; $password = $_POST['password']; $directory = $_POST['directory']; $passive_mode = isset($_POST['passive_mode']); $this->ftp_connection = ftp_connect($ip, $port); if ($this->ftp_connection) { if (@ftp_login($this->ftp_connection, $username, $password)) { if ($passive_mode) ftp_pasv($this->ftp_connection, true); $this->ftp_mksubdirs($this->ftp_connection, '/', $directory); ftp_chdir($this->ftp_connection, '/'); if ($directory) { if (@ftp_chdir($this->ftp_connection, $directory) ) { $result = array( 'success' => 1, 'msg' => sprintf('<span class="green">%s</span>', __('Congratulation! FTP successfully connected.', $this->text_domain)) ); } else { $result = array( 'success' => 0, 'msg' => __('Failed to change ftp directory, Did dirctory not exist?', $this->text_domain) ); } } else { $result = array( 'success' => 1, 'msg' => sprintf('<span class="green">%s</span>', __('Congratulation! FTP successfully connected.', $this->text_domain)) ); } } else { $result = array( 'success' => 0, 'msg' => __('Whoops, FTP logon has failed!', $this->text_domain) ); } } else { $result = array( 'success' => 0, 'msg' => __('Whoops, FTP connection has failed!', $this->text_domain) ); } echo json_encode($result); exit; } public function add_media_library_mode($modes) { $modes['ftp'] = __('Use FTP remote server', $this->text_domain); return $modes; } public function add_media_library_form($optimize_mode) { ?>
	<div class="optimize-table"<?php if ($optimize_mode!='ftp') echo ' style="display: none;"'; ?>>
		<table class="form-table">
			<tbody>
				<tr valign="top" id="url-settings">
					<th scope="row"><label for="ftp-host"><?php _e('Domain & Folder', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Domain & Folder', $this->text_domain); ?>" data-content="<?php _e("Set new url structure, Do not end with '/'. The folder string must front with '/'.", $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Domain & Folder', $this->text_domain); ?></span></legend>
							<label>
								<select id="protocol-ftp" name="qqworld-auto-save-images-ftp[protocol]">
									<option value="//"<?php selected('//', $this->protocol); ?>>//</option>
									<option value="http://"<?php selected('http://', $this->protocol); ?>>http://</option>
									<option value="https://"<?php selected('https://', $this->protocol); ?>>https://</option>
								</select>
								<input type="text" name="qqworld-auto-save-images-ftp[host]" class="regular-text" placeholder="<?php _e('Host', $this->text_domain); ?>" id="ftp-host" value="<?php echo $this->host; ?>" />
								<input type="text" id="folder-ftp" name="qqworld-auto-save-images-ftp[folder]" placeholder="<?php _e('Folder (Can be empty)', $this->text_domain); ?>" value="<?php echo $this->folder; ?>" />
								<span>/2014/11/example.jpg</span>
							</label>
					</fieldset></td>
				</tr>
				<tr valign="top" id="ftp-settings">
					<th scope="row"><label for="ftp-ip"><?php _e('FTP Settings', $this->text_domain); ?></label></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('FTP Settings', $this->text_domain); ?></span></legend>
						<table id="ftp-table">
							<tr>
								<td><label for="ftp-ip"><?php _e('IP Address', $this->text_domain); ?></label></td>
								<td><input type="text" name="qqworld-auto-save-images-ftp[ip]" id="ftp-ip" value="<?php echo $this->ftp['ip']; ?>" /></td>
							</tr>
							<tr>
								<td><label for="ftp-port"><?php _e('Port', $this->text_domain); ?></label></td>
								<td><input type="text" name="qqworld-auto-save-images-ftp[port]" id="ftp-port" size="5" value="<?php echo $this->ftp['port']; ?>" /></td>
							</tr>
							<tr>
								<td><label for="ftp-username"><?php _e('Username', $this->text_domain); ?></label></td>
								<td><input type="text" name="qqworld-auto-save-images-ftp[username]" id="ftp-username" value="<?php echo $this->ftp['username']; ?>" /></td>
							</tr>
							<tr>
								<td><label for="ftp-password"><?php _e('Password', $this->text_domain); ?></label></td>
								<td><input type="password" name="qqworld-auto-save-images-ftp[password]" id="ftp-password" value="<?php echo $this->ftp['password']; ?>" /></td>
							</tr>
							<tr>
								<td><label for="ftp-directory"><?php _e('Directory', $this->text_domain); ?></label></td>
								<td><input type="text" name="qqworld-auto-save-images-ftp[directory]" id="ftp-directory" value="<?php echo $this->ftp['directory']; ?>" /></td>
							</tr>
							<tr>
								<td><label for="ftp-passive"><?php _e('Passive Mode', $this->text_domain); ?></label></td>
								<td><input type="checkbox" name="qqworld-auto-save-images-ftp[passive]" id="ftp-Passive-mode" value="yes" <?php checked('yes', $this->ftp['passive']); ?> /></td>
							</tr>
							<tr>
								<td colspan="2"><input type="button" id="test-ftp" class="button" value="<?php _e('Test FTP', $this->text_domain); ?>" /></td>
							</tr>
						</table>
					</fieldset></td>
				</tr>
				<tr valign="top" id="ftp-settings">
					<th scope="row"><?php _e('Local Debug', $this->text_domain); ?></th>
					<td><pre><code>&lt;?php
/*
 * 请将以下代码保存到ftp.php文件，填写必要的参数后上传到服务器上的任意可以通过http访问的目录
 */
$host = '127.0.0.1'; // FTP主机
$port = 21; // 端口
$username = ''; // 用户名
$password = ''; // 密码
$passive_mode = false; // 是否被动模式

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
?&gt;</code></pre><p class="description"><?php _e('If you can not connect to FTP, use the above codes to test if your server supports FTP.', $this->text_domain); ?></p></td>
				</tr>
			</tbody>
		</table>
	</div>
<?php
 } } new ftp;