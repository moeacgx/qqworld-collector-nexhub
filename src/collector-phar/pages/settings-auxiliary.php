<h3><?php _e('Auxiliary Settings', $this->text_domain); ?></h3>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row"><label for="qqworld-collector-settings-enabled-auto-featrued-image"><?php _e('Automatically Featured Image', $this->text_domain); ?></label><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--additional--get-first-image-as-featured-image-from-post-content'); ?>" target="_blank" title="<?php _e('Help Documents', $this->text_domain); ?>" class="alignright qc-icon test help-documents"></a></th>
			<td>
				<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-enabled-auto-featrued-image', 'name' => $this->settings_name . '[auxiliary-settings][auto-featrued-image]', 'value' => $this->options->qc_auxiliary_settings_auto_featured_image )); ?>
				<p class="description"><?php _e('If the post does not have a feature image, the first image in the post content is dynamically obtained as a feature image in the front end, but it is not saved to the database.', $this->text_domain); ?></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="qqworld-collector-settings-enabled-show-featrued-image"><?php _e('Show Featured Image', $this->text_domain); ?></label></th>
			<td>
				<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-enabled-show-featrued-image', 'name' => $this->settings_name . '[auxiliary-settings][featrued-image]', 'value' => $this->options->qc_auxiliary_settings_featured_image )); ?>
				<p class="description"><?php _e("Show featured image in posts list column of admin page.", $this->text_domain); ?></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="qqworld-collector-settings-enabled-show-uploaded-images"><?php _e('Show Uploaded Images', $this->text_domain); ?></label></th>
			<td>
				<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-enabled-show-uploaded-images', 'name' => $this->settings_name . '[auxiliary-settings][uploaded-images]', 'value' => $this->options->qc_auxiliary_settings_uploaded_images )); ?>
				<p class="description"><?php _e("Show uploaded image in posts list column of admin page.", $this->text_domain); ?></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="qqworld-collector-settings-enabled-show-inner-images"><?php _e('Show Inner Images', $this->text_domain); ?></label></th>
			<td>
				<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-enabled-show-inner-images', 'name' => $this->settings_name . '[auxiliary-settings][inner-images]', 'value' => $this->options->qc_auxiliary_settings_inner_images )); ?>
				<p><?php _e("Show inner image in posts list column of admin page, including remote images.", $this->text_domain); ?></p>
			</td>
		</tr>
	</tbody>
</table>