<?php
namespace qqworld_collector\module\auto_save_attachments; use qqworld_collector\lib; class rest_api extends lib { var $user_can_manage_options; public function init() { add_action( 'rest_api_init', array($this, 'rest_api_init') ); } public function rest_api_init() { $namespace = 'collector/v1'; register_rest_route( $namespace, 'auto-save-attachments/debug', array( 'methods' => 'GET', 'callback' => array($this, 'auto_save_attachments_debug'), 'update_callback' => null, 'permission_callback' => '__return_true', 'schema' => null ) ); register_rest_route( $namespace, 'auto-save-attachments/post', array( 'methods' => 'POST', 'callback' => array($this, 'auto_save_attachments_post'), 'update_callback' => null, 'permission_callback' => '__return_true', 'schema' => null ) ); $this->user_can_manage_options = current_user_can('manage_options'); } public function auto_save_attachments_debug($data) { if (!$this->user_can_manage_options) exit; header("Content-Type: text/html"); $pid = $data['id']; ?><!DOCTYPE html>
<html>
<head>
<title><?php _e('Auto Save Attachments Debug', $this->text_domain); ?></title>
<style>
#debug-section {
	max-width: 760px;
	margin: 30px auto;
	font-size: 14px;
}
#debug-section form label {
	display: block;
	margin-bottom: 10px;
}
#debug-section form input[type="text"],
#debug-section form textarea,
#debug-section form select {
	width: 100%;
}
</style>
<link rel="stylesheet" id="dashicons-css"  href="<?php print includes_url('css/dashicons.css'); ?>" type="text/css" media="all" />
<link rel="stylesheet" id="forms-css"  href="<?php print admin_url('css/forms.css'); ?>" type="text/css" media="all" />
<link rel="stylesheet" id="buttons-css"  href="<?php print includes_url('css/buttons.css'); ?>" type="text/css" media="all" />
<?php ?>
</head>

<body>
<section id="debug-section" class="wp-core-ui">
	<form id="form" action="<?php print home_url('wp-json/collector/v1/auto-save-attachments/post'); ?>" method="post">
		<p><label for="title"><?php _e('Post Title', $this->text_domain); ?></label>
			<input type="text" name="title" id="title" value="" />
		</p>
		<p><label for="url"><?php _e('Post Content', $this->text_domain); ?></label>
			<?php wp_editor('', 'content', array('textarea_rows' => 30)); ?>
		</p>
		<p><label for="url"><?php _e('Headers', $this->text_domain); ?></label>
			<textarea id="headers" name="headers" rows="3" placeholder="<?php _e('Please enter the request headers', $this->text_domain); ?>"></textarea>
		</p>
		<p><input type="submit" class="button button-primary button-large" value="<?php _e('Submit', $this->text_domain); ?>" /></p>
	</form>
</section>
<?php wp_footer(); ?>
</body>
</html><?php
 exit; } public function auto_save_attachments_post() { global $wpdb; if (!$this->user_can_manage_options) exit; if (!isset($_POST['content'])) exit; extract($_POST); $post_id = wp_insert_post(array( 'post_title' => __('Auto Draft'), 'post_status' => 'draft' )); $args = array(); $content = stripslashes($content); $post_content = apply_filters( 'qqworld-collector-save-remote-attachment-from-content-before', $content, $args ); list($remote_attachments, $missing_attachments) = $this->core->get_remote_attachments($post_content); print "Get Remote Attachments:\n"; print_r($remote_attachments); if (!empty($missing_attachments)) { print "Missing Attachments:\n"; print_r($missing_attachments); } print "\n\n\n"; $remote_attachments = $this->core->grab_remote_attachments($remote_attachments, $post_id); print "Grab Remote Attachments:\n"; print_r($remote_attachments); print "\n\n\n"; $this->core->remote_attachments = array(); if (!empty($remote_attachments)) { foreach ($remote_attachments as $attachments) { if (!empty($remote_attachments)) { $this->core->remote_attachments = $remote_attachments; break; } } } if ($this->options->qc_asa_general_set_featured_image == 1) { if (!empty($this->core->remote_attachments)) $this->core->thumbnail_id = $this->core->get_featured_image_id($this->core->remote_attachments, $post_id); set_post_thumbnail( $post_id, $this->core->thumbnail_id ); print "Featured Image:\n"; print $this->core->thumbnail_id; print "\n\n\n"; } $post_content = $this->core->format_post_content($post_content, $remote_attachments, $missing_attachments, $post_id); print "Replaced Post Content:\n"; print_r($post_content); print "\n\n\n"; $wpdb->update( $wpdb->posts, array( 'post_title' => $title, 'post_content' => $post_content, 'post_status' => 'publish' ), array( 'ID' => $post_id ), array( '%s', '%s', '%s' ), array( '%d' ) ); exit; } } ?>