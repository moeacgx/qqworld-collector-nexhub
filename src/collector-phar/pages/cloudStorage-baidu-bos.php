<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-accesskey"><?php _e('Access Key', $this->text_domain); ?></label></th>
				<td><input type="text" name="<?php print $this->field_name; ?>[accesskey]" class="regular-text" id="<?php print $this->guid; ?>-accesskey" value="<?php echo $this->accesskey; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-secretkey"><?php _e('Secret Key', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[secretkey]" class="regular-text" id="<?php print $this->guid; ?>-secretkey" value="<?php echo $this->secretkey; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-endpoint"><?php _e('Region', $this->text_domain); ?></label></th>
				<td>
					<select id="<?php print $this->guid; ?>-endpoint" name="<?php print $this->field_name; ?>[endpoint]" class="selectstyle">
						<option value="bj.bcebos.com" <?php selected('bj.bcebos.com', $this->endpoint); ?>><?php _ex('North China - Bei Jing', 'baidu bos', $this->text_domain); ?></option>
						<option value="bd.bcebos.com" <?php selected('bd.bcebos.com', $this->endpoint); ?>><?php _ex('North China - Bao Ding', 'baidu bos', $this->text_domain); ?></option>
						<option value="su.bcebos.com" <?php selected('su.bcebos.com', $this->endpoint); ?>><?php _ex('East China - Su Zhou', 'baidu bos', $this->text_domain); ?></option>
						<option value="gz.bcebos.com" <?php selected('gz.bcebos.com', $this->endpoint); ?>><?php _ex('South China - Guang Zhou', 'baidu bos', $this->text_domain); ?></option>
						<option value="fsh.bcebos.com" <?php selected('fsh.bcebos.com', $this->endpoint); ?>><?php _ex('East China - Shang Hai', 'baidu bos', $this->text_domain); ?></option>
						<option value="hkg.bcebos.com" <?php selected('hkg.bcebos.com', $this->endpoint); ?>><?php _ex('Hongkong', 'baidu bos', $this->text_domain); ?></option>
						<option value="sin.bcebos.com" <?php selected('sin.bcebos.com', $this->endpoint); ?>><?php _ex('Singapore', 'baidu bos', $this->text_domain); ?></option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-bucket"><?php _e('Bucket', $this->text_domain); ?></label></th>
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
					<p class="description"><em class="qc-icon info"><?php printf(__('<strong>For example:</strong> %s', $this->text_domain), '@s_0,w_(w),h_(h),l_1,q_75'); ?></em></p>
					<p class="description"><em class="qc-icon info"><?php _e('Note that thumbnails are not uploaded when the cloud thumbnail is turned on, and turning off this feature will result in the thumbnail not being displayed.', $this->text_domain); ?></em></p>
					<p class="description"><em class="qc-icon info"><?php _e('Not compatible with Join Mode!', $this->text_domain); ?></em></p>
				</td>
			</tr>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-'. $this->guid ); ?>
		<tbody>
	</table>
</section>