<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-custom-upload-dir"><?php _e('Custom Upload Directory', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => $this->guid.'-custom-upload-dir', 'name' => $this->field_name . '[custom-upload-dir]', 'value' => $this->custom_upload_dir )); ?>
					<p class="description"><?php printf(__("The media will be uploaded to <em>%s</em> by default. If you want to customize the upload directory, please tick here.", $this->text_domain), $this->default_upload_dir); ?><br /><em class="qc-icon info"><?php _e('Note: Only files in the media library will be affected.', $this->text_domain); ?></em></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-host"><?php _e('Folder', $this->text_domain); ?></label></th>
				<td>
					<span class="custom<?php if ($this->custom_upload_dir == 0) print ' hidden'; ?>"><input type="text" id="<?php print $this->guid; ?>-folder" name="<?php print $this->field_name; ?>[folder]" placeholder="<?php _e('Folder (Can be empty)', $this->text_domain); ?>" value="<?php echo $this->folder; ?>" /></span>
					<span><span class="default<?php if ($this->custom_upload_dir == 1) print ' hidden'; ?>">/<?php print $this->default_upload_dir; ?></span>/2014/11/example.jpg</span>
					<p class="description"><?php _e("The folder string must front with '/'.", $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-home"><?php _e('Kodbox Homepage', $this->text_domain); ?></label></th>
				<td><input type="text" class="regular-text" placeholder="<?php _e('KodExplorer Homepage', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[home]" id="<?php print $this->guid; ?>-home" value="<?php echo $this->home; ?>" />
				<p class="description"><?php _e('Please enter the homepage URL of your Kodbox.', $this->text_domain); ?></p></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-username"><?php _e('Username', $this->text_domain); ?></label></th>
				<td>
					<input type="text" placeholder="<?php _e('Username', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[username]" id="<?php print $this->guid; ?>-username" value="<?php echo $this->username; ?>" />
					<p class="description"><?php _e("The user's home directory will be the upload directory for the cloud storage.", $this->text_domain); ?></p></td>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-password"><?php _e('Password', $this->text_domain); ?></label></th>
				<td>
					<input type="password" placeholder="<?php _e('Password', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[password]" id="<?php print $this->guid; ?>-password" value="<?php echo $this->password; ?>" />
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
		</tbody>
	</table>
</section>