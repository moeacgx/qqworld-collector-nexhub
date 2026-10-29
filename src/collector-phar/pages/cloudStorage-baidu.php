<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-before.php'; ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-cookies"><?php _e('Cookies', $this->text_domain); ?></label></th>
				<td><textarea class="large-text" name="<?php print $this->field_name; ?>[cookies]" placeholder="Cookie: ..." id="<?php print $this->guid; ?>-cookies" rows="5"><?php print $this->cookies; ?></textarea><p class="description"><?php printf(__('Please logged in <a href="%s" target="_blank">Baidu Baijia Back-Stage Management
</a> to get <a href="%s" target="_blank">Cookies</a>.', $this->text_domain), 'https://baijiahao.baidu.com/', admin_url('admin.php?page=qqworld-collector-documents#tips--get-cookies')); ?><br /><?php _e('Notice: Cookies may be valid for only one day. If cookies cannot be synchronized to the map, please update cookies.', $this->text_domain); ?></p></td>
			</tr>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-common.php'; ?>
		<tbody>
	</table>
</section>