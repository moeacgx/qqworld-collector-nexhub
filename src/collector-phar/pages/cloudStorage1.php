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
	<th scope="row"><label for="<?php print $this->guid; ?>-auto-replace"><?php _e('Auto Replace', $this->text_domain); ?></label></th>
	<td>
		<?php
 $this->the_switcher(array( 'id' => $this->guid.'-auto-replace', 'name' => $this->field_name . '[auto-replace]', 'value' => $this->auto_replace )); ?>
		<p class="description"><?php _e("Automatically replace the attachment url in the post content with the cloud storage url when synchronizing.", $this->text_domain); ?></p>
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
	<th scope="row"><label for="<?php print $this->guid; ?>-delete-attachment-after-synced"><?php _e('Delete Attachment After Synced', $this->text_domain); ?></label></th>
	<td>
		<?php
 $this->the_switcher(array( 'id' => $this->guid.'-delete-attachment-after-synced', 'name' => $this->field_name . '[delete-attachment-after-synced]', 'value' => $this->delete_attachment_after_synced )); ?>
		<p class="description"><?php _e('Automatically delete local attachment files after synced.', $this->text_domain); ?></p>
		<p class="description"><em class="qc-icon info"><?php _e('It is not recommended to turn this on. It is recommended to back up the media library periodically using FTP and then delete files on FTP.', $this->text_domain); ?></em></p>
		<p class="description"><em class="qc-icon info"><?php printf(__('If you checked this, system will unable to check the uniqueness of image filename, so i recommend add <strong>%1$s</strong> to filename-structure in <a href="%2$s" target="_blank">format settings</a> of auto-save-images settings page.', $this->text_domain), '%random%', admin_url('admin.php?page=qqworld-collector-auto-save-attachment#format')); ?></em></p>
	</td>
</tr>
<tr valign="top">
	<th scope="row"><label for="<?php print $this->guid; ?>-sync-the-website-resource"><?php _e('Sync the Website Resource', $this->text_domain); ?></label></th>
	<td>
		<?php
 $this->the_switcher(array( 'id' => $this->guid.'-sync-the-website-resource', 'name' => $this->field_name . '[sync-the-website-resource]', 'value' => $this->sync_the_website_resource )); ?>
		<p class="description"><?php _e("Synchronize the resource files in the website, Mainly used to synchronize the theme's CSS, JS and other files.", $this->text_domain); ?></p>
	</td>
</tr>
<tr valign="top">
	<th scope="row"><label for="<?php print $this->guid; ?>-website-resource-filetypes"><?php _e('File Types', $this->text_domain); ?></label></th>
	<td><?php
 $file_types = $this->get_allowed_file_types(); $file_types['others'] = array( 'text' => array('js', 'css') ); __('Others (%s)', $this->text_domain); foreach ($file_types as $type => $file_type) { $all_extensions = array(); foreach ($file_type as $extensions) { $all_extensions = array_merge($all_extensions, $extensions); } if ($type == 'image') $all_extensions = array_merge($all_extensions, array('bmp')); ?><p><label>
			<input name="<?php print $this->field_name; ?>[website-resource-filetypes][]" type="checkbox" value="<?php print $type; ?>" <?php checked(true, in_array($type, $this->website_resource_filetypes)); ?> />
			<?php printf(__(ucfirst($type) . ' (%s)', $this->text_domain), implode(', ', $all_extensions)); ?>
		</label></p>
		<?php
 } ?>
		<p class="description"><?php _e('Please select the type of website resource file to passive sync.', $this->text_domain); ?></p>
	</td>
</tr>
<tr valign="top">
	<th scope="row"><?php _e('Scan &amp; Synchronization', $this->text_domain); ?></th>
	<td>
		<p><button type="button" class="button sync-website-resources qc-icon export" data-mode="<?php echo $this->guid; ?>"<?php if (!$this->accessed) print ' disabled'; ?>><?php _e('Scan Website Resources', $this->text_domain); ?></button>
		<button type="button" class="button delete-website-resources qc-icon delete" data-mode="<?php echo $this->guid; ?>"<?php if (!$this->accessed || empty($this->website_resources_cache)) print ' disabled'; ?>><?php _e('Delete Website Resources Cache', $this->text_domain); ?></button></p>
		<p class="description"><?php _e('Scan and synchronize the resource files in the website, it may take a long time.', $this->text_domain ); ?></p>
		<p class="description qc-icon info"><?php _e('<strong>No scan is required</strong> if automatic backtrace is set, You just need to manually upload the required font files to the corresponding directory on the cloud storage.', $this->text_domain); ?></p>
		<p class="description"><em class="qc-icon info"><?php printf(__("Don't forget to set the return source address in the %s management console and fill in the home page address.", $this->text_domain), $this->label); ?></em></p>
		<ol>
			<li><?php _e('Do not check the request to carry parameters (if any), which may result in some images being inaccessible..', $this->text_domain); ?></li>
		</ol>
		<p class="description"><em class="qc-icon info"><?php _e('Notice: You need to follow the methods described below to upload and access these fonts:', $this->text_domain); ?></em></p>
		<ol>
			<li><?php _e('Create a new rule in the CORS settings, fill in the URL of your website homepage, and at least check the GET method.', $this->text_domain); ?></li>
			<li><?php _e('It may be necessary to add your website domain name to the anti-theft chain whitelist.', $this->text_domain); ?></li>
		</ol>
		<p class="description"><em class="qc-icon info"><?php _e("If you can't scan, it prompts Internal Server Error error, you need to check if open_basedir in php.ini contains your website root directory, if you need to delete it. (It may also be in the .htaccess or .user.ini file in the root of your website)", $this->text_domain); ?></em><br /><em class="qc-icon info"><?php _e("If you can't scan, it prompts \"There has been a critical error on your website.\", It may be because the <em>create_function</em> function is deprecated, please approve it in <em>php.ini</em>.", $this->text_domain); ?></em></p>
	</td>
</tr>
<tr valign="top">
	<th scope="row"><label for="<?php print $this->guid; ?>-sync-the-website-resource-custom-replacement"><?php _e('Custom Replacement', $this->text_domain); ?></label></th>
	<td>
		<textarea name="<?php print $this->field_name; ?>[custom-replacement]" id="<?php print $this->guid; ?>-sync-the-website-resource-custom-replacement" rows="3" class="large-text" placeholder="<?php printf(__('e.g. %s.', $this->text_domain), 'https://fonts.gstatic.com'); ?>"><?php print $this->custom_replacement; ?></textarea>
		<p class="description"><?php _e('Some themes come with some extra-wall resources, such as Google Fonts, and most people choose to delete them, but here is another option to automatically replace these domains with cloud-stored domain names and manually upload them to cloud storage. One per line.', $this->text_domain); ?></p>
	</td>
</tr>