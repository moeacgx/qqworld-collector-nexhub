<div class="wrap" id="qqworld-collector-settings">
	<h2 id="header-title"><?php _e('Import &amp; Export', $this->text_domain); ?></h2>
	<?php settings_errors(); ?>
	<form action="options.php" method="post" id="import-export-form" enctype="multipart/form-data">
		<?php settings_fields($this->settings_name); ?>
		<?php
 $nav_tabs = array( 'export' => __('Export', $this->text_domain), 'import' => __('Import', $this->text_domain), 'delete' => __('Wipe Settings', $this->text_domain), 'theme' => __('Theme Settings', $this->text_domain) ); $this->the_nav_tabs($nav_tabs); ?>
		<!-- Export - start -->
		<div class="nav-section">
			<p><?php _e('Please select the items to export.', $this->text_domain); ?></p>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="export-collection-project"><?php _e('Collection Projects', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-collection-project', 'name' => $this->settings_name . '[export][collection-project]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-options-auto-save-attachment"><?php _e('Auto Save Attachment', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-options-auto-save-attachment', 'name' => $this->settings_name . '[export][options][qqworld-collector-auto-save-attachment-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-options-watermark"><?php _e('Watermark', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-options-watermark', 'name' => $this->settings_name . '[export][options][qqworld-collector-watermark-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-options-translate"><?php _e('Translate', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-options-translate', 'name' => $this->settings_name . '[export][options][qqworld-collector-translate]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-options-cloud-storage"><?php _e('Cloud Storage', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-options-cloud-storage', 'name' => $this->settings_name . '[export][options][qqworld-collector-cloud-storage-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-options-proxy"><?php _e('Proxy', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-options-proxy', 'name' => $this->settings_name . '[export][options][qqworld-collector-proxy]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-options-database"><?php _e('Database', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-options-database', 'name' => $this->settings_name . '[export][options][qqworld-collector-database]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-options-anchor"><?php _e('Automatic Anchor', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-options-anchor', 'name' => $this->settings_name . '[export][options][qqworld-collector-anchor]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-options-pseudo-original"><?php _e('Pseudo Original', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-options-pseudo-original', 'name' => $this->settings_name . '[export][options][qqworld-collector-pseudo-original]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-options-cleaner"><?php _e('Cleaner', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-options-cleaner', 'name' => $this->settings_name . '[export][options][qqworld-collector-cleaner]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-options-static-cache"><?php _e('Static Cache', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-options-static-cache', 'name' => $this->settings_name . '[export][options][qqworld-collector-static-cache-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-options-settings"><?php _e('Settings', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'export-options-settings', 'name' => $this->settings_name . '[export][options][qqworld-collector-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button( __('Export Now', $this->text_domain), 'primary', 'export' ); ?>
		</div>
		<!-- Export - end -->
		<!-- Import - start -->
		<div class="nav-section hidden">
			<p><?php _e('Please select the items to import.', $this->text_domain); ?></p>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="import-collection-project"><?php _e('Collection Projects', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-collection-project', 'name' => $this->settings_name . '[import][collection-project]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-options-auto-save-attachment"><?php _e('Auto Save Attachment', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-options-auto-save-attachment', 'name' => $this->settings_name . '[import][options][qqworld-collector-auto-save-attachment-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-options-watermark"><?php _e('Watermark', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-options-watermark', 'name' => $this->settings_name . '[import][options][qqworld-collector-watermark-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-options-translate"><?php _e('Translate', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-options-translate', 'name' => $this->settings_name . '[import][options][qqworld-collector-translate]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-options-cloud-storage"><?php _e('Cloud Storage', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-options-cloud-storage', 'name' => $this->settings_name . '[import][options][qqworld-collector-cloud-storage-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-options-proxy"><?php _e('Proxy', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-options-proxy', 'name' => $this->settings_name . '[import][options][qqworld-collector-proxy]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-options-database"><?php _e('Database', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-options-database', 'name' => $this->settings_name . '[import][options][qqworld-collector-database]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-options-anchor"><?php _e('Automatic Anchor', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-options-anchor', 'name' => $this->settings_name . '[import][options][qqworld-collector-anchor]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-options-pseudo-original"><?php _e('Pseudo Original', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-options-pseudo-original', 'name' => $this->settings_name . '[import][options][qqworld-collector-pseudo-original]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-options-cleaner"><?php _e('Cleaner', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-options-cleaner', 'name' => $this->settings_name . '[import][options][qqworld-collector-cleaner]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-options-static-cache"><?php _e('Static Cache', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-options-static-cache', 'name' => $this->settings_name . '[import][options][qqworld-collector-static-cache-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-options-settings"><?php _e('Settings', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'import-options-settings', 'name' => $this->settings_name . '[import][options][qqworld-collector-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-package"><?php _ex('Package', 'import', $this->text_domain); ?></label></th>
						<td>
							<input type="file" name="package" id="import-package" value="" />
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button( __('Import Now', $this->text_domain), 'primary', 'import' ); ?>
		</div>
		<!-- Import - end -->
		<!-- Wipe Settings - start -->
		<div class="nav-section hidden">
			<p><?php _e('Please select an item to wipe the settings.', $this->text_domain); ?></p>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="wipe-options-auto-save-attachment"><?php _e('Auto Save Attachment', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'wipe-options-auto-save-attachment', 'name' => $this->settings_name . '[wipe][options][qqworld-collector-auto-save-attachment-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wipe-options-watermark"><?php _e('Watermark', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'wipe-options-watermark', 'name' => $this->settings_name . '[wipe][options][qqworld-collector-watermark-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wipe-options-translate"><?php _e('Translate', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'wipe-options-translate', 'name' => $this->settings_name . '[wipe][options][qqworld-collector-translate]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wipe-options-cloud-storage"><?php _e('Cloud Storage', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'wipe-options-cloud-storage', 'name' => $this->settings_name . '[wipe][options][qqworld-collector-cloud-storage-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wipe-options-proxy"><?php _e('Proxy', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'wipe-options-proxy', 'name' => $this->settings_name . '[wipe][options][qqworld-collector-proxy]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wipe-options-database"><?php _e('Database', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'wipe-options-database', 'name' => $this->settings_name . '[wipe][options][qqworld-collector-database]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wipe-options-anchor"><?php _e('Automatic Anchor', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'wipe-options-anchor', 'name' => $this->settings_name . '[wipe][options][qqworld-collector-anchor]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wipe-options-pseudo-original"><?php _e('Pseudo Original', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'wipe-options-pseudo-original', 'name' => $this->settings_name . '[wipe][options][qqworld-collector-pseudo-original]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wipe-options-cleaner"><?php _e('Cleaner', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'wipe-options-cleaner', 'name' => $this->settings_name . '[wipe][options][qqworld-collector-cleaner]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wipe-options-static-cache"><?php _e('Static Cache', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'wipe-options-static-cache', 'name' => $this->settings_name . '[wipe][options][qqworld-collector-static-cache-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wipe-options-settings"><?php _e('Settings', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'wipe-options-settings', 'name' => $this->settings_name . '[wipe][options][qqworld-collector-settings]', 'value' => 0 )); ?>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button( __('Wipe Now', $this->text_domain), 'primary', 'wipe' ); ?>
		</div>
		<!-- Wipe Settings - end -->
		<!-- Theme Settings - start -->
		<div class="nav-section hidden">
			<p><?php _e('It is used for the advanced post function of the local network to import the online theme settings to the local collection site.', $this->text_domain); ?></p>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="export-posttypes"><?php _e('Post Types', $this->text_domain); ?></label></th>
						<td><?php
 $args = array( 'public' => 1 ); $post_types = get_post_types($args, 'object'); if (!empty($post_types)) { print '<dl>'; foreach ($post_types as $post_type) { $taxonomies = get_object_taxonomies($post_type->name, 'object'); if (!empty($taxonomies)) { $tax = array(); foreach ($taxonomies as $taxonomy) { if (!$taxonomy->public || !$taxonomy->show_in_menu) continue; $tax[] = $taxonomy->label; } $taxonomies = implode(__(', ', $this->text_domain), $tax); } else { $taxonomies = ''; } print '<dt><strong>' . $post_type->label . '</strong></dt><dd>'.$taxonomies.'</dd>'; } print '</dl>'; } ?></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-taxonomies"><?php _e('Post Formats', $this->text_domain); ?></label></th>
						<td><?php
 $support_post_formats = get_theme_support( 'post-formats' ); if (!empty($support_post_formats)) { $temp_formats = array(); foreach ($support_post_formats as $support_post_format) { $temp_formats = array_merge($temp_formats, $support_post_format); } $support_post_formats = $temp_formats; $post_format = get_taxonomy('post_format'); if ($post_format && !empty($post_format->object_type)) { $args = array( 'taxonomy' => 'post_format', 'hierarchical' => 0, 'hide_empty' => 0, ); $post_formats = get_terms($args); if (!empty($post_formats)) { $formats = array(); foreach ($post_formats as $post_format) { if (in_array($post_format->slug, $support_post_formats)) $formats[] = $post_format->name; } print implode(__(', ', $this->text_domain), $formats); } else { _e('None'); } } else { _e('None'); } } else { _e('None'); } ?></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="export-taxonomies"><?php _e('Taxonomies', $this->text_domain); ?></label></th>
						<td><?php
 $args = array( 'public' => 1, 'show_in_menu' => 1 ); $taxonomies = get_taxonomies($args, 'object'); if (!empty($taxonomies)) { print '<dl>'; foreach ($taxonomies as $taxonomy) { print '<dt><strong>' . $taxonomy->label . '</strong></dt>'; } print '</dl>'; } ?></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="thumbnail-crop-sizes"><?php _e('Thumbnail Crop Sizes', $this->text_domain); ?></label></th>
						<td><?php
 global $_wp_additional_image_sizes; print '<dl>'; foreach ( $_wp_additional_image_sizes as $name => $_size ) { $sizeStr = sprintf(__(' (%s)', $this->text_domain), $_size['width'] . ' x ' . $_size['height']); print '<dt><strong>' . $name . '</strong>'.$sizeStr.'</dt>'; } print '</dl>'; ?></td>
					</tr>
					<tr valign="top">
						<th scope="row"></th>
						<td>
							<input type="hidden" name="<?php print $this->settings_name; ?>[theme-settings]" value="<?php print $this->options->qc_import_export_theme_settings; ?>" />
							<input type="file" name="theme-package" id="import-theme-settings-package" value="" class="hidden" />
							<p class="submit">
								<button class="button button-primary button-large qc-icon export" name="export-theme-settings" id="export-theme-settings"><?php _e('Export Now', $this->text_domain); ?></button>
								<button class="button button-primary button-large qc-icon import" name="import-theme-settings" id="import-theme-settings"><?php _e('Import Now', $this->text_domain); ?></button>
								<?php if ($this->options->qc_import_export_theme_settings) : ?><button class="button button-large qc-icon delete" name="wipe-theme-settings" id="wipe-theme-settings"><?php _e('Wipe Theme Settings', $this->text_domain); ?></button><?php endif; ?>
							</p>
						</td>
					</tr>
				</tbody>
			</table>
			
		</div>
		<!-- Theme Settings - end -->
	</form>
</div>