
<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-account-id"><?php _ex('Account ID', 'cloudflare', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[account-id]" class="regular-text" id="<?php print $this->guid; ?>-account-id" value="<?php echo $this->account_id; ?>" />
					<p class="description"><?php printf(__('When you go to the R2 Object Storage overview page, for example, if its address is <em>%s</em>, then the Account ID is <strong>%s</strong>.', $this->text_domain), 'https://dash.cloudflare.com/<strong>0c65c931574533f3b0531dc0146169ae</strong>/r2/overview', '0c65c931574533f3b0531dc0146169ae'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-access-key-id"><?php _ex('Access Key ID', 'cloudflare', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[access-key-id]" class="regular-text" id="<?php print $this->guid; ?>-access-key-id" value="<?php echo $this->access_key_id; ?>" />
					<p><?php _e('Obtain when creating an account API token.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-access-key-secret"><?php _ex('Access Key Secret', 'cloudflare', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[access-key-secret]" class="regular-text" id="<?php print $this->guid; ?>-access-key-secret" value="<?php echo $this->access_key_secret; ?>" />
					<p class="description"><?php _e('Obtain when creating an account API token.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-bucket"><?php _ex('Bucket', 'huawei obs', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[bucket]" class="regular-text" id="<?php print $this->guid; ?>-bucket" value="<?php echo $this->bucket; ?>" />
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
		<tbody>
	</table>
</section>