<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top" id="<?php print $this->guid; ?>-region-row">
				<th scope="row"><label for="<?php print $this->guid; ?>-region"><?php _e('Region', $this->text_domain); ?></label> <span class="icon help" data-header="<?php _e('Region', $this->text_domain); ?>" data-content="<?php _e("Please select the region of your bucket. (Featured of v4)", $this->text_domain); ?>"></span></th>
				<td>
					<select id="<?php print $this->guid; ?>-region" name="<?php print $this->field_name; ?>[region]" class="selectstyle">
						<option value="ap-beijing" <?php selected('ap-beijing', $this->region); ?>><?php _e('BeiJing (bj)', $this->text_domain); ?></option>
						<option value="ap-nanjing" <?php selected('ap-nanjing', $this->region); ?>><?php _e('NanJing', $this->text_domain); ?></option>
						<option value="ap-shanghai" <?php selected('ap-shanghai', $this->region); ?>><?php _e('East China - ShangHai (sh)', $this->text_domain); ?></option>
						<option value="ap-guangzhou" <?php selected('ap-guangzhou', $this->region); ?>><?php _e('South China - GuangZhou (gz)', $this->text_domain); ?></option>
						<option value="ap-chengdu" <?php selected('ap-chengdu', $this->region); ?>><?php _e('West South China - ChengDu (cd)', $this->text_domain); ?></option>
						<option value="ap-chongqing" <?php selected('ap-chongqing', $this->region); ?>><?php _e('ChongQing', $this->text_domain); ?></option>
						<option value="ap-shenzhen-fsi" <?php selected('ap-shenzhen-fsi', $this->region); ?>><?php _e('ShenZhen Financial', $this->text_domain); ?></option>
						<option value="ap-shanghai-fsi" <?php selected('ap-shanghai-fsi', $this->region); ?>><?php _e('ShangHai Financial', $this->text_domain); ?></option>
						<option value="ap-beijing-fsi" <?php selected('ap-beijing-fsi', $this->region); ?>><?php _e('BeiJing Financial', $this->text_domain); ?></option>
						<!-- 中国香港及海外地域 -->
						<option value="ap-hongkong" <?php selected('ap-hongkong', $this->region); ?>><?php _e('Hongkong (hk)', $this->text_domain); ?></option>
						<option value="ap-singapore" <?php selected('ap-singapore', $this->region); ?>><?php _e('Singapore (sgp)', $this->text_domain); ?></option>
						<option value="ap-mumbai" <?php selected('ap-mumbai', $this->region); ?>><?php _e('Mumbai', $this->text_domain); ?></option>
						<option value="ap-seoul" <?php selected('ap-seoul', $this->region); ?>><?php _e('Seoul', $this->text_domain); ?></option>
						<option value="ap-bangkok" <?php selected('ap-bangkok', $this->region); ?>><?php _e('Bangkok, Thailand', $this->text_domain); ?></option>
						<option value="ap-tokyo" <?php selected('ap-tokyo', $this->region); ?>><?php _e('Tokyo, Japan', $this->text_domain); ?></option>
						<option value="na-siliconvalley" <?php selected('na-siliconvalley', $this->region); ?>><?php _e('Silicon Valley', $this->text_domain); ?></option>
						<option value="na-ashburn" <?php selected('na-ashburn', $this->region); ?>><?php _e('Virginia (eastern United States)', $this->text_domain); ?></option>
						<option value="na-toronto" <?php selected('na-toronto', $this->region); ?>><?php _e('Toronto (ca)', $this->text_domain); ?></option>
						<option value="eu-frankfurt" <?php selected('eu-frankfurt', $this->region); ?>><?php _e('Frankfurt (ger)', $this->text_domain); ?></option>
						<option value="eu-moscow" <?php selected('eu-moscow', $this->region); ?>><?php _e('Moscow, Russia', $this->text_domain); ?></option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-secretID"><?php _e('secretID', $this->text_domain); ?></label></th>
				<td><input type="text" name="<?php print $this->field_name; ?>[secretID]" class="regular-text" id="<?php print $this->guid; ?>-secretID" value="<?php echo $this->secretID; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-secretKey"><?php _e('secretKey', $this->text_domain); ?></label></th>
				<td><input type="password" name="<?php print $this->field_name; ?>[secretKey]" class="regular-text" id="<?php print $this->guid; ?>-secretKey" value="<?php echo $this->secretKey; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-bucket"><?php _e('Bucket', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[bucket]" class="regular-text" id="<?php print $this->guid; ?>-bucket" value="<?php echo $this->bucket; ?>" />
					<?php if ($this->enabled && $this->is_current) : ?>
						<?php if ($this->accessed) : ?>
						<div class="cloud-storage-status"><span class="successed status"><?php _e('Accessed Successfully', $this->text_domain); ?></span></div>
						<?php else : ?>
						<div class="cloud-storage-status"><span class="failed status"><?php _e('Accessed Failed', $this->text_domain); ?></span></div>
						<?php endif; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-auto-replace"><?php _e('Cloud Thumbnail', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => $this->guid.'-cloud-thumbnail', 'name' => $this->field_name . '[cloud-thumbnail][enabled]', 'value' => $this->cloud_thumbnail_enabled )); ?>
					<p><input type="text" placeholder="<?php _e('Please use the following variables to stitch the link suffix of the cropped image.', $this->text_domain); ?>" class="large-text" name="<?php print $this->field_name; ?>[cloud-thumbnail][structure]" value="<?php print $this->cloud_thumbnail_structure; ?>" /></p>
					<p class="quick-symbol-block"><a class="symbol" href="#" title="<?php _e('Width'); ?>">(w)</a> <a class="symbol" href="#" title="<?php _e('Height'); ?>">(h)</a></p>
					<p class="description"><?php printf(__('Do not use thumbnails of the media library, use cloud thumbnails of %s.', $this->text_domain), $this->label); ?><br /><?php printf(__('It is not recommended to <strong>Disable the Thumbnail Size</strong> in <a href="%s" target="_blank">Settings</a>, also do not check the <a href="%s" target="_blank">Auto Save attachment</a> to <strong>Not Use the Media Library</strong>. because there is a compatibility issue.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-settings'), admin_url('admin.php?page=qqworld-collector-auto-save-attachment')); ?></p>
					<p class="description"><em class="qc-icon info"><?php printf(__('<strong>For example:</strong> %s', $this->text_domain), '?imageMogr2/thumbnail/(w)x(h)'); ?></em></p>
					<p class="description"><em class="qc-icon info"><?php _e('Note that thumbnails are not uploaded when the cloud thumbnail is turned on, and turning off this feature will result in the thumbnail not being displayed.', $this->text_domain); ?></em></p>
					<p class="description"><em class="qc-icon info"><?php _e('Not compatible with Join Mode!', $this->text_domain); ?></em></p>
				</td>
			</tr>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-'. $this->guid ); ?>
		<tbody>
	</table>
</section>