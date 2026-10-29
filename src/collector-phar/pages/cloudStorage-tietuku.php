<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-before.php'; ?>
			<tr valign="top" id="url-settings">
				<th scope="row"><label for="<?php print $this->guid; ?>-protocol"><?php _e('Protocol', $this->text_domain); ?></label></th>
				<td>
					<select id="<?php print $this->guid; ?>-protocol" name="<?php print $this->field_name; ?>[protocol]" class="selectstyle">
						<option value="1"<?php selected(1, $this->protocol); ?>>http</option>
						<option value="2"<?php selected(2, $this->protocol); ?>>https</option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-token"><?php _ex('Token', 'tietuku', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[token]" class="large-text" placeholder="<?php _ex('Token', 'tietuku', $this->text_domain); ?>" id="<?php print $this->guid; ?>-token" value="<?php echo $this->token; ?>" />
					<p><?php printf(_x('Get token from <a href="%s" target="_blank">here</a>, The upload method is <strong>local upload</strong>.', 'tietuku', $this->text_domain), 'http://www.tietuku.com/manager/createtoken'); ?></p>
				</td>
			</tr>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-common.php'; ?>
		<tbody>
	</table>
</section>