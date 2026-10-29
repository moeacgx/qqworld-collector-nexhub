<div class="wrap" id="qqworld-collector-settings">
	<h2 id="header-title"><?php _e("Cleaner", $this->text_domain); ?></h2>
	<p><?php _e('If you have a huge media library and do not know how many attachments has not bean used. this tool will help you to find out.', $this->text_domain); ?></p>
	<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
		<a href="#settings" class="nav-tab qc-icon regular"><?php _e('Settings'); ?></a>
		<a href="#results" class="nav-tab qc-icon info"><?php _e('Results', $this->text_domain); ?></a>
		<a href="#delete-attachments" class="nav-tab qc-icon delete"><?php _e('Delete Attachments', $this->text_domain); ?></a>
		<a href="#delete-posts" class="nav-tab qc-icon delete"><?php _e('Delete Posts', $this->text_domain); ?></a>
	</h2>
	<!-- Settings - start -->
	<div class="nav-section">
		<form action="" method="post" id="form">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="post-type"><?php _e('Post Type', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Post Type', $this->text_domain); ?>" data-content="<?php _e("Clean the attachment images that attached to posts of the post types you selected. leave empty means clean the attachment images that unattached.", $this->text_domain) ?>"></span></th>
						<td>
							<?php $post_types = get_post_types(array('public' => true, 'show_ui' => true), 'objects'); ?>
							<ul id="post_types_list">
							<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment', 'revision', 'nav_menu_item') )) : ?>
								<li><label><input name="post_type[]" type="checkbox" value="<?php echo $name; ?>" /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
							<?php endif; endforeach; ?></ul>
							<p class="description"><?php _e("Clean the attachment images that attached to posts of the post types you selected. leave empty means clean the attachment images that unattached.", $this->text_domain) ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="mime-types"><?php _e('Mime Types', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Mime Types', $this->text_domain); ?>" data-content="<?php _e("Select the mime types you want to scan.", $this->text_domain) ?>"></span></th>
						<td><?php
 ?>
							<ul class="mime_types_list">
							<?php
 $mime_types = get_allowed_mime_types(); foreach ($mime_types as $name => $mime_type) : $pretty_name = isset($this->mime_type_pretty_name[$mime_type]) ? $this->mime_type_pretty_name[$mime_type] : $mime_type; ?>
								<li><label><input name="mime_types[]" type="checkbox" value="<?php echo $mime_type; ?>"<?php if (in_array($mime_type, $this->default_mime_types)) echo ' checked'; ?> /> <img src="<?php echo wp_mime_type_icon($mime_type); ?>" width="16" height="16" /> <?php echo $pretty_name; ?> (<?php echo str_replace('|', ', ', $name); ?>)</label></li>
							<?php endforeach; ?>
							</ul>
							<p class="description"><?php _e("Select the mime types you want to scan.", $this->text_domain) ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="force-scan"><?php _e('Force Scan', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Force Scan', $this->text_domain); ?>" data-content="<?php _e("Successfully scanned attachments will be marked, wouldn\'t be scanned again. if you check this, they will be scanned again.", $this->text_domain); ?>"></span></th>
						<td>
							<input name="force-scan" id="force-scan" type="checkbox" value="yes" />
							<p class="description"><?php _e("Successfully scanned attachments will be marked, wouldn\'t be scanned again. if you check this, they will be scanned again.", $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit">
				<input name="auto_scan_redundancy_attachment" type="button" class="button-primary" id="scan-redundancy-attachment" value="<?php _e('Scan', $this->text_domain); ?> &#8667;" /> <span class="icon help" data-header="<?php _e('Automatic', $this->text_domain); ?>" data-content="<?php _e('Scan and automatically clean the redundancy attachment images.', $this->text_domain); ?>"></span>
				<input name="manual_scan_redundancy_attachment" type="button" class="button-primary" id="manual-scan-redundancy-attachment" value="<?php _e('Test', $this->text_domain); ?> &#9776;" />
			</p>
			<p class="description"><?php _e('It is recommended to use the test to find out the deleted image and manually clean it, because the scanning function will automatically delete the image.', $this->text_domain); ?></p>
			<p class="description qc-icon info"><?php _e('Warning: If the cloud storage is turned on, do not use this function, it will lead to accidental deletion of attachments.', $this->text_domain); ?></p>
		</form>
	</div>
	<!-- Settings - end -->
	<!-- Results - start -->
	<div class="nav-section">
		<table id="cleaner-results-table" class="wp-list-table widefat posts">
			<thead>
				<tr>
					<th scope="col" class="manage-column"><?php _e('ID', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Thumbnail', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Title', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Attach To', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Author', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Mime Type', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Date', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Status', $this->text_domain); ?></th>
				</tr>
			</thead>
			<tbody id="the-cleaner-results-list">
			</tbody>
			<tfoot>
				<tr>
					<th scope="col" class="manage-column"><?php _e('ID', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Thumbnail', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Title', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Attach To', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Author', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Mime Type', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Date', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Status', $this->text_domain); ?></th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!-- Results - end -->
	<!-- Delete Attachments - start -->
	<div class="nav-section">
		<form action="options.php" method="post" id="form">
			<?php settings_fields($this->settings_name); ?>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="bulk-delete-attachments"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td><?php
 $this->the_switcher(array( 'id' => 'enabled-proxy', 'name' => $this->settings_name . '[auto-delete][enabled]', 'value' => $this->options->qc_cleaner_auto_delete_enabled )); ?><p class="description"><?php _e("Bulk delete attachment of post when deleting post.", $this->text_domain); ?></p></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="bulk-delete-attachments"><?php _e('Mime Types', $this->text_domain); ?></label></th>
						<td>
							<label><input type="checkbox" value="1" id="select-all-mime-types" /> <?php _e('Select All'); ?></label>
							<hr />
							<ul class="mime_types_list">
							<?php
 $mime_types = get_allowed_mime_types(); foreach ($mime_types as $name => $mime_type) : $pretty_name = isset($this->mime_type_pretty_name[$mime_type]) ? $this->mime_type_pretty_name[$mime_type] : $mime_type; $checked = in_array($mime_type, $this->options->qc_cleaner_auto_delete_mime_types) ? ' checked' : ''; ?>
								<li><label><input name="<?php print $this->settings_name; ?>[auto-delete][mime-types][]" type="checkbox" value="<?php echo $mime_type; ?>"<?php echo $checked; ?> /> <img src="<?php echo wp_mime_type_icon($mime_type); ?>" width="16" height="16" /> <?php echo $pretty_name; ?> (<?php echo str_replace('|', ', ', $name); ?>)</label></li>
							<?php endforeach; ?>
							</ul>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<!-- Delete Attachments - end -->
	<!-- Delete Posts - start -->
	<div class="nav-section">
		<form action="" method="post" id="form">
			<h3><?php _e('Duplicated Posts', $this->text_domain); ?></h3>
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="delete-duplicated-posts-post-types"><?php _e('Post Types', $this->text_domain); ?></label></th>
						<td>
							<?php
 $args = array( 'public' => 1, 'show_ui' => 1 ); $post_types = get_post_types($args, 'objects'); ?>
							<ul id="post_types_list_for_delete">
							<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment')) ) : ?>
								<li><label><input name="duplicated-posts-post-types[]" type="checkbox" value="<?php echo $name; ?>" <?php checked(1, in_array($name, array('post'))); ?> /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
							<?php endif; endforeach; ?></ul>
							<p class="description"><?php _e('Please tick the post types you want to scan.', $this->text_domain) ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="delete-duplicated-posts"></label></th>
						<td>
							<button type="button" class="button button-primary qc-icon delete" id="delete-duplicated-posts"><?php _e('Start Bulk Delete Duplicated Posts', $this->text_domain); ?></button>
							<p class="description hidden"><?php _e("Notice: Please disable <strong>Delete Attachments</strong>, Because the posts that have duplicated title may include the same image attachment, so as not to be deleted together.", $this->text_domain); ?></p>
							<p class="description qc-icon info"><?php _e('I recommented backup your website first.', $this->text_domain); ?></p>
						</td>
					</tr>
				</body>
			</table>
			<h3><?php _e('Empty Posts', $this->text_domain); ?></h3>
			<table class="form-table">
					<tr>
						<th scope="row"><label for="delete-empty-posts-post-types"><?php _e('Post Types', $this->text_domain); ?></label></th>
						<td>
							<?php
 $args = array( 'public' => 1, 'show_ui' => 1 ); $post_types = get_post_types($args, 'objects'); ?>
							<ul id="post_types_list_for_delete">
							<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment')) ) : ?>
								<li><label><input name="empty-posts-post-types[]" type="checkbox" value="<?php echo $name; ?>" <?php checked(1, in_array($name, array('post'))); ?> /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
							<?php endif; endforeach; ?></ul>
							<p class="description"><?php _e('Please tick the post types you want to scan.', $this->text_domain) ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="delete-empty-posts"></label></th>
						<td>
							<button type="button" class="button button-primary qc-icon delete" id="delete-empty-posts"><?php _e('Start Bulk Delete Empty Posts', $this->text_domain); ?></button>
							<p class="description"><?php _e('If you have collected a lot of empty posts, you can use this function to clear them.', $this->text_domain); ?></p>
							<p class="description qc-icon info"><?php _e('I recommented backup your website first.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<!-- Delete Posts - end -->
</div>