<!-- SEO Cheater start -->
<div class="nav-section">
	<h2><?php _e('SEO Cheater', $this->text_domain); ?></h2>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enable-seo-cheater"><?php _e('Enable', $this->text_domain); ?></label></th>
				<td><?php
 $this->the_switcher(array( 'id' => 'enable-seo-cheater', 'name' => $this->settings_name . '[seo-cheater][enabled]', 'value' => $this->options->qc_pseudo_original_seo_cheater_enabled )); ?><p class="description"><?php _e('Randomly insert hidden characters in the post content to cheat the search engine into a pseudo-original effect.', $this->text_domain); ?></p></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="seo-cheater-offset"><?php _e('Offset', $this->text_domain); ?></label></th>
				<td>
					<input type="number" class="small-text" id="seo-cheater-offset" name="<?php print $this->settings_name; ?>[seo-cheater][offset]" value="<?php print $this->options->qc_pseudo_original_seo_cheater_offset; ?>" />
					<p class="description"><?php printf(__('The first %d characters of the post content do not add the SEO cheat code.', $this->text_domain), $this->options->qc_pseudo_original_seo_cheater_offset); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="seo-cheater-structure"><?php _e('Class Structure', $this->text_domain); ?></label></th>
				<td>
					<input type="text" class="regular-text" id="seo-cheater-structure" name="<?php print $this->settings_name; ?>[seo-cheater][structure]" value="<?php print $this->options->qc_pseudo_original_seo_cheater_structure; ?>" />
					<p class="description"><?php _e('The name of the tag class used to hide the content. The asterisk will be automatically replaced by a random number.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="seo-cheater-quantity"><?php _e('Quantity', $this->text_domain); ?></label></th>
				<td>
					<select id="seo-cheater-quantity" name="<?php print $this->settings_name; ?>[seo-cheater][quantity]" class="selectstyle">
						<option value="1" <?php selected(1, $this->options->qc_pseudo_original_seo_cheater_quantity); ?>><?php _ex('Very Few', 'number', $this->text_domain); ?></option>
						<option value="2" <?php selected(2, $this->options->qc_pseudo_original_seo_cheater_quantity); ?>><?php _ex('Few', 'number', $this->text_domain); ?></option>
						<option value="3" <?php selected(3, $this->options->qc_pseudo_original_seo_cheater_quantity); ?>><?php _ex('General', 'number', $this->text_domain); ?></option>
						<option value="4" <?php selected(4, $this->options->qc_pseudo_original_seo_cheater_quantity); ?>><?php _ex('Many', 'number', $this->text_domain); ?></option>
						<option value="5" <?php selected(5, $this->options->qc_pseudo_original_seo_cheater_quantity); ?>><?php _ex('Much', 'number', $this->text_domain); ?></option>
					</select>
					<p class="description"><?php _e('Randomly insert the number of SEO cheat codes in the content. If too many may be punished by the search engine, too little may not work well, please adjust it moderately.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="enable-impurities"><?php _e('Impurities', $this->text_domain); ?></label></th>
				<td>
					<select id="enable-impurities" name="<?php print $this->settings_name; ?>[seo-cheater][impurities]" class="selectstyle">
						<option value="0" <?php selected(0, $this->options->qc_pseudo_original_seo_cheater_impurities); ?>><?php _e('Random Garbled', $this->text_domain); ?></option>
						<option value="1" <?php selected(1, $this->options->qc_pseudo_original_seo_cheater_impurities); ?>><?php _e('Random Custom strings', $this->text_domain); ?></option>
						<option value="2" <?php selected(2, $this->options->qc_pseudo_original_seo_cheater_impurities); ?>><?php _e('Random Suggestion Keywords', $this->text_domain); ?></option>
					</select>
					<p class="description"><?php _e('Inserting random characters into the cheat code tag as an impurity further interferes with the judgment of the search engine.', $this->text_domain); ?></p>
					<dl>
						<dt><strong><?php _e('Random Garbled', $this->text_domain); ?></strong></dt>
						<dd><?php _e('Meaningless garbled, although very convenient, but not very friendly to search engines.', $this->text_domain); ?></dd>
						<dt><strong><?php _e('Random Custom strings', $this->text_domain); ?></strong></dt>
						<dd><?php _e('Customized strings can present keywords that match the website to search engines.', $this->text_domain); ?></dd>
						<dt><strong><?php _e('Random Suggestion Keywords', $this->text_domain); ?></strong></dt>
						<dd class="qc-icon info"><?php _e('The recommended keywords are automatically generated according to the tags of the article, which is more intelligent and recommended.', $this->text_domain); ?></dd>
					</dl>
				</td>
			</tr>
			<tr valign="top" class="random-strings-block<?php if ($this->options->qc_pseudo_original_seo_cheater_impurities != 1) print ' hidden'; ?>">
				<th scope="row"><label for="random-strings"><?php _e('Random Strings', $this->text_domain); ?></label></th>
				<td>
					<textarea id="random-strings" name="<?php print $this->settings_name; ?>[seo-cheater][random-strings]" class="regular-text" rows="5"><?php print $this->options->qc_pseudo_original_seo_cheater_random_strings; ?></textarea>
					<p class="description"><?php _e('Customize some random strings, one per line, and leave it blank to automatically generate garbled characters.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="suggestion-keywords-block<?php if ($this->options->qc_pseudo_original_seo_cheater_impurities != 2) print ' hidden'; ?>">
				<th scope="row"><label for="suggestion-keywords"><?php _e('Suggestion Keywords API', $this->text_domain); ?></label></th>
				<td>
					<select id="suggestion-keywords" class="selectstyle" name="<?php print $this->settings_name; ?>[seo-cheater][suggestion-keywords-api]">
						<option value="baidu" <?php selected('baidu', $this->options->qc_pseudo_original_seo_cheater_suggestion_keywords_api); ?>><?php _e('Baidu', $this->text_domain); ?></option>
						<option value="sogou" <?php selected('sogou', $this->options->qc_pseudo_original_seo_cheater_suggestion_keywords_api); ?> disabled><?php _e('SoGou', $this->text_domain); ?></option>
						<option value="360" <?php selected('360', $this->options->qc_pseudo_original_seo_cheater_suggestion_keywords_api); ?>><?php _e('360', $this->text_domain); ?></option>
						<option value="taobao" <?php selected('taobao', $this->options->qc_pseudo_original_seo_cheater_suggestion_keywords_api); ?>><?php _e('TaoBao', $this->text_domain); ?></option>
						<option value="bing" <?php selected('bing', $this->options->qc_pseudo_original_seo_cheater_suggestion_keywords_api); ?>><?php _e('Bing', $this->text_domain); ?></option>
						<option value="etao" <?php selected('etao', $this->options->qc_pseudo_original_seo_cheater_suggestion_keywords_api); ?>><?php _e('eTao', $this->text_domain); ?></option>
					</select>
					<p class="description"><?php _e('The system will obtain recommended keywords through the selected API and post tags.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="seo-cheater-scan-post-types"><?php _e('Post Types', $this->text_domain); ?></label></th>
				<td>
					<?php
 $args = array( 'public' => 1, 'show_ui' => 1 ); $post_types = get_post_types($args, 'objects'); ?>
					<ul id="post_types_list_for_delete">
					<?php foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment')) ) : ?>
						<li><label><input name="<?php print $this->settings_name; ?>[seo-cheater][post-types][]" type="checkbox" value="<?php echo $name; ?>" <?php checked(1, in_array($name, $this->options->qc_pseudo_original_seo_cheater_post_types)); ?> /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
					<?php endif; endforeach; ?></ul>
					<p class="description"><?php _e('Please select the post types you want to scan.', $this->text_domain) ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="post-meta"><?php _e('Post Meta', $this->text_domain); ?></label></th>
				<td>
					<textarea id="post-meta" name="<?php print $this->settings_name; ?>[seo-cheater][post-meta]" cols="50" rows="3" ><?php print $this->options->qc_pseudo_original_seo_cheater_post_meta; ?></textarea>
					<p class="description"><?php _e('Please fill in the name of the post meta where you want to insert the SEO cheat code, one per line.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="seo-cheater-mark"><?php _ex('Mark', 'seo cheater', $this->text_domain); ?></label></th>
				<td>
					<input type="text" id="seo-cheater-mark" name="<?php print $this->settings_name; ?>[seo-cheater][mark]" value="<?php print $this->options->qc_pseudo_original_seo_cheater_mark; ?>" />
					<p class="description"><?php _e('Used to hide and wpie the seo cheat code. If you want to modify it, please wipe the seo cheat code containing the old mark.', $this->text_domain); ?></p>
					<p class="description qc-icon info"><?php _e('If the front end cannot automatically hide the SEO cheat codes, save the following styles to the bottom of the theme\'s <em>style.css</em>.', $this->text_domain); ?></p>
					<div class="description"><pre class="prism"><code class="language-css">[data-mark="<?php print $this->options->qc_pseudo_original_seo_cheater_mark; ?>"] { display: none; }</code></pre></div>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="seo-cheater-scan"><?php _e('Scan', $this->text_domain); ?></label></th>
				<td>
					<span id="quick-manage-seo-cheater">
						<button type="button" data-mode="add" class="scan-seo-cheat-all button button-primary qc-icon refresh"<?php if (!$this->options->qc_pseudo_original_seo_cheater_enabled) print ' disabled'; ?>><?php _e('Add SEO Cheat Code', $this->text_domain); ?></button>
						<button type="button" data-mode="wipe" class="scan-seo-cheat-all button qc-icon delete"<?php if (!$this->options->qc_pseudo_original_seo_cheater_enabled) print ' disabled'; ?>><?php _e('Wipe SEO Cheat Code', $this->text_domain); ?></button>
					</span>
					<p class="description">
						<?php _e('<strong>Add SEO Cheat Code</strong>: Scan all posts and automatically add SEO cheat codes.', $this->text_domain); ?><br />
						<?php _e('<strong>Wipe SEO Cheat Code</strong>: Scan all posts and automatically wipe SEO cheat codes.', $this->text_domain); ?>
					</p>
					<br />
					<?php
 $this->the_switcher(array( 'id' => 'seo-cheater-baidu-included', 'name' => $this->settings_name . '[seo-cheater][baidu-included]', 'value' => $this->options->qc_pseudo_original_seo_cheater_baidu_included )); ?><p class="description"><label for="seo-cheater-baidu-included"><?php _e('Check whether it is included by Baidu, only add SEO Cheater code to posts that Baidu has not included, and only wipe SEO Cheater code from posts that have been included in Baidu.', $this->text_domain); ?></label></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('Theme Template Homogenization', $this->text_domain); ?></h2>
	<p><?php _e('Doing the SEO knows that the search engine has an algorithm to analyze judgment templates homogenization. Some topics have been used, and the search engine spiders are too lazy to include.', $this->text_domain); ?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enable-tpl-homogenization"><?php _e('Enable', $this->text_domain); ?></label></th>
				<td><?php
 $this->the_switcher(array( 'id' => 'enable-tpl-homogenization', 'name' => $this->settings_name . '[tpl-homogenization][enabled]', 'value' => $this->options->qc_pseudo_original_tpl_homogenization_enabled )); ?><p class="description"><?php _e('Dynamic modification for templates to achieve template heterogeneration.', $this->text_domain); ?></p></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tpl-homogenization-keywords"><?php _e('Keywords', $this->text_domain); ?></label></th>
				<td>
					<input type="text" class="regular-text" id="tpl-homogenization-keywords" name="<?php print $this->settings_name; ?>[tpl-homogenization][keywords]" value="<?php print $this->options->qc_pseudo_original_tpl_homogenization_keywords; ?>" />
					<p class="description"><?php _e('Please fill in the keyword and the plugin will automatically add it into the template.', $this->text_domain); ?></p>
					<p class="description qc-icon info"><?php _e('Note that don\'t fill in the style class name existing in the template.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<!-- SEO Cheater end -->