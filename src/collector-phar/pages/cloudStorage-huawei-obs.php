
<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-endpoints"><?php _e('Endpoint', $this->text_domain); ?></label></th>
				<td>
					<?php
 $endpoints = array( 'cn-north-1' => __('North China - BeiJing 1', $this->text_domain), 'cn-north-4' => __('North China - BeiJing 4', $this->text_domain), 'cn-southwest-2' => __('Southwest - GuiYang 1', $this->text_domain), 'cn-east-3' => __('Eastern China - ShangHai 1', $this->text_domain), 'ap-southeast-3' => __('Asia-Pacific - Singapore', $this->text_domain), 'af-south-1' => __('Africa - Johannesburg', $this->text_domain), 'cn-east-2' => __('East China - Shanghai 2', $this->text_domain), 'cn-south-1' => __('South China - GuangZhou', $this->text_domain), 'ap-southeast-1' => __('Asia Pacific - Hong Kong', $this->text_domain), 'ap-southeast-2' => __('Asia Pacific - Bangkok', $this->text_domain) ); ?>
					<select id="<?php print $this->guid; ?>-endpoints" class="selectstyle">
						<?php
 foreach ($endpoints as $endpoint => $label) : $endpoint = "obs.{$endpoint}.myhuaweicloud.com"; ?>
							<option value="<?php print $endpoint; ?>" <?php selected($endpoint, $this->endpoint); ?>><?php print $label; ?></option>
						<?php endforeach; ?>
					</select> <input type="text" name="<?php print $this->field_name; ?>[endpoint]" class="regular-text" value="<?php print $this->endpoint; ?>" readonly />
					<p class="description"><?php _e("Default Beijing 1 endpoint, Click <a href='https://developer.huaweicloud.com/endpoint' target='_balnk'>here</a> to know more.", $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-access-key-id"><?php _ex('Access Key ID', 'huawei obs', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[access-key-id]" class="regular-text" id="<?php print $this->guid; ?>-access-key-id" value="<?php echo $this->access_key_id; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-access-key-secret"><?php _ex('Access Key Secret', 'huawei obs', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[access-key-secret]" class="regular-text" id="<?php print $this->guid; ?>-access-key-secret" value="<?php echo $this->access_key_secret; ?>" />
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
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-auto-replace"><?php _e('Cloud Thumbnail', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => $this->guid.'-cloud-thumbnail', 'name' => $this->field_name . '[cloud-thumbnail][enabled]', 'value' => $this->cloud_thumbnail_enabled )); ?>
					<p><input type="text" placeholder="<?php _e('Please use the following variables to stitch the link suffix of the cropped image.', $this->text_domain); ?>" class="large-text" name="<?php print $this->field_name; ?>[cloud-thumbnail][structure]" value="<?php print $this->cloud_thumbnail_structure; ?>" /></p>
					<p class="quick-symbol-block"><a class="symbol" href="#" title="<?php _e('Width'); ?>">(w)</a> <a class="symbol" href="#" title="<?php _e('Height'); ?>">(h)</a></p>
					<p class="description"><?php printf(__('Do not use thumbnails of the media library, use cloud thumbnails of %s.', $this->text_domain), $this->label); ?><br /><?php printf(__('It is not recommended to <strong>Disable the Thumbnail Size</strong> in <a href="%s" target="_blank">Settings</a>, also do not check the <a href="%s" target="_blank">Auto Save attachment</a> to <strong>Not Use the Media Library</strong>. because there is a compatibility issue.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-settings'), admin_url('admin.php?page=qqworld-collector-auto-save-attachment')); ?></p>
					<p class="description"><em class="qc-icon info"><?php printf(__('<strong>For example:</strong> %s', $this->text_domain), '?x-image-process=image/resize,w_(w),h_(h)'); ?></em></p>
					<p class="description"><em class="qc-icon info"><?php _e('Note that thumbnails are not uploaded when the cloud thumbnail is turned on, and turning off this feature will result in the thumbnail not being displayed.', $this->text_domain); ?></em></p>
				</td>
			</tr>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-'. $this->guid ); ?>
		<tbody>
	</table>
</section>