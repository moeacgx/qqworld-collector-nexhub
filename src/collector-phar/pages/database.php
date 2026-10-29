<div class="wrap" id="qqworld-collector-settings">
	<?php global $wpdb; ?>
	<h2><?php _e('Database', $this->text_domain); ?></h2>
	<p><?php _e("Help you to handle database content easily.", $this->text_domain); ?>
	<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
		<a href="#replace" class="nav-tab qc-icon refresh"><?php _e('Batch Replacement', $this->text_domain); ?></a>
		<a href="#wipe" class="nav-tab qc-icon delete"><?php _e('Wipe Content', $this->text_domain); ?></a>
		<a href="#add" class="nav-tab qc-icon add"><?php _e('Add Content', $this->text_domain); ?></a>
	</h2>
	<!-- Batch Replacement - start -->
	<div class="nav-section">
		<form id="database-form" action="" method="post">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="db-table-fields"><?php _ex('Field', 'database', $this->text_domain); ?></label></th>
						<td>
							<select name="db-table-field" id="db-table-fields" class="selectstyle">
								<optgroup label="<?php _e('Posts'); ?>">
									<option value="<?php echo $wpdb->posts; ?>|post_content" rel="post"><?php _ex('Post Content', 'database', $this->text_domain); ?> (post_content)</option>
									<option value="<?php echo $wpdb->posts; ?>|post_title" rel="post"><?php _ex('Post Title', 'database', $this->text_domain); ?> (post_title)</option>
									<option value="<?php echo $wpdb->posts; ?>|post_excerpt" rel="post"><?php _ex('Post Excerpt', 'database', $this->text_domain); ?> (post_excerpt)</option>
									<option value="<?php echo $wpdb->posts; ?>|guid" rel="post"><?php _ex('Globally Unique Identifier', 'database', $this->text_domain); ?> (guid)</option>
								</optgroup>
								<optgroup label="<?php _e('Post Meta', $this->text_domain); ?>">
									<option value="<?php echo $wpdb->postmeta; ?>|meta_value" rel="post"><?php _ex('Meta Value', 'database', $this->text_domain); ?> (meta_value)</option>
									<option value="<?php echo $wpdb->postmeta; ?>|meta_key" rel="post"><?php _ex('Meta Key', 'database', $this->text_domain); ?> (meta_key)</option>
								</optgroup>
								<optgroup label="<?php _e('Comments'); ?>">
									<option value="<?php echo $wpdb->comments; ?>|comment_content" rel="post"><?php _ex('Comment Content', 'database', $this->text_domain); ?> (comment_content)</option>
								</optgroup>
							</select>
						</td>
					</tr>
					<tr valign="top" <?php $version = $wpdb->get_var('SELECT VERSION()'); if (!preg_match('/^8/', $version )) print ' class="hidden"'; ?>>
						<th scope="row"><label for="db-table-use-regular-expressions"><?php _e('Use Regular Expressions', $this->text_domain); ?></label></th>
						<td><?php
 $this->the_switcher(array( 'id' => 'db-table-use-regular-expressions', 'name' => 'db-table-use-regular-expressions', 'value' => 0 )); ?></td>
					</tr>
					<tr valign="top" class="hidden for-optional for-meta_value">
						<th scope="row"><label for="db-table-field-post-meta-key"><?php _e('Post Meta Key', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="regular-text" name="post-meta-key" id="db-table-field-post-meta-key" value="" />
							<p class="description"><?php _e('Please fill in the meta key of the post meta to be replaced, leave it blank to replace all meta keys.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="db-table-field-source"><?php _ex('Source Text', 'database', $this->text_domain); ?></label></th>
						<td>
							<textarea name="db-table-field-source" placeholder="<?php _ex('Source Text', 'database', $this->text_domain); ?>" rows="5" cols="100" class="large-text code" id="db-table-field-source"></textarea>
							<p class="symbol-block regex hidden">
								<a class="symbol" href="#" title="<?php _e('Wildcard', $this->text_domain); ?>">(*)</a>
								<a class="symbol" href="#" title="<?php _e('Space and Wrap', $this->text_domain); ?>">(n)</a>
								<a class="symbol" href="#" title="<?php _e('Number', $this->text_domain); ?>">(d)</a>
								<a class="symbol" href="#" title="<?php _e('Alphanumerics and Underscores', $this->text_domain); ?>">(w)</a>
								<a class="symbol" href="#" title="<?php _e('All characters except line breaks', $this->text_domain); ?>">(.)</a>
								<a class="symbol" href="#" title="<?php _ex('Chinese', 'lang', $this->text_domain); ?>">(c)</a>
							</p>
							<p class="description"><?php _e('For example: ', $this->text_domain); print site_url('/wp-content/uploads'); ?></p>
							<p class="description"><?php printf(__('Multiple lines of data are separated by <strong>%s</strong>, For example: ', $this->text_domain), '&lt;!--s--&gt;'); ?><br /><?php print site_url('/wp-content/uploads'); ?><br />&lt;!--s--&gt;<br /><?php print site_url('/wp-content/uploads'); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="db-table-field-replacement"><?php _ex('Replace with', 'database', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _ex('Replace with', 'database', $this->text_domain); ?>" data-content=""</span></th>
						<td>
							<textarea name="db-table-field-replacement" placeholder="<?php _ex('Replace with', 'database', $this->text_domain); ?>" rows="5" cols="100" class="large-text code" id="db-table-field-replacement"></textarea>
							<p class="description"><?php _e('For example: ', $this->text_domain); ?>http://www.example.com/uploads</p>
							<p class="description"><?php printf(__('Multiple lines of data are separated by <strong>%s</strong>, For example: ', $this->text_domain), '&lt;!--s--&gt;'); ?><br />http://www.example.com/uploads<br />&lt;!--s--&gt;<br />http://www.example.com/uploads</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="db-table-field-in-batches"><?php _e('In Batches', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'db-table-field-in-batches', 'name' => 'db-table-field-in-batches', 'value' => 0 )); ?>
							<p class="description"><?php _e('If your database is large, it is recommended to check this option.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(__('Replace Now', $this->text_domain), 'primary', 'database-replace-now'); ?>
			<p class="description qc-icon info"><?php _e('Be careful, before you click the Replace-Now button, i recommend backup the website database.', $this->text_domain); ?></p>
		</form>
	</div>
	<!-- Batch Replacement - end -->
	<!-- Wipe Content - start -->
	<div class="nav-section">
		<form id="wipe-content-form" action="options.php" method="post">
			<?php settings_fields($this->settings_name); ?>
			<p><?php _e('Automatically wipe specified tags or attributes in the post content.', $this->text_domain); ?></p>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="db-table-enable-auto-wipe"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td><?php
 $this->the_switcher(array( 'id' => 'db-table-enable-auto-wipe', 'name' => $this->settings_name . '[wipe-content][enabled]', 'value' => $this->options->qc_database_wipe_content_enabled )); ?></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="db-table-wipe-tags"><?php _ex('HTML Tags', 'database', $this->text_domain); ?></label></th>
						<td>
							<textarea name="<?php print $this->settings_name; ?>[wipe-content][tags]" placeholder="<?php _ex('HTML Tags', 'database', $this->text_domain); ?>" rows="5" cols="100" class="large-text code" id="db-table-wipe-tags"><?php print $this->options->qc_database_wipe_content_tags; ?></textarea>
							<p class="description"><?php _e('Please enter the HTML tags you want to automatically wipe, one per line.', $this->text_domain); ?></p>
							<p class="description qc-icon info"><?php _e('It is not recommended to clear the <strong>div</strong> tag, which will destroy the block of the GuteNberg Editor.', $this->text_domain); ?></p>
							<dl>
								<dt><?php _e('For example: ', $this->text_domain); ?></dt>
								<dd>b<br />i<br />article<br />.div-set<br />#section</dd>
							</dl>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="db-table-wipe-attributes"><?php _ex('Tag Attributes', 'database', $this->text_domain); ?></label></th>
						<td>
							<textarea name="<?php print $this->settings_name; ?>[wipe-content][attributes]" placeholder="<?php _ex('Tag Attributes', 'database', $this->text_domain); ?>" rows="5" cols="100" class="large-text code" id="db-table-wipe-attributes"><?php print $this->options->qc_database_wipe_content_attributes; ?></textarea>
							<p class="description"><?php _e('Please enter the tag attributes you want to automatically wipe, one per line.', $this->text_domain); ?></p>
							<dl>
								<dt><?php _e('For example: ', $this->text_domain); ?></dt>
								<dd>class<br />style<br />data-origin<br />data-*</dd>
							</dl>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="db-table-wipe-tag-comment"><?php _e('Tag Comment', $this->text_domain); ?></label></th>
						<td><?php
 $this->the_switcher(array( 'id' => 'db-table-wipe-tag-comment', 'name' => $this->settings_name . '[wipe-content][tag-comment]', 'value' => $this->options->qc_database_wipe_tag_comment )); if ($this->options->qc_pseudo_original_enabled_random_paragraphs) : ?>
						<p class="description qc-icon info"><?php printf(__('The <a href="%s" target="_blank">Random Paragraph</a> function has been turned on. It is not recommended to turn on this function, which will cause random paragraphs to be generated repeatedly.', $this->text_domain), admin_url('admin.php?page=pseudo-original-settings#random-paragraph')); ?></p>
						<?php endif; ?></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="db-table-wipe-empty-tags"><?php _e('Empty Tags', $this->text_domain); ?></label></th>
						<td><?php
 $this->the_switcher(array( 'id' => 'db-table-wipe-empty-tags', 'name' => $this->settings_name . '[wipe-content][empty-tags]', 'value' => $this->options->qc_database_wipe_empty_tags )); ?></td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<!-- Wipe Content - end -->
	<!-- Add Content - start -->
	<div class="nav-section">
		<form id="add-content-form" action="" method="post">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="post-type"><?php _e('Post Type', $this->text_domain); ?></label></th>
						<td>
							<?php $post_types = get_post_types(array('public' => true, 'show_ui' => true), 'objects'); ?>
							<ul id="post_types_list">
							<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment', 'revision', 'nav_menu_item') )) : ?>
								<li><label><input name="post_type" type="radio" value="<?php echo $name; ?>"<?php if ($name == 'post') print ' checked'; ?> /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
							<?php endif; endforeach; ?></ul>
							<p class="description"><?php _e('Please select the post type you want to add content.', $this->text_domain) ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="post-type"><?php _e('Post Meta', $this->text_domain); ?></label></th>
						<td>
							<input type="text" name="meta_key" class="regular-text" placeholder="<?php _e('Post Meta Key', $this->text_domain); ?>" value="" /><br />
							<input type="text" name="meta_value" class="regular-text" placeholder="<?php _e('Post Meta Value', $this->text_domain); ?>" value="" />
							<p class="description"><?php _e('Please enter the post meta key and post meta value, and the system will automatically add this field to each posts.', $this->text_domain) ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit"><button type="submit" class="button button-primary qc-icon add"><?php _e('Add Content', $this->text_domain); ?></button></p>
		</form>
	</div>
	<!-- Add Content - end -->
</div>