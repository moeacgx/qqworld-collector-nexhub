<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-before.php'; ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-host"><?php _e('Domain', $this->text_domain); ?></label><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#cloud-storage--custom-api--image-hosting-api'); ?>" target="_blank" title="<?php _e('Help Documents', $this->text_domain); ?>" class="alignright qc-icon test help-documents"></a></th>
				<td>
					<input type="text" class="regular-text" name="<?php print $this->field_name; ?>[host]" placeholder="<?php _e('Domain', $this->text_domain); ?>" id="<?php print $this->guid; ?>-host" value="<?php print $this->host; ?>" />
					<p class="description"><?php _e('Please fill in the domain name of the image hosting address, which is used to the excluded domain name of Auto Save Attachments.', $this->text_domain); ?></p>
				</td>
			</tr>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-common.php'; ?>
		<tbody>
	</table>
</section>