<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-username"><?php _e('FTP Username', $this->text_domain); ?></label></th>
				<td><input type="text" name="<?php print $this->field_name; ?>[username]" class="regular-text" id="<?php print $this->guid; ?>-username" value="<?php echo $this->username; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-password"><?php _e('FTP Password', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[password]" class="regular-text" id="<?php print $this->guid; ?>-password" value="<?php echo $this->password; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-api"><?php _e('API Domain', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[api]" class="regular-text" id="<?php print $this->guid; ?>-api" value="<?php echo $this->api; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-bucket"><?php _e('Bucket', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[bucket]" class="regular-text" id="<?php print $this->guid; ?>-bucket" value="<?php echo $this->bucket; ?>" />
					<?php if ($this->enabled && $this->is_current) : ?>
						<?php if ($this->accessed) : ?>
						<div class="cloud-storage-status"><span class="successed status"><?php _e('Accessed Successfully', $this->text_domain); ?></span></div>
						<?php else : ?>
						<div class="cloud-storage-status"><span class="failed status"><?php _e('Accessed Failed', $this->text_domain); ?></span></div>
						<?php endif; ?>
					<?php endif; ?>
				</td>
			</tr>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-'. $this->guid ); ?>
		<tbody>
	</table>
</section>