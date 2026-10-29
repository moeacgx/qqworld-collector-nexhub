<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-username"><?php _e('Github Username', $this->text_domain); ?></label></th>
				<td>
					<input type="text" class="regular-text" placeholder="<?php _e('Github Username', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[username]" id="<?php print $this->guid; ?>-username" value="<?php echo $this->username; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-email"><?php _e('Github E-mail', $this->text_domain); ?></label></th>
				<td>
					<input type="text" class="regular-text" placeholder="<?php _e('Github E-mail', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[email]" id="<?php print $this->guid; ?>-email" value="<?php echo $this->email; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-repository-name"><?php _e('Repository Name', $this->text_domain); ?></label></th>
				<td>
					<input type="text" class="regular-text" placeholder="<?php _e('Repository Name', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[repository-name]" id="<?php print $this->guid; ?>-repository-name" value="<?php echo $this->repository_name; ?>" />
					<p class="description"><?php printf(__('If you don\'t have %s, please goto <a href="%s" target="_blank">%s</a> to get one.', $this->text_domain), __('Repository Name', $this->text_domain), 'https://github.com/new', 'Github'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-token"><?php _e('Token', $this->text_domain); ?></label></th>
				<td>
					<input type="password" class="regular-text" placeholder="<?php _e('Token', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[token]" id="<?php print $this->guid; ?>-token" value="<?php echo $this->token; ?>" />
					<p class="description"><?php printf(__('If you don\'t have %s, please goto <a href="%s" target="_blank">%s</a> to get one.', $this->text_domain), __('Token', $this->text_domain), 'https://github.com/settings/tokens/new', 'Github'); ?></p>
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