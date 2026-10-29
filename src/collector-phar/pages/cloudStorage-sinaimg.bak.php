			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-method"><?php _e('Method of Getting Cookie', $this->text_domain); ?></label></th>
				<td>
					<select id="<?php print $this->guid; ?>-method" name="<?php print $this->field_name . '[method]'; ?>" class="selectstyle">
						<option value="manual" <?php selected('manual', $this->method); ?>><?php _e('Manual', $this->text_domain); ?></option>
						<option value="auto" <?php selected('auto', $this->method); if (version_compare(PHP_VERSION, '7.0.0', '<')) print ' disabled'; ?>><?php _e('Automatic', $this->text_domain); ?></option>
					</select>
					<p class="description"><?php _e('You need to get the cookie generated after logging in to Sina Weibo to transfer the image to Sina.<br />Note that the automated method requires a PHP version of 7.0 or higher.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="sinaimg-manual<?php if ($this->method != 'manual') print ' hidden'; ?>">
				<th scope="row"><label for="<?php print $this->guid; ?>-cookies"><?php _e('Cookies', $this->text_domain); ?></label></th>
				<td><textarea class="large-text" name="<?php print $this->field_name; ?>[cookies]" id="<?php print $this->guid; ?>-cookies" rows="5"><?php print $this->cookies; ?></textarea><p class="description"><?php printf(__('Please logged in <a href="%s" target="_blank">Sina Weibo</a> to get <a href="%s" target="_blank">Cookies</a>.', $this->text_domain), 'https://weibo.com', admin_url('admin.php?page=qqworld-collector-documents#tips--get-cookies')); ?><br /><?php _e('Notice: Cookies may be valid for only one day. If cookies cannot be synchronized to the map, please update cookies.', $this->text_domain); ?></p></td>
			</tr>
			<tr valign="top" class="sinaimg-auto<?php if ($this->method != 'auto') print ' hidden'; ?>">
				<th scope="row"><label for="<?php print $this->guid; ?>-username"><?php _e('Username'); ?></label></th>
				<td>
					<input type="text" id="<?php print $this->guid; ?>-username" name="<?php print $this->field_name . '[username]'; ?>" value="<?php print $this->username; ?>" />
					<p class="description"><?php _e('Please enter the username of Sina Weibo (email/member account/phone number), preferably an alternate account.', $this->text_domain); ?></p></td>
				</td>
			</tr>
			<tr valign="top" class="sinaimg-auto"<?php if ($this->method != 'auto') print ' hidden'; ?>>
				<th scope="row"><label for="<?php print $this->guid; ?>-password"><?php _e('Password', $this->text_domain); ?></label></th>
				<td>
					<input type="password" id="<?php print $this->guid; ?>-password" name="<?php print $this->field_name . '[password]'; ?>" value="<?php print $this->password; ?>" />
					<?php
 ?>
				</td>
			</tr>