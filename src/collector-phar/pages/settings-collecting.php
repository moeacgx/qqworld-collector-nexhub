<!-- Collecting - start -->
<div class="nav-section">
	<h2><?php _e('Core of Collector Method', $this->text_domain); ?></h2>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-collection-project-front-end-token"><?php _e('Core', $this->text_domain); ?></label></th>
				<td>
					<select class="selectstyle" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][core]">
						<option value="querylist" <?php selected('querylist', $this->options->qc_collection_project_core); ?>><?php _e('QueryList, simple, elegant, extensible PHP Web Scraper', $this->text_domain); ?></option>
						<option value="simple_html_dom" <?php selected('simple_html_dom', $this->options->qc_collection_project_core); ?>><?php _e('Simple HTML Dom Parser', $this->text_domain); ?></option>
					</select>
					<p class="description">
						<?php _e('Select the core functions of the selector collection method. <strong>Simple HTML Dom Parser</strong> is the most compatible and <strong>Querylist</strong> is more powerful.', $this->text_domain); ?><br />
						<span class="qc-icon info"><?php printf(__('<strong>QueryList</strong> and <strong>%s</strong> are not compatible at present, if you need to use these cloud storage when collecting, please change to <strong>%s</strong> core.', $this->text_domain), __('Huawei OBS &amp; Upyun', $this->text_domain), __('Simple HTML Dom Parser', $this->text_domain)); ?></span>
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('Front End Collector', $this->text_domain); ?></h2>
	<p><?php printf(__('Use the expansion for <a href="%s" target="_blank">Chrome</a>, <a href="%s" target="_blank">Microsoft Edge</a> and <a href="%s" target="_blank">Domestic browser (QQ, 360)</a> to collect it on the front end, See the <a href="%s" target="_blank">video tutorial</a>.', $this->text_domain), 'https://chromewebstore.google.com/detail/codjbhmofjoahkidpojbbblmiaolhapn', 'https://microsoftedge.microsoft.com/addons/detail/caheihnjoinldffpipjfhdllnlankilj', 'http://cloud.qqworld.org/index.php?share/folder&user=1&sid=pXDc3fUE', 'https://www.bilibili.com/video/av65299033/'); ?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-collection-project-front-end-token"><?php _e('Token', $this->text_domain); ?></label></th>
				<td>
					<input type="text" class="regular-text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][token]" id="qqworld-collector-settings-collection-project-front-end-token" value="<?php print $this->options->qc_collection_project_front_end_token; ?>" /> <button type="button" class="button qc-icon format" id="create-token-btn"><?php _e('Generate token', $this->text_domain); ?></button>
					<p class="description"><?php _e('Only when the tokens match, the front-end collector has permission to deliver the collected data to this website.', $this->text_domain); ?></p>
					<?php
 $url = home_url('wp-json/collector/v1/collecting/project/1'); $response = wp_remote_head($url); $response_code = wp_remote_retrieve_response_code($response); if ($response_code != 200) { $response_message = wp_remote_retrieve_response_message($response); ?>
						<p class="description qc-icon error msg-box"><?php printf(__('It seems that your website has disabled the REST API function of the QQWorld collector, which will cause the front-end plugin to be unable to deliver messages to your website. Error code: <strong>%d</strong>, error message: <strong>%s</strong>.', $this->text_domain), $response_code, $response_message); ?></p>
					<?php
 }; ?>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('Manual Download', $this->text_domain); ?></h2>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="manual-download-path"><?php _e('Path', $this->text_domain); ?></label></th>
				<td>
					<input type="text" class="regular-text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[download-to-local-path][domain]" placeholder="<?php print home_url(); ?>" value="<?php print $this->options->qc_download_to_local_path_domain; ?>" /><input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[download-to-local-path][path]" id="manual-download-path" class="regular-text" placeholder="/wp-content/uploads/download/" value="<?php print $this->options->qc_download_to_local_path_path; ?>" /> 2021/05/23/url.txt
					<p class="description"><?php _e('It is used to Download To Local filter and customize the path to save the file. Fill in the domain address in the front, which can be the domain address of cloud storage, and fill in the saved path in the back.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('Collection Project', $this->text_domain); ?></h2>
	<p><?php _e('Here are the settings related to the Collection Project.', $this->text_domain); ?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="collected-list-style"><?php _e('List Style', $this->text_domain); ?></label></th>
				<td>
					<select class="selectstyle" id="collected-list-style" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collected-list-style]">
						<option value="grid" <?php selected('grid', $this->options->qc_collected_list_style); ?>><?php _e('Grid', $this->text_domain); ?></option>
						<option value="list" <?php selected('list', $this->options->qc_collected_list_style); ?>><?php _e('List', $this->text_domain); ?></option>
					</select>
					<p class="description"><?php _e('Please select the default style of the collected post list.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="display-duplicate-posts"><?php _e('Display Duplicate Posts', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'display-duplicate-posts', 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[display-duplicate-posts]', 'value' => $this->options->qc_display_duplicate_posts )); ?>
					<p class="description"><?php _e('Duplicate posts are displayed when manually collecting the post list.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'duplicate-posts-cache', 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[duplicate-posts-cache]', 'value' => $this->options->qc_duplicate_posts_cache )); ?>
					<p class="description"><?php _e('The collected posts are cached to facilitate quick query of duplicate posts.<br />Do not enable this if you have a database cache installed.', $this->text_domain); ?></p><br />
					<button type="button" id="refresh-collected-data-cache" class="button qc-icon refresh"><?php _e('Refresh Collected Data Cache', $this->text_domain); ?></button>
					<p class="description"><?php _e('It is used to collect articles to exclude duplicates. If you feel that there is a problem, you can manually refresh the cache.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="display-collected-posts-number"><?php _e('Display Number of Collected Posts', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'display-collected-posts-number', 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[display-collected-posts-number]', 'value' => $this->options->qc_display_collected_posts_number )); ?>
					<p class="description"><?php _e('Display number of posts collected on the collection projects list page. If you have collected a large number of posts and the server performance is insufficient, access the list of collection project is very slow. Consider disabling it.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-collection-project-random-authors"><?php _e('Random Authors', $this->text_domain); ?></label></th>
				<td>
					<textarea name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][random-authors]" id="qqworld-collector-settings-collection-project-random-authors" rows="10" cols="50"><?php print $this->options->qc_collection_project_random_authors; ?></textarea>
					<p class="description"><?php _e('Please set the random author name, you can enter a string, the system will automatically create a new user, or you can enter an existing user ID, one per line.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h2 class="hidden"><?php _e('Custom Database Tables', $this->text_domain); ?></h2>
	<p class="hidden"><?php _e('Some themes or plug-ins have custom database tables, please register them here for easy access in the custom database table rules of collection projects.', $this->text_domain); ?></p>
	<table class="form-table hidden">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-collection-project-custom-database-tables"><?php _e('Database Tables Structure', $this->text_domain); ?></label></th>
				<td>
					<textarea name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][custom-database-tables]" id="qqworld-collector-settings-collection-project-custom-database-tables" rows="10" cols="50"><?php print $this->options->qc_collection_project_custom_database_tables; ?></textarea>
					<p class="description"><?php _e('Please fill in the structure of the custom database tables, for example:', $this->text_domain); ?></p>
					<pre class="prism"><code class="language-xml">table_name_1
