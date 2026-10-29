<div class="wrap" id="qqworld-collector-settings">
	<h2><?php _e('Cookie-Free Domain & Cloud Storage', $this->text_domain); ?></h2>
	<p><?php _e("A domain that serves no cookies. The idea here is that you use a cookie-free domain to serve images, CSS files, scripts and whatnot, so that your users don't waste time and bandwidth transmitting cookies for them.", $this->text_domain); ?></p>
	<form id="cloud-storage-form" action="options.php" method="post">
		<?php settings_fields($this->settings_name); ?>
		<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
			<a href="#general" class="nav-tab qc-icon regular"><?php _e('General', $this->text_domain); ?></a>
			<a href="#cloud-storage" class="nav-tab qc-icon cloud"><?php _e('Cloud Storage', $this->text_domain); ?></a>
			<a href="#joinmode" class="nav-tab qc-icon balloon"><?php _e('JoinMode', $this->text_domain); ?></a>
			<a href="#No-Media-Library-Mode" class="nav-tab qc-icon refresh"><?php _e('No Media Library Mode', $this->text_domain); ?></a>
			<a href="#Compatibility-Mode" class="nav-tab qc-icon tool"><?php _e('Compatibility Mode', $this->text_domain); ?></a>
		</h2>
		<!-- General - start -->
		<div class="nav-section">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="enabled-cloud-storage"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enabled-cloud-storage', 'name' => $this->settings_name . '[enabled]', 'value' => $this->options->cloud_storage_enabled )); ?>
							<p class="description"><?php _e('Use Cloud Storage to save and display images.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="cloud-storage-automatic"><?php _e('Automatic', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'cloud-storage-automatic', 'name' => $this->settings_name . '[automatic]', 'value' => $this->options->cloud_storage_automatic )); ?>
							<p class="description"><?php _e('Automatically sync to cloud storage when grabbing remote attachments or uploading to the media library.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="cloud-storage-interval"><?php _ex('Interval', 'cloud storage', $this->text_domain); ?></label></th>
						<td>
							<input id="cloud-storage-interval" name="<?php print $this->settings_name; ?>[interval]" class="small-text" type="number" value="<?php print $this->options->cloud_storage_interval; ?>" />
							<p class="description"><?php _e('Reduce the upload pressure of certain cloud storage and increase the time interval between two synchronizations, in seconds.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr id="file-types-row"<?php if ($this->options->cloud_storage_mode == 'local') print ' class="hidden"'; ?>>
						<th scope="row"><label for="file-types"><?php _e('File Types', $this->text_domain); ?></label></th>
						<td>
							<table class="wp-list-table fixed striped">
								<thead>
									<tr>
										<td class="manage-column"><?php _e('File Types', $this->text_domain); ?></td>
										<td class="manage-column"><?php _e('General Mode Split', $this->text_domain); ?></td>
										<td class="manage-column"><?php _e('Joinmode Split', $this->text_domain); ?></td>
									</tr>
								</thead>
								<tbody><?php  $file_types = $this->get_allowed_file_types(); foreach ($file_types as $type => $file_type) { $all_extensions = array(); foreach ($file_type as $extensions) { $all_extensions = array_merge($all_extensions, $extensions); } if ($type == 'image') $all_extensions = array_merge($all_extensions, array('bmp')); ?><tr>
							<td><label>
							<input name="<?php print $this->settings_name; ?>[filetypes][]" type="checkbox" id="<?php print $this->settings_name; ?>-type-<?php print $type; ?>" value="<?php print $type; ?>" <?php checked(true, in_array($type, $this->options->cloud_storage_filetypes)); ?> />
							<?php printf(__(ucfirst($type) . ' (%s)', $this->text_domain), implode(', ', $all_extensions)); ?>
						</label></td>
							<td>
								<select name="<?php print $this->settings_name; ?>[generalmode][types][<?php print $type; ?>]" class="selectstyle"<?php if ($this->options->cloud_storage_joinmode_enabled) print ' disabled'; ?>>
									<option value="">---------------- <?php _e('Splitless', $this->text_domain); ?> ----------------</option>
								<?php
 $cloud_storages_group = $GLOBALS['QC']->cloud_storage->cloud_storages_group; unset($cloud_storages_group['others']); foreach ($cloud_storages_group as $guid => $group) { print '<optgroup label="'.$group['label'].'">'; foreach ($group['children'] as $value => $title) { $selected = isset($this->options->cloud_storage_generalmode_types[$type]) ? $this->options->cloud_storage_generalmode_types[$type] : ''; print '<option value="'.$value.'"'.selected($value, $selected, false).'>'.$title.'</option>'; } print '</optgroup>'; } ?>
								</select>
							</td>
							<td><?php
 print '<select name="'.$this->settings_name.'[joinmode][types]['.$type.']" class="selectstyle"' . ($this->options->cloud_storage_joinmode_enabled ? '' : ' disabled') . '>
								<option value="all">'.__('All').'</option><option value="0">'.__('None').'</option><optgroup label="'.__('Please select a cloud storage to upload separately', $this->text_domain).'">'; if (!empty($this->options->cloud_storage_jsonmode_selected)) foreach ($this->options->cloud_storage_jsonmode_selected as $selected) { $selectType = isset($this->options->cloud_storage_joinmode_types[$type]) ? $this->options->cloud_storage_joinmode_types[$type] : ''; print '<option value="'.$selected.'" '.selected($selectType, $selected, false).'>'.$GLOBALS['QC']->cloud_storage->cloud_storages[$selected].'</option>'; } print '</optgroup></select>'; ?></td></tr>
						<?php
 } ?></tbody></table>
						<p class="description"><?php _e('Please select the file type of attachments that your want to actively synced.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note: Many image storage do not support audio and video formats.', $this->text_domain); ?></span></p></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="cloud-storage-override"><?php _e('Override', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'cloud-storage-override', 'name' => $this->settings_name . '[override]', 'value' => $this->options->cloud_storage_override )); ?>
							<p class="description"><?php _e('Overwrite existing files on cloud storage when uploading. (Invalid for the image bed)', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="cloud-storage-statistics"><?php _e('Enable Statistics', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'cloud-storage-statistics', 'name' => $this->settings_name . '[statistics]', 'value' => $this->options->cloud_storage_statistics )); ?>
							<p class="description"><?php _e('Count the synchronization of attachments in the media library.<br /><span class="qc-icon info">If there are too many attachments, it is not recommended to open it, which will cause the page to load slowly.</span>', $this->text_domain); ?></p>
						</td>
					</tr>
					<?php ?>
					<tr>
						<th scope="row"><label for="add_exclude_domain"><?php _e('Exclude Path/Keyword', $this->text_domain); ?></label></th>
						<td>
							<ul id="exclude_path_list">
							<?php
 if (!empty($this->options->cloud_storage_exclude_path)) foreach ($this->options->cloud_storage_exclude_path as $path) : if (!empty($path)) : ?>
							<li>http(s):// <input type="text" name="<?php print $this->settings_name; ?>[exclude-path][]" class="regular-text" value="<?php echo $path; ?>" /><button type="button" class="button delete-exclude-path qc-icon delete"><?php _e('Delete'); ?></button></li>
								<?php endif; endforeach; ?>
							</ul>
							<p><button type="button" id="add_exclude_path" class="button qc-icon add"><?php _e('Add a path/Keyword', $this->text_domain);?></button></p>
							<p class="description"><?php _e("Attachment will not be synced, if that path contains Exclude-path/Keyword.", $this->text_domain); ?></p>
						</td>
					</tr>
			</table>
		</div>
		<!-- General - end -->
		<!-- Cloud Storage - start -->
		<div class="nav-section">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="cloud-storage-mode"><?php _e('Mode', $this->text_domain); ?></label><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#cloud-storage--introduction'); ?>" target="_blank" title="<?php _e('Help Documents', $this->text_domain); ?>" class="alignright qc-icon test help-documents"></a></th>
						<td>
							<select name="<?php print $this->settings_name; ?>[mode]" id="cloud-storage-mode" class="selectstyle">
							<?php
 foreach ($GLOBALS['QC']->cloud_storage->cloud_storages_group as $guid => $group) { print '<optgroup label="'.$group['label'].'">'; foreach ($group['children'] as $value => $title) { print '<option value="'.$value.'"'.selected($value, $this->options->cloud_storage_mode, false).'>'.$title.'</option>'; } print '</optgroup>'; } ?>
							</select>
							<p class="description"><?php _e('Switch the cloud storage you want to use here to make the relevant settings.', $this->text_domain); ?></p><br />
							<div id="quick-manage-cloud-storage"<?php if (!in_array($this->options->cloud_storage_mode, $this->cloudStorage1) || in_array($this->options->cloud_storage_mode, ['cloudreve','onemanager']) ) print ' class="hidden"'; ?>>
								<button type="button" id="sync-cloud-storage-all" data-mode="sync" class="button button-primary qc-icon refresh"<?php if (!$this->options->cloud_storage_enabled) print ' disabled'; ?>><?php _e('Quick Synchronization', $this->text_domain); ?></button>
								<label>&nbsp;&nbsp;<input type="checkbox" id="download-objects-from-cloud-storage" value="1" /> <?php _e('Download objects from cloud storage', $this->text_domain); ?></label>
								<p class="description qc-icon info"><?php _e('If the attachments in the media library have been transferred to the cloud storage, you can use this feature to tell the system that you do not need to rescan and upload.', $this->text_domain); ?></p><br />
								<button type="button" id="wipe-cloud-storage-all" data-mode="wipe" class="button qc-icon delete"<?php if (!$this->options->cloud_storage_enabled) print ' disabled'; ?>><?php _e('Wipe Synchronization', $this->text_domain); ?></button>
								<label>&nbsp;&nbsp;<input type="checkbox" id="delete-objects-from-cloud-storage" value="1" /> <?php _e('Delete objects from cloud storage', $this->text_domain); ?></label>
								<p class="description qc-icon info"><?php _e('This feature is equivalent to quickly clearing the sync state and deleting all resources on the cloud storage.', $this->text_domain); ?></p>
							</div>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="after-schedule"><?php _e('Scheduled Scan Synchronization', $this->text_domain); ?></label></th>
						<td>
							<p><?php printf(__('After %s minutes', $this->text_domain), '<input type="number" class="small-text" id="after-schedule" name="'.$this->settings_name.'[after]" value="'.$this->options->cloud_storage_schedule_after.'"'.(!$this->options->cloud_storage_enabled ? ' disabled' : '').' />'); ?>
							<select id="schedules" name="<?php print $this->settings_name; ?>[recurrence]" class="selectstyle"<?php if (!$this->options->cloud_storage_enabled) print ' disabled'; ?>>
							<?php
 $schedules = wp_get_schedules(); foreach ($schedules as $recurrence => $schedule) : ?>
								<option value="<?php echo $recurrence; ?>" data-interval="<?php echo $schedule['interval']; ?>" <?php selected($recurrence, $this->options->cloud_storage_schedule_recurrence); ?>><?php echo $schedule['display']; ?></option>
							<?php endforeach; ?>
							</select>
							<button type="button" class="schedule-sync button button-primary qc-icon time" id="schedule-sync"<?php if (!$this->options->cloud_storage_enabled) print ' disabled'; ?>><?php _e('Schedule', $this->text_domain); ?></button>
							<button type="button" class="cancel-schedule-sync button qc-icon delete" id="cancel-schedule-sync"<?php if (!$this->options->cloud_storage_enabled) print ' disabled'; ?>><?php _e('Cancel'); ?></button></p>
							<p class="description qc-icon info"><?php _e('If you often fail to synchronize due to various problems, you can start a scheduled task for regular automatic scanning and synchronization, and only supports fast scanning of the media library.<br />If you enable a single cloud storage, the scheduled task will synchronize a single cloud storage, and if you enable the Joinmode, the Joinmode will be synchronized.', $this->text_domain); ?></p>
							<p class="description" id="schedule-sync-timer"><?php
 $timestamp = wp_next_scheduled( 'qqworld-collector-cloud-storage-schedule-sync' ); if ($timestamp !== false) { $recurrence = wp_get_schedule( 'qqworld-collector-cloud-storage-schedule-sync' ); $type = $recurrence ? $schedules[$recurrence]['display'] : __('Single Task', $this->text_domain); $next_time = $timestamp - time(); if ($next_time >= 0) { ?><time class="next-time" id="next-time" data-type="<?php echo $type; ?>" data-time="<?php print $next_time; ?>"></time><?php
 } elseif ($this->options->cloud_storage_schedule_recurrence) { _e('Scanning.<span class="spinner is-active"></span>', $this->text_domain); } } ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php do_action( 'qqworld-collector-cloud-storage-form', $this->options->cloud_storage_mode ); ?>
		</div>
		<!-- Cloud Storage - end -->
		<!-- JoinMode - start -->
		<div class="nav-section">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="enabled-joinmode"><?php _e('JoinMode', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enabled-joinmode', 'name' => $this->settings_name . '[joinmode][enabled]', 'value' => $this->options->cloud_storage_joinmode_enabled )); ?>
							<p class="description"><?php _e('Multiple cloud storage can be used at the same time, and the system will output the fastest address.', $this->text_domain); ?></p>
							<p class="description"><em class="qc-icon info"><?php printf(__('Settings - <a href="%s" target="_blank">Permalinks</a> - Common settings cannot be used plainly.', $this->text_domain), admin_url('options-permalink.php')); ?></em></p>
							<p class="description"><em class="qc-icon info"><?php _e('Note that you must make sure that the selected cloud storage can be used normally, and then you can turn on the JoinMode.', $this->text_domain); ?></em></p>
						</td>
					</tr>
					<tr valign="top" class="for-joinmode<?php if (!$this->options->cloud_storage_joinmode_enabled) print ' hidden'; ?>">
						<th scope="row"><label for="joinmode-image-storage-priority"><?php _e('Image Storage Priority', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'joinmode-image-storage-priority', 'name' => $this->settings_name . '[joinmode][image-storage-priority]', 'value' => $this->options->cloud_storage_joinmode_image_storage_priority )); ?>
							<p class="description"><?php _e('Prioritize the use of image storage to display images, and use paid cloud storage for backup.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top" class="for-joinmode<?php if (!$this->options->cloud_storage_joinmode_enabled) print ' hidden'; ?>">
						<th scope="row"><label for="joinmode-anti-leech"><?php _e('Anti-Leech', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'joinmode-anti-leech', 'name' => $this->settings_name . '[joinmode][anti-leech]', 'value' => $this->options->cloud_storage_joinmode_anti_leech )); ?>
							<p class="description"><?php _e('Do not check this if you want to be able to call outside the website.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top" class="for-joinmode<?php if (!$this->options->cloud_storage_joinmode_enabled) print ' hidden'; ?>">
						<th scope="row"><label for="enabled-joinmode"><?php _e('URL Style', $this->text_domain); ?></label></th>
						<td>
							<p class="description"><?php _e('JoinMode cloud storage url looks like:', $this->text_domain); ?></p>
							<?php
 $args = array( 'post_type' => 'attachment', 'posts_per_page' => 1 ); $attachments = get_posts($args); $attachment_id = !empty($attachments) ? $attachments[0]->ID : '{' . __('Attachment ID', $this->text_domain) . '}'; print '<ul>'; for ($i=0; $i<6; $i++) : ?>
								<li><?php $joinmode_url = $this->get_joinmode_url($attachment_id, 'thumbnail', $i); ?><label><input type="radio" name="<?php print $this->settings_name; ?>[joinmode][style]" value="<?php print $i; ?>" <?php checked($i, $this->options->cloud_storage_jsonmode_style); ?> /> <?php print $joinmode_url; ?></label> <a href="<?php print $joinmode_url; ?>" target="_blank" class="qc-icon link"></a></li>
							<?php
 endfor; print '</ul>'; ?>
							<p class="description"><em class="qc-icon info"><?php printf(__('Note that the address with the extension may be 404, see the <a href="%s" target="_blank">solution</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#malfunction--cloud-storage--joinmode-404')); ?></em></p>
						</td>
					</tr>
					<tr valign="top" class="for-joinmode<?php if (!$this->options->cloud_storage_joinmode_enabled) print ' hidden'; ?>">
						<th scope="row"><label for="cloud-storage-joinmode-selected"><?php _e('Mode', $this->text_domain); ?></label><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#cloud-storage--introduction'); ?>" target="_blank" title="<?php _e('Help Documents', $this->text_domain); ?>" class="alignright qc-icon test help-documents"></a></th>
						<td>
							<?php
 foreach ($GLOBALS['QC']->cloud_storage->cloud_storages_group as $guid => $group) { if ($guid == 'others') continue; print '<h5>'.$group['label'].'</h5>'; foreach ($group['children'] as $value => $title) { print '<p><label><input name="'.$this->settings_name.'[joinmode][selected][]" type="checkbox" value="'.$value.'" '.checked(1, in_array($value, $this->options->cloud_storage_jsonmode_selected), false).' />'.$title.'</label></p>'; } } ?>
							<p class="description"><?php _e('Please select a cloud storage to participate in the joinmode.', $this->text_domain); ?></p>
							<p class="description"><em class="qc-icon info"><?php printf(__('It is recommended not to choose too much, which will greatly increase the synchronization time and make it easier to cause timeouts. It is recommended to search for the <strong>404</strong> and <strong>504</strong> solutions in the <a href="%s" target="_blank">help documentation</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents')); ?></em></p>
						</td>
					</tr>
					<tr valign="top" class="for-joinmode<?php if (!$this->options->cloud_storage_joinmode_enabled) print ' hidden'; ?>">
						<th scope="row"><label for="cloud-storage-joinmode-scan"><?php _e('Scan', $this->text_domain); ?></label></th>
						<td>
							<p>
								<label><?php _e('Speed', $this->text_domain); ?> <select name="sacn-speed" class="selectstyle">
									<optgroup label="<?php _e('Speed', $this->text_domain); ?>">
									<?php for ($i=1; $i<51; $i++) : ?>
										<option value="<?php print $i; ?>"><?php print $i; ?></option>
									<?php endfor; ?>
									</optgroup>
								</select></label> 
								<button type="button" class="scan-to-sync button button-primary qc-icon search" data-mode="joinmode" data-guid="joinmode"<?php if (!$this->options->cloud_storage_joinmode_enabled) print ' disabled'; ?>><?php _e('Fast Scan', $this->text_domain); ?></button>
								<?php $synced_attachment_ids = $GLOBALS['QC']->cache->get_cache('synced-attachment-ids'); ?>
								<button type="button" id="wipe-synced-cache-data" class="button qc-icon delete"<?php if (empty($synced_attachment_ids)) print ' disabled'?>><?php _e('Wipe Synchronized Data Cache', $this->text_domain); ?></button>
							</p>
							<p class="description"><?php _e('Scan the media library in JoinMode to synchronize attachments to selected cloud storage in bulk.', $this->text_domain); ?></p>
							<p class="description"><em class="qc-icon info"><?php _e('Before scanning, make sure that the cloud storage address in the post content has been restored to a local address.', $this->text_domain); ?></em></p>
							<p class="description"><em class="qc-icon info"><?php _e('The entire media library is scanned and the synced attachment ID is cached. If you want to rescan, clear the cache of the synced data.', $this->text_domain); ?></em></p>
							<p class="description qc-icon info"><?php _e('Do not set the scan speed too high, your server or cloud storage server may not be able to bear.', $this->text_domain); ?></p>
							<p><button type="button" class="restore-media-library button qc-icon restore" id="restore-joinmode"<?php if (!$this->options->cloud_storage_joinmode_enabled) print ' disabled'; ?>><?php _e('Restore', $this->text_domain); ?></button></p>
							<p class="description"><?php _e('Batch convert the JoinMode cloud storage url in the post content to a local url.', $this->text_domain); ?></p>
							<p><button type="button" class="button qc-icon refresh" id="joinmode-speed-dedetection"<?php if (!$this->options->cloud_storage_joinmode_enabled) print ' disabled'; ?>><?php _e('Speed Detection', $this->text_domain); ?></button>
							</p>
							<p class="description"><?php _e('Re-detect the speed of each cloud storage URL in the JoinMode of all attachments, and automatically output the fastest one.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- JoinMode - end -->
		<!-- No Media Library Mode - start -->
		<div class="nav-section">
			<p><?php _e('Here, you can manage the attachments that have not been uploaded through the media library, which is convenient to upload or restore to the local address.', $this->text_domain); ?></p>
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label><?php _e('Select post types', $this->text_domain); ?></label></th>
						<td>
							<?php $post_types = get_post_types(array('public' => 1), 'objects'); ?>
							<ul id="post_types_list">
							<?php foreach ($post_types as $name => $post_type) : $count = wp_count_posts($name); if (!in_array($name, array('attachment', 'revision', 'nav_menu_item'))) : ?>
								<li><label><input name="qqworld-collector-cloud-storage-post-type" type="radio" value="<?php echo $name; ?>" /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
							<?php endif; endforeach; ?></ul>
							<p class="description"><?php _e("If you have too many posts to be scan, sometimes in process looks like stopping, but it may be fake. please be patient.", $this->text_domain) ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="scan-no-media-library"><?php _e('Scan Posts', $this->text_domain); ?></label></th>
						<td>
							<?php $uploads = get_option( 'qqworld-collector-cloud-storage-record-uploads' ); ?>
							<p>
								<button type="button" id="scan-no-media-library" class="button button-primary qc-icon qc-icon search"<?php if (!$this->options->cloud_storage_enabled) print ' disabled'; ?>><?php _e('Scan Posts', $this->text_domain); ?></button>
								&nbsp;&nbsp;
								<?php printf(__('After %s minutes', $this->text_domain), '<input type="number" class="small-text" id="no-media-library-after-schedule" name="no-media-library-after-schedule" value="5" />'); ?>
								<select name="no-media-library-schedule" id="no-media-library-scan-schedules" class="selectstyle">
									<option value=""><?php _e('Single Task', $this->text_domain); ?></option>
								<?php
 foreach (wp_get_schedules() as $recurrence => $detail) { echo '<option value="'.$recurrence.'">'.$detail['display'].'</option>'; } ?>
								</select>
								<button name="cron-no-media-library" type="button" class="button-primary qc-icon time" id="cron-no-media-library"><?php _e('Schedule Scan Task', $this->text_domain); ?></button>
								<button type="button" class="cancel-schedule-sync-no-media-library button qc-icon delete" id="cancel-schedule-sync-no-media-library"><?php _e('Cancel', $this->text_domain); ?></button>
							</p>
							<p class="description"><?php _e('Scan published posts and upload local images that are not in the media library to cloud storage.', $this->text_domain); ?>
								<br /><span class="qc-icon info"><?php _e('It is recommended to scan the media library before doing this.', $this->text_domain); ?></span>
								<br /><span class="qc-icon info"><?php printf(__('Warning: Be sure not to enable <strong>%s</strong>, you must backup them first and then delete them manually.', $this->text_domain), __('Delete Attachment After Synced', $this->text_domain)); ?></span>
								<?php if ($this->options->cloud_storage_joinmode_enabled) : ?><br /><span class="qc-icon info"><?php _e('Not compatible with Join Mode!', $this->text_domain); ?></span><?php endif; ?>
								<br /><span class="qc-icon info"><?php _e('Note that both scanning and restoring may need to be repeated several times to complete.', $this->text_domain); ?></span>
							</p>
							<p class="description" id="no-media-library-schedule-sync-timer"><?php
 $crons = $this->get_crons('qqworld-collector-cloud-storage-no-media-library-schedule-scan'); if ($crons) foreach ($crons as $cron) { $recurrence = $cron['options']['schedule']; $type = $recurrence ? $schedules[$recurrence]['display'] : __('Single Task', $this->text_domain); $next_time = $cron['timestamp'] - time(); if ($next_time >= 0) { ?><time class="next-time" id="next-time" data-type="<?php echo $type; ?>" data-time="<?php print $next_time; ?>"></time><?php
 } elseif ($this->options->cloud_storage_schedule_recurrence) { _e('Scanning.<span class="spinner is-active"></span>', $this->text_domain); } } ?></p>
						</td>
					</tr>
					<?php if ($uploads) : ?>
					<tr>
						<th scope="row"><label for="restore-no-media-library"><?php _e('Restore', $this->text_domain); ?></label></th>
						<td>
							<p><button type="button" id="uploaded-attachments" class="button qc-icon qc-icon on-cloud"><?php _e('Uploaded Attachments', $this->text_domain); ?></button> <button type="button" id="restore-no-media-library" class="button qc-icon qc-icon restore"><?php _e('Restore', $this->text_domain); ?></button></p>
							<p class="description"><?php _e('Restore images uploaded to cloud storage to local addresses.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note that both scanning and restoring may need to be repeated several times to complete.', $this->text_domain); ?></span></p>
							<br />
							<div id="uploaded-attachments-container" class="hidden">
								<table class="wp-list-table widefat striped posts">
									<thead>
										<tr>
											<td class="manage-column"><?php _e('Local URL', $this->text_domain); ?></td>
											<td class="manage-column"><?php _e('Cloud Storage URL', $this->text_domain); ?></td>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($uploads as $local_url => $cloud_url) : ?>
										<tr>
											<td><?php print $local_url; ?></td>
											<td><?php print $cloud_url; ?></td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<!-- No Media Library Mode - end -->
		<!-- Compatibility Mode - start -->
		<div class="nav-section">
			<p><?php _e('If it conflicts with certain themes or plug-ins, causing the cloud storage address to be abnormal, you can turn on the compatibility mode and actively replace the wrong address with the correct address, which will sacrifice a little server performance.', $this->text_domain); ?></p>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="enable-compatibility-mode"><?php _e('Enabled', $this->text_domain); ?></label></th>
					<td>
						<?php
 $this->the_switcher(array( 'id' => 'enable-compatibility-mode', 'name' => $this->settings_name . '[compatibility][enabled]', 'value' => $this->options->cloud_storage_compatibility_enabled )); ?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="compatibility-mode"><?php _e('Mode', $this->text_domain); ?></label></th>
					<td>
						<select name="<?php print $this->settings_name; ?>[compatibility][mode]" id="compatibility-mode" class="selectstyle">
							<option value="0" <?php selected(0, $this->options->cloud_storage_compatibility_mode); ?>><?php _e('Fastest', $this->text_domain); ?></option>
							<option value="1" <?php selected(1, $this->options->cloud_storage_compatibility_mode); ?>><?php _e('Best compatibility', $this->text_domain); ?></option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="compatibility-mode-wrong-url"><?php _e('Replace URL', $this->text_domain); ?></label></th>
					<td>
						<?php printf(__('Replace %s with %s', $this->text_domain), '<p><input type="text" name="' . $this->settings_name . '[compatibility][wrong-url]" class="large-text" id="compatibility-mode-wrong-url" value="'.$this->options->cloud_storage_compatibility_wrong_url.'" /></p>', '<p><input type="text" name="' . $this->settings_name . '[compatibility][correct-url]" class="regular-text" id="compatibility-mode-correct-url" value="'.$this->options->cloud_storage_compatibility_correct_url.'" /></p>'); ?>
						<p><strong><?php _e('For examples:', $this->text_domain); ?></strong></p>
						<p class="description"><?php printf(__('Replace %s with %s', $this->text_domain), '<br /><strong>website-1326157731.oss.ap-beijing.myqcloud.com/img06197701.oss.ap-beijing.myqcloud.com/img</strong><br />', '<br /><strong>website-1326157731.oss.ap-beijing.myqcloud.com/img</strong>'); ?></p>
					</td>
				</tr>
				<tr valign="top" class="for-best-compatibility">
					<th scope="row"><label for="compatibility-prefix"><?php _e('Prefix', $this->text_domain); ?></label></th>
					<td>
						<input type="text" class="regular-text" name="<?php print $this->settings_name; ?>[compatibility][prefix]" id="compatibility-prefix" value="<?php print $this->options->cloud_storage_compatibility_prefix; ?>" placeholder="https://api.example.com/do?url=" />
						<p class="description"><?php _e('You can add your own interface address.', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr valign="top" class="for-best-compatibility">
					<th scope="row"><label for="compatibility-prefix"><?php _e('Suffix', $this->text_domain); ?></label></th>
					<td>
						<input type="text" class="regular-text" name="<?php print $this->settings_name; ?>[compatibility][suffix]" id="compatibility-suffix" value="<?php print $this->options->cloud_storage_compatibility_suffix; ?>" placeholder="@image-crop,w160*180" />
						<p class="description"><?php _e('You can add your own interface parameters.', $this->text_domain); ?></p>
					</td>
				</tr>
			</table>
		</div>
		<!-- Compatibility Mode - end -->
		<?php submit_button(); ?>
	</form>
</div>