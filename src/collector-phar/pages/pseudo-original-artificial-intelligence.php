<!-- Artificial Intelligence start -->
<div class="nav-section">
	<p><?php _e('Using artificial intelligence to process words.', $this->text_domain); ?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enable-artificial-intelligence"><?php _e('Enable', $this->text_domain); ?></label></th>
				<td><?php
 $this->the_switcher(array( 'id' => 'enable-artificial-intelligence', 'name' => $this->settings_name . '[artificial-intelligence][enabled]', 'value' => $this->options->qc_pseudo_original_artificial_intelligence_enabled )); ?><p><?php _e('The AI is invoked when the article is published to process the content.', $this->text_domain); ?></p></td>
			</tr>
			<tr>
				<th scope="row"><label for="post-types"><?php _e('Post Types', $this->text_domain); ?></label></th>
				<td>
					<?php
 $args = array( 'public' => true, 'show_ui' => true ); $post_types = get_post_types($args, 'objects'); ?>
					<ul id="post-types-list">
					<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment')) ) : ?>
						<li><label><input name="<?php print $this->settings_name; ?>[artificial-intelligence][post-types][]" type="checkbox" value="<?php echo $name; ?>" <?php checked(1, in_array($name, $this->options->qc_pseudo_original_artificial_intelligence_post_types)); ?> /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
					<?php endif; endforeach; ?>
						<li><label><input name="<?php print $this->settings_name; ?>[artificial-intelligence][post-types][]" type="checkbox" value="attachment" <?php checked(1, in_array('attachment', $this->options->qc_pseudo_original_artificial_intelligence_post_types)); ?> /> <?php _e('Media'); ?> (<?php $count = wp_count_posts('attachment'); print $count->inherit; ?>)</label></li>
					</ul>
					<p class="description"><?php _e('Select the post type that you want to use artificial intelligence to process.', $this->text_domain) ?><br /><span class="qc-icon info"><?php _e('Media refers to display pages, not media files, which are not required by most websites.', $this->text_domain); ?></span></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="content"><?php _e('Content', $this->text_domain); ?></label></th>
				<td>
					<p><label><input type="checkbox" value="post_title" name="<?php print $this->settings_name; ?>[artificial-intelligence][content][]" <?php checked(1, in_array('post_title', $this->options->qc_pseudo_original_artificial_intelligence_content)); ?>/> <?php _e('Post Title', $this->text_domain); ?></label></p>
					<p><label><input type="checkbox" value="post_content" name="<?php print $this->settings_name; ?>[artificial-intelligence][content][]" <?php checked(1, in_array('post_content', $this->options->qc_pseudo_original_artificial_intelligence_content)); ?>/> <?php _e('Post Content', $this->text_domain); ?></label></p>
					<p><label><input type="checkbox" value="post_excerpt" name="<?php print $this->settings_name; ?>[artificial-intelligence][content][]" <?php checked(1, in_array('post_excerpt', $this->options->qc_pseudo_original_artificial_intelligence_content)); ?>/> <?php _e('Post Excerpt', $this->text_domain); ?></label></p>
					<p class="desciption"><?php _e('Select the content what you want the AI to process.', $this->text_domain); ?></p>
					<h4><label for="content-meta-postmeta"><?php _e('Post Meta', $this->text_domain); ?></label></h4>
					<p><textarea name="<?php print $this->settings_name; ?>[artificial-intelligence][content_meta][postmeta]" id="content-meta-postmeta" class="regular-text" rows="3"><?php print $this->options->qc_pseudo_original_artificial_intelligence_content_post_meta; ?></textarea><br /><?php _e('Please enter post meta keys, one per line.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('To be effective, you must enable the use of artificial intelligence to process content when publishing posts.', $this->text_domain); ?></span></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="artificial-intelligence-api"><?php _e('API', $this->text_domain); ?></label></th>
				<td>
					<select id="artificial-intelligence-api" name="<?php print $this->settings_name; ?>[artificial-intelligence][api]" class="selectstyle">
						<option value="deepseek" <?php selected('deepseek', $this->options->qc_pseudo_original_artificial_intelligence_api); ?>><?php _e('DeepSeek Chat', $this->text_domain); ?></option>
						<option value="siliconflow" <?php selected('siliconflow', $this->options->qc_pseudo_original_artificial_intelligence_api); ?>><?php _e('Silicon Flow', $this->text_domain); printf(__(' (%s)', $this->text_domain), __('Model Plaza', $this->text_domain)); ?></option>
						<option value="qianfan" <?php selected('qianfan', $this->options->qc_pseudo_original_artificial_intelligence_api); ?>><?php _e('Baidu Qianfan', $this->text_domain); printf(__(' (%s)', $this->text_domain), __('Model Plaza', $this->text_domain)); ?></option>
						<option value="bailian" <?php selected('bailian', $this->options->qc_pseudo_original_artificial_intelligence_api); ?>><?php _e('Aliyun Bailian', $this->text_domain); printf(__(' (%s)', $this->text_domain), __('Model Plaza', $this->text_domain)); ?></option>
						<option value="doubao" <?php selected('doubao', $this->options->qc_pseudo_original_artificial_intelligence_api); ?>><?php _e('ByteDance - Doubao', $this->text_domain); ?></option>
						<option value="xfyun" <?php selected('xfyun', $this->options->qc_pseudo_original_artificial_intelligence_api); ?>><?php _e('Xinghuo Cognitive Model', $this->text_domain); ?></option>
						<option value="chatgpt" <?php selected('chatgpt', $this->options->qc_pseudo_original_artificial_intelligence_api); ?>>ChatGPT</option>
						<option value="custom" <?php selected('custom', $this->options->qc_pseudo_original_artificial_intelligence_api); ?>><?php _e('Custom API', $this->text_domain); ?></option>
					</select>
					<p><?php _e('The AI is invoked when the article is published to process the content.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<section class="artificial-intelligence-section deepseek<?php if ($this->options->qc_pseudo_original_artificial_intelligence_api != 'deepseek') print ' hidden'; ?>">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-deepseek-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
					<td>
						<ul id="deepseek_apiKey_list">
						<?php if (is_string($this->options->qc_pseudo_original_artificial_intelligence_deepseek_apikey)) $this->options->qc_pseudo_original_artificial_intelligence_deepseek_apikey = array($this->options->qc_pseudo_original_artificial_intelligence_deepseek_apikey); ?>
						<?php if (!empty($this->options->qc_pseudo_original_artificial_intelligence_deepseek_apikey)) foreach ($this->options->qc_pseudo_original_artificial_intelligence_deepseek_apikey as $apikey) : ?>
							<li style=""><input type="text" name="<?php print $this->settings_name; ?>[artificial-intelligence][deepseek][apikey][]" value="<?php print $apikey; ?>" placeholder="sk-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" class="regular-text"><button type="button" class="button delete-deepseek-apikey qc-icon delete"><?php _e('Delete'); ?></button></li>
						<?php endforeach; ?>
						</ul>
						<p><button type="button" id="add_deepseek_apikey" class="button"><?php _e('Add API Key', $this->text_domain); ?></button></p>
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('API Key', $this->text_domain), 'https://platform.deepseek.com/api_keys', __('API Keys', $this->text_domain)); ?><br /><?php printf(__('For details, please refer to the <a href="%s" target="_blank">help documentation</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#pseudo-original--artificial-intelligence--deepseek')); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
	<section class="artificial-intelligence-section siliconflow<?php if ($this->options->qc_pseudo_original_artificial_intelligence_api != 'siliconflow') print ' hidden'; ?>">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-siliconflow-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
					<td>
						<ul id="siliconflow_apiKey_list">
						<?php if (is_string($this->options->qc_pseudo_original_artificial_intelligence_siliconflow_apikey)) $this->options->qc_pseudo_original_artificial_intelligence_siliconflow_apikey = array($this->options->qc_pseudo_original_artificial_intelligence_siliconflow_apikey); ?>
						<?php if (!empty($this->options->qc_pseudo_original_artificial_intelligence_siliconflow_apikey)) foreach ($this->options->qc_pseudo_original_artificial_intelligence_siliconflow_apikey as $apikey) : ?>
							<li style=""><input type="text" name="<?php print $this->settings_name; ?>[artificial-intelligence][siliconflow][apikey][]" value="<?php print $apikey; ?>" placeholder="sk-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" class="regular-text"><button type="button" class="button delete-siliconflow-apikey qc-icon delete"><?php _e('Delete'); ?></button></li>
						<?php endforeach; ?>
						</ul>
						<p><button type="button" id="add_siliconflow_apikey" class="button"><?php _e('Add API Key', $this->text_domain); ?></button></p>
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('API Key', $this->text_domain), 'https://cloud.siliconflow.cn/account/ak', __('API Key Management', $this->text_domain)); ?><br /><?php printf(__('For details, please refer to the <a href="%s" target="_blank">help documentation</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#pseudo-original--artificial-intelligence--siliconflow')); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-siliconflow-model"><?php _e('Model', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-siliconflow-model" name="<?php print $this->settings_name; ?>[artificial-intelligence][siliconflow][model]" class="regular-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_siliconflow_model; ?>" placeholder="XXXXX/XXXXXXXXXXXXX" />
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('Model', $this->text_domain), 'https://cloud.siliconflow.cn/models', __('Model Plaza', $this->text_domain)); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
	<section class="artificial-intelligence-section qianfan<?php if ($this->options->qc_pseudo_original_artificial_intelligence_api != 'qianfan') print ' hidden'; ?>">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-qianfan-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-qianfan-apikey" name="<?php print $this->settings_name; ?>[artificial-intelligence][qianfan][apikey]" class="regular-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_qianfan_apikey; ?>" placeholder="bce-v3/ALTAK-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" />
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('API Key', $this->text_domain), 'https://console.bce.baidu.com/iam/#/iam/apikey/list', __('API Key Management', $this->text_domain)); ?><br /><?php printf(__('For details, please refer to the <a href="%s" target="_blank">help documentation</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#pseudo-original--artificial-intelligence--qianfan')); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-qianfan-appid"><?php _e('APP ID', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-qianfan-appid" name="<?php print $this->settings_name; ?>[artificial-intelligence][qianfan][appid]" class="regular-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_qianfan_appid; ?>" placeholder="app-XXXXXXXX" />
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('Model', $this->text_domain), 'https://console.bce.baidu.com/qianfan/ais/console/applicationConsole/application', __('Application Access', $this->text_domain)); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-qianfan-model"><?php _e('Model', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-qianfan-model" name="<?php print $this->settings_name; ?>[artificial-intelligence][qianfan][model]" class="regular-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_qianfan_model; ?>" placeholder="XXXXX/XXXXXXXXXXXXX" />
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('Model', $this->text_domain), 'https://console.bce.baidu.com/qianfan/modelcenter/model/buildIn/list', __('Model Plaza', $this->text_domain)); ?><br /><span class="qc-icon info"><?php _e('Note that the model name should not contain spaces and all letters should be in lowercase.', $this->text_domain); ?></span></p>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
	<section class="artificial-intelligence-section bailian<?php if ($this->options->qc_pseudo_original_artificial_intelligence_api != 'bailian') print ' hidden'; ?>">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-bailian-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
					<td>
						<ul id="bailian_apiKey_list">
						<?php if (is_string($this->options->qc_pseudo_original_artificial_intelligence_bailian_apikey)) $this->options->qc_pseudo_original_artificial_intelligence_bailian_apikey = array($this->options->qc_pseudo_original_artificial_intelligence_bailian_apikey); ?>
						<?php if (!empty($this->options->qc_pseudo_original_artificial_intelligence_bailian_apikey)) foreach ($this->options->qc_pseudo_original_artificial_intelligence_bailian_apikey as $apikey) : ?>
							<li style=""><input type="text" name="<?php print $this->settings_name; ?>[artificial-intelligence][bailian][apikey][]" value="<?php print $apikey; ?>" placeholder="sk-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" class="regular-text"><button type="button" class="button delete-bailian-apikey qc-icon delete"><?php _e('Delete'); ?></button></li>
						<?php endforeach; ?>
						</ul>
						<p><button type="button" id="add_bailian_apikey" class="button"><?php _e('Add API Key', $this->text_domain); ?></button></p>
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('API Key', $this->text_domain), 'https://bailian.console.aliyun.com/?apiKey=1', __('API Key Management', $this->text_domain)); ?><br /><?php printf(__('For details, please refer to the <a href="%s" target="_blank">help documentation</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#pseudo-original--artificial-intelligence--bailian')); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-bailian-model"><?php _e('Model', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-bailian-model" name="<?php print $this->settings_name; ?>[artificial-intelligence][bailian][model]" class="regular-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_bailian_model; ?>" placeholder="XXXXXXXX-XXXXX-XXX" />
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('Model', $this->text_domain), 'https://bailian.console.aliyun.com/', __('Model Plaza', $this->text_domain)); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
	<section class="artificial-intelligence-section doubao<?php if ($this->options->qc_pseudo_original_artificial_intelligence_api != 'doubao') print ' hidden'; ?>">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-doubao-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
					<td>
						<ul id="doubao_apiKey_list">
						<?php if (is_string($this->options->qc_pseudo_original_artificial_intelligence_doubao_apikey)) $this->options->qc_pseudo_original_artificial_intelligence_doubao_apikey = array($this->options->qc_pseudo_original_artificial_intelligence_doubao_apikey); ?>
						<?php if (!empty($this->options->qc_pseudo_original_artificial_intelligence_doubao_apikey)) foreach ($this->options->qc_pseudo_original_artificial_intelligence_doubao_apikey as $apikey) : ?>
							<li style=""><input type="text" name="<?php print $this->settings_name; ?>[artificial-intelligence][doubao][apikey][]" value="<?php print $apikey; ?>" placeholder="XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX" class="regular-text"><button type="button" class="button delete-doubao-apikey qc-icon delete"><?php _e('Delete'); ?></button></li>
						<?php endforeach; ?>
						</ul>
						<p><button type="button" id="add_doubao_apikey" class="button"><?php _e('Add API Key', $this->text_domain); ?></button></p>
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('API Key', $this->text_domain), 'https://console.volcengine.com/ark/region:ark+cn-beijing/apiKey', __('API Key Management', $this->text_domain)); ?><br /><?php printf(__('For details, please refer to the <a href="%s" target="_blank">help documentation</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#pseudo-original--artificial-intelligence--doubao')); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-doubao-endpoint"><?php _ex('Endpoint', 'doubao', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-doubao-endpoint" name="<?php print $this->settings_name; ?>[artificial-intelligence][doubao][endpoint]" class="regular-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_doubao_endpoint; ?>" placeholder="ep-XXXXXXXXXXXXXX-XXXXX" />
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), _x('Endpoint', 'doubao', $this->text_domain), 'https://console.volcengine.com/ark/region:ark+cn-beijing/endpoint', __('Model Inference', $this->text_domain)); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
	<section class="artificial-intelligence-section xfyun<?php if ($this->options->qc_pseudo_original_artificial_intelligence_api != 'xfyun') print ' hidden'; ?>">
		<?php if (file_exists(WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'xfyun' . DIRECTORY_SEPARATOR . 'autoload.php')) : ?>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-xfyun-version"><?php _e('Version', $this->text_domain); ?></label></th>
					<td>
						<select id="artificial-intelligence-xfyun-version" name="<?php print $this->settings_name; ?>[artificial-intelligence][xfyun][version]" class="selectstyle">
							<option value="1.1" <?php selected('1.1', $this->options->qc_pseudo_original_artificial_intelligence_xfyun_version); ?>>Spark Lite</option>
							<option value="2.1" <?php selected('2.1', $this->options->qc_pseudo_original_artificial_intelligence_xfyun_version); ?>>Spark v2.0</option>
							<option value="3.1" <?php selected('3.1', $this->options->qc_pseudo_original_artificial_intelligence_xfyun_version); ?>>Spark Pro</option>
							<option value="3.5" <?php selected('3.5', $this->options->qc_pseudo_original_artificial_intelligence_xfyun_version); ?>>Spark Max</option>
							<option value="4.0" <?php selected('4.0', $this->options->qc_pseudo_original_artificial_intelligence_xfyun_version); ?>>Spark v4.0 Ultra</option>
						</select><?php ?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-xfyun-appid"><?php _e('APPID', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-xfyun-appid" name="<?php print $this->settings_name; ?>[artificial-intelligence][xfyun][appid]" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_xfyun_appid; ?>" placeholder="XXXXXXXXX" />
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('APPID', $this->text_domain), 'https://console.xfyun.cn/app/myapp', __('XunFei Open Platform', $this->text_domain)); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-xfyun-apisecret"><?php _e('APISecret', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-xfyun-apisecret" name="<?php print $this->settings_name; ?>[artificial-intelligence][xfyun][apisecret]" class="regular-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_xfyun_apisecret; ?>" placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" />
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('APISecret', $this->text_domain), 'https://console.xfyun.cn/app/myapp', __('XunFei Open Platform', $this->text_domain)); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-xfyun-apikey"><?php _e('APIKey', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-xfyun-apikey" name="<?php print $this->settings_name; ?>[artificial-intelligence][xfyun][apikey]" class="regular-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_xfyun_apikey; ?>" placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" />
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('APIKey', $this->text_domain), 'https://console.xfyun.cn/app/myapp', __('XunFei Open Platform', $this->text_domain)); ?></p>
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
			</tbody>
		</table>
		<?php endif; ?>
	</section>
	<section class="artificial-intelligence-section chatgpt<?php if ($this->options->qc_pseudo_original_artificial_intelligence_api != 'chatgpt') print ' hidden'; ?>">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-chatgpt-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
					<td>
						<ul id="chatgpt_apiKey_list">
						<?php if (is_string($this->options->qc_pseudo_original_artificial_intelligence_chatgpt_apikey)) $this->options->qc_pseudo_original_artificial_intelligence_chatgpt_apikey = array($this->options->qc_pseudo_original_artificial_intelligence_chatgpt_apikey); ?>
						<?php if (!empty($this->options->qc_pseudo_original_artificial_intelligence_chatgpt_apikey)) foreach ($this->options->qc_pseudo_original_artificial_intelligence_chatgpt_apikey as $apikey) : ?>
							<li style=""><input type="text" name="<?php print $this->settings_name; ?>[artificial-intelligence][chatgpt][apikey][]" value="<?php print $apikey; ?>" placeholder="sk-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" class="regular-text"><button type="button" class="button delete-chatgpt-apikey qc-icon delete"><?php _e('Delete'); ?></button></li>
						<?php endforeach; ?>
						</ul>
						<p><button type="button" id="add_chatgpt_apikey" class="button"><?php _e('Add API Key', $this->text_domain); ?></button></p>
						<p class="description"><?php printf(__('Please get API Key from <a href="%s" target="_blank">OpenAI</a>.', $this->text_domain), 'https://chat.openai.com/auth/login'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-custom-appid"><?php _e('APPID', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-custom-appid" name="<?php print $this->settings_name; ?>[artificial-intelligence][custom][appid]" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_custom_appid; ?>" placeholder="XXXXXXXXX" />
						<p class="description"><?php printf(__('Please get %1$s from <a href="%2$s" target="_blank">%3$s</a>.', $this->text_domain), __('APPID', $this->text_domain), 'https://console.custom.cn/app/myapp', __('XunFei Open Platform', $this->text_domain)); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
	<section class="artificial-intelligence-section custom<?php if ($this->options->qc_pseudo_original_artificial_intelligence_api != 'custom') print ' hidden'; ?>">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-custom-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-custom-apikey" name="<?php print $this->settings_name; ?>[artificial-intelligence][custom][apikey]" class="regular-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_custom_apikey; ?>" placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" />
						<p class="description"><?php printf(__('For details, please refer to the <a href="%s" target="_blank">help documentation</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#pseudo-original--artificial-intelligence--custom')); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-custom-api-address"><?php _e('API Address', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-custom-api-address" name="<?php print $this->settings_name; ?>[artificial-intelligence][custom][api-address]" class="large-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_custom_api_address; ?>" placeholder="https://xxx.com/api/v3/chat/completions" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="artificial-intelligence-custom-model"><?php _e('Model', $this->text_domain); ?></label></th>
					<td>
						<input type="text" id="artificial-intelligence-custom-model" name="<?php print $this->settings_name; ?>[artificial-intelligence][custom][model]" class="regular-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_custom_model; ?>" placeholder="XXXXXXX-XXXX" />
					</td>
				</tr>
			</tbody>
		</table>
	</section>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="artificial-intelligence-what-to-do"><?php _e('What to do', $this->text_domain); ?></label></th>
				<td>
					<input type="text" id="artificial-intelligence-what-to-do" name="<?php print $this->settings_name; ?>[artificial-intelligence][what-to-do]" class="regular-text" value="<?php print $this->options->qc_pseudo_original_artificial_intelligence_what_to_do; ?>" placeholder="<?php _e('For example: Please translate the following content into English.', $this->text_domain); ?>" />
					<p class="description"><?php _e('Please enter what you need AI to do for you.', $this->text_domain); ?></p>
				</td>
			</ttr>
		</ttbody>
	</table>
</div>
<!-- Artificial Intelligence - end -->