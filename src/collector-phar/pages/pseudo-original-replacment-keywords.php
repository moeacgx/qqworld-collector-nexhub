<!-- Replacment Keywords - start -->
<div class="nav-section">
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enable-replacment-keywords"><?php _e('Enable', $this->text_domain); ?></label></th>
				<td><?php
 $this->the_switcher(array( 'id' => 'enable-replacment-keywords', 'name' => $this->settings_name . '[enabled]', 'value' => $this->options->qc_pseudo_original_enabled )); ?></td>
			</tr>
			<tr>
				<th scope="row"><label for="mode"><?php _e('Mode', $this->text_domain); ?></label></th>
				<td>
					<p><label><input name="<?php print $this->settings_name; ?>[mode]" type="radio" id="<?php print $this->settings_name; ?>-mode-auto" value="auto" <?php checked('auto', $this->options->qc_pseudo_original_mode); ?> />
						<?php _e('Automatically replace the keywords in the post content when publishing the post.', $this->text_domain); ?></label></p>
					<p><label><input name="<?php print $this->settings_name; ?>[mode]" type="radio" id="<?php print $this->settings_name; ?>-mode-manual" value="manual" <?php checked('manual', $this->options->qc_pseudo_original_mode); ?> />
						<?php _e('Manually replace the keywords in the post content when you click the button on the top of editor.', $this->text_domain); ?></label></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="post-types"><?php _e('Post Types', $this->text_domain); ?></label></th>
				<td>
					<?php
 $args = array( 'public' => true, 'show_ui' => true ); $post_types = get_post_types($args, 'objects'); ?>
					<ul id="post-types-list">
					<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment')) ) : ?>
						<li><label><input name="<?php print $this->settings_name; ?>[post-types][]" type="checkbox" value="<?php echo $name; ?>" <?php checked(1, in_array($name, $this->options->qc_pseudo_original_post_types)); ?> /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
					<?php endif; endforeach; ?>
						<li><label><input name="<?php print $this->settings_name; ?>[post-types][]" type="checkbox" value="attachment" <?php checked(1, in_array('attachment', $this->options->qc_pseudo_original_post_types)); ?> /> <?php _e('Media'); ?> (<?php $count = wp_count_posts('attachment'); print $count->inherit; ?>)</label></li>
					</ul>
					<p class="description"><?php _e('Please select the post types to be pseudo-original.', $this->text_domain) ?><br /><span class="qc-icon info"><?php _e('Media refers to display pages, not media files, which are not required by most websites.', $this->text_domain); ?></span></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="content"><?php _e('Content', $this->text_domain); ?></label></th>
				<td>
					<p><label><input type="checkbox" value="post_title" name="<?php print $this->settings_name; ?>[content][]" <?php checked(1, in_array('post_title', $this->options->qc_pseudo_original_content)); ?>/> <?php _e('Post Title', $this->text_domain); ?></label></p>
					<p><label><input type="checkbox" value="post_content" name="<?php print $this->settings_name; ?>[content][]" <?php checked(1, in_array('post_content', $this->options->qc_pseudo_original_content)); ?>/> <?php _e('Post Content', $this->text_domain); ?></label></p>
					<p><label><input type="checkbox" value="post_excerpt" name="<?php print $this->settings_name; ?>[content][]" <?php checked(1, in_array('post_excerpt', $this->options->qc_pseudo_original_content)); ?>/> <?php _e('Post Excerpt', $this->text_domain); ?></label></p>
					<p class="desciption"><?php _e('Please select the content that you want to be pseudo-original.', $this->text_domain); ?></p>
					<p class="desciption qc-icon info"><?php _e('Pseudo-original authoring of post title is generally not recommended, as it may affect collection and eliminate duplication. If pay-per-view, check only the post content.', $this->text_domain); ?></p>
					<h4><label for="content-meta-postmeta"><?php _e('Post Meta', $this->text_domain); ?></label></h4>
					<p><textarea name="<?php print $this->settings_name; ?>[content_meta][postmeta]" id="content-meta-postmeta" class="regular-text" rows="3"><?php print $this->options->qc_pseudo_original_content_post_meta; ?></textarea><br /><?php _e('Please enter post meta keys, one per line.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('The pseudo original must be globally enabled and the automatic mode must be set to be effective.', $this->text_domain); ?></span></p>
				</td>
			</tr>
			<tr valign="top" class="hidden">
				<th scope="row"><label for="use-build-in-lexicons"><?php _e('Use Build-in Lexicons', $this->text_domain); ?></label></th>
				<td><?php
 $this->the_switcher(array( 'id' => 'use-build-in-lexicons', 'name' => $this->settings_name . '[use-build-in-lexicons]', 'value' => $this->options->qc_pseudo_original_use_build_in_lexicons )); ?></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="automatic"><?php _e('Automatic Thesaurus', $this->text_domain); ?></label></th>
				<td><?php
 $this->the_switcher(array( 'id' => 'automatic', 'name' => $this->settings_name . '[automatic][enabled]', 'value' => $this->options->qc_pseudo_original_automatic_enabled )); ?><p class="desciption"><?php printf(__('Use the external thesaurus to automatically replace keywords in the post content.<br />Some paid pseudo-originals are expensive, so consider buying them in the <a href="%s" target="_blank">official QQ group with other webmasters.', $this->text_domain), admin_url('admin.php?page=qqworld-collector#customer-service')); ?></p></td>
			</tr>
			<tr valign="top" class="automatic<?php if ($this->options->qc_pseudo_original_automatic_enabled != 1) print ' hidden'; ?>">
				<th scope="row"><label for="automatic-api"><?php _ex('API', 'pseudo original', $this->text_domain); ?></label></th>
				<td>
					<select id="automatic-api" name="<?php print $this->settings_name; ?>[automatic][api]" class="selectstyle">
						<optgroup label="<?php _e('Free', $this->text_domain); ?>">
							<option value="free-5118" <?php selected('free-5118', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('Free 5118 Big Data (wyc.5118.com)', $this->text_domain); ?></option>
							<option value="free-naipan-seo" <?php selected('free-naipan-seo', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('Free NaiPan SEO (naipan.com)', $this->text_domain); _e(' (Recommended)', $this->text_domain); ?></option>
						</optgroup>
						<optgroup label="<?php _ex('Commercial', 'version', $this->text_domain); ?>">
							<option value="pay-5118" <?php selected('pay-5118', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('5118 Big Data - One-click smart original (wyc.5118.com)', $this->text_domain); ?></option>
							<option value="pay-5118-rewrite" <?php selected('pay-5118-rewrite', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('5118 Big Data - One-click smart rewrite (wyc.5118.com)', $this->text_domain); ?></option>
							<option value="vip-naipan-ai" <?php selected('vip-naipan-ai', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('VIP NaiPan AI (naipan.com)', $this->text_domain); _e(' (Not Recommended)', $this->text_domain); ?></option>
							<option value="bokeai" <?php selected('bokeai', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('BoKe AI (bokeai.com)', $this->text_domain); ?></option>
							<option value="xiaofamao" <?php selected('xiaofamao', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('Xiaofamao Smart Writing (xiaofamao.com)', $this->text_domain); ?></option>
							<option value="puppy" <?php selected('puppy', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('Puppy AI+ (7pyx.com)', $this->text_domain); ?></option>
							<option value="baebos" <?php selected('baebos', $this->options->qc_pseudo_original_automatic_api); ?> disabled><?php _e('BAEBOS Intelligent Content Creation (api.baebos.com)', $this->text_domain); ?></option>
							<option value="naipan" <?php selected('naipan', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('Naipan (naipan.com)', $this->text_domain); ?></option>
							<option value="spinrewriter" <?php selected('spinrewriter', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('SpinRewriter (spinrewriter.com)', $this->text_domain); ?></option>
							<option value="ifagou" <?php selected('ifagou', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('iFaGou (ifagou.com)', $this->text_domain); ?></option>
							<option value="aixiegao" <?php selected('aixiegao', $this->options->qc_pseudo_original_automatic_api); ?>><?php _e('AiXieGao SEO (aixiegao.com)', $this->text_domain); _e(' (Not Recommended)', $this->text_domain); ?></option>
						</optgroup>
					</select>
					<p class="desciption"><?php _e('Please select the pseudo-original API of the automatic mode.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="automatic<?php if ($this->options->qc_pseudo_original_automatic_enabled != 1) print ' hidden'; ?>">
		<section class="free-5118 section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'free-5118') print ' hidden'; ?>">
		</section>
		<section class="free-naipan-seo section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'free-naipan-seo') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-free-naipan-seo"><?php _e('Cookies'); ?></label></th>
						<td>
							<textarea name="<?php print $this->settings_name; ?>[automatic][free-naipan-seo][cookies]" id="automatic-free-naipan-seo" class="large-text" rows="3" placeholder="Cookie: UM_distinctid=16e5b28df47217-0833dff79c853a-7711a3e-1fa400-16e5b28df4838d..."><?php print $this->options->qc_pseudo_original_automatic_free_naipan_seo_cookies?></textarea>
							<p class="description"><?php printf(__('Please log in to <a href="%s" target="_blank">NaiPan</a> and get the cookies on the home page.', $this->text_domain), 'http://www.naipan.com'); ?><br /><?php _e("The free user's originality is only 50%. To get 100% originality, please buy a VIP.", $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="vip-naipan-ai section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'vip-naipan-ai') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-vip-naipan-ai"><?php _e('Cookies'); ?></label></th>
						<td>
							<textarea name="<?php print $this->settings_name; ?>[automatic][vip-naipan-ai][cookies]" id="automatic-vip-naipan-ai" class="large-text" rows="3" placeholder="Cookie: UM_distinctid=16e5b28df47217-0833dff79c853a-7711a3e-1fa400-16e5b28df4838d..."><?php print $this->options->qc_pseudo_original_automatic_vip_naipan_ai_cookies?></textarea>
							<p class="description"><?php printf(__('Please log in to <a href="%s" target="_blank">NaiPan</a> and get the cookies on the home page.', $this->text_domain), 'http://www.naipan.com'); ?><br /><?php _e('Available only to VIP users, It is not recommended to buy, it is easy to be blocked.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="bokeai section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'bokeai') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-bokeai-api-address"><?php _e('API Address', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="large-text" id="automatic-bokeai-api-address" name="<?php print $this->settings_name; ?>[automatic][bokeai][address]" value="<?php print $this->options->qc_pseudo_original_automatic_bokeai_address; ?>" />
							<p class="description"><?php printf(__('Please get API Address from <a href="%s" target="_blank">bokeai</a>', $this->text_domain), 'https://www.bokeai.com'); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-bokeai-api"><?php _e('API', $this->text_domain); ?></label></th>
						<td>
							<select name="<?php print $this->settings_name; ?>[automatic][bokeai][api]" id="automatic-bokeai-api" class="selectstyle">
								<option value="1"<?php selected(1, $this->options->qc_pseudo_original_automatic_bokeai_api); ?>>V1</option>
								<option value="2"<?php selected(2, $this->options->qc_pseudo_original_automatic_bokeai_api); ?>>V2</option>
								<option value="3"<?php selected(3, $this->options->qc_pseudo_original_automatic_bokeai_api); ?>>V3</option>
								<option value="4"<?php selected(4, $this->options->qc_pseudo_original_automatic_bokeai_api); ?>>V4</option>
								<option value="5"<?php selected(5, $this->options->qc_pseudo_original_automatic_bokeai_api); ?>>V5</option>
								<option value="6"<?php selected(6, $this->options->qc_pseudo_original_automatic_bokeai_api); ?>>V6</option>
								<option value="7"<?php selected(7, $this->options->qc_pseudo_original_automatic_bokeai_api); ?>>V7</option>
								<option value="9"<?php selected(9, $this->options->qc_pseudo_original_automatic_bokeai_api); ?>>V9</option>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-bokeai-lock-nouns"><?php _e('Lock the Nouns', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-bokeai-lock-nouns', 'name' => $this->settings_name . '[automatic][bokeai][lock-nouns]', 'value' => $this->options->qc_pseudo_original_automatic_bokeai_lock_nouns )); ?>
							<p class="description"><?php _e('Identify nouns and lock them out.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="xiaofamao section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'xiaofamao') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-xiaofamao-api-address"><?php _e('API Address', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="large-text" id="automatic-xiaofamao-api-address" name="<?php print $this->settings_name; ?>[automatic][xiaofamao][address]" value="<?php print $this->options->qc_pseudo_original_automatic_xiaofamao_address; ?>" />
							<p class="description"><?php printf(__('Please get API Address from <a href="%s" target="_blank">Xiaofamao</a>', $this->text_domain), 'http://www.xiaofamao.com'); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-xiaofamao-api"><?php _e('API', $this->text_domain); ?></label></th>
						<td>
							<select name="<?php print $this->settings_name; ?>[automatic][xiaofamao][api]" id="automatic-xiaofamao-api" class="selectstyle">
								<option value="1"<?php selected(1, $this->options->qc_pseudo_original_automatic_xiaofamao_api); ?>>V1 (<?php _e('More Smooth', $this->text_domain); ?>)</option>
								<option value="2"<?php selected(2, $this->options->qc_pseudo_original_automatic_xiaofamao_api); ?>>V2 (<?php _e('High Originality', $this->text_domain); ?>)</option>
								<option value="3"<?php selected(3, $this->options->qc_pseudo_original_automatic_xiaofamao_api); ?>>V3 (<?php _e('Highest Originality', $this->text_domain); ?>)</option>
								<!--<option value="5"<?php selected(5, $this->options->qc_pseudo_original_automatic_xiaofamao_api); ?>>V5 (<?php _e('Suitable for Entertainment', $this->text_domain); ?>)</option>
								<option value="6"<?php selected(6, $this->options->qc_pseudo_original_automatic_xiaofamao_api); ?>>V6 (<?php _e('Suitable for Games', $this->text_domain); ?>)</option>
								<option value="7"<?php ?>>V7 (<?php ?>)</option>
								<option value="9"<?php ?>>V9 (<?php ?>)</option>-->
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-xiaofamao-lock-nouns"><?php _e('Lock the Nouns', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-xiaofamao-lock-nouns', 'name' => $this->settings_name . '[automatic][xiaofamao][lock-nouns]', 'value' => $this->options->qc_pseudo_original_automatic_xiaofamao_lock_nouns )); ?>
							<p class="description"><?php _e('Identify nouns and lock them out.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="puppy section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'puppy') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-puppy-api-address"><?php _e('API Address', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="large-text" id="automatic-puppy-api-address" name="<?php print $this->settings_name; ?>[automatic][puppy][address]" value="<?php print $this->options->qc_pseudo_original_automatic_puppy_address; ?>" />
							<p class="description"><?php printf(__('Please get API Address from <a href="%s" target="_blank">Puppy AI+</a>', $this->text_domain), 'http://www.7pyx.com'); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-puppy-api"><?php _e('API', $this->text_domain); ?></label></th>
						<td>
							<select name="<?php print $this->settings_name; ?>[automatic][puppy][api]" id="automatic-puppy-api" class="selectstyle">
								<option value="1"<?php selected(1, $this->options->qc_pseudo_original_automatic_puppy_api); ?>>V1 (<?php _e('More Smooth', $this->text_domain); ?>)</option>
								<option value="2"<?php selected(2, $this->options->qc_pseudo_original_automatic_puppy_api); ?>>V2 (<?php _e('High Originality', $this->text_domain); ?>)</option>
								<option value="3"<?php selected(3, $this->options->qc_pseudo_original_automatic_puppy_api); ?>>V3 (<?php _e('Highest Originality', $this->text_domain); ?>)</option>
								<option value="5"<?php selected(5, $this->options->qc_pseudo_original_automatic_puppy_api); ?>>V5 (<?php _e('Suitable for Entertainment', $this->text_domain); ?>)</option>
								<option value="6"<?php selected(6, $this->options->qc_pseudo_original_automatic_puppy_api); ?>>V6 (<?php _e('Suitable for Games', $this->text_domain); ?>)</option>
								<!--<option value="7"<?php ?>>V7 (<?php ?>)</option>
								<option value="9"<?php ?>>V9 (<?php ?>)</option>-->
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-puppy-lock-nouns"><?php _e('Lock the Nouns', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-puppy-lock-nouns', 'name' => $this->settings_name . '[automatic][puppy][lock-nouns]', 'value' => $this->options->qc_pseudo_original_automatic_puppy_lock_nouns )); ?>
							<p class="description"><?php _e('Identify nouns and lock them out.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="baebos section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'baebos') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-baebos-api-address"><?php _e('API Address', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="large-text" id="automatic-baebos-api-address" name="<?php print $this->settings_name; ?>[automatic][baebos][address]" value="<?php print $this->options->qc_pseudo_original_automatic_baebos_address; ?>" />
							<p class="description"><?php printf(__('Please get API Address from <a href="%s" target="_blank">BAEBOS</a>', $this->text_domain), 'https://api.baebos.com/?Ucenter'); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-baebos-model"><?php _e('Polish Model', $this->text_domain); ?></label></th>
						<td>
							<select name="<?php print $this->settings_name; ?>[automatic][baebos][model]" id="automatic-baebos-model" class="selectstyle">
								<option value="1"<?php selected(1, $this->options->qc_pseudo_original_automatic_baebos_model); ?>>V1 (<?php _e('More Smooth and Low Originality', $this->text_domain); ?>)</option>
								<option value="2"<?php selected(2, $this->options->qc_pseudo_original_automatic_baebos_model); ?> disabled>V2 (<?php _e('Smooth and Originality', $this->text_domain); ?>)</option>
								<option value="3"<?php selected(3, $this->options->qc_pseudo_original_automatic_baebos_model); ?>>V3 (<?php _e('High Originality', $this->text_domain); ?>)</option>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-baebos-lock-nouns"><?php _e('Lock the Nouns', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-baebos-lock-nouns', 'name' => $this->settings_name . '[automatic][baebos][lock-nouns]', 'value' => $this->options->qc_pseudo_original_automatic_baebos_lock_nouns )); ?>
							<p class="description"><?php _e('Identify nouns and lock them out.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="aixiegao section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'aixiegao') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-aixiegao-token"><?php _e('Token', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="regular-text" id="automatic-aixiegao-token" name="<?php print $this->settings_name; ?>[automatic][aixiegao][token]" value="<?php print $this->options->qc_pseudo_original_automatic_aixiegao_token; ?>" />
							<p class="description"><?php printf(__('Please get Token from <a href="%s" target="_blank">AiXieGao</a>', $this->text_domain), 'https://www.aixiegao.com'); ?></p>
							<p class="description"><?php _e('According to users, this pseudo-original problem is more and not recommended.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="pay-5118 section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'pay-5118') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-5118-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="regular-text" id="automatic-5118-apikey" name="<?php print $this->settings_name; ?>[automatic][5118][apikey]" value="<?php print $this->options->qc_pseudo_original_automatic_5118_apikey; ?>" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-5118-retype"><?php _e('Refactoring Type', $this->text_domain); ?></label></th>
						<td>
							<select id="automatic-5118-retype" name="<?php print $this->settings_name; ?>[automatic][5118][retype]" class="selectstyle">
								<option value="0" <?php selected(0, $this->options->qc_pseudo_original_automatic_5118_retype); ?>><?php _e('Fingerprint Reconstruction', $this->text_domain); ?></option>
								<option value="1" <?php selected(1, $this->options->qc_pseudo_original_automatic_5118_retype); ?>><?php _e('Sentence Reconstruction', $this->text_domain); ?></option>
								<option value="-1" <?php selected(-1, $this->options->qc_pseudo_original_automatic_5118_retype); ?>><?php _ex('Both', '5118', $this->text_domain); ?></option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="pay-5118-rewrite section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'pay-5118-rewrite') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-5118-rewrite-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="regular-text" id="automatic-5118-rewrite-apikey" name="<?php print $this->settings_name; ?>[automatic][5118-rewrite][apikey]" value="<?php print $this->options->qc_pseudo_original_automatic_5118_rewrite_apikey; ?>" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-5118-rewrite-retype"><?php _e('Refactoring Type', $this->text_domain); ?></label></th>
						<td>
							<select id="automatic-5118-retype" name="<?php print $this->settings_name; ?>[automatic][5118-rewrite][retype]" class="selectstyle">
								<option value="0" <?php selected(0, $this->options->qc_pseudo_original_automatic_5118_rewrite_retype); ?>><?php _e('Default', $this->text_domain); ?></option>
								<option value="1" <?php selected(1, $this->options->qc_pseudo_original_automatic_5118_rewrite_retype); ?>><?php _e('Mild Sentence Rewriting', $this->text_domain); ?></option>
								<option value="2" <?php selected(2, $this->options->qc_pseudo_original_automatic_5118_rewrite_retype); ?>><?php _ex('Cautious Sentence Rewriting', '5118', $this->text_domain); ?></option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="naipan section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'naipan') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-naipan-regname"><?php _e('Username', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="regular-text" id="automatic-naipan-regname" name="<?php print $this->settings_name; ?>[automatic][naipan][regname]" value="<?php print $this->options->qc_pseudo_original_automatic_naipan_regname; ?>" />
							<p class="description"><?php _e('Please enter your username (email address).', $this->text_domain); ?></p>
							<p class="description"><em class="qc-icon info"><?php _e('Please purchase the Extreme Edition, Enhanced Edition is only for manual posting.', $this->text_domain); ?></em></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-naipan-regsn"><?php _e('Authorization Code', $this->text_domain); ?></label></th>
						<td>
							<input type="password" class="regular-text" id="automatic-naipan-regsn" name="<?php print $this->settings_name; ?>[automatic][naipan][regsn]" value="<?php print $this->options->qc_pseudo_original_automatic_naipan_regsn; ?>" />
							<p class="description"><?php _e('Please enter authorization code.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="spinrewriter section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'spinrewriter') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-email"><?php _e('E-mail Address', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="regular-text" id="automatic-spinrewriter-email" name="<?php print $this->settings_name; ?>[automatic][spinrewriter][email]" value="<?php print $this->options->qc_pseudo_original_automatic_spinrewriter_email; ?>" />
							<p class="description"><?php _e('Please enter your username (email address).', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-regname"><?php _e('API Key', $this->text_domain); ?></label></th>
						<td>
							<input type="password" class="regular-text" id="automatic-spinrewriter-api-key" name="<?php print $this->settings_name; ?>[automatic][spinrewriter][api-key]" value="<?php print $this->options->qc_pseudo_original_automatic_spinrewriter_api_key; ?>" />
							<p class="description"><?php printf(__('Please enter your <a href="%s" target="_blank">API Key</a>.', $this->text_domain), 'https://www.spinrewriter.com/cp-api'); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-confidence-level"><?php _e('Confidence Level', $this->text_domain); ?></label></th>
						<td>
							<select id="automatic-spinrewriter-confidence-level" name="<?php print $this->settings_name; ?>[automatic][spinrewriter][confidence-level]" class="selectstyle">
								<option value="low" <?php selected('low', $this->options->qc_pseudo_original_automatic_spinrewriter_confidence_level); ?>><?php _e('Low: largest number of synonyms for various words and phrases, least readable unique variations of text', $this->text_domain); ?></option>
								<option value="medium" <?php selected('medium', $this->options->qc_pseudo_original_automatic_spinrewriter_confidence_level); ?>><?php _e('Medium: relatively reliable synonyms, usually well readable unique variations of text', $this->text_domain); ?></option>
								<option value="high" <?php selected('high', $this->options->qc_pseudo_original_automatic_spinrewriter_confidence_level); ?>><?php _e('High: only the most reliable synonyms, perfectly readable unique variations of text', $this->text_domain); ?></option>
							</select>
							<p class="description"><?php _e('Set the confidence level of the One-Click Rewrite process.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-protected-terms"><?php _e('Protected Terms', $this->text_domain); _e(' (optional)', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="large-text" id="automatic-spinrewriter-protected-terms" name="<?php print $this->settings_name; ?>[automatic][spinrewriter][protected-terms]" value="<?php print $this->options->qc_pseudo_original_automatic_spinrewriter_protected_terms; ?>" />
							<p class="description"><?php _e('Set a list of protected terms, protected terms are separated by commas (comma-separated list).', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-nested-spintax"><?php _e('Nested Spintax', $this->text_domain); _e(' (optional)', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-spinrewriter-nested-spintax', 'name' => $this->settings_name . '[automatic][spinrewriter][nested-spintax]', 'value' => $this->options->qc_pseudo_original_automatic_spinrewriter_nested_spintax )); ?>
							<p class="description"><?php _e('Set whether the One-Click Rewrite process uses nested spinning syntax (multi-level spinning) or not.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-auto-sentences"><?php _e('Auto Sentences', $this->text_domain); _e(' (optional)', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-spinrewriter-auto-sentences', 'name' => $this->settings_name . '[automatic][spinrewriter][auto-sentences]', 'value' => $this->options->qc_pseudo_original_automatic_spinrewriter_auto_sentences )); ?>
							<p class="description"><?php _e('Set whether Spin Rewriter rewrites complete sentences on its own.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-Auto-Paragraphs"><?php _e('Auto Paragraphs', $this->text_domain); _e(' (optional)', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-spinrewriter-auto-paragraphs', 'name' => $this->settings_name . '[automatic][spinrewriter][auto-paragraphs]', 'value' => $this->options->qc_pseudo_original_automatic_spinrewriter_auto_paragraphs )); ?>
							<p class="description"><?php _e('Set whether Spin Rewriter rewrites entire paragraphs on its own.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-auto-new-paragraphs"><?php _e('Auto New Paragraphs', $this->text_domain); _e(' (optional)', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-spinrewriter-auto-new-paragraphs', 'name' => $this->settings_name . '[automatic][spinrewriter][auto-new-paragraphs]', 'value' => $this->options->qc_pseudo_original_automatic_spinrewriter_auto_new_paragraphs )); ?>
							<p class="description"><?php _e('Set whether Spin Rewriter writes additional paragraphs on its own.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-auto-sentence-trees"><?php _e('Auto Sentence Trees', $this->text_domain); _e(' (optional)', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-spinrewriter-auto-sentence-trees', 'name' => $this->settings_name . '[automatic][spinrewriter][auto-sentence-trees]', 'value' => $this->options->qc_pseudo_original_automatic_spinrewriter_auto_sentence_trees )); ?>
							<p class="description"><?php _e('Set whether Spin Rewriter changes the entire structure of phrases and sentences.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-use-only-synonyms"><?php _e('Use Only Synonyms', $this->text_domain); _e(' (optional)', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-spinrewriter-use-only-synonyms', 'name' => $this->settings_name . '[automatic][spinrewriter][use-only-synonyms]', 'value' => $this->options->qc_pseudo_original_automatic_spinrewriter_use_only_synonyms )); ?>
							<p class="description"><?php _e('Sets whether Spin Rewriter should only use synonyms (where available) when generating spun text.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-reorder-paragraphs"><?php _e('Reorder Paragraphs', $this->text_domain); _e(' (optional)', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-spinrewriter-reorder-paragraphs', 'name' => $this->settings_name . '[automatic][spinrewriter][reorder-paragraphs]', 'value' => $this->options->qc_pseudo_original_automatic_spinrewriter_reorder_paragraphs )); ?>
							<p class="description"><?php _e('Sets whether Spin Rewriter should intelligently randomize the order of paragraphs and lists when generating spun text.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-add-html-markup"><?php _e('Add HTML Markup', $this->text_domain); _e(' (optional)', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-spinrewriter-add-html-markup', 'name' => $this->settings_name . '[automatic][spinrewriter][add-html-markup]', 'value' => $this->options->qc_pseudo_original_automatic_spinrewriter_add_html_markup )); ?>
							<p class="description"><?php _e('Sets whether Spin Rewriter should automatically enrich generated articles with headings, bullet points, etc.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-spinrewriter-use-html-line-breaks"><?php _e('Use HTML Line breaks', $this->text_domain); _e(' (optional)', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'automatic-spinrewriter-use-html-line-breaks', 'name' => $this->settings_name . '[automatic][spinrewriter][use-html-line-breaks]', 'value' => $this->options->qc_pseudo_original_automatic_spinrewriter_use_html_line_breaks )); ?>
							<p class="description"><?php _e('Sets whether Spin Rewriter should automatically convert line-breaks to HTML tags.', $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="ifagou section-tab<?php if ($this->options->qc_pseudo_original_automatic_api != 'ifagou') print ' hidden'; ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="automatic-ifagou-apiid"><?php _ex('API ID', 'ifagou', $this->text_domain); ?></label></th>
						<td>
							<input type="text" class="regular-text" id="automatic-ifagou-apiid" name="<?php print $this->settings_name; ?>[automatic][ifagou][apiid]" value="<?php print $this->options->qc_pseudo_original_automatic_ifagou_apiid; ?>" />
							<p class="description"><?php printf(__('Please get API ID from <a href="%s" target="_blank">iFaGou</a>.', $this->text_domain), 'http://www.ifagou.com/openapi/index.html'); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-ifagou-apisecret"><?php _ex('API Secret', 'ifagou', $this->text_domain); ?></label></th>
						<td>
							<input type="password" class="regular-text" id="automatic-ifagou-apisecret" name="<?php print $this->settings_name; ?>[automatic][ifagou][apisecret]" value="<?php print $this->options->qc_pseudo_original_automatic_ifagou_apisecret; ?>" />
							<p class="description"><?php printf(__('Please get API Secret from <a href="%s" target="_blank">iFaGou</a>.', $this->text_domain), 'http://www.ifagou.com/openapi/index.html'); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="automatic-ifagou-type"><?php _e('Type', $this->text_domain); ?></label></th>
						<td>
							<select class="selectstyle" id="automatic-ifagou-type" name="<?php print $this->settings_name; ?>[automatic][ifagou][type]">
								<option value="0" <?php selected('0', $this->options->qc_pseudo_original_automatic_ifagou_type); ?>><?php _e('Basic Pseudo Original', $this->text_domain); ?></option>
								<option value="1" <?php selected('1', $this->options->qc_pseudo_original_automatic_ifagou_type); ?>><?php _e('Originality First', $this->text_domain); ?></option>
								<option value="2" <?php selected('2', $this->options->qc_pseudo_original_automatic_ifagou_type); ?>><?php _e('Readability First', $this->text_domain); ?></option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
		<h3><?php _e('Test Automatic Mode', $this->text_domain); ?></h3>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="test-replacment-keywords"><?php _e('Test', $this->text_domain); ?></label></th>
					<td>
						<textarea rows="5" class="large-text" id="test-replacment-keywords" name="<?php print $this->settings_name; ?>[test]" placeholder="<?php _e('Please enter the text to test.', $this->text_domain); ?>"><?php print $this->options->qc_pseudo_original_test; ?></textarea>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="results-replacment-keywords"><?php _e('Results', $this->text_domain); ?></label></th>
					<td>
						<textarea rows="5" class="large-text" id="results-replacment-keywords" disabled><?php print $this->options->qc_pseudo_original_results; ?></textarea>
						<p><em class="qc-icon info"><?php _e('Note that the first save form cannot test pseudo-original because the parameters have not been saved to the database.', $this->text_domain); ?></em></p>
					</td>
				</tr>
			</tbody>
		</table>
		<?php submit_button(); ?>
	</div>
	<h3><?php _e('Custom keywords', $this->text_domain); ?></h3>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="replacment-keywords"><?php _e('Keywords', $this->text_domain); ?></label></th>
				<td>
					<textarea rows="20" class="large-text" id="replacment-keywords" name="<?php print $this->settings_name; ?>[keywords]" placeholder="<?php _e('Keywords', $this->text_domain); ?>"><?php print $this->options->qc_pseudo_original_keywords; ?></textarea>
					<p class="description"><?php _e("In addition to the automatic mode, you can also define your own vocabulary.<br />The format is separated by a '|' between the replaced word and the replacement word, one group per line.<br />It should be noted that the replacement word should not appear as a replaced word below itself.", $this->text_domain); ?></p>
					<p class="description"><?php _e('For examples:', $this->text_domain); ?></p>
					<pre class="prism"><code class="language-php"><?php _ex('Worship', 'word', $this->text_domain); ?>|<?php _ex('Cultus', 'word', $this->text_domain); ?>

<?php _ex('Holy', 'word', $this->text_domain); ?>|<?php _ex('Saint', 'word', $this->text_domain); ?>

<?php _ex('Royal', 'word', $this->text_domain); ?>|<?php _ex('Imperial', 'word', $this->text_domain); ?></code></pre>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<!-- Replacment Keywords - end -->