<tr valign="top" class="not-for-joinmode<?php if ($this->options->cloud_storage_joinmode_enabled) print ' hidden'; ?>">
	<th scope="row"><?php _e('Scan &amp; Synchronization', $this->text_domain); ?></th>
	<td>
		<?php
 $this->the_switcher(array( 'id' => $this->guid.'-silent-scanning', 'name' => $this->field_name . '[silent-scanning]', 'value' => $this->silent_scanning )); ?>
		<p class="description"><?php _e("Silent scanning, you can close the window during the run, but you can't see the details of the scan.", $this->text_domain); ?></p>
		<p><button type="button" class="scan-to-sync button qc-icon search" data-mode="fast" data-guid="<?php print $this->guid; ?>"<?php if (!$this->accessed || $this->options->cloud_storage_joinmode_enabled) print ' disabled'; ?>><?php _e('Fast Scan', $this->text_domain); ?></button></p>
		<p class="description"><?php printf(__('Automatically scan media library and sync to %s.', $this->text_domain), $this->label); ?><br />
		<?php _e('<strong>Fast Scan</strong>: According to whether the local file has synchronized markers.', $this->text_domain); ?></p>
	</td>
</tr>
<tr valign="top" class="not-for-joinmode<?php if ($this->options->cloud_storage_joinmode_enabled) print ' hidden'; ?>">
	<th scope="row"><label for="restore-<?php print $this->guid; ?>"><?php _e('Restore', $this->text_domain); ?></label></th>
	<td>
		<button type="button" class="restore-media-library button qc-icon restore" data-guid="<?php print $this->guid; ?>" id="restore-<?php print $this->guid; ?>"<?php if (!$this->accessed || $this->options->cloud_storage_joinmode_enabled) print ' disabled'; ?>><?php _e('Restore', $this->text_domain); ?></button>
		<p class="description"><?php _e('Notice: All synced attachment would restore to initial status. Please backup database first.', $this->text_domain); ?></p>
	</td>
</tr>
<tr valign="top" class="not-for-joinmode<?php if ($this->options->cloud_storage_joinmode_enabled) print ' hidden'; ?>">
	<th scope="row"><label for="<?php print $this->guid; ?>-delete-attachment-after-synced"><?php _e('Delete Attachment After Synced', $this->text_domain); ?></label></th>
	<td>
		<?php
 $this->the_switcher(array( 'id' => $this->guid.'-delete-attachment-after-synced', 'name' => $this->field_name . '[delete-attachment-after-synced]', 'value' => $this->delete_attachment_after_synced )); ?>
		<p class="description"><?php _e("Automatically delete local attachment after synced.", $this->text_domain); ?></p>
		<p class="description"><em class="qc-icon info"><?php _e('It is not recommended to turn this on. It is recommended to back up the media library periodically using FTP and then delete files on FTP.', $this->text_domain); ?></em></p>
		<p class="description"><em class="qc-icon info"><?php printf(__('If you checked this, system will unable to check the uniqueness of image filename, so i recommend add <strong>%1$s</strong> to filename-structure in <a href="%2$s" target="_blank">format settings</a> of auto-save-images settings page.', $this->text_domain), '%random%', admin_url('admin.php?page=qqworld-collector-auto-save-attachment#format')); ?></em></p>
	</td>
</tr>