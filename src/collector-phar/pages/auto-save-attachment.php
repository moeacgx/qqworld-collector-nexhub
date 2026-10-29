<div class="wrap" id="qqworld-collector-settings">
	<h2 id="header-title"><?php _e("Auto Save Attachment", $this->text_domain); ?></h2>
	<p><?php _e('Automatically keep the all remote attachments to the local, and automatically set featured image.', $this->text_domain); ?></p>
	<form action="options.php" method="post" id="form">
		<?php settings_fields($this->settings_name); ?>
		<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
			<a href="#general" class="nav-tab qc-icon regular"><?php _e('General', $this->text_domain); ?></a>
			<a href="#filter" class="nav-tab qc-icon filters"><?php _e('Filter', $this->text_domain); ?></a>
			<a href="#format" class="nav-tab qc-icon edit"><?php _e('Format', $this->text_domain); ?></a>
			<a href="#scan-posts" class="nav-tab qc-icon search"><?php _e('Scan Posts', $this->text_domain); ?></a>
			<a href="#cron" class="nav-tab qc-icon time"><?php _e('Cron', $this->text_domain); ?></a>
			<a href="#convert" class="nav-tab qc-icon convert"><?php _e('File Format Conversion', $this->text_domain); ?></a>
		</h2>
		<!-- General - start -->
		<div class="nav-section">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="file-types"><?php _e('File Types', $this->text_domain); ?></label></th>
						<td><?php  $file_types = $this->get_allowed_file_types(); foreach ($file_types as $type => $file_type) { $all_extensions = array(); foreach ($file_type as $extensions) { $all_extensions = array_merge($all_extensions, $extensions); } if ($type == 'image') $all_extensions = array_merge($all_extensions, array('bmp')); ?><p><label>
							<input name="<?php print $this->settings_name; ?>[general][type][]" type="checkbox" id="<?php print $this->settings_name; ?>-type-<?php print $type; ?>" value="<?php print $type; ?>" <?php checked(true, in_array($type, $this->options->qc_asa_general_type)); ?> />
							<?php printf(__(ucfirst($type) . ' (%s)', $this->text_domain), implode(', ', $all_extensions)); ?>
						</label></p>
						<?php
 } ?><p class="description"><?php _e('Please select the file type of remote attachments that your want to grabbed.', $this->text_domain); ?></p></td>
					</tr>
					<tr>
						<th scope="row"><label for="post-meta"><?php _e('Post Meta', $this->text_domain); ?></label></th>
						<td>
							<textarea id="post-meta" name="<?php print $this->settings_name; ?>[general][post-meta]" cols="50" rows="3" ><?php print $this->options->qc_asa_general_post_meta; ?></textarea>
							<p class="description"><?php _e('Please fill in the post meta key and saving type to grab the remote attachment, one per line. Fires when the post is saved.', $this->text_domain); ?></p>
							<div class="description"><?php printf(__('<strong>For example:</strong> %s', $this->text_domain), '<pre class="prism"><code class="language-php">fav-image|id
footer-pic|url</code></pre>'); ?></div>
							<p class="description"><?php _e('The front of the "|" is the post meta key, the latter is the saving type, <strong>id</strong>: Attachment ID, <strong>url</strong>: Attachment URL.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="mode"><?php _e('Mode', $this->text_domain); ?></label></th>
						<td>
							<select id="mode" name="<?php print $this->settings_name; ?>[general][mode]" class="selectstyle">
								<option value="auto" <?php selected('auto', $this->options->qc_asa_general_mode); ?>><?php _e('Automatic Mode', $this->text_domain); ?></option>
								<option value="manual" <?php selected('manual', $this->options->qc_asa_general_mode); ?>><?php _e('Manual Mode', $this->text_domain); ?></option>
							</select>
							<p class="description"><?php _e('<strong>Automatic Mode</strong>: Automatically save all remote images to local media libary when you save or publish post.', $this->text_domain); ?><br /><?php _e('<strong>Manual Mode</strong>: Manually save all remote images to local media libary when you click the button on the top of editor.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr id="when-row"<?php if ($this->options->qc_asa_general_mode != 'auto') echo ' class="hidden"'; ?>>
						<th scope="row"><label for="when"><?php _e('When', $this->text_domain); ?></label></th>
						<td><?php
 global $wp_post_statuses; $checkboxes = array(); foreach ($wp_post_statuses as $slug => $status) { if (!in_array($slug, array('auto-draft', 'inherit', 'trash'))) { $checked = in_array($slug, $this->options->qc_asa_general_when) ? ' checked' : ''; $checkboxes[] = '<p><label><input type="checkbox" name="'.$this->settings_name.'[general][when][]" value="'.$slug.'" '.$checked.' /> '.$status->label . '</label></p>'; } } echo implode('', $checkboxes); ?>
							<p class="description"><?php _e('Select the post statuses you want to grab remote images.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="<?php print $this->settings_name; ?>-paste-image"><?php _e('Paste Image', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-paste-image', 'name' => $this->settings_name . '[general][paste-image]', 'value' => $this->options->qc_asa_general_paste_image )); ?>
							<p class="description"><?php _e('Support paste screenshots and upload automatically.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note: You can only use CTRL + C to copy content on the webpage and paste it into the editor, otherwise duplicate images may be generated.', $this->text_domain); ?></span></p><br />
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-paste-image-then_convert', 'name' => $this->settings_name . '[general][paste-image-then_convert]', 'value' => $this->options->qc_asa_general_paste_image_then_convert )); ?>
							<p class="description"><label for="<?php print $this->settings_name; ?>-paste-image-then_convert"><?php _e('The PNG format is generated by default, and the file size may be too large. Turning on this option will automatically convert to JPEG format.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="<?php print $this->settings_name; ?>-schedule-publish"><?php _e('Schedule Publish', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-schedule-publish', 'name' => $this->settings_name . '[general][schedule-publish]', 'value' => $this->options->qc_asa_general_schedule_publish )); ?>
							<p class="description"><?php _e('Save remote images via Schedule Publish.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="<?php print $this->settings_name; ?>-remote-publishing"><?php _e('Remote Publishing', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-remote-publishing', 'name' => $this->settings_name . '[general][remote-publishing]', 'value' => $this->options->qc_asa_general_remote_publishing )); ?>
							<p class="description"><?php _e('Save remote images via remote publishing from IFTTT or other way using XMLRPC.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="<?php print $this->settings_name; ?>-set-featured-image"><?php _e('Set Featured Image', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-set-featured-image', 'name' => $this->settings_name . '[general][set-featured-image]', 'value' => $this->options->qc_asa_general_set_featured_image )); ?>
							<?php printf(__('Set No. %s photo as featured image', $this->text_domain), '<input type="number" min="1" class="small-text" name="' . $this->settings_name . '[general][featured-image-index]" value="'.$this->options->qc_asa_general_featured_image_index.'" />'); ?>
							<p class="description"><?php _e('Set first one of the remote images as featured image.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"></th>
						<td>
							<button type="button" class="bulk-set-featured-images button button-primary qc-icon add" data-mode="set"><?php _e('Set All Featured Images', $this->text_domain); ?></button>
							<button type="button" class="bulk-set-featured-images button qc-icon delete" data-mode="wipe"><?php _e('Wipe All Featured Images', $this->text_domain); ?></button>
							<p class="description"><?php _e('You can easily add feature maps to the article in batches, or you can erase them all. It is recommended to back up the database before doing it.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note that if the post does not have an attachment, the feature image will not be set automatically.', $this->text_domain); ?></span></p>
							<?php
 $this->the_switcher(array( 'id' => 'force-set-featured-image', 'name' => 'force-set-featured-image', 'value' => 0 )); ?>
							<p class="description"><?php _e('Some posts without featured images clearly have attachments, but they cannot be scanned. Checking this will force all posts to be scanned.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="upload-default-featured-images"><?php _e('Default Featured Image', $this->text_domain); ?></label></th>
						<td>
							<?php
 if ($this->options->qc_asa_general_default_featured_image) { print '<ul id="default-featured-image-list" class="common-scan-list">'; $featured_images = explode(',', $this->options->qc_asa_general_default_featured_image); foreach ($featured_images as $attachment_id) { $full_featured_image = wp_get_attachment_image_src($attachment_id, 'full'); $featured_image = wp_get_attachment_image_src($attachment_id, 'thumbnail'); print '<li class="animated '.$this->options->qc_graphic_completed_animation.'" style="background-image: url('.$featured_image[0].')"><a href="'.$full_featured_image[0].'" target="_blank"></a><span class="type">'.$attachment_id.'</span></li>'; } print '</ul>'; } ?>
							<input type="hidden" name="<?php print $this->settings_name; ?>[general][default-featured-image]" value="<?php print $this->options->qc_asa_general_default_featured_image; ?>" />
							<?php $title = $this->options->qc_asa_general_default_featured_image ? __('Manage Default Featured Images', $this->text_domain) : __('Upload Default Featured Images', $this->text_domain); ?>
							<button id="upload-default-featured-images" class="qc-icon add button button-primary<?php if ($this->options->qc_asa_general_default_featured_image) print ' uploaded'; ?>" title="<?php print $title; ?>"><?php print $title; ?></button>
							<button type="button" class="qc-icon delete button<?php if (!$this->options->qc_asa_general_default_featured_image) echo ' hidden'; ?>" id="remove-default-featured-images"><?php _e('Remove Default Featured Images', $this->text_domain); ?></button>
							<p class="description"><?php _e("If no images in post, set a default image as featured image. leave empty to not use default image.", $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Hold down the Control key to select multiple items.', $this->text_domain); ?></span></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="<?php print $this->settings_name; ?>-flip-horizontal-image"><?php _e('Flip Horizontal Image', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-flip-horizontal-image', 'name' => $this->settings_name . '[general][flip-horizontal-image]', 'value' => $this->options->qc_asa_general_flip_horizontal_image )); ?>
							<p class="description"><?php _e("Automatically flip the picture horizontally, just like looking in a mirror.", $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="<?php print $this->settings_name; ?>-no-media-library"><?php _e('No Media Library', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-no-media-library', 'name' => $this->settings_name . '[general][no-media-library]', 'value' => $this->options->qc_asa_general_no_media_library )); ?>
							<p class="description"><?php _e("Remote images will no be saved into media library, it means would not generate thumbnail.<br />but if you checked Set-Featured-Image, the specified remote image will be saved into media library.", $this->text_domain); ?></p>
							<p class="description"><em class="qc-icon info"><?php printf(__('It is not recommended to enable, It is recommended to disable thumbnail size in <a href="%s" target="_blank">Settings</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-settings') ); ?></em></p>
							<p class="description"><em class="qc-icon info"><?php printf(__('Notice: this feature is not compatible with <a href="%s" target="_blank">JoinMode of cloud storage</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-cloud-storage') ); ?></em></p>
							<?php
 $disabled = ' disabled'; if (file_exists($GLOBALS['QC']->auto_save_attachment->save_attachment->local_mark->log_path)) { $log = file_get_contents($GLOBALS['QC']->auto_save_attachment->save_attachment->local_mark->log_path); if ($log) $disabled = ''; } ?>
							<p class="description">
								<button id="refresh-local-cache" type="button" class="button qc-icon refresh"<?php print $disabled; ?>><?php _e('Refresh Cache', $this->text_domain); ?></button>
								<br /><?php _e('The system will create a cache file to record attachments that have been saved to the local, and it can also prevent duplicates from being saved.<br />However, deleting the local attachments will not automatically update record from cache, so you can click this button to manually refresh.', $this->text_domain); ?>
							</p>
							<p class="description">
								<button id="manage-local-cache" type="button" class="button qc-icon refresh"<?php print $disabled; ?>><?php _e('Manage Cache', $this->text_domain); ?></button>
								<br /><?php _e('Manage un-stocked images and delete unwanted local image (Drag items to be deleted into the trash).', $this->text_domain); ?>
							</p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php do_action('qqworld-collector-auto-save-attachment-general-form'); ?>
			<?php submit_button(); ?>
		</div>
		<!-- General - end -->
		<!-- Filter - start -->
		<div class="nav-section hidden">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="convert-file-type"><?php _e('Convert File Type', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-filter-convert-file-type-avif', 'name' => $this->settings_name . '[filter][convert-file-type][avif]', 'value' => $this->options->qc_asa_filter_convert_file_type_avif )); ?>
							<p class="description"><?php printf(__('Automatically convert <strong>%s</strong> to <strong>%s</strong>.', $this->text_domain), 'AVIF', 'JPG'); ?></label></p>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-filter-convert-file-type-webp', 'name' => $this->settings_name . '[filter][convert-file-type][webp]', 'value' => $this->options->qc_asa_filter_convert_file_type_webp )); ?>
							<p class="description"><?php printf(__('Automatically convert <strong>%s</strong> to <strong>%s</strong>.', $this->text_domain), 'WEBP', 'JPG'); ?></label></p>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-filter-convert-file-type-bmp', 'name' => $this->settings_name . '[filter][convert-file-type][bmp]', 'value' => $this->options->qc_asa_filter_convert_file_type_bmp )); ?>
							<p class="description"><?php printf(__('Automatically convert <strong>%s</strong> to <strong>%s</strong>.', $this->text_domain), 'BMP', 'JPG'); ?></label></p>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-filter-convert-file-type-jpg', 'name' => $this->settings_name . '[filter][convert-file-type][jpg]', 'value' => $this->options->qc_asa_filter_convert_file_type_jpg )); ?>
							<p class="description"><?php printf(__('Automatically convert <strong>%s</strong> to <strong>%s</strong>.', $this->text_domain), 'JPG', 'WEBP'); ?></label></p>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-filter-convert-file-type-png', 'name' => $this->settings_name . '[filter][convert-file-type][png]', 'value' => $this->options->qc_asa_filter_convert_file_type_png )); ?>
							<p class="description"><?php printf(__('Automatically convert <strong>%s</strong> to <strong>%s</strong>.', $this->text_domain), 'PNG', 'WEBP'); ?></label></p>
						</td>
					</tr>
					<?php if (class_exists('imagick')) : ?>
					<tr>
						<th scope="row"><label for="<?php print $this->settings_name; ?>-filter-convert-file-type-svg"><?php _e('SVG Converting', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-filter-convert-file-type-svg', 'name' => $this->settings_name . '[filter][convert-file-type][svg][enabled]', 'value' => $this->options->qc_asa_filter_convert_file_type_svg_enabled )); ?>
							<p class="description"><?php printf(__('Automatically convert <strong>%s</strong> to <strong>%s</strong>.', $this->text_domain), 'SVG', 'PNG'); ?></label></p>
							<dl>
								<dt><label for="<?php print $this->settings_name; ?>-filter-convert-file-type-svg-dpi"><?php _e('Convert Resolution', $this->text_domain); ?></label></dt>
								<dd><input type="number" class="small-text" id="<?php print $this->settings_name; ?>-filter-convert-file-type-svg-dpi" name="<?php print $this->settings_name; ?>[filter][convert-file-type][svg][dpi]'" value="<?php print $this->options->qc_asa_filter_convert_file_type_svg_dpi; ?>" /> DPI</dd>
								<dt><label for="<?php print $this->settings_name; ?>-filter-convert-file-type-svg-bg"><?php _e('Background Transparent', $this->text_domain); ?></label></dt>
								<dd><?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-filter-convert-file-type-svg-bg', 'name' => $this->settings_name . '[filter][convert-file-type][svg][bg]', 'value' => $this->options->qc_asa_filter_convert_file_type_svg_bg )); ?><p class="description"><?php _e('If there is an inexplicable watermark, turn off this option to solve it.', $this->text_domain); ?></p></dd>
							</dl>
						</td>
					</tr>
					<?php endif; ?>
					<tr>
						<th scope="row"><label for="only_save_first"><?php _e('Grabbing from Each Posts', $this->text_domain); ?></label></th>
						<td>
							<select id="only_save_first" name="<?php print $this->settings_name; ?>[filter][only-save-first]" class="selectstyle">
								<option value="all" <?php selected('all', $this->options->qc_asa_filter_only_save_first); ?>><?php _e('All Images', $this->text_domain); ?></option>
								<?php
 for ($i=1; $i<=30; $i++) { $selected = selected($i, $this->options->qc_asa_filter_only_save_first, false); echo '<option value="' . $i . '" '.$selected.'>' . sprintf(_n('First %d image only', 'First %d images only', $i, $this->text_domain), $i) . '</option>'; } ?>
							</select><p class="description"><?php _e('Only supports automatic mode.', $this->text_domain); ?></p><br />
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-filter-only-save-first-delete-remaining', 'name' => $this->settings_name . '[filter][only-save-first-delete-remaining]', 'value' => $this->options->qc_asa_filter_only_save_first_delete_remaining )); ?><p class="description"><?php _e('Delete remote image codes that are not grabbed.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php _e('Minimum Picture Size', $this->text_domain); ?></label></th>
						<td>
							<table class="wp-list-table fixed striped">
								<thead>
									<tr>
										<td class="manage-column"><?php _e('Width (px)', $this->text_domain); ?></td>
										<td class="manage-column"><?php _e('Height (px)', $this->text_domain); ?></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input name="<?php print $this->settings_name; ?>[filter][minimum-picture-size][width]" class="small-text" type="number" id="qqworld-auto-save-images-minimum-picture-size-width" value="<?php echo $this->options->qc_asa_filter_minimum_picture_size_width; ?>" /></td>
										<td><input name="<?php print $this->settings_name; ?>[filter][minimum-picture-size][height]" class="small-text" type="number" id="qqworld-auto-save-images-minimum-picture-size-height" value="<?php echo $this->options->qc_asa_filter_minimum_picture_size_height; ?>" readonly /></td>
									</tr>
								</tbody>
							</table>
							<p class="description"><?php _e('Ignore smaller that bigger than this size.', $this->text_domain); ?></p><br />
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-filter-minimum-picture-size-delete', 'name' => $this->settings_name . '[filter][minimum-picture-size][delete]', 'value' => $this->options->qc_asa_filter_minimum_picture_size_delete )); ?>
							<p class="description"><?php _e('Automatically delete images smaller than minimum-picture-size.', $this->text_domain); ?></label></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php _e('Maximum Picture Size', $this->text_domain); ?></label></th>
						<td>
							<table class="wp-list-table fixed striped">
								<thead>
									<tr>
										<td class="manage-column"><?php _e('Width (px)', $this->text_domain); ?></td>
										<td class="manage-column"><?php _e('Height (px)', $this->text_domain); ?></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input name="<?php print $this->settings_name; ?>[filter][maximum-picture-size][width]" class="small-text" type="number" id="qqworld-auto-save-images-maximum-picture-size-width" value="<?php echo $this->options->qc_asa_filter_maximum_picture_size_width; ?>" /></td>
										<td><input name="<?php print $this->settings_name; ?>[filter][maximum-picture-size][height]" class="small-text" type="number" id="qqworld-auto-save-images-maximum-picture-size-height" value="<?php echo $this->options->qc_asa_filter_maximum_picture_size_height; ?>" /></td>
									</tr>
								</tbody>
							</table>
							<p class="description"><?php _e("Automatic reduction is greater than the size of the picture. if you want image width less than 800px with any size height, please set width 800 and leave height blank.", $this->text_domain); ?></p>
							<p class="description"><?php printf(__('Does not capture images with file sizes greater than %s MB.', $this->text_domain), '<input type="number" class="small-text" name="'.$this->settings_name.'[filter][maximum-picture-size][filter]" value="'.$this->options->qc_asa_filter_maximum_picture_size_filter.'" />')?></p>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-filter-maximum-picture-size-for-upload', 'name' => $this->settings_name . '[filter][maximum-picture-size][for-upload]', 'value' => $this->options->qc_asa_filter_maximum_picture_size_for_upload )); ?>
							<p class="description"><?php _e('Automatic reduction is greater than the size of the picture when uploading images to the media library.', $this->text_domain); ?></label></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="cropping"><?php _e('Cropping', $this->text_domain); ?></label></th>
						<td>
							<table class="wp-list-table fixed striped">
								<thead>
									<tr>
										<td class="manage-column" colspan="3"><?php _e('Cropping', $this->text_domain); ?> (px)</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td>
											<input type="number" class="small-text" name="<?php print $this->settings_name; ?>[filter][cropping][top]" value="<?php print $this->options->qc_asa_filter_cropping_top; ?>" placeholder="<?php _e('Top side', $this->text_domain); ?>" />
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<input type="number" class="small-text" name="<?php print $this->settings_name; ?>[filter][cropping][left]" value="<?php print $this->options->qc_asa_filter_cropping_left; ?>" placeholder="<?php _e('Left side', $this->text_domain); ?>" />
										</td>
										<td></td>
										<td>
											<input type="number" class="small-text" name="<?php print $this->settings_name; ?>[filter][cropping][right]" value="<?php print $this->options->qc_asa_filter_cropping_right; ?>" placeholder="<?php _e('Right side', $this->text_domain); ?>" />
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<input type="number" class="small-text" name="<?php print $this->settings_name; ?>[filter][cropping][bottom]" value="<?php print $this->options->qc_asa_filter_cropping_bottom; ?>" placeholder="<?php _e('Bottom side', $this->text_domain); ?>" />
										</td>
										<td></td>
									</tr>
								</tbody>
							</table>
							<p class="description"><?php _e("Crop the captured remote images, please fill in the pixel values to be cropped on the 4 sides", $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="add_exclude_domain"><?php _e('Exclude Domain/Keyword', $this->text_domain); ?></label></th>
						<td>
							<ul id="exclude_domain_list">
							<?php
 if (!empty($this->options->qc_asa_filter_exclude_domain)) foreach ($this->options->qc_asa_filter_exclude_domain as $domain) : if (!empty($domain)) : ?>
							<li>http(s):// <input type="text" name="<?php print $this->settings_name; ?>[filter][exclude-domain][]" class="regular-text" value="<?php echo $domain; ?>" /><button type="button" class="button delete-exclude-domain qc-icon delete"><?php _e('Delete'); ?></button></li>
								<?php endif; endforeach; ?>
							</ul>
							<p><button type="button" id="add_exclude_domain" class="button"><?php _e('Add a Domain/Keyword', $this->text_domain);?></button></p>
							<p class="description"><?php _e("Images will not be saved, if that url contains Exclude-Domain/Keyword.", $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php _e('Excluded Keywords', $this->text_domain)?></label></th>
						<td>
							<ol>
								<?php
 $exclude_domain = $this->get_exclude_domain(); foreach ($exclude_domain as $domain) : ?>
								<li><?php echo $domain; ?></li>
								<?php endforeach; ?>
							</ol>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="<?php print $this->settings_name; ?>-filter-check-duplicated"><?php _e('Check Duplicated', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-filter-check-duplicated', 'name' => $this->settings_name . '[filter][check-duplicated]', 'value' => $this->options->qc_asa_filter_check_duplicated )); ?>
							<p class="description"><?php _e('If the image has already been collected, it is called directly from the media library.', $this->text_domain); ?></label></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="add_exclude_crc"><?php _e('Exclude CRC', $this->text_domain); ?></label></th>
						<td>
							<ul id="exclude_crc_list">
							<?php
 if (!empty($this->options->qc_asa_filter_exclude_crc)) foreach ($this->options->qc_asa_filter_exclude_crc as $crc) : if (!empty($crc)) : ?>
							<li><input type="text" name="<?php print $this->settings_name; ?>[filter][exclude-crc][]" value="<?php echo $crc; ?>" /><button type="button" class="button delete-exclude-crc qc-icon delete"><?php _e('Delete'); ?></button></li>
								<?php endif; endforeach; ?>
							</ul>
							<p><button type="button" id="add_exclude_crc" class="button"><?php _e('Add a CRC of Image', $this->text_domain);?></button></p>
							<p class="description"><?php _e("Remote images will not be saved, if the CRC of image in this list.", $this->text_domain); ?><br /><?php printf(__('Use 7-Zip, WinRAR or others compression tools to get <a href="%s" target="_blank">CRC</a>.', $this->text_domain), QQWORLD_COLLECTOR_URL . 'images/auto-save-attachments/get-crc.png'); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="add_delete_crc"><?php _e('Delete CRC', $this->text_domain); ?></label></th>
						<td>
							<ul id="delete_crc_list">
							<?php
 if (!empty($this->options->qc_asa_filter_delete_crc)) foreach ($this->options->qc_asa_filter_delete_crc as $crc) : if (!empty($crc)) : ?>
							<li><input type="text" name="<?php print $this->settings_name; ?>[filter][delete-crc][]" value="<?php echo $crc; ?>" /><button type="button" class="button delete-delete-crc qc-icon delete"><?php _e('Delete'); ?></button></li>
								<?php endif; endforeach; ?>
							</ul>
							<p><button type="button" id="add_delete_crc" class="button"><?php _e('Add a CRC of Image', $this->text_domain);?></button></p>
							<p class="description"><?php _e("Remote images html code will be deleted, if the CRC of image in this list. it's priority than Exclude-CRC", $this->text_domain); ?><br /><?php printf(__('Use 7-Zip, WinRAR or others compression tools to get <a href="%s" target="_blank">CRC</a>.', $this->text_domain), QQWORLD_COLLECTOR_URL . 'images/auto-save-attachments/get-crc.png'); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="add_exclude_domain"><?php _e('Delete Domain/Keyword', $this->text_domain); ?></label></th>
						<td>
							<ul id="delete_domain_list">
							<?php
 if (!empty($this->options->qc_asa_filter_delete_domain)) foreach ($this->options->qc_asa_filter_delete_domain as $domain) : if (!empty($domain)) : ?>
							<li>http(s):// <input type="text" name="<?php print $this->settings_name; ?>[filter][delete-domain][]" class="regular-text" value="<?php echo $domain; ?>" /><button type="button" class="button delete-exclude-domain qc-icon delete"><?php _e('Delete'); ?></button></li>
								<?php endif; endforeach; ?>
							</ul>
							<p><button type="button" id="add_delete_domain" class="button"><?php _e('Add a Domain/Keyword', $this->text_domain);?></button></p>
							<p class="description"><?php _e("Images will be deleted, if that url contains Delete-Domain/Keyword.", $this->text_domain); ?></p>
						</td>
					</tr>
				<//tbody>
			</table>
			<?php submit_button(null, 'primary', 'submit-2'); ?>
		</div>
		<!-- Filter - end -->
		<!-- Format - start -->
		<div class="nav-section hidden">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="delete-missing-images"><?php _e('Delete Missing Images', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'delete-missing-images', 'name' => $this->settings_name . '[format][delete-missing-images]', 'value' => $this->options->qc_asa_format_delete_missing_images )); ?>
							<p class="description"><?php _e("Automatically Delete html code of remote images that missing or undownloadable.", $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="auto_change_name"><?php _e('Change Image Filename', $this->text_domain); ?></label></th>
						<td>
							<select id="auto_change_name" name="<?php print $this->settings_name; ?>[format][auto-change-name]" class="selectstyle">
								<option value="none" <?php selected('none', $this->options->qc_asa_format_change_image_name); ?>>1. <?php _e('No'); ?></option>
								<option value="ascii" <?php selected('ascii', $this->options->qc_asa_format_change_image_name); ?>>2. <?php _e('Only change attachment filename that have Non-ASCii characters (for Windows Server)', $this->text_domain); ?></option>
								<option value="all" <?php selected('all', $this->options->qc_asa_format_change_image_name); ?>>3. <?php _e('Change all attachment filename (for Linux Server)', $this->text_domain); ?></option>
							</select>
						</td>
					</tr>
					<tr id="filename-source-field"<?php if ($this->options->qc_asa_format_change_image_name!='all') echo ' style="display: none;"'?>>
						<th scope="row"><label><?php _e('Filename Source & Source Priority', $this->text_domain); ?></label></th>
						<td>
							<?php
 $filename_sources = array( 'postname' => __('Post Name', $this->text_domain), 'alt' => __('Alternative Text of Image (alt)', $this->text_domain), 'title' => __('Title of Image', $this->text_domain) ); ?>
							<table class="wp-list-table fixed striped posts qc-drag-list">
							<?php
 foreach ($this->options->qc_asa_format_filename_source as $slug) : ?>
								<tr>
									<td><span class="icon drag"></span></td>
									<td style="width: 250px;"><label><input type="hidden" name="<?php print $this->settings_name; ?>[format][filename-source][]" value="<?php echo $slug; ?>" <?php if (in_array($slug, $this->options->qc_asa_format_filename_source)) echo 'checked'; ?> /><?php echo $filename_sources[$slug]; ?></label></td>
									
								</tr>
							<?php
 endforeach; ?>
							</table>
							<p class="description"><?php _e('You can change the order by dragging.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="filename-structure"><?php _e('Custom Filename Structure', $this->text_domain); ?><br /><?php _e('(For Grab Remote Attachment)', $this->text_domain); ?></label></th>
						<td>
							<label for="filename-structure">
								<input name="<?php print $this->settings_name; ?>[format][filename-structure]" type="text" id="filename-structure" class="regular-text" value="<?php echo $this->options->qc_asa_format_filename_structure; ?>" />
							</label>
							<p class="description">
								<strong>%filename%</strong> : <?php _e('Original filename or automatic changed filename.', $this->text_domain); ?><br />
								<strong>%date%</strong> : <?php _e('Full date, e.g. 20150209.', $this->text_domain); ?><br />
								<strong>%year%</strong> - <?php _e('YYYY, e.g. 2015.', $this->text_domain); ?><br />
								<strong>%month%</strong> - <?php _e('MM, e.g. 02.', $this->text_domain); ?><br />
								<strong>%day%</strong> -  <?php _e('DD, e.g. 15.', $this->text_domain); ?><br />
								<strong>%time%</strong> - <?php _e('HHMMSS, e.g. 182547.', $this->text_domain); ?><br />
								<strong>%timestamp%</strong> - <?php printf(__('Unix timestamp, e.g. %s.', $this->text_domain), time()); ?><br />
								<strong>%md5%</strong> - <?php printf(__('MD5, e.g. %s.', $this->text_domain), md5('qqworld.org')); ?><br />
								<strong>%random%</strong> - <?php printf(__('Random number, e.g. %s.', $this->text_domain), 'A5eqWj'); ?><br />
								<strong>%post_id%</strong> - <?php printf(__('Post ID, e.g. %s.', $this->text_domain), '128'); ?><br />
								<strong>%post_name%</strong> - <?php printf(__('Post Name, e.g. %s.', $this->text_domain), 'hello-world'); ?>
							</p>
							<p class="description"><em class="qc-icon info"><?php printf(__('Multiple combinations of variables can be used, such as: %s', $this->text_domain), '<strong>%post_id%</strong>-<strong>%random%</strong>'); ?></em></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="filename-structure-for-upload"><?php _e('Custom Filename Structure', $this->text_domain); ?><br /><?php _e('(For Upload Attachment)', $this->text_domain); ?></label></th>
						<td>
							<label for="filename-structure">
								<input name="<?php print $this->settings_name; ?>[format][filename-structure-for-upload]" type="text" id="filename-structure-for-upload" class="regular-text" value="<?php echo $this->options->qc_asa_format_filename_structure_for_upload; ?>" />
							</label>
							<p class="description">
								<strong>%filename%</strong> : <?php _e('Original filename.', $this->text_domain); ?><br />
								<strong>%date%</strong> : <?php _e('Full date, e.g. 20150209.', $this->text_domain); ?><br />
								<strong>%year%</strong> - <?php _e('YYYY, e.g. 2015.', $this->text_domain); ?><br />
								<strong>%month%</strong> - <?php _e('MM, e.g. 02.', $this->text_domain); ?><br />
								<strong>%day%</strong> -  <?php _e('DD, e.g. 15.', $this->text_domain); ?><br />
								<strong>%time%</strong> - <?php _e('HHMMSS, e.g. 182547.', $this->text_domain); ?><br />
								<strong>%timestamp%</strong> - <?php printf(__('Unix timestamp, e.g. %s.', $this->text_domain), time()); ?><br />
								<strong>%md5%</strong> - <?php printf(__('MD5, e.g. %s.', $this->text_domain), md5('qqworld.org')); ?><br />
								<strong>%random%</strong> - <?php printf(__('Random number, e.g. %s.', $this->text_domain), 'A5eqWj'); ?>
							</p>
							<p class="description"><em class="qc-icon info"><?php printf(__('Multiple combinations of variables can be used, such as: %s', $this->text_domain), '<strong>%day%</strong>-<strong>%random%</strong>'); ?></em></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="format_title_alt"><?php _e('Change Title & Alt', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'format_title_alt', 'name' => $this->settings_name . '[format][title-alt]', 'value' => $this->options->qc_asa_format_change_title_alt )); ?>
							<p class="description"><?php _e('Automatically add title & alt of image as post title or custom text.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="format_keep_style"><?php _e('Keep Image Style', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'format_keep_style', 'name' => $this->settings_name . '[format][keep-image-style]', 'value' => $this->options->qc_asa_format_keep_style )); ?>
							<p class="description"><?php _e("Keep the style of remote images if exist.", $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="format_keep_external_links"><?php _e('Keep External Links', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'format_keep_external_links', 'name' => $this->settings_name . '[format][keep-external-links]', 'value' => $this->options->qc_asa_format_keep_external_links )); ?>
							<p class="description"><?php _e("Keep the outside links of remote images if exist.", $this->text_domain); ?><br /><em class="qc-icon info"><?php _e('Note: Some download links are images. If this option is not checked, the download url will be deleted when grabbing remote images.', $this->text_domain); ?></em></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="format_save_external_links"><?php _e('Save External Links', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'format_save_external_links', 'name' => $this->settings_name . '[format][save-external-links]', 'value' => $this->options->qc_asa_format_save_external_links )); ?>
							<p class="description"><?php _e("Save the external links to description of attachments.", $this->text_domain); ?></p>
							<p class="description"><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--save-external-link'); ?>" target="_blank"><?php _e('Custom content of save external links', $this->text_domain); ?></a></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="width_height"><?php _e('Width &amp; Height', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'width_height', 'name' => $this->settings_name . '[format][width-height]', 'value' => $this->options->qc_asa_format_change_width_height )); ?>
							<p class="description"><?php _e("Automatically set the true height and width of the image.", $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="format-size"><?php _e('Image Size', $this->text_domain); ?></label></th>
						<td>
							<label>
								<select name="<?php print $this->settings_name; ?>[format][size]" id="format-size" class="selectstyle">
								<?php
 $sizes = apply_filters( 'image_size_names_choose', array( 'thumbnail' => __('Thumbnail'), 'medium' => __('Medium'), 'large' => __('Large'), 'full' => __('Full Size') ) ); foreach ($sizes as $value => $title) echo '<option value="'.$value.'"'.selected($value, $this->options->qc_asa_format_image_size, false).'>'.$title.'</option>'; ?>
								</select>
							</label>
							<p class="description"><?php _e("Replace images you want size to display.", $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="format-link-to"><?php _e('Link To', $this->text_domain); ?></label></th>
						<td>
							<label>
								<select name="<?php print $this->settings_name; ?>[format][link-to]" id="format-link-to" class="selectstyle">
								<?php
 $linkTo = array( 'file' => __('Media File'), 'post' => __('Attachment Page'), 'none' => __('None') ); foreach ($linkTo as $value => $title) echo '<option value="'.$value.'"'.selected($value, $this->options->qc_asa_format_format_link_to, false).'>'.$title.'</option>'; ?>
								</select>
							</label>
							<p class="description"><?php _e("If you checked Keep-Outside-Links, this option will not works.", $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="format-align-to-enabled"><?php _e('Align To', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'format-align-to-enabled', 'name' => $this->settings_name . '[format][align-to-enabled]', 'value' => $this->options->qc_asa_format_align_to_enabled )); ?>
							<label>
								<select name="<?php print $this->settings_name; ?>[format][align-to]" id="format-align-to"<?php if ($this->options->qc_asa_format_align_to_enabled!=1) echo ' style="display: none;"'; ?> class="selectstyle">
								<?php
 $linkTo = array( 'left' => __('Left'), 'center' => __('Center'), 'right' => __('Right'), 'none' => __('None') ); foreach ($linkTo as $value => $title) echo '<option value="'.$value.'"'.selected($value, $this->options->qc_asa_format_align_to, false).'>'.$title.'</option>'; ?>
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="format_caption"><?php _e('Auto Caption', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'format_caption', 'name' => $this->settings_name . '[format][auto-caption]', 'value' => $this->options->qc_asa_format_auto_caption )); ?>
							<p class="description"><?php _e("Automatically add caption shortcode.", $this->text_domain); ?></p>
							<p><input name="<?php print $this->settings_name; ?>[format][auto-caption-width]" class="small-text" type="number" placeholder="<?php _e('Width'); ?>" id="qqworld-auto-save-images-auto-caption-width" value="<?php echo $this->options->qc_asa_format_auto_caption_width; ?>" /> x <input name="<?php print $this->settings_name; ?>[format][auto-caption-height]" class="small-text" type="number" placeholder="<?php _e('Height'); ?>" id="qqworld-auto-save-images-auto-caption-height" value="<?php echo $this->options->qc_asa_format_auto_caption_height; ?>" /></p>
							<p class="description"><?php _e('The smallest image size (px) allowed to add captions.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="format_caption"><?php _e('Compatible', $this->text_domain); ?></label></th>
						<td>
							<select name="<?php print $this->settings_name; ?>[format][compatible]" class="selectstyle">
								<option value="gutenberg" <?php selected('gutenberg', $this->options->qc_asa_format_compatible); ?>><?php _e('Gutenberg Editor (Block Editor)', $this->text_domain); ?></option>
								<option value="tinymce" <?php selected('tinymce', $this->options->qc_asa_format_compatible); ?>><?php _e('TinyMCE Editor (Old Editor)', $this->text_domain); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="additional_content_after"><?php _e('Additional Content', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'format-additional-before', 'name' => $this->settings_name . '[format][additional][before]', 'value' => $this->options->qc_asa_format_additional_before )); ?>
							<p class="description"><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--additional-content'); ?>" target="_blank"><?php _e('Additional Content Before', $this->text_domain); ?></a></p>
							<?php
 $this->the_switcher(array( 'id' => 'format-additional-after', 'name' => $this->settings_name . '[format][additional][after]', 'value' => $this->options->qc_asa_format_additional_after )); ?>
							<p class="description"><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--additional-content'); ?>" target="_blank"><?php _e('Additional Content After', $this->text_domain); ?></a></p>
							<p class="description"><?php _e("This content will be displayed before or after the each remote images code.", $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<!-- Format - end -->
			<?php submit_button(null, 'primary', 'submit-3'); ?>
		</div>
	</form>
	<!-- Scan Posts - start -->
	<div class="nav-section hidden">
		<div id="scan-result"></div>
		<div id="scan-post-block">
			<form id="scan" action="" method="get">
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label><?php _e('Select post types', $this->text_domain); ?></label></th>
							<td>
								<?php $post_types = get_post_types(array('public' => 1), 'objects'); ?>
								<ul id="post_types_list">
								<?php foreach ($post_types as $name => $post_type) : $count = wp_count_posts($name); if (!in_array($name, array('attachment', 'revision', 'nav_menu_item'))) : ?>
									<li><label><input name="qqworld-collector-auto-save-attachments-post-types[]" type="checkbox" value="<?php echo $name; ?>" /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
								<?php endif; endforeach; ?></ul>
								<p class="description"><?php _e("If you have too many posts to be scan, sometimes in process looks like stopping, but it may be fake. please be patient.", $this->text_domain) ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label><?php _e('Categories'); ?></label></th>
							<td>
								<div id="categories_block" class="terms_list_container"><?php _e('Please select post types.', $this->text_domain); ?></div>
								<p class="description"><?php _e("Default empty to scan all categories.", $this->text_domain) ?></p>
							</td>
						</tr>

						<tr>
							<th scope="row"><label for="id_from"><?php _e('Scope of Post ID', $this->text_domain); ?></label></th>
							<td>
								<?php printf(__('From %1$s to %2$s', $this->text_domain), '<input type="number" class="small-text" name="id_from" id="id_from" />', '<input type="number" class="small-text" name="id_to" />'); ?>
								<p class="description"><?php _e("Default empty for scan all posts ID. If you want to scan posts ID from 50 to 100. please type '50' and '100' or '100' and '50', The order in which two numbers can be reversed. If you only type one number, system would only scan that ID.", $this->text_domain); ?></p>
							</td>
						</tr>

						<tr>
							<th scope="row"><label for="post_date_before"><?php _e('Date Range', $this->text_domain); ?></label></th>
							<td>
								<input type="text" id="post_date_after" name="post_date_after" class="datepicker" readonly /> - <input type="text" id="post_date_before" name="post_date_before" class="datepicker" readonly />
								<p class="description"><?php _e('You can fill in all of them, or you can just fill in one of them.', $this->text_domain); ?></p>
							</td>
						</tr>
						
						<tr>
							<th scope="row"><label for="offset"><?php _e('Offset', $this->text_domain); ?></label></th>
							<td>
								<?php printf(__('Start from %s to Scan', $this->text_domain), '<input type="number" class="small-text" name="offset" id="offset" value="0" disabled />'); ?>
								<select name="posts_per_page" class="selectstyle">
									<option value="-1"><?php _e('All'); ?></option>
									<option value="20">20</option>
									<option value="30">30</option>
									<option value="50">50</option>
									<?php for ($i=1; $i<=10; $i++) : ?>
									<option value="<?php echo $i*100; ?>"><?php echo $i*100; ?></option>
									<?php endfor; ?>
									<option value="2000">2000</option>
									<option value="5000">5000</option>
								</select> <?php _e('Posts'); ?>
								<p class="description"><?php _e("Default scan all posts. If you want to scan 50-150 posts, please type '50' in the textfield and select '100'.", $this->text_domain); ?></p>
							</td>
						</tr>

						<tr>
							<th scope="row"><label for="scan_post_status"><?php _e('Status'); ?></label></th>
							<td>
								<select name="post_status" id="scan_post_status" class="selectstyle">
								<?php
 global $wp_post_statuses; echo '<option value="any" /> '.__('Any', $this->text_domain).'</option>'; foreach ($wp_post_statuses as $slug => $status) { if (!in_array($slug, array('auto-draft', 'inherit', 'trash'))) echo '<option value="'.$slug.'" '.selected('publish', $slug, false).'> '.$status->label.'</option>'; } ?>
								</select>
							</td>
						</tr>

						<tr>
							<th scope="row"><label for="scan_orderby"><?php _e('Order By', $this->text_domain); ?></label></th>
							<td>
								<select name="orderby" id="scan_orderby" class="selectstyle">
									<?php
 $default_orderby = $this->get_default_orderby(); foreach ($default_orderby as $key => $name) : ?>
									<option value="<?php echo $key; ?>"<?php selected('date', $key); ?>><?php echo $name; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>

						<tr>
							<th scope="row"><label for="order"><?php _e('Order'); ?></label></th>
							<td>
								<select name="order" id="order" class="selectstyle">
									<option value="DESC">DESC</option>
									<option value="ASC">ASC</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<th scope="row"><label for="scan_speed"><?php _e('Speed', $this->text_domain); ?></label></th>
							<td>
								<select name="speed" id="scan_speed" class="selectstyle">
									<?php
 for ($i=1; $i<=10; $i++) : $selected = get_transient( 'qqworld-collector-auto-save-attachments-scan-posts-speed' ); ?>
									<option value="<?php echo $i; ?>" <?php selected($selected, $i); ?>><?php echo $i; ?></option>
									<?php endfor; ?>
								</select>
								<p class="description"><?php _e('If the server is too much stress may be appropriately reduced speed.', $this->text_domain); ?></p>
							</td>
						</tr>

						<tr>
							<th scope="row"><label for="force-scan"><?php _e('Force Scan', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'force-scan', 'name' => 'force-scan', 'value' => 0 )); ?>
								<p class="description"><?php _e("Successfully scanned posts will be marked, wouldn\'t be scanned again. if you check this, they will be scanned again.", $this->text_domain); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
				<p class="submit">
					<button name="scan_old_posts" type="button" class="button-primary qc-icon convert" id="scan_old_posts"><?php _e('Automatic', $this->text_domain); ?></button>
					<button name="list_all_posts" type="button" class="button-primary qc-icon search" id="list_all_posts"><?php _e('Manual', $this->text_domain); ?></button>
					&nbsp;&nbsp;
					<?php printf(__('After %s minutes', $this->text_domain), '<input type="number" class="small-text" id="after-schedule" name="after-schedule" value="5" />'); ?>
					<select name="schedule" id="scan-schedules" class="selectstyle">
						<option value=""><?php _e('Single Task', $this->text_domain); ?></option>
					<?php
 foreach (wp_get_schedules() as $recurrence => $detail) { echo '<option value="'.$recurrence.'">'.$detail['display'].'</option>'; } ?>
					</select>
					<button name="cron_scan_posts" type="button" class="button-primary qc-icon time" id="cron_scan_posts"><?php _e('Schedule Scan Task', $this->text_domain); ?></button>
				</p>
				<dl>
					<dt><strong class="qc-icon info"><?php _e('Automatic', $this->text_domain); ?></strong></dt>
					<dd><?php _e('Scan posts and keep remote images in all posts to local media library. Maybe take a long time.', $this->text_domain); ?></dd>
					<dt><strong class="qc-icon info"><?php _e('Manual', $this->text_domain); ?></strong></dt>
					<dd><?php _e("The list displayed will show you which posts including remote images, then you can keep them to local manually via click \"Fetch\" button.", $this->text_domain); ?></dd>
					<dt><strong class="qc-icon info"><?php _e('Cron', $this->text_domain); ?></strong></dt>
					<dd><?php _e("Set cron for automatically scan posts.<br />I recommend set the option Offset from 0 to scan 100 posts.", $this->text_domain); ?></dd>
				</dl>
			</form>
		</div>
	</div>
	<!-- Scan Posts - end -->
	<!-- Cron - start -->
	<div class="nav-section hidden">
		<h3><?php _e('Cron of Scan Posts', $this->text_domain); ?></h3>
		<form id="scan-cron" action="" method="get">
			<table id="cron-list-table" class="wp-list-table widefat striped posts">
				<thead>
					<td class="manage-column column-cb check-column"></td>
					<th scope="col" class="manage-column column-primary"><?php _e('Post Types', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Categories'); ?></th>
					<th scope="col" class="manage-column"><?php _e('Scope of Post ID', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Date Range', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Offset', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Status'); ?></th>
					<th scope="col" class="manage-column"><?php _e('Order By', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Order'); ?></th>
					<th scope="col" class="manage-column"><?php _e('Recurrence', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Will Run On', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Delete'); ?></th>
				</thead>
				<?php $crons = $this->get_crons('qqworld-collector-auto-save-attachment-cron-scan-post'); ?>
				<tbody id="cron-list">
					<?php
 if (!empty($crons)) : $options = array(); foreach ($crons as $cron) { $options[$cron['timestamp']] = $cron['options']['args'][0]; } echo $this->scan_posts->get_cron_table_row($options); else : ?>
					<tr class="no-cron">
						<td colspan="12"><?php _e('No cron yet.', $this->text_domain); ?></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<p class="submit">
				<input type="button" class="button button-primary" id="clear-all-crons" value="<?php _e('Clear All Crons', $this->text_domain); ?>" />
			</p>
		</form>
		<h3><?php _e('Scan Log', $this->text_domain); ?></h3>
		<?php
 global $blog_id; $log_path = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $blog_id . DIRECTORY_SEPARATOR . 'qqworld-collector' . DIRECTORY_SEPARATOR . 'cron-scan-posts.log'; ?>
		<p><?php printf(__('Log path: %s', $this->text_domain), $log_path); ?></p>
		<?php
 $content = file_exists($log_path) && filesize($log_path) ? file_get_contents($log_path) : __('Log is emplty.', $this->text_domain); ?>
		<pre><code class="language-markup"><?php print $content; ?></code></pre>
	</div>
	<!-- Cron - end -->
	<!-- General - start -->
	<div class="nav-section">
		<p><?php _e('The new browsers now basically support the WEBP format, and the full use of the WEBP format has been put on the agenda. This tool will help everyone to batch convert pictures in media library to WEBP format.', $this->text_domain); ?></p>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="mime-types"><?php _e('Mime Types', $this->text_domain); ?></label></th>
					<td>
						<ul class="mime_types_list">
						<?php
 $mime_types = get_allowed_mime_types(); foreach ($mime_types as $name => $mime_type) : if ( !preg_match('/^image/i', $mime_type) ) continue; $pretty_name = isset($this->mime_type_pretty_name[$mime_type]) ? $this->mime_type_pretty_name[$mime_type] : $mime_type; ?>
							<li><label><input name="mime_types[]" type="checkbox" value="<?php echo $mime_type; ?>" /> <img src="<?php echo wp_mime_type_icon($mime_type); ?>" width="16" height="16" /> <?php echo $pretty_name; ?> (<?php echo str_replace('|', ', ', $name); ?>)</label></li>
						<?php endforeach; ?>
						</ul>
						<p class="description"><?php _e("Select the mime types you want to convert.", $this->text_domain) ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="convert-to"><?php _e('Convert To', $this->text_domain); ?></label></th>
					<td>
						<select name="convert-to" id="convert-to" class="selectstyle">
							<option value="webp">WEBP</option>
							<option value="jpeg">JPEG</option>
							<option value="png">PNG</option>
							<option value="gif">GIF</option>
						</select>
						<p class="description"><?php _e('Select the file format you want to convert.', $this->text_domain) ?></p>
						<p class="description webp"><em class="qc-icon info"><?php _e('Danger! It is recommended to confirm that the environment supports WEBP before scanning, and backup the entire website.', $this->text_domain); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="scan-selected-images"><?php _e('Scan Selected Images', $this->text_domain); ?></label></th>
					<td>
						<?php
 $exclude = get_option('qqworld-collector-convert-image-file-fromat-selected-images-exclude'); $label = $exclude ? __('Continue to Scan', $this->text_domain) : __('Scan Now', $this->text_domain); ?>
						<button type="button" id="scan-selected-images" class="button button-primary button-large qc-icon refresh start-scanning" data-mode="all"><?php print $label; ?></button>
						<button type="button" id="rescan-selected-images" class="button button-large qc-icon delete restart-scanning" data-mode="all"<?php if (!$exclude) print ' disabled';?>><?php
 if ($exclude) printf(__('Restart (%d)', $this->text_domain), count($exclude)); else _e('Restart', $this->text_domain); ?></button>
						&nbsp;&nbsp;
						<?php printf(__('After %s minutes', $this->text_domain), '<input type="number" class="small-text" id="convert-after-schedule" name="convert-after-schedule" value="5" />'); ?>
						<select name="schedule" id="convert-scan-schedules" class="selectstyle">
							<option value=""><?php _e('Single Task', $this->text_domain); ?></option>
						<?php
 $schedules = wp_get_schedules(); foreach ($schedules as $recurrence => $detail) { echo '<option value="'.$recurrence.'">'.$detail['display'].'</option>'; } ?>
						</select>
						<button name="cron_convert_scan_posts" type="button" class="button-primary qc-icon time" id="cron_convert_scan_posts"><?php _e('Schedule Scan Task', $this->text_domain); ?></button>
						<button type="button" class="cancel-schedule-convert-file-format button qc-icon delete" id="cancel-schedule-convert-file-format"><?php _e('Cancel', $this->text_domain); ?></button>
						<p class="description"><?php _e('Scan the selected images and convert it to the specified file format.<br />You can continue to scan the snapshot. If you want to restart the scan, click the <strong>Restart</strong> button.', $this->text_domain); ?></p>
						<p class="description" id="auto-save-attachment-convert-schedule-timer"><?php
 $crons = $this->get_crons('qqworld-collector-auto-save-attachment-convert-schedule-scan'); if ($crons) foreach ($crons as $cron) { $recurrence = $cron['options']['schedule']; $type = $recurrence ? $schedules[$recurrence]['display'] : __('Single Task', $this->text_domain); $next_time = $cron['timestamp'] - time(); if ($next_time >= 0) { ?><time class="convert-next-time" id="convert-next-time" data-type="<?php echo $type; ?>" data-time="<?php print $next_time; ?>"></time><?php
 } elseif ($this->options->cloud_storage_schedule_recurrence) { _e('Scanning.<span class="spinner is-active"></span>', $this->text_domain); } } ?></p>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- General - end -->
</div>