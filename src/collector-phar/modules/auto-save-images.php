<?php  namespace QASI\modules; use qqworld_collector\lib\options; use QASI\modules\watermark\watermark; use PHPImageWorkshop\ImageWorkshop; use GifCreator; use GifFrameExtractor; class auto_save_images extends \qqworld_collector_common { const TOO_SMALL = "too small"; const MISSING = "missing"; const NEED_DELETED = 'need deleted'; const NEED_IGNORED = 'need ignored'; const NO_MEDIA_LIBRARY = 'no media library'; var $is_downloaded; var $temp; var $log_path; var $post_id; var $width; var $height; var $type; var $attr; var $is_base64_image; var $plugin; var $thumbnail_id = 0; var $current_post_id; var $has_remote_image; var $has_missing_image; var $images_id_of_post; var $count; var $default_orderby; var $content; var $temp_content; var $attributes; var $watermark; public function init() { add_action( 'admin_menu', array($this, 'admin_menu') ); add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts') ); if (!$this->is_activate('pro')) return; $this->log_path = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'qqworld-auto-save-images.log'; $this->get_plugin_data(); if (!is_array($this->options->when)) $this->options->when = array('publish'); $this->attributes = array('width' => '', 'height' => '', 'class' => ''); $this->watermark = new watermark; add_filter( 'wp_handle_upload_prefilter', array($this, 'wp_handle_upload_prefilter') ); if ($this->options->compression_enabled=='yes') { add_filter( 'qqworld_auto_save_images_file_bits', array($this, 'compress_image') ); } if ($this->options->flip_horizontal_image=='yes') { add_filter( 'qqworld_auto_save_images_file_bits', array($this, 'flip_horizontal_image') ); } add_filter( 'pre_post__thumbnail_id', array($this, 'pre_post_post_thumbnail') ); add_filter( 'pre_post_author', array($this, 'pre_post_author') ); switch ($this->options->mode) { case 'auto': $this->add_actions(); break; case 'manual': add_action( 'media_buttons', array($this, 'media_buttons' ), 11 ); add_action( 'wp_ajax_manual_save_remote_images', array($this, 'manual_save_remote_images') ); add_action( 'wp_ajax_nopriv_manual_save_remote_images', array($this, 'manual_save_remote_images') ); break; } if ($this->options->schedule_publish == 'yes') add_action( 'publish_future_post', array($this, 'fetch_images_after_save') ); if ($this->options->remote_publishing) add_action('xmlrpc_publish_post', array($this, 'fetch_images_after_save') ); add_action( 'wp_ajax_get_scan_list', array($this, 'get_scan_list') ); add_action( 'wp_ajax_nopriv_get_scan_list', array($this, 'get_scan_list') ); add_action( 'wp_ajax_auto_save_images_set_cron_scan_post', array($this, 'set_cron_scan_post') ); add_action( 'wp_ajax_nopriv_auto_save_images_set_cron_scan_post', array($this, 'set_cron_scan_post') ); add_action( 'wp_ajax_auto-save-images-delete-schedule', array($this, 'delete_schedule') ); add_action( 'wp_ajax_nopriv_auto-save-images-delete-schedule', array($this, 'delete_schedule') ); add_action( 'wp_ajax_auto-save-images-clear-all-crons', array($this, 'clear_all_schedule_crons') ); add_action( 'wp_ajax_nopriv_auto-save-images-clear-all-crons', array($this, 'clear_all_schedule_crons') ); add_action( 'wp_ajax_save_remote_images_get_categories_list', array($this, 'save_remote_images_get_categories_list') ); add_action( 'wp_ajax_nopriv_save_remote_images_get_categories_list', array($this, 'save_remote_images_get_categories_list') ); add_action( 'wp_ajax_save_remote_images_after_scan', array($this, 'save_remote_images_after_scan') ); add_action( 'wp_ajax_nopriv_save_remote_images_after_scan', array($this, 'save_remote_images_after_scan') ); add_action( 'wp_ajax_save_remote_images_list_all_posts', array($this, 'save_remote_images_list_all_posts') ); add_action( 'wp_ajax_nopriv_save_remote_images_list_all_posts', array($this, 'save_remote_images_list_all_posts') ); add_action( 'wp_ajax_save_remote_images_save_outside_links', array($this, 'save_remote_images_save_outside_links') ); add_action( 'wp_ajax_nopriv_save_remote_images_save_outside_links', array($this, 'save_remote_images_save_outside_links') ); add_action( 'wp_ajax_qqworld_auto_save_images_get_attachments_list', array($this, 'get_attachments_list') ); add_action( 'wp_ajax_nopriv_qqworld_auto_save_images_get_attachments_list', array($this, 'get_attachments_list') ); add_action( 'wp_ajax_qqworld_auto_save_images_compress_single_attachment', array($this, 'compress_single_attachment') ); add_action( 'wp_ajax_nopriv_qqworld_auto_save_images_compress_single_attachment', array($this, 'compress_single_attachment') ); add_action( 'wp_ajax_qqworld_auto_save_images_compress_attachment', array($this, 'compress_attachment') ); add_action( 'wp_ajax_nopriv_qqworld_auto_save_images_compress_attachment', array($this, 'compress_attachment') ); add_action( 'wp_ajax_qqworld-auto-save-images-add-to-black-list', array($this, 'add_to_black_list') ); add_action( 'wp_ajax_nopriv_qqworld-auto-save-images-add-to-black-list', array($this, 'add_to_black_list') ); add_filter( 'qqworld-auto-save-images-custom-filename-structure', array($this, 'custom_filename_structure'), 10, 2 ); add_filter( 'qqworld-auto-save-images-before-content-save-pre', array($this, 'content_optimization'), 10, 2 ); add_filter( 'qqworld-auto-save-images-before-content-save-pre', array($this, 'wipe_html_tags'), 10, 2 ); add_filter( 'qqworld-auto-save-images-before-content-save-pre', array($this, 'wipe_attributes'), 10, 2 ); add_action( 'admin_init', array($this, 'setup') ); add_action( 'admin_init', array($this, 'register_settings') ); add_action( 'add_meta_boxes', array($this, 'add_meta_box') ); add_filter( 'plugin_row_meta', array($this, 'registerPluginLinks'),10,2 ); add_filter( 'post_updated_messages', array($this, 'post_updated_messages') ); add_action( 'admin_notices', array($this, 'admin_notices') ); add_action( 'deleted_post', array($this, 'wipe_post_meta') ); add_action( 'delete_attachment', array($this, 'wipe_attachment_meta') ); if ($this->options->enabled_smart_grabbing=='yes') add_filter( 'qqworld-auto-save-images-remote-images', array($this, 'smart_grabbing'), 10, 2 ); add_filter( 'manage_media_columns', array($this, 'manage_media_columns') ); add_action( 'manage_media_custom_column', array($this, 'manage_media_custom_column'), 10, 2 ); add_filter( 'wp_generate_attachment_metadata', array($this, 'set_crc_of_attachment'), 10, 2); if ($this->options->optimize_enabled == 'yes' && $this->options->optimize_mode == 'local') ; add_action( 'qqworld-auto-save-images-cron-scan-post', array($this, 'do_cron_scan_post'), 10, 8 ); add_filter( 'qqworld-auto-save-images-string-compatible', array($this, 'string_compatible_vietnamese_to_english') ); add_action( 'cron_delete_attachment_after_synced', array($this, 'cron_delete_attachment') ); add_filter( 'qqworld-auto-save-images-content-save-pre', array($this, 'set_featured_image'), 10, 2); } public function add_meta_box() { $id = 'auto-save-images-settings'; $title = __('Auto Save Images Settings', $this->text_domain); $screen = get_post_types(array('public'=>true, 'show_ui' => true)); $callback = array( $this, 'render_auto_save_images_settings' ); $context = 'side'; $priority = 'default'; $callback_args = null; add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args ); } public function render_auto_save_images_settings() { ?>
	<?php if ($this->options->watermark_enabled == 'yes') : ?>
	<p><label for="post_watermark"><strong><?php _e('Watermark', $this->text_domain); ?></strong></label><br />
	<?php _e('Add watermark to remote images when automatically save them.', $this->text_domain); ?><br />
	<label><select name="post_watermark" id="post_watermark">
		<option value="1" <?php selected(1, $this->options->watermark_default_value); ?>><?php _ex('Enabled', 'watermark', $this->text_domain); ?></option>
		<option value="0" <?php selected(0, $this->options->watermark_default_value); ?>><?php _e('Disabled', $this->text_domain); ?></option>
	</select><label></p>
	<?php endif; ?>
	<p><label for="header-user-agent"><strong><?php _e('Header - User Agent', $this->text_domain); ?></strong></label><br />
	<?php _e('Grab some remote images need to set the User-Agent of the header, some do not need.', $this->text_domain); ?><br />
	<label><select id="header-user-agent" name="qqworld-collector-http-header[user-agent]">
		<option value=""><?php _e('Not Use', $this->text_domain); ?></option>
		<option value="Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36" <?php selected('Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', $this->options->http_header_user_agent); ?>><?php _e('Google Chrome Explorer', $this->text_domain); ?></option>
		<option value="Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0" <?php selected('Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0', $this->options->http_header_user_agent); ?>><?php _e('Mozilla Firefox Explorer', $this->text_domain); ?></option>
		<option value="Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36 OPR/38.0.2220.41" <?php selected('Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36 OPR/38.0.2220.41', $this->options->http_header_user_agent); ?>><?php _e('Opera Explorer', $this->text_domain); ?></option>
		<option value="Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1" <?php selected('Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', $this->options->http_header_user_agent); ?>><?php _e('Apple Safari Explorer', $this->text_domain); ?></option>
		<option value="Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0)" <?php selected('Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0)', $this->options->http_header_user_agent); ?>><?php _e('Microsoft Internet Explorer', $this->text_domain); ?></option>
		<option value="Googlebot/2.1 (+http://www.google.com/bot.html)"" <?php selected('Googlebot/2.1 (+http://www.google.com/bot.html)', $this->options->http_header_user_agent); ?>><?php _e('Crawler and Bot', $this->text_domain); ?></option>
		<option value="mozilla/5.0 (linux; u; android 4.1.2; zh-cn; mi-one plus build/jzo54k) applewebkit/534.30 (khtml, like gecko) version/4.0 mobile safari/534.30 micromessenger/5.0.1.352" <?php selected('mozilla/5.0 (linux; u; android 4.1.2; zh-cn; mi-one plus build/jzo54k) applewebkit/534.30 (khtml, like gecko) version/4.0 mobile safari/534.30 micromessenger/5.0.1.352', $this->options->http_header_user_agent); ?>><?php _e('Wechat Explorer', $this->text_domain); ?></option>
	</select><label></p>
	<p><label for="header-http-referer"><strong><?php _e('Header - HTTP Referer', $this->text_domain); ?></strong></label><br />
	<?php _e('Very few remote images need to set the HTTP reference address.', $this->text_domain); ?><br />
	<label><select id="header-http-referer" name="qqworld-collector-http-header[http-referer]">
		<option value=""><?php _e('Not Use', $this->text_domain); ?></option>
		<option value="auto" <?php selected('auto', $this->options->http_header_http_referer); ?>><?php _e('Automatic', $this->text_domain); ?></option>
		<option value="https://www.baidu.com" <?php selected('https://www.baidu.com', $this->options->http_header_http_referer); ?>><?php _e('Baidu', $this->text_domain); ?></option>
		<option value="https://www.google.com" <?php selected('https://www.google.com', $this->options->http_header_http_referer); ?>><?php _e('Google', $this->text_domain); ?></option>
		<option value="https://www.facebook.com" <?php selected('https://www.facebook.com', $this->options->http_header_http_referer); ?>><?php _e('Facebook', $this->text_domain); ?></option>
		<option value="http://" <?php selected('http://', $this->options->http_header_http_referer); ?>><?php _e('Custom', $this->text_domain); ?></option>
	</select><label><br /><input type="text" id="header-custom-http-referer" name="qqworld-collector-http-header[custom-http-referer]" class="large-text" placeholder="<?php _e('It is usually the address of the collected website.', $this->text_domain); ?>" value="<?php print $this->options->http_header_custom_http_referer; ?>" <?php if ($this->options->http_header_http_referer != 'http://') print 'readonly'; ?> /></p>
	<script>
	jQuery(document).on('change', '#header-http-referer', function() {
		var $ = jQuery;
		var text = $(this).val();
		if (text == 'http://') {
			$('#header-custom-http-referer').removeAttr('readonly');
		} else {
			$('#header-custom-http-referer').attr('readonly', 'readonly');
		}
		text = text == 'auto' ? '' : text;
		$('#header-custom-http-referer').val(text);
	});
	</script>
	<?php if ($this->options->proxy_enabled=='yes'): ?>
	<p><label for="http_proxy"><strong><?php _e('Proxy', $this->text_domain); ?></strong></label><br />
	<?php _e('If you do not want to use a proxy, select Disable.', $this->text_domain); ?><br />
	<label><select name="http_proxy" id="http_proxy">
		<option value="1"><?php _e('Enabled', $this->text_domain); ?></option>
		<option value="0"><?php _e('Disabled', $this->text_domain); ?></option>
	</select><label></p>
	<?php endif; ?>
<?php
 } public function pre_post_author($value) { if ( $value && !is_numeric($value) ) { if (is_array($value)) { $new_user_data = $value; if (isset($new_user_data['meta_input'])) { $meta_input = $new_user_data['meta_input']; unset($new_user_data['meta_input']); } $value = $value['nickname']; } $args = array( 'meta_key' => 'auto-save-username', 'meta_value' => $value ); $users = get_users($args); if (!empty($users)) { $value = $users[0]->ID; } else { $userdata = array( 'user_login' => current_time('timestamp'), 'user_pass' => rand(111111111111, 999999999999), 'first_name' => $value, 'user_nicename' => $value, 'nickname' => $value, 'display_name' => $value ); if (isset($new_user_data)) $userdata = wp_parse_args($userdata, $new_user_data); $user_id = wp_insert_user( $userdata ); if ($user_id) { update_user_meta($user_id, 'auto-save-username', $value); if (isset($meta_input)) foreach ($meta_input as $key => $value) { update_user_meta($user_id, $key, $value); } $value = $user_id; } } } return $value; } public function pre_post_post_thumbnail($value) { if ( $value && !is_numeric($value) ) { $res = $this->save_images($value); if (isset($res['id'])) { $value = $res['id']; } else { $value = -1; } } return $value; } public function set_featured_image($content, $post_id) { if ( !has_post_thumbnail($post_id) && $this->options->featured_image=='yes' ) { if (!empty($this->images_id_of_post)) { if (count($this->images_id_of_post) > $this->options->featured_image_index-1) $this->thumbnail_id = $this->images_id_of_post[$this->options->featured_image_index-1]; else $this->thumbnail_id = end($this->images_id_of_post); set_post_thumbnail( $post_id, $this->thumbnail_id); } else { $this->automatic_set_featured_pic_from_media_library($post_id); if (!has_post_thumbnail($post_id) && $this->options->default_featured_image) { $this->_log('No image found in media library with post ('.$post_id.'), set a default image as featured image.'); $result = set_post_thumbnail( $post_id, $this->options->default_featured_image ); $this->_log('New _post_thumbnail meta id is ' . $result); } } } return $content; } public function cron_delete_attachment($attachment_id) { remove_action( 'delete_attachment', array($this, 'delete_attachment') ); $sizes = array(); $sizes['full'] = get_attached_file( $attachment_id ); $path = dirname($sizes['full']); $metadata = wp_get_attachment_metadata($attachment_id); if (!empty($metadata['sizes'])) foreach ($metadata['sizes'] as $name => $size) { $sizes[$name] = $path . DIRECTORY_SEPARATOR . $size['file']; } foreach ($sizes as $size => $file) { @ unlink($file); } } public function string_compatible_vietnamese_to_english($str) { $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str); $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str); $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str); $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str); $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str); $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str); $str = preg_replace("/(đ)/", 'd', $str); $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str); $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str); $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str); $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str); $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str); $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str); $str = preg_replace("/(Đ)/", 'D', $str); return $str; } public function add_to_black_list() { $post_id = $_POST['post_id']; $image_url = $_POST['image_url']; $mode = $_POST['mode']; $file = $this->download_image($image_url); if (!empty($file)) { $crc = $this->getCrc32($file); switch ($mode) { case 'exclude': $exclude_list = get_option('qqworld-auto-save-images-exclude-crc'); if (!empty($exclude_list) && !in_array($crc, $exclude_list)) { $exclude_list[] = $crc; } else { $exclude_list = array($crc); } update_option('qqworld-auto-save-images-exclude-crc', $exclude_list); break; case 'delete': $delete_list = get_option('qqworld-auto-save-images-delete-crc'); if (!empty($delete_list) && !in_array($crc, $delete_list)) { $delete_list[] = $crc; } else { $delete_list = array($crc); } update_option('qqworld-auto-save-images-delete-crc', $delete_list); break; } $result = array('success' => 1); } else { $result = array('success' => 0); } echo json_encode($result); exit; } public function new_interval($interval) { $interval['minutely'] = array( 'interval' => 60, 'display' => __('Minutely', $this->text_domain) ); return $interval; } public function get_crons($hook) { $crons = _get_cron_array(); $results = array(); foreach ($crons as $timestamp => $cron) { if (is_numeric($timestamp)) { if (!empty($cron)) foreach ($cron as $cron_hook => $cr) { if ($cron_hook == $hook) { if (!empty($cr)) foreach ($cr as $args) { $results[] = array( 'timestamp' => wp_next_scheduled($hook, $args['args']), 'options' => $args ); } } } } } return $results; } public function setup() { $this->default_orderby = array( 'ID' => __('ID'), 'author' => __('Author'), 'title' => __('Title'), 'date' => __('Date'), 'modified' => __('Last Modified'), 'comment_count' => __('Comment Count', $this->text_domain) ); } public function content_optimization($content, $post_id) { $pattern = '/&amp;/i'; if (preg_match($pattern, $content, $match)) $content = preg_replace($pattern, '&', $content); $pattern = '/\?tp=webp&/i'; if (preg_match($pattern, $content, $match)) $content = preg_replace($pattern, '?', $content); $pattern = '/\?tp=webp/i'; if (preg_match($pattern, $content, $match)) $content = preg_replace($pattern, '', $content); $pattern = '/&tp=webp/i'; if (preg_match($pattern, $content, $match)) $content = preg_replace($pattern, '', $content); $preg = preg_match_all('/(src|href)=\"((?!\").*?)\"/i', stripslashes($content), $matches); if ($preg) { foreach ($matches[2] as $match) { $new_str = str_replace(' ', '%20', $match); $content = str_replace($match, $new_str, $content); } } return $content; } public function wipe_html_tags($content, $post_id=null) { if (!empty($this->options->smart_wipe_html_tags)) { foreach ($this->options->smart_wipe_html_tags as $tag) { $pattern = '/<'.$tag.' [\s\S]*?>([\s\S]*?)<\/'.$tag.'>/i'; $content = preg_replace($pattern, '$1', $content); } } return $content; } public function wipe_attributes($content, $post_id=null) { if (!empty($this->options->smart_wipe_attributes)) { foreach ($this->options->smart_wipe_attributes as $attribute) { $attribute = str_replace('*', '[^"]*?', $attribute); $pattern = '/ '.$attribute.'="[^"]*?"/i'; $content = preg_replace($pattern, '', $content); } } return $content; } public function delete_schedule() { $key = $_POST['timestamp']; $args = $_POST['qqworld-auto-save-images-cron-scan-posts'][$key]; $post_type = $args['post_type']; $tax_query = isset($args['tax_query']) && !empty($args['tax_query']) ? $args['tax_query'] : ''; $post__in = isset($args['post__in']) && !empty($args['post__in']) ? $args['post__in'] : ''; $offset = isset($args['offset']) && !empty($args['offset']) ? $args['offset'] : ''; $posts_per_page = $args['posts_per_page']; $post_status = $args['post_status']; $orderby = $args['orderby']; $order = $args['order']; $timestamp = wp_next_scheduled( 'qqworld-auto-save-images-cron-scan-post', array($post_type, $tax_query, $post__in, $offset, $posts_per_page, $post_status, $orderby, $order) ); if ($timestamp) { wp_unschedule_event( $timestamp, 'qqworld-auto-save-images-cron-scan-post', array($post_type, $tax_query, $post__in, $offset, $posts_per_page, $post_status, $orderby, $order) ); $results = array('success' => 1, 'timestamp' => $timestamp, 'msg' => __('Successfully deleted schedule.', $this->text_domain), 'args' => $args); } else { $results = array('success' => 0,'timestamp' => $timestamp, 'msg' => __('Deleted schedule faied.', $this->text_domain), 'args' => $args); } echo json_encode($results); exit; } public function get_cron_table_row($options) { ob_start(); if (!empty($options)) foreach ($options as $timestamp => $option) { ?>
		<tr>
			<td>
				<?php
 $posttypes = get_post_types('', 'object'); $types = array(); foreach ($option['post_type'] as $post_type) : $types[] = $posttypes[$post_type]->label; ?><input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[<?php echo $timestamp; ?>][post_type][]" value="<?php echo $post_type; ?>" />
				<?php
 endforeach; echo implode(', ', $types); ?>
			</td>
			<td>
			<?php
 $tax_html = array(); $terms = array(); if (isset($option['tax_query'])) { foreach ($option['tax_query'] as $id => $items) { $taxonomy = get_taxonomy($items['taxonomy']); $tax_html[] = $taxonomy->label . ': ' . implode(', ', $items['terms']); ?>
					<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[<?php echo $timestamp; ?>][tax_query][<?php echo $id; ?>][taxonomy]" value="<?php echo $items['taxonomy']; ?>" />
			<?php
 if (!empty($items['terms'])) foreach ($items['terms'] as $term) { ?>
					<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[<?php echo $timestamp; ?>][tax_query][<?php echo $id; ?>][terms][]" value="<?php echo $term; ?>" />
			<?php
 } ?>
					<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[<?php echo $timestamp; ?>][tax_query][<?php echo $id; ?>][field]" value="<?php echo $items['field']; ?>" />
			<?php
 } } echo !empty($tax_html) ? implode('<br />', $tax_html) : __('none'); if (!empty($terms)) foreach ($terms as $term) { ?>
				
			<?php } ?>
			</td>
			<td>
			<?php
 $post__in = isset($option['post__in']) ? $option['post__in'] : ''; if (is_array($post__in) && !empty($post__in)) { if (count($post__in) == 1) echo $post__in[0]; else echo $post__in[0] . '-' . $post__in[count($post__in)-1]; foreach ($post__in as $post) {?>
						<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[<?php echo $timestamp; ?>][post__in][]" value="<?php echo $post; ?>" />
					<?php } } else _e('none'); ?>
			</td>
			<td>
				<?php
 $posts_per_page = $option['posts_per_page'] == -1 ? __('All', $this->text_domain) : $option['posts_per_page']; printf(__('Start from %s to Scan %s posts', $this->text_domain), $option['offset'], $posts_per_page); ?>
				<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[<?php echo $timestamp; ?>][offset]" value="<?php echo $option['offset']; ?>" />
				<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[<?php echo $timestamp; ?>][posts_per_page]" value="<?php echo $option['posts_per_page']; ?>" />
			</td>
			<td>
				<?php
 $post_status = $option['post_status']; $post_statuses = get_post_statuses(); echo $post_statuses[$post_status]; ?>
				<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[<?php echo $timestamp; ?>][post_status]" value="<?php echo $post_status; ?>" />
			</td>
			<td>
				<?php
 $orderby = $option['orderby']; echo $this->default_orderby[$orderby]; ?>
				<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[<?php echo $timestamp; ?>][orderby]" value="<?php echo $orderby; ?>" />
			</td>
			<td><?php echo $option['order']; ?><input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[<?php echo $timestamp; ?>][order]" value="<?php echo $option['order']; ?>" /></td>
			<td><?php
 $schedules = wp_get_schedules(); echo $schedules[$option['schedule']]['display']; ?><input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[<?php echo $timestamp; ?>][schedule]" value="<?php echo $option['schedule']; ?>" /></td>
			<td><?php
 echo date(__('H:i:s, d M Y', $this->text_domain), $timestamp + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ); ?></td>
			<td><input type="button" class="button button-primary" value="<?php echo __('Delete'); ?>" name="delete-schedule" timestamp="<?php echo $timestamp; ?>" /></td>
		</tr>
		<?php
 } $content = ob_get_contents(); ob_end_clean(); return $content; } public function do_cron_scan_post($post_type, $tax_query, $post__in, $offset, $posts_per_page, $post_status, $orderby, $order) { set_time_limit($this->options->timeout); $args = array(); $args['post_type'] = $post_type; if ( !empty($tax_query) ) { $args['tax_query'] = array( 'relation' => 'OR' ); $args['tax_query'] = array_merge($args['tax_query'], $tax_query); } if ($post__in) $args['post__in'] = $post__in; if ($offset) $args['offset'] = $offset; $args['posts_per_page'] = $posts_per_page; $args['post_status'] = $post_status; $args['orderby'] = $orderby; $args['order'] = $order; $args['meta_key'] = 'qqworld-auto-save-images-posts-scanned'; $args['meta_compare'] = 'NOT EXISTS'; $posts = get_posts($args); foreach ($posts as $id => $post) { $content = $post->post_content; $content = $this->content_save_pre($content, $post->ID); wp_update_post(array('ID' => $post->ID, 'post_content' => $content)); } } public function clear_all_schedule_crons() { if (!current_user_can($this->options->authorization)) return; $cleaned = $this->clear_all_crons( 'qqworld-auto-save-images-cron-scan-post' ); if ($cleaned) { $results = array('success' => 1, 'msg' => __('Successfully cleared all Crons.', $this->text_domain)); } else { $results = array('success' => 0, 'msg' => __('No Crons found.', $this->text_domain)); } echo json_encode($results); exit; } public function clear_all_crons($hook) { $crons = _get_cron_array(); if ( empty( $crons ) ) { return; } $cleaned = false; foreach( $crons as $timestamp => $cron ) { if ( ! empty( $cron[$hook] ) ) { unset( $crons[$timestamp][$hook] ); $cleaned = true; } } foreach( $crons as $timestamp => $cron ) { if (empty($cron)) unset($crons[$timestamp]); } _set_cron_array( $crons ); return $cleaned; } public function set_cron_scan_post() { if (!current_user_can($this->options->authorization)) return; $args = $this->get_scan_args($_POST); if (isset($args['tax_query'])) unset($args['tax_query']['relation']); $schedule = $_POST['schedule']; $args['schedule'] = $schedule; $timestamp = time(); $post_type = $args['post_type']; $tax_query = isset($args['tax_query']) && !empty($args['tax_query']) ? $args['tax_query'] : ''; $post__in = isset($args['post__in']) && !empty($args['post__in']) ? $args['post__in'] : ''; $offset = isset($args['offset']) && !empty($args['offset']) ? $args['offset'] : ''; $posts_per_page = $args['posts_per_page']; $post_status = $args['post_status']; $orderby = $args['orderby']; $order = $args['order']; $event_args = array($post_type, $tax_query, $post__in, $offset, $posts_per_page, $post_status, $orderby, $order); wp_schedule_event( $timestamp, $schedule, 'qqworld-auto-save-images-cron-scan-post', $event_args); $schedules = wp_get_schedules(); $timestamp += $schedules[$schedule]['interval']; $options = array( $timestamp => $args ); $results = array( 'success' => 1, 'html' => $this->get_cron_table_row($options), 'args' => $args ); echo json_encode($results); exit; } public function wipe_post_meta($post_id) { delete_post_meta($post_id, 'Original Link'); delete_post_meta($post_id, 'CRC of Original Image'); } public function wipe_attachment_meta($post_id) { delete_post_meta($post_id, '_compressed'); delete_post_meta($post_id, '_sync_aliyun_oss'); delete_post_meta($post_id, '_sync_upyun'); delete_post_meta($post_id, '_sync_qiniu'); delete_post_meta($post_id, '_sync_tencent_cos'); } public function delete_attachment($post_id) { do_action( 'qqworld-auto-save-images-delete-attachment-' . $this->options->optimize_mode, $post_id); } public function image_downsize($downsize, $id, $size) { return apply_filters( 'qqworld-auto-save-images-image-downsize-' . $this->options->optimize_mode, $downsize, $id, $size); } public function wp_get_attachment_url($url, $post_id) { return apply_filters( 'qqworld-auto-save-images-attachment-url-' . $this->options->optimize_mode, $url, $post_id); } public function set_crc_of_attachment($metadata, $attachment_id) { if (in_array($this->type, $this->allowed_image_types)) { $upload_dir = wp_upload_dir(); $file = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . $metadata['file']; $crc = $this->getCrc32($file); update_post_meta($attachment_id, 'CRC of Original Image', $crc); } return $metadata; } public function manage_media_columns( $cols ) { if ($this->options->compression_enabled=='yes') { $cols["compression"] = __("Compression", $this->text_domain); } if ($this->options->optimize_enabled == 'yes') { $cols = apply_filters('qqworld-auto-save-images-manage-media-columns-'.$this->options->optimize_mode, $cols); } return $cols; } public function manage_media_custom_column( $column_name, $id ) { switch ($column_name) { case 'compression': $compressed = get_post_meta($id, '_compressed', true); $mime_type = get_post_mime_type($id); if ( in_array($mime_type, array('image/jpeg')) ) { if ($compressed) { echo '<input type="button" attachment-id="'.$id.'" class="button" name="compress-again" value="'.__('Compress Again', $this->text_domain).'">'; } else { echo '<input type="button" attachment-id="'.$id.'" class="button button-primary" name="compress-it" value="'.__('Compress It', $this->text_domain).'">'; } } else { echo '<p style="color: #ccc;">'; _e('Uncompressible', $this->text_domain); echo '</p>'; } break; } do_action('qqworld-auto-save-images-manage-media-custom-column', $column_name, $id); } public function admin_notices() { $screen = get_current_screen(); if (strstr($screen->id, 'qqworld-auto-save-images')) { settings_errors(); if (!function_exists('curl_init')) add_settings_error('qqworld-auto-save-images', esc_attr('needs_php_lib'), __("Your server PHP does not support cUrl, please remove ';' from in front of extension=php_curl.dll in the php.ini.", $this->text_domain), 'error' ); if (!function_exists('imagecreate')) add_settings_error('qqworld-auto-save-images', esc_attr('needs_php_lib'), __("Your server PHP does not support GD2, please remove ';' from in front of extension=php_gd2.dll in the <strong>php.ini</strong>.", $this->text_domain), 'error' ); if (!function_exists('file_get_contents')) add_settings_error('qqworld-auto-save-images', esc_attr('needs_php_lib'), __('Your server PHP does not support fopen, please set allow_url_fopen=1 in the php.ini.', $this->text_domain), 'error' ); settings_errors('qqworld-auto-save-images'); } } public function get_attachments_list() { if (!current_user_can($this->options->authorization)) return; $mode = $_REQUEST['mode']; $paged = $_REQUEST['paged']; switch ($mode) { case 'compression': $args = array( 'post_type' => 'attachment', 'post_mime_type' => 'image/jpeg', 'meta_key' => '_compressed', 'meta_value' => 1, 'meta_compare' => 'NOT EXISTS', 'posts_per_page' => 1000, 'offset' => 1000*$paged ); break; } $attachments = get_posts($args); switch ($mode) { case 'compression': $success_message = sprintf(_n('%d uncompressed image of attachments found, compressing...', '%d uncompressed images of attachments found, compressing...', count($attachments), $this->text_domain), number_format_i18n(count($attachments))); $failed_message = __('Congratulations, seems like all images attachments had already compressed.', $this->text_domain); break; } if (!empty($attachments)) { $array = array(); foreach ($attachments as $attachment) $array[] = $attachment->ID; $results = array( 'success' => 1, 'msg' => $success_message, 'attachments' => $array ); } else { $results = array( 'success' => 0, 'msg' => $failed_message ); } echo json_encode($results); exit; } public function compress_single_attachment() { if (!current_user_can($this->options->authorization)) return; $attachment_id = $_POST['attachment_id']; $attachment = get_post($attachment_id); $type = $attachment->post_mime_type; $fullsize_path = get_attached_file( $attachment_id ); $file_paths = $this->get_all_thumb_file_full_path($attachment_id, $fullsize_path); $file_paths['full'] = $fullsize_path; $size1 = 0; $size2=0; foreach ($file_paths as $size => $path) { $src = wp_get_attachment_image_src( $attachment_id, $size); $filesize = @filesize($path); $size1 += $filesize; switch ($type) { case 'image/jpeg': $img = @imagecreatefromjpeg($path); if (@imagejpeg($img, $path, $this->options->compression_level)) { $sizes[$size] = array( 'success' => 1, 'src' => $src[0], 'path' => $path, 'filesize1' => $filesize ); } break; } } if (!empty($sizes)) foreach ($sizes as $size => $result) { $filesize = @filesize($result['path']); $size2 += $filesize; $sizes[$size]['filesize2'] = $filesize; } update_post_meta($attachment_id, '_compressed', 1); $msg = sprintf(_n('%d image has been compressed, ', '%d images have been compressed, ', count($sizes), $this->text_domain), number_format_i18n(count($sizes))); $msg .= sprintf(__('Total space saving %s.', $this->text_domain), $this->formatBytes($size1-$size2)); $results = array( 'msg' => $msg, 'sizes' => $sizes ); echo json_encode($results); exit; } public function compress_attachment() { if (!current_user_can($this->options->authorization)) return; $sizes = array(); $attachment_id = $_POST['attachment_id']; $fullsize_path = get_attached_file( $attachment_id ); $file_paths = $this->get_all_thumb_file_full_path($attachment_id, $fullsize_path); $file_paths['full'] = $fullsize_path; $size1 = 0; $size2=0; foreach ($file_paths as $size => $path) { remove_filter( 'upload_dir', array($this, 'upload_dir') ); $src = wp_get_attachment_image_src( $attachment_id, $size); add_filter( 'upload_dir', array($this, 'upload_dir') ); $filesize = @filesize($path); $size1 += $filesize; $img = @imagecreatefromjpeg($path); if (@imagejpeg($img, $path, $this->options->compression_level)) { $sizes[$size] = array( 'success' => 1, 'src' => $src[0], 'path' => $path, 'filesize1' => $filesize ); } } foreach ($sizes as $size => $result) { $filesize = @filesize($result['path']); $size2 += $filesize; $sizes[$size]['filesize2'] = $filesize; } update_post_meta($attachment_id, '_compressed', 1); $msg = sprintf(_n('%d image has been compressed, ', '%d images have been compressed, ', count($sizes), $this->text_domain), number_format_i18n(count($sizes))); $msg .= sprintf(__('Total space saving %s.', $this->text_domain), $this->formatBytes($size1-$size2)); $results = array( 'msg' => $msg, 'sizes' => $sizes ); echo json_encode($results); exit; } public function get_url_headers($url) { $headers = @get_headers($url); if ($headers) { $array = array(); foreach ($headers as $header) { $parts = explode(':', $header); if (count($parts)==2) $array[$parts[0]] = ltrim($parts[1]); } return $array; } return false; } public function smart_grabbing($remote_images, $content) { $pattern = '/<a[^<]+href=\"(.*?)\".*?><img.*?src=\"((?!\").*?)\".*?>?<[^>]+a>/i'; $preg = preg_match_all($pattern, $content, $matches); if ($preg) { if (isset($matches[1]) && isset($matches[2])) { $images_1 = $matches[1]; $images_2 = $matches[2]; foreach ($images_1 as $i => $image_1) { $image_2 = $images_2[$i]; $image_1_header = $this->get_url_headers($image_1); $image_2_header = $this->get_url_headers($image_2); if ( in_array($image_1_header['Content-Type'], $this->allowed_image_types) && in_array($image_2_header['Content-Type'], $this->allowed_image_types)) { if ($this->is_remote_image($image_1) && $this->is_remote_image($image_2)) { $image_1_size = $image_1_header['Content-Length']; $image_2_size = $image_2_header['Content-Length']; $results[$i] = array(); if ($image_1_size > $image_2_size) { $remote_images[] = array('target' => 'href', 'image_url' => $image_1); $pattern_image_url = $this->encode_pattern($image_1); $pattern = '/<a[^<]+href=\"'.$pattern_image_url.'\".*?><img.*?src=\"((?!\").*?)\".*?>?<[^>]+a>/i'; } else { $remote_images[] = array('target' => 'src', 'image_url' => $image_2); $pattern_image_url = $this->encode_pattern($image_2); $pattern = '/<a[^<]+href=\"(.*?)\".*?><img.*?src=\"'.$pattern_image_url.'\".*?>?<[^>]+a>/i'; } $this->temp_content = preg_replace($pattern, '', $this->temp_content); } } } } } return $remote_images; } public function save_remote_images_save_outside_links() { if (!current_user_can($this->options->authorization)) return; $this->_log('Ajax save_outside_links - Start'); if (isset($_POST['id']) && isset($_POST['href'])) { $link = $_POST['href']; $content = '<a href="'.$link.'" target="_blank" rel="nofollow">'.__('Original Link', $this->text_domain).'</a>'; $content = apply_filters('qqworld-auto-save-images-save-outsite-link', $content, $link); $this->_log('Ajax save_outside_links - content: ' . $content); $args = array( 'ID' => $_POST['id'], 'post_content' => $content ); wp_update_post($args); } exit; } public function removeDir($dir) { $it = new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS); $files = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::CHILD_FIRST); foreach($files as $file) { if ($file->isDir()){ rmdir($file->getRealPath()); } else { unlink($file->getRealPath()); } } return rmdir($dir); } public function outside_languages() { __('Michael Wang', $this->text_domain); __('QQWorld Auto Save Images Pro', $this->text_domain); __(' (In Development)', $this->text_domain); } public function manual_save_remote_images() { set_time_limit($this->options->timeout); if ( !current_user_can( $this->options->authorization ) ) return; if (isset($_REQUEST['mode'])) switch ($_REQUEST['mode']) { case 'get-remote-images-list': $post_id = $_REQUEST['post_id']; $this->post_id = $post_id; $this->current_post_id = $post_id; $content = $this->utf8_urldecode($this->utf8_urldecode($_REQUEST['content'])); $result = array(); if ( $remote_images = $this->content_save_pre($content, null, 'get-remote-images-list')) { foreach ($remote_images as $remote_image) { $target = $remote_image['target']; $image_url = $remote_image['image_url']; if ($this->options->only_save_first != 'all' && $this->count++ > $this->options->only_save_first) continue; if ($this->is_remote_image($image_url)) { $result[] = $remote_image; } } } elseif (!empty($post_id)) $this->automatic_set_featured_pic_from_media_library($post_id); echo json_encode($result); break; case 'print-remote-images-list': ?>
				<ul id="remote-images-list"></ul>
				<script>jQuery('#remote-images-list').html(QASI.results);QQWorld_Auto_Save_Image.manual_obj.action.when_tb_show.init();</script>
				<?php break; case 'save-remote-images-list': $post_id = $_REQUEST['post_id']; $this->post_id = $post_id; $this->current_post_id = $post_id; $image_url = $this->utf8_urldecode($_REQUEST['image_url']); $target = $_REQUEST['target']; $title = $_REQUEST['title']; $alt = $_REQUEST['alt']; $style = $_REQUEST['style']; $args = array('alt'=>$alt, 'title'=>$title, 'style' => $style); if ($res = $this->save_images( $image_url, $post_id, $args )) { $this->_log('Manual save-remote-images-list: res: ' . print_r($res, true)); if ($this->options->optimize_mode == 'ftp') $res['status'] = 1; if (isset($res['id'])) { $attachment_id = $res['id']; $status = 1; if ($alt) { update_post_meta($attachment_id, '_wp_attachment_image_alt', $alt); $res['alt'] = $alt; } if ($title) { $attachment = array( 'ID' => $attachment_id, 'post_title' => $title ); wp_update_post($attachment); $res['title'] = $title; } $res['permalink'] = get_permalink($attachment_id); update_post_meta($attachment_id, 'Original Link', $image_url); $res['status'] = 1; do_action( 'qqworld-auto-save-images-after-save-image', $res); do_action( 'qqworld-auto-save-images-after-save-image-'.$this->options->optimize_mode, $res); } elseif (is_array($res) && $res['code']==self::NEED_DELETED) { $res['status'] = 2; } elseif (is_array($res) && $res['code']==self::NEED_IGNORED) { $res['status'] = 3; } elseif (is_array($res) && $res['code']==self::NO_MEDIA_LIBRARY) { $res['status'] = 1; } } else { $res['status'] = 0; } $res['image_url'] = $image_url; $res['target'] = $target; $res['style'] = $style; echo json_encode($res); break; case 'save-post-content': $post_id = $_POST['post_id']; $this->post_id = $post_id; $failed = $_POST['failed']; $this->images_id_of_post = $_POST['attachment_ids']; if ($failed == 0) update_post_meta($post_id, 'qqworld-auto-save-images-posts-scanned', 'yes'); $content = $this->utf8_urldecode($this->utf8_urldecode($_POST['content'])); $content = apply_filters( 'qqworld-auto-save-images-content-save-pre', $content, $post_id ); if (preg_match('/=http(.*?)&/', $content, $match)) { $content = str_replace($match[1], urlencode($match[1]), $content); } $post = array( 'ID' => $post_id, 'post_content' => addslashes($content) ); $result = array( "content" => $content ); $result['status'] = wp_update_post($post); if (has_post_thumbnail($post_id)) { $featured_image_id = get_post_thumbnail_id($post_id); $result['featured_image_id'] = $featured_image_id; $result['featured_image'] = wp_get_attachment_image_src($featured_image_id, array(300,300)); $result['featured_image_desc'] = '<p class="hide-if-no-js howto" id="set-post-thumbnail-desc">'.__('Click the image to edit or update').'</p><p class="hide-if-no-js"><a href="#" id="remove-post-thumbnail">'._x('Remove featured image', 'post').'</a></p>'; } echo json_encode($result); break; } exit; } public function wp_handle_upload_prefilter($file) { $image_path = $file['tmp_name']; $this->type = $file['type']; $this->_log("The new file uploaded, file: ". print_r($file, true)); if (in_array($this->type, $this->allowed_image_types)) { if ($this->options->compression_enabled=='yes') { $fp = fopen($image_path, "r"); $stream = fread($fp, filesize($image_path)); fclose($fp); $image = $this->compress_image($stream); $fp = fopen($image_path, "wb"); fwrite($fp, $image); fclose($fp); } if ( preg_match('/(.*?)\.(jpg|jpeg|png|gif)$/i', $file['name'], $match) ) { $name = $match[1]; $extension = $match[2]; } else { $name = md5($image_path); $extension = $this->get_extension_from_type($this->type); } $this->_log("Before auto change file name when upload image, name: {$name}, extension: {$extension}"); $file['name'] = $this->change_images_filename($name, $extension); } else { if ($this->options->special_handle_attacment_filename_enabled == 'yes') { $extension = preg_match('/\.[^\.]*?$/i', $file['name'], $match) ? $match[0] : ''; $name = preg_replace('/\.[^\.]*?$/i', '', $file['name']); $file['name'] = apply_filters('qqworld-auto-save-images-custom-filename-structure', $name, $this->options->special_handle_attacment_filename_structure) . $extension; } } return $file; } public function get_extension_from_type($type) { switch ($type) { case 'image/jpeg': case 'image/jpg': return 'jpg'; break; case 'image/png': return 'png'; break; case 'image/gif': return 'gif'; break; } } public function save_remote_images_get_categories_list() { if (isset($_REQUEST['posttype']) && !empty($_REQUEST['posttype'])) { $posttype = $_REQUEST['posttype']; $taxonomies = get_object_taxonomies($posttype); if (!empty($taxonomies)) foreach ($taxonomies as $tax) { $taxonomy = get_taxonomy($tax); echo '<div id="'.$tax.'div" post-type="'.$tax.'" class="postbox"><div class="hndle">'.$taxonomy->labels->name.'</div><div class="inside"><div id="'.$tax.'-all" class="tabs-panel"><ul>'; wp_terms_checklist('', array( 'taxonomy' => $tax, 'walker' => new Walker_Category_Checklist )); echo '</ul></div></div></div>'; } else _e('No taxonomies found.', $this->text_domain); } exit; } public function post_updated_messages($messages) { global $post, $post_ID; $post_type = get_post_type( $post_ID ); $messages[$post_type][21] = __('All remote images have been saved.', $this->text_domain) . sprintf( __(' <a href="%s">View</a>', $this->text_domain), esc_url( get_permalink($post_ID) ) ); $messages[$post_type][22] = __('Has missing images or image which could not download.', $this->text_domain) . sprintf( __(' <a href="%s">View</a>', $this->text_domain), esc_url( get_permalink($post_ID) ) ); return $messages; } public function redirect_post_location($location, $post_id) { if ($this->has_remote_image) { if ($this->has_missing_image) $location = add_query_arg( 'message', 22, get_edit_post_link( $post_id, 'url' ) ); else $location = add_query_arg( 'message', 21, get_edit_post_link( $post_id, 'url' ) ); } return $location; } public function admin_enqueue_scripts() { global $post; $default_translation_array = array( 'yes' => __('Yes'), 'no' => __('No'), 'format' => $this->options->format, 'keep_style' => $this->options->keep_style, 'keep_outside_links' => $this->options->keep_outside_links, 'auto_caption' => $this->options->auto_caption, 'align_to_enabled' => $this->options->format_align_to_enabled, 'align_to' => $this->options->format_align_to, 'width_height' => $this->options->change_width_height, 'speed_for_manual_mode' => $this->options->speed_for_manual_mode ); if ( $this->options->mode == 'manual' && ($GLOBALS['hook_suffix'] == 'post.php' || $GLOBALS['hook_suffix'] == 'post-new.php') ) { wp_enqueue_script('jquery-effects-core'); wp_enqueue_script('jquery-effects-shake'); wp_register_style('qqworld-auto-save-images-style', QQWORLD_COLLECTOR_URL . 'css/manual.css' ); wp_enqueue_style('qqworld-auto-save-images-style'); wp_deregister_style('animate'); wp_register_style('animate', QQWORLD_COLLECTOR_URL . 'css/animate-min.css' ); wp_enqueue_style('animate'); wp_register_script('noty', QQWORLD_COLLECTOR_URL . 'js/noty/noty.min.js', array('jquery'), '3.1.0', true ); wp_enqueue_script('noty'); wp_register_style('noty', QQWORLD_COLLECTOR_URL . 'js/noty/noty.css' ); wp_enqueue_style('noty'); wp_register_script('qqworld-md5', QQWORLD_COLLECTOR_URL . 'js/md5.js' ); wp_enqueue_script('qqworld-md5'); wp_register_script('qqworld-pwd', QQWORLD_COLLECTOR_URL . 'js/pwd.min.js'); wp_enqueue_script('qqworld-pwd'); wp_register_script('qqworld-auto-save-images-script-post', QQWORLD_COLLECTOR_URL . 'js/manual.js', array('jquery') ); wp_enqueue_script('qqworld-auto-save-images-script-post'); $translation_array = array( 'qasiprocode' => $this->options->activation_code, 'in_processing' => __('In processing.', $this->text_domain), 'product' => $this->product, 'timeout' => __('Download Timeout, please set the timeout option that in optimization settings page to a longger time.', $this->text_domain), 'successfully_saved' => __('Successfully saved.', $this->text_domain), 'successfully_deleted' => __('Successfully deleted.', $this->text_domain), 'successfully_ignored' => __('Successfully ignored.', $this->text_domain), 'failed_saved' => __('Failed saved.', $this->text_domain), 'no_remote_images_found' => __('No remote images found.', $this->text_domain), 'all_remote_images_saved' => __('All remote images have been saved.<br />And the post content has been updated, no need to update again.', $this->text_domain), 'portion_of_remote_images_saved' => __('Portion of remote images have been saved.<br />And the post content has been updated, no need to update again.', $this->text_domain), 'all_remote_images_saved_failed' => __('All remote images saved failed.', $this->text_domain), 'all_remote_images_canceled' => __("All remote images have been canceled, what are you doing?", $this->text_domain), 'save_remote_images_you_selected' => __("Save remote images you've selected", $this->text_domain), 'please_check_remote_images' => __('Please Check Remote Images', $this->text_domain), 'remote_images_not_checked' => __('Are you sure?<br />Remote images not checked will be deleted.', $this->text_domain), 'error' => __('Something error, please check.', $this->text_domain), 'additional_content_after' => $this->options->additional_content['after'], 'minimum_picture_size' => $this->options->minimum_picture_size, 'minimum_picture_size_auto_delete' => $this->options->minimum_picture_size_auto_delete, 'smart_wipe_html_tags' => $this->options->smart_wipe_html_tags, 'smart_wipe_attributes' => $this->options->smart_wipe_attributes, 'delete_missing_images' => $this->options->delete_missing_images, 'edit' => __('Edit'), 'exclude_image' => __('Add this image to list of Exclude-CRC.', $this->text_domain), 'delete_image' => __('Add this image to list of Delete-CRC.', $this->text_domain), 'close' => __('Close'), 'manual_list_title' => __('Title (title)', $this->text_domain), 'manual_list_alt' => __('Alternative Text (alt)', $this->text_domain), 'your_sure_add_to_blacklist' => __('Are you sure to add this image to blacklist?', $this->text_domain), 'successed_add_image_to_blacklist' => __('This image has been successfully added to the blacklist!', $this->text_domain), 'failed_add_image_to_blacklist' => __('This image can not be added to the blacklist!<br />Undownloadable or not exists?', $this->text_domain) ); $translation_array = array_merge($default_translation_array, $translation_array); $translation_array = apply_filters( 'qqworld-auto-save-images-manual-mode-translation-array', $translation_array); wp_localize_script('qqworld-auto-save-images-script-post', 'QASI', $translation_array, '3.0.0'); } if ( preg_match('/qqworld-(collector|auto-save-images|collector-watermark|cloud-storage|collector-optimization|collector-database|collector-translation).*?$/i', $GLOBALS['hook_suffix'], $matche) ) { wp_deregister_style('animate'); wp_register_style('animate', QQWORLD_COLLECTOR_URL . 'css/animate-min.css' ); wp_enqueue_style('animate'); wp_register_script('noty', QQWORLD_COLLECTOR_URL . 'js/noty/noty.min.js', array('jquery'), '3.1.0', true ); wp_enqueue_script('noty'); wp_register_style('noty', QQWORLD_COLLECTOR_URL . 'js/noty/noty.css' ); wp_enqueue_style('noty'); wp_register_style('qqworld-auto-save-images-style', QQWORLD_COLLECTOR_URL . 'css/admin.css' ); wp_enqueue_style('qqworld-auto-save-images-style'); wp_enqueue_script('wp-pointer'); wp_enqueue_style('wp-pointer'); wp_enqueue_script('jquery-ui-draggable'); wp_enqueue_script('jquery-effects-core'); wp_enqueue_script('jquery-effects-shake'); wp_register_script('qqworld-auto-save-images-script', QQWORLD_COLLECTOR_URL . 'js/admin.js', array('jquery') ); wp_enqueue_script('qqworld-auto-save-images-script'); wp_register_script('qqworld-md5', QQWORLD_COLLECTOR_URL . 'js/md5.js', array('qqworld-auto-save-images-script') ); wp_enqueue_script('qqworld-md5'); wp_register_script('qqworld-pwd', QQWORLD_COLLECTOR_URL . 'js/pwd.min.js', array('qqworld-auto-save-images-script') ); wp_enqueue_script('qqworld-pwd'); wp_enqueue_media(); $translation_array = array( 'domain' => $_SERVER['HTTP_HOST'], 'activation_code' => $this->options->activation_code, 'version' => $this->plugin['Version'], 'product' => $this->product, 'qasiprocode' => $this->options->activation_code, 'close' => __('Close'), 'expired_in' => __('Trial expires in %D% days %H% hours %I% minutes %S% seconds.', $this->text_domain), 'unable_access_update_server' => __('Unable to access update server, please contact plugin author.', $this->text_domain), 'your_sure' => __('Are you sure?', $this->text_domain), 'are_your_sure' => __('Are you sure?<br />Before you click the yes button, I recommend backup site database.', $this->text_domain), 'pls_select_post_types' => __('Please select post types.', $this->text_domain), 'maybe_problem' => __('May be a problem with some posts: ', $this->text_domain), 'no_need_enter_' => __("No need enter \"%s\".", $this->text_domain), 'n_post_has_been_scanned' => __( '%d post has been scanned.', $this->text_domain), 'n_posts_have_been_scanned' => __( '%d posts have been scanned.', $this->text_domain), 'n_post_included_remote_images_processed' => __( '%d post included remote images processed.', $this->text_domain), 'n_posts_included_remote_images_processed' => __( '%d posts included remote images processed.', $this->text_domain), 'n_post_has_missing_images_couldnt_be_processed' => __( "%d post has missing images couldn't be processed.", $this->text_domain), 'n_posts_have_missing_images_couldnt_be_processed' => __( "%d posts have missing images couldn't be processed.", $this->text_domain), 'found_n_post_including_remote_images' => __( 'found %d post including remote images.', $this->text_domain), 'found_n_posts_including_remote_images' => __( 'found %d posts including remote images.', $this->text_domain), 'and_with_n_post_has_missing_images' => __( "And with %d post has missing images.", $this->text_domain), 'and_with_n_posts_have_missing_images' => __( "And with %d posts have missing images.", $this->text_domain), 'no_posts_processed' => __( "No posts processed.", $this->text_domain), 'no_post_has_remote_images_found' => __('No post has remote images found.', $this->text_domain), 'no_posts_found' => __('No posts found.', $this->text_domain), 'all_done' => __('All done.', $this->text_domain), 'scanning' => __('Scanning...', $this->text_domain), 'listing' => __('Listing...', $this->text_domain), 'id' => __('ID'), 'post_type' => __('Post Type', $this->text_domain), 'title' => __('Title'), 'status' => __('Status'), 'control' => __('Control', $this->text_domain), 'done' => __('Done'), 'delete' => __('Delete'), 'string' => __('String', $this->text_domain), 'array' => __('Array', $this->text_domain), 'field_name' => __('Field Name', $this->text_domain), 'array_key' => __('If array, please enter the array key of image url. such as "[attachment]"', $this->text_domain), 'scanned_n_attachment' => __('<strong id="scan-results">0</strong> attachments have been scanned.', $this->text_domain), 'scan_completed' => __('Scan completed.', $this->text_domain), 'error' => __('Something error, please check.', $this->text_domain), 'congratulations_all_compressed' => __('Congratulations, seems like all images attachments had already compressed.', $this->text_domain), 'successfull_scheduled_single_event' => __('Successfull Scheduled Event.', $this->text_domain), 'successfully_accessed' => __('Successfully Accessed.', $this->text_domain), 'successfully_synced' => __('Successfully Synced.', $this->text_domain), 'access_failed' => __('Access Failed.', $this->text_domain), 'successfully_created' => __('Successfully Created.', $this->text_domain), 'successfully_deleted' => __('Successfully Deleted.', $this->text_domain), 'clean_cache_successfully' => __('Successfully Cleaned Cache.', $this->text_domain), 'there_are_x_files_to_sync' => __('There are %s files to sync.', $this->text_domain), 'all_files_has_been_synced' => __('All files has been successfully synced.', $this->text_domain), 'length_out_of_range' => __('Length out of range.', $this->text_domain), 'nonstandard_naming' => __('Nonstandard naming.', $this->text_domain), 'please_enter_source_replacement' => __('Please enter Source Text.', $this->text_domain), 'translated_successfully' => __('Translated successfully.', $this->text_domain), 'are_u_sure_restore' => __('Are you sure to restore all attachments?', $this->text_domain), 'no_need_wait' => __('You can close the window, no need to waiting.', $this->text_domain), 'are_u_sure_delete_duplicated_posts' => __('Are you sure to delete duplicated posts?', $this->text_domain), ); $translation_array = apply_filters( 'qqworld-auto-save-images-admin-translation-array', $translation_array); $translation_array = array_merge($default_translation_array, $translation_array); wp_localize_script('qqworld-auto-save-images-script', 'QASI', $translation_array, '3.0.0'); } if ( preg_match('/(collection-projects|collected-posts|collection-settings).*?$/i', $GLOBALS['hook_suffix'], $matche) ) { wp_register_style('qqworld-auto-save-images-style', QQWORLD_COLLECTOR_URL . 'css/admin.css' ); wp_enqueue_style('qqworld-auto-save-images-style'); } $screen = get_current_screen(); if ($screen->base == 'upload') { wp_register_script('noty', QQWORLD_COLLECTOR_URL . 'js/noty/noty.min.js', array('jquery'), '3.1.0', true ); wp_enqueue_script('noty'); wp_register_style('noty', QQWORLD_COLLECTOR_URL . 'js/noty/noty.css' ); wp_enqueue_style('noty'); wp_register_script('upload_php', QQWORLD_COLLECTOR_URL . 'js/upload_php.js', array('jquery') ); wp_enqueue_script('upload_php'); $translation_array = array( 'error' => __('Something error, please check.', $this->text_domain) ); $translation_array = array_merge($default_translation_array, $translation_array); wp_localize_script('upload_php', 'QASI', $translation_array, '3.0.0'); } $collected = get_option('_website_qc_flag'); $collected = !empty($collected) ? 1 : 0; $translation_array = array( 'jquery_enabled' => $collected ); wp_localize_script('jquery', 'QCC', $translation_array, '3.0.0'); } public function get_scan_args($postdata=null) { if (!$postdata) $postdata = $_REQUEST; $args = array(); $post_types = isset($postdata['qqworld-auto-save-images-post-types']) ? $postdata['qqworld-auto-save-images-post-types'] : 'post'; $args['post_type'] = $post_types; if (isset($postdata['terms']) && !empty($postdata['terms'])) { $terms = $postdata['terms']; $args['tax_query'] = array( 'relation' => 'OR' ); foreach ($terms as $taxonomy => $term_ids) { $args['tax_query'][] = array( 'taxonomy' => $taxonomy, 'terms' => $term_ids, 'field' => 'id' ); } } $id_from = $postdata['id_from']; $id_to = $postdata['id_to']; $id_from = $id_from=='0' ? 1 : $id_from; $id_to = $id_to=='0' ? 1 : $id_to; $post__in = array(); if (!empty($id_from) && is_numeric($id_from) && empty($id_to)) { $post__in[] = $id_from; } elseif (empty($id_from) && !empty($id_to) && is_numeric($id_to)) { $post__in[] = $id_to; } elseif (!empty($id_from) && is_numeric($id_from) && !empty($id_to) && is_numeric($id_to)) { if ($id_from == $id_to) $post__in[] = $id_from; elseif ($id_from < $id_to) for ($s=$id_from; $s<=$id_to; $s++) $post__in[]=$s; elseif($id_from > $id_to) for ($s=$id_from; $s>=$id_to; $s--) $post__in[]=$s; } $args['post__in'] = $post__in; if ( isset($postdata['offset']) ) { $args['offset'] = $postdata['offset']; $args['posts_per_page'] = $postdata['posts_per_page']; } else { $args['posts_per_page'] = $postdata['speed']; } $args['order'] = $postdata['order']; $args['post_status'] = $postdata['post_status']; $args['orderby'] = $postdata['orderby']; $args['paged'] = $postdata['page']; if ( !isset($postdata['force-scan']) ) { $args['meta_key'] = 'qqworld-auto-save-images-posts-scanned'; $args['meta_compare'] = 'NOT EXISTS'; } return $args; } public function get_scan_list() { global $wp_query; if ( !current_user_can( $this->options->authorization ) ) return; $args = $this->get_scan_args($_REQUEST); query_posts($args); $result = array( 'page' => $_REQUEST['page'], 'max_num_pages' => $wp_query->max_num_pages, 'ids' => array() ); while ( have_posts() ) { the_post(); array_push( $result['ids'], get_the_ID() ); } echo json_encode($result); wp_reset_query(); exit; } public function save_remote_images_after_scan() { set_time_limit($this->options->timeout); if ( !current_user_can( $this->options->authorization ) ) return; $post_ids = $_REQUEST['post_id']; if (!empty($post_ids)) foreach ($post_ids as $post_id) : $this->_log('Starting scan post with id: ' . $post_id); $this->has_remote_image = 0; $this->has_missing_image = 0; $post = get_post($post_id); $post_id = $post->ID; $post_type = $post->post_type; $content = $post->post_content; $title = $post->post_title; $content = $this->content_save_pre($content, $post_id); $post_type_object = get_post_type_object($post_type); if ($this->has_remote_image) : $class = 'has_remote_images'; if ($this->has_missing_image) $class .= ' has_not_exits_remote_images'; $class = ' class="' . $class . '"'; ?>
			<tr<?php echo $class; ?>>
				<td><?php echo $post_id; ?></td>
				<td><?php echo $post_type_object->labels->name; ?></td>
				<td><a href="<?php echo get_edit_post_link($post_id); ?>" target="_blank"><?php echo $title; ?> &#8667;</a></td>
				<td><?php echo $this->has_missing_image ? '<span class="red">'.__('Has missing images.', $this->text_domain).'</span>' : '<span class="green">'.__('All remote images have been saved.', $this->text_domain).'</span>'; ?></td>
			</tr>
<?php else: ?>
			<tr>
				<td colspan="4" class="hr"></td>
			</tr>
<?php	 endif; wp_update_post(array('ID' => $post_id, 'post_content' => $content)); endforeach; exit; } public function save_remote_images_list_all_posts() { set_time_limit($this->options->timeout); if ( !current_user_can( $this->options->authorization ) ) return; $post_ids = $_REQUEST['post_id']; if (!empty($post_ids)) foreach ($post_ids as $post_id) : $this->has_remote_image = 0; $this->has_missing_image = 0; $post = get_post($post_id); $post_id = $post->ID; $post_type = $post->post_type; $content = $post->post_content; $title = $post->post_title; $content = $this->content_save_pre($content, $post_id, 'get-remote-images-list'); if ($this->has_remote_image) : $post_type_object = get_post_type_object($post_type); $class = $this->has_missing_image ? ' has_not_exits_remote_images' : ''; ?>
			<tr class="has_remote_images<?php echo $class; ?>">
				<td><?php echo $post_id; ?></td>
				<td><?php echo $post_type_object->labels->name; ?></td>
				<td><a href="<?php echo get_edit_post_link($post_id); ?>" target="_blank"><?php echo $title; ?> &#8667;</a></td>
				<td><?php echo $this->has_missing_image ? '<span class="red">'.__('Has missing images.', $this->text_domain).'</span>' : __('Normal', $this->text_domain); ?></a></td>
				<td id="list-<?php echo $post_id; ?>"><input type="button" post-id="<?php echo $post_id; ?>" class="fetch-remote-images button button-primary" value="&#9997; <?php _e('Fetch', $this->text_domain); ?>" /></td>
			</tr>
<?php else: ?>
			<tr>
				<td colspan="5" class="hr"></td>
			</tr>
<?php	 endif; endforeach; exit; } public function media_buttons() { if ( isset($GLOBALS['hook_suffix']) && ($GLOBALS['hook_suffix'] == 'post.php' || $GLOBALS['hook_suffix'] == 'post-new.php') ) { ?>
		<a href="javascript:" id="save-remote-images-button" class="button save_remote_images" title="<?php _e('Save Remote Images', $this->text_domain); ?>"><span class="wp-media-buttons-icon"></span><?php _e('Save Remote Images', $this->text_domain); ?></a>
	<?php
 do_action( 'qqworld-collector-add-media-buttons-for-menual-mode' ); } } function registerPluginLinks($links, $file) { $base = plugin_basename(__FILE__); if ($file == $base) { $links[] = '<a href="' . menu_page_url( 'qqworld-auto-save-images', 0 ) . '">' . __('Settings') . '</a>'; } return $links; } function admin_menu() { $parent_slug = 'qqworld-collector'; $capability = 'administrator'; $page_title = __('Auto Save Images', $this->text_domain); $menu_title = $page_title; $menu_slug = 'qqworld-auto-save-images'; $function = $this->is_activate('pro') ? array($this, 'auto_save_images_page') : array($this, 'activation_page'); $settings_page = add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function); $page_title = __('Watermark', $this->text_domain); $menu_title = $page_title; $menu_slug = 'qqworld-collector-watermark'; $function = $this->is_activate('pro') ? array($this->watermark, 'watermark_page') : array($this, 'activation_page'); $settings_page = add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function); add_action( "load-{$settings_page}", array($this, 'help_tab') ); $page_title = __('Optimization', $this->text_domain); $menu_title = $page_title; $menu_slug = 'qqworld-collector-optimization'; $function = $this->is_activate('pro') ? array($this, 'optimization_page') : array($this, 'activation_page'); $settings_page = add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function); add_action( "load-{$settings_page}", array($this, 'help_tab') ); } function auto_save_images_page() { ?>
<div class="wrap">
	<h2 id="header-title"><?php _e("Auto Save Images", $this->text_domain); ?></h2>
	<p><?php _e('Automatically keep the all remote picture to the local, and automatically set featured image.', $this->text_domain); ?></p>
	<form action="options.php" method="post" id="form">
		<?php settings_fields('qqworld-auto-save-images-settings'); ?>
		<ul id="qqworld-auto-save-images-tabs" class="qqworld-collector-tabs">
			<li class="current"><?php _e('General', $this->text_domain); ?></li>
			<li><?php _e('Filter', $this->text_domain); ?></li>
			<li><?php _e('Format', $this->text_domain); ?></li>
			<li><?php _e('Scan Posts', $this->text_domain); ?></li>
			<li id="cron-tab"><?php _e('Cron', $this->text_domain); ?></li>
		</ul>
		<div class="tab-content">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label><?php _e('Mode', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Mode', $this->text_domain); ?></span></legend>
								<label for="auto">
									<input name="qqworld-auto-save-images-mode" type="radio" id="auto" value="auto" <?php checked('auto', $this->options->mode); ?> />
									<?php _e('Automatic', $this->text_domain); ?>
								</label> <span class="icon help" data-header="<?php _e('Mode', $this->text_domain); ?>" data-content="<?php _e('Automatically save all remote images to local media libary when you save or publish post.', $this->text_domain); ?>"></span><br />
								<label for="manual">
									<input name="qqworld-auto-save-images-mode" type="radio" id="manual" value="manual" <?php checked('manual', $this->options->mode); ?> />
									<?php _e('Manual', $this->text_domain); ?>
								</label> <span class="icon help" data-header="<?php _e('Mode', $this->text_domain); ?>" data-content="<?php _e('Manually save all remote images to local media libary when you click the button on the top of editor.', $this->text_domain); ?>"></span>
						</fieldset></td>
					</tr>
					
					<tr id="second_level" valign="top"<?php if ($this->options->mode != 'auto') echo ' style="display: none;"'; ?>>
						<th scope="row"><label><?php _e('When', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('When', $this->text_domain); ?>" data-content="<?php _e('Select the post statuses you want to grab remote images.', $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('When', $this->text_domain); ?></span></legend>
								<?php
 global $wp_post_statuses; $checkboxes = array(); foreach ($wp_post_statuses as $slug => $status) { if (!in_array($slug, array('auto-draft', 'inherit', 'trash'))) { $checked = in_array($slug, $this->options->when) ? ' checked' : ''; $checkboxes[] = '<label><input type="checkbox" name="qqworld-auto-save-images-when[]" value="'.$slug.'" '.$checked.' /> '.$status->label . '</label>'; } } echo implode('<br />', $checkboxes); ?>
						</fieldset></td>
					</tr>

					<tr valign="top">
						<th scope="row"><label><?php _e('Schedule Publish', $this->text_domain); ?></label> <span class="icon help"  data-header="<?php _e('Schedule Publish', $this->text_domain); ?>" data-content="<?php _e("Save remote images via Schedule Publish.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Schedule Publish', $this->text_domain); ?></span></legend>
								<label for="qqworld-auto-save-images-schedule-publish">
									<input name="qqworld-auto-save-images-schedule-publish" type="checkbox" id="qqworld-auto-save-images-schedule-publish" value="yes" <?php checked('yes', $this->options->schedule_publish); ?> />
								</label>
						</fieldset></td>
					</tr>


					<tr valign="top">
						<th scope="row"><label for="remote_publishing"><?php _e('Remote Publishing', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Remote Publishing', $this->text_domain); ?>" data-content="<?php _e("Save remote images via remote publishing from IFTTT or other way using XMLRPC. Only supports publish post.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Remote Publishing', $this->text_domain); ?></span></legend>
								<label for="qqworld-auto-save-images-remote-publishing">
									<input name="qqworld-auto-save-images-remote-publishing" type="checkbox" id="remote_publishing" value="yes" <?php checked('yes', $this->options->remote_publishing); ?> />
								</label>
						</fieldset></td>
					</tr>

					<tr valign="top">
						<th scope="row"><label for="set_featured_image"><?php _e('Set Featured Image', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Set Featured Image', $this->text_domain); ?>" data-content="<?php _e("Set first one of the remote images as featured image.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Set Featured Image', $this->text_domain); ?></span></legend>
								<label for="qqworld-auto-save-images-set-featured-image-yes">
									<input name="qqworld-auto-save-images-set-featured-image" type="checkbox" id="qqworld-auto-save-images-set-featured-image-yes" value="yes" <?php checked('yes', $this->options->featured_image); ?> />
								</label>
								<?php printf(__('Set No. %s photo as featured image', $this->text_domain), '<input type="number" min="1" class="small-text" name="qqworld-auto-save-images-set-featured-image-index" value="'.$this->options->featured_image_index.'" />'); ?>
						</fieldset></td>
					</tr>

					<tr valign="top">
						<th scope="row"><label for="upload-default-featured-image"><?php _e('Default Featured Image', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Default Featured Image', $this->text_domain); ?>" data-content="<?php _e("If no images in post, set a default image as featured image. leave empty to not use default image.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Default Featured Image', $this->text_domain); ?></span></legend>
							<label for="watermark-image">
								<a href="javascript:" id="upload-default-featured-image" class="upload-default-featured-image" data-button="<?php _e('Insert Image', $this->text_domain); ?>" title="<?php _e('Change a default Featured Image', $this->text_domain); ?>">
									<?php
 if ($this->options->default_featured_image) : echo wp_get_attachment_image($this->options->default_featured_image, 'thumbnail'); endif; ?>
								</a>
								<input name="qqworld-auto-save-images-default-featured-image" id="watermark-image" type="hidden" title="" value="<?php echo $this->options->default_featured_image; ?>" />
							</label>
							<input type="button" class="button upload-default-featured-image<?php if ($this->options->default_featured_image) echo ' hidden'; ?>" value="<?php _e('Upload Default Featured Image', $this->text_domain); ?>" title="<?php _e('Upload Default Featured Image', $this->text_domain); ?>" data-button="<?php _e('Insert Image', $this->text_domain); ?>" />
							<input type="button" class="button<?php if (!$this->options->default_featured_image) echo ' hidden'; ?>" id="remove-default-featured-image" value="<?php _e('Remove Default Featured Image', $this->text_domain); ?>" />
						</fieldset></td>
					</tr>

					<tr valign="top">
						<th scope="row"><label for="qqworld-auto-save-images-flip-horizontal-image-yes"><?php _e('Flip Horizontal Image', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Flip Horizontal Image', $this->text_domain); ?>" data-content="<?php _e("You know it.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Flip Horizontal Image', $this->text_domain); ?></span></legend>
								<label for="qqworld-auto-save-images-flip-image-yes">
									<input name="qqworld-auto-save-images-flip-horizontal-image" type="checkbox" id="qqworld-auto-save-images-flip-horizontal-image-yes" value="yes" <?php checked('yes', $this->options->flip_horizontal_image); ?> />
								</label>
						</fieldset></td>
					</tr>

					<tr valign="top">
						<th scope="row"><label for="qqworld-auto-save-images-no-media-library-yes"><?php _e('No Media Library', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('No Media Library', $this->text_domain); ?>" data-content="<?php _e("(Not recommended!) Remote images will no be saved into media library, it means would not generate thumbnail. but if you checked Set-Featured-Image, the first remote image will be saved into media library.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('No Media Library', $this->text_domain); ?></span></legend>
								<label for="qqworld-auto-save-images-no-media-library-yes">
									<input name="qqworld-auto-save-images-no-media-library" type="checkbox" id="qqworld-auto-save-images-no-media-library-yes" value="yes" <?php checked('yes', $this->options->no_media_library); ?> />
								</label>
						</fieldset></td>
					</tr>

					<tr valign="top">
						<th scope="row"><label for="qqworld-auto-save-images-watermark-default-value"><?php _e('Watermark Default Value', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Watermark Default Value', $this->text_domain); ?>" data-content="<?php _e("If you enabled watermark, a watermark switcher will be displayed on edit page, and set this default value.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Watermark Default Value', $this->text_domain); ?></span></legend>
								<label for="qqworld-auto-save-images-watermark-default-value">
									<select name="qqworld-auto-save-images-watermark-default-value">
										<option value="1" <?php selected(1, $this->options->watermark_default_value); ?>><?php _ex('Enabled', 'watermark', $this->text_domain); ?></option>
										<option value="0" <?php selected(0, $this->options->watermark_default_value); ?>><?php _e('Disabled', $this->text_domain); ?></option>
									</select>
								</label>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
			<?php do_action('qqworld-auto-save-images-general-options-form'); ?>
			<h2><?php _e('Debug Option', $this->text_domain); ?></h2>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="debup-auto-save-images"><?php _e('Debug', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Debug', $this->text_domain); ?>" data-content="<?php _e("Log: ".$this->log_path, $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Debug', $this->text_domain); ?></span></legend>
								<label for="qqworld-auto-save-images-remote-publishing">
									<input name="qqworld-auto-save-images-debug" type="checkbox" id="debug-auto-save-images" value="yes" <?php checked('yes', $this->options->debug); ?> /> <?php _e('Enabled', $this->text_domain); ?>
								</label>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</div>
		<div class="tab-content hidden">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="only_save_first"><?php _e('Grabbing from Each Posts', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Grabbing from Each Posts', $this->text_domain); ?></span></legend>
								<select id="only_save_first" name="qqworld-auto-save-images-only-save-first">
									<option value="all" <?php selected('all', $this->options->only_save_first); ?>><?php _e('All Images', $this->text_domain); ?></option>
									<?php
 for ($i=1; $i<=30; $i++) { $selected = selected($i, $this->options->only_save_first, false); echo '<option value="' . $i . '" '.$selected.'>' . sprintf(_n('First %d image only', 'First %d images only', $i, $this->text_domain), number_format_i18n($i)) . '</option>'; } ?>
								</select>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Minimum Picture Size', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Minimum Picture Size', $this->text_domain); ?>" data-content="<?php _e("Ignore smaller than this size picture.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Minimum Picture Size', $this->text_domain); ?></span></legend>
								<label for="qqworld-auto-save-images-minimum-picture-size-width">
									<?php _e('Width:', $this->text_domain); ?> <input name="qqworld-auto-save-images-minimum-picture-size[width]" class="small-text" type="text" id="qqworld-auto-save-images-minimum-picture-size-width" value="<?php echo $this->options->minimum_picture_size['width']; ?>" /> <?php _e('(px)', $this->text_domain); ?>
								</label><br />
								<label for="qqworld-auto-save-images-minimum-picture-size-height">
									<?php _e('Height:', $this->text_domain); ?> <input name="qqworld-auto-save-images-minimum-picture-size[height]" class="small-text" type="text" id="qqworld-auto-save-images-minimum-picture-size-height" value="<?php echo $this->options->minimum_picture_size['height']; ?>" readonly /> <?php _e('(px)', $this->text_domain); ?>
								</label><br />
								<label for="qqworld-auto-save-images-minimum-picture-size-auto-delete">
									<input name="qqworld-auto-save-images-minimum-picture-size[auto-delete]" type="checkbox" id="qqworld-auto-save-images-minimum-picture-size-auto-delete" <?php checked($this->options->minimum_picture_size_auto_delete, 'yes')?> value="yes" /> <?php _e('Automatically delete images smaller than minimum-picture-size.', $this->text_domain); ?>
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Maximum Picture Size', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Maximum Picture Size', $this->text_domain); ?>" data-content="<?php _e("Automatic reduction is greater than the size of the picture. if you want image width less than 800px with any size height, please set width 800 and leave height blank.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Maximum Picture Size', $this->text_domain); ?></span></legend>
								<label for="qqworld-auto-save-images-maximum-picture-size-width">
									<?php _e('Width:', $this->text_domain); ?> <input name="qqworld-auto-save-images-maximum-picture-size[width]" class="small-text" type="text" id="qqworld-auto-save-images-maximum-picture-size-width" value="<?php echo $this->options->maximum_picture_size['width']; ?>" /> <?php _e('(px)', $this->text_domain); ?>
								</label><br />
								<label for="qqworld-auto-save-images-maximum-picture-size-height">
									<?php _e('Height:', $this->text_domain); ?> <input name="qqworld-auto-save-images-maximum-picture-size[height]" class="small-text" type="text" id="qqworld-auto-save-images-maximum-picture-size-height" value="<?php echo $this->options->maximum_picture_size['height']; ?>" /> <?php _e('(px)', $this->text_domain); ?>
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="add_exclude_domain"><?php _e('Exclude Domain/Keyword', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Exclude Domain/Keyword', $this->text_domain); ?>" data-content="<?php _e("Images will not be saved, if that url contains Exclude-Domain/Keyword.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Exclude Domain/Keyword', $this->text_domain); ?></span></legend>
								<ul id="exclude_domain_list">
								<?php
 if (!empty($this->options->exclude_domain)) foreach ($this->options->exclude_domain as $domain) : if (!empty($domain)) : ?>
								<li>http(s):// <input type="text" name="qqworld-auto-save-images-exclude-domain[]" class="regular-text" value="<?php echo $domain; ?>" /><input type="button" class="button delete-exclude-domain" value="<?php _e('Delete'); ?>"></li>
									<?php endif; endforeach; ?>
								</ul>
								<p><input type="button" id="add_exclude_domain" class="button" value="<?php _e('Add a Domain/Keyword', $this->text_domain);?>" /></p>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="add_exclude_crc"><?php _e('Exclude CRC', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Exclude CRC', $this->text_domain); ?>" data-content="<?php _e("Remote images will not be saved, if the CRC of image in this list.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Exclude CRC', $this->text_domain); ?></span></legend>
								<ul id="exclude_crc_list">
								<?php
 if (!empty($this->options->exclude_crc)) foreach ($this->options->exclude_crc as $crc) : if (!empty($crc)) : ?>
								<li><input type="text" name="qqworld-auto-save-images-exclude-crc[]" value="<?php echo $crc; ?>" /><input type="button" class="button delete-exclude-crc" value="<?php _e('Delete'); ?>"></li>
									<?php endif; endforeach; ?>
								</ul>
								<p><input type="button" id="add_exclude_crc" class="button" value="<?php _e('Add a CRC of Image', $this->text_domain);?>" /> <span class="icon help" data-header="<?php _e('How to get CRC of Image?', $this->text_domain); ?>" data-content="<?php _e("Use 7-Zip, WinRAR or others compression tools.", $this->text_domain); ?>"></span></p>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="add_delete_crc"><?php _e('Delete CRC', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Delete CRC', $this->text_domain); ?>" data-content="<?php _e("Remote images html code will be deleted, if the CRC of image in this list. it's priority than Exclude-CRC", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Delete CRC', $this->text_domain); ?></span></legend>
								<ul id="delete_crc_list">
								<?php
 if (!empty($this->options->delete_crc)) foreach ($this->options->delete_crc as $crc) : if (!empty($crc)) : ?>
								<li><input type="text" name="qqworld-auto-save-images-delete-crc[]" value="<?php echo $crc; ?>" /><input type="button" class="button delete-delete-crc" value="<?php _e('Delete'); ?>"></li>
									<?php endif; endforeach; ?>
								</ul>
								<p><input type="button" id="add_delete_crc" class="button" value="<?php _e('Add a CRC of Image', $this->text_domain);?>" /> <span class="icon help" data-header="<?php _e('How to get CRC of Image?', $this->text_domain); ?>" data-content="<?php _e("Use 7-Zip, WinRAR or others compression tools.", $this->text_domain); ?>"></span></p>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Excluded Keywords', $this->text_domain)?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Excluded Keywords', $this->text_domain); ?></span></legend>
								<ol>
									<?php
 $exclude_domain = $this->get_exclude_domain(); foreach ($exclude_domain as $domain) : ?>
									<li><?php echo $domain; ?></li>
									<?php endforeach; ?>
								</ol>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</div>
		<div class="tab-content hidden">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="delete-missing-images"><?php _e('Delete Missing Images', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Delete Missing Images', $this->text_domain); ?>" data-content="<?php _e("Automatically Delete html code of remote images that missing or undownloadable.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Delete Missing Images', $this->text_domain); ?></span></legend>
								<label for="delete-missing-images">
									<input name="qqworld-auto-save-images-format[delete-missing-images]" type="checkbox" id="delete-missing-images" value="yes" <?php checked('yes', $this->options->delete_missing_images); ?> />
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="auto_change_name"><?php _e('Change Image Filename', $this->text_domain); ?></label></th>
						<td>
							<fieldset>
							<legend class="screen-reader-text"><span><?php _e('Change Image Filename', $this->text_domain); ?></span></legend>
								<select id="auto_change_name" name="qqworld-auto-save-images-auto-change-name">
									<option value="none" <?php selected('none', $this->options->change_image_name); ?>>1. <?php _e('No'); ?></option>
									<option value="ascii" <?php selected('ascii', $this->options->change_image_name); ?>>2. <?php _e('Only change remote images filename that have Non-ASCii characters (for Windows Server)', $this->text_domain); ?></option>
									<option value="all" <?php selected('all', $this->options->change_image_name); ?>>3. <?php _e('Change all remote images Filename (for Linux Server)', $this->text_domain); ?></option>
								</select>
						</fieldset></td>
					</tr>
					<tr valign="top" id="filename-source-field"<?php if ($this->options->change_image_name!='all') echo ' style="display: none;"'?>>
						<th scope="row"><label><?php _e('Filename Source & Source Priority', $this->text_domain); ?></label></th>
						<td>
							<fieldset>
							<legend class="screen-reader-text"><span><?php _e('Filename Source & Source Priority', $this->text_domain); ?></span></legend>
								<?php
 $filename_sources = array( 'postname' => __('Post Name', $this->text_domain), 'alt' => __('Alternative Text of Image (alt)', $this->text_domain), 'title' => __('Title of Image', $this->text_domain) ); ?>
								<table class="qasi-drag-list" style="width: 270px;">
								<?php
 foreach ($filename_sources as $slug => $title) : ?>
									<tr>
										<td style="width: 250px;"><label><input type="checkbox" name="qqworld-auto-save-images-filename-source[]" value="<?php echo $slug; ?>" <?php if (in_array($slug, $this->options->filename_source)) echo 'checked'; ?> /><?php echo $title; ?></label></td>
										<td><span class="icon drag"></span></td>
									</tr>
								<?php
 endforeach; ?>
								</table>
						</fieldset></td>
					</tr>
					<tr valign="top" id="filename-structure-field"<?php if ($this->options->change_image_name!='all') echo ' style="display: none;"'?>>
						<th scope="row"><label for="filename-structure"><?php _e('Custom Filename Structure', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Custom Filename Structure', $this->text_domain); ?></span></legend>
								<label for="filename-structure">
									<input name="qqworld-auto-save-images-format[filename-structure]" type="text" id="filename-structure" class="regular-text" value="<?php echo $this->options->filename_structure; ?>" />
								</label>
								<p class="description">
									<strong>%filename%</strong> : <?php _e('Original filename or automatic changed filename.', $this->text_domain); ?><br />
									<strong>%date%</strong> : <?php _e('Full date, e.g. 20150209.', $this->text_domain); ?><br />
									<strong>%year%</strong> - <?php _e('YYYY, e.g. 2015.', $this->text_domain); ?><br />
									<strong>%month%</strong> - <?php _e('MM, e.g. 02.', $this->text_domain); ?><br />
									<strong>%day%</strong> -  <?php _e('DD, e.g. 15.', $this->text_domain); ?><br />
									<strong>%time%</strong> - <?php _e('HHMMSS, e.g. 182547.', $this->text_domain); ?><br />
									<strong>%timestamp%</strong> - <?php printf(__('Unix timestamp, e.g. %s.', $this->text_domain), time()); ?><br />
									<strong>%random%</strong> - <?php printf(__('Random number, e.g. %s.', $this->text_domain), 'A5eqWj'); ?><br />
									<strong>%post_id%</strong> - <?php printf(__('Post ID, e.g. %s.', $this->text_domain), '128'); ?><br />
									<strong>%post_name%</strong> - <?php printf(__('Post Name, e.g. %s.', $this->text_domain), 'hello-world'); ?>
								</p>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Change Title & Alt', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Change Title & Alt', $this->text_domain); ?>" data-content="<?php _e('Automatically add title & alt of image as post title or custom text.', $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Change Title & Alt', $this->text_domain); ?></span></legend>
								<label for="format_title_alt">
									<input name="qqworld-auto-save-images-format[title-alt]" type="checkbox" id="format_title_alt" value="yes" <?php checked('yes', $this->options->change_title_alt); ?> />
									<input name="qqworld-auto-save-images-format[custom-title-alt]" type="text" placeholder="<?php _e('Custom Text for Title & Alt', $this->text_domain); ?>" class="regular-text" value="<?php echo $this->options->custom_title_alt; ?>" />
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="format_keep_style"><?php _e('Keep Image Style', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Keep Image Style', $this->text_domain); ?>" data-content="<?php _e("Keep the style of remote images if exist.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Keep Image Style', $this->text_domain); ?></span></legend>
								<label for="format_keep_outside_links">
									<input name="qqworld-auto-save-images-format[keep-image-style]" type="checkbox" id="format_keep_style" value="yes" <?php checked('yes', $this->options->keep_style); ?> />
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="format_keep_outside_links"><?php _e('Keep Outside Links', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Keep Outside Links', $this->text_domain); ?>" data-content="<?php _e("Keep the outside links of remote images if exist.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Keep Outside Links', $this->text_domain); ?></span></legend>
								<label for="format_keep_outside_links">
									<input name="qqworld-auto-save-images-format[keep-outside-links]" type="checkbox" id="format_keep_outside_links" value="yes" <?php checked('yes', $this->options->keep_outside_links); ?> />
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="format_save_outside_links"><?php _e('Save Outside Links', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Save Outside Links', $this->text_domain); ?>" data-content="<?php _e("Save the outside links to description of attachments.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Save Outside Links', $this->text_domain); ?></span></legend>
								<label for="format_save_outside_links">
									<input name="qqworld-auto-save-images-format[save-outside-links]" type="checkbox" id="format_save_outside_links" value="yes" <?php checked('yes', $this->options->save_outside_links); ?> />
								</label>
								<p><?php _e('To custom the content, add codes into <strong>functions.php</strong> like this below:', $this->text_domain); ?></p>
								<pre>add_filter('qqworld-auto-save-images-save-outsite-link', 'save_outside_link', 10, 2);
function save_outside_link($content, $link) {
	$content = '&lta href="'.$link.'" target="_blank" rel="nofollow"&gt;Original Link&lt;/a&gt;';
	return $content;
}</pre>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="width_height"><?php _e('Width &amp; Height', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Width &amp; Height', $this->text_domain); ?>" data-content="<?php _e("Automatically set the true height and width of the image.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Width &amp; Height', $this->text_domain); ?></span></legend>
								<label for="width_height">
									<input name="qqworld-auto-save-images-format[width-height]" type="checkbox" id="width_height" value="yes" <?php checked('yes', $this->options->change_width_height); ?> />
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="format-size"><?php _e('Image Size', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Image Size', $this->text_domain); ?>" data-content="<?php _e("Replace images you want size to display.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Image Size', $this->text_domain); ?></span></legend>
								<label>
									<select name="qqworld-auto-save-images-format[size]" id="format-size">
									<?php
 $sizes = apply_filters( 'image_size_names_choose', array( 'thumbnail' => __('Thumbnail'), 'medium' => __('Medium'), 'large' => __('Large'), 'full' => __('Full Size') ) ); foreach ($sizes as $value => $title) echo '<option value="'.$value.'"'.selected($value, $this->options->format['size'], false).'>'.$title.'</option>'; ?>
									</select>
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="format-link-to"><?php _e('Link To', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Link To', $this->text_domain); ?>" data-content="<?php _e("If you checked Keep-Outside-Links, this option will not works.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Link To', $this->text_domain); ?></span></legend>
								<label>
									<select name="qqworld-auto-save-images-format[link-to]" id="format-link-to">
									<?php
 $linkTo = array( 'file' => __('Media File'), 'post' => __('Attachment Page'), 'none' => __('None') ); foreach ($linkTo as $value => $title) echo '<option value="'.$value.'"'.selected($value, $this->options->format_link_to, false).'>'.$title.'</option>'; ?>
									</select>
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="format-align-to-enabled"><?php _e('Align To', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Align To', $this->text_domain); ?></span></legend>
								<input name="qqworld-auto-save-images-format[align-to-enabled]" type="checkbox" id="format-align-to-enabled" value="yes" <?php checked('yes', $this->options->format_align_to_enabled); ?> />
								<label>
									<select name="qqworld-auto-save-images-format[align-to]" id="format-align-to"<?php if ($this->options->format_align_to_enabled=='no') echo ' style="display: none;"'; ?>>
									<?php
 $linkTo = array( 'left' => __('Left'), 'center' => __('Center'), 'right' => __('Right'), 'none' => __('None') ); foreach ($linkTo as $value => $title) echo '<option value="'.$value.'"'.selected($value, $this->options->format_align_to, false).'>'.$title.'</option>'; ?>
									</select>
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="format_caption"><?php _e('Auto Caption', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Auto Caption', $this->text_domain); ?>" data-content="<?php _e("Automatically add caption shortcode.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Auto Caption', $this->text_domain); ?></span></legend>
								<label for="format_caption">
									<input name="qqworld-auto-save-images-format[auto-caption]" type="checkbox" id="format_caption" value="yes" <?php checked('yes', $this->options->auto_caption); ?> />
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="additional_content_after"><?php _e('Additional Content', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Additional Content', $this->text_domain); ?>" data-content="<?php _e("This content will be displayed after the each remote images code. you can use [Attachment ID] indicate current attachment ID.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Additional Content', $this->text_domain); ?></span></legend>
								<label>
									<textarea name="qqworld-auto-save-images-format[additional-content][after]" rows="3" cols="80" id="additional_content_after"><?php echo $this->options->additional_content['after']; ?></textarea>
									<p class="discription"><?php _e("For example: [Gbuy id='[Attachment ID]']", $this->text_domain); ?></p>
								</label>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</div>
	</form>
	<form action="" method="post" id="scan">
		<div class="tab-content hidden">
			<div id="scan-result"></div>
			<div id="scan-post-block">
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label><?php _e('Select post types', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Select post types', $this->text_domain); ?>" data-content="<?php _e("If you have too many posts to be scan, sometimes in process looks like stopping, but it may be fake. please be patient.", $this->text_domain) ?>"></span></th>
							<td>
								<?php $post_types = get_post_types('', 'objects'); ?>
								<ul id="post_types_list">
								<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment', 'revision', 'nav_menu_item') )) : ?>
									<li><label><input name="qqworld-auto-save-images-post-types[]" type="checkbox" value="<?php echo $name; ?>" /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
								<?php endif; endforeach; ?></ul>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Categories'); ?></label> <span class="icon help" data-header="<?php _e('Categories'); ?>" data-content="<?php _e("Default empty to scan all categories.", $this->text_domain) ?>"></span></th>
							<td id="categories_block"><?php _e('Please select post types.', $this->text_domain); ?></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="id_from"><?php _e('Scope of Post ID', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Scope of Post ID', $this->text_domain); ?>" data-content="<?php _e("Default empty for scan all posts ID. If you want to scan posts ID from 50 to 100. please type '50' and '100' or '100' and '50', The order in which two numbers can be reversed. If you only type one number, system would only scan that ID.", $this->text_domain); ?>"></span></th>
							<td><?php printf(__('From %1$s to %2$s', $this->text_domain), '<input type="number" class="small-text" name="id_from" id="id_from" />', '<input type="number" class="small-text" name="id_to" />'); ?></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="offset"><?php _e('Offset', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Offset', $this->text_domain); ?>" data-content="<?php _e("Default scan all posts. If you want to scan 50-150 posts, please type '50' in the textfield and select '100'.", $this->text_domain); ?>"></span></th>
							<td>
								<?php printf(__('Start from %s to Scan', $this->text_domain), '<input type="number" class="small-text" name="offset" id="offset" value="0" disabled />'); ?>
								<select name="posts_per_page">
									<option value="-1"><?php _e('All'); ?></option>
									<option value="20">20</option>
									<option value="30">30</option>
									<option value="50">50</option>
									<?php for ($i=1; $i<=10; $i++) : ?>
									<option value="<?php echo $i*100; ?>"><?php echo $i*100; ?></option>
									<?php endfor; ?>
									<option value="2000">2000</option>
									<option value="5000">5000</option>
								</select> <?php _e('Posts'); ?>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="scan_post_status"><?php _e('Status'); ?></label></th>
							<td>
								<select name="post_status" id="scan_post_status">
								<?php
 global $wp_post_statuses; echo '<option value="any" /> '.__('Any', $this->text_domain).'</option>'; foreach ($wp_post_statuses as $slug => $status) { if (!in_array($slug, array('auto-draft', 'inherit', 'trash'))) echo '<option value="'.$slug.'" '.selected('publish', $slug, false).'> '.$status->label.'</option>'; } ?>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="scan_orderby"><?php _e('Order By', $this->text_domain); ?></label></th>
							<td>
								<select name="orderby" id="scan_orderby">
									<?php
 foreach ($this->default_orderby as $key => $name) : ?>
									<option value="<?php echo $key; ?>"<?php selected('date', $key); ?>><?php echo $name; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="order"><?php _e('Order'); ?></label></th>
							<td id="categories_block"><fieldset>
								<select name="order" id="order">
									<option value="DESC">DESC</option>
									<option value="ASC">ASC</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="scan_speed"><?php _e('Speed', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Speed', $this->text_domain); ?>" data-content="<?php _e('If the server is too much stress may be appropriately reduced speed.', $this->text_domain); ?>"></span></th>
							<td>
								<select name="speed" id="scan_speed">
									<?php for ($i=1; $i<10; $i++) : ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php endfor; ?>
									<option value="10" selected>10</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="force-scan"><?php _e('Force Scan', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Force Scan', $this->text_domain); ?>" data-content="<?php _e("Successfully scanned posts will be marked, wouldn\'t be scanned again. if you check this, they will be scanned again.", $this->text_domain); ?>"></span></th>
							<td>
								<label><input name="force-scan" id="force-scan" type="checkbox" value="yes" /></label>
							</td>
						</tr>
					</tbody>
				</table>
				<p class="submit">
					<input name="scan_old_posts" type="button" class="button-primary" id="scan_old_posts" value="<?php _e('Automatic', $this->text_domain); ?> &#8667;" /> <span class="icon help" data-header="<?php _e('Automatic', $this->text_domain); ?>" data-content="<?php _e('Scan posts and keep remote images in all posts to local media library. Maybe take a long time.', $this->text_domain); ?>"></span>
					<input name="list_all_posts" type="button" class="button-primary" id="list_all_posts" value="<?php _e('Manual', $this->text_domain); ?> &#9776;" /> <span class="icon help" data-header="<?php _e('Manual', $this->text_domain); ?>" data-content="<?php _e("The list displayed will show you which posts including remote images, then you can keep them to local manually via click \"Fetch\" button.", $this->text_domain); ?>"></span>
					&nbsp;&nbsp;
					<select name="schedule" id="scan-schedules">
					<?php
 foreach (wp_get_schedules() as $recurrence => $detail) { echo '<option value="'.$recurrence.'">'.$detail['display'].'</option>'; } ?>
					</select>
					<input name="cron_scan_posts" type="button" class="button-primary" id="cron_scan_posts" value="<?php _e('Cron', $this->text_domain); ?> &#8667;" /> <span class="icon help" data-header="<?php _e('Cron', $this->text_domain); ?>" data-content="<?php _e("Set cron for automatically scan posts.<br />I recommend set the option Offset from 0 to scan 100 posts.", $this->text_domain); ?>"></span>
				</p>
				<?php if ($this->options->timeout<3600 && $this->options->timeout>0) : ?>
					<p style="vertical-align: middle;"><span class="icon warning"></span> <?php printf(__("Setting <a href=\"%s\" target=\"_blank\">Timeout</a> is not enough, please set at least 1 hour.", $this->text_domain), admin_url('admin.php?page=qqworld-collector-optimization')); ?></p>
				<?php endif; ?>
				<p><strong><?php _e('How to add interval?', $this->text_domain); ?></strong><br /><?php _e('Put the following codes into the theme <em>functions.php</em> file.', $this->text_domain); ?></p>
				<pre>function bing_add_schedules( $schedules ){
	$schedules['2hours'] = array(
		'interval' => 7200,
		'display' => "<?php _e('Each 2 hours', $this->text_domain); ?>"
	);
	return $schedules;
}
add_filter( 'cron_schedules', 'bing_add_schedules' );</pre>
			</div>
		</div>
	</form>
	<form action="" method="post" id="scan-cron">
		<div class="tab-content hidden">
			<div id="cron-list-container">
				<h3><?php _e('Cron of Scan Posts', $this->text_domain); ?></h3>
				<table id="cron-list-table" class="common-list-table">
					<thead>
						<th><?php _e('Post Types', $this->text_domain); ?></th>
						<th><?php _e('Categories'); ?></th>
						<th><?php _e('Scope of Post ID', $this->text_domain); ?></th>
						<th><?php _e('Offset', $this->text_domain); ?></th>
						<th><?php _e('Status'); ?></th>
						<th><?php _e('Order By', $this->text_domain); ?></th>
						<th><?php _e('Order'); ?></th>
						<th><?php _e('Recurrence', $this->text_domain); ?></th>
						<th><?php _e('Will Run On', $this->text_domain); ?></th>
						<th><?php _e('Delete'); ?></th>
					</thead>
					<?php $crons = $this->get_crons('qqworld-auto-save-images-cron-scan-post'); ?>
					<tbody id="cron-list">
						<?php
 if (!empty($crons)) { $options = array(); foreach ($crons as $cron) { $options[$cron['timestamp']] = array( 'post_type' => $cron['options']['args'][0], 'offset' => isset($cron['options']['args'][3]) && !empty($cron['options']['args'][3]) ? $cron['options']['args'][3] : 0, 'posts_per_page' => $cron['options']['args'][4], 'post_status' => $cron['options']['args'][5], 'orderby' => $cron['options']['args'][6], 'order' => $cron['options']['args'][7], 'schedule' => $cron['options']['schedule'] ); if (isset($cron['options']['args'][1]) && !empty($cron['options']['args'][1])) $options[$cron['timestamp']]['tax_query'] = $cron['options']['args'][1]; if (isset($cron['options']['args'][2]) && !empty($cron['options']['args'][2])) $options[$cron['timestamp']]['post__in'] = $cron['options']['args'][2]; } echo $this->get_cron_table_row($options); } ?>
					</tbody>
					<tfoot<?php if (!empty($crons)) echo ' style="display: none;"';?>>
						<tr><td colspan="10" align="center"><?php _e('No Cron yet.', $this->text_domain); ?></td></tr>
					</tfoot>
				</table>
				<p class="submit">
					<input type="button" class="button button-primary" id="clear-all-crons" value="<?php _e('Clear All Crons', $this->text_domain); ?>" />
				</p>
			</div>
		</div>
		<pre><?php ?></pre>
	</form>
</div>
<?php
 } public function optimization_page() { ?>
<div class="wrap">
	<form action="options.php" method="post" id="optimization-form">
		<?php settings_fields('qqworld-auto-save-images-optimization'); ?>
		<h2><?php _e('Authorization Settings', $this->text_domain); ?></h2>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="who-can-use"><?php _e('Who Can Use?', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Who Can Use?', $this->text_domain); ?>" data-content="<?php _e('Set roles who can use this plugin.', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Timeout', $this->text_domain); ?></span></legend>
						<label>
							<select id="who-can-use" name="qqworld-collector-authorization">
								<option value="read"<?php selected('read', $this->options->authorization); ?>><?php _e('Subscriber+ (Read)', $this->text_domain);?></option>
								<option value="edit_posts"<?php selected('edit_posts', $this->options->authorization); ?>><?php _e('Contributor+ (Edit Posts)', $this->text_domain);?></option>
								<option value="publish_posts"<?php selected('publish_posts', $this->options->authorization); ?>><?php _e('Author+ (Publish Posts)', $this->text_domain);?></option>
								<option value="edit_others_posts"<?php selected('edit_others_posts', $this->options->authorization); ?>><?php _e('Editor+ (Edit Others Posts)', $this->text_domain);?></option>
								<option value="manage_options"<?php selected('manage_options', $this->options->authorization); ?>><?php _e('Administrator+ (Manage Options)', $this->text_domain);?></option>
							</select>
						</label>
					</fieldset></td>
				</tr>
			</tbody>
		</table>
		<h2><?php _e('Webserver Stress', $this->text_domain); ?></h2>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="speed_for_manual_mode"><?php _e('Speed', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Speed', $this->text_domain); ?>" data-content="<?php _e('For Manual Mode, if your server is not powerful. use a low speed will be better.', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Speed', $this->text_domain); ?></span></legend>
						<label>
							<select id="speed_for_manual_mode" name="qqworld-collector-webserver[speed]">
							<?php for ($i=1; $i<11; $i++) : ?>
								<option value="<?php echo $i; ?>"<?php selected($i, $this->options->speed_for_manual_mode); ?>><?php echo $i; ?></option>
							<?php endfor; ?>
								<option value="0"<?php selected(0, $this->options->speed_for_manual_mode); ?>><?php _e('Unlimited', $this->text_domain);?></option>
							</select>
						</label>
					</fieldset></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="fetching_interval"><?php _e('Fetching Interval', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Fetching Interval', $this->text_domain); ?>" data-content="<?php _e('Some website would block your server IP, if you are fatching too fast.', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Speed', $this->text_domain); ?></span></legend>
						<label>
							<select id="fetching_interval" name="qqworld-collector-webserver[interval]">
								<option value="0"<?php selected(0, $this->options->fetching_interval); ?>><?php _e('Uninterrupted', $this->text_domain);?></option>
							<?php for ($i=1; $i<11; $i++) : ?>
								<option value="<?php echo $i; ?>"<?php selected($i, $this->options->fetching_interval); ?>><?php printf(_n('%d Second', '%d Seconds', $i, $this->text_domain), $i); ?></option>
							<?php endfor; ?>
							</select>
						</label>
					</fieldset></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="timeout"><?php _e('Timeout', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Timeout', $this->text_domain); ?>" data-content="<?php _e('PHP run time limit (Default: 30 seconds),<br /><strong>For Manual Mode</strong>: Most situation default 30 seconds is fine, but if you want download WeChat images i recommend 3 minutes.<br /><strong>For Automatic Mode</strong>: You need set a bigger number if you need grabbing many remote images at one time. Recommend set Half-a-Hour.<br /><strong>For Scan Mode</strong>: I recommend 10 times as long as the time required for automatic mode.', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Timeout', $this->text_domain); ?></span></legend>
						<label>
							<select id="timeout" name="qqworld-collector-webserver[timeout]">
								<option value="30"<?php selected(30, $this->options->timeout); ?>><?php _e('30 Seconds (Default)', $this->text_domain);?></option>
								<option value="180"<?php selected(180, $this->options->timeout); ?>><?php _e('3 Minutes', $this->text_domain);?></option>
								<option value="300"<?php selected(300, $this->options->timeout); ?>><?php _e('5 Minutes', $this->text_domain);?></option>
								<option value="600"<?php selected(600, $this->options->timeout); ?>><?php _e('10 Minutes', $this->text_domain);?></option>
								<option value="900"<?php selected(900, $this->options->timeout); ?>><?php _e('15 Minutes', $this->text_domain);?></option>
								<option value="1800"<?php selected(1800, $this->options->timeout); ?>><?php _e('Half a Hour', $this->text_domain);?></option>
								<option value="3600"<?php selected(3600, $this->options->timeout); ?>><?php _e('1 Hour', $this->text_domain);?></option>
								<option value="7200"<?php selected(7200, $this->options->timeout); ?>><?php _e('2 Hours', $this->text_domain);?></option>
								<option value="18000"<?php selected(18000, $this->options->timeout); ?>><?php _e('5 Hours', $this->text_domain);?></option>
								<option value="36000"<?php selected(36000, $this->options->timeout); ?>><?php _e('10 Hours', $this->text_domain);?></option>
								<option value="0"<?php selected(0, $this->options->timeout); ?>><?php _e('For Ever', $this->text_domain);?></option>
							</select>
						</label>
					</fieldset></td>
				</tr>
			</tbody>
		</table>
		<h2><?php _e('HTTP Header', $this->text_domain); ?></h2>
		<p><?php _e('The following settings can help you better grab remote images.', $this->text_domain); ?></p>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="header-user-agent"><?php _e('Header - User Agent', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Header - User Agent', $this->text_domain); ?>" data-content="<?php _e('Grab some remote images need to set the User-Agent of the header, some do not need.', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Header - User Agent', $this->text_domain); ?></span></legend>
							<select id="header-user-agent" name="qqworld-collector-http-header[user-agent]">
								<option value=""><?php _e('Not Use', $this->text_domain); ?></option>
								<option value="Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36" <?php selected('Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', $this->options->http_header_user_agent); ?>><?php _e('Google Chrome Explorer', $this->text_domain); ?></option>
								<option value="Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0" <?php selected('Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0', $this->options->http_header_user_agent); ?>><?php _e('Mozilla Firefox Explorer', $this->text_domain); ?></option>
								<option value="Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36 OPR/38.0.2220.41" <?php selected('Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36 OPR/38.0.2220.41', $this->options->http_header_user_agent); ?>><?php _e('Opera Explorer', $this->text_domain); ?></option>
								<option value="Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1" <?php selected('Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', $this->options->http_header_user_agent); ?>><?php _e('Apple Safari Explorer', $this->text_domain); ?></option>
								<option value="Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0)" <?php selected('Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0)', $this->options->http_header_user_agent); ?>><?php _e('Microsoft Internet Explorer', $this->text_domain); ?></option>
								<option value="Googlebot/2.1 (+http://www.google.com/bot.html)"" <?php selected('Googlebot/2.1 (+http://www.google.com/bot.html)', $this->options->http_header_user_agent); ?>><?php _e('Crawler and Bot', $this->text_domain); ?></option>
								<option value="mozilla/5.0 (linux; u; android 4.1.2; zh-cn; mi-one plus build/jzo54k) applewebkit/534.30 (khtml, like gecko) version/4.0 mobile safari/534.30 micromessenger/5.0.1.352" <?php selected('mozilla/5.0 (linux; u; android 4.1.2; zh-cn; mi-one plus build/jzo54k) applewebkit/534.30 (khtml, like gecko) version/4.0 mobile safari/534.30 micromessenger/5.0.1.352', $this->options->http_header_user_agent); ?>><?php _e('Wechat Explorer', $this->text_domain); ?></option>
							</select>
					</fieldset></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="header-http-referer"><?php _e('Header - HTTP Referer', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Header - User Referer', $this->text_domain); ?>" data-content="<?php _e('Very few remote images need to set the HTTP reference address.', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Header - User Referer', $this->text_domain); ?></span></legend>
							<select id="header-http-referer" name="qqworld-collector-http-header[http-referer]">
								<option value=""><?php _e('Not Use', $this->text_domain); ?></option>
								<option value="auto" <?php selected('auto', $this->options->http_header_http_referer); ?>><?php _e('Automatic', $this->text_domain); ?></option>
								<option value="https://www.baidu.com" <?php selected('https://www.baidu.com', $this->options->http_header_http_referer); ?>><?php _e('Baidu', $this->text_domain); ?></option>
								<option value="https://www.google.com" <?php selected('https://www.google.com', $this->options->http_header_http_referer); ?>><?php _e('Google', $this->text_domain); ?></option>
								<option value="https://www.facebook.com" <?php selected('https://www.facebook.com', $this->options->http_header_http_referer); ?>><?php _e('Facebook', $this->text_domain); ?></option>
								<option value="http://" <?php selected('http://', $this->options->http_header_http_referer); ?>><?php _e('Custom', $this->text_domain); ?></option>
							</select>
							<p><input type="text" id="header-custom-http-referer" name="qqworld-collector-http-header[custom-http-referer]" class="regular-text" placeholder="<?php _e('It is usually the address of the collected website.', $this->text_domain); ?>" value="<?php print $this->options->http_header_custom_http_referer; ?>" <?php if ($this->options->http_header_http_referer != 'http://') print 'readonly'; ?> /></p>
					</fieldset></td>
				</tr>
			</tbody>
		</table>
		<h2><?php _e('Proxy Settings', $this->text_domain); ?></h2>
		<p><?php _e("I hope you have fast proxy server.", $this->text_domain); ?>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="enabled_proxy"><?php _e('Enabled', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Enabled', $this->text_domain); ?>" data-content="<?php _e('Use proxy server to download images.', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Enabled', $this->text_domain); ?></span></legend>
							<label>
								<input name="qqworld-auto-save-images-proxy[enabled]" type="checkbox" id="enabled_proxy" value="yes" <?php checked('yes', $this->options->proxy_enabled); ?> />
							</label>
					</fieldset></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="proxy_timeout"><?php _e('Timeout', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Timeout', $this->text_domain); ?>" data-content="<?php _e("Set timeout period on proxy.", $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Timeout', $this->text_domain); ?></span></legend>
							<label for="proxy_timeout">
								<input name="qqworld-auto-save-images-proxy[timeout]" type="text" class="small-text" id="proxy_timeout" value="<?php echo $this->options->proxy_timeout; ?>" /> <?php _e("Second(s)", $this->text_domain); ?>
							</label>
					</fieldset></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="proxy_address"><?php _e('Proxy Address', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Proxy Address', $this->text_domain); ?>" data-content="<?php _e("For example: 127.0.0.1:8087", $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Proxy Address', $this->text_domain); ?></span></legend>
							<label for="proxy_address">
								<input name="qqworld-auto-save-images-proxy[address]" type="text" id="proxy_address" value="<?php echo $this->options->proxy_address; ?>" />
							</label>
					</fieldset></td>
				</tr>
			</tbody>
		</table>
		<h2><?php _e('Images Compression Options', $this->text_domain); ?></h2>
		<p><?php printf(__('I recommented another compress plugin: <a href="%s" target="_blank">Compress JPEG & PNG images</a>.', $this->text_domain), 'https://wordpress.org/plugins/tiny-compress-images/')?></p>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="enabled_compression"><?php _e('Enabled', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Enabled', $this->text_domain); ?>" data-content="<?php _e('Enable compress images when uploading. (Only JPEG)', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Enabled', $this->text_domain); ?></span></legend>
							<label>
								<input name="qqworld-auto-save-images-compression[enabled]" type="checkbox" id="enabled_compression" value="yes" <?php checked('yes', $this->options->compression_enabled); ?> />
							</label>
					</fieldset></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="compression-quality"><?php _e('Quality', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Quality', $this->text_domain); ?>" data-content="<?php _e('Compression level, ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file).', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Quality', $this->text_domain); ?></span></legend>
							<select id="compression-quality" name="qqworld-auto-save-images-compression[quality]">
							<?php for ($q=100; $q>=0; $q-=5) : ?>
								<option value="<?php echo $q; ?>"<?php selected($q, $this->options->compression_level); ?>><?php echo $q; ?><?php if ($q==75) _e(' (Recommend)', $this->text_domain); ?></option>
							<?php endfor; ?>
							</select>
					</fieldset></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="scan-all-attachments"><?php _e('Scan All Attachments', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Scan All Attachments', $this->text_domain); ?>" data-content="<?php _e('Scan all attachments and automatically compression.', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Scan All Attachments', $this->text_domain); ?></span></legend>
							<input type="button" class="button" id="scan-all-attachments" value="<?php _e('Scan', $this->text_domain); ?> &#8667;" />
					</fieldset></td>
				</tr>
			</tbody>
		</table>
		<h2><?php _e('Smart Options', $this->text_domain); ?></h2>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="enabled_smart_grabbing"><?php _e('Smart Grabbing', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Smart Grabbing', $this->text_domain); ?>" data-content="<?php _e('Automatically detect 2 images url from href/src of remote image with outside link, and grab the bigger one. (Not recommend)', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Smart Grabbing', $this->text_domain); ?></span></legend>
							<label>
								<input name="qqworld-auto-save-images-smart[enabled_smart_grabbing]" type="checkbox" id="enabled_smart_grabbing" value="yes" <?php checked('yes', $this->options->enabled_smart_grabbing); ?> />
							</label>
					</fieldset></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for=""><?php _e('Wipe HTML Tag', $this->text_domain); ?></label></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Wipe HTML Tag', $this->text_domain); ?></span></legend>
						<?php
 $html_tags = array( 'a' => '&lt;a&gt', 'b' => '&lt;b&gt', 'strong' => '&lt;strong&gt', 'i' => '&lt;i&gt', 'em' => '&lt;em&gt', 'div' => '&lt;div&gt', 'p' => '&lt;p&gt', 'span' => '&lt;span&gt', 'iframe' => '&lt;iframe&gt', 'object' => '&lt;object&gt', 'section' => '&lt;section&gt', 'aside' => '&lt;aside&gt', 'script' => '&lt;script&gt', 'style' => '&lt;style&gt', 'frameset' => '&lt;frameset&gt' ); ?>
						<?php foreach ($html_tags as $tag => $label) : ?>
						<label><input type="checkbox" name="qqworld-auto-save-images-smart[wipe-html-tags][]" value="<?php echo $tag; ?>"<?php if (is_array($this->options->smart_wipe_html_tags) && in_array($tag, $this->options->smart_wipe_html_tags)) echo ' checked="checked"'; ?> /> <?php echo $label; ?></label>
						<?php endforeach; ?>
						<p><?php _e("Notice: Wipe <strong>&lt;div&gt;</strong>, <strong>&lt;p&gt;</strong>, <strong>&lt;section&gt;</strong> tags can cause content to not wrap. and i recommented that do not check the tag A, unless you dont't want any link.", $this->text_domain); ?></p>
					</fieldset></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="enabled_smart_grabbing"><?php _e('Wipe Attributes of HTML Tag', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Wipe Attributes of HTML Tag', $this->text_domain); ?>" data-content="<?php _e('If you offen reproduce WeChat articles, you will love this feature.', $this->text_domain); ?>"></span></th>
					<td><fieldset>
						<legend class="screen-reader-text"><span><?php _e('Wipe Attributes of HTML Tag', $this->text_domain); ?></span></legend>
						<?php
 $attributes = array( 'style' => __('Style (style)', $this->text_domain), 'data-*' => __('Data (data-*)', $this->text_domain), '_*' => __('Prefixion (_*)', $this->text_domain), 'class' => __('Class (class)', $this->text_domain) ); ?>
						<?php foreach ($attributes as $attribute => $label) : ?>
						<label><input type="checkbox" name="qqworld-auto-save-images-smart[wipe-attributes][]" value="<?php echo $attribute; ?>"<?php if (is_array($this->options->smart_wipe_attributes) && in_array($attribute, $this->options->smart_wipe_attributes)) echo ' checked="checked"'; ?> /> <?php echo $label; ?></label>
						<?php endforeach; ?>
					</fieldset></td>
				</tr>
			</tbody>
		</table>
		<?php submit_button(); ?>
	</form>
</div>
<?php
 } public function register_settings() { $prefix = 'qqworld-auto-save-images-'; $settings_fields = array( 'settings' => array( 'mode', 'when', 'remote-publishing', 'schedule-publish', 'set-featured-image', 'set-featured-image-index', 'default-featured-image', 'no-media-library', 'watermark-default-value', 'flip-horizontal-image', 'auto-change-name', 'filename-source', 'only-save-first', 'minimum-picture-size', 'maximum-picture-size', 'exclude-domain', 'format', 'debug' ), 'optimization' => array( 'proxy', 'compression', 'smart' ), 'cron' => array( 'cron-scan-posts' ) ); foreach ( $settings_fields as $field => $settings ) foreach ( $settings as $setting ) register_setting("{$prefix}{$field}", $prefix . $setting); register_setting('qqworld-auto-save-images-settings', 'qqworld-auto-save-images-exclude-crc', array($this, 'check_strtoupper')); register_setting('qqworld-auto-save-images-settings', 'qqworld-auto-save-images-delete-crc', array($this, 'check_strtoupper')); register_setting('qqworld-auto-save-images-optimization', 'qqworld-collector-webserver'); register_setting('qqworld-auto-save-images-optimization', 'qqworld-collector-http-header'); register_setting("qqworld-auto-save-images-optimization", 'qqworld-collector-authorization'); } public function check_strtoupper($input) { if (!empty($input)) foreach ($input as $i => $ipt) { $input[$i] = strtoupper($ipt); } return $input; } public function get_current_post_type() { global $post, $typenow, $current_screen; if (isset($_GET['post']) && $_GET['post']) { $post_type = get_post_type($_GET['post']); return $post_type; } if ( $post && $post->post_type ) return $post->post_type; elseif( $typenow ) return $typenow; elseif( $current_screen && $current_screen->post_type ) return $current_screen->post_type; elseif( isset( $_REQUEST['post_type'] ) ) return sanitize_key( $_REQUEST['post_type'] ); return null; } public function add_actions() { add_filter( 'wp_insert_post_data', array($this, 'fetch_images_when_saving'), 10, 2 ); add_action( 'wp_insert_post', array($this, 'set_featured_image_for_wp_4_6'), 10, 3 ); } public function set_featured_image_for_wp_4_6($post_ID, $post, $update) { if ($this->thumbnail_id) set_post_thumbnail($post_ID, $this->thumbnail_id); } public function remove_actions() { remove_filter( 'wp_insert_post_data', array($this, 'fetch_images_when_saving') ); remove_action( 'wp_insert_post', array($this, 'set_featured_image_for_wp_4_6') ); if ($this->options->schedule_publish == 'yes') remove_action( 'publish_future_post', array($this, 'fetch_images_after_save') ); if ($this->options->remote_publishing) remove_action('xmlrpc_publish_post', array($this, 'fetch_images_after_save') ); } public function utf8_urldecode($str) { $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\\\1;",urldecode($str)); return html_entity_decode($str, null, 'UTF-8'); } public function fetch_images_when_saving($data, $postarr) { set_time_limit($this->options->timeout); if (in_array($data['post_status'], $this->options->when)) { $this->_log('Starting grab remote images on auto mode from the post: ' . print_r($postarr, true)); $this->has_remote_image = 0; $this->has_missing_image = 0; add_filter( 'redirect_post_location', array($this, 'redirect_post_location'), 10, 2); $data['post_content'] = addslashes($this->content_save_pre(stripslashes($data['post_content']), $postarr['ID'])); } return $data; } public function fetch_images_after_save($post_id, $post, $update) { set_time_limit($this->options->timeout); if (empty($post)) $post = get_post($post_id); if (!in_array($post->post_status, $this->options->when)) return; if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return; if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) return; $this->current_post_id = $post_id; $this->has_remote_image = 0; $this->has_missing_image = 0; add_filter( 'redirect_post_location', array($this, 'redirect_post_location'), 10, 2); if ($this->options->mode=='auto') $this->remove_actions(); if ($this->options->remote_publishing) remove_action( 'xmlrpc_publish_post', array($this, 'fetch_images_after_save') ); if ($this->options->schedule_publish == 'yes') remove_action( 'publish_future_post', array($this, 'fetch_images_after_save') ); $post = get_post($post_id); $content = $this->content_save_pre($post->post_content, $post_id); remove_action( 'post_updated', 'wp_save_post_revision', 10 ); remove_filter( 'content_save_pre', 'wp_filter_post_kses' ); wp_update_post(array( 'ID' => $post_id, 'post_content' => addslashes($content), '_thumbnail_id' => $this->thumbnail_id )); add_action( 'post_updated', 'wp_save_post_revision', 10, 1 ); if ($this->options->mode=='auto') $this->add_actions(); if ($this->options->remote_publishing) add_action('xmlrpc_publish_post', array($this, 'fetch_images_after_save') ); if ($this->options->schedule_publish == 'yes') add_action('publish_future_post', array($this, 'fetch_images_after_save') ); } public function get_exclude_domain() { $exclude_domain = array(get_bloginfo('url')); $this->_log('exclude_domain: ' . print_r($exclude_domain, true)); if ($this->options->optimize_enabled == 'yes') { $exclude_domain = apply_filters( 'qqworld-auto-save-images-exclude-domain-'.$this->options->optimize_mode, $exclude_domain ); } if (!empty($this->options->exclude_domain)) $exclude_domain = array_merge($exclude_domain, $this->options->exclude_domain); return $exclude_domain; } public function is_remote_image($image_url) { if(empty($image_url)) return false; $pos = false; $exclude_domain = $this->get_exclude_domain(); foreach ($exclude_domain as $domain) { if ($pos===false) $pos = strpos($image_url, $domain); } return $pos===false; } public function check_missing_images($remote_images) { if(!empty($remote_images)){ foreach($remote_images as $i => $remote_image) { $image_url = $remote_image['image_url']; if ($this->is_remote_image($image_url)) { $this->has_remote_image = 1; if (!@getimagesize($image_url)) { unset($remote_images[$i]); $this->has_missing_image = 1; return; } } else { unset($remote_images[$i]); } } } return $remote_images; } public function automatic_set_featured_pic_from_media_library($post_id) { if ( $this->options->featured_image == 'yes' && !has_post_thumbnail($post_id) ) { $this->_log('Starting to set featured image from media library with post: ' . $post_id); $media = get_attached_media('image', $post_id); if (!empty($media)) foreach ($media as $attachment_id => $attachment) { set_post_thumbnail( $post_id, $attachment_id ); break; } } } public function content_save_pre($content, $post_id=null, $action="save", $featured_image_index=null) { $this->images_id_of_post = array(); $this->options->featured_image_index = $featured_image_index ? $featured_image_index : $this->options->featured_image_index; if ($post_id) { $this->current_post_id = $post_id; $this->post_id = $post_id; $post = get_post($post_id); if ($post->post_type == 'revision') return; } if (!empty($post_id)) $this->automatic_set_featured_pic_from_media_library($post_id); $content = apply_filters('qqworld-auto-save-images-before-content-save-pre', $content, $post_id); $this->temp_content = $content; $this->count = 1; $this->change_attachment_url_to_permalink($content); $remote_images = apply_filters('qqworld-auto-save-images-remote-images', array(), $this->temp_content); $preg = preg_match_all('/<img.*? src=\"((?!\").*?)\"/i', $this->temp_content, $matches); if ($preg) { if (isset($matches[1])) foreach ($matches[1] as $image_url) { if ($this->is_remote_image($image_url)) $remote_images[] = array('target'=>'src', 'image_url' => $image_url); } } $preg = preg_match_all('/<img.*? src=\'((?!\').*?)\'/i', $this->temp_content, $matches); if ($preg) { if (isset($matches[1])) foreach ($matches[1] as $image_url) { if ($this->is_remote_image($image_url)) $remote_images[] = array('target'=>'src', 'image_url' => $image_url); } } if (isset($_REQUEST['action']) && in_array($_REQUEST['action'], array('save_remote_images_after_scan', 'save_remote_images_list_all_posts'))) { $this->check_missing_images($remote_images); } if ($action == 'get-remote-images-list') { foreach($remote_images as $i => $remote_image) { $image_url = $remote_image['image_url']; if ($this->options->only_save_first != 'all' && $this->count++ > $this->options->only_save_first) unset($remote_images[$i]); $remote_images[$i] = $this->get_attributes_from_image_url($remote_images[$i], $content); } return !empty($remote_images) ? $remote_images : false; } if(!empty($remote_images)) { $content = apply_filters('qqworld-auto-save-images-has-remove-images-before-content-save-pre', $content, $post_id); $this->images_id_of_post = array(); foreach ($remote_images as $remote_image) { $image_url = $remote_image['image_url']; if ($this->options->only_save_first != 'all' && $this->count++ > $this->options->only_save_first) continue; if ($this->is_remote_image($image_url)) { $this->has_remote_image = 1; $args = $this->get_args_from_content_by_image_url($image_url, $content); if ($action == "save") { if ($res = $this->save_images($image_url, $post_id, $args)) { if (is_array($res) && isset($res['code']) && $res['code'] == self::NEED_IGNORED) continue; if (is_array($res) && isset($res['code']) && $res['code'] == self::NEED_DELETED) $content = $this->deleteImageFromContent($image_url, $content); elseif ($res == self::TOO_SMALL) { if ($this->options->minimum_picture_size_auto_delete == 'yes') $content = $this->deleteImageFromContent($image_url, $content); } elseif ($res != self::TOO_SMALL) $content = $this->format($remote_image, $res, $content); if (is_array($res) && isset($res['id'])) { do_action( 'qqworld-auto-save-images-after-save-image', $res, $this->options->optimize_mode); do_action( 'qqworld-auto-save-images-after-save-image-'.$this->options->optimize_mode, $res); } } else { if ($this->options->delete_missing_images == 'yes') $content = $this->deleteImageFromContent($image_url, $content); } } } } } if (!$this->has_missing_image) update_post_meta($post_id, 'qqworld-auto-save-images-posts-scanned', 'yes'); return apply_filters( 'qqworld-auto-save-images-content-save-pre', $content, $post_id ); } public function deleteImageFromContent($image_url, $content) { $pattern_image_url = $this->encode_pattern($image_url); $pattern = '/<a[^<]+><img\s[^>]*'.$pattern_image_url.'.*?>?<[^>]+a>/i'; $preg = preg_match($pattern, $content, $matches); if ($preg) { $content = preg_replace($pattern, '', $content); } $pattern = '/<img\s[^>]*'.$pattern_image_url.'.*?>/i'; $preg = preg_match($pattern, $content, $matches); if ($preg) { $content = preg_replace($pattern, '', $content); } return $content; } public function get_attributes_from_image_url($remote_image, $content) { $target = $remote_image['target']; $image_url = $remote_image['image_url']; $pattern_image_url = $this->encode_pattern($image_url); $alt = ''; $title = ''; $style = ''; if ($this->options->change_title_alt == 'yes') { if (empty($this->options->custom_title_alt)) { $alt = $this->get_post_title() ? $this->get_post_title() : null; $title = $this->get_post_title() ? $this->get_post_title() : null; } else { $title = $this->options->custom_title_alt; $alt = $title; } } else { switch ($target) { case 'href': $pattern = '/<a[^<]+'.$pattern_image_url.'.*?><img.*?>?<[^>]+a>/i'; if ( preg_match($pattern, $content, $matches) ) { $img = $matches[0]; } break; case 'src': $pattern = '/<img.*?'.$pattern_image_url.'[^>]+>/i'; if ( preg_match($pattern, $content, $matches) ) { $img = $matches[0]; } break; } $pattern = '/<img\s[^>]*alt=[\"|\'](.*?)[\"|\'].*?>/i'; if ( preg_match($pattern, $img, $matches) ) $alt = $matches[1]; $pattern = '/<img\s[^>]*title=[\"|\'](.*?)[\"|\'].*?>/i'; if ( preg_match($pattern, $img, $matches) ) $title = $matches[1]; $remote_image['img'] = $img; } if ($this->options->keep_style == 'yes') { $pattern = '/<img.*?'.$pattern_image_url.'[^>]+>/i'; if ( preg_match($pattern, $content, $matches) ) { $img = $matches[0]; $preg = preg_match('/style="(.*?)"/i', $img, $match); if ($preg) { $style = $match[1]; } } } $remote_image['alt'] = $alt; $remote_image['title'] = $title; $remote_image['style'] = $style; return $remote_image; } public function change_attachment_url_to_permalink(&$content) { $pattern = '/<a\s[^>]*href=\"'.$this->encode_pattern(home_url('?attachment_id=')).'(.*?)\".*?>/i'; if ( preg_match_all($pattern, $content, $matches) ) { foreach ($matches[1] as $attachment_id) { $attachment = get_post($attachment_id); $post = get_post($attachment->post_parent); if ($post->post_status != 'draft' && $post->post_status != 'pending') { $url = get_permalink($attachment_id); $content = preg_replace('/'.$this->encode_pattern(home_url('?attachment_id='.$attachment_id)).'/i', $url, $content); } } } } public function encode_pattern($str) { $str = str_replace('(', '\(', $str); $str = str_replace(')', '\)', $str); $str = str_replace('{', '\{', $str); $str = str_replace('}', '\}', $str); $str = str_replace('+', '\+', $str); $str = str_replace('.', '\.', $str); $str = str_replace('?', '\?', $str); $str = str_replace('*', '\*', $str); $str = str_replace('/', '\/', $str); $str = str_replace('^', '\^', $str); $str = str_replace('$', '\$', $str); $str = str_replace('|', '\|', $str); $str = str_replace('%', '\%', $str); return $str; } public function get_attributes_by_remote_url($remote_image, $content) { $image_url = $remote_image['image_url']; $pattern_image_url = $this->encode_pattern($image_url); $pattern = '/<img [^>]*'.$pattern_image_url.'.*?>/i'; $this->attributes = array( 'width' => '', 'height' => '', 'class' => '' ); if (preg_match($pattern, $content, $matches)) { $image = $matches[0]; $pattern = '/<img\s[^>]*width=[\"|\'](.*?)[\"|\'].*?>/i'; if ( preg_match($pattern, $image, $matches) ) $this->attributes['width'] = $matches[1]; $pattern = '/<img\s[^>]*height=[\"|\'](.*?)[\"|\'].*?>/i'; if ( preg_match($pattern, $image, $matches) ) $this->attributes['height'] = $matches[1]; $pattern = '/<img\s[^>]*class=[\"|\'](.*?)[\"|\'].*?>/i'; if ( preg_match($pattern, $image, $matches) ) $this->attributes['class'] = $matches[1]; } } public function format($remote_image, $res, $content) { $this->get_attributes_by_remote_url($remote_image, $content); $image_url = $remote_image['image_url']; $target = $remote_image['target']; $no_match = false; $pattern_image_url = $this->encode_pattern($image_url); if ($this->options->optimize_enabled == 'yes' && $this->options->optimize_mode == 'ftp') { $pattern = '/'.$pattern_image_url.'/i'; $replace = $res['url']; } else { if (isset($res['id'])) $attachment_id = $res['id']; $url_path = str_replace(basename($res['file']), '', $res['url']); $size = isset($res['sizes'][$this->options->format['size']]) ? $this->options->format['size'] : 'full'; if (!isset($res['id'])) $size = 'full'; if ($size == 'full') { $src = $res['url']; $width = $res['width']; $height = $res['height']; } else { $src = $url_path . $res['sizes'][$size]['file']; $width = $res['sizes'][$size]['width']; $height = $res['sizes'][$size]['height']; } if ($this->options->change_width_height == 'no') { $width = $this->attributes['width']; $height = $this->attributes['height']; } $preg = false; if ( $this->options->keep_outside_links=='no' ) { switch ($target) { case 'href': $pattern = '/<a[^<]+href=\"'.$pattern_image_url.'\".*?><img\s[^>]*.*?>?<[^>]+a>/i'; break; case 'src': $pattern = '/<a[^<]+><img\s[^>]*'.$pattern_image_url.'.*?>?<[^>]+a>/i'; break; } $preg = preg_match($pattern, $content, $matches); if ( isset($res['id']) && $preg ) { $this->_log('Format: save_outside_links: ' . $this->options->save_outside_links); if ($this->options->save_outside_links == 'yes' ) { if ( preg_match('/<a[^>]*href=\"(.*?)\".*?>/i', $matches[0], $match) ) { $link = $match[1]; $description = '<a href="'.$link.'" target="_blank" rel="nofollow">'.__('Original Link', $this->text_domain).'</a>'; $description = apply_filters('qqworld-auto-save-images-save-outsite-link', $description, $link); $this->_log('Format: save_outside_links id: ' . $attachment_id); $this->_log('Format: save_outside_links description: ' . $description); $args = array( 'ID' => $attachment_id, 'post_content' => $description ); wp_update_post($args); } } $args = $this->set_img_metadata($matches[0], $attachment_id); } } if (!$preg) { $pattern = '/<img\s[^>]*'.$pattern_image_url.'.*?>/i'; if ( preg_match($pattern, $content, $matches) ) { if (isset($res['id']) ) $args = $this->set_img_metadata($matches[0], $attachment_id); } else { $pattern = '/'.$pattern_image_url.'/i'; $no_match = true; } } $alt = isset($args['alt']) ? ' alt="'.$args['alt'].'"' : ''; $title = isset($args['title']) ? ' title="'.$args['title'].'"' : ''; $style = isset($res['args']['style']) ? ' style="'.$res['args']['style'].'"' : ''; $align = $this->options->format_align_to_enabled == 'no' && preg_match('/align(none|left|center|right|justify)/i', $this->attributes['class'], $matches) ? $matches[0] : 'align'.$this->options->format_align_to; $align = $this->options->auto_caption == 'yes' ? '' : $align.' '; $width = $width ? ' width="'.$width.'"' : ''; $height = $height ? ' height="'.$height.'"' : ''; $img = '<img class="'.$align.'size-'.$size.' wp-image-'.$attachment_id.'" src="'.$src.'"'.$width.$height.$alt.$title.$style.' />'; $link_to = $this->options->keep_outside_links=='no' ? $this->options->format['link-to'] : 'none'; if ( !isset($res['id']) ) $link_to = 'none'; switch ($link_to) { case 'none': $replace = $img; break; case 'file': $replace = '<a href="'.$res['url'].'">'.$img.'</a>'; break; case 'post': $replace = '<a href="'.get_permalink($attachment_id).'">'.$img.'</a>'; break; } if ($no_match) $replace = $res['url']; else if ($this->options->auto_caption == 'yes') $replace = '[caption id="attachment_'.$attachment_id.'" align="align'.$this->options->format_align_to.'" width="'.$width.'"]' . $replace . ' ' . (isset($args['alt']) ? $args['alt'] : '') . '[/caption]'; if ( isset($res['id']) ) $replace .= str_replace( '[Attachment ID]', $res['id'], $this->options->additional_content['after'] ); if ( $this->options->keep_outside_links=='yes' ) { $patt = '/<a[^<]+><img\s[^>]*'.$pattern_image_url.'.*?>?<[^>]+a>/i'; if ( preg_match($patt, $content, $match) ) { $string = $match[0]; $pos = strpos($string, '>'); $string = substr_replace($string, ' rel="nofollow">', $pos, 1); $content = preg_replace($patt, $string, $content); } } } $content = preg_replace($pattern, $replace, $content); return $content; } public function get_args_from_content_by_image_url($image_url, $content) { $pattern_image_url = $this->encode_pattern($image_url); $pattern = '/<img\s[^>]*'.$pattern_image_url.'.*?>/i'; $args = array(); if ( preg_match($pattern, $content, $matches) ) { $pattern = '/<img\s[^>]*alt=[\"|\'](.*?)[\"|\'].*?>/i'; if ( preg_match($pattern, $matches[0], $alt) ) $args['alt'] = $alt[1]; else $args['alt'] = ''; $pattern = '/<img\s[^>]*title=[\"|\'](.*?)[\"|\'].*?>/i'; if ( preg_match($pattern, $matches[0], $title) ) $args['title'] = $title[1]; else $args['title'] = ''; } if (empty($args['title'])) { $pattern = '/<a[^<]+><img\s[^>]*'.$pattern_image_url.'.*?>?<[^>]+a>/i'; if ( preg_match($pattern, $content, $matches) ) { $pattern = '/<a\s[^>]*title=[\"|\'](.*?)[\"|\'].*?><img\s[^>]*?>?<[^>]+a>/i'; if ( preg_match($pattern, $matches[0], $title) ) $args['title'] = $title[1]; else $args['title'] = ''; } } if ($this->options->keep_style == 'yes') { $pattern = '/<img.*?'.$pattern_image_url.'[^>]+>/i'; if ( preg_match($pattern, $content, $matches) ) { $img = $matches[0]; $preg = preg_match('/style="(.*?)"/i', $img, $match); if ($preg) { $args['style'] = $match[1]; } } } return $args; } public function set_img_metadata($img, $attachment_id) { if ($this->options->change_title_alt == 'yes') { if (empty($this->options->custom_title_alt)) { $alt = $this->get_post_title() ? $this->get_post_title() : null; $title = $this->get_post_title() ? $this->get_post_title() : null; } else { $title = $this->options->custom_title_alt; $alt = $title; } } else { $pattern = '/<img\s[^>]*alt=\"(.*?)\".*?>/i'; if ( preg_match($pattern, $img, $matches) ) $alt = $matches[1]; else { $pattern = '/<img\s[^>]*alt=\'(.*?)\'.*?>/i'; $alt = preg_match($pattern, $img, $matches) ? $matches[1] : null; } $pattern = '/<img\s[^>]*title=\"(.*?)\".*?>/i'; if ( preg_match($pattern, $img, $matches) ) $title = $matches[1]; else { $pattern = '/<img\s[^>]*alt=\'(.*?)\'.*?>/i'; $title = preg_match($pattern, $img, $matches) ? $matches[1] : null; } } if ($alt) update_post_meta($attachment_id, '_wp_attachment_image_alt', $alt); if ($title) { $attachment = array( 'ID' => $attachment_id, 'post_title' => $title ); wp_update_post($attachment); } return array( 'alt' => $alt, 'title' => $title ); } public function get_post_title() { if (!empty($this->current_post_id)) { $post = get_post($this->current_post_id); return isset($post->post_title) ? $post->post_title : ''; } else { if (isset($_POST['post_title'])) { return $_POST['post_title']; } elseif (isset($_POST['results']) && isset($_POST['results']['title'])) { return $_POST['results']['title']; } else return ''; } } public function get_post_name() { return sanitize_title_with_dashes( $this->get_post_title() ); } private function createNonceStr($length = 16) { $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; $str = ""; for ($i = 0; $i < $length; $i++) { $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1); } return $str; } public function custom_filename_structure($filename, $structure) { $blogtime = current_time( 'mysql' ); list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = preg_split( '([^0-9])', $blogtime ); $date = $today_year . $today_month . $today_day; $year = $today_year; $month = $today_month; $day = $today_day; $time = $hour . $minute . $second; $timestamp = current_time('timestamp'); $random = $this->createNonceStr(6); $post = get_post($this->post_id); $post_name = $post->post_name; $filename_structure = str_replace( '%filename%', $filename, $structure ); $filename_structure = str_replace( '%date%', $date, $filename_structure ); $filename_structure = str_replace( '%year%', $year, $filename_structure ); $filename_structure = str_replace( '%month%', $month, $filename_structure ); $filename_structure = str_replace( '%day%', $day, $filename_structure ); $filename_structure = str_replace( '%time%', $time, $filename_structure ); $filename_structure = str_replace( '%timestamp%', $timestamp, $filename_structure ); $filename_structure = str_replace( '%random%', $random, $filename_structure ); if (!empty($this->post_id)) { $filename_structure = str_replace( '%post_id%', $this->post_id, $filename_structure ); $filename = str_replace( '%post_name%', $post_name, $filename_structure ); } else { $filename_structure = preg_replace('/(-)?%post_id%/i', '', $filename_structure); $filename = preg_replace('/(-)?%post_name%/i', '', $filename_structure); } return $filename; } public function change_images_filename($name, $extension, $args = array('alt'=>'', 'title'=>'')) { switch ($this->options->change_image_name) { case 'none': $this->_log("None mode file name: name: {$name}, extension: {$extension}"); break; case 'ascii': if ( !preg_match( '/^[\x20-\x7f]*$/', $name, $match ) ) $name = md5($name); $this->_log("ASCii mode changing file name: name: {$name}, extension: {$extension}"); break; case 'all': global $post; $postname = urldecode($this->get_post_name()); $alt = isset($args['alt']) && !empty($args['alt']) ? $args['alt'] : ''; $title = isset($args['title']) && !empty($args['title']) ? $args['title'] : ''; if (!empty($this->options->filename_source)) foreach ($this->options->filename_source as $source) { if (!empty($$source)) { $name = $$source; break; } } $name = apply_filters('qqworld-auto-save-images-string-compatible', $name); $this->_log("All mode changing file name: name: {$name}, extension: {$extension}"); break; } $extension = preg_replace('/^\.*/i', '', $extension); return $this->options->change_image_name == 'all' ? apply_filters('qqworld-auto-save-images-custom-filename-structure', $name, $this->options->filename_structure) . '.' . $extension : $name . '.' . $extension; } public function get_filename_from_url($url) { $url = parse_url($url); $path = $url['path']; $filename = explode('/', $path); return urldecode($filename[count($filename)-1]); } public function automatic_reduction($file, $image_url) { $filetype = $this->getFileType($file); $needs_reduction = false; if ( !empty($this->options->maximum_picture_size['width']) && !empty($this->options->maximum_picture_size['height']) && ($this->width > $this->options->maximum_picture_size['width'] || $this->height > $this->options->maximum_picture_size['height']) ) { $needs_reduction = true; } elseif ( !empty($this->options->maximum_picture_size['width']) && empty($this->options->maximum_picture_size['height']) && $this->width > $this->options->maximum_picture_size['width'] ) { $needs_reduction = true; } elseif ( empty($this->options->maximum_picture_size['width']) && !empty($this->options->maximum_picture_size['height']) && $this->height > $this->options->maximum_picture_size['height'] ) { $needs_reduction = true; } if ($needs_reduction) { if ($this->width > $this->height) { $maximum_picture_size_width = empty($this->options->maximum_picture_size['width']) ? $this->width*$this->options->maximum_picture_size['height']/$this->height : $this->options->maximum_picture_size['width']; $new_width = intval($maximum_picture_size_width); $new_height = intval($this->height*$maximum_picture_size_width/$this->width); } else { $maximum_picture_size_height = empty($this->options->maximum_picture_size['height']) ? $this->height*$this->options->maximum_picture_size['width']/$this->width : $this->options->maximum_picture_size['height']; $new_width = intval($this->width*$maximum_picture_size_height/$this->height); $new_height = intval($maximum_picture_size_height); } $layer = ImageWorkshop::initFromString($file); if ($filetype=='gif' && GifFrameExtractor\GifFrameExtractor::isAnimatedGif($this->temp)) { $gfe = new GifFrameExtractor\GifFrameExtractor(); $frames = $gfe->extract($this->temp, true); $retouchedFrames = array(); foreach ($frames as $frame) { $frameLayer = ImageWorkshop::initFromResourceVar($frame['image']); $frameLayer->resizeInPixel($new_width, $new_height); $retouchedFrames[] = $frameLayer->getResult(); } $gc = new GifCreator\GifCreator(); $gc->create($retouchedFrames, $gfe->getFrameDurations(), 0); $file = $gc->getGif(); } else { $image_p = imagecreatetruecolor($new_width, $new_height); $image = imagecreatefromstring($file); imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height); ob_start(); switch ($filetype) { case 'jpg': case 'jpeg': ImageJpeg($image_p, null, 75); break; case 'png': imagealphablending($image_p, false); imagesavealpha($image_p, true); ImagePng($image_p); break; case 'gif': ImageGif($image_p, null, 75); break; } $file = ob_get_contents(); ob_end_clean(); } imagedestroy($image_p); imagedestroy($layer->getResult()); $this->width = $new_width; $this->height = $new_height; } return $file; } function fsockopen_image_header($image_url, $mode='Content-Type') { if (preg_match('/^data:(image\/\w{3,4});base64,([^\s]*)/i', $image_url, $match)) { return null; } $url = parse_url($image_url); if (isset($url['host'])) { $fp = fsockopen($url['host'], 80, $errno, $errstr, 30); if ($fp) { $out = "HEAD {$url['path']} HTTP/1.1\r\n"; $out .= "Host: {$url['host']}\r\n"; $out .= "Connection: Close\r\n\r\n"; fwrite($fp, $out); while (!feof($fp)) { $header = fgets($fp); if (stripos($header, $mode) !== false) { $value = trim(substr($header, strpos($header, ':') + 1)); return $value; } } fclose($fp); } } return null; } public function get_header($image_url, $key=null) { $headers = @get_headers($image_url); $results = array(); if (!empty($headers)) foreach ($headers as $header) { $header = explode(':', $header); if (isset($header[1])) $results[$header[0]] = trim($header[1]); } if ($key) { if (empty($headers)) return $this->fsockopen_image_header($image_url, $key); return isset($results[$key]) ? $results[$key] : null; } return $results; } public function get_image_size($image_url, $encoding=null) { if (preg_match('/^data:(image\/\w{3,4});base64,([^\s]*)/i', $image_url, $match)) { $file = str_replace(' ', '+', urldecode($match[2])); $file = base64_decode($file); $image = imagecreatefromstring($file); $this->width = imagesx($image); $this->height = imagesy($image); $this->type = $match[1]; return; } $encoding = $encoding ? $encoding : $this->get_header($image_url, 'Content-Encoding'); $params = @getimagesize($image_url); if (!empty($params)) { $this->width = $params[0]; $this->height = $params[1]; $this->type = $params['mime']; } else if ($this->options->proxy_enabled == "yes") { $ch = curl_init(); curl_setopt($ch, CURLOPT_URL, $image_url); curl_setopt($ch, CURLOPT_TIMEOUT, $this->options->proxy_timeout); curl_setopt($ch, CURLOPT_PROXY, $this->options->proxy_address); curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); curl_setopt($ch, CURLOPT_HEADER, 0); $file = curl_exec($ch); if ($encoding == 'gzip' && function_exists('gzdecode')) $file = gzdecode($file); curl_close($ch); if (function_exists("getimagesizefromstring")) { $params = getimagesizefromstring($file); $this->width = $params[0]; $this->height = $params[1]; $this->type = $params['mime']; } } else { $arrContextOptions = array( "ssl" => array( "verify_peer" => false, "verify_peer_name" => false ) ); $file = @file_get_contents( $image_url, null, stream_context_create($arrContextOptions) ); if ($file) { if ($encoding == 'gzip' && function_exists('gzdecode')) $file = gzdecode($file); if (function_exists("getimagesizefromstring")) { $params = getimagesizefromstring($file); $this->width = $params[0]; $this->height = $params[1]; $this->type = $params['mime']; } if ( empty($this->type) ) $this->type = $this->get_header($image_url, 'Content-Type'); } } } public function download_image($image_url) { if (preg_match('/^\/\//', $image_url)) $image_url = 'http:' . $image_url; $this->_log('$image_url is ' . $image_url); $this->is_base64_image = false; $file = ''; if (preg_match('/^data:(image\/\w{3,4});base64,([^\s]*)/i', $image_url, $match)) { $this->_log('This is a base64 encoded image: ' . $match[2]); $file = str_replace(' ', '+', urldecode($match[2])); $file = base64_decode($file); $this->is_base64_image = true; } if (preg_match('/\.qpic\.cn\//i', $image_url)) { $image_url = preg_replace('/\/640\?/i', '/0?', $image_url); } $encoding = $this->get_header($image_url, 'Content-Encoding'); $this->get_image_size($image_url, $encoding); if ( (!empty($this->width) && $this->width<$this->options->minimum_picture_size['width']) || (!empty($this->height) && $this->height<$this->options->minimum_picture_size['height']) ) { return self::TOO_SMALL; } $this->_log('Starting to download remote image: ' . $image_url); $this->_log('The remote image Width: ' . $this->width . ', Height: ' . $this->width . ', Type: ' . $this->type); if ($this->is_base64_image) return $file; sleep(intval($this->options->fetching_interval)); if (isset($_POST['qqworld-collector-http-header'])) { $_POST['user_agent'] = $_POST['qqworld-collector-http-header']['user-agent']; $_POST['http_referer'] = $_POST['qqworld-collector-http-header']['http-referer']; $_POST['custom_http_referer'] = $_POST['qqworld-collector-http-header']['custom-http-referer']; } else { $_POST['user_agent'] = $this->options->http_header_user_agent; $_POST['http_referer'] = $this->options->http_header_http_referer; $_POST['custom_http_referer'] = $this->options->http_header_custom_http_referer; } return apply_filters( 'qqworld_auto_save_images_download_image', $image_url, $this->type, $encoding); } public function compress_image($file) { if ($this->type == 'image/gif' || !in_array($this->type, $this->allowed_image_types)) return $file; $img = @imagecreatefromstring($file); if ($img) { $result = ''; ob_start(); switch($this->type) { case 'image/jpeg': ImageJpeg($img, null, $this->options->compression_level); break; } $result = ob_get_contents(); ob_end_clean(); imagedestroy($img); if ($result) $file = $result; } return $file; } public function flip_horizontal_image($file) { if ( $this->width && $this->height ) { $img = imagecreatefromstring($file); $new = imagecreatetruecolor($this->width, $this->height); for($x=0 ;$x<$this->width; $x++){ imagecopy($new, $img, $this->width-$x-1, 0, $x, 0, 1, $this->height); } ob_start(); switch ($this->type) { case 'image/jpeg': ImageJpeg($new, null, 75); break; case 'image/png': imagealphablending($new, false); imagesavealpha($new, true); ImagePng($new); break; case 'image/gif': ImageGif($new, null, 75); break; } $file = ob_get_contents(); ob_end_clean(); imagedestroy($img); imagedestroy($new); } return $file; } public function is_downloaded($object, $type) { $this->is_downloaded = false; switch ($type) { case 'url': $args = array( 'post_type' => 'attachment', 'meta_key' => 'Original Link', 'meta_value' => $object, 'post_status' => 'inherit' ); break; case 'crc': $args = array( 'post_type' => 'attachment', 'meta_key' => 'CRC of Original Image', 'meta_value' => $object, 'post_status' => 'inherit' ); break; } $attachments = get_posts($args); if (!empty($attachments)) { $this->is_downloaded = true; $attachment = $attachments[0]; $attachment_id = $attachment->ID; $src = wp_get_attachment_image_src($attachment_id, 'full'); $meta_data = wp_get_attachment_metadata($attachment_id); $res = array( 'id' => $attachment_id, 'url' => $src[0] ); $res = array_merge($res, $meta_data); return $res; } return false; } public function getCrc32($file) { $crc = strtoupper( dechex( crc32($file) ) ); return $crc; } public function save_images($image_url, $post_id=0, $args=null) { $image_url = is_array($image_url) ? array_shift($image_url) : $image_url; if (!defined('COLLECTING')) define('COLLECTING', true); set_time_limit($this->options->timeout); if ( $res = $this->is_downloaded($image_url, 'url') ) { $this->images_id_of_post[] = $res['id']; $res['args'] = $args; return $res; } $remote_image = stripslashes(str_replace(' ', '%20', $image_url)); if (preg_match('/^\/\//', $image_url, $match)) $image_url = 'http:' . $image_url; $file = $this->download_image($remote_image); if ( !empty($file) && $file != self::TOO_SMALL ) { $crc = $this->getCrc32($file); if ( !empty($this->options->delete_crc) && in_array($crc, $this->options->delete_crc) ) return array( 'code' => self::NEED_DELETED, 'image_url' => $image_url ); if ( !empty($this->options->exclude_crc) && in_array($crc, $this->options->exclude_crc) ) return array( 'code' => self::NEED_IGNORED, 'image_url' => $image_url ); if ( $res = $this->is_downloaded($crc, 'crc') ) { $this->images_id_of_post[] = $res['id']; $res['args'] = $args; return $res; } $filename = $this->get_filename_from_url($image_url); preg_match( '/(.*?)(\.(jpg|jpeg|png|gif|bmp))$/i', $filename, $match ); if ( empty($match) ) { $this->_log('This image filename has no extension: ' . $filename); if ($filetype = $this->getFileType($file) ) { preg_match( '/(.*?)$/i', $filename, $match ); $img_name = explode('.', $filename); $pos = strpos($image_url,'?'); $img_name = $pos || count($img_name)<2 ? md5($image_url) : $img_name[0]; $this->_log("Before auto change image filename, img_name: {$img_name}, filetype : {$filetype}"); $img_name = $this->change_images_filename($img_name, '.'.$filetype, $args); } else return false; } else { $img_name = $match[1]; $filetype = preg_replace('/^.*/', '', $match[2]); $this->_log("Before auto change image filename, img_name: {$match[1]}, filetype : {$match[2]}"); $img_name = $this->change_images_filename($match[1], '.'.$match[2], $args); } $img_name = preg_replace('/\.bmp$/i', '.jpg', $img_name); $this->_log('Final image name is: ' . $img_name); $this->temp = tempnam(sys_get_temp_dir(), 'QQWorld'); $temp = fopen($this->temp, "w"); fwrite($temp, $file); $file = $this->automatic_reduction($file, $image_url); fclose($temp); unlink($this->temp); $file = apply_filters( 'qqworld_auto_save_images_file_bits', $file ); if (function_exists('cud_custom_upload_dir')) { global $cud_file_ext, $cud_file_type; $cud_file_type = $this->type; $cud_file_ext = $filetype; add_filter('upload_dir', 'cud_custom_upload_dir', 1); } $res = wp_upload_bits($img_name, null, $file); if (isset( $res['error'] ) && !empty($res['error'])) { $this->_log($res['error']); return false; } if ( $this->options->no_media_library == 'yes' && ($this->options->featured_image!='yes' || ($post_id && has_post_thumbnail($post_id))) ) { if ($this->watermark->watermark_enabled=='yes' && $this->width>=$this->watermark->filter_size['width'] && $this->height>=$this->watermark->filter_size['height']) $this->watermark->save_watermark($res['file']); $res['width'] = $this->width; $res['height'] = $this->height; $res['code'] = self::NO_MEDIA_LIBRARY; if ($this->options->optimize_enabled == 'yes' && !empty($this->options->optimize_mode)) $res = apply_filters('qqworld-auto-save-images-no-media-library-res-'.$this->options->optimize_mode, $res); } elseif ($this->options->optimize_enabled == 'yes' && $this->options->optimize_mode == 'ftp') { if ($this->watermark->watermark_enabled=='yes' && $this->width>=$this->watermark->filter_size['width'] && $this->height>=$this->watermark->filter_size['height']) $this->watermark->save_watermark($res['file']); $file = file_get_contents($res['file']); $res = apply_filters('qqworld-auto-save-images-saving-'.$this->options->optimize_mode, $file, $img_name, $this->width, $this->height); unlink($res['file']); } else { $attachment_id = $this->insert_attachment($res['file'], $post_id); $res['crc'] = $crc; update_post_meta($attachment_id, 'CRC of Original Image', $crc); if (!$this->is_base64_image) update_post_meta($attachment_id, 'Original Link', $image_url); if ($this->options->compression_enabled=='yes' || ($this->options->watermark_enabled=='yes' && in_array('collection', $this->options->watermark_enabled_for)) ) { update_post_meta($attachment_id, '_compressed', '1'); } $res['id'] = $attachment_id; $meta_data = wp_get_attachment_metadata($attachment_id); $res = array_merge($res, $meta_data); if ( $this->options->optimize_enabled == 'yes') { $dirs = wp_upload_dir(); $url_path = $this->options->optimize_protocol . $this->options->optimize_host . $this->options->optimize_folder; $url_path = apply_filters('qqworld-auto-save-images-url-path-'.$this->options->optimize_mode, $url_path, $this->options->optimize_protocol, $this->options->optimize_host, $this->options->optimize_folder); $filename = explode('/', $res['url']); switch ($this->options->optimize_mode) { case 'sinaimg': $uploaded = get_post_meta($attachment_id, '_sync_sinaimg_sizes_url', true); if (isset($uploaded['full'])) $res['url'] = $uploaded['full']; break; case 'tietuku': $uploaded = get_post_meta($attachment_id, '_sync_tietuku_sizes_url', true); if (isset($uploaded['full'])) $res['url'] = $uploaded['full']; break; case 'smms': $uploaded = get_post_meta($attachment_id, '_sync_smms_sizes_url', true); if (isset($uploaded['full'])) $res['url'] = $uploaded['full']; break; default: $res['url'] = $url_path . $dirs['subdir'] . '/' . $filename[count($filename)-1]; break; } } if ( $post_id && !has_post_thumbnail($post_id) && $this->options->featured_image=='yes' ) { $this->thumbnail_id = $attachment_id; } $this->images_id_of_post[] = $attachment_id; } $res['args'] = $args; return $res; } else if ($file == self::TOO_SMALL) { return self::TOO_SMALL; } else if ($file != self::TOO_SMALL) { $this->has_missing_image = 1; } return false; } public function insert_attachment($file, $parent){ $dirs = wp_upload_dir(); $filetype = wp_check_filetype($file); $attachment = array( 'guid' => $dirs['baseurl'].'/'._wp_relative_upload_path($file), 'post_mime_type' => $filetype['type'], 'post_title' => urldecode(preg_replace('/\.[^.]+$/','', basename($file))), 'post_content' => '', 'post_status' => 'inherit' ); $attach_id = wp_insert_attachment($attachment, $file, $parent); if (!function_exists('wp_generate_attachment_metadata')) include_once (ABSPATH . DIRECTORY_SEPARATOR . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'image.php'); $attach_data = wp_generate_attachment_metadata($attach_id, $file); wp_update_attachment_metadata($attach_id, $attach_data); return $attach_id; } } class Walker_Category_Checklist extends \Walker { public $tree_type = 'category'; public $db_fields = array ('parent' => 'parent', 'id' => 'term_id'); public function start_lvl( &$output, $depth = 0, $args = array() ) { $indent = str_repeat("\t", $depth); $output .= "$indent<ul class='children'>\n"; } public function end_lvl( &$output, $depth = 0, $args = array() ) { $indent = str_repeat("\t", $depth); $output .= "$indent</ul>\n"; } public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) { if ( empty( $args['taxonomy'] ) ) { $taxonomy = 'category'; } else { $taxonomy = $args['taxonomy']; } if ( $taxonomy == 'category' ) { $name = 'post_category'; } else { $name = 'tax_input[' . $taxonomy . ']'; } $args['popular_cats'] = empty( $args['popular_cats'] ) ? array() : $args['popular_cats']; $class = in_array( $category->term_id, $args['popular_cats'] ) ? ' class="popular-category"' : ''; $args['selected_cats'] = empty( $args['selected_cats'] ) ? array() : $args['selected_cats']; $output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" . '<label class="selectit"><input value="' . $category->term_id . '" type="checkbox" name="terms['.$taxonomy.'][]" id="in-'.$taxonomy.'-' . $category->term_id . '"' . checked( in_array( $category->term_id, $args['selected_cats'] ), true, false ) . disabled( empty( $args['disabled'] ), false, false ) . ' /> ' . esc_html( apply_filters( 'the_category', $category->name ) ) . '</label>'; } public function end_el( &$output, $category, $depth = 0, $args = array() ) { $output .= "</li>\n"; } }