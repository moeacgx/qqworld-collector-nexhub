
<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-access-key"><?php _e('Access Key', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[access-key]" class="regular-text" id="<?php print $this->guid; ?>-access-key" value="<?php echo $this->accessKey; ?>" />
					<p class="description"><?php printf(__('Get it in the <a href="%s" target="_blank">Key Management</a> of the user center.', $this->text_domain), 'https://console.dogecloud.com/user/keys'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-secret-key"><?php _e('Secret Key', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[secret-key]" class="regular-text" id="<?php print $this->guid; ?>-secret-key" value="<?php echo $this->secretKey; ?>" />
					<p class="description"><?php printf(__('Get it in the <a href="%s" target="_blank">Key Management</a> of the user center.', $this->text_domain), 'https://console.dogecloud.com/user/keys'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-s3-bucket"><?php _e('S3 Bucket', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[s3-bucket]" class="regular-text" id="<?php print $this->guid; ?>-bucket" value="<?php echo $this->s3_bucket; ?>" />
					<p class="description"><?php printf(__('Get it in the <a href="%s" target="_blank">SDK Parameters</a> of the storage space.', $this->text_domain), 'https://console.dogecloud.com/oss/list'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-s3-endpoint"><?php _e('S3 Endpoint', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[s3-endpoint]" class="regular-text" id="<?php print $this->guid; ?>-s3-endpoint" value="<?php echo $this->s3_endpoint; ?>" />
					<p class="description"><?php _e('Get it in the <a href="%s" target="_blank">SDK Parameters</a> of the storage space.', $this->text_domain); ?></p>
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