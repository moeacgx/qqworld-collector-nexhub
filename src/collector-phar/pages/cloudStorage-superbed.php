<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-before.php'; ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-token"><?php _ex('Token', 'tietuku', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[token]" class="large-text" placeholder="<?php _ex('Token', 'tietuku', $this->text_domain); ?>" id="<?php print $this->guid; ?>-token" value="<?php echo $this->token; ?>" />
					<p><?php printf(_x('Get token from <a href="%s" target="_blank">here</a>.', 'superbed', $this->text_domain), 'https://superbed.cn/doc'); ?></p>
				</td>
			</tr>
			<!--
			<tr valign="top">
				<th scope="row"><?php _e('Endpoint', $this->text_domain); ?></th>
				<td>
					<?php
 ?>
						<p><label><input type="checkbox" name="<?php ?>[endpoints][]" value="<?php ?>" <?php ?> /> <?php ?></label></p>
					<?php ?>
					<p class="description"><?php ?></p>
				</td>
			</tr>
			-->
			<!--<tr valign="top" class="hidden">
				<th scope="row"><?php _e('Save'); ?></th>
				<td>
					<?php
 $saves = array( 'weibo' => __('Sina Images Storage', $this->text_domain), 'sohu' => __('Sohu Images Storage', $this->text_domain), 'sogou' => __('Sogou Images Storage', $this->text_domain), 'qiniu' => __('Qiniu Cloud Storage', $this->text_domain), 'qcloud' => __('Tencent Cloud Object Service (COS)', $this->text_domain), 'upyun' => __('UpYun Storage Service', $this->text_domain), 'aliyun' => __('Aliyun Open Storage Service (OSS)', $this->text_domain), 'aws' => __('Amazon Web Services S3 Cloud Storage (AWS S3)', $this->text_domain), 'cloudinary' => __('Cloudinary', $this->text_domain), 'backblaze' => __('Backblaze', $this->text_domain), 'ufile' => __('UCloud File Storage Service (UFile)', $this->text_domain) ); foreach ($saves as $save => $label) : ?>
						<p><label><input type="radio" name="<?php print $this->field_name; ?>[endpoint]" value="<?php ?>" <?php ?> /> <?php print $label; ?></label></p>
					<?php endforeach; ?>
					<p class="description"><?php _e('You can upload multiple cloud storage at the same time, but you can only use one of them.', $this->text_domain); ?></p>
					<p class="description"><em class="qc-icon info"><?php printf(__("Don't forget to add the domain name keyword of the selected image storage to the <a href=\"%s\" target=\"_blank\">Excluded Domain / Keywords</a> of the auto-save attachment, otherwise it will be repeatedly crawled.", $this->text_domain), admin_url('admin.php?page=qqworld-collector-auto-save-attachment#filter')); ?></em></p>
				</td>
			</tr>-->
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-common.php'; ?>
		<tbody>
	</table>
</section>