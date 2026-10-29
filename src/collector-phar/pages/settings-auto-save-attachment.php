<!-- Image - start -->
<div class="nav-section">
	<h2><?php _e('No Thumbnail Sizes', $this->text_domain); ?></h2>
	<p><?php _e('Many users think that Wordpress generates too many thumbnail sizes and takes up too much space on the server hard disk.', $this->text_domain); ?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enabled-no-thumbnail-sizes"><?php _e('Enabled', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'enabled-no-thumbnail-sizes', 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[no-thumbnail-sizes][enabled]', 'value' => $this->options->qc_no_thumbnail_sizes_enabled )); ?>
					<p class="description"><?php _e('After enabling, the following settings will take effect.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('You can set the global thumbnail size, or you can set the thumbnail size individually for featured images.', $this->text_domain); ?></span><br /><span class="qc-icon info"><?php printf(__('Note: After enabled, you can perform batch operations on the <a href="%s" target="_blank">media library list page</a>.', $this->text_domain), admin_url('upload.php?mode=list')); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for=""><?php _e('Thumbnail Sizes', $this->text_domain); ?></label></th>
				<td>
					<?php
 global $_wp_additional_image_sizes; $sizes = apply_filters( 'image_size_names_choose', array( 'thumbnail' => __('Thumbnail'), 'medium' => __('Medium'), 'medium_large' => __('Medium Large', $this->text_domain), '1536x1536' => __('2x Medium Large', $this->text_domain), 'large' => __('Large'), '2048x2048' => __('2x large', $this->text_domain), 'full' => __('Full Size'), 'post-thumbnail' => __('Featured Image', $this->text_domain), 'woocommerce_thumbnail' => __('WooCommerce Thumbnail', $this->text_domain), 'woocommerce_single' => __('WooCommerce Single', $this->text_domain), 'woocommerce_gallery_thumbnail' => __('WooCommerce Gallery Thumbnail', $this->text_domain), 'shop_catalog' => __('WooCommerce Shop Catalog (for old verion theme)', $this->text_domain), 'shop_single' => __('WooCommerce Shop Single (for old verion theme)', $this->text_domain), 'shop_thumbnail' => __('WooCommerce Shop Thumbnail (for old verion theme)', $this->text_domain), ) ); foreach ( get_intermediate_image_sizes() as $_size ) : if (isset($_wp_additional_image_sizes[$_size])) { $width = $_wp_additional_image_sizes[$_size]['width']; $height = $_wp_additional_image_sizes[$_size]['height']; } else { $width = get_option($_size.'_size_w'); $height = get_option($_size.'_size_h'); } $sizeStr = sprintf(__(' (%s)', $this->text_domain), $width . ' x ' . $height); ?>
						<p><label><input name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[no-thumbnail-sizes][size][]" type="checkbox" value="<?php print $_size; ?>" <?php if (is_array($this->options->qc_no_thumbnail_sizes_size) && in_array($_size, $this->options->qc_no_thumbnail_sizes_size)) print ' checked="checked"'; ?> /> <strong><?php print isset($sizes[$_size]) ? $sizes[$_size] : $_size; ?></strong><?php print $sizeStr; ?></label></p>
					<?php endforeach; ?>
					<p class="description"><?php _e('Please select the size of the thumbnail you want to disable, unless you have special needs, please keep at least the minimum thumbnail size of wordpres.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note that the checked size is disabled.', $this->text_domain); ?></span><br /><span class="qc-icon info"><?php _e('Remember: If you do not want to disable the minimum thumbnail size, then do not disable all sizes below the same as the minimum thumbnail size.', $this->text_domain); ?></span></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for=""><?php _e('Featured Image Sizes', $this->text_domain); ?></label></th>
				<td>
					<?php
 foreach ( get_intermediate_image_sizes() as $_size ) : if (isset($_wp_additional_image_sizes[$_size])) { $width = $_wp_additional_image_sizes[$_size]['width']; $height = $_wp_additional_image_sizes[$_size]['height']; } else { $width = get_option($_size.'_size_w'); $height = get_option($_size.'_size_h'); } $sizeStr = sprintf(__(' (%s)', $this->text_domain), $width . ' x ' . $height); ?>
						<p><label><input name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[no-thumbnail-sizes][featured-image-size][]" type="checkbox" value="<?php print $_size; ?>" <?php if (is_array($this->options->qc_no_thumbnail_sizes_size) && in_array($_size, $this->options->qc_no_thumbnail_sizes_featured_image_size)) print ' checked="checked"'; ?> /> <strong><?php print isset($sizes[$_size]) ? $sizes[$_size] : $_size; ?></strong><?php print $sizeStr; ?></label></p>
					<?php endforeach; ?>
					<p class="description"><?php _e('Please select the size of the thumbnail you want to disable, unless you have special needs, please keep at least the minimum thumbnail size of wordpres.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note that the checked size is disabled.', $this->text_domain); ?></span><br /><span class="qc-icon info"><?php _e('Remember: If you do not want to disable the minimum thumbnail size, then do not disable all sizes below the same as the minimum thumbnail size.', $this->text_domain); ?></span></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="scan-all-images"><?php _e('Scan All Images', $this->text_domain); ?></label></th>
				<td>
					<?php
 $exclude = get_option('qqworld-collector-no-thumbnail-sizes-all-images-exclude'); $label = $exclude ? __('Continue to Scan', $this->text_domain) : __('Scan Now', $this->text_domain); ?>
					<button type="button" id="scan-all-images" class="button button-primary button-large qc-icon refresh start-scanning" data-mode="all"><?php print $label; ?></button>
					<button type="button" id="rescan-all-images" class="button button-large qc-icon delete restart-scanning" data-mode="all"<?php if (!$exclude) print ' disabled';?>><?php
 if ($exclude) printf(__('Restart (%d)', $this->text_domain), count($exclude)); else _e('Restart', $this->text_domain); ?></button>
					<p class="description"><?php _e('Scan all images to Regenerate the thumbnail.<br />You can continue to scan the snapshot. If you want to restart the scan, click the <strong>Restart</strong> button.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="scan-featured-images"><?php _e('Scan Featured Images', $this->text_domain); ?></label></th>
				<td>
					<?php
 global $wpdb; $sql = "SELECT `meta_value` FROM `{$wpdb->postmeta}` WHERE `meta_key` = '_thumbnail_id' AND `meta_value` != 0"; $rows = $wpdb->get_results($sql); $featured_images = array(); if ($rows) { foreach ($rows as $row) { $featured_images[] = $row->meta_value; } } $exclude = get_option('qqworld-collector-no-thumbnail-sizes-featured-images-exclude'); if (!empty($featured_images) && !empty($exclude)) { $exclude = array_intersect($featured_images, $exclude); $label = $exclude ? __('Continue to Scan', $this->text_domain) : __('Scan Now', $this->text_domain); } else { $label = __('Scan Now', $this->text_domain); } ?>
					<button type="button" id="scan-featured-images" class="button button-primary button-large qc-icon refresh start-scanning" data-mode="featured"><?php print $label; ?></button>
					<button type="button" id="rescan-featured-images" class="button button-large qc-icon delete restart-scanning" data-mode="featured"<?php if (!$exclude) print ' disabled';?>><?php
 if ($exclude) printf(__('Restart (%d)', $this->text_domain), count($exclude)); else _e('Restart', $this->text_domain); ?></button>
					<p class="description"><?php _e('Only scan all featured images to Regenerate the thumbnail.<br />You can continue to scan the snapshot. If you want to restart the scan, click the <strong>Restart</strong> button.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('Images Compression Options', $this->text_domain); ?></h2>
	<p class="hidden"><?php printf(__('I recommented another compress plugin: <a href="%s" target="_blank">Compress JPEG & PNG images</a>.', $this->text_domain), 'https://wordpress.org/plugins/tiny-compress-images/')?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enabled_compression"><?php _e('Enabled', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'enabled_compression', 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[compression][enabled]', 'value' => $this->options->qc_compression_enabled )); ?>
					<p class="description"><?php _e('Enable compress images when uploading. (Only JPEG &amp; WEBP)', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="compression-quality"><?php _e('Quality', $this->text_domain); ?></label></th>
				<td>
					<select id="compression-quality" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[compression][quality]" class="selectstyle">
					<?php for ($q=100; $q>=0; $q-=5) : ?>
						<option value="<?php echo $q; ?>"<?php selected($q, $this->options->qc_compression_quality); ?>><?php echo $q; ?><?php if ($q==75) _e(' (Recommend)', $this->text_domain); ?></option>
					<?php endfor; ?>
					</select>
					<p><?php _e('Compression level, ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file).', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="compress-all-attachments"></label></th>
				<td>
					<button type="button" class="button qc-icon search" id="compress-all-attachments"><?php _e('Scan', $this->text_domain); ?></button>
					<p><?php _e('Scan all attachments and automatically compression.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('No HTTP Referer', $this->text_domain); ?></h2>
	<p><?php __('Crack some anti-theft chain means, the disadvantage is that you can not use the website statistics program.', $this->text_domain); ?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enabled-frontend-no-http-referer"><?php _e('Frontend', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'enabled-frontend-no-http-referern', 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[no-referer][frontend]', 'value' => $this->options->qc_no_referer_frontend )); ?>
					<p class="description"><?php _e('No http referer at the frontend, and is mainly used to crack the anti-theft chain similar to the Sina image hosting.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note: Turning this option on will cause website statistics to be invalid.', $this->text_domain); ?></span></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="enabled-backend-no-http-referer"><?php _e('Backend', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'enabled-backend-no-http-referern', 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[no-referer][backend]', 'value' => $this->options->qc_no_referer_backend )); ?>
					<p class="description"><?php _e('No http referer at the backend, and is mainly used to crack the anti-theft chain similar to the wechat images.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('Verify Image Format', $this->text_domain); ?></h2>
	<p><?php _e('Some websites have anti-collection measures and may return wrong content. Turn on this option and check whether the returned content is a picture when saving remote attachments.', $this->text_domain); ?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enabled-verify-image-format"><?php _e('Enabled', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'enabled-verify-image-format', 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[verify-image-format]', 'value' => $this->options->qc_verify_image_format )); ?>
					<p class="description"><?php _e('Note that it will increase the burden on the server, please do not enable this option if it is unnecessary.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<?php do_action( 'qqworld-collector-settings-image-fields', $this ); ?>
</div>
<!-- Image - end -->