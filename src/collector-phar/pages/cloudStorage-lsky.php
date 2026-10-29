<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-before.php'; ?>
			<!--<tr valign="top">
				<th scope="row"><label for="<?php print $this->version; ?>-version"><?php _e('Version', $this->text_domain); ?></label></th>
				<td>
					<label><input type="radio" name="<?php print $this->field_name; ?>[version]" value="pro" <?php if ($this->version == 'pro') print 'checked'; ?> /> <?php _e('Paid Version', $this->text_domain); ?></label><br />
					<label><input type="radio" name="<?php print $this->field_name; ?>[version]" value="new" <?php if ($this->version == 'new') print 'checked'; ?> /> <?php _e('New Version', $this->text_domain); ?></label><br />
					<label><input type="radio" name="<?php print $this->field_name; ?>[version]" value="old" <?php if ($this->version == 'old') print 'checked'; ?> /> <?php _e('Old Version', $this->text_domain); ?></label>
				</td>
			</tr>-->
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-host"><?php _e('Homepage', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[host]" class="regular-text" placeholder="<?php _e('Homepage', $this->text_domain); ?>" id="<?php print $this->guid; ?>-host" value="<?php echo $this->host; ?>" />
					<p><?php _e('Please enter your own Lsky Pro homepage url.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="lsky paid<?php if ($this->version != 'pro') print ' hidden'; ?>">
				<th scope="row"><label for="<?php print $this->guid; ?>-token"><?php _e('Token', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[token]" class="regular-text" placeholder="<?php _e('Token', $this->text_domain); ?>" id="<?php print $this->guid; ?>-token" value="<?php echo $this->token; ?>" />
					<p><?php _e('Please fill in the paid version Token.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="lsky paid<?php if ($this->version != 'pro') print ' hidden'; ?>">
				<th scope="row"><label for="<?php print $this->guid; ?>-album-id"><?php _e('Album ID', $this->text_domain); ?></label></th>
				<td>
					<input type="number" name="<?php print $this->field_name; ?>[album-id]" class="small-text" placeholder="<?php _e('Album ID', $this->text_domain); ?>" id="<?php print $this->guid; ?>-album-id" value="<?php echo $this->album_id; ?>" />
					<p><?php _e('Please fill in the Album ID.', $this->text_domain); ?></p>
				</td>
			</tr>
			<!--<tr valign="top" class="lsky free<?php if ($this->version == 'pro') print ' hidden'; ?>">
				<th scope="row"><label for="<?php print $this->guid; ?>-username"><?php _ex('E-Mail', 'contact', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[username]" class="regular-text" placeholder="<?php _ex('E-Mail', 'contact', $this->text_domain); ?>" id="<?php print $this->guid; ?>-username" value="<?php echo $this->username; ?>" />
					<p><?php _e('Leave it blank to upload the image anonymously, but it may not work because the website prohibits anonymous uploading.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="lsky free<?php if ($this->version == 'pro') print ' hidden'; ?>">
				<th scope="row"><label for="<?php print $this->guid; ?>-password"><?php _e('Password', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[password]" class="regular-text" placeholder="<?php _e('Password', $this->text_domain); ?>" id="<?php print $this->guid; ?>-password" value="<?php echo $this->password; ?>" />
					<p><?php _e('Leave it blank to upload the image anonymously, but it may not work because the website prohibits anonymous uploading.', $this->text_domain); ?></p>
				</td>
			</tr>-->
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-common.php'; ?>
		<tbody>
	</table>
</section>