<tr valign="top" class="not-for-joinmode<?php if ($this->options->cloud_storage_joinmode_enabled) print ' hidden'; ?>">
	<th scope="row"><?php _e('Scan &amp; Synchronization', $this->text_domain); ?></th>
	<td>
		<p>
			<label><?php _e('Speed', $this->text_domain); ?> <select name="sacn-speed" class="selectstyle">
				<optgroup label="<?php _e('Speed', $this->text_domain); ?>">
				<?php for ($i=1; $i<51; $i++) : ?>
					<option value="<?php print $i; ?>"><?php print $i; ?></option>
				<?php endfor; ?>
				</optgroup>
			</select></label>
			<button type="button" class="scan-to-sync button qc-icon search" data-mode="fast" data-guid="<?php print $this->guid; ?>"<?php if (!$this->accessed || $this->options->cloud_storage_joinmode_enabled) print ' disabled'; ?>><?php _e('Fast Scan', $this->text_domain); ?></button>
			<button type="button" class="scan-to-sync button qc-icon search" data-mode="smart" data-guid="<?php print $this->guid; ?>"<?php if (!$this->accessed || $this->options->cloud_storage_joinmode_enabled) print ' disabled'; ?>><?php _e('Smart Scan', $this->text_domain); ?></button>
		</p>
		<p class="description"><?php printf(__('Automatically scan media library and sync to %s, you can also manually sync one by one on the <a href="%s" target="_blank">Media Library</a> list page.', $this->text_domain), $this->label, admin_url('upload.php?mode=list')); ?><br />
		<?php _e('<strong>Fast Scan</strong>: According to whether the local file has synchronized markers.', $this->text_domain); ?><br />
		<?php _e('<strong>Smart Scan</strong>: According to the existence of the file on the cloud storage.', $this->text_domain); ?></p>
		<p class="description qc-icon info"><?php _e('If after the scan is completed, there are still unsynchronized situations when scanning again, it is recommended to check whether the local images of these attachments have been deleted.', $this->text_domain); ?></p>
		<p class="description qc-icon info"><?php _e('Do not set the scan speed too high, your server or cloud storage server may not be able to bear.', $this->text_domain); ?></p><br />
		<?php
 $this->the_switcher(array( 'id' => $this->guid.'-silent-scanning', 'name' => $this->field_name . '[silent-scanning]', 'value' => $this->silent_scanning )); ?>
		<p class="description"><?php _e("Silent scanning, you can close the window during the run, but you can't see the details of the scan.", $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Not recommended, prone to 502 or 504 errors.', $this->text_domain); ?></span></p>
	</td>
</tr>
<tr valign="top">
	<th scope="row"><label for="<?php print $this->guid; ?>-sync-delete"><?php _e('Sync Delete', $this->text_domain); ?></label></th>
	<td>
		<?php
 $this->the_switcher(array( 'id' => $this->guid.'-sync-delete', 'name' => $this->field_name . '[sync-delete]', 'value' => $this->sync_delete )); ?>
		<p class="description"><?php _e('Delete files on the cloud storage automatically when deleting a attachment from media library.', $this->text_domain); ?></p>
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
		<p class="description"><?php _e('Automatically delete local attachment files after synced.', $this->text_domain); ?></p>
		<p class="description"><em class="qc-icon info"><?php _e('It is not recommended to turn this on. It is recommended to back up the media library periodically using FTP and then delete files on FTP.', $this->text_domain); ?></em></p>
		<p class="description"><em class="qc-icon info"><?php printf(__('If you checked this, system will unable to check the uniqueness of image filename, so i recommend add <strong>%1$s</strong> to filename-structure in <a href="%2$s" target="_blank">format settings</a> of auto-save-images settings page.', $this->text_domain), '%random%', admin_url('admin.php?page=qqworld-collector-auto-save-attachment#format')); ?></em></p>
	</td>
</tr>