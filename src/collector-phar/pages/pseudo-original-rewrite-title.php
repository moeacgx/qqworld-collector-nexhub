<!-- Rewrite Title - start -->
<div class="nav-section">
	<table class="form-table rewrite-title">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enable-rewrite-title"><?php _e('Enable', $this->text_domain); ?></label></th>
				<td><?php
 $this->the_switcher(array( 'id' => 'enable-rewrite-title', 'name' => $this->settings_name . '[rewrite-title][enabled]', 'value' => $this->options->qc_pseudo_original_rewrite_title_enabled )); ?><p class="description"><?php _e('Rewriting the title when publishing an post.', $this->text_domain); ?></p></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="rewrite-title-api"><?php _ex('API', 'pseudo original', $this->text_domain); ?></label></th>
				<td>
					<select id="rewrite-title-api" name="<?php print $this->settings_name; ?>[rewrite-title][api]" class="selectstyle">
						<optgroup label="<?php _ex('Commercial', 'version', $this->text_domain); ?>">
							<option value="5118" <?php selected('5118', $this->options->qc_pseudo_original_rewrite_title_api); ?>><?php _e('5118 Big Data - Smart Title Generation API (wyc.5118.com)', $this->text_domain); ?></option>
						</optgroup>
					</select>
					<p class="desciption"><?php _e('Please select the pseudo-original API of the automatic mode.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top" class="5118 section-tab<?php if ($this->options->qc_pseudo_original_rewrite_title_api != '5118') print ' hidden'; ?>">
				<th scope="row"><label for="rewrite-title-5118-apikey"><?php _e('API Key', $this->text_domain); ?></label></th>
				<td>
					<input type="password" class="regular-text" id="rewrite-title-5118-apikey" name="<?php print $this->settings_name; ?>[rewrite-title][5118][apikey]" value="<?php print $this->options->qc_pseudo_original_rewrite_title_5118_apikey; ?>" />
				</td>
			</tr>
		</tbody>
	</table>
</div>
<!-- Rewrite Title - end -->