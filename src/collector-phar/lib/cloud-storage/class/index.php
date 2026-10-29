<?php
namespace qqworld_collector; use Overtrue\Pinyin\Pinyin; define('QQWORLD_COLLECTOR_DIR', __DIR__ . DIRECTORY_SEPARATOR); if (isset($_GET['debug'])) error_reporting(E_ALL); include QQWORLD_COLLECTOR_DIR . 'lib.php'; include QQWORLD_COLLECTOR_DIR . 'upgrade.php'; include QQWORLD_COLLECTOR_DIR . 'options.php'; include QQWORLD_COLLECTOR_DIR . 'documents.php'; include QQWORLD_COLLECTOR_DIR . 'debug.php'; class qqworld_collector extends lib { var $options; var $settings_name = 'qqworld-collector-activation'; var $activation; public function __construct() { if ( ! function_exists( 'is_plugin_active_for_network' ) ) { require_once( ABSPATH . '/wp-admin/includes/plugin.php' ); } $this->domain = $this->get_domain(); $this->mode = is_plugin_active_for_network( basename(dirname(__FILE__)) . '/qqworld-collector.php' ) ? 'network' : 'blog'; $this->options = new options; $this->document = new documents; add_action( 'plugins_loaded', array($this, 'load_lib') ); add_action( 'plugins_loaded', array($this, 'load_modules') ); if ($this->mode == 'network') { add_action( 'admin_menu', array($this, 'admin_menu_for_network'), 1 ); add_action('network_admin_menu', array($this, 'admin_menu') ); } else { add_action( 'admin_menu', array($this, 'admin_menu'), 1 ); } add_action( 'wp_default_styles', array($this, 'wp_default_styles') ); add_action( 'wp_default_scripts', array($this, 'wp_default_scripts') ); add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts') ); add_action( 'add_meta_boxes', array($this, 'add_meta_box') ); add_action( 'media_buttons', array($this, 'media_buttons' ), 11 ); } public function admin_menu() { $page_title = __('QQWorld Collector', $this->text_domain); $menu_title = $page_title; $capability = $this->options->qc_authorization_who_can_use; $menu_slug = 'qqworld-collector'; $function = array($this, 'activation_page'); $icon_url = 'none'; $position = 100; $settings_page = add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position); add_action( "load-{$settings_page}", array($this, 'help_tab') ); } public function admin_menu_for_network() { $page_title = __('QQWorld Collector', $this->text_domain); $menu_title = $page_title; $capability = $this->options->qc_authorization_who_can_use; $menu_slug = 'qqworld-collector'; $function = array($this, 'for_network_page'); $icon_url = 'none'; $position = 100; $settings_page = add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position); add_action( "load-{$settings_page}", array($this, 'help_tab') ); } public function set_languages() { __('Image (%s)', $this->text_domain); __('Video (%s)', $this->text_domain); __('Text (%s)', $this->text_domain); __('Application (%s)', $this->text_domain); __('Audio (%s)', $this->text_domain); } public function for_network_page() { ?>
	<div class="wrap" id="qqworld-collector-settings">
		<h2 class="qc-icon medal"><?php _e('QQWorld Collector - Product Activation', $this->text_domain); ?></h2>
		<div id="message" class="updated notice is-dismissible"><p><?php printf(__('Please go to <a href="%s" target="_blank">Network admin page</a> to activate QQWorld Collector.', $this->text_domain), network_admin_url('admin.php?page=qqworld-collector')); ?></p></div>
		<p><?php _e('Do you feel it is a heavy workload to maintain your website? This plug-in will save you a lot of time! QQWorld collector is a Wordpress capture plug-in, built-in dozens of collection rules, featuring regular batch collection of WeChat public number and headline number, grab WeChat pictures, support watermark, support Aliyun OSS, UPYun, Tencent COS , QiNiu cloud storage and Baidu BOS, in particular, can automatically delete the local attachment after synchronization, establish a remote cloud media library...', $this->text_domain); ?></p>
		<figure id="banner-container">
			<img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/banner-772x250.jpg" width="772" height="250" id="banner" />
			<img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/packaging.png" class="packaging" />
		</figure>
	</div>
<?php
 } public function activation_page() { ?>
	<div class="wrap" id="qqworld-collector-settings">
		<div id="local-storage-notice" class="notice is-dismissible notice-warning">
			<p class="help"><?php printf(__('After purchasing the QQWorld collector, remember to <a href="%s" target="_blank">comment</a> within half a year and get %s of the points to redeem the coupon, but it cannot be re-acquired.', $this->text_domain), 'https://www.qqworld.org/product/qqworld-collector#comments', '10%'); ?></p>
		</div>
		<h2 class="qc-icon medal"><?php _e('QQWorld Collector - Product Activation', $this->text_domain); ?></h2>
		<p><?php _e('Do you feel it is a heavy workload to maintain your website? This plug-in will save you a lot of time! QQWorld collector is a Wordpress capture plug-in, built-in dozens of collection rules, featuring regular batch collection of WeChat public number and headline number, grab WeChat pictures, support watermark, support Aliyun OSS, UPYun, Tencent COS , QiNiu cloud storage and Baidu BOS, in particular, can automatically delete the local attachment after synchronization, establish a remote cloud media library...', $this->text_domain); ?></p>
		<figure id="banner-container">
			<img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/banner-772x250.jpg" width="772" height="250" id="banner" />
			<img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/packaging.png" class="packaging" />
		</figure>

		<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
			<a href="#activation" class="nav-tab qc-icon unlock"><?php _e('Activation', $this->text_domain); ?></a>
			<a href="#whois" class="nav-tab qc-icon search"><?php _e('Whois', $this->text_domain); ?></a>
			<a href="#upgrade" class="nav-tab qc-icon download"><?php _e('Upgrade', $this->text_domain); ?></a>
			<a href="#environment" class="nav-tab qc-icon tree"><?php _e('Environment', $this->text_domain); ?></a>
			<a href="#edition-differences" class="nav-tab qc-icon diff"><?php _e('Edition Differences', $this->text_domain); ?></a>
			<a href="#contact" class="nav-tab qc-icon profile"><?php _e('Contact', $this->text_domain); ?></a>
		</h2>
		<!-- Activation - start -->
		<div class="nav-section"><?php do_action( 'qqworld-product-activation-list' ); ?></div>
		<!-- Activation - end -->
		<!-- Whois - start -->
		<div class="nav-section hidden"><?php do_action( 'qqworld-product-whois-query' ); ?></div>
		<!-- Whois - end -->
		<!-- Upgrade - start -->
		<div class="nav-section hidden">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for=""><?php _e('Download', $this->text_domain); ?></label></th>
						<td>
							<a href="https://pan.baidu.com/s/17xOeihj6AvEPvgQnzHwuIA" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Baidi Network Disk', $this->text_domain); ?></a>
							<a href="https://drive.google.com/open?id=0B8SziOUSW1wpT283ZWc5ZUNsUXM" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Google Drive', $this->text_domain); ?></a>
							<p><?php _e('Check here for new releases.', $this->text_domain); ?></p><br />
						</td>
					</tr>
					<tr>
						<th scope="row"><label for=""><?php _e('How to Upgrade', $this->text_domain); ?></th>
						<td>
						<p><?php _e("The easy way is to delete the plugin, upload the zip package in the plugins page to automatically install the plugin.<br />Don't worry, it will not lose any data.", $this->text_domain); ?></p>
						<?php
 $plugin_url = is_multisite() ? admin_url('network/plugins.php') : admin_url('plugins.php'); $add_plugin_url = is_multisite() ? admin_url('network/plugin-install.php') : admin_url('plugin-install.php'); ?>
						<p><strong><?php _e('Details', $this->text_domain); ?></strong></p>
						<ol class="how-to-upgrade">
							<li><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/upgrade/1.png" /><p><?php printf(_x('<a href="%s" target="_blank">Download</a> zip file of new version.', 'update plugin', $this->text_domain), 'https://pan.baidu.com/s/17xOeihj6AvEPvgQnzHwuIA'); ?></p></li>
							<li><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/upgrade/2.png" /><p><?php printf(_x('<a href="%s" target="_blank">Deactivate and delete</a> the QQWorld Collector.', 'update plugin', $this->text_domain), $plugin_url); ?></p></li>
							<li><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/upgrade/3.png" /><p><?php printf(_x('<a href="%s" target="_blank">Upload and install</a> the new version.', 'update plugin', $this->text_domain), $add_plugin_url); ?></p></li>
							<li><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/upgrade/4.png" /><p><?php printf(_x('<a href="%s" target="_blank">Activate</a> the QQWorld Collector.', 'update plugin', $this->text_domain), admin_url('plugins.php')); ?></p></li>
							<li><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/upgrade/5.png" /><p><?php printf(_x('<a href="%s" target="_blank">Activate</a> the Product of QQWorld Collector.', 'update plugin', $this->text_domain), admin_url('admin.php?page=qqworld-collector')); ?></p></li>
						</ol>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Upgrade - end -->
		<!-- Environment - start -->
		<div class="nav-section hidden">
			<p><?php _e('This table will tell you the operating environment that this plug-in needs.', $this->text_domain); ?></p>
			<table id="environment-list-table" class="wp-list-table widefat striped plugins">
				<thead>
					<tr>
						<td class="manage-column column-cb check-column"></td>
						<th scope="col" class="manage-column column-primary"><?php _e('Title'); ?></th>
						<th scope="col" class="manage-column"><?php _e('Description', $this->text_domain); ?></th>
						<th scope="col" class="manage-column"><?php _e('Importance', $this->text_domain); ?></th>
						<th scope="col" class="manage-column"><?php _e('Status', $this->text_domain); ?></th>
						<th scope="col" class="manage-column"><?php _ex('Method', 'environment', $this->text_domain); ?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td class="manage-column column-cb check-column"></td>
						<th scope="col" class="manage-column column-primary"><?php _e('Title'); ?></th>
						<th scope="col" class="manage-column"><?php _e('Description', $this->text_domain); ?></th>
						<th scope="col" class="manage-column"><?php _e('Importance', $this->text_domain); ?></th>
						<th scope="col" class="manage-column"><?php _e('Status', $this->text_domain); ?></th>
						<th scope="col" class="manage-column"><?php _ex('Method', 'environment', $this->text_domain); ?></th>
					</tr>
				</tfoot>
				<tbody id="the-environment">
					<?php do_action('qqworld-collector-environment-list-before'); ?>
					<?php $is_supported = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Public IP Address', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('This plugin cannot be used in a LAN.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Very High', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php _e('Put the website on the public network.', $this->text_domain); ?></td>
					</tr>
					<?php $is_supported = !is_plugin_active( 'qqworld-auto-save-images/qqworld-auto-save-images.php' ); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Plugin Conflict', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Cannot be enabled at the same time as the free version.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Very High', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php _e('Disable or delete QQWorld auto save images.', $this->text_domain); ?></td>
					</tr>
					<?php
 $num_cpus = $this->num_cpus(); $is_supported = $num_cpus != 1; ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Number of CPU Core', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Collecting images is very resource intensive, Single-core CPUs tend to cause server stalls during acquisition.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Midium', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php printf(__("The number of cores for upgrading the CPU is at least 2. (Current server's cpu core number: %d)", $this->text_domain), $num_cpus); ?></td>
					</tr>
					<?php $is_supported = function_exists('curl_init'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary">cURL</td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('cURL is a file transfer tool that works under the command line using URL syntax to collect remote attachments or web pages.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Very High', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'cURL'); ?></td>
					</tr>
					<?php $is_supported = function_exists('file_get_contents') && ini_get('allow_url_fopen') == 1; ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('File System Functions', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Collect remote attachments or web pages.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Very High', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php _e('Please Make sure the server configuration <strong>allow_url_fopen=1</strong> in php.ini.', $this->text_domain); ?></td>
					</tr>
					<?php $is_supported = function_exists('openssl_encrypt'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('OpenSSL', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Used to grab ssl(https) links.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Very High', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'OpenSSL'); ?></td>
					</tr>
					<?php $is_supported = extension_loaded('gd'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary">GD</td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('A GD image function library that processes images.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('High', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'GD2'); ?></td>
					</tr>
					<?php $is_supported = class_exists('Imagick'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('ImageMagick high performance graphics library', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e("Convert webp and bmp image type to jpg, recommended, if you have already installed this, you don't need to install WEBP library and BMP Support.", $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Midium', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'imageMagick'); ?></td>
					</tr>
					<?php $is_supported = function_exists('imagecreatefromwebp'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('WEBP library', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Convert webp image type to jpg.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Midium', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Upgrade PHP to at least version %s', $this->text_domain), 5.5); ?></td>
					</tr>
					<?php $is_supported = function_exists('imagecreatefrombmp'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary">BMP</td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Convert bmp image type to jpg.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Midium', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php
 if (version_compare(PHP_VERSION, '7.2.0', '>=')) { printf(__('Upgrade PHP to at least version %s', $this->text_domain), 7.2); } else { printf(__('Your php version is lower than 7.2.0, so you are using an unofficial BMP handler.', $this->text_domain), 7.2); } ?></td>
					</tr>
					<?php $is_supported = function_exists('finfo_open'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('File Infomation', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Recognizes encrypted file information for capturing downloadable files and fatch the image of the file protocol(file:///).', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('High', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'fileinfo'); ?></td>
					</tr>
					<?php $is_supported = function_exists('mb_convert_encoding'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Conversion Character Encoding', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Convert HTML to UTF8 encoding during collection.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Very High', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'mbstring'); ?></td>
					</tr>
					<?php
 $wp_config = file_get_contents(ABSPATH . 'wp-config.php'); $is_supported = preg_match('/WP_MEMORY_LIMIT/i', $wp_config); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Memory Limit', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Specify the maximum amount of memory that can be consumed by PHP, Prevent certain programs from causing Wordpress to run out of memory..', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Low', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php _e("Add <strong>define( 'WP_MEMORY_LIMIT', '256M' );</strong> into the front of the content of <em>wp-config.php</em>.", $this->text_domain); ?></td>
					</tr>
					<?php
 $max_input_vars = ini_get('max_input_vars'); $is_supported = $max_input_vars > 5000; ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Max Input Variable', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('The maximum number of variables that can be used in the form, if the collection project you created is too complex, exceeding the form item limit will result in an inability to save.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('Very Low', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Method', 'environment', $this->text_domain); ?>"><?php _e('Change the <em>max_input_vars</em> value in php.ini to 10000.', $this->text_domain); ?></td>
					</tr>
					<?php $is_supported = empty(ini_get('open_basedir')); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('File Operations Base Directory', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('The directory synchronization site resource could not be scanned in the cloud storage.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>"><?php _e('High', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php _e('Clear the value of <strong>open_basedir</strong> in php.ini, or in .htaccess or .user.ini in the root of the website.<br />For example, in the Pagoda panel, there is a website setting called <strong>Preventing Cross-Site Attacks</strong> that automatically generates this setting to <em>.user.ini</em>.', $this->text_domain); ?></td>
					</tr>
					<?php do_action('qqworld-collector-environment-list-after'); ?>
				</tbody>
			</table>
		</div>
		<!-- Environment - end -->
		<!-- Edition Differences - start -->
		<div class="nav-section hidden">
			<table id="product-info" class="wp-list-table widefat striped posts">
				<thead>
					<tr>
						<td class="manage-column column-cb check-column"></td>
						<th class="manage-column column-primary"><?php _ex('Feature Description', 'activation', $this->text_domain); ?></th>
						<th class="manage-column aligncenter"><?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?></th>
						<th class="manage-column aligncenter"><?php _ex('Server Edition', 'activation', $this->text_domain); ?></th>
						<th class="manage-column aligncenter"><?php _ex('Professional Edition', 'activation', $this->text_domain); ?></th>
						<th class="manage-column aligncenter"><?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td class="manage-column column-cb check-column"></td>
						<th class="manage-column column-primary"><?php _ex('Feature Description', 'activation', $this->text_domain); ?></th>
						<th class="manage-column aligncenter"><?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?></th>
						<th class="manage-column aligncenter"><?php _ex('Server Edition', 'activation', $this->text_domain); ?></th>
						<th class="manage-column aligncenter"><?php _ex('Professional Edition', 'activation', $this->text_domain); ?></th>
						<th class="manage-column aligncenter"><?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?></th>
					</tr>
				</tfoot>
				<tbody>
					<tr class="priceRowTop">
						<th scope="row" class="check-column"></th>
						<td class="column-primary">
						<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>399.00</span>'); ?></td>
						<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>199.00</span>'); ?></td>
						<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>129.00</span>'); ?></td>
						<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>99.00</span>'); ?></td>
					</tr>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="column-primary qc-svg collection">
							<strong><?php _e('Collection Project', $this->text_domain); ?></strong>
							<ol>
								<li><?php _e('Self-built collection project, set collection rules, using object-oriented programming compared to 2.x, it is very convenient to collect AJAX loaded pages and filter any collected content.', $this->text_domain); ?></li>
								<li><?php _e('Manual collection, you can select the posts to be collected, you can collect them by importing archive links or singular post links.', $this->text_domain); ?></li>
								<li><?php _e('Automatically collect, set up scheduled tasks, and let the website automatically collect posts.', $this->text_domain); ?></li>
								<li><?php _e('A template that automatically adds a header template and a footer template to the collected posts in the collection project.', $this->text_domain); ?></li>
								<li><?php _e('Collection project store with video tutorials. You can purchase collection project directly.', $this->text_domain); ?></li>
								<li><?php _e('Basically, as long as it is not a digital signature encrypted website, it can be collected.', $this->text_domain); ?></li>
							</ol>
							<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
						</td>
						<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
						<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
						<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					</tr>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="column-primary qc-svg attachments">
							<strong><?php _e('Auto Save Attachment', $this->text_domain); ?></strong>
							<ol>
								<li><?php _e('Automatically save remote attachments, as long as the file format allowed by the Wordpress media library can be crawled.', $this->text_domain); ?></li>
								<li><?php _e('Format the HTML code of the collected remote image.', $this->text_domain); ?></li>
								<li><?php _e('You can not use the media library.', $this->text_domain); ?></li>
								<li><?php _e('Scan the post to automatically save remote attachments from the old post to local.', $this->text_domain); ?></li>
								<li><?php _e('Set up scheduled tasks to scan posts.', $this->text_domain); ?></li>
								<li><?php _e('Set thumbnail crop position.', $this->text_domain); ?></li>
							</ol>
							<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
						</td>
						<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					</tr>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="column-primary qc-svg watermark">
							<strong><?php _e('Watermark', $this->text_domain); ?></strong>
							<ol>
								<li><?php _e('Both image watermark and text watermark are supported.', $this->text_domain); ?></li>
								<li><?php _e('Scan the media library to watermark the image.', $this->text_domain); ?></li>
							</ol>
							<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
						</td>
						<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					</tr>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="column-primary qc-svg translate">
							<strong><?php _e('Translate', $this->text_domain); ?></strong>
							<ol>
								<li><?php _e("You can use Baidu translation, Google free translation, Google translation and Simplified and Traditional chinese to translate the content of the article automatically or manually.", $this->text_domain); ?></li>
								<li><?php _e('Support automatic translation, manual translation or translation at the time of collection.', $this->text_domain); ?></li>
								<li><?php _e('Automatically translate post name.', $this->text_domain); ?></li>
							</ol>
							<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
						</td>
						<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
						<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					</tr>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="column-primary qc-svg cloud-storage">
							<strong><?php _e('Cloud Storage', $this->text_domain); ?></strong>
							<p class="description"><?php _e("A domain that serves no cookies. The idea here is that you use a cookie-free domain to serve images, CSS files, scripts and whatnot, so that your users don't waste time and bandwidth transmitting cookies for them.", $this->text_domain); ?></p>
							<ol>
								<li><?php _e("Cookie-free domain: use the local server save attachments, the idea here is that you use a cookie-free domain to serve images, CSS files, scripts and whatnot, so that your users don't waste time and bandwidth transmitting cookies for them.", $this->text_domain); ?></li>
								<li><?php _e('Controllable Cloud Storage: FTP, Aliyun OSS, QiNiu Cloud Storage, UpYun Cloud Storage, Tencent COS, Baidu BOS, UCloud UFile Storage. Most of these cloud storage require payment, but data security is higher.', $this->text_domain); ?></li>
								<li><?php _e('Others Cloud Storage: Sina images storage, SM.MS etc. These cloud storage are free, but the resources are less controllable and have the potential to be lost.', $this->text_domain); ?></li>
							</ol>
							<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
						</td>
						<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
						<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					</tr>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="column-primary qc-svg proxy">
							<strong><?php _e('Proxy', $this->text_domain); ?></strong>
							<ol>
								<li><?php _e("Static Proxy: You can directly fill in the IP and port of the proxy server, I hope you have fast proxy server.", $this->text_domain); ?></li>
								<li><?php _e('Dynamic proxy: All are paid proxy, you need to fill in the URL to dynamically get the proxy address.', $this->text_domain); ?></li>
							</ol>
							<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
						</td>
						<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
						<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
						<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>

					</tr>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="column-primary qc-svg database">
							<strong><?php _e('Database', $this->text_domain); ?></strong>
							<p class="description"><?php _e("Help you to handle database content easily.", $this->text_domain); ?>
							<ol>
								<li><?php _e('Modify some characters in the database in batches.', $this->text_domain); ?></li>
								<li><?php _e('Batch restore the address of the controllable cloud storage to the local address.', $this->text_domain); ?></li>
								<li><?php _e('Automatically wipe specified tags or attributes in the post content.', $this->text_domain); ?></li>
							</ol>
							<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
						</td>
						<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
						<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					</tr>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="column-primary qc-svg anchor">
							<strong><?php _e('Automatic Anchor', $this->text_domain); ?></strong>
							<p class="description"><?php _e('Automatically add tags anchor to the keywords in the post content.', $this->text_domain); ?></p>
							<ol>
								<li><?php _e('The anchor link is automatically set according to the manually set keywords when the post content is output.', $this->text_domain); ?></li>
								<li><?php _e('Automatically set up existing article tags.', $this->text_domain); ?></li>
							</ol>
							<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
						</td>
						<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
						<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
						<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					</tr>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="column-primary qc-svg pseudo-original">
							<strong><?php _e('Pseudo Original', $this->text_domain); ?></strong>
							<p class="description"><?php _e('Automatically replace the keywords in the post content.', $this->text_domain); ?></p>
							<ol>
								<li><?php _e('Built-in tens of thousands of thesaurus.', $this->text_domain); ?></li>
								<li><?php _e('The thesaurus can be built manually.', $this->text_domain); ?></li>
							</ol>
							<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
						</td>
						<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
						<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
						<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					</tr>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="column-primary qc-svg cleaner">
							<strong><?php _e('Cleaner', $this->text_domain); ?></strong>
							<p class="description"><?php _e('If you have a huge media library and do not know how many attachments has not bean used. this tool will help you to find out.', $this->text_domain); ?></p>
							<ol>
								<li><?php _e('Scan for attachments that are not in use and automatically delete them.', $this->text_domain); ?></li>
								<li><?php _e('Attachments to post are automatically deleted when the post is deleted.', $this->text_domain); ?></li>
								<li><?php _e('Automatically delete duplicated posts.', $this->text_domain); ?></li>
								<li><?php _e('Automatically delete empty posts.', $this->text_domain); ?></li>
							</ol>
							<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
						</td>
						<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
						<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					</tr>
					<tr class="priceRowBottom">
						<th scope="row" class="check-column"></th>
						<td class="column-primary">
						<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>399.00</span>'); ?></td>
						<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>199.00</span>'); ?></td>
						<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>129.00</span>'); ?></td>
						<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>99.00</span>'); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Edition Differences - end -->
		<!-- Contact - start -->
		<div class="nav-section hidden">
			<table id="contact-list" class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for=""><?php _ex('Developer', 'contact', $this->text_domain); ?></label></th>
						<td><?php _e('Michael Wang', $this->text_domain); ?></td>
					</tr>
					<tr>
						<th scope="row"><label for=""><?php _e('Official Website', $this->text_domain); ?></label></th>
						<td><a href="https://www.qqworld.org" target="_blank" class="button button-primary qc-icon link"><?php _e("QQWorld's Projects", $this->text_domain); ?></a></td>
					</tr>
					<tr>
						<th scope="row"><label for=""><?php _e('Email'); ?></label></th>
						<td><a href="mailto:<?php _e('Michael Wang', $this->text_domain); ?> <admin@qqworld.org>" class="button button-primary qc-icon mail">admin@qqworld.org</a></td>
					</tr>
					<tr>
						<th scope="row"><label for=""><?php _e('Tencent QQ', $this->text_domain); ?></label></th>
						<td><a href="http://wpa.qq.com/msgrd?v=3&uin=172269588&site=qq&menu=yes">172269588</a> (<?php printf(__('%s: ', $this->text_domain), __('QQ Group', $this->text_domain)); ?>3372914)<br /><br />
						<img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/qrcode/qq-follow.png" class="qq qr-code" />
						<p><?php _e('Please use the QQ APP to scan the QR code.', $this->text_domain); ?></p></td>
					</tr>
					<tr>
						<th scope="row"><label for=""><?php _e('Wechat', $this->text_domain); ?></label></th>
						<td><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/qrcode/wechat-follow.png" class="qr-code" />
						<p><?php _e('Please use the WeChat APP to scan the QR code.', $this->text_domain); ?></p></td>
					</tr>
					<tr>
						<th scope="row"><label for=""><?php _e('Alipay', $this->text_domain); ?></label></th>
						<td><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/qrcode/alipay-follow.png" class="qr-code" />
						<p><?php _e('Please use the Alipay APP to scan the QR code.', $this->text_domain); ?></p></td>
					</tr>
					<tr>
						<th scope="row"><label for=""><?php _e('Cellphone', $this->text_domain); ?></label></th>
						<td><a href="tel:13294296711" class="button button-primary qc-icon phone">13294296711</a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Contact - end -->
	</div>
<?php
 } public function wp_default_styles(&$styles) { $styles->add( 'animate', QQWORLD_COLLECTOR_URL . 'css/animate.min.css' ); $styles->add( 'noty', QQWORLD_COLLECTOR_URL . 'js/noty/noty.css' ); $styles->add( 'qqworld-collector-admin-style', QQWORLD_COLLECTOR_URL . 'css/admin.css' ); $styles->add( 'qqworld-collector-documents', QQWORLD_COLLECTOR_URL . 'css/documents.css' ); $styles->add( 'qqworld-collector-auto-save-attachment-admin', QQWORLD_COLLECTOR_URL . 'css/auto-save-attachment.admin.css' ); $styles->add( 'qqworld-collector-auto-save-attachment-manual', QQWORLD_COLLECTOR_URL . 'css/auto-save-attachment.manual.css' ); $styles->add( 'qqworld-collector-auto-save-attachment-auto', QQWORLD_COLLECTOR_URL . 'css/auto-save-attachment.auto.css' ); $styles->add( 'qqworld-collector-floating-panel', QQWORLD_COLLECTOR_URL . 'css/floating-panel.css' ); $styles->add( 'prism', QQWORLD_COLLECTOR_URL . 'js/prism/prism.css' ); $styles->add( 'qqworld-collector-cloud-storage-admin', QQWORLD_COLLECTOR_URL . 'css/cloud-storage.admin.css' ); $styles->add( 'qqworld-collector-translate-manual', QQWORLD_COLLECTOR_URL . 'css/translate.manual.css' ); $styles->add( 'qqworld-collector-watermark-admin', QQWORLD_COLLECTOR_URL . 'css/watermark.css' ); $styles->add( 'qqworld-collector-auxiliary-settings', QQWORLD_COLLECTOR_URL . 'css/auxiliary.edit.css' ); $styles->add( 'qqworld-collector-collection-projects-edit', QQWORLD_COLLECTOR_URL . 'css/collection-projects.edit.css' ); $styles->add( 'qqworld-collector-collection-projects-post', QQWORLD_COLLECTOR_URL . 'css/collection-projects.post.css' ); $styles->add( 'thumbnail-crop-position', QQWORLD_COLLECTOR_URL . 'css/thumbnail-crop-position.css' ); } public function wp_default_scripts(&$scripts) { $scripts->add( 'thumbnail-crop-position', QQWORLD_COLLECTOR_URL . 'js/thumbnail-crop-position.js', array('jquery'), '1.0', true ); $scripts->add( 'qqworld-responsive-navigation', QQWORLD_COLLECTOR_URL . 'js/jquery.qqworld_responsive_navigation-min.js', array('jquery'), '1.0', true ); $scripts->add( 'serialize-object', QQWORLD_COLLECTOR_URL . 'js/jquery.serialize-object.min.js', array('jquery'), '2.5', true ); $scripts->add( 'noty', QQWORLD_COLLECTOR_URL . 'js/noty/noty.min.js', array('jquery'), '3.1.4', true ); $scripts->add( 'sprintf', QQWORLD_COLLECTOR_URL . 'js/jquery.sprintf.js', array('jquery'), '0.0.6', true ); $scripts->add( 'scrollTo', QQWORLD_COLLECTOR_URL . 'js/jquery.scrollTo.min.js', array('jquery'), '1.4.3.1', true ); $scripts->add( 'qqworld-collector-admin-script', QQWORLD_COLLECTOR_URL . 'js/admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-documents', QQWORLD_COLLECTOR_URL . 'js/documents.js', array('jquery', 'qqworld-collector-admin-script'), null, true ); $scripts->add( 'qqworld-collector-auto-save-attachment-admin', QQWORLD_COLLECTOR_URL . 'js/auto-save-attachment.admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-auto-save-attachment-manual', QQWORLD_COLLECTOR_URL . 'js/auto-save-attachment.manual.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-floating-panel', QQWORLD_COLLECTOR_URL . 'js/floating-panel.js', array('jquery'), null, true ); $scripts->add( 'prism', QQWORLD_COLLECTOR_URL . 'js/prism/prism.js', null, null, true ); $scripts->add( 'base64', QQWORLD_COLLECTOR_URL . 'js/base64.js', null, null, true ); $scripts->add( 'qqworld-collector-cleaner-admin', QQWORLD_COLLECTOR_URL . 'js/cleaner.admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-cloud-storage-admin', QQWORLD_COLLECTOR_URL . 'js/cloud-storage.admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-cloud-storage-upload', QQWORLD_COLLECTOR_URL . 'js/cloud-storage.upload.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-proxy-admin', QQWORLD_COLLECTOR_URL . 'js/proxy.admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-anchor-admin', QQWORLD_COLLECTOR_URL . 'js/anchor.admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-pseudo-original-admin', QQWORLD_COLLECTOR_URL . 'js/pseudo-original.admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-database-admin', QQWORLD_COLLECTOR_URL . 'js/database.admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-translate-core', QQWORLD_COLLECTOR_URL . 'js/translate.core.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-translate-admin', QQWORLD_COLLECTOR_URL . 'js/translate.admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-translate-manual', QQWORLD_COLLECTOR_URL . 'js/translate.manual.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-settings-admin', QQWORLD_COLLECTOR_URL . 'js/settings.js', array('jquery'), null, true ); $scripts->add( 'qqworld-md5', QQWORLD_COLLECTOR_URL . 'js/md5.js' ); $scripts->add( 'qqworld-pwd', QQWORLD_COLLECTOR_URL . 'js/pwd.min.js' ); $scripts->add( 'qqworld-collector-watermark-admin', QQWORLD_COLLECTOR_URL . 'js/watermark.admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-import-export-admin', QQWORLD_COLLECTOR_URL . 'js/import-export-admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collected-posts', QQWORLD_COLLECTOR_URL . 'js/collected-posts.admin.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-engine', QQWORLD_COLLECTOR_URL . 'js/collection-projects.engine.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-edit-common', QQWORLD_COLLECTOR_URL . 'js/collection-projects.edit.common.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-edit-import', QQWORLD_COLLECTOR_URL . 'js/collection-projects.edit.import.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-edit-manual', QQWORLD_COLLECTOR_URL . 'js/collection-projects.edit.manual.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-edit-automatic', QQWORLD_COLLECTOR_URL . 'js/collection-projects.edit.automatic.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-edit-shop', QQWORLD_COLLECTOR_URL . 'js/collection-projects.edit.shop.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-post-advanced-request', QQWORLD_COLLECTOR_URL . 'js/collection-projects.post.advanced_request.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-post-collecting-items', QQWORLD_COLLECTOR_URL . 'js/collection-projects.post.collecting_items.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-post-links', QQWORLD_COLLECTOR_URL . 'js/collection-projects.post.links.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-post-archive', QQWORLD_COLLECTOR_URL . 'js/collection-projects.post.archive.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-post-archive-test', QQWORLD_COLLECTOR_URL . 'js/collection-projects.post.archive.test.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-post-singular', QQWORLD_COLLECTOR_URL . 'js/collection-projects.post.singular.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-post-singular-test', QQWORLD_COLLECTOR_URL . 'js/collection-projects.post.singular.test.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-post-format', QQWORLD_COLLECTOR_URL . 'js/collection-projects.post.format.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-post-settings', QQWORLD_COLLECTOR_URL . 'js/collection-projects.post.settings.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-post-common', QQWORLD_COLLECTOR_URL . 'js/collection-projects.post.common.js', array('jquery'), null, true ); $scripts->add( 'qqworld-collector-collection-projects-post-tabs', QQWORLD_COLLECTOR_URL . 'js/collection-projects.post.tabs.js', array('jquery', 'qqworld-collector-collection-projects-post-common'), null, true ); } public function admin_enqueue_scripts() { wp_enqueue_style('qqworld-collector-admin-style'); wp_enqueue_script('qqworld-collector-admin-script'); $translation_array = array( 'url' => array(), 'text' => array( 'yes' => __('Yes'), 'no' => __('No'), 'delete' => __('Delete'), 'error' => __('Something error, please check.', $this->text_domain), 'your_sure' => __('Are you sure?', $this->text_domain), 'edit' => __('Edit'), 'cancel' => __('Cancel'), 'title' => __('Title'), 'type' => __('Type'), 'save_change' => __('Save Changes'), 'save' => __('Save'), 'test' => __('Test', $this->text_domain), 'show_more_details' => __('Show more details'), 'all' =>__('All'), 'value' => __('Value'), 'name' =>__('Name', $this->text_domain), 'minimize' =>__('Minimize', $this->text_domain), 'maximize' =>__('Maximize', $this->text_domain), 'failed' => __('Failed', $this->text_domain) ) ); $translation_array = apply_filters( 'qqworld-collector-script-translation-array', $translation_array); wp_localize_script('qqworld-collector-admin-script', 'QC', $translation_array, '1.0.0'); } public function load_lib() { $libs = array('cache', 'core'); foreach ($libs as $lib) { include QQWORLD_COLLECTOR_DIR . $lib . '.php'; $classname = str_replace('-', '_', $lib); $class = "qqworld_collector\\lib\\{$classname}"; $this->$classname = new $class; $this->$classname->options = $this->options; } } public function load_modules() { $modules = array('collector', 'auto-save-attachment', 'watermark', 'translate', 'cloud-storage', 'proxy', 'database', 'anchor', 'pseudo-original', 'cleaner', 'settings', 'import_export'); foreach ($modules as $module) { include QQWORLD_COLLECTOR_DIR . 'modules' . DIRECTORY_SEPARATOR . $module . '.php'; $classname = str_replace('-', '_', $module); $class = "qqworld_collector\\module\\{$classname}"; $this->$classname = new $class; $this->$classname->options = $this->options; } } public function add_meta_box() { $id = 'qqworld-collector-settings'; $title = __('QQWorld Collector Settings', $this->text_domain); $screen = get_post_types(array('public'=>true, 'show_ui' => true)); $callback = array( $this, 'render_qqworld_collector_settings' ); $context = 'side'; $priority = 'default'; $callback_args = null; add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args ); } public function render_qqworld_collector_settings() { do_action( 'qqworld-collector-settings-meta-box' ); } public function media_buttons() { do_action( 'qqworld-collector-add-media-buttons-for-menual-mode' ); } } $GLOBALS['QC'] = new qqworld_collector; ?>