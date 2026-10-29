<?php
namespace qqworld_collector\module\watermark; use qqworld_collector\lib; class add_watermark_when_upload extends lib { var $options; var $settings; var $log_id = 'add-watermark-when-upload'; public function __construct() { add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts') ); } public function admin_enqueue_scripts() { wp_enqueue_script( 'watermark-upload' ); } public function init() { global $pagenow; if ($pagenow == 'media-new.php') { add_action( 'post-upload-ui', array( $this, 'uploader_controls' ) ); } else { add_action( 'pre-upload-ui', array( $this, 'uploader_controls' ) ); } } public function uploader_controls() { $add_image_watermark = isset($_COOKIE['QQWORLD-COLLECTOR-ADD-IMAGE-WATERMARK-WHEN-UPLOAD']) ? $_COOKIE['QQWORLD-COLLECTOR-ADD-IMAGE-WATERMARK-WHEN-UPLOAD'] : $this->options->qc_watermark_image_enabled; setcookie('QQWORLD-COLLECTOR-ADD-IMAGE-WATERMARK-WHEN-UPLOAD', $add_image_watermark, array( 'expires' => time() + 600, 'path' => '/', 'domain' => '', 'secure' => true, 'httponly' => true, 'samesite' => 'None' )); $add_text_watermark = isset($_COOKIE['QQWORLD-COLLECTOR-ADD-TEXT-WATERMARK-WHEN-UPLOAD']) ? $_COOKIE['QQWORLD-COLLECTOR-ADD-TEXT-WATERMARK-WHEN-UPLOAD'] : $this->options->qc_watermark_text_enabled; setcookie('QQWORLD-COLLECTOR-ADD-TEXT-WATERMARK-WHEN-UPLOAD', $add_text_watermark, array( 'expires' => time() + 600, 'path' => '/', 'domain' => '', 'secure' => true, 'httponly' => true, 'samesite' => 'None' )); ?>
		<div class="add-watermark-position text-aligncenter">
			<p><label for="allow-add-image-watermark"><?php printf(__('%s: '), __( 'Add Image Watermark', $this->text_domain ));?></label></p>
			<div class="watermark-controls">
				<?php
 $this->the_switcher(array( 'id' => 'allow-add-image-watermark', 'name' => 'allow-image-wartermark', 'value' => $add_image_watermark )); ?>
			</div>
			<p><label for="allow-text-watermark"><?php printf(__('%s: '), __( 'Add Text Watermark', $this->text_domain ));?></label></p>
			<div class="watermark-controls">
				<?php
 $this->the_switcher(array( 'id' => 'allow-add-text-watermark', 'name' => 'allow-text-wartermark', 'value' => $add_text_watermark )); ?>
			</div>
			<p>&nbsp;</p>
		</div>
	<?php
 } } ?>