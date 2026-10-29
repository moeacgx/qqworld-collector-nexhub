<?php
namespace qqworld_collector\module\auto_save_attachments; use qqworld_collector\lib; class thumbnail_crop_position extends lib { var $options; var $settings; var $log_id = 'thumbnail-crop-position'; public function __construct() { add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts') ); add_filter( 'qqworld-collector-script-translation-array', array($this, 'add_translation_array') ); add_action( 'wp_ajax_qqworld-collector-save-thumbnail-crop-position', array($this, 'update_position') ); add_action( 'wp_ajax_nopriv_qqworld-collector-save-thumbnail-crop-position', array($this, 'update_position') ); add_filter( 'image_resize_dimensions', array( $this, 'image_resize_dimensions' ), 10, 6 ); } public function admin_enqueue_scripts() { wp_enqueue_style( 'thumbnail-crop-position' ); wp_enqueue_script( 'thumbnail-crop-position' ); } public function add_translation_array($translation_array) { $translation_array['_wpnonce'] = wp_create_nonce('update-thumbnail-crop-position'); return $translation_array; } public function update_position() { if ( empty($_REQUEST['_wpnonce']) || !check_ajax_referer( 'update-thumbnail-crop-position', '_wpnonce', false ) || !current_user_can('upload_files') ) { echo -1; die(); } $position = isset($_POST['position']) ? min( 8, absint( $_POST['position'] ) ) : 4; update_option( 'qqworld-collector-thumbmail-crop-position', array( 'position' => $position ) ); echo $position; die(); exit; } public function init() { global $pagenow; if ($pagenow == 'media-new.php') { add_action( 'post-upload-ui', array( $this, 'uploader_controls' ) ); } else { add_action( 'pre-upload-ui', array( $this, 'uploader_controls' ) ); } } public function get_position() { $options = get_option( 'qqworld-collector-thumbmail-crop-position' ); return is_array($options) && isset($options['position']) ? min( 8, absint( $options['position'] ) ) : 4; } public function uploader_controls() { $pos = $this->get_position(); ?>
		<div class="thumbnail-crop-position">
			<p><?php _e( 'Select thumbnail crop position:', $this->text_domain );?></p>
			<div class="tcp-controls">

				<div class="button button-hero<?php echo $pos == 0 ? ' button-primary' : ''; ?>">
					<input id="ci-0" class="screen-reader-text" name="position" type="radio" value="0"<?php checked( 0, $pos ); ?> />
					<label for="ci-0" class="ci-0"><?php echo __('Top') .'-'. __('Left'); ?></label>
				</div>
				<div class="button button-hero<?php echo $pos == 1 ? ' button-primary' : ''; ?>">
					<input id="ci-1" class="screen-reader-text" name="position" type="radio" value="1"<?php checked( 1, $pos ); ?> />
					<label for="ci-1" class="ci-1"><?php echo __('Top') .'-'. __('Center'); ?></label>
				</div>
				<div class="button button-hero<?php echo $pos == 2 ? ' button-primary' : ''; ?>">
					<input id="ci-2" class="screen-reader-text" name="position" type="radio" value="2"<?php checked( 2, $pos ); ?> />
					<label for="ci-2" class="ci-2"><?php echo __('Top') .'-'. __('Right'); ?></label>
				</div>

				<div class="button button-hero<?php echo $pos == 3 ? ' button-primary' : ''; ?>">
					<input id="ci-3" class="screen-reader-text" name="position" type="radio" value="3"<?php checked( 3, $pos ); ?> />
					<label for="ci-3" class="ci-3"><?php echo __('Center') .'-'. __('Left'); ?></label>
				</div>
				<div class="button button-hero<?php echo $pos == 4 ? ' button-primary' : ''; ?>">
					<input id="ci-4" class="screen-reader-text" name="position" type="radio" value="4"<?php checked( 4, $pos ); ?> />
					<label for="ci-4" class="ci-4"><?php echo __('Center') .'-'. __('Center'); ?></label>
				</div>
				<div class="button button-hero<?php echo $pos == 5 ? ' button-primary' : ''; ?>">
					<input id="ci-5" class="screen-reader-text" name="position" type="radio" value="5"<?php checked( 5, $pos ); ?> />
					<label for="ci-5" class="ci-5"><?php echo __('Center') .'-'. __('Right'); ?></label>
				</div>

				<div class="button button-hero<?php echo $pos == 6 ? ' button-primary' : ''; ?>">
					<input id="ci-6" class="screen-reader-text" name="position" type="radio" value="6"<?php checked( 6, $pos ); ?> />
					<label for="ci-6" class="ci-6"><?php echo __('Bottom') .'-'. __('Left'); ?></label>
				</div>
				<div class="button button-hero<?php echo $pos == 7 ? ' button-primary' : ''; ?>">
					<input id="ci-7" class="screen-reader-text" name="position" type="radio" value="7"<?php checked( 7, $pos ); ?> />
					<label for="ci-7" class="ci-7"><?php echo __('Bottom') .'-'. __('Center'); ?></label>
				</div>
				<div class="button button-hero<?php echo $pos == 8 ? ' button-primary' : ''; ?>">
					<input id="ci-8" class="screen-reader-text" name="position" type="radio" value="8"<?php checked( 8, $pos ); ?> />
					<label for="ci-8" class="ci-8"><?php echo __('Bottom') .'-'. __('Right'); ?></label>
				</div>

			</div>
		</div>
	<?php
 } function image_resize_dimensions( $payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop) { if( false ) return $payload; if ( $crop ) { $aspect_ratio = $orig_w / $orig_h; $new_w = min($dest_w, $orig_w); $new_h = min($dest_h, $orig_h); $new_w = $new_w ? $new_w : intval($new_h * $aspect_ratio); $new_h = $new_h ? $new_h : intval($new_w / $aspect_ratio); $size_ratio = max($new_w / $orig_w, $new_h / $orig_h); $crop_w = round($new_w / $size_ratio); $crop_h = round($new_h / $size_ratio); $s_x_left = 0; $s_x_center = floor( ($orig_w - $crop_w) / 2 ); $s_x_right = floor( ($orig_w - $crop_w) ); $s_y_top = 0; $s_y_center = floor( ($orig_h - $crop_h) / 2 ); $s_y_bottom = floor( ($orig_h - $crop_h) ); $pos = $this->get_position(); if ( $pos == 0 ) { $s_x = $s_x_left; $s_y = $s_y_top; } elseif ( $pos == 1 ) { $s_x = $s_x_center; $s_y = $s_y_top; } elseif ( $pos == 2 ) { $s_x = $s_x_right; $s_y = $s_y_top; } elseif ( $pos == 3 ) { $s_x = $s_x_left; $s_y = $s_y_center; } elseif ( $pos == 4 ) { $s_x = $s_x_center; $s_y = $s_y_center; } elseif ( $pos == 5 ) { $s_x = $s_x_right; $s_y = $s_y_center; } elseif ( $pos == 6 ) { $s_x = $s_x_left; $s_y = $s_y_bottom; } elseif ( $pos == 7 ) { $s_x = $s_x_center; $s_y = $s_y_bottom; } elseif ( $pos == 8 ) { $s_x = $s_x_right; $s_y = $s_y_bottom; } else { $s_x = $s_x_center; $s_y = $s_y_center; } } else { $crop_w = $orig_w; $crop_h = $orig_h; $s_x = 0; $s_y = 0; list( $new_w, $new_h ) = wp_constrain_dimensions( $orig_w, $orig_h, $dest_w, $dest_h ); } if ( $new_w >= $orig_w && $new_h >= $orig_h ) return false; return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h ); } } ?>