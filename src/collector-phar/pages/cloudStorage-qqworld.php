<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-root-url"><?php _e('Root URL', $this->text_domain); ?></label></th>
				<td>
					<input type="text" class="regular-text" placeholder="<?php _e('Root URL', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[root-url]" id="<?php print $this->guid; ?>-root-url" value="<?php echo $this->options->cloud_storage_qqworld_root_url; ?>" /> /qqworld-cloud-file-storage-system.php
					<p class="description"><?php _e('Please fill in the accessible address of the root directory.', $this->text_domain); ?></p>
					<?php if ($this->enabled && $this->is_current) : ?>
						<?php if ($this->accessed) : ?>
						<div class="cloud-storage-status"><span class="successed status"><?php _e('Accessed Successfully', $this->text_domain); ?></span></div>
						<?php else : ?>
						<div class="cloud-storage-status"><span class="failed status"><?php _e('Accessed Failed', $this->text_domain); ?></span></div>
						<?php endif; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-token"><?php _e('Token', $this->text_domain); ?></label></th>
				<td>
					<input type="password" class="regular-text" placeholder="<?php _e('Token', $this->text_domain); ?>" name="<?php print $this->field_name; ?>[token]" id="<?php print $this->guid; ?>-token" value="<?php echo $this->options->cloud_storage_qqworld_token; ?>" /> <button type="button" class="button qc-icon format" id="create-token-btn"><?php _e('Generate token', $this->text_domain); ?></button>
					<p class="description"><?php printf(__('Please set the Token, save the settings and click the <a href="%s">here</a> to download the interface file and upload it to the root directory of the cloud storage.', $this->text_domain), admin_url('admin-ajax.php?action=qqworld-collector-cloud-stoarge-qqworld-api-file')); ?><br /><span class="qc-icon info"><?php _e('Note that after changing the Token, the interface file must be downloaded and uploaded again.', $this->text_domain); ?></span></p>
				</td>
			</tr>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-'. $this->guid ); ?>
		</tbody>
	</table>
</section>