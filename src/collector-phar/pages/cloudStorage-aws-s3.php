<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-access-key-id"><?php _ex('Access Key ID', 'aws s3', $this->text_domain); ?></label></th>
				<td><input type="text" name="<?php print $this->field_name; ?>[access-key-id]" class="regular-text" placeholder="<?php _ex('Access Key ID', 'aws s3', $this->text_domain); ?>" id="<?php print $this->guid; ?>-access-key-id" value="<?php echo $this->access_key_id; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-secret-access-key"><?php _ex('Secret Access Key', 'aws s3', $this->text_domain); ?></label></th>
				<td><input type="password" name="<?php print $this->field_name; ?>[secret-access-key]" class="regular-text" placeholder="<?php _ex('Secret Access Key', 'aws s3', $this->text_domain); ?>" id="<?php print $this->guid; ?>-secret-access-key" value="<?php echo $this->secret_access_key; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-region"><?php _e('Region', $this->text_domain); ?></label></th>
				<td>
					<?php
 $regions = array( 'us-east-2' => __('US East (Ohio) Region', $this->text_domain), 'us-east-1' => __('US East (N. Virginia) Region', $this->text_domain), 'us-west-1' => __('US West (N. California) Region', $this->text_domain), 'us-west-2' => __('US West (Oregon) Region', $this->text_domain), 'ap-east-1' => __('Asia Pacific (Hong Kong) Region', $this->text_domain), 'ap-south-1' => __('Asia Pacific (Mumbai) Region', $this->text_domain), 'ap-northeast-3' => __('Asia Pacific (Osaka-Local) Region', $this->text_domain), 'ap-northeast-2' => __('Asia Pacific (Seoul) Region', $this->text_domain), 'ap-southeast-1' => __('Asia Pacific (Singapore) Region', $this->text_domain), 'ap-southeast-2' => __('Asia Pacific (Sydney) Region', $this->text_domain), 'ap-northeast-1' => __('Asia Pacific (Tokyo) Region', $this->text_domain), 'ca-central-1' => __('Canada (Central) Region', $this->text_domain), 'eu-central-1' => __('Europe (Frankfurt) Region', $this->text_domain), 'eu-west-1' => __('Europe (Ireland) Region', $this->text_domain), 'eu-west-2' => __('Europe (London) Region', $this->text_domain), 'eu-west-3' => __('Europe (Paris) Region', $this->text_domain), 'eu-north-1' => __('Europe (Stockholm) Region', $this->text_domain), 'me-south-1' => __('Middle East (Bahrain) Region', $this->text_domain), 'sa-east-1' => __('South America (S&atilde;o Paulo) Region', $this->text_domain), ); ?>
					<select id="<?php print $this->guid; ?>-region" name="<?php print $this->field_name; ?>[region]" class="selectstyle">
						<?php foreach ($regions as $region => $label) : ?>
							<option value="<?php print $region; ?>"<?php selected($region, $this->region); ?>><?php print $label; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-bucket"><?php _ex('Bucket', 'aws s3', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[bucket]" placeholder="<?php _ex('Bucket', 'aws s3', $this->text_domain); ?>" id="<?php print $this->guid; ?>-bucket" value="<?php echo $this->bucket; ?>" />
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