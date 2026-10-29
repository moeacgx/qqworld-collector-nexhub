<!-- Remote Website - start -->
<div class="nav-section">
	<h2><?php _e('Auto Login', $this->text_domain); ?></h2>
	<p><?php _e('Some websites need to change cookies frequently. It is more convenient to use the automatic login function to change cookies automatically.', $this->text_domain); ?><br /><em class="qc-icon info"><?php _e('If some websites need to fill in a verification code to log in, please give up.', $this->text_domain); ?></em></p>
	<div id="auto-login-container">
		<?php
 if (!empty($this->options->qc_auto_login_website)) { $folded = count($this->options->qc_auto_login_website) > 1 ? ' folded' : ''; $hidden = count($this->options->qc_auto_login_website) > 1 ? ' hidden' : ''; foreach ($this->options->qc_auto_login_website as $guid => $website) { extract($website); $title = isset($title) ? $title : __('Unnamed', $this->text_domain); ?><section class="item-wrapper" data-id="<?php print $guid; ?>">
			<header class="item-titlebar">
				<button type="button" class="tool fold<?php print $folded; ?>" title="<?php _e('Fold', $this->text_domain); ?>"></button>
				<label><?php print $title; ?></label>
				<div class="tools">
					<button type="button" class="tool clone" title="<?php _e('Clone', $this->text_domain); ?>"></button>
					<button type="button" class="tool delete" title="<?php _e('Delete'); ?>"></button>
				</div>
			</header>
			<div class="item-body<?php print $hidden; ?>">
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="title-<?php print $guid; ?>"><?php _e('Title'); ?></label></th>
							<td>
								<input type="text" id="title-<?php print $guid; ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[auto-login-website][<?php print $guid; ?>][title]" class="regular-text auto-login-title" placeholder="<?php _e('Title'); ?>" value="<?php print $title; ?>" />
								<p class="description"><?php _e('Used to quickly identify website to log in automatically in collecting settings of collection project.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="request-url-<?php print $guid; ?>"><?php _e('Request URL', $this->text_domain); ?></label></th>
							<td>
								<input type="text" id="request-url-<?php print $guid; ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[auto-login-website][<?php print $guid; ?>][url]" class="large-text" placeholder="<?php _e('Request URL', $this->text_domain); ?>" value="<?php print $url; ?>" />
								<p class="description"><?php _e('Please enter the action url of the login form.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="request-headers-<?php print $guid; ?>"><?php _e('Request Headers', $this->text_domain); ?></label></th>
							<td>
								<textarea id="request-headers-<?php print $guid; ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[auto-login-website][<?php print $guid; ?>][headers]" class="large-text" rows="3" placeholder="<?php _e('Request Headers', $this->text_domain); ?>"><?php print $headers; ?></textarea>
								<p class="description"><?php printf(__('How to get <a href="%s" target="_blank">request headers</a>?', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#tips--collector--get-request-headers')); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="expires-<?php print $guid; ?>"><?php _e('Expires', $this->text_domain); ?></label></th>
							<td>
								<input type="number" id="expires-<?php print $guid; ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[auto-login-website][<?php print $guid; ?>][expires]" class="small-text" value="<?php print $expires; ?>" /> <?php _e('Seconds', $this->text_domain); ?>
								<p class="description"><?php _e('The cache time of the cookies that are automatically acquired. If they expire, log in again and obtain cookies again.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="form-fields-<?php print $guid; ?>"><?php _e('Form Fields', $this->text_domain); ?></label></th>
							<td>
								<p>
									<label><input type="radio" class="data-type" id="form-data-type-<?php print $guid; ?>-form-data" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[auto-login-website][<?php print $guid; ?>][data_type]" value="form-data" <?php checked('form-data', $data_type); ?> /> <?php _e('Form Data', $this->text_domain); ?></label>
									<label><input type="radio" class="data-type" id="form-data-type-<?php print $guid; ?>-raw-data" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[auto-login-website][<?php print $guid; ?>][data_type]" value="raw" <?php checked('raw', $data_type); ?> /> <?php _e('Raw Data', $this->text_domain); ?></label>
								</p><br />
								<div class="data-type-fields form-data<?php if ($data_type != 'form-data') print ' hidden'; ?>">
									<table class="wp-list-table widefat striped posts>
										<tbody>
										<?php
 if (isset($fields) && !empty($fields)) foreach ($fields as $fid => $field) { extract($field); ?>
											<tr valign="top">
												<td>
													<input type="text" class="large-text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[auto-login-website][<?php print $guid; ?>][fields][<?php print $fid; ?>][title]" placeholder="<?php _e('Title'); ?>" value="<?php print $title; ?>" />
												</td>
												<td>
													<input type="text" class="large-text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[auto-login-website][<?php print $guid; ?>][fields][<?php print $fid; ?>][name]" placeholder="<?php _e('Field Name', $this->text_domain); ?>" value="<?php print $name; ?>" />
												</td>
												<td>
													<input type="text" class="large-text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[auto-login-website][<?php print $guid; ?>][fields][<?php print $fid; ?>][value]" placeholder="<?php _e('Field Value', $this->text_domain); ?>" value="<?php print $value; ?>" />
												</td>
												<td>
													<button type="button" class="button delete-field button qc-icon trash"><?php _e('Delete'); ?></button>
												</td>
											</tr>
										<?php } ?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="4">
													<button type="button" class="button add-field button qc-icon add" data-guid="<?php print $guid; ?>"><?php _e('Add Form Field', $this->text_domain); ?></button>
													<button type="button" class="button login-test button qc-icon login"><?php _e('Login Test', $this->text_domain); ?></button>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>
								<div class="data-type-fields raw<?php if ($data_type != 'raw') print ' hidden'; ?>">
									<table class="wp-list-table widefat striped posts">
										<tbody>
											<tr valign="top">
												<td>
													<textarea class="large-text" rows="5" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[auto-login-website][<?php print $guid; ?>][raw_data]"><?php print $raw_data; ?></textarea>
												</td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="4">
													<button type="button" class="button login-test button qc-icon login"><?php _e('Login Test', $this->text_domain); ?></button>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
		<?php } } ?>
	</div>
	<p><button id="add-auto-login-website" type="button" class="button button-large qc-icon add"><?php _e('Add a Website', $this->text_domain); ?></button></p>
</div>
<!-- Remote Website - end -->