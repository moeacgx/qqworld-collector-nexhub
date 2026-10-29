<!-- Debug - start -->
<div class="nav-section">
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="debug"><?php _e('Debug', $this->text_domain); ?></label></th>
			<td>
				<?php
 $this->the_switcher(array( 'id' => 'enabled_debug', 'name' => $this->settings_name . '[debug][enabled]', 'value' => $this->options->qc_debug_enabled )); $log_path = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $blog_id . DIRECTORY_SEPARATOR . 'qqworld-collector' . DIRECTORY_SEPARATOR; $log_url = WP_CONTENT_URL . '/logs/' . $blog_id . '/qqworld-collector/'; ?>
				<p class="description"><?php _e('The debug logs for each module are saved in the following file.', $this->text_domain); ?></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"></th>
			<td>
				<table class="wp-list-table fixed striped">
				<?php
 $logs = array( 'core.log' => __('Core', $this->text_domain), 'auto-save-attachment.log' => __('Auto Save Attachment', $this->text_domain), 'collection-project.log' => __('Collection Project', $this->text_domain), 'collecting.log' => __('Collecting Logs', $this->text_domain), 'cloud-storage.log' => __('Cloud Storage', $this->text_domain), 'translate.log' => __('Translate', $this->text_domain), 'automatic-anchor.log' => __('Automatic Anchor', $this->text_domain), 'pseudo-original.log' => __('Pseudo Original', $this->text_domain), 'artificial-intelligence.log' => __('Artificial Intelligence', $this->text_domain), 'static-cache.log' => __('Static Cache', $this->text_domain), 'seo.log' => __('Search Engine', $this->text_domain), ); foreach ($logs as $filename => $label) : ?>
					<tr>
						<td></td>
						<td><strong><?php print $label; ?></strong></td>
						<td>
						<?php if ( file_exists($log_path.$filename) ) : ?>
							<a href="<?php print $log_url . $filename; ?>" target="_blank" class="button button-primary qc-icon download"><?php _e('Download', $this->text_domain); ?></a>
							<button type="button" class="button qc-icon delete delete-log" data-path="<?php print $log_path . $filename; ?>"><?php _e('Delete'); ?></button>
						<?php else: _e('No logs.', $this->text_domain); endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</table>
			</td>
		</tr>
		<!--<tr valign="top">
			<th scope="row"><label for="safe-mode-enabled"><?php _e('Safe Mode', $this->text_domain); ?></label></th>
			<td>
				<?php
 ?>
				<p class="description"><?php _e('Used for debug.', $this->text_domain); ?></p>
			</td>
		</tr>-->
	</table>
</div>
<!-- Debug - end -->