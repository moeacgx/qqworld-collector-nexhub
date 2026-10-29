<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><?php _e('Missing SDK', $this->text_domain); ?></th>
				<td>
					<a href="<?php print admin_url('admin.php?page=qqworld-collector#sdk'); ?>" target="_blank" class="button qc-icon download"><?php _e('Install SDK', $this->text_domain); ?></a>
					<p class="description qc-icon info"><?php _e('Please install <strong>Software Development Kit (SDK)</strong> and return here to refresh the page for the next setting.', $this->text_domain); ?></p>
				</td>
			</tr>
		<tbody>
	</table>
</section>