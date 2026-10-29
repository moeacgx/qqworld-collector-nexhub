<div class="wrap" id="qqworld-collector-settings">
	<?php
 if ($this->options->qc_watermark_image) { $watermark_image_path = get_attached_file($this->options->qc_watermark_image); if (!file_exists($watermark_image_path)) print '<div class="error"><p>' . __('Warning: The local watermark image does not exist, the image with watermark cannot be generated, and this page may be stuck.', $this->text_domain). '</p></div>'; } ?>
	<h2 id="header-title"><?php _e("Watermark", $this->text_domain); ?></h2>
	<form action="options.php" method="post" id="watermark-form">
		<?php settings_fields($this->settings_name); ?>
		<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
			<a href="#common" class="nav-tab qc-icon regular"><?php _e('Common Settings', $this->text_domain); ?></a>
			<a href="#image-watermark" class="nav-tab qc-icon image"><?php _e('Image Watermark', $this->text_domain); ?></a>
			<a href="#text-watermark" class="nav-tab qc-icon text"><?php _e('Text Watermark', $this->text_domain); ?></a>
		</h2>
		<!-- Common Settings - start -->
		<div class="nav-section">
			<table class="form-table">
				<tr>
					<th scope="row"><label for="ignore-animated-gif"><?php _e('Ignore animated GIF', $this->text_domain); ?></label></th>
					<td>
						<?php
 $this->the_switcher(array( 'id' => 'ignore-animated-gif', 'name' => $this->settings_name . '[ignore-animated-gif]', 'value' => $this->options->qc_watermark_ignore_animated_gif )); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="scan-media-library-to-add-watermark"><?php _e('Scan', $this->text_domain); ?></label></th>
					<td>
						<button type="button" class="button button-primary qc-icon refresh" id="scan-media-library-to-add-watermark"><?php _e('Scan', $this->text_domain); ?></button>
						<p class="description"><?php _e("Scan media library to automatically add watermark to allowed images. Will not process to images that already added watermark.", $this->text_domain); ?></p>
						<p class="description"><em class="qc-icon info"><?php _e('Note: The Media Library option must be checked in the Enabled For to be work.', $this->text_domain); ?></em></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="backup-original"><?php _e('Backup the Original Image', $this->text_domain); ?></label></th>
					<td>
						<?php
 $this->the_switcher(array( 'id' => 'backup-original', 'name' => $this->settings_name . '[backup-original]', 'value' => $this->options->qc_watermark_backup_original )); ?>
						<p class="description"><?php printf(__('To facilitate the replacement of the watermark, back up a copy of the original image to <em>%s</em>.', $this->text_domain), WP_CONTENT_DIR . DIRECTORY_SEPARATOR . '<input type="text" name="' . $this->settings_name . '[backup-dir]" value="'.$this->options->qc_watermark_backup_dir.'">' . DIRECTORY_SEPARATOR); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="scan-media-library-to-restore-original-images"><?php _e('Restore', $this->text_domain); ?></label></th>
					<td>
						<button type="button" class="button button-primary qc-icon refresh" id="scan-media-library-to-restore-original-images"><?php _e('Scan', $this->text_domain); ?></button>
						<p class="description"><?php _e('Scan media library to automatically restore ogiginal images.', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enabled-for"><?php _e('Enabled For', $this->text_domain); ?></label></th>
					<td>
						<p><label>
							<input name="<?php print $this->settings_name; ?>[enabled-for][]" type="checkbox" id="watermark-enabled-for-collection" value="collection"<?php if ( is_array($this->options->qc_watermark_enabled_for) && in_array('collection', $this->options->qc_watermark_enabled_for) ) echo ' checked'; ?> />
							<?php _e('Auto Save Images', $this->text_domain); ?><br />
							<?php _e("Enabled for Auto Save Image.", $this->text_domain); ?>
						</label></p>
						<p><label>
							<input name="<?php print $this->settings_name; ?>[enabled-for][]" type="checkbox" id="watermark-enabled-for-edit-page" value="edit-page"<?php if ( is_array($this->options->qc_watermark_enabled_for) && in_array('edit-page', $this->options->qc_watermark_enabled_for) ) echo ' checked'; ?> />
							<?php _e('Edit Page', $this->text_domain); ?><br />
							<?php _e("Enabled for Update image in Edit page.", $this->text_domain); ?>
						</label></p>
						<p><label>
							<input name="<?php print $this->settings_name; ?>[enabled-for][]" type="checkbox" id="watermark-enabled-for-media-library" value="media-library"<?php if ( is_array($this->options->qc_watermark_enabled_for) && in_array('media-library', $this->options->qc_watermark_enabled_for) ) echo ' checked'; ?> />
							<?php _e('Media Library', $this->text_domain); ?><br />
							<?php _e("Enabled for Update image in Meida Labrary page.", $this->text_domain); ?>
						</label></p>
						<p class="description"><?php _e("Please select the method to using watermark.", $this->text_domain); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enabled-for-thumbnail-sizes"><?php _e('Enabled for Thumbnail Sizes', $this->text_domain); ?></label></th>
					<td>
						<p class="hidden"><label><input name="<?php print $this->settings_name; ?>[thumbnail-sizes][]" type="checkbox" value="full" <?php if (is_array($this->options->qc_watermark_thumbnail_sizes) && in_array('full', $this->options->qc_watermark_thumbnail_sizes)) echo ' checked="checked"'; ?> /> <?php _e('Full Size'); ?></label></p>
						<?php
 $sizes = apply_filters( 'image_size_names_choose', array( 'thumbnail' => __('Thumbnail'), 'medium' => __('Medium'), 'medium_large' => __('Medium Large', $this->text_domain), 'large' => __('Large'), 'full' => __('Full Size') ) ); foreach ( get_intermediate_image_sizes() as $_size ) : ?>
							<p><label><input name="<?php print $this->settings_name; ?>[thumbnail-sizes][]" type="checkbox" value="<?php echo $_size; ?>" <?php if (is_array($this->options->qc_watermark_thumbnail_sizes) && in_array($_size, $this->options->qc_watermark_thumbnail_sizes)) echo ' checked="checked"'; ?> /> <?php echo isset($sizes[$_size]) ? $sizes[$_size] : $_size; ?></label></p>
						<?php endforeach; ?>
						<p class="description"><?php _e('Please select the image size to be watermarked.', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="filter-size-width"><?php _e('Filter by Sizes', $this->text_domain); ?></label></th>
					<td>
						<p><label>
							<input name="<?php print $this->settings_name; ?>[filter-size][width]" type="number" id="filter-size-width" value="<?php echo $this->options->qc_watermark_filter_size_width; ?>" class="small-text" /> <?php _e('Width (px)', $this->text_domain); ?>
						</label></p>
						<p><label>
							<input name="<?php print $this->settings_name; ?>[filter-size][height]" type="number" id="filter-size-height" value="<?php echo $this->options->qc_watermark_filter_size_height; ?>" class="small-text" /> <?php _e('Height (px)', $this->text_domain); ?>
						</label></p>
						<p class="description"><?php _e("Skip images that smaller than this size.", $this->text_domain); ?></p>
						<p><label>
							<input name="<?php print $this->settings_name; ?>[filter-size][max-width]" type="number" id="filter-size-max-width" value="<?php echo $this->options->qc_watermark_filter_size_max_width; ?>" class="small-text" /> <?php _e('Width (px)', $this->text_domain); ?>
						</label></p>
						<p><label>
							<input name="<?php print $this->settings_name; ?>[filter-size][max-height]" type="number" id="filter-size-max-height" value="<?php echo $this->options->qc_watermark_filter_size_max_height; ?>" class="small-text" /> <?php _e('Height (px)', $this->text_domain); ?>
						</label></p>
						<p class="description"><?php _e("Skip images that greater than this size.", $this->text_domain); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="add-watermark-filter-url"><?php _e('Filter by Url', $this->text_domain); ?></label></th>
					<td>
						<ul id="filter_url_list">
						<?php
 if (!empty($this->options->qc_watermark_filter_url)) foreach ($this->options->qc_watermark_filter_url as $url) : if (!empty($url)) : ?>
						<li>http(s):// <input type="text" name="<?php print $this->settings_name; ?>[filter-url][]" class="regular-text" value="<?php echo $url; ?>" /><input type="button" class="button delete-watermark-filter-url" value="<?php _e('Delete'); ?>"></li>
							<?php endif; endforeach; ?>
						</ul>
						<p><input type="button" id="add-watermark-filter-url" class="button" value="<?php _e('Add a Domain/Keyword', $this->text_domain);?>" /></p>
						<p class="description"><?php _e("Skip images that url contains these keywords.", $this->text_domain); ?></p>
					</td>
				</tr>
			</table>
		</div>
		<!-- Common Settings - end -->
		<!-- Image Watermark - start -->
		<div class="nav-section">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="image-watermark-enabled"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td><?php
 $this->the_switcher(array( 'id' => 'image-watermark-enabled', 'name' => $this->settings_name . '[image][enabled]', 'value' => $this->options->qc_watermark_image_enabled )); ?><p><span class="qc-icon info"><?php printf(__('Note: After enabled, you can perform batch operations on the <a href="%s" target="_blank">media library list page</a>.', $this->text_domain), admin_url('upload.php?mode=list')); ?></p></td>
					</tr>
					<tr>
						<th scope="row"><label for="watermark-mode"><?php _e('Mode', $this->text_domain); ?></label></th>
						<td>
							<select id="watermark-mode" name="<?php print $this->settings_name; ?>[image][mode]" class="selectstyle">
								<option value="normal" <?php selected('normal', $this->options->qc_watermark_image_mode); ?>><?php _e('Normal', $this->text_domain); ?></option>
								<option value="random-position" <?php selected('random-position', $this->options->qc_watermark_image_mode); ?>><?php _e('Random Position', $this->text_domain); ?></option>
								<option value="repeat-covered" <?php selected('repeat-covered', $this->options->qc_watermark_image_mode); ?>><?php _e('Repeat Covered', $this->text_domain); ?></option>
							</select>
						</td>
					</tr>
					<tr id="watermark-align-to-container"<?php if ($this->options->qc_watermark_image_mode != 'normal') echo ' style="display: none;"'; ?>>
						<th scope="row"><label><?php _e('Align To', $this->text_domain); ?></label></th>
						<td>
							<table id="watermark-align-to">
								<tr>
									<td><label><input type="radio" value="lt" id="lt" name="<?php print $this->settings_name; ?>[image][align-to]" <?php checked('lt', $this->options->qc_watermark_image_align_to); ?> /></label></td>
									<td><label><input type="radio" value="ct" id="ct" name="<?php print $this->settings_name; ?>[image][align-to]" <?php checked('ct', $this->options->qc_watermark_image_align_to); ?> /></label></td>
									<td><label><input type="radio" value="rt" id="rt" name="<?php print $this->settings_name; ?>[image][align-to]" <?php checked('rt', $this->options->qc_watermark_image_align_to); ?> /></label></td>
								</tr>
								<tr>
									<td><label><input type="radio" value="lc" id="lc" name="<?php print $this->settings_name; ?>[image][align-to]" <?php checked('lc', $this->options->qc_watermark_image_align_to); ?> /></label></td>
									<td><label><input type="radio" value="cc" id="cc" name="<?php print $this->settings_name; ?>[image][align-to]" <?php checked('cc', $this->options->qc_watermark_image_align_to); ?> /></label></td>
									<td><label><input type="radio" value="rc" id="rc" name="<?php print $this->settings_name; ?>[image][align-to]" <?php checked('rc', $this->options->qc_watermark_image_align_to); ?> /></label></td>
								</tr>
								<tr>
									<td><label><input type="radio" value="lb" id="lb" name="<?php print $this->settings_name; ?>[image][align-to]" <?php checked('lb', $this->options->qc_watermark_image_align_to); ?> /></label></td>
									<td><label><input type="radio" value="cb" id="cb" name="<?php print $this->settings_name; ?>[image][align-to]" <?php checked('cb', $this->options->qc_watermark_image_align_to); ?> /></label></td>
									<td><label><input type="radio" value="rb" id="rb" name="<?php print $this->settings_name; ?>[image][align-to]" <?php checked('rb', $this->options->qc_watermark_image_align_to); ?> /></label></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php _e('Position', $this->text_domain); ?></label></th>
						<td>
							<div id="watermark-position">
								<?php
 if ($this->options->qc_watermark_image) { $attachment = wp_get_attachment_image_src($this->options->qc_watermark_image, 'full'); $attachment_src = $attachment[0]; $width = $attachment[1]; $height = $attachment[2]; } else { $attachment_src = QQWORLD_COLLECTOR_URL . 'images/watermark/watermark.png'; $width = 205; $height = 61; } print '<img id="watermark-test" src="' . $attachment_src . '" width="' . $width . '" height="' . $height . '" />'; ?>
								<img id="photo-test" src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/watermark/photo.jpg" width="800" height="450" />
							</div>
							<?php add_thickbox(); ?>
							<p class="description"><?php _e("You can try to drag the watermark image.", $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"></th>
						<td>
							<p><button type="button" data-href="#TB_inline?height=472&width=800&inlineId=preview-watermark" class="button qc-icon search" id="button-preview-watermark" title="<?php _e('Preview Watermark Effect', $this->text_domain); ?>"><?php _e('Preview Watermark Effect', $this->text_domain); ?></button></p>
							<div id="preview-watermark" class="hidden"><img style="margin-top: 13px;" src="<?php echo admin_url('admin-ajax.php?action=qqworld-collector-watermark-preview&mode=image'); ?>" width="800" height="450" /></div>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php _e('Offset', $this->text_domain); ?></label></th>
						<td>
							<label for="offset-x">
								X: <input name="<?php print $this->settings_name; ?>[image][offset][x]" type="text" id="offset-x" value="<?php echo $this->options->qc_watermark_image_offset_x; ?>" class="small-text" readonly />
							</label>
							<label for="offset-y">
								Y: <input name="<?php print $this->settings_name; ?>[image][offset][y]" type="text" id="offset-y" value="<?php echo $this->options->qc_watermark_image_offset_y; ?>" class="small-text" readonly />
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="watermark-opacity"><?php _e('Opacity', $this->text_domain); ?></label></th>
						<td>
							<label for="qqworld-auto-save-images-watermark-opacity">
								<input name="<?php print $this->settings_name; ?>[image][opacity]" type="number" id="watermark-opacity" value="<?php echo $this->options->qc_watermark_image_opacity; ?>" class="small-text" /> (0-100)
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row"><label id="for-watermark-image" for="watermark-image"><?php _e('Upload Watermark Image', $this->text_domain); ?></label></th>
						<td>
							<label for="watermark-image">
								<a href="#" id="upload-watermark-image" title="<?php _e('Insert a Watermark Image', $this->text_domain); ?>">
									<?php
 if ($this->options->qc_watermark_image) { $attachment = wp_get_attachment_image_src($this->options->qc_watermark_image, 'full'); $attachment_src = $attachment[0]; $width = $attachment[1]; $height = $attachment[2]; } else { $attachment_src = QQWORLD_COLLECTOR_URL . 'images/watermark/watermark.png'; $width = 205; $height = 61; } print '<img src="' . $attachment_src . '" width="' . $width . '" height="' . $height . '" />'; ?>
								</a>
								<input name="<?php print $this->settings_name; ?>[image][watermark-image]" id="watermark-image" type="hidden" title="" value="<?php print $this->options->qc_watermark_image; ?>" />
							</label>
							<input type="button" class="button<?php if (!$this->options->qc_watermark_image) echo ' hidden'; ?>" id="default-watermark" value="<?php _e('Default Watermark', $this->text_domain); ?>">
							<p class="description"><em class="qc-icon info"><?php _e('Note: If Cloud Storage is enabled and delete local attachment after synchronization is set, please close the cloud storage and upload the watermark image, and remember not to delete the local watermark image.', $this->text_domain); ?></em></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="watermark-width-limit"><?php _e('Width Limit', $this->text_domain); ?></label></th>
						<td>
							<label for="qqworld-auto-save-images-watermark-opacity">
								<?php printf(__('%s percent of photo width. (1-100)', $this->text_domain), '<input name="' . $this->settings_name . '[image][width-limit]" type="number" id="watermark-width-limit" value="'.$this->options->qc_watermark_image_width_limit .'" class="small-text" />'); ?>
							</label>
							<p class="description"><?php _e("The Max-Width of watermark image.", $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Image Watermark - end -->
		<!-- Text Watermark - start -->
		<div class="nav-section hidden">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="enabled_text_watermark"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td><?php
 $this->the_switcher(array( 'id' => 'enabled_text_watermark', 'name' => $this->settings_name . '[text][enabled]', 'value' => $this->options->qc_watermark_text_enabled )); ?><p><span class="qc-icon info"><?php _e('Note: You need to upload your favorite fonts to use, there are many on <a href="https://www.google.com/search?newwindow=1&source=hp&ei=nYcVXoqAN8_H-gTqk6fgDA&q=free+font&oq=free+font&gs_l=psy-ab.3..0l10.695.2138..2656...0.0..0.454.2935.2-9j0j1......0....1..gws-wiz.....0..0i12.X8MrtPJ9E8o&ved=0ahUKEwjKwuSkwPPmAhXPo54KHerJCcwQ4dUDCAY&uact=5" target="_blank">Google</a>.', $this->text_domain); ?></span><br /><span class="qc-icon info"><?php printf(__('Note: After enabled, you can perform batch operations on the <a href="%s" target="_blank">media library list page</a>.', $this->text_domain), admin_url('upload.php?mode=list')); ?></p></td>
					</tr>
					<?php if (!empty($this->options->qc_watermark_text_font)) : ?>
					<tr>
						<th scope="row"><label for=""><?php _e('Preview'); ?></label></th>
						<td>
							<?php list($r, $g, $b) = $this->hex2rgb($this->options->qc_watermark_text_bgcolor); ?>
							<div id="text-position">
								<div id="text-content"><?php echo $this->options->qc_watermark_text_content; ?></div>
								<img id="text-photo" src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/watermark/text-photo.jpg" width="640" height="379" />
							</div>
							<style>
							#text-content {
								width: <?php echo $this->options->qc_watermark_text_bg_width; ?>px;
								background: <?php echo $this->options->qc_watermark_text_bgcolor; ?>;
								background: rgba(<?php echo $r; ?>, <?php echo $g; ?>, <?php echo $b; ?>, <?php echo $this->options->qc_watermark_text_bg_opacity/100; ?>);
								color: <?php echo $this->options->qc_watermark_text_font_color; ?>;
							}
							</style>
						</td>
					</tr>
					<?php endif; ?>
					<tr>
						<th scope="row"><label for="text_watermark_text"><?php _e('Content', $this->text_domain); ?></label></th>
						<td>
							<input name="<?php print $this->settings_name; ?>[text][content]" type="text" class="regular-text" id="text_watermark_text" value="<?php echo $this->options->qc_watermark_text_content; ?>" />
							<p class="description"><?php _e('Leave empty will not apply text watermark.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="text_watermark_font_color"><?php _e('Font Color', $this->text_domain); ?></label></th>
						<td>
							<input name="<?php print $this->settings_name; ?>[text][font-color]" type="text" class="regular-text" id="text_watermark_font_color" value="<?php echo $this->options->qc_watermark_text_font_color; ?>" data-default-color="#333333" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="text_watermark_font"><?php _e('Font', $this->text_domain); ?></label></th>
						<td>
							<?php
 $fonts = array(); $dir = WP_CONTENT_DIR . '/font'; if (is_dir($dir)) { $handler = opendir($dir); while (($file = readdir($handler)) !== false) { if ($file != '.' && $file != '..') $fonts[] = $file; } } if (!empty($fonts)) : ?>
							<select id="text_watermark_font" name="<?php print $this->settings_name; ?>[text][font]" class="selectstyle">
							<?php
 foreach ($fonts as $font) echo '<option value="'.$font.'"'.selected($font, $this->options->qc_watermark_text_font, false).'>'.$font.'</option>'; ?>
							</select>
							<?php else: ?>
								<input type="hidden" name="<?php print $this->settings_name; ?>[text][font]" value="" />
							<?php endif; ?>
							<p class="description"><?php printf(__("Please upload your favorite font into <strong>%s</strong> directory.", $this->text_domain), '/wp-content/font/'); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="text_watermark_bg_width"><?php _e('Background Width', $this->text_domain); ?></label></th>
						<td>
							<label>
								<input name="<?php print $this->settings_name; ?>[text][bg-width]" type="number" id="text_watermark_bg_width" value="<?php echo $this->options->qc_watermark_text_bg_width; ?>" class="small-text" /> <?php _e('(px)', $this->text_domain); ?>
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="text_watermark_bgcolor"><?php _e('Background Color', $this->text_domain); ?></label></th>
						<td>
							<input name="<?php print $this->settings_name; ?>[text][bgcolor]" type="text" class="regular-text" id="text_watermark_bgcolor" value="<?php echo $this->options->qc_watermark_text_bgcolor; ?>" data-default-color="#dadada" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="text_watermark_bg_opacity"><?php _e('Background Opacity', $this->text_domain); ?></label></th>
						<td>
							<label>
								<input name="<?php print $this->settings_name; ?>[text][bg-opacity]" type="number" id="text_watermark_bg_opacity" value="<?php echo $this->options->qc_watermark_text_bg_opacity; ?>" class="small-text" /> (0-100)
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="text_watermark_bg_mosaics"><?php _e('Background Mosaics', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'text_watermark_bg_mosaics', 'name' => $this->settings_name . '[text][bg-mosaics]', 'value' => $this->options->qc_watermark_text_bg_mosaics )); ?>
							<p class="description"><?php _e('Further weakening existing watermark.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Text Watermark - end -->
		<?php submit_button(); ?>
	</form>
</div>