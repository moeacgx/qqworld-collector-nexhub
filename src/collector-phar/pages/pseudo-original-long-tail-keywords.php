<!-- Long Tail Keywords - start -->
<div class="nav-section">
	<table class="form-table long-tail-keywords">
		<tbody>
			<tr valign="top" class="hidden">
				<th scope="row"><label for="enable-long-tail-keywords"><?php _e('Enable', $this->text_domain); ?></label></th>
				<td><?php
 $this->the_switcher(array( 'id' => 'enable-rewrite-title', 'name' => $this->settings_name . '[long-tail-keywords][enabled]', 'value' => $this->options->qc_pseudo_original_long_tail_keywords_enabled )); ?><p class="description"><?php _e('Show the long tail keywords panel to the post edit page.', $this->text_domain); ?></p></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="long-tail-keywords-api"><?php _ex('API', 'pseudo original', $this->text_domain); ?></label></th>
				<td>
					<select id="long-tail-keywords-api" name="<?php print $this->settings_name; ?>[long-tail-keywords][api]" class="selectstyle">
						<optgroup label="<?php _ex('Commercial', 'version', $this->text_domain); ?>">
							<option value="5118" <?php selected('5118', $this->options->qc_pseudo_original_long_tail_keywords_api); ?>><?php _e('5118 Big Data - Long Tail Keyword Mining API (wyc.5118.com)', $this->text_domain); ?></option>
						</optgroup>
						<optgroup label="<?php _e('Free', $this->text_domain); ?>">
							<option value="toutiao" <?php selected('toutiao', $this->options->qc_pseudo_original_long_tail_keywords_api); ?>><?php _e('Toutiao', $this->text_domain); _e(' (Recommened)', $this->text_domain); ?></option>
						</optgroup>
					</select>
					<p class="desciption"><?php _e('Please select the API of the Long Tail Keywords.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="5118 section-tab<?php if ($this->options->qc_pseudo_original_long_tail_keywords_api != '5118') print ' hidden'; ?>">
				<th scope="row"><label for="long-tail-keywords-5118-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
				<td>
					<input type="password" class="regular-text" id="long-tail-keywords-5118-apikey" name="<?php print $this->settings_name; ?>[long-tail-keywords][5118][apikey]" value="<?php print $this->options->qc_pseudo_original_long_tail_keywords_5118_apikey; ?>" />
					<p class="desciption"><?php _e('Only short words can be used to obtain long tail keywords, which is not recommended.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="toutiao section-tab<?php if ($this->options->qc_pseudo_original_long_tail_keywords_api != 'toutiao') print ' hidden'; ?>">
				<th scope="row"><label for="long-tail-keywords-toutiao-cookies"><?php _e('Cookies', $this->text_domain); ?></label></th>
				<td>
					<textarea class="large-text" id="long-tail-keywords-toutiao-cookies" name="<?php print $this->settings_name; ?>[long-tail-keywords][toutiao][cookies]" placeholder="Cookie: UM_distinctid=16e5b28df47217-0833dff79c853a-7711a3e-1fa400-16e5b28df4838d..." rows="3"><?php print $this->options->qc_pseudo_original_long_tail_keywords_toutiao_cookies; ?></textarea>
					<p class="desciption"><?php _e('Please apply for the right to contribute to Toutiao, and obtain Cookies from the submission editing page and fill in here.', $this->text_domain); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<!-- Long Tail Keywords - end -->