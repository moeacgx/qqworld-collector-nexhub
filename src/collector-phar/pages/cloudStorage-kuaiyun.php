<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-access_key"><?php _e('Access Key', $this->text_domain); ?></label></th>
				<td><input type="text" name="<?php print $this->field_name; ?>[access_key]" class="regular-text" placeholder="<?php _e('Access KEY', $this->text_domain); ?>" id="<?php print $this->guid; ?>-access_key" value="<?php echo $this->access_key; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-secret_key"><?php _e('Secret Key', $this->text_domain); ?></label></th>
				<td><input type="password" name="<?php print $this->field_name; ?>[secret_key]" class="regular-text" placeholder="<?php _e('Secret KEY', $this->text_domain); ?>" id="<?php print $this->guid; ?>-secret_key" value="<?php echo $this->secret_key; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-voucher"><?php _ex('Voucher', 'kuaiyun', $this->text_domain); ?></label></th>
				<td><input type="text" name="<?php print $this->field_name; ?>[voucher]" class="regular-text" placeholder="<?php _ex('Voucher', 'kuaiyun', $this->text_domain); ?>" id="<?php print $this->guid; ?>-voucher" value="<?php echo $this->voucher; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-resource"><?php _ex('Resource', 'kuaiyun', $this->text_domain); ?></label></th>
				<td><input type="text" name="<?php print $this->field_name; ?>[resource]" class="regular-text" placeholder="<?php _ex('Resource', 'kuaiyun', $this->text_domain); ?>" id="<?php print $this->guid; ?>-resource" value="<?php echo $this->resource; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-bucket"><?php _ex('Bucket', 'ucloud', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[bucket]" placeholder="<?php _ex('Bucket', 'ucloud', $this->text_domain); ?>" id="<?php print $this->guid; ?>-bucket" value="<?php echo $this->bucket; ?>" />
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