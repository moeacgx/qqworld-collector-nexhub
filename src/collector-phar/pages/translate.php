<div class="wrap" id="qqworld-collector-settings">
	<h2 id="header-title"><?php _e("Translate", $this->text_domain); ?></h2>
	<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
		<a href="#settings" class="nav-tab qc-icon regular"><?php _e('Settings'); ?></a>
		<a href="#test" class="nav-tab qc-icon debug"><?php _e('Test', $this->text_domain); ?></a>
		<a href="#post-name" class="nav-tab qc-icon convert"><?php _e('Translate Post Name', $this->text_domain); ?></a>
	</h2>
	<form action="options.php" method="post" id="translate-form">
		<!-- Settings - start -->
		<div class="nav-section">
			<?php settings_fields($this->settings_name); ?>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="<?php print $this->settings_name; ?>-enabled-translation"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-enabled-translate', 'name' => $this->settings_name . '[enabled]', 'value' => $this->options->qc_translate_enabled )); ?>
							<p class="description"><?php _e('The translation option will appear at the top of the editor.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="<?php print $this->settings_name; ?>-automatic-mode"><?php _e('Automatic Mode', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-automatic-mode', 'name' => $this->settings_name . '[automatic]', 'value' => $this->options->qc_translate_automatic )); ?>
							<p class="description"><?php _e('Automatically translate post content when saving post.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="content"><?php _e('Content', $this->text_domain); ?></label></th>
						<td>
							<p><label><input type="checkbox" value="post_title" name="<?php print $this->settings_name; ?>[content][]" <?php checked(1, in_array('post_title', $this->options->qc_translate_automatic_content)); ?>/> <?php _e('Post Title', $this->text_domain); ?></label></p>
							<p><label><input type="checkbox" value="post_content" name="<?php print $this->settings_name; ?>[content][]" <?php checked(1, in_array('post_content', $this->options->qc_translate_automatic_content)); ?>/> <?php _e('Post Content', $this->text_domain); ?></label></p>
							<p><label><input type="checkbox" value="post_excerpt" name="<?php print $this->settings_name; ?>[content][]" <?php checked(1, in_array('post_excerpt', $this->options->qc_translate_automatic_content)); ?>/> <?php _e('Post Excerpt', $this->text_domain); ?></label></p>
							<p class="desciption"><?php _e('Please select the content that you want to be translate automatically.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php _e('Select post types', $this->text_domain); ?></label></th>
						<td>
							<?php $post_types = get_post_types('', 'objects'); ?>
							<ul id="post_types_list">
							<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment', 'revision', 'nav_menu_item') )) : ?>
								<li><label><input name="<?php print $this->settings_name; ?>[post_type][]" type="checkbox" value="<?php echo $name; ?>" <?php checked(true, in_array($name, $this->options->qc_translate_post_types)); ?> /> <?php echo $post_type->labels->name; ?></label></li>
							<?php endif; endforeach; ?></ul>
							<p class="description"><?php _e("For automatic mode, please select the type of post to translate automatically.", $this->text_domain) ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><labe for="enabled-translate-term-name"l><?php _e('Taxonomies', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enabled-translate-term-name', 'name' => $this->settings_name . '[enabled-translate-term-name]', 'value' => $this->options->qc_translate_term_name_enabled )); ?>
							<p class="description"><?php _e('Automatic translation of name when saving terms.', $this->text_domain) ?></p>
							<?php $taxonomies = get_taxonomies('', 'objects'); ?>
							<ul id="taxonomies_list">
							<?php foreach ($taxonomies as $name => $taxonomy) : if (!$taxonomy->public || !$taxonomy->show_ui || !$taxonomy->show_in_menu) continue; ?>
								<li><label><input name="<?php print $this->settings_name; ?>[taxonomies][]" type="checkbox" value="<?php echo $name; ?>" <?php checked(1, in_array($name, $this->options->qc_translate_taxonomies)); ?> /> <?php echo $taxonomy->labels->name; ?></label></li>
							<?php endforeach; ?></ul>
							<p class="description"><?php _e('Please select the taxonomies whose name you want to translate.', $this->text_domain) ?><br /><span class="qc-icon info"><?php _e('Manual mode is not supported, it is only effective when saving terms.', $this->text_domain) ?></span></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="translate-mode"><?php _e('Translate API', $this->text_domain); ?></label></th>
						<td>
							<select name="<?php print $this->settings_name; ?>[mode]" id="translate-mode" class="selectstyle">
							<?php
 $modes = array( 'aliyun' => __('Aliyun Machine Translation', $this->text_domain), 'baidu' => __('Baidu Translation', $this->text_domain), 'tencent' => __('Tencent Machine Translation', $this->text_domain), 'sogou' => __('Sogou Text Translation', $this->text_domain), 'google-free' => __('Google Free Translation', $this->text_domain) . __(' (Don\'t use it, it is easy to fatal error)', $this->text_domain), 'google' => __('Google Translation', $this->text_domain), 'deepl' => __('DeepL Translation', $this->text_domain), 'zh-conversion' => __('Simplified Traditional Conversion', $this->text_domain), 'youdao' => __('YouDao Translation', $this->text_domain) ); foreach ($modes as $value => $title) echo '<option value="'.$value.'"'.selected($value, $this->options->qc_translate_mode, false).'>'.$title.'</option>'; ?>
							</select>
							<p class="description"><?php _e("Please select translate mode.", $this->text_domain); ?></p>
							<p class="description qc-icon info"><?php _e("Note that Google's free translation is easy to get errors and is not recommended.", $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top" class="interval">
						<th scope="row"><label for="<?php print $this->settings_name; ?>-query-time-interval"><?php _e('Query Time Interval', $this->text_domain); ?></label></th>
						<td>
							<label><input type="number" name="<?php print $this->settings_name; ?>[query-time-interval]" class="small-text" id="<?php print $this->settings_name; ?>-query-time-interval" value="<?php print $this->options->qc_translate_query_time_interval; ?>" /> <?php _e('Seconds', $this->text_domain); ?></label>
							<p class="description"><?php _e('If you want to translate a lot, it is recommended to increase this value, otherwise it may be rejected by the QPS setting of the translation interface.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="<?php print $this->settings_name; ?>-display-languages-list"><?php _e('Display Languages List', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => $this->settings_name . '-display-languages-list', 'name' => $this->settings_name . '[display-languages-list]', 'value' => $this->options->qc_display_languages_list )); ?>
							<p class="description"><?php _e("Display languages list on top of editor.", $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="translate-table<?php if ($this->options->qc_translate_mode != 'aliyun') echo ' hidden'; ?>">
			<?php if (file_exists(WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'alibabacloud' . DIRECTORY_SEPARATOR . 'autoload.php')) : ?>
				<table class="form-table" id="aliyun-translate">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="aliyun-access-key-id"><?php _ex('Access Key ID', 'aliyun', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[aliyun][access-key-id]" type="text" class="regular-text" id="aliyun-access-key-id" value="<?php echo $this->options->qc_aliyun_access_key_id; ?>" />
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://ram.console.aliyun.com/manage/ak', _x('Access Key ID', 'aliyun', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="aliyun-access-key-secret"><?php _ex('Access Key Secret', 'aliyun', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[aliyun][access-key-secret]" type="password" class="regular-text" id="aliyun-access-key-secret" value="<?php echo $this->options->qc_aliyun_access_key_secret; ?>" />
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://ram.console.aliyun.com/manage/ak', _x('Access Key Secret', 'aliyun', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="translate_method"><?php _e('Method', $this->text_domain); ?></label></th>
							<td>
								<label>
									<?php _e('From', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[aliyun][from]" id="aliyun_method_from" class="selectstyle">
									<?php  foreach ($this->aliyun_translations as $key => $translate) { echo '<option value="'.$key.'"'.selected($key, $this->options->qc_aliyun_method_from, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
								<label>
									<?php _e('To', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[aliyun][to]" id="aliyun_method_to" class="selectstyle">
									<?php  foreach ($this->aliyun_translations as $key => $translate) { if ($key!='auto') echo '<option value="'.$key.'"'.selected($key, $this->options->qc_aliyun_method_to, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
							</td>
						</tr>
					</tbody>
				</table>
			<?php else: ?>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><?php _e('Missing SDK', $this->text_domain); ?></th>
							<td>
								<a href="<?php print admin_url('admin.php?page=qqworld-collector#sdk'); ?>" target="_blank" class="button qc-icon download"><?php _e('Install SDK', $this->text_domain); ?></a>
								<p class="description qc-icon info"><?php _e('Please install <strong>Software Development Kit (SDK)</strong> and return here to refresh the page for the next setting.', $this->text_domain); ?></p>
							</td>
						</tr>
					<tbody>
				</table>
			<?php endif; ?>
			</div>
			<div class="translate-table<?php if ($this->options->qc_translate_mode != 'baidu') echo ' hidden'; ?>">
				<table class="form-table" id="baidu-translate">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="baidu_appid"><?php _ex('APP ID', 'baidu', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[baidu][appid]" type="text" class="regular-text" id="baidu_appid" value="<?php echo $this->options->qc_baidu_appid; ?>" />
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://api.fanyi.baidu.com', _x('APP ID', 'baidu', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="baidu_key"><?php _ex('Key', 'baidu', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[baidu][key]" type="password" class="regular-text" id="baidu_key" value="<?php echo $this->options->qc_baidu_key; ?>" />
								<input name="<?php print $this->settings_name; ?>[baidu][salt]" type="hidden" class="regular-text" id="baidu_salt" value="<?php echo mt_rand(1000000000,mt_getrandmax()); ?>" />
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://api.fanyi.baidu.com', _x('Key', 'baidu', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="baidu_custom_terms"><?php _ex('Use Custom Terms', 'baidu', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'baidu_custom_terms', 'name' => $this->settings_name . '[baidu][custom-terms]', 'value' => $this->options->qc_baidu_custom_terms )); ?>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="translate_method"><?php _e('Method', $this->text_domain); ?></label></th>
							<td>
								<label>
									<?php _e('From', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[baidu][from]" id="baidu_method_from" class="selectstyle">
									<?php  foreach ($this->baidu_translations as $key => $translate) { echo '<option value="'.$key.'"'.selected($key, $this->options->qc_baidu_method_from, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
								<label>
									<?php _e('To', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[baidu][to]" id="baidu_method_to" class="selectstyle">
									<?php  foreach ($this->baidu_translations as $key => $translate) { if ($key!='auto') echo '<option value="'.$key.'"'.selected($key, $this->options->qc_baidu_method_to, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="translate-table<?php if ($this->options->qc_translate_mode != 'tencent') echo ' hidden'; ?>">
			<?php if (file_exists(WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'tencentcloud' . DIRECTORY_SEPARATOR . 'autoload.php')) : ?>
				<table class="form-table" id="google-translate">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="tencent_secretid"><?php _ex('Secret ID', 'tencent', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[tencent][secretid]" type="text" class="regular-text" id="tencent_secretid" value="<?php echo $this->options->qc_tencent_secretid; ?>" />
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://console.cloud.tencent.com/cam/capi', _x('Secret ID', 'tencent', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="tencent_secretkey"><?php _ex('Secret Key', 'tencent', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[tencent][secretkey]" type="password" class="regular-text" id="tencent_secretkey" value="<?php echo $this->options->qc_tencent_secretkey; ?>" />
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://console.cloud.tencent.com/cam/capi', _x('Secret Key', 'tencent', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="tencent_region"><?php _ex('Region', 'tencent', $this->text_domain); ?></label></th>
							<td>
								<select class="selectstyle" name="<?php print $this->settings_name; ?>[tencent][region]">
									<optgroup label="<?php _e('Please Select Big Region', $this->text_domain); ?>">
										<option value="ap-beijing" <?php selected('ap-beijing', $this->options->qc_tencent_region); ?>><?php _e('BeiJing (bj)', $this->text_domain); ?></option>
										<option value="ap-chengdu" <?php selected('ap-chengdu', $this->options->qc_tencent_region); ?>><?php _e('West South China - ChengDu (cd)', $this->text_domain); ?></option>
										<option value="ap-chongqing" <?php selected('ap-chongqing', $this->options->qc_tencent_region); ?>><?php _e('ChongQing', $this->text_domain); ?></option>
										<option value="ap-guangzhou" <?php selected('ap-guangzhou', $this->options->qc_tencent_region); ?>><?php _e('South China - GuangZhou (gz)', $this->text_domain); ?></option>
										<option value="ap-hongkong" <?php selected('ap-hongkong', $this->options->qc_tencent_region); ?>><?php _e('Hongkong (hk)', $this->text_domain); ?></option>
										<option value="ap-seoul" <?php selected('ap-seoul', $this->options->qc_tencent_region); ?>><?php _e('Seoul', $this->text_domain); ?></option>
										<option value="ap-shanghai" <?php selected('ap-shanghai', $this->options->qc_tencent_region); ?>><?php _e('East China - ShangHai (sh)', $this->text_domain); ?></option>
										<option value="ap-singapore" <?php selected('ap-singapore', $this->options->qc_tencent_region); ?>><?php _e('Singapore (sgp)', $this->text_domain); ?></option>
										<option value="eu-frankfurt" <?php selected('eu-frankfurt', $this->options->qc_tencent_region); ?>><?php _e('Frankfurt (ger)', $this->text_domain); ?></option>
										<option value="na-siliconvalley" <?php selected('na-siliconvalley', $this->options->qc_tencent_region); ?>><?php _e('Silicon Valley', $this->text_domain); ?></option>
										<option value="na-toronto" <?php selected('na-toronto', $this->options->qc_tencent_region); ?>><?php _e('Toronto (ca)', $this->text_domain); ?></option>
										<option value="ap-mumbai" <?php selected('ap-mumbai', $this->options->qc_tencent_region); ?>><?php _e('Mumbai', $this->text_domain); ?></option>
										<option value="na-ashburn" <?php selected('na-ashburn', $this->options->qc_tencent_region); ?>><?php _e('Virginia (eastern United States)', $this->text_domain); ?></option>
										<option value="ap-bangkok" <?php selected('ap-bangkok', $this->options->qc_tencent_region); ?>><?php _e('Bangkok, Thailand', $this->text_domain); ?></option>
									</optgroup>
									<optgroup label="<?php _e('Financial Region', $this->text_domain); ?>">
										<option value="ap-shanghai-fsi" <?php selected('ap-shanghai-fsi', $this->options->qc_tencent_region); ?>><?php _e('ShangHai Financial', $this->text_domain); ?></option>
										<option value="ap-shenzhen-fsi" <?php selected('ap-shenzhen-fsi', $this->options->qc_tencent_region); ?>><?php _e('ShenZhen Financial', $this->text_domain); ?></option>
									</optgroup>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="translate_method"><?php _e('Method', $this->text_domain); ?></label></th>
							<td>
								<label>
									<?php _e('From', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[tencent][source]" id="tencent_method_source" class="selectstyle">
									<?php
 $tencent_translations = array_merge($this->auto, $this->tencent_translations); foreach ($tencent_translations as $key => $translate) { echo '<option value="'.$key.'"'.selected($key, $this->options->qc_tencent_method_source, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
								<label>
									<?php _e('To', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[tencent][target]" id="tencent_method_target" class="selectstyle">
									<?php  foreach ($this->tencent_translations as $key => $translate) { if ($key!='auto') echo '<option value="'.$key.'"'.selected($key, $this->options->qc_tencent_method_target, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
							</td>
						</tr>
					</tbody>
				</table>
			<?php else: ?>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><?php _e('Missing SDK', $this->text_domain); ?></th>
							<td>
								<a href="<?php print admin_url('admin.php?page=qqworld-collector#sdk'); ?>" target="_blank" class="button qc-icon download"><?php _e('Install SDK', $this->text_domain); ?></a>
								<p class="description qc-icon info"><?php _e('Please install <strong>Software Development Kit (SDK)</strong> and return here to refresh the page for the next setting.', $this->text_domain); ?></p>
							</td>
						</tr>
					<tbody>
				</table>
			<?php endif; ?>
			</div>
			<div class="translate-table<?php if ($this->options->qc_translate_mode != 'sogou') echo ' hidden'; ?>">
				<table class="form-table" id="sogou-translate">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="sogou_appid"><?php _ex('APP ID', 'sogou', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[sogou][appid]" type="text" class="regular-text" id="sogou_appid" value="<?php echo $this->options->qc_sogou_appid; ?>" />
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://console.ai.sogou.com/apps', _x('APP ID', 'sogou', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="sogou_appkey"><?php _ex('APP Key', 'sogou', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[sogou][appkey]" type="password" class="regular-text" id="sogou_appkey" value="<?php echo $this->options->qc_sogou_appkey; ?>" />
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://console.ai.sogou.com/apps', _x('APP Key', 'sogou', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="translate_method"><?php _e('Method', $this->text_domain); ?></label></th>
							<td>
								<label>
									<?php _e('From', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[sogou][source]" id="sogou_method_source" class="selectstyle">
									<?php  foreach ($this->sogou_translations as $key => $translate) { echo '<option value="'.$key.'"'.selected($key, $this->options->qc_sogou_method_source, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
								<label>
									<?php _e('To', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[sogou][target]" id="sogou_method_target" class="selectstyle">
									<?php  foreach ($this->sogou_translations as $key => $translate) { if ($key!='auto') echo '<option value="'.$key.'"'.selected($key, $this->options->qc_sogou_method_target, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="translate-table<?php if ($this->options->qc_translate_mode != 'google-free') echo ' hidden'; ?>">
				<table class="form-table" id="google-translate">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="translate_method"><?php _e('Method', $this->text_domain); ?></label></th>
							<td>
								<label>
									<?php _e('From', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[google-free][source]" id="google_free_method_source" class="selectstyle">
									<?php
 $google_translations = array_merge($this->auto, $this->google_translations); foreach ($google_translations as $key => $translate) { echo '<option value="'.$key.'"'.selected($key, $this->options->qc_google_free_method_source, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
								<label>
									<?php _e('To', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[google-free][target]" id="google_free_method_target" class="selectstyle">
									<?php  foreach ($this->google_translations as $key => $translate) { if ($key!='auto') echo '<option value="'.$key.'"'.selected($key, $this->options->qc_google_free_method_target, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="google_free_cn"><?php _ex('Use Chinese Server', 'google', $this->text_domain); ?></label></th>
							<td>
								<?php
 $this->the_switcher(array( 'id' => 'google_free_cn', 'name' => $this->settings_name . '[google-free][cn]', 'value' => $this->options->qc_google_free_cn )); ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="translate-table<?php if ($this->options->qc_translate_mode != 'google') echo ' hidden'; ?>">
				<table class="form-table" id="google-translate">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="google_apikey"><?php _e('Google API Key', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[google][apikey]" type="text" class="regular-text" id="google_apikey" value="<?php echo $this->options->qc_google_apikey; ?>" />
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://console.developers.google.com/project', __('Google API Key', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="translate_method"><?php _e('Method', $this->text_domain); ?></label></th>
							<td>
								<label>
									<?php _e('From', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[google][source]" id="google_method_source" class="selectstyle">
									<?php  foreach (array_merge($this->auto, $this->google_translations) as $key => $translate) { echo '<option value="'.$key.'"'.selected($key, $this->options->qc_google_method_source, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
								<label>
									<?php _e('To', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[google][target]" id="google_method_target" class="selectstyle">
									<?php  foreach ($this->google_translations as $key => $translate) { if ($key!='auto') echo '<option value="'.$key.'"'.selected($key, $this->options->qc_google_method_target, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="translate-table<?php if ($this->options->qc_translate_mode != 'deepl') echo ' hidden'; ?>">
			<?php if (file_exists(WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'deepl-php' . DIRECTORY_SEPARATOR . 'autoload.php')) : ?>
				<table class="form-table" id="deepl-translate">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="deepl_authkey"><?php _e('Auth Key', $this->text_domain); ?></label></th>
							<td>
								<ul id="deepl_authkey_list">
								<?php if (is_string($this->options->qc_deepl_authkey)) $this->options->qc_deepl_authkey = array($this->options->qc_deepl_authkey); ?>
								<?php if (!empty($this->options->qc_deepl_authkey)) foreach ($this->options->qc_deepl_authkey as $authkey) : ?>
									<li style=""><input type="text" name="<?php print $this->settings_name; ?>[deepl][authkey][]" value="<?php print $authkey; ?>" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx:fx" class="regular-text"><button type="button" class="button delete-deepl-authkey qc-icon delete"><?php _e('Delete'); ?></button></li>
								<?php endforeach; ?>
								</ul>
								<p><button type="button" id="add_deepl_authkey" class="qc-icon add button"><?php _e('Add Auth key', $this->text_domain); ?></button></p>
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://www.deepl.com/zh/pro?cta=header-pro-button/', __('Auth Key', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="translate_method"><?php _e('Method', $this->text_domain); ?></label></th>
							<td>
								<label>
									<?php _e('From', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[deepl][source]" id="deepl_method_source" class="selectstyle">
									<?php  foreach (array_merge($this->auto, $this->deepl_translations) as $key => $translate) { echo '<option value="'.$key.'"'.selected($key, $this->options->qc_deepl_method_source, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
								<label>
									<?php _e('To', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[deepl][target]" id="deepl_method_target" class="selectstyle">
									<?php  foreach ($this->deepl_translations as $key => $translate) { if ($key!='auto') echo '<option value="'.$key.'"'.selected($key, $this->options->qc_deepl_method_target, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
							</td>
						</tr>
					</tbody>
				</table>
				<?php else: ?>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><?php _e('Missing SDK', $this->text_domain); ?></th>
							<td>
								<a href="<?php print admin_url('admin.php?page=qqworld-collector#sdk'); ?>" target="_blank" class="button qc-icon download"><?php _e('Install SDK', $this->text_domain); ?></a>
								<p class="description qc-icon info"><?php _e('Please install <strong>Software Development Kit (SDK)</strong> and return here to refresh the page for the next setting.', $this->text_domain); ?></p>
							</td>
						</tr>
					<tbody>
				</table>
			<?php endif; ?>
			</div>
			<div class="translate-table"<?php if ($this->options->qc_translate_mode != 'zh-conversion') echo ' hidden'; ?>>
				<table class="form-table" id="zh-conversion-translate">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="zh_conversion_method"><?php _e('Method', $this->text_domain); ?></label></th>
							<td>
								<label>
									<?php _e('To', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[zh-conversion]" id="zh_conversion_method" class="selectstyle">
									<?php
 foreach ($this->zh_conversion_translations as $key => $translate) { if ($key!='auto') echo '<option value="'.$key.'"'.selected($key, $this->options->qc_zh_conversion_method, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="translate-table"<?php if ($this->options->qc_translate_mode != 'youdao') echo ' hidden'; ?>>
				<table class="form-table" id="youdao-translate">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="youdao_appkey"><?php _ex('APP ID', 'common', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[youdao][appKey]" type="text" class="regular-text" id="youdao_appkey" value="<?php echo $this->options->qc_youdao_appkey; ?>" />
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://ai.youdao.com/appmgr.s', _x('APP ID', 'common', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="youdao_appsecret"><?php _ex('APP Secret', 'common', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[youdao][appSecret]" type="password" class="regular-text" id="youdao_appsecret" value="<?php echo $this->options->qc_youdao_appsecret; ?>" />
								<p class="description"><?php printf(__('Access <a href="%s" target="_blank">here</a> to get %s.', $this->text_domain), 'https://ai.youdao.com/appmgr.s', _x('APP Secret', 'common', $this->text_domain)); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="youdao_method"><?php _e('Method', $this->text_domain); ?></label></th>
							<td>
								<label>
									<?php _e('From', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[youdao][source]" id="youdao_method_source" class="selectstyle">
									<?php  foreach (array_merge($this->auto, $this->youdao_translations) as $key => $translate) { echo '<option value="'.$key.'"'.selected($key, $this->options->qc_youdao_method_source, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
								<label>
									<?php _e('To', $this->text_domain); ?>
									<select name="<?php print $this->settings_name; ?>[youdao][target]" id="youdao_method_target" class="selectstyle">
									<?php  foreach ($this->youdao_translations as $key => $translate) { if ($key!='auto') echo '<option value="'.$key.'"'.selected($key, $this->options->qc_youdao_method_target, false).'>'.$translate.'</option>'; } ?>
									</select>
								</label>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php submit_button(); ?>
		</div>
		<!-- Settings - end -->
		<!-- Test - start -->
		<div class="nav-section hidden">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="test_translate"><?php _e('Test', $this->text_domain); ?></label></th>
						<td><?php wp_editor(__('Hello World!', $this->text_domain), 'test-translate'); ?></td>
					</tr>
					<tr valign="top">
						<th scope="row"></th>
						<td><?php submit_button(__('Translate', $this->text_domain), 'primary', 'test-translate-button', false); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Test - end -->
		<!-- Translate Post Name - start -->
		<div class="nav-section hidden">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="enabled-translate-post-name"><?php _e('Post Name', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enabled-translate-post-name', 'name' => $this->settings_name . '[translate-post-name][enabled]', 'value' => $this->options->qc_translate_post_name_enabled )); ?>
							<p class="description"><?php _e("Automatically convert the post name to Pinyin or translate it into English when you publish the post.", $this->text_domain); ?></p>

							<?php $post_types = get_post_types('', 'objects'); ?>
							<ul id="post_types_list">
							<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment', 'revision', 'nav_menu_item') ) && $post_type->public && $post_type->show_ui && $post_type->show_in_menu ) : ?>
								<li><label><input name="<?php print $this->settings_name; ?>[translate-post-name][post_types][]" type="checkbox" value="<?php echo $name; ?>" <?php checked(1, in_array($name, $this->options->qc_translate_post_name_post_types)); ?> /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
							<?php endif; endforeach; ?></ul>
							<p class="description"><?php _e('Please select the post type whose post name you want to translate.', $this->text_domain) ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="enabled-translate-term-slug"><?php _e('Term Slug', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enabled-translate-term-slug', 'name' => $this->settings_name . '[translate-term-slug][enabled]', 'value' => $this->options->qc_translate_term_slug_enabled )); ?>
							<p class="description"><?php _e("Automatically convert the term slug to Pinyin or translate it into English when you publish the post.", $this->text_domain); ?></p>
							<?php $taxonomies = get_taxonomies('', 'objects'); ?>
							<ul id="taxonomies_list">
							<?php foreach ($taxonomies as $name => $taxonomy) : if (!$taxonomy->public || !$taxonomy->show_ui || !$taxonomy->show_in_menu) continue; ?>
								<li><label><input name="<?php print $this->settings_name; ?>[translate-term-slug][taxonomies][]" type="checkbox" value="<?php echo $name; ?>" <?php checked(1, in_array($name, $this->options->qc_translate_term_slug_taxonomies)); ?> /> <?php echo $taxonomy->labels->name; ?></label></li>
							<?php endforeach; ?></ul>
							<p class="description"><?php _e('Please select the taxonomies whose slug you want to translate.', $this->text_domain) ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="enabled-filename"><?php _e('Filename', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enabled-filename', 'name' => $this->settings_name . '[translate-filename][enabled]', 'value' => $this->options->qc_translate_filename_enabled )); ?>
							<p class="description"><?php _e("Automatically convert the attachment filename to Pinyin or translate it into English when you publish the post.", $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<h3><?php _e('Other Settings', $this->text_domain); ?></h3>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="translate-post-name-method"><?php _e('Translate Into', $this->text_domain); ?></label></th>
						<td>
							<select name="<?php print $this->settings_name; ?>[translate-post-name][method]" id="translate-post-name-method" class="selectstyle">
								<option value="english" <?php selected('english', $this->options->qc_translate_post_name_method); ?>><?php _e('English'); ?></option>
								<option value="pinyin" <?php selected('pinyin', $this->options->qc_translate_post_name_method); ?>><?php _e('Chinese Pinyin', $this->text_domain); ?></option>
								<option value="md5" <?php selected('md5', $this->options->qc_translate_post_name_method); ?>><?php _e('MD5', $this->text_domain); ?></option>
							</select>
							<p class="description" id="for-translate-post-name-to-eng"<?php if ($this->options->qc_translate_post_name_method != 'english') print ' style="display: none;"'; ?>><?php _e('Use Google free translation, if your server is in mainland China, you must check the use of Chinese server in the translation Settings (first select the free Google translation, you can turn off the translation after setting up, you can choose other translations).', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="translate-post-name-max-length"><?php _e('Max Length', $this->text_domain); ?></label></th>
						<td>
							<input name="<?php print $this->settings_name; ?>[translate-post-name][max-length]" type="number" class="small-text" id="translate-post-name-max-length" value="<?php echo $this->options->qc_translate_post_name_max_length; ?>" />
							<p class="description"><?php _e('The translated post name may be very long. Here you can set the maximum length of the string of the post name. 0 is not limited.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(null, 'primary', null, true, array('id' => 'translate-post-name-save-changes')); ?>
		</div>
		<!-- Translate Post Name - end -->
	</form>
</div>