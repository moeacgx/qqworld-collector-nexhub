<div class="wrap" id="qqworld-collector-settings">
	<h2><?php _e('Remote Publish', $this->text_domain); ?></h2>
	<p><?php _e('Powerful form to help you manually push content to remote websites.', $this->text_domain); ?></p>
	<form action="" method="post" id="form">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="remote-website"><?php _e('Remote Website', $this->text_domain); ?></label></th>
					<td>
						<select name="remote-website" id="remote-website" class="selectstyle">
							<option value="">-= <?php _e('Please select a remote website', $this->text_domain); ?> =-</option>
							<?php
  foreach ($this->options->qc_remote_website as $guid => $remote_website) : extract($remote_website); $singular_exclude = get_option('qqworld-collector-remote-publish-refreshing-singular-exclude-'.$guid, array()); $taxonomy_exclude = get_option('qqworld-collector-remote-publish-refreshing-taxonomy-exclude-'.$guid, array()); $sitemap_record = get_option('qqworld-collector-remote-publish-refreshing-sitemap-record-'.$guid, array()); ?>
							<option value="<?php echo $guid; ?>" data-type="<?php print $type; ?>" data-singular-exclude="<?php print $singular_exclude && is_array($singular_exclude) ? count($singular_exclude) : ''; ?>" data-taxonomy-exclude="<?php print $taxonomy_exclude && is_array($taxonomy_exclude) ? count($taxonomy_exclude) : ''; ?>" data-sitemap-record="<?php print $sitemap_record && is_array($sitemap_record) ? count($sitemap_record): ''; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
						<p><?php _e('Please select a remote site for remote publishing.', $this->text_domain); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
 $nav_tabs = array( 'document' => __('Post Type', $this->text_domain), 'taxonomy' => __('Taxonomies', $this->text_domain), 'home' => __('Home'), 'sitemap' => __('Sitemap', $this->text_domain) ); $this->the_nav_tabs($nav_tabs); ?>
		<div class="tab-content">
			<!-- Post Type - start -->
			<div class="nav-section">
				<p class="qc-icon info"><?php _e('Batch remotely publish singula page of post type to remote website.', $this->text_domain); ?></p>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label><?php _e('Select post types', $this->text_domain); ?></label></th>
							<td>
								<?php
 $args = array( 'public' => 1 ); $post_types = get_post_types($args, 'objects'); ?>
								<ul id="post_types_list">
								<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment', 'revision', 'nav_menu_item') )) : ?>
									<li><label><input name="singular[post_type][]" type="checkbox" value="<?php echo $name; ?>" /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
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
							<th scope="row"><label for="post_date_before"><?php _e('Date Range', $this->text_domain); ?></label></th>
							<td>
								<input type="text" id="post_date_after" name="singular[post_date][after]" class="datepicker" readonly /> - <input type="text" id="post_date_before" name="singular[post_date][before]" class="datepicker" readonly />
								<p class="description"><?php _e('You can fill in all of them, or you can just fill in one of them.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="id_from"><?php _e('Scope of Post ID', $this->text_domain); ?></label></th>
							<td>
								<?php printf(__('From %1$s to %2$s', $this->text_domain), '<input type="number" class="small-text" name="singular[id_from]" id="id_from" />', '<input type="number" class="small-text" name="singular[id_to]" />'); ?>
								<p class="description"><?php _e("Default empty for scan all posts ID. If you want to scan posts ID from 50 to 100. please type '50' and '100' or '100' and '50', The order in which two numbers can be reversed. If you only type one number, system would only scan that ID.", $this->text_domain); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="scan_post_status"><?php _e('Status'); ?></label></th>
							<td>
								<select name="singular[post_status]" id="scan_post_status" class="selectstyle">
								<?php
 global $wp_post_statuses; echo '<option value="any" /> '.__('Any', $this->text_domain).'</option>'; foreach ($wp_post_statuses as $slug => $status) { if (!in_array($slug, array('auto-draft', 'inherit', 'trash'))) echo '<option value="'.$slug.'" '.selected('publish', $slug, false).'> '.$status->label.'</option>'; } ?>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="scan_orderby"><?php _e('Order By', $this->text_domain); ?></label></th>
							<td>
								<select name="singular[orderby]" id="scan_orderby" class="selectstyle">
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
								<select name="singular[order]" id="order" class="selectstyle">
									<option value="DESC">DESC</option>
									<option value="ASC">ASC</option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="force-scan"><?php _e('Force Scan', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'singular-force-scan', 'name' => 'singular[force-scan]', 'value' => 0 )); ?>
								<p class="description"><?php _e("Successfully scanned posts will be marked, wouldn\'t be scanned again. if you check this, they will be scanned again.", $this->text_domain); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
				<p>
					<button type="button" id="publish-post-type" class="button button-primary button-large qc-icon export" data-mode="singular" disabled><?php _e('Publish Now', $this->text_domain); ?></button>
					<button type="button" id="restart-publishing-post-type" class="button button-large qc-icon delete restart-publishing" data-mode="singular" disabled><?php _e('Restart', $this->text_domain); ?></button>
				</p>
				<p class="description"><?php _e('Republishing all singular page of the selected post types.<br />You can continue to refresh the snapshot. If you want to restart the publishing, click the <strong>Restart</strong> button.', $this->text_domain); ?></p>
			</div>
			<!-- Post Type - end -->
			<!-- Taxonomies - start -->
			<div class="nav-section hidden">
				<p class="qc-icon info"><?php _e('Batch remotely publish list page of archive to remote website.', $this->text_domain); ?></p>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="publish-taxonomy"><?php _e('Taxonomy'); ?></label></th>
							<td>
								<select name="taxonomies[taxonomy]" id="publish-taxonomy" class="selectstyle">
									<option value="">-= <?php _e('Please select a taxonomy', $this->text_domain); ?> =-</option>
									<optgroup label="<?php _e('Taxonomy'); ?>">
								<?php
 $args = array( 'public' => 1, 'show_ui' => 1, 'show_in_menu' => 1 ); $taxonomies = get_taxonomies($args, 'object'); foreach ($taxonomies as $taxonomy) { print '<option value="'.$taxonomy->name.'">'.$taxonomy->label.'</option>'; } ?>
									</optgroup>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><label><?php _e('Categories'); ?></label></th>
							<td>
								<div id="terms_block" class="terms_list_container"><?php _e('Please select a taxonomy.', $this->text_domain); ?></div>
								<p class="description"><?php _e("Default empty to scan all categories.", $this->text_domain) ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="term_id_from"><?php _e('Scope of Term ID', $this->text_domain); ?></label></th>
							<td>
								<?php printf(__('From %1$s to %2$s', $this->text_domain), '<input type="number" class="small-text" name="taxonomies[id_from]" id="term_id_from" />', '<input type="number" class="small-text" name="taxonomies[id_to]" />'); ?>
								<p class="description"><?php _e("Default empty for scan all terms ID. If you want to scan terms ID from 50 to 100. please type '50' and '100' or '100' and '50', The order in which two numbers can be reversed. If you only type one number, system would only scan that ID.", $this->text_domain); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="terms_scan_orderby"><?php _e('Order By', $this->text_domain); ?></label></th>
							<td>
								<select name="taxonomies[orderby]" id="terms_scan_orderby" class="selectstyle">
									<?php
 $default_orderby = $this->get_terms_default_orderby(); foreach ($default_orderby as $key => $name) : ?>
									<option value="<?php echo $key; ?>"<?php selected('term_id', $key); ?>><?php echo $name; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="terms_order"><?php _e('Order'); ?></label></th>
							<td>
								<select name="taxonomies[order]" id="terms_order" class="selectstyle">
									<option value="DESC">DESC</option>
									<option value="ASC">ASC</option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="force-scan"><?php _e('Force Scan', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'taxonomies-force-scan', 'name' => 'taxonomies[force-scan]', 'value' => 0 )); ?>
								<p class="description"><?php _e("Successfully scanned terms will be marked, wouldn\'t be scanned again. if you check this, they will be scanned again.", $this->text_domain); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
				<p>
					<button type="button" id="publish-taxonomies" class="button button-primary button-large qc-icon export" data-mode="taxonomy" disabled><?php _e('Publish Now', $this->text_domain); ?></button>
					<button type="button" id="restart-publishing-taxonomies" class="button button-large qc-icon delete restart-publishing" data-mode="taxonomy" disabled><?php _e('Restart', $this->text_domain); ?></button>
				</p>
				<p class="description"><?php _e('Republishing all archive page of the selected post types.<br />You can continue to republish the snapshot. If you want to restart the publishing, click the <strong>Restart</strong> button.', $this->text_domain); ?></p>
			</div>
			<!-- Taxonomies - end -->
			<!-- Home - start -->
			<div class="nav-section hidden">
				<p><button type="button" id="publish-homepage" class="button button-primary button-large qc-icon export" data-mode="homepage" disabled><?php _e('Publish Now', $this->text_domain); ?></button></p>
			</div>
			<!-- Home - end -->
			<!-- Sitemap - start -->
			<div class="nav-section hidden">
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label for="website-map"><?php _e('Websit Map Filename', $this->text_domain); ?></label></th>
							<td>
								<input type="text" name="sitemap[filename]" id="website-map" value="wp-sitemap.xml" />
								<p class="qc-icon info"><?php printf(__('If your WordPress version is lower than 5.5, Please make sure that the local site has a <a href="%s" target="_blank">Sitemap</a> and can be accessed normally, recommended plugin: <a href="%s" target="_blank">Google XML Sitemaps</a>.', $this->text_domain), home_url('sitemap.xml'), 'https://wordpress.org/plugins/google-sitemap-generator/'); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
				<p><button type="button" id="publish-sitemap" class="button button-primary button-large qc-icon export" data-mode="sitemap" disabled><?php _e('Publish Now', $this->text_domain); ?></button>
				<button type="button" id="restart-publishing-sitemap" class="button button-large qc-icon delete restart-publishing" data-mode="sitemap" disabled><?php _e('Restart', $this->text_domain); ?></button></p>
			</div>
			<!-- Sitemap - end -->
		</div>
	</form>
</div>