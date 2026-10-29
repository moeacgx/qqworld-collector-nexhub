<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-before.php'; ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-api-url"><?php _e('API URL', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[apiUrl]" class="regular-text" placeholder="<?php _e('API URL', $this->text_domain); ?>" id="<?php print $this->guid; ?>-api-url" value="<?php print $this->apiUrl; ?>" />
					<p><?php printf(__('Please get the bohe image storage API URL from <a href="%s" target="_blank">here</a>.', $this->text_domain), 'https://zixiaoyun.com/'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-token"><?php _e('Token', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[token]" class="regular-text" placeholder="<?php _e('Token', $this->text_domain); ?>" id="<?php print $this->guid; ?>-token" value="<?php print $this->token; ?>" />
					<p><?php printf(__('Please get the bohe image storage API Token from <a href="%s" target="_blank">here</a>.', $this->text_domain), 'https://zixiaoyun.com/'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-naming-mode"><?php _e('Naming Modes', $this->text_domain); ?></label></th>
				<td>
					<?php
 $modes = array( 1 => __('Auto-renaming', $this->text_domain), 2 => __('Keep original filename', $this->text_domain), 3 => __('Auto-renaming (short link mode)', $this->text_domain) ); ?>
					<select id="<?php print $this->guid; ?>-naming-mode" name="<?php print $this->field_name; ?>[namingMode]" class="selectstyle">
					<?php foreach ($modes as $mode => $label) : ?>
						<option value="<?php print $mode; ?>" <?php selected($mode, $this->namingMode); ?>><?php print $label; ?></option>
					<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-upload-path"><?php _e('Upload Path', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[uploadPath]" class="regular-text" placeholder="<?php _e('Upload Path', $this->text_domain); ?>" id="<?php print $this->guid; ?>-upload-path" value="<?php print $this->uploadPath; ?>" />
				</td>
			</tr>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-common.php'; ?>
		<tbody>
	</table>
</section>