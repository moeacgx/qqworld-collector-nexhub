<!-- XiongZhang Number - start -->
<div class="nav-section">
	<h3><?php _e('Links Submission', $this->text_domain); ?></h3>
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
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-baidu-link-submit-mip"><?php _e('MIP', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-baidu-link-submit-mip', 'name' => $this->settings_name . '[baidu-link-submit][mip]', 'value' => $this->options->qc_baidu_link_submit_mip )); ?>
					<p class="description"><?php _e('If your website supports MIP, please enable the MIP link to actively push.', $this->text_domain); ?></p>
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
				<th scope="row"><label for="qqworld-collector-settings-baidu-link-submit-post-type"><?php _e('Post Types', $this->text_domain); ?></label></th>
				<td>
					<?php
 $post_types = get_post_types(array('public' => true, 'show_ui' => true, 'show_in_nav_menus' => true), 'object'); foreach ($post_types as $post_type => $args) : ?>
						<p><label><input name="<?php print $this->settings_name; ?>[baidu-link-submit][post_types][]" type="checkbox" value="<?php print $post_type; ?>" <?php checked(true, in_array($post_type, $this->options->qc_baidu_link_submit_post_types)); ?> /> <?php print $args->label; ?></label></p>
					<?php endforeach; ?>
					<p class="description"><?php _e('Please select post types which you want to push to Baidu.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h3><?php _e('Xiongzhang Number Automatic Push Settings', $this->text_domain); ?></h3>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-xiongzhang-enabled"><?php _e('Enabled', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-xiongzhang-enabled', 'name' => $this->settings_name . '[xiongzhang][enabled]', 'value' => $this->options->qc_xiongzhang_enabled )); ?>
					<p class="description"><?php _e('If a Remote Website is turned on, only remote URL will be pushed.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-xiongzhang-appid"><?php _ex('APP ID', 'xiognzhang', $this->text_domain); ?></label></th>
				<td>
					<input name="<?php print $this->settings_name; ?>[xiongzhang][appid]" type="text" class="regular-text" id="qqworld-collector-settings-xiongzhang-appid" value="<?php echo $this->options->qc_xiongzhang_appid; ?>" />
					<p class="description"><?php printf(__("If you don't have %s, please goto <a href=\"%s\" target=\"_blank\">Baidu Xiongzhang Number</a> to get one.", $this->text_domain), _x('APP ID', 'xiognzhang', $this->text_domain), 'https://xiongzhang.baidu.com'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-xiongzhang-token"><?php _ex('Token', 'xiognzhang', $this->text_domain); ?></label></th>
				<td>
					<input name="<?php print $this->settings_name; ?>[xiongzhang][token]" type="text" class="regular-text" id="qqworld-collector-settings-xiongzhang-token" value="<?php echo $this->options->qc_xiongzhang_token; ?>" />
					<p class="description"><?php printf(__("If you don't have %s, please goto <a href=\"%s\" target=\"_blank\">Baidu Xiongzhang Number</a> to get one.", $this->text_domain), _x('Token', 'xiognzhang', $this->text_domain), 'https://xiongzhang.baidu.com'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-xiongzhang-post-type"><?php _e('Post Types', $this->text_domain); ?></label></th>
				<td>
					<?php
 $post_types = get_post_types(array('public' => true, 'show_ui' => true, 'show_in_nav_menus' => true), 'object'); foreach ($post_types as $post_type => $args) : ?>
						<p><label><input name="<?php print $this->settings_name; ?>[xiongzhang][post_types][]" type="checkbox" value="<?php print $post_type; ?>" <?php checked(true, in_array($post_type, $this->options->qc_xiongzhang_post_types)); ?> /> <?php print $args->label; ?></label></p>
					<?php endforeach; ?>
					<p class="description"><?php _e('Please select post types which you want to push to xiongzhang number.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="qqworld-collector-settings-xiongzhang-original"><?php _ex('Original', 'xiognzhang', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'qqworld-collector-settings-xiongzhang-original', 'name' => $this->settings_name . '[xiongzhang][original]', 'value' => $this->options->qc_xiongzhang_original )); ?>
					<p class="description"><?php _e('Submit original protection to Baidu Xiongzhang Number.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<!-- XiongZhang Number - end -->