<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-type"><?php _e('Type', $this->text_domain); ?></label></th>
				<td>
					<select name="<?php print $this->field_name; ?>[type]" id="<?php print $this->guid; ?>-type" class="selectstyle">
						<option value="ftp"<?php selected('ftp', $this->type); ?>>FTP</option>
						<option value="sftp"<?php selected('sftp', $this->type); ?>>SFTP over SSH</option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-ip"><?php _e('IP Address', $this->text_domain); ?></label></th>
				<td>
					<input type="text" class="regular-text" placeholder="<?php _e('IP Address', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[ip]" id="<?php print $this->guid; ?>-ip" value="<?php echo $this->options->cloud_storage_ftp_ip; ?>" />
					<p class="description"><?php _e("If you can't connect, you can consider turning on passive mode or upgrading the FTP service program.", $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-port"><?php _e('Port', $this->text_domain); ?></label></th>
				<td><input type="number" placeholder="<?php _e('Port', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[port]" id="<?php print $this->guid; ?>-port" size="5" class="small-text" value="<?php echo $this->port; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-username"><?php _e('Username', $this->text_domain); ?></label></th>
				<td><input type="text" placeholder="<?php _e('Username', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[username]" id="<?php print $this->guid; ?>-username" value="<?php echo $this->username; ?>" /></td>
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
			<?php  ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-passive"><?php _e('Passive Mode', $this->text_domain); ?></label></th>
				<td><?php
 $this->the_switcher(array( 'id' => $this->guid.'-passive', 'name' => $this->field_name . '[passive]', 'value' => $this->passive )); ?><p class="description"><?php _e('Many FTP servers need to enable passive mode to upload files.', $this->text_domain); ?></p></td>
			</tr>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-'. $this->guid ); ?>
		</tbody>
	</table>
</section>