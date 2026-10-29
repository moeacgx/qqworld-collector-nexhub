<?php if ($this->options->cloud_storage_statistics) : ?><tr valign="top">
	<th scope="row"><label for="<?php print $this->guid; ?>-statistics"><?php _e('Statistics', $this->text_domain); ?></label></th>
	<td><?php
 $count_all = $this->get_all_attachment_count(); $count = $this->get_synced_attachment_count(); printf(__('A total of <strong>%d</strong> attachments, <strong>%d</strong> have been synchronized, <strong>%d</strong> have not been synchronized.', $this->text_domain), $count_all, $count, $count_all-$count); ?></td>
</tr><?php endif; ?>