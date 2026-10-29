<div class="wrap qqworld-ai-wrap" id="qqworld-collector-artificial-intelligence">
	<?php global $wpdb; ?>
	<h2><?php _e('Artificial Intelligence', $this->text_domain); ?></h2>
	<p><?php _e("You can conveniently call the large model here.", $this->text_domain); ?>
	<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
		<a href="#chat" class="nav-tab qc-icon comments"><?php _e('Chat', $this->text_domain); ?></a>
		<a href="#models" class="nav-tab qc-icon smart"><?php _e('Models', $this->text_domain); ?></a>
		<a href="#settings" class="nav-tab qc-icon settings"><?php _e('Settings', $this->text_domain); ?></a>
	</h2>
	<!-- Chat - start -->
	<div class="nav-section qqworld-ai-wrap">

		<div class="qqworld-ai-container">
			<aside class="qqworld-ai-sidebar">
				<div class="qqworld-ai-sidebar-header">
					<button type="button" class="button button-primary qqworld-ai-new-chat">
						<span class="dashicons dashicons-plus"></span>
						<?php _e('New Session', $this->text_domain); ?>
					</button>
				</div>
				
				<div class="qqworld-ai-sessions-list">
					<div class="qqworld-ai-loading-sessions">
						<span class="spinner is-active"></span>
						<?php _e('Loading...', $this->text_domain); ?>
					</div>
				</div>
			</aside>
			
			<main class="qqworld-ai-main">
				<div class="qqworld-ai-header">
					<div class="qqworld-ai-model-selector">
						<label for="qqworld-ai-model"><?php _e('Models: ', $this->text_domain); ?></label>
						<select id="qqworld-ai-model" class="qqworld-ai-model-select">
							<option value=""><?php _e('Choose a model', $this->text_domain); ?></option>
						</select>
					</div>
					<div class="qqworld-ai-session-title">
						<span class="qqworld-ai-title-text"><?php _e('New Session', $this->text_domain); ?></span>
					</div>
				</div>
				
				<div class="qqworld-ai-chat-area">
					<div class="qqworld-ai-messages" id="qqworld-ai-messages">
						<div class="qqworld-ai-empty-state">
							<div class="qqworld-ai-empty-icon">
								<span class="dashicons dashicons-lightbulb"></span>
							</div>
							<p><?php _e("Let's start the conversation! Choose a model, then enter a message.", $this->text_domain); ?></p>
						</div>
					</div>
					
					<div class="qqworld-ai-input-area">
						<div class="qqworld-ai-input-wrapper">
							<textarea 
								id="qqworld-ai-input" 
								class="qqworld-ai-message-input" 
								placeholder="<?php esc_attr_e('Enter a message...', $this->text_domain); ?>"
								rows="1"
							></textarea>
							<button type="button" class="button button-primary qqworld-ai-send-btn" disabled>
								<span class="dashicons dashicons-arrow-right-alt2"></span>
							</button>
						</div>
						<div class="qqworld-ai-input-row">
							<div class="qqworld-ai-checkbox-group">
								<label class="qqworld-ai-checkbox-label">
									<input type="checkbox" id="qqworld-ai-web-search" checked>
									<span><?php _e('Web Search', $this->text_domain); ?></span>
								</label>
								<label class="qqworld-ai-checkbox-label">
									<input type="checkbox" id="qqworld-ai-deep-thinking" checked>
									<span><?php _e('Deep Thinking', $this->text_domain); ?></span>
								</label>
							</div>
							<p class="qqworld-ai-input-hint">
								<?php _e('Press <strong>Enter</strong> to send, <strong>Shift + Enter</strong> to insert a new line', $this->text_domain); ?>
							</p>
						</div>
					</div>
				</div>
			</main>
		</div>

	</div>
	<!-- Chat - end -->

	<!-- Models - start -->
	<div class="nav-section">
		<div id="qqworld-ai-models-tab"></div>
	</div>
	<!-- Models - end -->

	<!-- Settings - start -->
	<div class="nav-section">
		<form id="artificial-intelligence-settings-form" action="options.php" method="post">
			<?php settings_fields($this->settings_name); ?>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label><?php _e('Web Search Mode', $this->text_domain); ?></label></th>
						<td>
							<select name="<?php print $this->settings_name; ?>[web-search]" id="qqworld-ai-web-search-mode">
								<option value="auto" <?php selected('auto', $this->options->qc_ai_web_search_mode); ?>><?php _e('Auto (Free Scraper)', $this->text_domain); ?></option>
								<option value="bing" <?php selected('bing', $this->options->qc_ai_web_search_mode); ?>><?php _e('Bing Search API', $this->text_domain); ?></option>
								<option value="baidu" <?php selected('baidu', $this->options->qc_ai_web_search_mode); ?>><?php _e('Baidu Search API', $this->text_domain); ?></option>
								<option value="duckduckgo" <?php selected('duckduckgo', $this->options->qc_ai_web_search_mode); ?>><?php _e('DuckDuckGo Search API', $this->text_domain); ?></option>
							</select>
							<p class="description"><?php _e('Select the web search engine for AI tools. Auto mode uses free scraper (no API key required).', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>

			<div class="qqworld-ai-search-settings" id="qqworld-ai-bing-settings" <?php if ($this->options->qc_ai_web_search_mode != 'bing') echo 'style="display:none;"'; ?>>
				<h3><?php _e('Bing Search API Settings', $this->text_domain); ?></h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="qqworld-ai-bing-api-key"><?php _e('API Key', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[bing-api-key]" type="password" class="regular-text" id="qqworld-ai-bing-api-key" value="<?php echo esc_attr($this->options->qc_ai_bing_api_key); ?>" />
								<p class="description"><?php printf(__('Get your API key from <a href="%s" target="_blank">Microsoft Azure</a>.', $this->text_domain), 'https://www.microsoft.com/en-us/bing/apis/bing-web-search-api'); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="qqworld-ai-bing-endpoint"><?php _e('Endpoint', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[bing-endpoint]" type="url" class="regular-text" id="qqworld-ai-bing-endpoint" value="<?php echo esc_url($this->options->qc_ai_bing_endpoint ?: 'https://api.bing.microsoft.com/v7.0/search'); ?>" />
								<p class="description"><?php _e('Default: https://api.bing.microsoft.com/v7.0/search', $this->text_domain); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="qqworld-ai-search-settings" id="qqworld-ai-baidu-settings" <?php if ($this->options->qc_ai_web_search_mode != 'baidu') echo 'style="display:none;"'; ?>>
				<h3><?php _e('Baidu Search API Settings', $this->text_domain); ?></h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="qqworld-ai-baidu-ak"><?php _e('AK (Access Key)', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[baidu-ak]" type="password" class="regular-text" id="qqworld-ai-baidu-ak" value="<?php echo esc_attr($this->options->qc_ai_baidu_ak); ?>" />
								<p class="description"><?php printf(__('Get your AK from <a href="%s" target="_blank">Baidu Cloud</a>.', $this->text_domain), 'https://cloud.baidu.com/'); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="qqworld-ai-baidu-sk"><?php _e('SK (Secret Key)', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[baidu-sk]" type="password" class="regular-text" id="qqworld-ai-baidu-sk" value="<?php echo esc_attr($this->options->qc_ai_baidu_sk); ?>" />
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="qqworld-ai-search-settings" id="qqworld-ai-duckduckgo-settings" <?php if ($this->options->qc_ai_web_search_mode != 'duckduckgo') echo 'style="display:none;"'; ?>>
				<h3><?php _e('DuckDuckGo Search API Settings', $this->text_domain); ?></h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="qqworld-ai-duckduckgo-token"><?php _e('API Token', $this->text_domain); ?></label></th>
							<td>
								<input name="<?php print $this->settings_name; ?>[duckduckgo-token]" type="password" class="regular-text" id="qqworld-ai-duckduckgo-token" value="<?php echo esc_attr($this->options->qc_ai_duckduckgo_token); ?>" />
								<p class="description"><?php printf(__('Get your token from <a href="%s" target="_blank">DuckDuckGo</a>.', $this->text_domain), 'https://duckduckgo.com/'); ?> <?php _e('Optional. DuckDuckGo works without API key in most cases.', $this->text_domain); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<?php submit_button(); ?>
		</form>
	</div>
	<!-- Settings - end -->

	<script>
	jQuery(function($) {
		$('#qqworld-ai-web-search-mode').on('change', function() {
			var mode = $(this).val();
			$('.qqworld-ai-search-settings').hide();
			if (mode === 'bing') $('#qqworld-ai-bing-settings').show();
			else if (mode === 'baidu') $('#qqworld-ai-baidu-settings').show();
			else if (mode === 'duckduckgo') $('#qqworld-ai-duckduckgo-settings').show();
		});
	});
	</script>
</div>