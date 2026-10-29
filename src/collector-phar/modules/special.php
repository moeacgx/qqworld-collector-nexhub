<?php  namespace QASI\modules; use QASI\modules\auto_save_images; use Overtrue\Pinyin\Pinyin; class special extends auto_save_images { var $mime_type_pretty_name; public function init() { add_action( 'admin_menu', array($this, 'admin_menu'), 11 ); if (!$this->is_activate('server')) return; add_action( 'admin_init', array($this, 'register_settings') ); if ($this->options->special_custom_fields_enabled == 'yes') { add_filter( 'qqworld-auto-save-images-content-save-pre', array($this, 'save_pre'), 10, 2 ); } add_action( 'wp_ajax_qqworld-auto-save-images-special-get-posts', array($this, 'get_posts') ); add_action( 'wp_ajax_nopriv_qqworld-auto-save-images-special-get-posts', array($this, 'get_posts') ); add_action( 'wp_ajax_qqworld-auto-save-images-special-scan-posts', array($this, 'scan_posts') ); add_action( 'wp_ajax_nopriv_qqworld-auto-save-images-special-scan-posts', array($this, 'scan_posts') ); add_action( 'wp_ajax_qqworld_auto_save_images_delete_duplicated_images', array($this, 'delete_duplicated_images') ); add_action( 'wp_ajax_nopriv_qqworld_auto_save_images_delete_duplicated_images', array($this, 'delete_duplicated_images') ); if ($this->options->special_translate_post_name_enabled == 'yes') { add_filter( 'wp_insert_post_data', array($this, 'translate_post_name'), 20, 2 ); } if ($this->options->special_bulk_delete_attachments_enabled == 'yes') { add_action( 'before_delete_post', array($this, 'delete_attachments_before_delete_post') ); } } public function translate_post_name($data, $postarr) { $post_name = urldecode($data['post_name']); switch ($this->options->special_translate_post_name_method) { case 'pinyin': $files = array('DictLoaderInterface', 'FileDictLoader', 'Pinyin'); foreach ($files as $filename) { include_once(QQWORLD_COLLECTOR_DIR . 'lib' . DIRECTORY_SEPARATOR . 'overtrue_pinyin' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $filename . '.php'); } $pinyin = new Pinyin(); $results = $pinyin->convert($post_name); $data['post_name'] = implode('-', $results); break; case 'method': break; } return $data; } public function get_posts() { if (!is_user_logged_in() || !isset($_POST['post_type'])) return; $posttype = $_POST['post_type']; $args = array( 'posts_per_page' => -1, 'post_type' => $posttype ); $posts = get_posts($args); $ids = array(); if (!empty($posts)) foreach ($posts as $post) { $ids[] = $post->ID; } echo json_encode($ids); exit; } public function scan_posts() { if (!is_user_logged_in() || !isset($_POST['items'])) return; $items = $_POST['items']; if (!empty($items)) foreach ($items as $post_id) { $this->save($post_id); } echo json_encode($items); exit; } public function save($post_id) { if (!empty($this->options->special_custom_fields)) foreach ($this->options->special_custom_fields as $field) { if (!empty($field)) { $field_name = isset($field['field']) ? $field['field'] : ''; $type = isset($field['type']) ? $field['type'] : 'string'; $key = isset($field['array-key']) ? $field['array-key'] : ''; $value = get_post_meta($post_id, $field_name, true); if (!empty($value)) { switch ($type) { case 'string': $image_url = $value; break; case 'array': $image_url = $value; $array = preg_replace('/^\[/i', '', $key); $array = preg_replace('/\]$/i', '', $array); $array = explode('][', $array); foreach ($array as $key) { $image_url = $image_url[$key]; } break; } $res = $this->save_images($image_url, $post_id, null); if (isset($res['id'])) { $url = $res['url']; switch ($type) { case 'string': $value = $url; break; case 'array': $codeStr = '$value'; foreach ($array as $key) { $codeStr .= '["'.$key.'"]'; } $codeStr .= ' = "' . $url . '";'; eval($codeStr); break; } update_post_meta($post_id, $field_name, $value); } } } } } public function save_pre($content, $post_id) { $this->save($post_id); return $content; } public function delete_attachments_before_delete_post($post_id) { $mime_types = get_allowed_mime_types(); $types = array(); foreach ($mime_types as $mime_type) { $label = explode('/', $mime_type); $type = strtoupper($label[0]); $types[] = $type; } $types = array_flip(array_flip($types)); foreach ($types as $type) { $attachments = get_attached_media($type, $post_id); if (!empty($attachments)) { foreach ($attachments as $attachment_id => $attachment) { if (in_array($attachment->post_mime_type, $this->options->special_bulk_delete_attachments_mime_types)) { wp_delete_attachment($attachment_id, true); } } } } } public function delete_duplicated_images() { if (!is_user_logged_in() || !current_user_can('manage_options')) exit; global $wpdb; $sql_1 = "CREATE TABLE `my_tmp` AS SELECT MIN(ID) AS `col1` FROM `{$wpdb->posts}` GROUP BY `post_title`"; $wpdb->query($sql_1); $sql_2 = "SELECT `ID` FROM `{$wpdb->posts}` WHERE `post_type` = 'post' AND `ID` NOT IN (SELECT `col1` FROM `my_tmp`)"; $results = $wpdb->get_results($sql_2); $sql_3 = "DROP TABLE `my_tmp`"; $wpdb->query($sql_3); if (!empty($results)) { foreach ($results as $result) { wp_delete_post($result->ID); } $msg = array( 'success' => 1, 'msg' => sprintf(_n('%d duplicated post has been deleted.', '%d duplicated posts has been deleted.', count($results), $this->text_domain), number_format_i18n(count($results))) ); } else { $msg = array( 'success' => 0, 'msg' => __('No duplicated post found.', $this->text_domain) ); } echo json_encode($msg); exit; } public function admin_menu() { $parent_slug = 'qqworld-collector'; $capability = 'administrator'; $page_title = __('Special Features', $this->text_domain); $menu_title = $page_title; $menu_slug = 'qqworld-collector-special'; $function = $this->is_activate('server') ? array($this, 'page') : array($this, 'activation_page'); $settings_page = add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function); add_action( "load-{$settings_page}", array($this, 'help_tab') ); } public function register_settings() { register_setting("qqworld-auto-save-images-special", 'qqworld-auto-save-images-special-custom-fields-enabled'); register_setting("qqworld-auto-save-images-special", 'qqworld-auto-save-images-special-custom-fields'); register_setting("qqworld-auto-save-images-special", 'qqworld-auto-save-images-special-translate-post-name'); register_setting("qqworld-auto-save-images-special", 'qqworld-auto-save-images-special-handle-attacment-filename'); register_setting("qqworld-auto-save-images-special", 'qqworld-auto-save-images-special-bulk-delete-attachments'); } public function page() { $this->mime_type_pretty_name = array( 'image/jpeg' => __('JPEG Image', $this->text_domain), 'image/png' => __('PNG Image', $this->text_domain), 'image/gif' => __('GIF Image', $this->text_domain), 'audio/mpeg' => __('MPEG Audio', $this->text_domain), 'video/quicktime' => __('Quicktime Video', $this->text_domain), 'video/avi' => __('AVI Video', $this->text_domain), 'video/x-ms-wmv' => __('WMV Video', $this->text_domain), 'audio/midi' => __('MIDI Audio', $this->text_domain), 'application/pdf' => __('PDF Document', $this->text_domain) ); ?>
<div class="wrap">
	<form id="special-form" action="options.php" method="post">
		<?php settings_fields('qqworld-auto-save-images-special'); ?>
		<h2><?php _e('Special Features', $this->text_domain); ?></h2>
		<ul id="qqworld-auto-save-images-tabs" class="qqworld-collector-tabs">
			<li class="current"><?php _e('Handle Custom Fields', $this->text_domain); ?></li>
			<li><?php _e('Translate Post Name (Slug)', $this->text_domain); ?></li>
			<li><?php _e('Handle Filename of Attachments', $this->text_domain); ?></li>
			<li><?php _e('Bulk Delete Attachments', $this->text_domain); ?></li>
			<li><?php _e('Bulk Delete Duplicated Posts', $this->text_domain); ?></li>
		</ul>
		<div class="tab-content">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="enabled_custom_fields"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Enabled', $this->text_domain); ?></span></legend>
							<label>
								<input name="qqworld-auto-save-images-special-custom-fields-enabled" type="checkbox" id="enabled_cookie_free_domain" value="yes" <?php checked('yes', $this->options->special_custom_fields_enabled); ?> />
							</label>
							<p class="description"><?php _e("Automatically keep remote images in the custom fields to the local media library.", $this->text_domain); ?>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="special_custom_fields_list"><?php _e('Custom Fields', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Custom Fields', $this->text_domain); ?>" data-content="<?php _e("The plugin will keep remote images in there custom fields to the local.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Custom Fields', $this->text_domain); ?></span></legend>
								<ul id="special_custom_fields_list">
								<?php
 if (!empty($this->options->special_custom_fields)) foreach ($this->options->special_custom_fields as $timestamp => $field) : if (!empty($field)) : $field_name = isset($field['field']) ? $field['field'] : ''; $type = isset($field['type']) ? $field['type'] : 'string'; $key = isset($field['array-key']) ? $field['array-key'] : ''; ?>
								<li><input type="text" placeholder="<?php _e('Field Name', $this->text_domain); ?>" name="qqworld-auto-save-images-special-custom-fields[<?php echo $timestamp; ?>][field]" value="<?php echo $field_name; ?>" />
								<select name="qqworld-auto-save-images-special-custom-fields[<?php echo $timestamp; ?>][type]">
									<option value="string" <?php selected('string', $type); ?>><?php _e('String', $this->text_domain); ?></option>
									<option value="array" <?php selected('array', $type); ?>><?php _e('Array', $this->text_domain); ?></option>
								</select>
								<input type="text" placeholder="<?php _e('If array, please enter the array key of image url. such as "[attachment]"', $this->text_domain); ?>" name="qqworld-auto-save-images-special-custom-fields[<?php echo $timestamp; ?>][array-key]" class="regular-text" value="<?php echo $key; ?>" />
								<input type="button" class="button delete-special-custom-fields" value="<?php _e('Delete'); ?>"></li>
									<?php endif; endforeach; ?>
								</ul>
								<p><input type="button" id="add_special_custom_fields" class="button" value="<?php _e('Add a Special Custom Fields', $this->text_domain);?>" /></p>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="scan"><?php _e('Scan', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Scan', $this->text_domain); ?>" data-content="<?php _e("Scan all custom fields and automatically keep the remote images to the local.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Scan', $this->text_domain); ?></span></legend>
								<?php $post_types = get_post_types(array('public'=>true), 'objects'); ?>
								<ul id="post_types_list">
								<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment', 'revision', 'nav_menu_item') )) : ?>
									<li><label><input name="post_type[]" type="checkbox" value="<?php echo $name; ?>" /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
								<?php endif; endforeach; ?></ul>
								<p><input type="button" id="scan_special_custom_fields" class="button" value="<?php _e('Scan', $this->text_domain);?>" /></p>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- //////////////////////////////////////////// -->
		<div class="tab-content hidden">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="translate-post-name-enabled"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Enabled', $this->text_domain); ?></span></legend>
							<label>
								<input name="qqworld-auto-save-images-special-translate-post-name[enabled]" type="checkbox" id="translate-post-name-enabled" value="yes" <?php checked('yes', $this->options->special_translate_post_name_enabled); ?> />
							</label>
							<p class="description"><?php _e("Automatically convert the post name to Pinyin or translate it into English when you publish the post.", $this->text_domain); ?></p>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="translate-post-name-method"><?php _e('Translate Into', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Translate Into', $this->text_domain); ?></span></legend>
							<label>
								<select name="qqworld-auto-save-images-special-translate-post-name[method]" id="translate-post-name-method">
									<option value="english" disabled <?php selected('english', $this->options->special_translate_post_name_method); ?>><?php _e('English'); ?></option>
									<option value="pinyin" <?php selected('pinyin', $this->options->special_translate_post_name_method); ?>><?php _e('Chinese Pinyin', $this->text_domain); ?></option>
								</select>
							</label>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- //////////////////////////////////////////// -->
		<div class="tab-content hidden">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="handle-attacment-filename-enabled"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Enabled', $this->text_domain); ?></span></legend>
							<label>
								<input name="qqworld-auto-save-images-special-handle-attacment-filename[enabled]" type="checkbox" id="handle-attacment-filename-enabled" value="yes" <?php checked('yes', $this->options->special_handle_attacment_filename_enabled); ?> />
							</label>
							<p class="description"><?php _e("Automatically change attachment file name when uploading non-image attachments.", $this->text_domain); ?></p>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="handle-attacment-filename-structure"><?php _e('Filename Structure', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Enabled', $this->text_domain); ?></span></legend>
							<label>
								<input name="qqworld-auto-save-images-special-handle-attacment-filename[structure]" type="text" class="regular-text" id="handle-attacment-filename-structure" value="<?php echo $this->options->special_handle_attacment_filename_structure; ?>" />
							</label>
							<p class="description">
								<strong>%filename%</strong> : <?php _e('Original filename.', $this->text_domain); ?><br />
								<strong>%date%</strong> : <?php _e('Full date, e.g. 20150209.', $this->text_domain); ?><br />
								<strong>%year%</strong> - <?php _e('YYYY, e.g. 2015.', $this->text_domain); ?><br />
								<strong>%month%</strong> - <?php _e('MM, e.g. 02.', $this->text_domain); ?><br />
								<strong>%day%</strong> -  <?php _e('DD, e.g. 15.', $this->text_domain); ?><br />
								<strong>%time%</strong> - <?php _e('HHMMSS, e.g. 182547.', $this->text_domain); ?><br />
								<strong>%timestamp%</strong> - <?php printf(__('Unix timestamp, e.g. %s.', $this->text_domain), time()); ?><br />
								<strong>%random%</strong> - <?php printf(__('Random number, e.g. %s.', $this->text_domain), 'A5eqWj'); ?>
							</p>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- //////////////////////////////////////////// -->
		<div class="tab-content hidden">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="bulk-delete-attachments"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Enabled', $this->text_domain); ?></span></legend>
							<label>
								<input name="qqworld-auto-save-images-special-bulk-delete-attachments[enabled]" type="checkbox" id="bulk-delete-attachments" value="yes" <?php checked('yes', $this->options->special_bulk_delete_attachments_enabled); ?> />
							</label>
							<p class="description"><?php _e("Bulk delete attachment of post when deleting post.", $this->text_domain); ?></p>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="bulk-delete-attachments"><?php _e('Mime Types', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Mime Types', $this->text_domain); ?></span></legend>
							<label><input type="checkbox" value="1" id="select-all-mime-types" /> <?php _e('Select All'); ?></label>
							<hr />
							<?php
 include_once(ABSPATH . 'wp-includes/ms-functions.php'); $mime_types = \get_allowed_mime_types(); ?>
							<ul id="mime_types_list">
							<?php foreach ($mime_types as $name => $mime_type) : $pretty_name = isset($this->mime_type_pretty_name[$mime_type]) ? $this->mime_type_pretty_name[$mime_type] : $mime_type; $checked = in_array($mime_type, $this->options->special_bulk_delete_attachments_mime_types) ? ' checked' : ''; ?>
								<li><label><input name="qqworld-auto-save-images-special-bulk-delete-attachments[mime-types][]" type="checkbox" value="<?php echo $mime_type; ?>"<?php echo $checked; ?> /> <img src="<?php echo wp_mime_type_icon($mime_type); ?>" width="16" height="16" /> <?php echo $pretty_name; ?> (<?php echo str_replace('|', ', ', $name); ?>)</label></li>
							<?php endforeach; ?>
							</ul>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- //////////////////////////////////////////// -->
		<div class="tab-content hidden">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="bulk-delete-duplicated-posts"><?php _e('Run', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Run', $this->text_domain); ?></span></legend>
							<label>
								<button type="button" class="button button-primary" id="bulk-delete-duplicated-posts"><?php _e('Start Bulk Delete Duplicated Posts', $this->text_domain); ?></button>
							</label>
							<p class="description"><?php _e("Notice: Please disable <strong>Bulk Delete Attachments</strong>, Because the posts that have duplicated title may include the same image attachment, so as not to be deleted together.", $this->text_domain); ?></p>
							<p><?php _e('I recommented backup your website first.', $this->text_domain); ?></p>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php submit_button(); ?>
	</form>
</div>
<?php
 } }