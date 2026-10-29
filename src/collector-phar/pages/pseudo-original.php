<div class="wrap" id="qqworld-collector-settings">
	<h2 id="header-title"><?php _e('Pseudo Original', $this->text_domain); ?></h2>
	<p><?php _e('Automatically replace the keywords or insert paragraphs in the post content.', $this->text_domain); ?></p>
	<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
		<a href="#replacment-keywords" class="nav-tab qc-icon filters"><?php _e('Replacment Keywords', $this->text_domain); ?></a>
		<a href="#rewrite-title" class="nav-tab qc-icon edit"><?php _e('Rewrite Title', $this->text_domain); ?></a>
		<a href="#long-tail-keywords" class="nav-tab qc-icon tag"><?php _e('Long Tail Keywords', $this->text_domain); ?></a>
		<a href="#random-keywords" class="nav-tab qc-icon edit"><?php _e('Random Keywords', $this->text_domain); ?></a>
		<a href="#random-paragraph" class="nav-tab qc-icon edit"><?php _e('Random Paragraph', $this->text_domain); ?></a>
		<a href="#artificial-intelligence" class="nav-tab qc-icon ai"><?php _e('Artificial Intelligence', $this->text_domain); ?></a>
		<a href="#originality-detection" class="nav-tab qc-icon search"><?php _e('Originality Detection', $this->text_domain); ?></a>
		<a href="#cheater" class="nav-tab qc-icon minimize"><?php _e('SEO Cheater', $this->text_domain); ?></a>
		<a href="#simulate-manual-publish" class="nav-tab qc-icon edit"><?php _e('Simulate Manual Publish', $this->text_domain); ?></a>
	</h2>
	<form action="options.php" method="post" id="pseudo-original-form">
		<?php settings_fields($this->settings_name); ?>
		<?php include __DIR__ . '/pseudo-original-replacment-keywords.php'; ?>
		<?php include __DIR__ . '/pseudo-original-rewrite-title.php'; ?>
		<?php include __DIR__ . '/pseudo-original-long-tail-keywords.php'; ?>
		<!-- Random Keywords - start -->
		<div class="nav-section">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="random-keywords"><?php _e('Keywords', $this->text_domain); ?></label></th>
						<td>
							<textarea rows="30" class="large-text" id="random-keywords" name="<?php print $this->settings_name; ?>[random][keywords]" placeholder="<?php _e('Keywords', $this->text_domain); ?>"><?php print $this->options->qc_pseudo_original_random_keywords; ?></textarea>
							<p class="description"><?php _e('The content here can be called in a pseudo original filter in the collection project.<br />One per line.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Random Keywords - end -->
		<?php include __DIR__ . '/pseudo-original-random-paragraph.php'; ?>
		<?php include __DIR__ . '/pseudo-original-artificial-intelligence.php'; ?>
		<!-- Originality Detection start -->
		<div class="nav-section">
			<p><?php printf(__('This function is mainly called by the %s filter of collection projects.', $this->text_domain), __('Ignore by Keyword', $this->text_domain)); ?></p>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="originality-detection-api"><?php _e('API', $this->text_domain); ?></label></th>
						<td>
							<select id="originality-detection-api" name="<?php print $this->settings_name; ?>[originality-detection][api]" class="selectstyle" disabled>
								<option value="5118" <?php ?>><?php _e('5118 Originality Detection API', $this->text_domain); ?></option>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="originality-detection-5118-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
						<td>
							<input type="password" class="regular-text" id="originality-detection-5118-apikey" name="<?php print $this->settings_name; ?>[originality-detection][5118][apikey]" value="<?php print $this->options->qc_pseudo_original_originality_detection_5118_apikey; ?>" />
							<p><?php printf(__('If you don\'t have %s, please goto <a href="%s" target="_blank">%s</a> to get one.', $this->text_domain), __('API Key', $this->text_domain), 'https://account.5118.com/signin/myapi', '5118')?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Originality Detection end -->
		<?php include __DIR__ . '/pseudo-original-seo-cheater.php'; ?>
		<?php submit_button(); ?>
	</form>
	<?php include __DIR__ . '/pseudo-original-simulate-manual-publish.php'; ?>
</div>