---field_1
---field_2
table_name_2
---field_3
---field_4
---field_5</code></pre>
					<p class="description qc-icon info"><?php _e('Note that you only need to fill in the field names needed for collection.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('Enhancement', $this->text_domain); ?></h2>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="initialization-toutiao"><?php _e('Hack Toutiao', $this->text_domain); ?></label></th>
				<td>
					<button type="button" class="button qc-icon debug" id="initialization-toutiao"><?php _e('Initialization', $this->text_domain); ?></button>
					<p class="description"><?php _e('If you cannot collect the list of toutiao articles, please click again.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('Collection Project Local Cache', $this->text_domain); ?></h2>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="update-collection-project-local-cache"><?php _e('Update Local Cache', $this->text_domain); ?></label></th>
				<td>
					<?php $disabled = apply_filters( 'qqworld-collector-activated-module-smart-collecting', false ) ? '' : ' disabled'; ?>
					<button type="button" class="button qc-icon refresh" id="update-collection-project-local-cache"<?php print $disabled; ?>><?php _e('Update Local Cache', $this->text_domain); ?></button>
					<?php
 if (!$disabled) { global $wpdb; $sql = "SHOW TABLES LIKE '%{$wpdb->prefix}collection_projects_cache%'"; $rows = $wpdb->get_results($sql); $disabled = $rows ? '' : ' disabled'; } ?>
					<button type="button" class="button qc-icon delete" id="wipe-collection-project-local-cache"<?php print $disabled; ?>><?php _e('Wipe Local Cache', $this->text_domain); ?></button>
					<p class="description"><?php _e('Smart collecting is the exclusive feature of the Ultimate non-basic Edition, click this button to update the collection project local cache.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('Collection Project Rule Filters', $this->text_domain); ?></h2>
	<p><?php _e('Global rule filters. The rule items you check will not be saved to your site.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note: Checking some options will result in an error to collecting and cannot save posts.', $this->text_domain); ?></span></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for=""><?php _e('Collecting Items', $this->text_domain); ?></label></th>
				<td>
					<dl>
						<dd><label><input type="checkbox" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][filters][post_link]" value="1"<?php if (isset($this->options->qc_collection_project_filters['post_link'])) print ' checked'; ?> /> <?php _e('Post Link', $this->text_domain); ?></label></dd>
						<dd><label><input type="checkbox" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][filters][post_title]" value="1"<?php if (isset($this->options->qc_collection_project_filters['post_title'])) print ' checked'; ?> /> <?php _e('Post Title', $this->text_domain); ?></label></dd>
						<dd><label><input type="checkbox" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][filters][post_excerpt]" value="1"<?php if (isset($this->options->qc_collection_project_filters['post_excerpt'])) print ' checked'; ?> /> <?php _e('Post Excerpt', $this->text_domain); ?></label></dd>
						<dd><label><input type="checkbox" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][filters][post_content]" value="1"<?php if (isset($this->options->qc_collection_project_filters['post_content'])) print ' checked'; ?> /> <?php _e('Post Content', $this->text_domain); ?></label></dd>
						<dd><hr></dd>
						<dt><?php _e('Taxonomies', $this->text_domain); ?><dt>
						<?php
 $taxonomies = get_taxonomies(array('public' => 1, 'show_in_menu' => 1), 'objects'); foreach ($taxonomies as $name => $taxonomy) : ?>
						<dd><label><input type="checkbox" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][filters][taxonomy][<?php print $name; ?>]" value="1"<?php if (isset($this->options->qc_collection_project_filters['taxonomy']) && isset($this->options->qc_collection_project_filters['taxonomy'][$name])) print ' checked'; ?> /> <?php print $taxonomy->label; ?></label></dd>
						<?php endforeach; ?>
						<dd><hr></dd>
						<dd><label><input type="checkbox" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][filters][featured_image]" value="1"<?php if (isset($this->options->qc_collection_project_filters['featured_image'])) print ' checked'; ?> /> <?php _e('Featured Image', $this->text_domain); ?></label></dd>
						<dd><label><input type="checkbox" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][filters][post_author]" value="1"<?php if (isset($this->options->qc_collection_project_filters['post_author'])) print ' checked'; ?> /> <?php _e('Post Author', $this->text_domain); ?></label></dd>
						<dd><label><input type="checkbox" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][filters][post_date]" value="1"<?php if (isset($this->options->qc_collection_project_filters['post_date'])) print ' checked'; ?> /> <?php _e('Post Date', $this->text_domain); ?></label></dd>
						<dd><label><input type="checkbox" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[collection-project][filters][post_name]" value="1"<?php if (isset($this->options->qc_collection_project_filters['post_name'])) print ' checked'; ?> /> <?php _e('Post Name', $this->text_domain); ?></label></dd>
					</dl>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('Detect Duplicate Titles', $this->text_domain); ?></h2>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enabled-detect-duplicate-titles"><?php _e('Enabled', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'enabled-detect-duplicate-titles', 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[detectd-duplicate-titles]', 'value' => $this->options->qc_detectd_duplicate_titles )); ?>
					<p class="description"><?php _e('After the title is entered on the edit page, it is automatically detected whether the title is repeated and the duplicated posts are listed.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="enabled-detect-duplicate-post-meta"><?php _e('Post Meta', $this->text_domain); ?></label></th>
				<td>
					<input type="text" id="enabled-detect-duplicate-post-meta" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[detectd-duplicate-post-meta]" class="regular-text" value="<?php print $this->options->qc_detectd_duplicate_post_meta; ?>" placeholder="<?php _e('Post Meta', $this->text_domain); ?>" />
					<p class="description"><?php _e('Fill in the post meta key to be detected at the same time, only the title and the post meta value are repeated, it will be judged as a duplicate post.', $this->text_domain); ?></p>
					<p class="description qc-icon info"><?php _e('Note: the newly created custom field must be saved after clicking <strong>Add Custom Field</strong> button to participate in the comparison  ', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
 $duplicated_post_ids = get_transient( 'qqworld-collector-duplicated-post-ids' ); if ($duplicated_post_ids) : ?>
	<p><?php _e('The following is automatically detected repeated posts, please manually judge and publish or delete them.', $this->text_domain); ?></p>
	<?php
 $post_statuses = get_post_statuses(); unset($post_statuses['publish']); $args = array( 'posts_per_page' => -1, 'post_status' => array_keys($post_statuses), 'post__in' => $duplicated_post_ids, 'post_type' => get_post_types() ); $posts = get_posts($args); ?>
	<table class="wp-list-table widefat striped table-view-list posts">
		<thead>
			<tr>
				<th class=" column-id">ID</th>
				<th scope="col" id="title" class="manage-column column-title column-primary"><?php _e('Title'); ?></th>
				<th scope="col" id="title" class="manage-column column-post-type"><?php _e('Post Type', $this->text_domain); ?></th>
				<th scope="col" id="title" class="manage-column column-post-status"><?php _e('Post Status', $this->text_domain); ?></th>
				<th scope="col" id="title" class="manage-column column-post-date"><?php _e('Post Date', $this->text_domain); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($posts as $post) : ?>
			<tr>
				<th scope="row" class="column-id" valign="top"><?php print $post->ID; ?></th>
				<td class="title column-title has-row-actions column-primary" data-colname="<?php _e('Title'); ?>">
					<a href="<?php print admin_url('post.php?post='.$post->ID.'&action=edit'); ?>" target="_blank"><strong><?php print $post->post_title; ?></strong></a>
					<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show Details'); ?></span></button>
				</td>
				<td class="title column-post-type" data-colname="<?php _e('Post Type', $this->text_domain); ?>"><?php $post_type = get_post_type_object($post->post_type); print $post_type->label; ?></td>
				<td class="title column-post-status" data-colname="<?php _e('Post status', $this->text_domain); ?>"><?php $post_status = get_post_status_object($post->post_status); print $post_status->label; ?></td>
				<td class="title column-post-date" data-colname="<?php _e('Post Date', $this->text_domain); ?>"><?php print $post->post_date; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>
</div>
<!-- Collecting - end -->