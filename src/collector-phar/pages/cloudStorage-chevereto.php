<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-before.php'; ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-host"><?php _ex('Homepage', 'chevereto', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[host]" class="regular-text" placeholder="<?php _ex('Homepage', 'chevereto', $this->text_domain); ?>" id="<?php print $this->guid; ?>-host" value="<?php echo $this->host; ?>" />
					<p><?php _ex('Please enter your own chevereto homepage url.', 'chevereto', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-api-v1-key"><?php _ex('API v1 key', 'chevereto', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[api-v1-key]" class="regular-text" placeholder="<?php _ex('API v1 key', 'chevereto', $this->text_domain); ?>" id="<?php print $this->guid; ?>-api-v1-key" value="<?php echo $this->api_v1_key; ?>" />
					<p><?php printf(_x('Please get <a href="%s" target="_blank">API v1 key</a> in your chevereto site, Leave blank to upload anonymously.', 'chevereto', $this->text_domain), $this->host . '/dashboard/settings/api'); ?></p>
				</td>
			</tr>
			<tr valign="top"<?php if (!$this->api_v1_key) print ' class="hidden"'; ?>>
				<th scope="row"><label for="<?php print $this->guid; ?>-album-id"><?php _ex('Album ID', 'chevereto', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[album-id]" placeholder="<?php _ex('Album ID', 'chevereto', $this->text_domain); ?>" id="<?php print $this->guid; ?>-album-id" value="<?php echo $this->album_id; ?>" />
					<p><?php _ex('Enter the album ID, that is, the last string of characters in the album address, which can be left blank.', 'chevereto', $this->text_domain); ?></p>
				</td>
			</tr>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-common.php'; ?>
		<tbody>
	</table>
</section>