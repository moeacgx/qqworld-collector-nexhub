<?php if ($this->options->cloud_storage_statistics) : ?><tr valign="top">
	<th scope="row"><label for="<?php print $this->guid; ?>-statistics"><?php _e('Statistics', $this->text_domain); ?></label></th>
	<td><?php
 $count_all = $this->get_all_attachment_count(); $count = $this->get_synced_attachment_count(); printf(__('A total of <strong>%d</strong> attachments, <strong>%d</strong> have been synchronized, <strong>%d</strong> have not been synchronized.', $this->text_domain), $count_all, $count, $count_all-$count); ?></td>
</tr><?php endif; ?>
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
		<input type="text" name="<?php print $this->field_name; ?>[host]" class="regular-text" placeholder="<?php _e('Host', $this->text_domain); ?>" id="<?php print $this->guid; ?>-host" value="<?php echo $this->host; ?>" />
		<span class="custom<?php if ($this->custom_upload_dir == 0) print ' hidden'; ?>"><input type="text" id="<?php print $this->guid; ?>-folder" name="<?php print $this->field_name; ?>[folder]" placeholder="<?php _e('Folder (Can be empty)', $this->text_domain); ?>" value="<?php echo $this->folder; ?>" /></span>
		<span><span class="default<?php if ($this->custom_upload_dir == 1) print ' hidden'; ?>">/<?php print $this->default_upload_dir; ?></span>/2014/11/example.jpg</span>
		<p class="description"><?php _e("Set new url structure, Do not end with '/'. The folder string must front with '/'.", $this->text_domain); ?></p>
	</td>
</tr>