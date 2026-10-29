<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-proxy_suffix"><?php _e('Proxy Suffix', $this->text_domain); ?></label></th>
				<td><input type="text" name="<?php print $this->field_name; ?>[proxy_suffix]" class="regular-text" placeholder="<?php _e('Proxy Suffix', $this->text_domain); ?>" id="<?php print $this->guid; ?>-proxy_suffix" value="<?php echo $this->proxy_suffix; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-public_key"><?php _e('Public KEY', $this->text_domain); ?></label></th>
				<td><input type="text" name="<?php print $this->field_name; ?>[public_key]" class="regular-text" placeholder="<?php _e('Public KEY', $this->text_domain); ?>" id="<?php print $this->guid; ?>-public_key" value="<?php echo $this->public_key; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-private_key"><?php _e('Private Key', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[private_key]" class="regular-text" placeholder="<?php _e('Private Key', $this->text_domain); ?>" id="<?php print $this->guid; ?>-private_key" value="<?php echo $this->private_key; ?>" />
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
				<th scope="row"><label for="<?php print $this->guid; ?>-bucket"><?php _ex('Bucket', 'ucloud', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[bucket]" placeholder="<?php _ex('Bucket', 'ucloud', $this->text_domain); ?>" id="<?php print $this->guid; ?>-bucket" value="<?php echo $this->bucket; ?>" />
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
					<p class="description"><em class="qc-icon info"><?php printf(__('<strong>For example:</strong> %s', $this->text_domain), '?iopcmd=crop&width=(w)&height=(h)'); ?></em></p>
					<p class="description"><em class="qc-icon info"><?php _e('Note that thumbnails are not uploaded when the cloud thumbnail is turned on, and turning off this feature will result in the thumbnail not being displayed.', $this->text_domain); ?></em></p>
					<p class="description"><em class="qc-icon info"><?php _e('Not compatible with Join Mode!', $this->text_domain); ?></em></p>
				</td>
			</tr>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-'. $this->guid ); ?>
		<tbody>
	</table>
</section>