<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-before.php'; ?>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-host"><?php _e('Homepage', $this->text_domain); ?></label></th>
				<td>
					<input type="text" name="<?php print $this->field_name; ?>[host]" class="regular-text" placeholder="<?php _e('Homepage', $this->text_domain); ?>" id="<?php print $this->guid; ?>-host" value="<?php print $this->host; ?>" />
					<p><?php _e('Please enter the Hidove Pro image storage homepage url.', $this->text_domain); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-token"><?php _e('Token', $this->text_domain); ?></label></th>
				<td>
					<input type="password" name="<?php print $this->field_name; ?>[token]" class="regular-text" placeholder="<?php _e('Token', $this->text_domain); ?>" id="<?php print $this->guid; ?>-token" value="<?php print $this->token; ?>" />
					<p><?php printf(__('Please get Token from the <a href="%s" target="_blank">user center</a> page of image storage website.', $this->text_domain), $this->host . '/user'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-apitype"><?php _e('API Type', $this->text_domain); ?></label></th>
				<td>
					<?php
 $apiTypes = array( 'ali' => __('Alibaba CDN', $this->text_domain), 'toutiao' => __('Toutiao CDN', $this->text_domain), 'huluxia' => __('Huluxia Image Storage', $this->text_domain), 'sina' => __('Sina Images Storage', $this->text_domain), 'bilibili' => __('Bilibili CDN', $this->text_domain), 'bjbcebos' => __('Baidu BaiJia CDN', $this->text_domain), 'postimages' => __('Postimages', $this->text_domain), 'neteasy' => __('Netease YanXuan CDN', $this->text_domain), 'niupic' => __('Niupic Image Storage', $this->text_domain), 'smms' => __('SM.MS', $this->text_domain), 'sougou' => __('Sougo CDN', $this->text_domain), 'xiaomi' => __('Xiaomi YouPin CDN', $this->text_domain), 'catbox' => __('Catbox', $this->text_domain), 'qihoo' => __('Qihoo CDN', $this->text_domain), 'suning' => __('Suning CDN', $this->text_domain), 'juejin' => __('JueJin CDN', $this->text_domain), 'vimcn' => __('Vim-cn Image Storage', $this->text_domain), 'qpic' => __('Qpic', $this->text_domain), 'qdoc' => __('Qdoc', $this->text_domain), 'qcoral' => __('Qcoral', $this->text_domain), 'imgbb' => __('ImgBB Image Storage', $this->text_domain), 'github' => __('Github', $this->text_domain), 'netease' => __('Netease', $this->text_domain), 'chaoxing' => __('Chaoxing', $this->text_domain), 'ai58' => __('Ai58', $this->text_domain), 'imgbox' => __('Imgbox', $this->text_domain), 'imageshack' => __('Imageshack', $this->text_domain), 'imgur' => __('Imgur', $this->text_domain), 'gtimg' => __('Gtimg', $this->text_domain), 'vxichina' => __('Vxichina', $this->text_domain), 'renren' => __('RenRen Image Storage', $this->text_domain), 'taihe' => __('Taihe', $this->text_domain), 'bkimg' => __('Bkimg', $this->text_domain), 'muke' => __('Muke', $this->text_domain), 'bitauto' => __('Bitauto', $this->text_domain) ); ?>
					<select id="<?php print $this->guid; ?>-apitype" name="<?php print $this->field_name; ?>[apitype]" class="selectstyle">
					<?php foreach ($apiTypes as $apiType => $label) : ?>
						<option value="<?php print $apiType; ?>" <?php selected($apiType, $this->apitype); ?>><?php print $label; ?></option>
					<?php endforeach; ?>
					</select>
					<p><?php _e('Please select the image storage interface to upload.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Please note that not all interfaces are available.', $this->text_domain); ?></span></p>
				</td>
			</tr>
			<?php require __DIR__ . DIRECTORY_SEPARATOR . 'cloudStorage2-common.php'; ?>
		<tbody>
	</table>
</section>