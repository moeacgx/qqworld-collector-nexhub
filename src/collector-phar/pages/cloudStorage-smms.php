<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-before.php'; ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-secret-token"><?php _e('Secret Token', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[secret-token]" class="regular-text" placeholder="<?php _e('Secret Token', $this->text_domain); ?>" id="<?php print $this->guid; ?>-secret-token" value="<?php echo $this->secret_token; ?>" />
					<p><?php printf(__('Please log in to <a href="%s" target="_blank">MS.SM</a> to get the Secret Token. If you leave it blank, upload it anonymously.', $this->text_domain), 'https://sm.ms/home/apitoken'); ?></p>
				</td>
			</tr>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-common.php'; ?>
		<tbody>
	</table>
</section>