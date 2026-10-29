<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-home"><?php _e('KodExplorer Homepage', $this->text_domain); ?></label></th>
				<td><input type="text" class="regular-text" placeholder="<?php _e('KodExplorer Homepage', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[home]" id="<?php print $this->guid; ?>-home" value="<?php echo $this->home; ?>" />
				<p class="description"><?php _e('Please enter the homepage URL of your KodExplorer.', $this->text_domain); ?></p></td>
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