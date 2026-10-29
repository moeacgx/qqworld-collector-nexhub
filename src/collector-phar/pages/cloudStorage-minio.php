<section id="<?php print $guid; ?>-form-settings" class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
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
				<th scope="row"><label for="<?php print $this->guid; ?>-host"><?php _e('Domain & Folder', $this->text_domain); ?></label></th>
				<td>
					<select id="<?php print $this->guid; ?>-protocol" name="<?php print $this->field_name; ?>[protocol]" class="selectstyle">
						<option value="//"<?php selected('//', $this->protocol); ?>>//</option>
						<option value="http://"<?php selected('http://', $this->protocol); ?>>http://</option>
						<option value="https://"<?php selected('https://', $this->protocol); ?>>https://</option>
					</select>
					<input type="text" name="<?php print $this->field_name; ?>[host]" class="regular-text" placeholder="<?php _ex('Console Address', 'minio', $this->text_domain); ?>" id="<?php print $this->guid; ?>-host" value="<?php echo $this->host; ?>" />
					<span><?php print $this->bucket ? $this->bucket : __('Bucket', $this->text_domain); ?></span>
					<span class="custom<?php if ($this->custom_upload_dir == 0) print ' hidden'; ?>"><input type="text" id="<?php print $this->guid; ?>-folder" name="<?php print $this->field_name; ?>[folder]" placeholder="<?php _e('Folder (Can be empty)', $this->text_domain); ?>" value="<?php echo $this->folder; ?>" /></span>
					<span><span class="default<?php if ($this->custom_upload_dir == 1) print ' hidden'; ?>">/<?php print $this->default_upload_dir; ?></span>/2014/11/example.jpg</span>
					<p class="description">
						<span class="qc-icon info"><?php _e('Please enter the URL address of the MinIO Console page.', $this->text_domain); ?> (e.g. http://xxx.xxx.xxx.xxx:<strong>9000</strong>, https://minio.yoursite.com)</span><br />
						<?php _e("Set new url structure, Do not end with '/'. The folder string must front with '/'.", $this->text_domain); ?>
					</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-homepage"><?php _ex('Server URL', 'minio', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[homepage]" class="regular-text" placeholder="<?php _ex('Server URL', 'minio', $this->text_domain); ?>" id="<?php print $this->guid; ?>-homepage" value="<?php echo $this->homepage; ?>" />
					<p class="description"><?php _e('Please enter the URL address of the MinIO Server page.', $this->text_domain); ?> (e.g. http://xxx.xxx.xxx.xxx:<strong>9001</strong>)</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-username"><?php _e('Username', $this->text_domain); ?></label></th>
				<td>
					<input type="text" class="regular-text" placeholder="<?php _e('Username', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[username]" id="<?php print $this->guid; ?>-username" value="<?php echo $this->username; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-password"><?php _e('Password', $this->text_domain); ?></label></th>
				<td>
					<input type="password" class="regular-text" placeholder="<?php _e('Password', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[password]" id="<?php print $this->guid; ?>-password" value="<?php echo $this->password; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-bucket"><?php _e('Bucket', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[bucket]" class="regular-text" id="<?php print $this->guid; ?>-bucket" placeholder="<?php _e('Bucket', $this->text_domain); ?>" value="<?php echo $this->bucket; ?>" />
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