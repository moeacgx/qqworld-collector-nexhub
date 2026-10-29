
<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-before-'. $this->guid ); ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-endpoints"><?php _e('Endpoint', $this->text_domain); ?></label></th>
				<td>
					<?php
 $network = array( 'external' => __('External', $this->text_domain), 'internal' => __('Internal', $this->text_domain) ); $regions = array( 'cn-hangzhou' => __('East China 1 (HangZhou)', $this->text_domain), 'cn-shanghai' => __('East China 2 (ShangHai)', $this->text_domain), 'cn-nanjing' => __('East China 5 (NanJing - local region)', $this->text_domain), 'cn-fuzhou' => __('East China 6 (FuZhou - local region)', $this->text_domain), 'cn-qingdao' => __('North China 1 (QingDao)', $this->text_domain), 'cn-beijing' => __('North China 2 (BeiJing)', $this->text_domain), 'cn-zhangjiakou' => __('North China 3 (ZhangJiaKou)', $this->text_domain), 'cn-huhehaote' => __('North China 5 (HuHeHaoTe)', $this->text_domain), 'cn-wulanchabu' => __('North China 6 (WuLanChaBu)', $this->text_domain), 'cn-shenzhen' => __('South China 1 (ShenZhen)', $this->text_domain), 'cn-heyuan' => __('South China 2 (HeYuan)', $this->text_domain), 'cn-guangzhou' => __('South China 3 (GuangZhou)', $this->text_domain), 'cn-chengdu' => __('Southwest China 1 (ChengDu)', $this->text_domain), 'cn-hongkong' => __('China (Hongkong)', $this->text_domain), 'cn-wuhan-lr' => __('Mid-China (WuHan - local region)', $this->text_domain), 'us-west-1' => __('Western America 1 (Silicon Valley)', $this->text_domain), 'us-east-1' => __('Eastern United States 1 (Virginia)', $this->text_domain), 'ap-southeast-1' => __('Asia Pacific southeast 1 (Singapore)', $this->text_domain), 'ap-southeast-2' => __('Asia Pacific southeast 2 (Sydney, Australia)', $this->text_domain), 'ap-southeast-3' => __('Asia Pacific southeast 3 (Kuala Lumpur, Malaysia)', $this->text_domain), 'ap-southeast-5' => __('Asia Pacific southeast 5 (Jakarta, Indonesia)', $this->text_domain), 'ap-southeast-6' => __('Asia Pacific southeast 6 (Manila, Philippines)', $this->text_domain), 'ap-northeast-1' => __('Asia Pacific Northeast 1 (Tokyo, Japan)', $this->text_domain), 'ap-south-1' => __('Asia Pacific Southern 1 (Bombay, India)', $this->text_domain), 'eu-central-1' => __('Central Europe 1 (Frankfurt, Germany)', $this->text_domain), 'eu-west-1' => __('The United Kingdom (London, UK)', $this->text_domain), 'me-east-1' => __('Middle East East 1 (Dubai, UAE)', $this->text_domain), ); $vpc = array( 'vpc100-oss-cn-beijing.aliyuncs.com' => __('BeiJing', $this->text_domain), 'vpc100-oss-cn-shenzhen.aliyuncs.com' => __('ShenZhen', $this->text_domain), 'vpc100-oss-cn-hangzhou.aliyuncs.com' => __('HangZhou', $this->text_domain), 'vpc100-oss-cn-shanghai.aliyuncs.com' => __('ShangHai', $this->text_domain), ); ?>
					<select id="<?php print $this->guid; ?>-endpoints" class="selectstyle">
						<option value="">-=== <?php _e('Please select the endpoint', $this->text_domain); ?> ===-</option>
						<option value="oss-accelerate.aliyuncs.com"><?php _e('Transfer Accelerated Domain', $this->text_domain); ?></option>
						<optgroup label="<?php _e('ECS VPC Internal', $this->text_domain); ?>">
						<?php foreach ($vpc as $endpoint => $label) : ?>
							<option value="<?php print $endpoint; ?>" <?php selected($endpoint, $this->endpoint); ?>><?php print $label; ?></option>
						<?php endforeach; ?>
						</optgroup>
					<?php foreach ($network as $net => $label) : ?>
						<optgroup label="<?php print $label; ?>">
						<?php foreach ($regions as $key => $label) : $endpoint = $net == 'internal' ? 'oss-' . $key . '-internal.aliyuncs.com' : 'oss-' . $key . '.aliyuncs.com'; ?>
							<option value="<?php print $endpoint; ?>"<?php selected($endpoint, $this->endpoint); ?>><?php print $label; ?></option>
						<?php endforeach; ?>
						</optgroup>
					<?php endforeach; ?>
					</select> <input type="text" name="<?php print $this->field_name; ?>[endpoint]" class="regular-text" value="<?php print $this->endpoint; ?>" readonly />
					<p class="description"><?php _e("Default HangZhou endpoint, Click <a href='http://help.aliyun.com/view/11108271_13438690.html' target='_balnk'>here</a> to know more.", $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-access-key-id"><?php _e('Access Key ID', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[access-key-id]" class="regular-text" id="<?php print $this->guid; ?>-access-key-id" value="<?php echo $this->access_key_id; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-access-key-secret"><?php _e('Access Key Secret', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[access-key-secret]" class="regular-text" id="<?php print $this->guid; ?>-access-key-secret" value="<?php echo $this->access_key_secret; ?>" />
				</td>
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
					<p class="description"><em class="qc-icon info"><?php printf(__('<strong>For example:</strong> %s', $this->text_domain), '?x-oss-process=image/resize,m_fill,h_(h),w_(w)'); ?></em></p>
					<p class="description"><em class="qc-icon info"><?php _e('Note that thumbnails are not uploaded when the cloud thumbnail is turned on, and turning off this feature will result in the thumbnail not being displayed.', $this->text_domain); ?></em></p>
					<p class="description"><em class="qc-icon info"><?php _e('Not compatible with Join Mode!', $this->text_domain); ?></em></p>
				</td>
			</tr>
			<?php do_action( 'qqworld-collector-cloud-storage-form-fields-'. $this->guid ); ?>
		<tbody>
	</table>
</section>