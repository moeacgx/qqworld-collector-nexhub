<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-before.php'; ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-host"><?php _ex('Homepage', 'chevereto', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[host]" class="regular-text" placeholder="<?php _ex('Homepage', 'chevereto', $this->text_domain); ?>" id="<?php print $this->guid; ?>-host" value="<?php echo $this->host; ?>" />
					<p><?php printf(__('Please enter your own %s homepage url.', $this->text_domain), __('Rainbow External Chain Network Disk', $this->text_domain)); ?><br /><span class="qc-icon info"><?php _e('Don\'t forget to enable the upload API on the admin page.', $this->text_domain); ?></span></p>
				</td>
			</tr>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-common.php'; ?>
		<tbody>
	</table>
</section>