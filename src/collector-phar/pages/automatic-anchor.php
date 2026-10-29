<div class="wrap" id="qqworld-collector-settings">
	<h2 id="header-title"><?php _e('Automatic Anchor', $this->text_domain); ?></h2>
	<?php settings_errors(); ?>
	<p><?php _e('Automatically add tags anchor to the keywords in the post content.', $this->text_domain); ?></p>
	<form action="options.php" method="post" id="anchor-form">
		<?php settings_fields($this->settings_name); ?>
		<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
			<a href="#manual" class="nav-tab qc-icon link"><?php _e('Automatic Anchor', $this->text_domain); ?></a>
			<a href="#automatic-tags" class="nav-tab qc-icon tag"><?php _e('Automatic Tags', $this->text_domain); ?></a>
		</h2>
		<!-- Automatic Anchor - start  -->
		<div class="nav-section hidden">
			<?php
 $max_input_vars = ini_get('max_input_vars'); if ($max_input_vars <= 1000) : ?>
			<p><?php _e('Note: php.ini default <strong>max_input_vars</strong> value is 1000, so can only set 143 tags or less, if you want to set more tags, please increase this value.', $this->text_domain); ?></p>
			<?php endif; ?>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="enable-automatic-anchor"><?php _e('Enable Automatic Anchor', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enable-automatic-anchor', 'name' => $this->settings_name . '[enabled]', 'value' => $this->options->qc_automatic_anchor_enabled )); ?>
							<p class="description"><?php _e('Please add the anchor manually.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-tags-post-types"><?php _e('Post Types', $this->text_domain); ?></label></th>
						<td>
							<?php $post_types = get_post_types(array('public' => 1), 'objects'); ?>
							<ul id="post_types_list">
							<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment', 'revision', 'nav_menu_item') )) : ?>
								<li><label><input name="<?php print $this->settings_name; ?>[post-type][]" type="checkbox" value="<?php echo $name; ?>" <?php checked(1, in_array($name, $this->options->qc_automatic_anchor_post_types)); ?> /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
							<?php endif; endforeach; ?></ul>
							<p class="description"><?php _e('Please select the post types to automatically add anchors.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="enable-automatica-add-tags"><?php _e('Automatica Add Tags', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enable-automatica-add-tags', 'name' => $this->settings_name . '[auto-add-tags]', 'value' => $this->options->qc_automatic_anchor_auto_add_tags )); ?>
							<p class="description"><?php _e('Add an tag to the post while adding an anchor.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="enable-fully-automatic-anchors"><?php _e('Fully Automatic Anchors', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enable-fully-automatic-anchors', 'name' => $this->settings_name . '[full-automatic][enabled]', 'value' => $this->options->qc_full_automatic_anchors_enabled )); ?>
							<p class="description"><?php _e('Get anchors from Post Tags automatically.', $this->text_domain); ?></p>
							<p class="description"><em class="qc-icon info"><?php _e('If you have a lot of tags, it is not recommended to enable this option. If you must enable it, please also enable the following Save to Database option.', $this->text_domain); ?></em></p><br />
							<?php
 $this->the_switcher(array( 'id' => 'fully-automatic-anchors-attached-only', 'name' => $this->settings_name . '[full-automatic][attached-only]', 'value' => $this->options->qc_full_automatic_anchors_attached_only )); ?>
							<p class="description"><?php _e('Match anchors only from tags attached to the current post.', $this->text_domain); ?></p>
							<p class="description"><em class="qc-icon info"><?php _e('If you enable this option, the number of tags will not be too many, you can selectively enable the following Save to Database option.', $this->text_domain); ?></em></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-anchors-limit"><?php _e('Limit', $this->text_domain); ?></label></th>
						<td>
							<input type="number" class="small-text" id="full-automatic-anchors-limit" value="<?php print $this->options->qc_full_automatic_anchors_limit; ?>" name="<?php print $this->settings_name; ?>[full-automatic][limit]" />
							<p class="description"><label><?php _e('The maximum number of anchor allowed to be added.', $this->text_domain); ?></label></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="save-to-database"><?php _e('Save to Database', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'save-to-database', 'name' => $this->settings_name . '[save-to-database]', 'value' => $this->options->qc_automatic_anchor_save_to_database )); ?>
							<p class="description"><?php _e('By default, the anchors is dynamically added. Check this box to write the link code of the anchors to the post content of the database.', $this->text_domain); ?></p>
							<?php if ($this->options->qc_automatic_anchor_save_to_database) : ?>
							<p><button type="button" class="button button-large qc-icon search" id="scan-posts-and-add-anchors"><?php _e('Scan Posts and Add Anchors', $this->text_domain); ?></button></p>
							<?php endif; ?>
						</td>
					</tr>
				</body>
			</table>
			<h3><?php _e('Set Anchor Keywords', $this->text_domain); ?></h3>
			<table id="keywords-table" class="wp-list-table widefat striped posts">
				<thead>
					<tr>
						<th></th>
						<th scope="col" class="manage-column column-title column-primary desc"><?php _e('Keywords'); ?></th>
						<th scope="col" class="manage-column column-taxonomy"><?php _e('Taxonomies', $this->text_domain); ?></th>
						<th scope="col" class="manage-column column-url"><?php _e('URL'); ?></th>
						<th scope="col" class="manage-column column-url"><?php _e('Custom URL'); ?></th>
						<th scope="col" class="manage-column column-new-window"><?php _e('New Window', $this->text_domain); ?></th>
						<th scope="col" class="manage-column column-ignore-case"><?php _e('Ignore Case', $this->text_domain); ?></th>
						<th scope="col" class="manage-column column-bold"><?php _e('Bold', $this->text_domain); ?></th>
						<th scope="col" class="manage-column column-color"><?php _e('Color'); ?></th>
						<th></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th scope="col" class="manage-column column-title column-primary desc"><?php _e('Keywords'); ?></th>
						<th scope="col" class="manage-column column-taxonomy"><?php _e('Taxonomies', $this->text_domain); ?></th>
						<th scope="col" class="manage-column column-url"><?php _e('URL'); ?></th>
						<th scope="col" class="manage-column column-url"><?php _e('Custom URL'); ?></th>
						<th scope="col" class="manage-column column-new-window"><label><input type="checkbox" class="select-all" data-mode="new-window" style="margin: 0;" /></label></th>
						<th scope="col" class="manage-column column-ignore-case"><label><input type="checkbox" class="select-all" data-mode="ignore-case" style="margin: 0;" /></label></th>
						<th scope="col" class="manage-column column-bold"><label><input type="checkbox" class="select-all" data-mode="bold" style="margin: 0;" /></label></th>
						<th scope="col" class="manage-column column-color"><?php _e('Color'); ?></th>
						<th></th>
					</tr>
				</tfoot>
				<tbody id="the-list">
				<?php
 if (!empty($this->options->qc_automatic_anchor_settings)) foreach ($this->options->qc_automatic_anchor_settings as $timestamp => $anchor) : $keyword = $anchor['keyword']; $tax = $anchor['taxonomy']; $term = get_term_by('name', $keyword, $tax); $link = $term ? get_term_link($term->slug, $tax) : ''; $custom_link = isset($anchor['custom-link']) ? $anchor['custom-link'] : ''; $new_window = isset($anchor['new-window']) ? $anchor['new-window'] : ''; $ignore_case = isset($anchor['ignore-case']) ? $anchor['ignore-case'] : ''; $bold = isset($anchor['bold']) ? $anchor['bold'] : ''; $color = isset($anchor['color']) ? $anchor['color'] : ''; ?>
					<tr>
						<td>+</td>
						<td><input type="text" name="qqworld-collector-anchor[settings][<?php print $timestamp; ?>][keyword]" value="<?php print $keyword; ?>" /></td>
						<td><select name="qqworld-collector-anchor[settings][<?php print $timestamp; ?>][taxonomy]" class="selectstyle">
						<?php
 $taxonomies = get_taxonomies(array('public' => 1, 'show_ui' => 1, 'hierarchical' => 0), 'objects'); foreach ($taxonomies as $slug => $taxonomy) : ?>
							<option value="<?php print $slug; ?>" <?php selected($slug, $tax); ?>><?php print $taxonomy->label; ?></option>
						<?php endforeach; ?>
						</select>
						</td>
						<td><?php if ($link) : ?><a href="<?php print_r($link); ?>" target="_blank"><?php print $keyword; ?></a><?php endif; ?></td>
						<td><input type="text" class="regular-text" name="qqworld-collector-anchor[settings][<?php print $timestamp; ?>][custom-link]" value="<?php print $custom_link; ?>" /></td>
						<td><label><input type="checkbox" name="qqworld-collector-anchor[settings][<?php print $timestamp; ?>][new-window]" value="1" <?php checked('1', $new_window); ?> /></label></td>
						<td><label><input type="checkbox" name="qqworld-collector-anchor[settings][<?php print $timestamp; ?>][ignore-case]" value="1" <?php checked('1', $ignore_case); ?> /></label></td>
						<td><label><input type="checkbox" name="qqworld-collector-anchor[settings][<?php print $timestamp; ?>][bold]" value="1" <?php checked('1', $bold); ?> /></label></td>
						<td><input type="text" class="color-field" name="qqworld-collector-anchor[settings][<?php print $timestamp; ?>][color]" value="<?php print $color; ?>" /></td>
						<td><input type="button" class="button delete-keyword" value="<?php _e('Delete'); ?>"></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<p><button type="button" class="button button-large qc-icon add" id="add-a-keyword"><?php _e('Add a Keyword', $this->text_domain); ?></button></p>
			<?php submit_button(); ?>
		</div>
		<!-- Automatic Anchor - end  -->
		<!-- Automatic Tags - start  -->
		<div class="nav-section">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="enable-automatic-tags"><?php _e('Enable Automatic Tags', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enable-automatic-tags', 'name' => $this->settings_name . '[automatic-tags][enabled]', 'value' => $this->options->qc_automatic_tags_enabled )); ?>
							<p class="description"><?php _e('Automatically add existed tags when saving post.', $this->text_domain); ?></p>
							<p class="description"><label><?php printf(__('Save up to %s tags.', $this->text_domain), '<input type="number" class="small-text" id="automatic-tags-limit" value="'.$this->options->qc_automatic_tags_limit.'" name="'.$this->settings_name.'[automatic-tags][limit]" />'); ?></label></p>
						</td>
					</tr>
					<tr id="when-row">
						<th scope="row"><label for="when"><?php _e('When', $this->text_domain); ?></label></th>
						<td><?php
 global $wp_post_statuses; $checkboxes = array(); foreach ($wp_post_statuses as $slug => $status) { if (!in_array($slug, array('auto-draft', 'inherit', 'trash'))) { $checked = in_array($slug, $this->options->qc_automatic_tags_when) ? ' checked' : ''; $checkboxes[] = '<p><label><input type="checkbox" name="'.$this->settings_name.'[automatic-tags][when][]" value="'.$slug.'" '.$checked.' /> '.$status->label . '</label></p>'; } } echo implode('', $checkboxes); ?>
							<p class="description"><?php _e('Select the post statuses you want to add tags.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="content"><?php _e('Content', $this->text_domain); ?></label></th>
						<td>
							<p><label><input type="checkbox" value="post_title" name="<?php print $this->settings_name; ?>[automatic-tags][from-content][]" <?php checked(1, in_array('post_title', $this->options->qc_automatic_tags_from_content)); ?>/> <?php _e('Post Title', $this->text_domain); ?></label></p>
							<p><label><input type="checkbox" value="post_content" name="<?php print $this->settings_name; ?>[automatic-tags][from-content][]" <?php checked(1, in_array('post_content', $this->options->qc_automatic_tags_from_content)); ?>/> <?php _e('Post Content', $this->text_domain); ?></label></p>
							<p><label><input type="checkbox" value="post_excerpt" name="<?php print $this->settings_name; ?>[automatic-tags][from-content][]" <?php checked(1, in_array('post_excerpt', $this->options->qc_automatic_tags_from_content)); ?>/> <?php _e('Post Excerpt', $this->text_domain); ?></label></p>
							<p class="desciption"><?php _e('Please select content to match tags.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="enable-automatic-tags"><?php _e('Scan', $this->text_domain); ?></label></th>
						<td>
							<?php $post_types = get_post_types(array('public' => 1), 'objects'); ?>
							<ul id="post_types_list">
							<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment', 'revision', 'nav_menu_item') )) : ?>
								<li><label><input name="<?php print $this->settings_name; ?>[automatic-tags][post-type][]" type="checkbox" value="<?php echo $name; ?>" /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
							<?php endif; endforeach; ?></ul>
							<input type="submit" class="button button-primary" name="<?php print $this->settings_name; ?>[automatic-tags][scan]" value="<?php _e('Scan', $this->text_domain); ?>" />
							<p class="description"><?php _e('Automatically scan all posts and add tags.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-tags-allowed-keywords"><?php _e('Allowed Keywords', $this->text_domain); ?></label></th>
						<td>
							<textarea type="submit" id="automatic-tags-allowed-keywords" class="regular-text" name="<?php print $this->settings_name; ?>[automatic-tags][allowed-keywords]" rows="5" cols="50"><?php print $this->options->qc_automatic_tags_allowed_keywords; ?></textarea>
							<p class="description"><?php _e('Tags that do not contain the specified keywords will be excluded, one per line.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-tags-excluded-keywords"><?php _e('Excluded Keywords', $this->text_domain); ?></label></th>
						<td>
							<textarea type="submit" id="automatic-tags-excluded-keywords" class="regular-text" name="<?php print $this->settings_name; ?>[automatic-tags][excluded-keywords]" rows="5" cols="50"><?php print $this->options->qc_automatic_tags_excluded_keywords; ?></textarea>
							<p class="description"><?php _e('Tags containing these keywords will be filtered out, one per line.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-tags-length-limit"><?php _e('Length Limit', $this->text_domain); ?></label></th>
						<td>
							<input type="text" id="automatic-tags-length-limit" class="small-text" name="<?php print $this->settings_name; ?>[automatic-tags][length-limit]" value="<?php print $this->options->qc_automatic_tags_length_limit; ?>" />
							<p class="description"><?php _e('Limit the length of the tag. By default, only tag of 2-4 characters are added.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<h3><?php _e('Automatic Word Segmentation System', $this->text_domain); ?></h3>
			<p><?php _e('Use the word segmentation system to automatically filter out keywords as tags.', $this->text_domain); ?></p>
			<table class="form-table">
				<body>
					<tr valign="top">
						<th scope="row"><label for="enable-automatic-tags-auto-enabled"><?php _e('Enable', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enable-automatic-tags-auto-enabled', 'name' => $this->settings_name . '[automatic-tags][auto][enabled]', 'value' => $this->options->qc_automatic_tags_auto_enabled )); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="content"><?php _e('Content', $this->text_domain); ?></label></th>
						<td>
							<p><label><input type="checkbox" value="post_title" name="<?php print $this->settings_name; ?>[automatic-tags][auto][content][]" <?php checked(1, in_array('post_title', $this->options->qc_automatic_tags_auto_content)); ?>/> <?php _e('Post Title', $this->text_domain); ?></label></p>
							<p><label><input type="checkbox" value="post_content" name="<?php print $this->settings_name; ?>[automatic-tags][auto][content][]" <?php checked(1, in_array('post_content', $this->options->qc_automatic_tags_auto_content)); ?>/> <?php _e('Post Content', $this->text_domain); ?></label></p>
							<p><label><input type="checkbox" value="post_excerpt" name="<?php print $this->settings_name; ?>[automatic-tags][auto][content][]" <?php checked(1, in_array('post_excerpt', $this->options->qc_automatic_tags_auto_content)); ?>/> <?php _e('Post Excerpt', $this->text_domain); ?></label></p>
							<p class="desciption"><?php _e('Please select the contents that you want to provide for the automatic word segmentation system.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-tags-auto-api"><?php _e('API', $this->text_domain); ?></label></th>
						<td>
							<select name="<?php print $this->settings_name; ?>[automatic-tags][auto][api]" id="automatic-tags-auto-api" class="selectstyle">
								<optgroup label="<?php _e('Free', $this->text_domain); ?>">
									<option value="baidu" <?php selected('baidu', $this->options->qc_automatic_tags_auto_api); ?>><?php _e('Baidu Natural Language Processing - Article Tags (cloud.baidu.com)', $this->text_domain); ?></option>
									<option value="5118" <?php selected('5118', $this->options->qc_automatic_tags_auto_api); ?>><?php _e('5118 Big Data - Intelligent core word extraction API (5118.com)', $this->text_domain); ?></option>
									<option value="wapi" <?php selected('wapi', $this->options->qc_automatic_tags_auto_api); ?>><?php _e('Dig Data (wapi.cn)', $this->text_domain); ?></option>
									<option value="xf" <?php selected('xf', $this->options->qc_automatic_tags_auto_api); ?>><?php _e('XunFei Open Platform (xfyun.cn)', $this->text_domain); ?></option>
								</optgroup>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="auto-tags baidu<?php if ($this->options->qc_automatic_tags_auto_api != 'baidu') print ' hidden'; ?>">
				<table class="form-table">
					<body>
						<tr valign="top">
							<th scope="row"><label for="auto-baidu-api-key"><?php _e('API Key', $this->text_domain); ?></label></th>
							<td>
								<input type="text" class="regular-text" name="<?php print $this->settings_name; ?>[automatic-tags][auto][baidu][api-key]" id="auto-baidu-api-key" value="<?php print $this->options->qc_automatic_tags_auto_baidu_api_key; ?>" />
								<p class="description"><?php printf(__('Please get <strong>%1$s</strong> from <a href="%2$s" target="_blank">Baidu Smart Cloud</a>.', $this->text_domain), __('API Key', $this->text_domain), 'https://ai.baidu.com/tech/nlp/'); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="auto-baidu-secret-key"><?php _e('Secret Key', $this->text_domain); ?></label></th>
							<td>
								<input type="password" class="regular-text" name="<?php print $this->settings_name; ?>[automatic-tags][auto][baidu][secret-key]" id="auto-baidu-secret-key" value="<?php print $this->options->qc_automatic_tags_auto_baidu_secret_key; ?>" />
								<p class="description"><?php printf(__('Please get <strong>%1$s</strong> from <a href="%2$s" target="_blank">Baidu Smart Cloud</a>.', $this->text_domain), __('Secret Key', $this->text_domain), 'https://ai.baidu.com/tech/nlp/'); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="auto-tags 5118<?php if ($this->options->qc_automatic_tags_auto_api != '5118') print ' hidden'; ?>">
				<table class="form-table">
					<body>
						<tr valign="top">
							<th scope="row"><label for="auto-5118-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
							<td>
								<input type="password" name="<?php print $this->settings_name; ?>[automatic-tags][auto][5118][apikey]" id="auto-5118-apikey" class="regular-text" value="<?php print $this->options->qc_automatic_tags_auto_5118_apikey; ?>" />
								<p class="description"><?php printf(__('Please get the <strong>%1$s</strong> from <a href="%2$s" target="_blank">5118 Big Data</a>.', $this->text_domain), __('API Key', $this->text_domain), 'https://www.5118.com'); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="auto-tags wapi<?php if ($this->options->qc_automatic_tags_auto_api != 'wapi') print ' hidden'; ?>">
				<table class="form-table">
					<body>
						<tr valign="top">
							<th scope="row"><label for="auto-wapi-api-url"><?php _ex('API URL', 'wapi', $this->text_domain); ?></label></th>
							<td>
								<input type="text" class="regular-text" name="<?php print $this->settings_name; ?>[automatic-tags][auto][wapi][api-url]" id="auto-wapi-api-url" value="<?php print $this->options->qc_automatic_tags_auto_wapi_app_url; ?>" />
								<p class="description"><?php printf(__('Please get <strong>%1$s</strong> from <a href="%2$s" target="_blank">Dig Data</a>.', $this->text_domain), _x('API URL', 'wapi', $this->text_domain), 'https://www.wapi.cn/api_detail/91/213.html'); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="auto-wapi-appid"><?php _ex('APP ID', 'wapi', $this->text_domain); ?></label></th>
							<td>
								<input type="text" name="<?php print $this->settings_name; ?>[automatic-tags][auto][wapi][appid]" id="auto-wapi-appid" value="<?php print $this->options->qc_automatic_tags_auto_wapi_appid; ?>" />
								<p class="description"><?php printf(__('Please get <strong>%1$s</strong> from <a href="%2$s" target="_blank">Dig Data</a>.', $this->text_domain), _x('APP ID', 'wapi', $this->text_domain), 'https://www.wapi.cn/member/my_apply.html'); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="auto-wapi-secret"><?php _ex('Secret Key', 'wapi', $this->text_domain); ?></label></th>
							<td>
								<input type="password" class="regular-text" name="<?php print $this->settings_name; ?>[automatic-tags][auto][wapi][secret]" id="auto-wapi-secret" value="<?php print $this->options->qc_automatic_tags_auto_wapi_secret; ?>" />
								<p class="description"><?php printf(__('Please get <strong>%1$s</strong> from <a href="%2$s" target="_blank">Dig Data</a>.', $this->text_domain), _x('Secret Key', 'wapi', $this->text_domain), 'https://www.wapi.cn/member/my_apply.html'); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="auto-tags xf<?php if ($this->options->qc_automatic_tags_auto_api != 'xf') print ' hidden'; ?>">
				<table class="form-table">
					<body>
						<tr valign="top">
							<th scope="row"><label for="auto-xf-appid"><?php _ex('APPID', 'xf', $this->text_domain); ?></label></th>
							<td>
								<input type="text" class="regular-text" name="<?php print $this->settings_name; ?>[automatic-tags][auto][xf][appid]" id="auto-xf-appid" value="<?php print $this->options->qc_automatic_tags_auto_xf_appid; ?>" />
								<p class="description"><?php printf(__('Please get <strong>%1$s</strong> from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), _x('APPID', 'xf', $this->text_domain), 'https://console.xfyun.cn/services/ke', __('XunFei Open Platform (xfyun.cn)', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="auto-xf-apikey"><?php _ex('APIKey', 'xf', $this->text_domain); ?></label></th>
							<td>
								<input type="password" class="regular-text" name="<?php print $this->settings_name; ?>[automatic-tags][auto][xf][apikey]" id="auto-xf-apikey" value="<?php print $this->options->qc_automatic_tags_auto_xf_apikey; ?>" />
								<p class="description"><?php printf(__('Please get <strong>%1$s</strong> from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), _x('APIKey', 'xf', $this->text_domain), 'https://console.xfyun.cn/services/ke', __('XunFei Open Platform (xfyun.cn)', $this->text_domain)); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<h3><?php _e('Import Tags', $this->text_domain); ?></h3>
			<table class="form-table">
				<body>
					<tr valign="top">
						<th scope="row"><label for=""><?php _e('Taxonomies', $this->text_domain); ?></label></th>
						<td>
							<?php
 $args = array( 'public' => true, 'show_ui' => true, 'show_in_nav_menus' => true, 'hierarchical' => false ); $taxonomies = get_taxonomies($args, 'OBJECT'); if (!empty($taxonomies)) foreach ($taxonomies as $taxonomy) { ?><p><label><input type="radio" name="<?php print $this->settings_name; ?>[import-tag-tax]" value="<?php print $taxonomy->name; ?>" /> <?php print $taxonomy->label; ?></label></p><?php
 } ?>
							<p class="description"><?php _e('Please select the tag taxonomy which you want to imported.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="import-tags"><?php _e('Tags'); ?></label></th>
						<td>
							<textarea name="<?php print $this->settings_name; ?>[import-tags]" id="import-tags" class="large-text" rows="10" placeholder="<?php _e('One per line.', $this->text_domain); ?>"></textarea>
							<p class="description"><?php _e('One per line.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</div>
		<!-- Automatic Tags - end  -->
	</form>
</div>