<div class="wrap" id="qqworld-collector-settings">
	<?php
 $permalink_structure = get_option('permalink_structure'); if (!$permalink_structure) : ?><div id="qqworld-collector-notice" class="notice is-dismissible notice-error">
		<p class="help"><?php printf(__('This function must enable pseudo-static. Please do not choose <strong>plain</strong> in the <a href="%s" target="_blank">Premalink Settings</a>.', $this->text_domain), admin_url('options-permalink.php')); ?></p>
	</div><??><?php endif; ?>
	<form id="static-cache-form" action="options.php" method="post">
		<?php settings_fields($this->settings_name); ?>
		<div class="tab-content">
			<h2><?php _e('Static Cache', $this->text_domain); ?></h2>
			<p><?php _e("If you don't need interactive features, just show the site as fast as it can, and you'll like this static caching system like a domestic system like Empire CMS.", $this->text_domain); ?></p>
			<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
				<a href="#general" class="nav-tab qc-icon regular"><?php _e('General', $this->text_domain); ?></a>
				<a href="#refresh" class="nav-tab qc-icon refresh"><?php _e('Refresh Cache', $this->text_domain); ?></a>
				<a href="#delete" class="nav-tab qc-icon delete"><?php _e('Wipe Cache', $this->text_domain); ?></a>
			</h2>
			<!-- General - start -->
			<div class="nav-section">
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="enabled-static-cache"><?php _e('Enabled', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'enabled-static-cache', 'name' => $this->settings_name . '[enabled]', 'value' => $this->options->qc_static_cache_enabled )); ?>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="static-cache-mode"><?php _e('Mode', $this->text_domain); ?></label></th>
							<td>
								<select name="<?php print $this->settings_name; ?>[mode]" id="static-cache-mode" class="selectstyle">
									<option value="half" <?php selected('half', $this->options->qc_static_cache_mode); ?>><?php _e('Half Static Cache', $this->text_domain); ?></option>
									<option value="pure" <?php selected('pure', $this->options->qc_static_cache_mode); ?>><?php _e('Pure Static Cache', $this->text_domain); ?></option>
								</select>
								<p class="description"><?php _e('<strong>Half Static Cache</strong>: This mode supports website interaction and loads the static cache only for users who are not logged in.', $this->text_domain); ?><br /><?php printf(__("<strong>Pure Static Cache</strong>: This mode is the fastest, but does not support website interaction, no search, no comment. <span class=\"qc-icon info\">To match this feature, <strong>index.html</strong> in your site's default document settings must have a higher priority than <strong>index.php</strong>, please refer to the <a href=\"%s\" target=\"_blank\" class=\"qc-icon test help-documents\">Help Documentation</a> for details.</span>", $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#static-cache')); ?><br /><span class="qc-icon info"><?php _e('Note: Local LAN Edtion is not supported.', $this->text_domain); ?></span><br /><span class="qc-icon info"><?php _e('Note: Do not prohibit <em>?p=id</em> dynamic link access, otherwise it will cause all 404 of the generated cached pages.', $this->text_domain); ?></span></p>
							</td>
						</tr>
						<tr valign="top" class="mode-half<?php if ($this->options->qc_static_cache_mode != 'half') print ' hidden'; ?>">
							<th scope="row"><label for="static-cache-expiration"><?php _e('Expiration Time', $this->text_domain); ?></label></th>
							<td>
								<input type="number" class="small-text" id="static-cache-expiration" name="<?php print $this->settings_name; ?>[expiration]" value="<?php print $this->options->qc_static_cache_expiration; ?>" /> <?php _e('Hours', $this->text_domain); ?>
								<p class="description"><?php _e('It is only used for Half Static Cache. If the cache expires, the cache will be refreshed automatically.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="static-cache-interval"><?php _e('Interval', $this->text_domain); ?></label></th>
							<td>
								<select name="<?php print $this->settings_name; ?>[interval]" id="static-cache-interval" class="selectstyle">
								<?php
 foreach (wp_get_schedules() as $recurrence => $detail) { $selected = $this->options->qc_static_cache_interval == $recurrence ? ' selected' : ''; echo '<option value="'.$recurrence.'"'.$selected.'>'.$detail['display'].'</option>'; } ?>
								</select>
								<p class="description"><?php _e('The system automatically updates the cache every once in a while, select the time interval.', $this->text_domain); ?><br />
								<span class="qc-icon info"><?php
 $timestamp = wp_next_scheduled( $this->refreash_action ); if ($timestamp !== false) { printf(__('Next update cache time: <strong>%s</stront>.', $this->text_domain), get_date_from_gmt(date('Y-m-d H:i:s', $timestamp))); } else { _e('No cron yet.', $this->text_domain); } ?></span></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="enabled-static-smart"><?php _e('Smart Refresh', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'enabled-static-smart', 'name' => $this->settings_name . '[smart]', 'value' => $this->options->qc_static_cache_smart )); ?>
								<p class="description"><?php _e('The cache is automatically updated when the user accesses it.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="static-cache-stress"><?php _e('Stress', $this->text_domain); ?></label></th>
							<td>
								<select name="<?php print $this->settings_name; ?>[stress]" id="static-cache-stress" class="selectstyle">
									<option value="0"><?php _e('Uninterrupted', $this->text_domain); ?></option>
								<?php
 for ($s=1; $s<11; $s++) { $selected = $this->options->qc_static_cache_stress == $s ? ' selected' : ''; print '<option value="'.$s.'"'.$selected.'>'.sprintf(__('%d Seconds', $this->text_domain), $s).'</option>'; } ?>
								</select>
								<p class="description"><?php _e('The time interval for refreshing each page, if it is too fast, may be similar to a CC attack, causing tremendous pressure on the server.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="static-cache-minify-html"><?php _e('Minify HTML', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'static-cache-minify-html', 'name' => $this->settings_name . '[minify-html]', 'value' => $this->options->qc_static_cache_minify_html )); ?>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="static-cache-minify-js-css"><?php _e('Minify JS &amp; CSS', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'static-cache-minify-js-css', 'name' => $this->settings_name . '[minify-js-css]', 'value' => $this->options->qc_static_cache_minify_js_css )); ?>
								<p class="description"><?php _e('Combine all local JS and CSS files into a large file package.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note: If the relative address of the file is referenced in the JS file, or the font file is referenced in the CSS file, do not check it.', $this->text_domain); ?></span></p>
							</td>
						</tr>
					</tbody>
				</table>
				<h3><?php _e('Cache Object', $this->text_domain); ?></h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="static-cache-homepage"><?php _e('Homepage', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'static-cache-homepage', 'name' => $this->settings_name . '[homepage]', 'value' => $this->options->qc_static_cache_homepage )); ?>
								<p class="description"><?php _e('Static home page.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="static-cache-post-type-archive"><?php _e('Post Type Archive', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'static-cache-post-type-archive', 'name' => $this->settings_name . '[post-type-archive]', 'value' => $this->options->qc_static_cache_post_type_archive )); ?>
								<p class="description"><?php _e('Static post type archive page, it is the home page of the post type that is not classified.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="static-cache-post-types"><?php _e('Post Types', $this->text_domain); ?></label></th>
							<td>
								<?php
 $args = array( 'public' => true, 'show_ui' => true, 'show_in_nav_menus' => true ); $post_types = get_post_types($args, 'objects'); ?>
								<ul id="post-types-list-for-static-cache">
								<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment')) ) : ?>
									<li><label><input name="<?php print $this->settings_name; ?>[post-types][]" type="checkbox" value="<?php echo $name; ?>" <?php checked(1, in_array($name, $this->options->qc_static_cache_post_types)); ?> /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
								<?php endif; endforeach; ?>
									<li><label><input name="<?php print $this->settings_name; ?>[post-types][]" type="checkbox" value="attachment" <?php checked(1, in_array('attachment', $this->options->qc_static_cache_post_types)); ?> /> <?php _e('Media'); ?> (<?php $count = wp_count_posts('attachment'); print $count->inherit; ?>)</label></li>
								</ul>
								<p class="description"><?php _e('Please select the post types you want to staticize.', $this->text_domain) ?><br /><span class="qc-icon info"><?php _e('Media refers to display pages, not media files, which are not required by most websites.', $this->text_domain); ?></span></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="static-cache-taxonomies"><?php _e('Taxonomies', $this->text_domain); ?></label></th>
							<td>
								<?php
 $args = array( 'public' => true, 'show_ui' => true, 'show_in_nav_menus' => true ); $taxonomies = get_taxonomies($args, 'OBJECT'); if (!empty($taxonomies)) foreach ($taxonomies as $taxonomy) { ?><p><label><input type="checkbox" name="<?php print $this->settings_name; ?>[taxonomies][]" value="<?php print $taxonomy->name; ?>" <?php checked(1, in_array($taxonomy->name, $this->options->qc_static_cache_taxonomies)); ?> /> <?php print $taxonomy->label; ?></label></p><?php
 } ?>
								<p class="description"><?php _e('Please select the taxonomies you want to staticize.', $this->text_domain); ?></p>
							</td>
						</tr>
						<?php if ($this->options->cloud_storage_enabled && $this->options->cloud_storage_joinmode_enabled) : ?>
						<tr valign="top">
							<th scope="row"><label for="static-cache-homepage"><?php _e('JoinMode of Cloud Storage', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'static-cache-cloud-storage-joinmode', 'name' => $this->settings_name . '[cloud-storage-joinmode]', 'value' => $this->options->qc_static_cache_cloud_storage_joinmode )); ?>
								<p class="description"><?php _e('Static JoinMode of Cloud Storage.', $this->text_domain); ?></p>
							</td>
						</tr>
						<?php endif; ?>
						<tr>
							<th scope="row"><label for="add_exclude_path"><?php _e('Exclude Path/Keyword', $this->text_domain); ?></label></th>
							<td>
								<ul id="exclude_path_list">
								<?php
 if (!empty($this->options->qc_static_cache_exclude_path)) foreach ($this->options->qc_static_cache_exclude_path as $path) : if (!empty($path)) : ?>
								<li>http(s):// <input type="text" name="<?php print $this->settings_name; ?>[exclude-path][]" class="regular-text" value="<?php echo $path; ?>" /><input type="button" class="button delete-exclude-path" value="<?php _e('Delete'); ?>"></li>
									<?php endif; endforeach; ?>
								</ul>
								<p><button type="button" id="add_exclude_path" class="button"><?php _e('Add a Path/Keyword', $this->text_domain);?></button></p>
								<p class="description"><?php _e('No cache will be generated, if that path contains Exclude-Path/Keyword.', $this->text_domain); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
				<?php submit_button(); ?>
			</div>
			<!-- General - end -->
			<!-- Refresh Cache - start -->
			<div class="nav-section hidden">
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="refresh-homepage"><?php _e('Homepage', $this->text_domain); ?></label></th>
							<td>
								<button type="button" id="refresh-homepage" class="button button-primary button-large qc-icon refresh" data-mode="homepage"><?php _e('Refresh Now', $this->text_domain); ?></button>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="refresh-post-type-archive"><?php _e('Post Type Archive', $this->text_domain); ?></label></th>
							<td>
								<button type="button" id="refresh-post-type-archive" class="button button-primary button-large qc-icon refresh" data-mode="post-type-archive"><?php _e('Refresh Now', $this->text_domain); ?></button>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="refresh-post-type"><?php _e('Post Type', $this->text_domain); ?></label></th>
							<td>
								<?php
 $exclude = get_option('qqworld-collector-static-cache-refreshing-post-type-exclude'); $label = $exclude ? __('Continue to Refresh', $this->text_domain) : __('Refresh Now', $this->text_domain); ?>
								<button type="button" id="refresh-post-type" class="button button-primary button-large qc-icon refresh" data-mode="post-type"><?php print $label; ?></button>
								<button type="button" id="restart-refresh-post-type" class="button button-large qc-icon delete restart-refreshing" data-mode="post-type"<?php if (!$exclude) print ' disabled';?>><?php
 if ($exclude) printf(__('Restart (%d)', $this->text_domain), count($exclude)); else _e('Restart', $this->text_domain); ?></button>
								</p>
								<p class="description"><?php _e('Refresh all singular page of the selected post types.<br />You can continue to refresh the snapshot. If you want to restart the refresh, click the <strong>Restart</strong> button.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="refresh-taxonomies"><?php _e('Taxonomies', $this->text_domain); ?></label></th>
							<td>
								<p>
								<?php
 $exclude = get_option('qqworld-collector-static-cache-refreshing-taxonomies-exclude'); $label = $exclude ? __('Continue to Refresh', $this->text_domain) : __('Refresh Now', $this->text_domain); ?>
								<button type="button" id="refresh-taxonomies" class="button button-primary button-large qc-icon refresh" data-mode="taxonomies"><?php print $label; ?></button>
								<button type="button" id="restart-refresh-taxonomies" class="button button-large qc-icon delete restart-refreshing" data-mode="taxonomies"<?php if (!$exclude) print ' disabled';?>><?php
 if ($exclude) printf(__('Restart (%d)', $this->text_domain), count($exclude)); else _e('Restart', $this->text_domain); ?></button>
								</p>
								<p class="description"><?php _e('Refresh the archive page for all checked taxonomies.<br />You can continue to refresh the snapshot. If you want to restart the refresh, click the <strong>Restart</strong> button.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="multi-threaded"><?php _e('Multi-threaded Mode', $this->text_domain); ?></label></th>
							<td>
								<p><label for="multi-threaded"><input type="checkbox" value="1" name="multi-threaded" id="multi-threaded" /> <?php _e('Enabled', $this->text_domain); ?></label></p>
								<p><label for="refresh-speed"><select name="refresh-speed" id="refresh-speed" class="selectstyle">
									<optgroup label="<?php _e('Speed', $this->text_domain); ?>">
									<?php
 for ($i=1; $i<51; $i++) : $selected = $i == $this->options->qc_stress_manual_speed ? ' selected' : ''; ?>
										<option value="<?php print $i; ?>"<?php print $selected; ?>><?php print $i; ?></option>
									<?php endfor; ?>
									</optgroup>
								</select> <?php _e('Speed', $this->text_domain); ?></label></p>
								<p class="description"><?php _e('If your server performance is strong, you can refresh the cache as fast as possible.', $this->text_domain); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- Refresh Cache - end -->
			<!-- Wipe Cache - start -->
			<div class="nav-section hidden">
				<p class="qc-icon info"><?php _e('The deletion operation is more dangerous. It is recommended to back up the website files first.', $this->text_domain); ?></p>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="wipe-homepage"><?php _e('Homepage', $this->text_domain); ?></label></th>
							<td>
								<button type="button" id="wipe-homepage" class="button button-primary button-large qc-icon delete wipe" data-mode="homepage"><?php _e('Wipe Now', $this->text_domain); ?></button>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="wipe-post-type-archive"><?php _e('Post Type Archive', $this->text_domain); ?></label></th>
							<td>
								<button type="button" id="wipe-post-type-archive" class="button button-primary button-large qc-icon delete wipe" data-mode="post-type-archive" disabled><?php _e('Wipe Now', $this->text_domain); ?></button>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="wipe-post-type"><?php _e('Post Type', $this->text_domain); ?></label></th>
							<td>
								<?php
 $exclude = get_option('qqworld-collector-static-cache-wiping-post-type-exclude'); $label = $exclude ? __('Continue to Wipe', $this->text_domain) : __('Wipe Now', $this->text_domain); ?>
								<button type="button" id="wipe-post-type" class="button button-primary button-large qc-icon delete wipe" data-mode="post-type"><?php print $label; ?></button>
								<button type="button" id="restart-wipe-post-type" class="button button-large qc-icon delete restart-wiping" data-mode="post-type"<?php if (!$exclude) print ' disabled';?>><?php
 if ($exclude) printf(__('Restart (%d)', $this->text_domain), count($exclude)); else _e('Restart', $this->text_domain); ?></button>
								<p class="description"><?php _e('Wipe all singular page of the selected post types. If you want to restart the wipe, click the <strong>Restart</strong> button.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="wipe-taxonomies"><?php _e('Taxonomies', $this->text_domain); ?></label></th>
							<td>
								<?php
 $exclude = get_option('qqworld-collector-static-cache-wiping-taxonomies-exclude'); $label = $exclude ? __('Continue to Wipe', $this->text_domain) : __('Wipe Now', $this->text_domain); ?>
								<button type="button" id="wipe-taxonomies" class="button button-primary button-large qc-icon delete wipe" data-mode="taxonomies"><?php print $label; ?></button>
								<button type="button" id="restart-wipe-taxonomies" class="button button-large qc-icon delete restart-wiping" data-mode="taxonomies"<?php if (!$exclude) print ' disabled';?>><?php
 if ($exclude) printf(__('Restart (%d)', $this->text_domain), count($exclude)); else _e('Restart', $this->text_domain); ?></button>
								<p class="description"><?php _e('Wipe the archive page for all checked taxonomies. If you want to restart the wipe, click the <strong>Restart</strong> button.', $this->text_domain); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- Wipe Cache - end -->
		</div>
	</form>
</div>