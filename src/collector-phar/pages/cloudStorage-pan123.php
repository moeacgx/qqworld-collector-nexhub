
<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-CLIENT-ID"><?php _ex('Client ID', '123pan', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[client-id]" class="regular-text" id="<?php print $this->guid; ?>-client-id" value="<?php echo $this->client_id; ?>" />
					<p><?php _e('Only VIP users can obtain direct links.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-client-secret"><?php _ex('Client Secret', '123pan', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[client-secret]" class="regular-text" id="<?php print $this->guid; ?>-client-secret" value="<?php echo $this->client_secret; ?>" />
					<?php if ($this->enabled && $this->is_current) : ?>
						<?php if ($this->accessed) : ?>
						<div class="cloud-storage-status"><span class="successed status"><?php _e('Accessed Successfully', $this->text_domain); ?></span></div>
						<?php else : ?>
						<div class="cloud-storage-status"><span class="failed status"><?php _e('Accessed Failed', $this->text_domain); ?></span></div>
						<?php endif; ?>
					<?php endif; ?>
				</td>
			</tr>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-'. $this->guid ); ?>
		<tbody>
	</table>
</section>