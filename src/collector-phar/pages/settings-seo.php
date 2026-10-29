<!-- SEO - start -->
<div class="nav-section">
	<h3><?php _e('Baidu Links Submission', $this->text_domain); ?></h3>
	<p><?php _e('The link submission tool is a tool for the website to actively push data to Baidu search. This tool can shorten the link time of the crawler discovery website. The website time-sensitive content suggests using the link submission tool to push data to the search in real time.', $this->text_domain); ?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-baidu-link-submit-enabled"><?php _e('Enabled', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-baidu-link-submit-enabled', 'name' => $this->settings_name . '[baidu-link-submit][enabled]', 'value' => $this->options->qc_baidu_link_submit_enabled )); ?>
					<p class="description"><?php _e('If a Remote Website is turned on, only remote URL will be pushed.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="baidu<?php if (!$this->options->qc_baidu_link_submit_enabled) print ' hidden'; ?>">
				<th scope="row"><label for="qqworld-collector-settings-baidu-link-submit-post-type"><?php _e('Post Types', $this->text_domain); ?></label></th>
				<td>
					<?php
 $post_types = get_post_types(array('public' => true, 'show_ui' => true, 'show_in_nav_menus' => true), 'object'); foreach ($post_types as $post_type => $args) : ?>
						<p><label><input name="<?php print $this->settings_name; ?>[baidu-link-submit][post_types][]" type="checkbox" value="<?php print $post_type; ?>" <?php checked(true, in_array($post_type, $this->options->qc_baidu_link_submit_post_types)); ?> /> <?php print $args->label; ?></label></p>
					<?php endforeach; ?>
					<p class="description"><?php _e('Please select post types which you want to push to Baidu.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="baidu<?php if (!$this->options->qc_baidu_link_submit_enabled) print ' hidden'; ?>">
				<th scope="row"><label for="qqworld-collector-settings-baidu-link-submit-daily"><?php _e('Quick Inclusion', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-baidu-link-submit-daily', 'name' => $this->settings_name . '[baidu-link-submit][daily]', 'value' => $this->options->qc_baidu_link_submit_daily )); ?>
					<p class="description"><?php _e('If your website is high-quality enough to use quick inclusion, please enable this option.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="baidu-quick-nclusion<?php if (!$this->options->qc_baidu_link_submit_enabled || !$this->options->qc_baidu_link_submit_daily) print ' hidden'; ?>">
				<th scope="row"><label for="qqworld-collector-settings-baidu-link-submit-post-type-for-quick-inclusion"><?php _e('Post Types', $this->text_domain); ?></label></th>
				<td>
					<?php
 $post_types = get_post_types(array('public' => true, 'show_ui' => true, 'show_in_nav_menus' => true), 'object'); foreach ($post_types as $post_type => $args) : ?>
						<p><label><input name="<?php print $this->settings_name; ?>[baidu-link-submit][post_types_quick_inclusion][]" type="checkbox" value="<?php print $post_type; ?>" <?php checked(true, in_array($post_type, $this->options->qc_baidu_link_submit_post_types_for_quick_inclusion)); ?> /> <?php print $args->label; ?></label></p>
					<?php endforeach; ?>
					<p class="description"><?php _e('Please select post types which you want to push to Baidu Quick Inclusion.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-baidu-link-submit-token"><?php _ex('Token', 'xiognzhang', $this->text_domain); ?></label></th>
				<td>
					<input name="<?php print $this->settings_name; ?>[baidu-link-submit][token]" type="text" class="regular-text" id="qqworld-collector-settings-baidu-link-submit-token" value="<?php echo $this->options->qc_baidu_link_submit_token; ?>" />
					<p class="description"><?php printf(__("If you don't have %s, please goto <a href=\"%s\" target=\"_blank\">Baidu</a> to get one.", $this->text_domain), _x('Token', 'xiognzhang', $this->text_domain), 'https://ziyuan.baidu.com/linksubmit/index'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-baidu-link-submit-cron"><?php _e('Cron', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-baidu-link-submit-cron', 'name' => $this->settings_name . '[baidu-link-submit][cron]', 'value' => $this->options->qc_baidu_link_submit_cron )); ?>
					<p class="description"><?php _e('Use the scheduled task to reissue once after submission, if the hit rate is very low, you can turn on this option.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('It is not recommended to enable it. If there are more collection tasks, it will cause confusion in the scheduled tasks.', $this->text_domain); ?></span></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-baidu-check-inclusion"><?php _e('Check Inclusion', $this->text_domain); ?></label></th>
				<td>
					<input name="baidu_url" type="text" class="regular-text" id="qqworld-collector-settings-baidu-check-inclusion" placeholder="<?php _e('Link URL', $this->text_domain); ?>" value="<?php print home_url(); ?>" />
					<p class="description"><?php _e('Please enter the link URL and click the check button to determine whether the link is included.', $this->text_domain); ?></p>
					<p class="submit"><button type="button" id="baidu-check-inclusion" class="button qc-icon search"><?php _e('Check Now', $this->text_domain); ?></button></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h3><?php _e('Shenma Links Submission', $this->text_domain); ?></h3>
	<p><?php _e('Shenma search engine is a rising star in the search engine world, which can quickly increase the traffic of the website. If your website integrates MIP, you must not miss this.', $this->text_domain); ?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-shenma-enabled"><?php _e('Enabled', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-shenma-enabled', 'name' => $this->settings_name . '[shenma][enabled]', 'value' => $this->options->qc_shenma_link_submit_enabled )); ?>
					<p class="description"><?php _e('If a Remote Website is turned on, only remote URL will be pushed.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="shenma<?php if (!$this->options->qc_shenma_link_submit_enabled) print ' hidden'; ?>">
				<th scope="row"><label for="qqworld-collector-settings-shenma-post-type"><?php _e('Post Types', $this->text_domain); ?></label></th>
				<td>
					<?php
 $post_types = get_post_types(array('public' => true, 'show_ui' => true, 'show_in_nav_menus' => true), 'object'); foreach ($post_types as $post_type => $args) : ?>
						<p><label><input name="<?php print $this->settings_name; ?>[shenma][post_types][]" type="checkbox" value="<?php print $post_type; ?>" <?php checked(true, in_array($post_type, $this->options->qc_shenma_link_submit_post_types)); ?> /> <?php print $args->label; ?></label></p>
					<?php endforeach; ?>
					<p class="description"><?php _e('Please select post types which you want to push to Shenma Webmaster Platform.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-shenma-username"><?php _ex('Username', 'shenma', $this->text_domain); ?></label></th>
				<td>
					<input name="<?php print $this->settings_name; ?>[shenma][username]" type="text" class="regular-text" id="qqworld-collector-settings-shenma-username" value="<?php print $this->options->qc_shenma_link_submit_username; ?>" />
					<p class="description"><?php printf(__("If you don't have %s, please goto <a href=\"%s\" target=\"_blank\">Shenma Webmaster Platform</a> to get one.", $this->text_domain), _x('Username', 'shenma', $this->text_domain), 'https://zhanzhang.sm.cn/'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-shenma-authkey"><?php _ex('Authkey', 'shenma', $this->text_domain); ?></label></th>
				<td>
					<input name="<?php print $this->settings_name; ?>[shenma][authkey]" type="text" class="regular-text" id="qqworld-collector-settings-shenma-authkey" value="<?php print $this->options->qc_shenma_link_submit_authkey; ?>" />
					<p class="description"><?php printf(__("If you don't have %s, please goto <a href=\"%s\" target=\"_blank\">Shenma Webmaster Platform</a> to get one.", $this->text_domain), _x('Authkey', 'shenma', $this->text_domain), 'https://zhanzhang.sm.cn/open/mip'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-shenma-link-submit-cron"><?php _e('Cron', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-shenma-link-submit-cron', 'name' => $this->settings_name . '[shenma][cron]', 'value' => $this->options->qc_shenma_link_submit_cron )); ?>
					<p class="description"><?php _e('Use the scheduled task to reissue once after submission, if the hit rate is very low, you can turn on this option.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('It is not recommended to enable it. If there are more collection tasks, it will cause confusion in the scheduled tasks.', $this->text_domain); ?></span></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h3><?php _e('Bing Links Submission', $this->text_domain); ?></h3>
	<p><?php _e('Bing is a web search engine launched by Microsoft.', $this->text_domain); ?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-bing-enabled"><?php _e('Enabled', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-bing-enabled', 'name' => $this->settings_name . '[bing][enabled]', 'value' => $this->options->qc_bing_link_submit_enabled )); ?>
					<p class="description"><?php _e('If a Remote Website is turned on, only remote URL will be pushed.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="bing<?php if (!$this->options->qc_bing_link_submit_enabled) print ' hidden'; ?>">
				<th scope="row"><label for="qqworld-collector-settings-bing-post-type"><?php _e('Post Types', $this->text_domain); ?></label></th>
				<td>
					<?php
 $post_types = get_post_types(array('public' => true, 'show_ui' => true, 'show_in_nav_menus' => true), 'object'); foreach ($post_types as $post_type => $args) : ?>
						<p><label><input name="<?php print $this->settings_name; ?>[bing][post_types][]" type="checkbox" value="<?php print $post_type; ?>" <?php checked(true, in_array($post_type, $this->options->qc_bing_link_submit_post_types)); ?> /> <?php print $args->label; ?></label></p>
					<?php endforeach; ?>
					<p class="description"><?php _e('Please select post types which you want to push to bing Webmaster Platform.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-bing-apikey"><?php _ex('API Key', 'bing', $this->text_domain); ?></label></th>
				<td>
					<input name="<?php print $this->settings_name; ?>[bing][apikey]" type="text" class="regular-text" id="qqworld-collector-settings-bing-apikey" value="<?php print $this->options->qc_bing_link_submit_apikey; ?>" />
					<p class="description"><?php printf(__("If you don't have %s, please goto <a href=\"%s\" target=\"_blank\">bing Webmaster Platform</a> to get one.", $this->text_domain), _x('API Key', 'bing', $this->text_domain), 'https://www.bing.com/webmasters'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-bing-indexnow-apikey">IndexNow <?php _ex('API Key', 'bing', $this->text_domain); ?></label></th>
				<td>
					<input name="<?php print $this->settings_name; ?>[bing][indexnow-apikey]" type="text" class="regular-text" id="qqworld-collector-settings-bing-indexnow-apikey" value="<?php print $this->options->qc_bing_link_submit_indexnow_apikey; ?>" />
					<p class="description"><?php printf(__("If you don't have %s, please goto <a href=\"%s\" target=\"_blank\">bing Webmaster Platform</a> to get one.", $this->text_domain), _x('API Key', 'bing', $this->text_domain), 'https://www.bing.com/indexnow#generateApiKey'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-bing-link-submit-cron"><?php _e('Cron', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-bing-link-submit-cron', 'name' => $this->settings_name . '[bing][cron]', 'value' => $this->options->qc_bing_link_submit_cron )); ?>
					<p class="description"><?php _e('Use the scheduled task to reissue once after submission, if the hit rate is very low, you can turn on this option.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('It is not recommended to enable it. If there are more collection tasks, it will cause confusion in the scheduled tasks.', $this->text_domain); ?></span></p>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<!-- SEO - end -->