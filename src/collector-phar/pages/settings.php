<div class="wrap" id="qqworld-collector-settings">
	<h2 id="header-title"><?php _e("Settings", $this->text_domain); ?></h2>
	<form action="options.php" method="post" id="form">
		<?php settings_fields($this->settings_name); ?>
		<?php
 $nav_tabs = array( 'server' => __('Server', $this->text_domain), 'authorization' => __('Authorization', $this->text_domain), 'graphic' => __('Graphic', $this->text_domain) ); $nav_tabs = apply_filters( 'qqworld-collector-settings-nav-tabs', $nav_tabs ); if (!isset($GLOBALS['QC-DISPLAY-SERVER-IN-SETTINGS']) || !$GLOBALS['QC-DISPLAY-SERVER-IN-SETTINGS']) { unset($nav_tabs['server']); unset($nav_tabs['graphic']); } $this->the_nav_tabs($nav_tabs); do_action( 'qqworld-collector-settings-nav-sections-before' ); if (isset($GLOBALS['QC-DISPLAY-SERVER-IN-SETTINGS']) && $GLOBALS['QC-DISPLAY-SERVER-IN-SETTINGS']) : ?>
		<!-- Server - start -->
		<div class="nav-section hidden">
		<?php if (function_exists('opcache_compile_file')) : ?>
			<h2><?php _e('Reset OPcache', $this->text_domain); ?></h2>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="reset-opcache"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'reset-opcache', 'name' => 'reset-opcache', 'value' => 0 )); ?>
							<p class="description"><?php _e('Manually clear the OPcache cache.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		<?php endif; ?>
		<?php if (class_exists('Memcached') || class_exists('Redis')) : ?>
			<h2><?php _e('Auto Flush Cache of Memcached/Redis', $this->text_domain); ?></h2>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="flush-memcached-redis"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'flush-memcached-redis', 'name' => $this->settings_name . '[flush-memcached-redis]', 'value' => $this->options->flush_memcached_redis )); ?>
							<p class="description"><?php _e('If you have installed a database cache and are troubled by data delays when using the plug-in, you can try enabling this option. Note that this feature may reduce cache efficiency.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		<?php endif; ?>
			<h2><?php _e('Webserver Stress', $this->text_domain); ?></h2>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="speed_for_manual_mode"><?php _e('Speed', $this->text_domain); ?></label></th>
						<td>
							<select id="speed_for_manual_mode" name="<?php print $this->settings_name; ?>[stress][manual-speed]" class="selectstyle">
								<optgroup label="<?php _e('Normal server (1-2 cores)', $this->text_domain); ?>">
								<?php for ($i=1; $i<5; $i++) : ?>
									<option value="<?php echo $i; ?>"<?php selected($i, $this->options->qc_stress_manual_speed); ?>><?php echo $i; ?></option>
								<?php endfor; ?>
								</optgroup>
								<optgroup label="<?php _e('High performance server (3-6 cores)', $this->text_domain); ?>">
								<?php for ($i=5; $i<11; $i++) : ?>
									<option value="<?php echo $i; ?>"<?php selected($i, $this->options->qc_stress_manual_speed); ?>><?php echo $i; ?></option>
								<?php endfor; ?>
								</optgroup>
								<optgroup label="<?php _e('Ultra high performance server (7-128 cores)', $this->text_domain); ?>">
									<option value="15"<?php selected(15, $this->options->qc_stress_manual_speed); ?>>15</option>
									<option value="20"<?php selected(20, $this->options->qc_stress_manual_speed); ?>>20</option>
									<option value="25"<?php selected(25, $this->options->qc_stress_manual_speed); ?>>25</option>
									<option value="30"<?php selected(30, $this->options->qc_stress_manual_speed); ?>>30</option>
									<option value="35"<?php selected(35, $this->options->qc_stress_manual_speed); ?>>35</option>
									<option value="40"<?php selected(40, $this->options->qc_stress_manual_speed); ?>>40</option>
									<option value="45"<?php selected(45, $this->options->qc_stress_manual_speed); ?>>45</option>
									<option value="50"<?php selected(50, $this->options->qc_stress_manual_speed); ?>>50</option>
									<option value="0"<?php selected(0, $this->options->qc_stress_manual_speed); ?>><?php _e('Unlimited', $this->text_domain);?></option>
								</optgroup>
							</select>
							<p class="description"><?php _e('For Manual Mode, if your server is not powerful. use a low speed will be better.<br />If the value is set to 2, it means that only 2 remote attachments or articles can be collected at the same time.<br />Note that you can use 10x when your server has more than 6 CPU cores.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="fetching_interval"><?php _e('Fetching Interval', $this->text_domain); ?></label></th>
						<td>
							<select id="fetching_interval" name="<?php print $this->settings_name; ?>[stress][interval]" class="selectstyle">
								<option value="0"<?php selected(0, $this->options->qc_stress_fetching_interval); ?>><?php _e('Uninterrupted', $this->text_domain);?></option>
							<?php for ($i=1; $i<11; $i++) : ?>
								<option value="<?php echo $i; ?>"<?php selected($i, $this->options->qc_stress_fetching_interval); ?>><?php printf(_n('%d Second', '%d Seconds', $i, $this->text_domain), $i); ?></option>
							<?php endfor; ?>
							<?php for ($i=15; $i<61; $i=$i+5) : ?>
								<option value="<?php echo $i; ?>"<?php selected($i, $this->options->qc_stress_fetching_interval); ?>><?php printf(_n('%d Second', '%d Seconds', $i, $this->text_domain), $i); ?></option>
							<?php endfor; ?>
							<?php for ($i=75; $i<121; $i=$i+15) : ?>
								<option value="<?php echo $i; ?>"<?php selected($i, $this->options->qc_stress_fetching_interval); ?>><?php printf(_n('%d Second', '%d Seconds', $i, $this->text_domain), $i); ?></option>
							<?php endfor; ?>
							</select>
							<p class="description"><?php _e('Some website would block your server IP, if you are fatching too fast. (Only for grabbing remote attachments)', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="fetching-timeout"><?php _e('Fetching Timeout', $this->text_domain); ?></label></th>
						<td>
							<select id="fetching-timeout" name="<?php print $this->settings_name; ?>[stress][fetching-timeout]" class="selectstyle">
								<option value="30"<?php selected(30, $this->options->qc_stress_fetching_timeout); ?>><?php _e('30 Seconds', $this->text_domain);?></option>
								<option value="180"<?php selected(180, $this->options->qc_stress_fetching_timeout); ?>><?php _e('3 Minutes', $this->text_domain);?></option>
								<option value="300"<?php selected(300, $this->options->qc_stress_fetching_timeout); ?>><?php _e('5 Minutes', $this->text_domain);?></option>
								<option value="600"<?php selected(600, $this->options->qc_stress_fetching_timeout); ?>><?php _e('10 Minutes', $this->text_domain);?></option>
								<option value="900"<?php selected(900, $this->options->qc_stress_fetching_timeout); ?>><?php _e('15 Minutes', $this->text_domain);?></option>
								<option value="1800"<?php selected(1800, $this->options->qc_stress_fetching_timeout); ?>><?php _e('Half a Hour', $this->text_domain);?></option>
								<option value="3600"<?php selected(3600, $this->options->qc_stress_fetching_timeout); ?>><?php _e('1 Hour (Default)', $this->text_domain);?></option>
								<option value="7200"<?php selected(7200, $this->options->qc_stress_fetching_timeout); ?>><?php _e('2 Hours', $this->text_domain);?></option>
								<option value="18000"<?php selected(18000, $this->options->qc_stress_fetching_timeout); ?>><?php _e('5 Hours', $this->text_domain);?></option>
								<option value="36000"<?php selected(36000, $this->options->qc_stress_fetching_timeout); ?>><?php _e('10 Hours', $this->text_domain);?></option>
							</select>
							<p class="description"><?php _e('The time limit required to capture each remote image or each post. If you want to capture a large image or the website is slow, please increase it appropriately.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="timeout"><?php _e('Timeout', $this->text_domain); ?></label></th>
						<td>
							<select id="timeout" name="<?php print $this->settings_name; ?>[stress][timeout]" class="selectstyle">
								<option value="30"<?php selected(30, $this->options->qc_stress_timeout); ?>><?php _e('30 Seconds', $this->text_domain);?></option>
								<option value="180"<?php selected(180, $this->options->qc_stress_timeout); ?>><?php _e('3 Minutes', $this->text_domain);?></option>
								<option value="300"<?php selected(300, $this->options->qc_stress_timeout); ?>><?php _e('5 Minutes', $this->text_domain);?></option>
								<option value="600"<?php selected(600, $this->options->qc_stress_timeout); ?>><?php _e('10 Minutes', $this->text_domain);?></option>
								<option value="900"<?php selected(900, $this->options->qc_stress_timeout); ?>><?php _e('15 Minutes', $this->text_domain);?></option>
								<option value="1800"<?php selected(1800, $this->options->qc_stress_timeout); ?>><?php _e('Half a Hour', $this->text_domain);?></option>
								<option value="3600"<?php selected(3600, $this->options->qc_stress_timeout); ?>><?php _e('1 Hour (Default)', $this->text_domain);?></option>
								<option value="7200"<?php selected(7200, $this->options->qc_stress_timeout); ?>><?php _e('2 Hours', $this->text_domain);?></option>
								<option value="18000"<?php selected(18000, $this->options->qc_stress_timeout); ?>><?php _e('5 Hours', $this->text_domain);?></option>
								<option value="36000"<?php selected(36000, $this->options->qc_stress_timeout); ?>><?php _e('10 Hours', $this->text_domain);?></option>
								<option value="0"<?php selected(0, $this->options->qc_stress_timeout); ?>><?php _e('For Ever', $this->text_domain);?></option>
							</select>
							<p class="description"><?php _e('PHP run time limit (Default: 1 hour),<br /><strong>For Manual Mode</strong>: Most situation 30 seconds is fine, but if you want download WeChat images i recommend 3 minutes.<br /><strong>For Automatic Mode</strong>: You need set a bigger number if you need grabbing many remote images at one time. Recommend set Half-a-Hour.<br /><strong>For Scan Mode</strong>: I recommend 10 times as long as the time required for automatic mode.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<h2><?php _e('HTTP Header', $this->text_domain); ?></h2>
			<p><?php _e('The following settings can help you better grab remote images.', $this->text_domain); ?></p>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="header-user-agent"><?php _e('Header - User Agent', $this->text_domain); ?></label></th>
						<td>
							<select id="header-user-agent" name="<?php print $this->settings_name; ?>[http-headers][user-agent]" class="selectstyle">
								<option value=""><?php _e('Not Use', $this->text_domain); ?></option>
								<option value="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0" <?php selected('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', $this->options->qc_http_header_user_agent); ?>><?php _e('Google Chrome Explorer', $this->text_domain); ?></option>
								<option value="Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0" <?php selected('Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0', $this->options->qc_http_header_user_agent); ?>><?php _e('Mozilla Firefox Explorer', $this->text_domain); ?></option>
								<option value="Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36 OPR/38.0.2220.41" <?php selected('Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36 OPR/38.0.2220.41', $this->options->qc_http_header_user_agent); ?>><?php _e('Opera Explorer', $this->text_domain); ?></option>
								<option value="Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1" <?php selected('Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', $this->options->qc_http_header_user_agent); ?>><?php _e('Apple Safari Explorer', $this->text_domain); ?></option>
								<option value="Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0)" <?php selected('Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0)', $this->options->qc_http_header_user_agent); ?>><?php _e('Microsoft Internet Explorer', $this->text_domain); ?></option>
								<option value="Googlebot/2.1 (+http://www.google.com/bot.html)"" <?php selected('Googlebot/2.1 (+http://www.google.com/bot.html)', $this->options->qc_http_header_user_agent); ?>><?php _e('Crawler and Bot', $this->text_domain); ?></option>
								<option value="mozilla/5.0 (linux; u; android 4.1.2; zh-cn; mi-one plus build/jzo54k) applewebkit/534.30 (khtml, like gecko) version/4.0 mobile safari/534.30 micromessenger/5.0.1.352" <?php selected('mozilla/5.0 (linux; u; android 4.1.2; zh-cn; mi-one plus build/jzo54k) applewebkit/534.30 (khtml, like gecko) version/4.0 mobile safari/534.30 micromessenger/5.0.1.352', $this->options->qc_http_header_user_agent); ?>><?php _e('Wechat Explorer', $this->text_domain); ?></option>
							</select>
							<p class="description"><?php _e('Grab some remote images need to set the User-Agent of the header, some do not need.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="header-http-referer"><?php _e('Header - HTTP Referer', $this->text_domain); ?></label></th>
						<td>
							<select id="header-http-referer" name="<?php print $this->settings_name; ?>[http-headers][http-referer]" class="selectstyle">
								<option value=""><?php _e('Not Use', $this->text_domain); ?></option>
								<option value="auto" <?php selected('auto', $this->options->qc_http_header_http_referer); ?>><?php _e('Automatic', $this->text_domain); ?></option>
								<option value="https://www.baidu.com" <?php selected('https://www.baidu.com', $this->options->qc_http_header_http_referer); ?>><?php _e('Baidu', $this->text_domain); ?></option>
								<option value="https://www.google.com" <?php selected('https://www.google.com', $this->options->qc_http_header_http_referer); ?>><?php _e('Google', $this->text_domain); ?></option>
								<option value="https://www.facebook.com" <?php selected('https://www.facebook.com', $this->options->qc_http_header_http_referer); ?>><?php _e('Facebook', $this->text_domain); ?></option>
								<option value="http://" <?php selected('http://', $this->options->qc_http_header_http_referer); ?>><?php _e('Custom', $this->text_domain); ?></option>
							</select>
							<p><textarea type="text" id="header-custom-http-referer" name="<?php print $this->settings_name; ?>[http-headers][custom-http-referer]" rows="3" cols="50" class="large-text" placeholder="<?php _e('It is usually the address of the collected website.', $this->text_domain); ?>" <?php if ($this->options->qc_http_header_http_referer != 'http://') print 'readonly'; ?>><?php print $this->options->qc_http_header_custom_http_referer; ?></textarea></p>
							<p class="description"><?php printf(__('Very few remote images need to set the HTTP reference address.<br />You can set a different reference address for the specified website in the format of the <strong>Image Domain Name | Website URL</strong>, for example:<br /><strong>%s</strong>', $this->text_domain), 'img.example.com|https://www.example.cn/id.html'); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="header-cookies"><?php _e('Header - Cookies', $this->text_domain); ?></label></th>
						<td>
							<table id="header-cookies-table" class="wp-list-table widefat striped">
								<thead>
									<tr>
										<td class="manage-column" style="width: 250px;"><?php _e('Referer Address', $this->text_domain); ?></td>
										<td class="manage-column"><?php _e('Cookies', $this->text_domain); ?></td>
										<td class="manage-column" style="width: 150px;"><?php _e('Control', $this->text_domain); ?></td>
									</tr>
								</thead>
								<tbody>
								<?php
 if (!empty($this->options->qc_http_header_cookies)) : foreach ($this->options->qc_http_header_cookies as $unique => $cookies) : extract($cookies); ?>
									<tr>
										<td><input name="<?php print $this->settings_name; ?>[http-headers][cookies][<?php print $unique; ?>][referer]" class="large-text" type="text" value="<?php print $referer; ?>" /></td>
										<td><textarea name="<?php print $this->settings_name; ?>[http-headers][cookies][<?php print $unique; ?>][cookies]" rows="3" class="large-text"><?php print $cookies; ?></textarea></td>
										<td><button type="button" class="delete-cookies button qc-icon delete"><?php _e('Delete'); ?></button></td>
									</tr>
								<?php
 endforeach; else: ?>
									<tr class="empty">
										<td colspan="3"><input type="hidden" name="<?php print $this->settings_name; ?>[http-headers][cookies]" value="" /></td>
									</tr>
								<?php endif;?>
								</tbody>
							</table>
							<p><button type="button" id="add-cookies-field" class="button qc-icon add"><?php _e('Add Cookies', $this->text_domain); ?></button></p>
							<p class="description"><?php _e('Some websites or remote attachments need to fill in cookies to collect.', $this->text_domain); ?><br /><?php printf(__('<strong>For example:</strong> %s', $this->text_domain), sprintf(__('<br /><strong>Referer Address</strong>: %s<br /><strong>Cookies</strong>: %s', $this->text_domain), 'baidu.com', 'Cookie: yjs_ab_lid=6cb813548311f677b487b78cda2015379d771; yjs_ab_score=300; __cfduid=d118ccba11f55324d7229661934dfc8621541151205; cf_clearance=419b1af61b05c0d0b0a377ae95514c42f184b398-1541151210-86400-150; Hm_lvt_0e69a104474060baa65c1a145b571031=1541151212; Hm_lpvt_0e69a104474060baa65c1a145b571031=1541151212; yjs_id=eada6691940abc4189242cbc00582026; ctrl_time=1')); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<h2><?php _e('Auxiliary Function', $this->text_domain); ?></h2>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="auxiliary-set-post-author"><?php _e('Set Post Author', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'auxiliary-set-post-author', 'name' => $this->settings_name . '[auxiliary][set-post-author]', 'value' => $this->options->qc_auxiliary_set_post_author )); ?>
							<p class="description"><?php _e('Display the function of Set Post Author in the QQWorld Collector settings in the editing page, if your users are many, do not recommend open, the editing page will die.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<h2><?php _e('Database', $this->text_domain); ?></h2>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="database-sql_calc_found_rows"><?php _e('Speed Up Large Database Queries', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'database-sql_calc_found_rows', 'name' => $this->settings_name . '[database][sql_calc_found_rows]', 'value' => $this->options->qc_database_sql_calc_found_rows )); ?>
							<p class="description"><?php _e('Optimizing the <strong>SQL_CALC_FOUND_ROWS</strong> function causes slow queries on large databases.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note that some servers are not compatible with this feature, resulting in front and back page query errors.', $this->text_domain); ?></span></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php do_action( 'qqworld-collector-settings-server-fields', $this ); ?>
		</div>
		<!-- Server - end -->
		<?php endif; ?>
		<!-- Authorization - start -->
		<div class="nav-section">
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="who-can-use"><?php _e('Who Can Use?', $this->text_domain); ?></label></th>
					<td>
						<select id="who-can-use" name="<?php print $this->settings_name; ?>[authorization][who-can-use]" class="selectstyle">
							<option value="read"<?php selected('read', $this->options->qc_authorization_who_can_use); ?>><?php _e('Subscriber+ (Read)', $this->text_domain);?></option>
							<option value="edit_posts"<?php selected('edit_posts', $this->options->qc_authorization_who_can_use); ?>><?php _e('Contributor+ (Edit Posts)', $this->text_domain);?></option>
							<option value="publish_posts"<?php selected('publish_posts', $this->options->qc_authorization_who_can_use); ?>><?php _e('Author+ (Publish Posts)', $this->text_domain);?></option>
							<option value="edit_others_posts"<?php selected('edit_others_posts', $this->options->qc_authorization_who_can_use); ?>><?php _e('Editor+ (Edit Others Posts)', $this->text_domain);?></option>
							<option value="manage_options"<?php selected('manage_options', $this->options->qc_authorization_who_can_use); ?>><?php _e('Administrator+ (Manage Options)', $this->text_domain);?></option>
						</select>
						<p class="description"><?php _e('Set roles who can use this plugin.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('The plus sign means that roles with higher permissions also have permissions.', $this->text_domain); ?></span></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="all-roles-can-modify-settings"><?php _e('All Roles Can Modify Settings', $this->text_domain); ?></label></th>
					<td>
						<?php
 $this->the_switcher(array( 'id' => 'all-roles-can-modify-settings', 'name' => $this->settings_name . '[authorization][all-roles-can-modify-settings]', 'value' => $this->options->qc_authorization_all_roles_can_modify_settings )); ?>
						<p class="description"><?php _e('Only the administrator can see the setting menu by default. If this item is enabled, all authorized roles can see the setting menu.', $this->text_domain); ?></p>
					</td>
				</tr>
			</table>
		</div>
		<!-- Authorization - end -->
		<?php if (isset($GLOBALS['QC-DISPLAY-SERVER-IN-SETTINGS']) && $GLOBALS['QC-DISPLAY-SERVER-IN-SETTINGS']) : ?>
		<!-- Graphic - start -->
		<div class="nav-section">
			<h2><?php _e('Graphic Effects', $this->text_domain); ?></h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="effect"><?php _e('Effect', $this->text_domain); ?></label></th>
					<td>
						<select id="effect" name="<?php print $this->settings_name; ?>[graphic][effect]" class="selectstyle">
							<option value="low"<?php selected('low', $this->options->qc_graphic_effect); ?>><?php _e('Low', $this->text_domain);?></option>
							<option value="midium"<?php selected('midium', $this->options->qc_graphic_effect); ?>><?php _e('Midium', $this->text_domain);?></option>
							<option value="high"<?php selected('high', $this->options->qc_graphic_effect); ?>><?php _e('High', $this->text_domain);?></option>
						</select>
						<p class="description"><?php _e('The list display effect of manually collecting attachments or posts.<br />If your PC client performance is strong, please select high effects.', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="effect-completed-animation"><?php _e('Completed Animation', $this->text_domain); ?></label></th>
					<td>
						<select id="effect-completed-animation" name="<?php print $this->settings_name; ?>[graphic][completed-animation]" class="selectstyle">
						<?php
 $in_animations = $this->get_animation_options('in'); foreach ($in_animations as $name => $group) : ?>
							<optgroup label="<?php print $group['label']; ?>">
							<?php foreach ($group['options'] as $value => $label) : ?>
							<option value="<?php print $value; ?>" <?php selected($value, $this->options->qc_graphic_completed_animation); ?>><?php print $label; ?></option>
							<?php endforeach; ?>
							</optgroup>
						<?php endforeach; ?>
						</select>
						<p class="description"><?php _e('Animation effects when the collecting attachments or posts is completed.', $this->text_domain); ?></p>
					</td>
				</tr>
			</table>
			<h2><?php _e('Noty Effects', $this->text_domain); ?></h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="effect-noty-theme"><?php _e('Themes'); ?></label></th>
					<td>
						<select id="effect-noty-theme" name="<?php print $this->settings_name; ?>[graphic][noty][theme]" class="selectstyle">
						<?php
 $themes = array( 'bootstrap-v3' => _x('Bootstrap V3', 'noty', $this->text_domain), 'bootstrap-v4' => _x('Bootstrap V4', 'noty', $this->text_domain), 'light' => _x('Light', 'noty', $this->text_domain), 'metroui' => _x('Metro UI', 'noty', $this->text_domain), 'mint' => _x('Mint', 'noty', $this->text_domain), 'nest' => _x('Nest', 'noty', $this->text_domain), 'relax' => _x('Relax', 'noty', $this->text_domain), 'semanticui' => _x('Semantic UI', 'noty', $this->text_domain), 'sunset' => _x('Sunset', 'noty', $this->text_domain) ); foreach ($themes as $theme => $label) : ?>
							<option value="<?php print $theme; ?>" <?php selected($theme, $this->options->qc_graphic_noty_theme); ?>><?php print $label; ?></option>
						<?php endforeach; ?>
						</select>
						<p class="description"><?php _e('Please select the theme of Noty plugin.', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="effect-noty-open"><?php _e('Open Animation', $this->text_domain); ?></label></th>
					<td>
						<select id="effect-noty-open" name="<?php print $this->settings_name; ?>[graphic][noty][open]" class="selectstyle">
						<?php
 $in_animations = $this->get_animation_options('in'); foreach ($in_animations as $name => $group) : ?>
							<optgroup label="<?php print $group['label']; ?>">
							<?php foreach ($group['options'] as $value => $label) : ?>
							<option value="<?php print $value; ?>" <?php selected($value, $this->options->qc_graphic_noty_open_animation); ?>><?php print $label; ?></option>
							<?php endforeach; ?>
							</optgroup>
						<?php endforeach; ?>
						</select>
						<p class="description"><?php _e('Please select the open animation of Noty plugin.', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="effect-noty-close"><?php _e('Close Animation', $this->text_domain); ?></label></th>
					<td>
						<select id="effect-noty-close" name="<?php print $this->settings_name; ?>[graphic][noty][close]" class="selectstyle">
						<?php
 $in_animations = $this->get_animation_options('out'); foreach ($in_animations as $name => $group) : ?>
							<optgroup label="<?php print $group['label']; ?>">
							<?php foreach ($group['options'] as $value => $label) : ?>
							<option value="<?php print $value; ?>" <?php selected($value, $this->options->qc_graphic_noty_close_animation); ?>><?php print $label; ?></option>
							<?php endforeach; ?>
							</optgroup>
						<?php endforeach; ?>
						</select>
						<p class="description"><?php _e('Please select the close animation of Noty plugin.', $this->text_domain); ?></p>
					</td>
				</tr>
			</table>
		</div>
		<!-- Graphic - end -->
		<?php endif; ?>
		<?php do_action( 'qqworld-collector-settings-nav-sections' ); ?>
		<?php submit_button(); ?>
	</form>
</div>