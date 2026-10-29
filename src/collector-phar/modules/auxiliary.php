<?php
namespace qqworld_collector\module; use qqworld_collector\lib; class auxiliary extends lib { var $options; public function __construct() { add_action( 'init', array($this, 'init') ); add_action( 'woocommerce_api_create_product', array($this, 'woocommerce_api_create_product'), 10, 2 ); add_action( 'woocommerce_api_edit_product', array($this, 'woocommerce_api_create_product'), 10, 2 ); add_action( 'qqworld-collector-settings-meta-box', array($this, 'setting_meta_box') ); add_filter( 'wp_insert_post_data', array($this, 'wp_insert_post_data'), 10, 2 ); } public function init() { if ( apply_filters( 'qqworld-collector-auxiliary-allow-bulk-update', false) ) { require QQWORLD_COLLECTOR_DIR . 'lib' . DIRECTORY_SEPARATOR . 'auxiliary' . DIRECTORY_SEPARATOR . 'bulk-update.php'; } } public function woocommerce_api_create_product($id, $data) { if ( apply_filters( 'qqworld-collector-auto-add-sku-for-woo-products', '__return_false') ) { update_post_meta($id, '_sku', $id); $parent_product = wc_get_product($id); $parent_product_type = $parent_product->get_type(); if ($parent_product_type == 'variable') { $available_variations = $parent_product->get_available_variations(); foreach ($available_variations as $index => $available_variation) { update_post_meta($available_variation['variation_id'], '_sku', $id . '-' . ($index+1)); } } } } public function setting_meta_box($post) { if ( !apply_filters( 'qqworld-collector-activated', false ) ) return; if ( apply_filters( 'qqworld-collector-activated-license', false ) && !apply_filters( 'qqworld-collector-activated-module-' . 'collection-project', false ) ) return; if ($this->options->qc_auxiliary_set_post_author) : ?>
	<p>
		<label for="set-post-author"><strong><?php _e('Set Post Author', $this->text_domain); ?></strong></label><br>
		<?php _e("You can select frequently used users from the drop-down menu.", $this->text_domain); ?>
	</p>
	<p>
		<select name="qc-set-post-author" id="set-post-author" class="selectstyle">
			<option value="">--- <?php _e('Please select post author', $this->text_domain); ?> ---</option>
			<?php
 $roles = array('administrator', 'editor', 'author'); global $wp_roles; foreach ($roles as $role) { $args = array('role__in' => array($role)); $users = get_users($args); if (!empty($users)) { print '<optgroup label="'.translate_user_role($wp_roles->roles[$role]['name']).'">'; foreach ($users as $user) print '<option value="'.$user->ID.'" '.selected($user->ID, $post->post_author, false).'>'.$user->data->display_name.'</option>'; print '</optgroup>'; } } ?>
		</select><br />
	</p>
	<p>
		<?php _e("If you want to create a user temporarily, or specify a user with low authority, you can directly enter the user's name.", $this->text_domain); ?>
	</p>
	<p>
		<?php
 if ($post->post_author) { $author = get_user_by('id', $post->post_author); $display_name = $author->data->display_name; } else $display_name = ''; ?>
		<input type="text" class="large-text" name="qc-custom-post-author" placeholder="<?php _e('Please enter the user name directly', $this->text_domain); ?>" value="<?php print $display_name; ?>" />
	</p>
	<p id="suggestion_search_users"></p>
	<?php
 $users = get_users(array( 'fields' => ['ID','display_name'], )); $json = array(); foreach ($users as $user) { $json[$user->ID] = $user->display_name; } ?>
	<script>
	QQWorldCollector.search_post_author = function() {
		var $ = jQuery, that = this, users = <?php print json_encode($json); ?>;

		this.action = {};
		this.action.set_post_author = function() {
			var index = $(this).get(0).selectedIndex;
			var name = $('option', this).get(index).innerHTML;
			$('[name="qc-custom-post-author"]').val(name);
		};
		this.action.keyup = function(e) {
			$('#suggestion_search_users').html('');
			var keyword = $(this).val();
			if (keyword) {
				var options = '';
				for (var id in users) {
					if (users[id].indexOf(keyword) != -1 && users[id] != keyword) {
						options += '<li><a href="#">' + users[id] + '</a> (id: '+id+')</li>'
					}
				}
				if (options) $('#suggestion_search_users').html('<ul>' + options + '</ul>');
			}
		};

		this.action.keydown = function(e) {
			if (e.keyCode == 13) return false;
		};

		this.action.select_user = function() {
			$('[name="qc-custom-post-author"]').val($(this).html());
			$('#suggestion_search_users ul').hide('normal');
			return false;
		};

		this.create = {};
		this.create.events = function() {
			$(document).on('change', '#set-post-author', that.action.set_post_author);
			$(document).on('keyup', '[name="qc-custom-post-author"]', that.action.keyup);
			$(document).on('keydown', '[name="qc-custom-post-author"]', that.action.keydown);
			$(document).on('click', '#suggestion_search_users a', that.action.select_user);
		};
		this.create.init = function() {
			that.create.events();
		};
		this.create.init();
	};
	new QQWorldCollector.search_post_author;
	</script>
	<hr />
	<?php endif; ?>
	<script>
	// 用于自动模式
	jQuery(function($) {
		if (QC.asa_general_mode == 'auto') {
			var type = QC.is_block_editor ? 'gutenberg' : 'tinymce';
			$('#post').prepend('<input type="hidden" id="qc-editor-type" name="qc-editor-type" value="'+type+'">');
		}
	});
	</script>
	<p>
		<label for="set-post-type"><strong><?php _e('Set Post Type', $this->text_domain); ?></strong></label><br>
		<?php _e("You can change the type of article here.", $this->text_domain); ?>
	</p>
	<p>
		<select name="qc-set-post-type" id="set-post-type" class="selectstyle">
			<option value="">--- <?php _e('Please select post type', $this->text_domain); ?> ---</option>
			<?php
 $post_types = get_post_types(array('public' => 1), OBJECT); unset($post_types['attachment']); foreach ($post_types as $name => $post_type) { print '<option value="'.$name.'" '.selected($name, $post->post_type, false).'>' . $post_type->label . '</option>'; } ?>
		</select><br />
	</p>
	<hr />
	<p>
		<label for="set-post-type"><strong><?php _e('Use Current Date', $this->text_domain); ?></strong></label><br>
		<?php _e('If you want to change the post date of the post to the current date, please check here.', $this->text_domain); ?>
	</p>
	<?php
 $this->the_switcher(array( 'id' => 'use-current-date', 'name' => 'use-current-date', 'value' => apply_filters( 'qqworld-collector-auxiliary-use-current-date-default-value', 0 ) )); } public function wp_insert_post_data($data, $postarr) { if (isset($postarr['qc-custom-post-author']) && $postarr['qc-custom-post-author']) { $data['post_author'] = apply_filters( 'qqworld-collector-parse-post-author-string-to-id', $postarr['qc-custom-post-author'] ); } elseif (isset($postarr['qc-set-post-author']) && $postarr['qc-set-post-author']) { $data['post_author'] = $postarr['qc-set-post-author']; } if (isset($postarr['qc-set-post-type']) && $postarr['qc-set-post-type']) { $data['post_type'] = $postarr['qc-set-post-type']; } if (isset($postarr['use-current-date']) && $postarr['use-current-date'] == 1) { $data['post_date'] = date('Y-m-d H:i:s', current_time('timestamp')); $data['post_date_gmt'] = get_gmt_from_date($data['post_date']); } return $data; } } ?>