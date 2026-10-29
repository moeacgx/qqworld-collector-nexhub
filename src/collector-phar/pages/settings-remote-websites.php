<!-- Remote Website - start -->
<p class="description">远程认证信息不会回显。相同目标的账号、密码和令牌留空时保持原值；更改目标地址或存储类型后，请重新填写认证信息。</p>
<div class="nav-section">
	<h2><?php _e('Remote Website', $this->text_domain); ?></h2>
	<p><?php _e('For remote publishing when collecting, you can select the set remote website in the collection settings of collection projects.', $this->text_domain); ?></p>
	<div id="remote-website-container">
	<?php
 if (!empty($this->options->qc_remote_website)) { $folded = count($this->options->qc_remote_website) > 1 ? ' folded' : ''; $hidden = count($this->options->qc_remote_website) > 1 ? ' hidden' : ''; $disabled = apply_filters( 'qqworld-activation-is-ultimate-edition', false ) ? '' : ' disabled'; foreach ($this->options->qc_remote_website as $guid => $remote_website) { extract($remote_website); $title = isset($title) ? $title : __('Unnamed', $this->text_domain); ?><section class="item-wrapper" data-id="<?php print $guid; ?>">
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
								<input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][title]" class="regular-text remote-website-title" placeholder="<?php _e('Title'); ?>" id="title-<?php print $guid; ?>" value="<?php print $title; ?>" />
								<p class="description"><?php _e('Used to quickly identify remote website in collecting settings of collection project.', $this->text_domain); ?></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="type-<?php print $guid; ?>"><?php _e('Type', $this->text_domain); ?></label></th>
							<td>
								<select name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][type]" id="type-<?php print $guid; ?>" class="remote-website-type selectstyle">
									<option value="wordpress" <?php selected('wordpress', $type); ?>>WordPress</option>
									<optgroup label="<?php _e('Advanced', $this->text_domain); ?>">
										<option value="ftp" <?php selected('ftp', $type); print $disabled; ?>><?php _e('File Transfer Protocol (FTP)', $this->text_domain); ?></option>
										<option value="qiniu" <?php selected('qiniu', $type); print $disabled; ?>><?php _e('Qiniu Cloud Storage', $this->text_domain); ?></option>
										<option value="oss" <?php selected('oss', $type); print $disabled; ?>><?php _e('Aliyun Open Storage Service (OSS)', $this->text_domain); ?></option>
										<option value="cos" <?php selected('cos', $type); print $disabled; ?>><?php _e('Tencent Cloud Object Service (COS)', $this->text_domain); ?></option>
										<option value="obs" <?php selected('obs', $type); print $disabled; ?>><?php _e('Huawei Object Storage Service (OBS)', $this->text_domain); ?></option>
										<option value="upyun" <?php selected('upyun', $type); print $disabled; ?>><?php _e('UpYun Storage Service', $this->text_domain); ?></option>
										<option value="bos" <?php selected('bos', $type); print $disabled; ?>><?php _e('Baidu Object Storage (BOS)', $this->text_domain); ?></option>
										<option value="qqworld" <?php selected('qqworld', $type); print $disabled; ?>><?php _e('QQWorld Cloud File Storage System', $this->text_domain); ?></option>
										<option value="custom" <?php selected('custom', $type); print $disabled; ?>><?php _e('Custom', $this->text_domain); ?></option>
									</optgroup>
								</select>
								<p class="description"><?php _e('Only the <strong>Ultimate Edition</strong> supports advanced remote publishing.', $this->text_domain); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
				<section class="remote-website-item<?php if ($type != 'wordpress') print ' hidden'; ?>">
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row"><label for="wordpress-home-<?php print $guid; ?>"><?php _e('Website Homepage Address', $this->text_domain); ?></label></th>
								<td>
									<input type="text" id="wordpress-home-<?php print $guid; ?>" class="regular-text host" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][wordpress][host]" placeholder="<?php _e('Website Homepage Address', $this->text_domain); ?> (http://)" value="<?php print $wordpress['host']; ?>" />
									<p class="description qc-icon info"><?php printf(__('Note: You can only push to the <strong>Master Edition</strong>, <strong>Enterprise Edition</strong> or <strong>Ultimate Edition</strong> website of the <a href="%s" target="_blank">domain name</a> bound to the serial number.', $this->text_domain), 'https://www.qqworld.org/account/product-activation'); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="wordpress-login-name-<?php print $guid; ?>"><?php _e('Login Name', $this->text_domain); ?></label></th>
								<td>
									<input type="text" id="wordpress-login-name-<?php print $guid; ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][wordpress][user]" placeholder="<?php _e('Login Name', $this->text_domain); ?>" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" />
									<p class="description"><?php _e('Please fill in a user name with administrator role.', $this->text_domain); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="wordpress-password-<?php print $guid; ?>"><?php _e('Password'); ?></label></th>
								<td>
									<input type="password" id="wordpress-password-<?php print $guid; ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][wordpress][pass]" placeholder="<?php _e('Password'); ?>" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="wordpress-mode-<?php print $guid; ?>"><?php _e('Mode', $this->text_domain); ?></label></th>
								<td>
									<dl>
										<dt><label><input type="radio" id="wordpress-mode-<?php print $guid; ?>-regular" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][wordpress][mode]" value="regular" <?php checked('regular', $wordpress['mode']); ?> /> <strong><?php _e('Regular Mode', $this->text_domain); ?></strong></label></dt>
										<dd><label for="wordpress-mode-<?php print $guid; ?>-regular"><?php _e('The collected content is delivered to the remote site intact, and the remote site captures the remote images.', $this->text_domain); ?></dd>
										<dt><label><input type="radio" id="wordpress-mode-<?php print $guid; ?>-advanced" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][wordpress][mode]" value="advanced" <?php checked('advanced', $wordpress['mode']); ?> /> <strong><?php _e('Advanced Mode', $this->text_domain); ?></strong></label></dt>
										<dd><label for="wordpress-mode-<?php print $guid; ?>-advanced"><?php _e('The remote images is captured locally and delivered directly to the remote site, reducing server collecting pressure.', $this->text_domain); ?></label></dd>
										<dt><label><input type="radio" id="wordpress-mode-<?php print $guid; ?>-alternative" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][wordpress][mode]" value="alternative" <?php checked('alternative', $wordpress['mode']); ?> /> <strong><?php _e('Alternative Mode', $this->text_domain); ?></strong></label></dt>
										<dd><label for="wordpress-mode-<?php print $guid; ?>-alternative"><?php _e('Capture remote images locally and save them to cloud storage. Do not send images to remote sites, only the Ultimate Edition supports it.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('The theme of the remote site must support obtaining pictures from the post content and displaying it as featured image. Otherwise, there will be no featured pictures.', $this->text_domain); ?></span></label></dd>
									</dl>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="wordpress-check-duplicated-<?php print $guid; ?>"><?php _e('Check Duplicated', $this->text_domain); ?></label></th>
								<td>
									<?php
 $this->the_switcher(array( 'id' => 'wordpress-check-duplicated-'. $guid, 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[remote-website]['.$guid.'][wordpress][check-duplicated]', 'value' => $wordpress['check-duplicated'] )); ?>
									<p class="description"><?php _e('Before posting, check if the remote site has an post with the same title, and if so, will ignore or overwrite it. You can choose a repeated policy in the collection settings for each collection project (Only valid when collecting posts).', $this->text_domain ); ?><br /><span class="qc-icon info"><?php _e('Note that this is only suitable for old websites and can be very time consuming.', $this->text_domain); ?></span><br /><span class="qc-icon info"><?php _e('Note: Only posts in the remote website in the published state can be repeatedly detected, so please publish local posts before pushing.', $this->text_domain); ?></span></p>
								</td>
							</tr>
						</tbody>
					</table>
				</section>
				<section class="remote-website-item<?php if ($type != 'ftp') print ' hidden'; ?>">
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row"><label for="ftp-home-<?php print $guid; ?>"><?php _e('Website Homepage Address', $this->text_domain); ?></label></th>
								<td>
									<input type="text" id="ftp-home-<?php print $guid; ?>" class="regular-text host" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][ftp][host]" placeholder="<?php _e('Website Homepage Address', $this->text_domain); ?> (http://)" value="<?php print $ftp['host']; ?>" />
									<p class="description qc-icon info"><?php printf(__('Note: You can only push to the static website of the <a href="%s" target="_blank">domain name</a> bound to the serial number.', $this->text_domain), 'https://www.qqworld.org/account/product-activation'); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="ftp-mode-<?php print $guid; ?>-ip"><?php _e('IP Address', $this->text_domain); ?></label></th>
								<td>
									<input type="text" class="regular-text" placeholder="<?php _e('IP Address', $this->text_domain); ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][ftp][ip]" id="ftp-mode-<?php print $guid; ?>-ip" value="<?php echo $ftp['ip']; ?>" />
									<p class="description"><?php _e("If you can't connect, you can consider turning on passive mode or upgrading the FTP service program.", $this->text_domain); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="ftp-mode-<?php print $guid; ?>-port"><?php _e('Port', $this->text_domain); ?></label></th>
								<td><input type="number" placeholder="<?php _e('Port', $this->text_domain); ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][ftp][port]" id="ftp-mode-<?php print $guid; ?>-port" size="5" class="small-text" value="<?php echo $ftp['port']; ?>" /></td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="ftp-mode-<?php print $guid; ?>-username"><?php _e('Username', $this->text_domain); ?></label></th>
								<td><input type="text" placeholder="<?php _e('Username', $this->text_domain); ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][ftp][username]" id="ftp-mode-<?php print $guid; ?>-username" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" /></td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="ftp-mode-<?php print $guid; ?>-password"><?php _e('Password', $this->text_domain); ?></label></th>
								<td>
									<input type="password" placeholder="<?php _e('Password', $this->text_domain); ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][ftp][password]" id="ftp-mode-<?php print $guid; ?>-password" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="ftp-mode-<?php print $guid; ?>-passive"><?php _e('Passive Mode', $this->text_domain); ?></label></th>
								<td><?php
 $this->the_switcher(array( 'id' => 'ftp-mode-'.$guid.'-passive', 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[remote-website]['.$guid.'][ftp][passive]', 'value' => $ftp['passive'] )); ?><p class="description"><?php _e('Many FTP servers need to enable passive mode to upload files.', $this->text_domain); ?></p></td>
							</tr>
						</tbody>
					</table>
				</section>
				<section class="remote-website-item<?php if ($type != 'qiniu') print ' hidden'; ?>">
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row"><label for="qiniu-mode-<?php print $guid; ?>-home"><?php _e('Website Homepage Address', $this->text_domain); ?></label></th>
								<td>
									<input type="text" id="qiniu-mode-<?php print $guid; ?>-home" class="regular-text host" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][qiniu][host]" placeholder="<?php _e('Website Homepage Address', $this->text_domain); ?> (http://)" value="<?php print $qiniu['host']; ?>" />
									<p class="description qc-icon info"><?php printf(__('Note: You can only push to the static website of the <a href="%s" target="_blank">domain name</a> bound to the serial number.', $this->text_domain), 'https://www.qqworld.org/account/product-activation'); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="qiniu-mode-<?php print $guid; ?>-accesskey"><?php _e('AccessKey', $this->text_domain); ?></label></th>
								<td><input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][qiniu][accesskey]" class="regular-text" id="qiniu-mode-<?php print $guid; ?>-accesskey" placeholder="<?php _e('AccessKey', $this->text_domain); ?>" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" /></td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="qiniu-mode-<?php print $guid; ?>-secretkey"><?php _e('SecretKey', $this->text_domain); ?></label></th>
								<td><input type="password" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][qiniu][secretkey]" class="regular-text" id="qiniu-mode-<?php print $guid; ?>-secretkey" placeholder="<?php _e('SecretKey', $this->text_domain); ?>" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" /></td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="qiniu-mode-<?php print $guid; ?>-bucket"><?php _e('Bucket', $this->text_domain); ?></label></th>
								<td>
									<input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][qiniu][bucket]" class="regular-text" id="qiniu-mode-<?php print $guid; ?>-bucket" placeholder="<?php _e('Bucket', $this->text_domain); ?>" value="<?php echo $qiniu['bucket']; ?>" />
								</td>
							</tr>
						</tbody>
					</table>
				</section>
				<section class="remote-website-item<?php if ($type != 'oss') print ' hidden'; ?>">
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row"><label for="oss-home-<?php print $guid; ?>"><?php _e('Website Homepage Address', $this->text_domain); ?></label></th>
								<td>
									<input type="text" id="oss-home-<?php print $guid; ?>" class="regular-text host" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][oss][host]" placeholder="<?php _e('Website Homepage Address', $this->text_domain); ?> (http://)" value="<?php print $oss['host']; ?>" />
									<p class="description qc-icon info"><?php printf(__('Note: You can only push to the static website of the <a href="%s" target="_blank">domain name</a> bound to the serial number.', $this->text_domain), 'https://www.qqworld.org/account/product-activation'); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="oss-mode-<?php print $guid; ?>-endpoint"><?php _e('Endpoint', $this->text_domain); ?></label></th>
								<td>
									<input type="text" class="regular-text" placeholder="<?php _e('Endpoint', $this->text_domain); ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][oss][endpoint]" id="oss-mode-<?php print $guid; ?>-endpoint" value="<?php echo $oss['endpoint']; ?>" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="oss-mode-<?php print $guid; ?>-access-key-id"><?php _e('Access Key ID', $this->text_domain); ?></label></th>
								<td>
									<input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][oss][access-key-id]" class="regular-text" placeholder="<?php _e('Access Key ID', $this->text_domain); ?>" id="oss-mode-<?php print $guid; ?>-access-key-id" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="oss-mode-<?php print $guid; ?>-access-key-secret"><?php _e('Access Key Secret', $this->text_domain); ?></label></th>
								<td>
									<input type="password" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][oss][access-key-secret]" class="regular-text" placeholder="<?php _e('Access Key Secret', $this->text_domain); ?>" id="oss-mode-<?php print $guid; ?>-access-key-secret" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="oss-mode-<?php print $guid; ?>-bucket"><?php _e('Bucket', $this->text_domain); ?></label></th>
								<td>
									<input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][oss][bucket]" class="regular-text" placeholder="<?php _e('Bucket', $this->text_domain); ?>" id="oss-mode-<?php print $guid; ?>-bucket" value="<?php echo $oss['bucket']; ?>" />
								</td>
							</tr>
						</tbody>
					</table>
				</section>
				<section class="remote-website-item<?php if ($type != 'cos') print ' hidden'; ?>">
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row"><label for="cos-home-<?php print $guid; ?>"><?php _e('Website Homepage Address', $this->text_domain); ?></label></th>
								<td>
									<input type="text" id="cos-home-<?php print $guid; ?>" class="regular-text host" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][cos][host]" placeholder="<?php _e('Website Homepage Address', $this->text_domain); ?> (http://)" value="<?php print $cos['host']; ?>" />
									<p class="description qc-icon info"><?php printf(__('Note: You can only push to the static website of the <a href="%s" target="_blank">domain name</a> bound to the serial number.', $this->text_domain), 'https://www.qqworld.org/account/product-activation'); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="cos-mode-<?php print $guid; ?>-region"><?php _e('Region', $this->text_domain); ?></label></th>
								<td>
									<select class="selectstyle" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][cos][region]" id="cos-mode-<?php print $guid; ?>-region">
										<optgroup label="V5" class="v5">
											<option value="ap-beijing" <?php selected('ap-beijing', $cos['region']); ?>><?php _e('BeiJing (bj)', $this->text_domain); ?></option>
											<option value="ap-nanjing" <?php selected('ap-nanjing', $cos['region']); ?>><?php _e('NanJing', $this->text_domain); ?></option>
											<option value="ap-shanghai" <?php selected('ap-shanghai', $cos['region']); ?>><?php _e('East China - ShangHai (sh)', $this->text_domain); ?></option>
											<option value="ap-guangzhou" <?php selected('ap-guangzhou', $cos['region']); ?>><?php _e('South China - GuangZhou (gz)', $this->text_domain); ?></option>
											<option value="ap-chengdu" <?php selected('ap-chengdu', $cos['region']); ?>><?php _e('West South China - ChengDu (cd)', $this->text_domain); ?></option>
											<option value="ap-chongqing" <?php selected('ap-chongqing', $cos['region']); ?>><?php _e('ChongQing', $this->text_domain); ?></option>
											<option value="ap-shenzhen-fsi" <?php selected('ap-shenzhen-fsi', $cos['region']); ?>><?php _e('ShenZhen Financial', $this->text_domain); ?></option>
											<option value="ap-shanghai-fsi" <?php selected('ap-shanghai-fsi', $cos['region']); ?>><?php _e('ShangHai Financial', $this->text_domain); ?></option>
											<option value="ap-beijing-fsi" <?php selected('ap-beijing-fsi', $cos['region']); ?>><?php _e('BeiJing Financial', $this->text_domain); ?></option>
											<!-- �й���ۼ�������� -->
											<option value="ap-hongkong" <?php selected('ap-hongkong', $cos['region']); ?>><?php _e('Hongkong (hk)', $this->text_domain); ?></option>
											<option value="ap-singapore" <?php selected('ap-singapore', $cos['region']); ?>><?php _e('Singapore (sgp)', $this->text_domain); ?></option>
											<option value="ap-mumbai" <?php selected('ap-mumbai', $cos['region']); ?>><?php _e('Mumbai', $this->text_domain); ?></option>
											<option value="ap-seoul" <?php selected('ap-seoul', $cos['region']); ?>><?php _e('Seoul', $this->text_domain); ?></option>
											<option value="ap-bangkok" <?php selected('ap-bangkok', $cos['region']); ?>><?php _e('Bangkok, Thailand', $this->text_domain); ?></option>
											<option value="ap-tokyo" <?php selected('ap-tokyo', $cos['region']); ?>><?php _e('Tokyo, Japan', $this->text_domain); ?></option>
											<option value="na-siliconvalley" <?php selected('na-siliconvalley', $cos['region']); ?>><?php _e('Silicon Valley', $this->text_domain); ?></option>
											<option value="na-ashburn" <?php selected('na-ashburn', $cos['region']); ?>><?php _e('Virginia (eastern United States)', $this->text_domain); ?></option>
											<option value="na-toronto" <?php selected('na-toronto', $cos['region']); ?>><?php _e('Toronto (ca)', $this->text_domain); ?></option>
											<option value="eu-frankfurt" <?php selected('eu-frankfurt', $cos['region']); ?>><?php _e('Frankfurt (ger)', $this->text_domain); ?></option>
											<option value="eu-moscow" <?php selected('eu-moscow', $cos['region']); ?>><?php _e('Moscow, Russia', $this->text_domain); ?></option>
										</optgroup>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="cos-mode-<?php print $guid; ?>-api-id"><?php _e('APP ID', $this->text_domain); ?></label></th>
								<td><input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][cos][appID]" class="regular-text" placeholder="<?php _e('APP ID', $this->text_domain); ?>" id="cos-mode-<?php print $guid; ?>-api-id" value="<?php echo $cos['appID']; ?>" /></td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="cos-mode-<?php print $guid; ?>-secretID"><?php _e('secretID', $this->text_domain); ?></label></th>
								<td><input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][cos][secretID]" class="regular-text" placeholder="<?php _e('secretID', $this->text_domain); ?>" id="cos-mode-<?php print $guid; ?>-secretID" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" /></td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="cos-mode-<?php print $guid; ?>-secretKey"><?php _e('secretKey', $this->text_domain); ?></label></th>
								<td><input type="password" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][cos][secretKey]" class="regular-text" placeholder="<?php _e('secretKey', $this->text_domain); ?>" id="cos-mode-<?php print $guid; ?>-secretKey" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" /></td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="cos-mode-<?php print $guid; ?>-bucket"><?php _e('Bucket', $this->text_domain); ?></label></th>
								<td>
									<input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][cos][bucket]" class="regular-text" placeholder="<?php _e('Bucket', $this->text_domain); ?>" id="cos-mode-<?php print $guid; ?>-bucket" value="<?php echo $cos['bucket']; ?>" />
								</td>
							</tr>
						</tbody>
					</table>
				</section>
				<section class="remote-website-item<?php if ($type != 'obs') print ' hidden'; ?>">
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row"><label for="obs-mode-<?php print $guid; ?>-home"><?php _e('Website Homepage Address', $this->text_domain); ?></label></th>
								<td>
									<input type="text" id="obs-mode-<?php print $guid; ?>-home" class="regular-text host" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][obs][host]" placeholder="<?php _e('Website Homepage Address', $this->text_domain); ?> (http://)" value="<?php print $obs['host']; ?>" />
									<p class="description qc-icon info"><?php printf(__('Note: You can only push to the static website of the <a href="%s" target="_blank">domain name</a> bound to the serial number.', $this->text_domain), 'https://www.qqworld.org/account/product-activation'); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="obs-mode-<?php print $guid; ?>-endpoint"><?php _e('Endpoint', $this->text_domain); ?></label></th>
								<td>
									<input type="text" class="regular-text" placeholder="<?php _e('Endpoint', $this->text_domain); ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][obs][endpoint]" id="obs-mode-<?php print $guid; ?>-endpoint" value="<?php echo $obs['endpoint']; ?>" />
									<p class="description"><?php _e("Default Beijing 1 endpoint, Click <a href='https://developer.huaweicloud.com/endpoint' target='_balnk'>here</a> to know more.", $this->text_domain); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="obs-mode-<?php print $guid; ?>-access-key-id"><?php _ex('Access Key ID', 'huawei obs', $this->text_domain); ?></label></th>
								<td>
									<input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][obs][access-key-id]" class="regular-text" id="obs-mode-<?php print $guid; ?>-access-key-id" placeholder="<?php _ex('Access Key ID', 'huawei obs', $this->text_domain); ?>" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="obs-mode-<?php print $guid; ?>-access-key-secret"><?php _ex('Access Key Secret', 'huawei obs', $this->text_domain); ?></label></th>
								<td>
									<input type="password" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][obs][access-key-secret]" class="regular-text" id="obs-mode-<?php print $guid; ?>-access-key-secret" placeholder="<?php _ex('Access Key Secret', 'huawei obs', $this->text_domain); ?>" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="obs-mode-<?php print $guid; ?>-bucket"><?php _ex('Bucket', 'huawei obs', $this->text_domain); ?></label></th>
								<td>
									<input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][obs][bucket]" class="regular-text" id="obs-mode-<?php print $guid; ?>-bucket" placeholder="<?php _ex('Bucket', 'huawei obs', $this->text_domain); ?>" value="<?php echo $obs['bucket']; ?>" />
								</td>
							</tr>
						</tbody>
					</table>
				</section>
				<section class="remote-website-item<?php if ($type != 'upyun') print ' hidden'; ?>">
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row"><label for="upyun-mode-<?php print $guid; ?>-home"><?php _e('Website Homepage Address', $this->text_domain); ?></label></th>
								<td>
									<input type="text" id="upyun-mode-<?php print $guid; ?>-home" class="regular-text host" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][upyun][host]" placeholder="<?php _e('Website Homepage Address', $this->text_domain); ?> (http://)" value="<?php print $upyun['host']; ?>" />
									<p class="description qc-icon info"><?php printf(__('Note: You can only push to the static website of the <a href="%s" target="_blank">domain name</a> bound to the serial number.', $this->text_domain), 'https://www.qqworld.org/account/product-activation'); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="upyun-mode-<?php print $guid; ?>-username"><?php _ex('Operator', 'upyun', $this->text_domain); ?></label></th>
								<td><input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][upyun][username]" placeholder="<?php _e('Username', $this->text_domain); ?>" id="upyun-mode-<?php print $guid; ?>-username" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" /></td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="upyun-mode-<?php print $guid; ?>-password"><?php _e('Password', $this->text_domain); ?></label></th>
								<td>
									<input type="password" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][upyun][password]" placeholder="<?php _e('Password', $this->text_domain); ?>" id="upyun-mode-<?php print $guid; ?>-password" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="upyun-mode-<?php print $guid; ?>-bucket"><?php _ex('Service Name', 'upyun', $this->text_domain); ?></label></th>
								<td>
									<input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][upyun][bucket]" placeholder="<?php _ex('Service Name', 'upyun', $this->text_domain); ?>" id="upyun-mode-<?php print $guid; ?>-bucket" value="<?php echo $upyun['bucket']; ?>" />
								</td>
							</tr>
						</tbody>
					</table>
				</section>
				<section class="remote-website-item<?php if ($type != 'bos') print ' hidden'; ?>">
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row"><label for="bos-mode-<?php print $guid; ?>-home"><?php _e('Website Homepage Address', $this->text_domain); ?></label></th>
								<td>
									<input type="text" id="bos-mode-<?php print $guid; ?>-home" class="regular-text host" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][bos][host]" placeholder="<?php _e('Website Homepage Address', $this->text_domain); ?> (http://)" value="<?php print $bos['host']; ?>" />
									<p class="description qc-icon info"><?php printf(__('Note: You can only push to the static website of the <a href="%s" target="_blank">domain name</a> bound to the serial number.', $this->text_domain), 'https://www.qqworld.org/account/product-activation'); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="bos-mode-<?php print $guid; ?>-accesskey"><?php _e('Access Key', $this->text_domain); ?></label></th>
								<td><input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][bos][accesskey]" class="regular-text" id="bos-mode-<?php print $guid; ?>-accesskey" placeholder="<?php _e('Access Key', $this->text_domain); ?>" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" /></td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="bos-mode-<?php print $guid; ?>-secretkey"><?php _e('Secret Key', $this->text_domain); ?></label></th>
								<td>
									<input type="password" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][bos][secretkey]" class="regular-text" id="bos-mode-<?php print $guid; ?>-secretkey" placeholder="<?php _e('Secret Key', $this->text_domain); ?>" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="bos-mode-<?php print $guid; ?>-endpoint"><?php _e('Region', $this->text_domain); ?></label></th>
								<td>
									<select id="bos-mode-<?php print $guid; ?>-endpoint" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][bos][endpoint]" class="selectstyle">
										<option value="bj.bcebos.com" <?php selected('bj.bcebos.com', $bos['endpoint']); ?>><?php _ex('North China - Bei Jing', 'baidu bos', $this->text_domain); ?>
										<option value="gz.bcebos.com" <?php selected('gz.bcebos.com', $bos['endpoint']); ?>><?php _ex('South China - Guang Zhou', 'baidu bos', $this->text_domain); ?>
										<option value="hkg.bcebos.com" <?php selected('hkg.bcebos.com', $bos['endpoint']); ?>><?php _ex('Hongkong', 'baidu bos', $this->text_domain); ?>
										<option value="su.bcebos.com" <?php selected('su.bcebos.com', $bos['endpoint']); ?>><?php _ex('East China - Su Zhou', 'baidu bos', $this->text_domain); ?>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="bos-mode-<?php print $guid; ?>-bucket"><?php _e('Bucket', $this->text_domain); ?></label></th>
								<td>
									<input type="text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][bos][bucket]" class="regular-text" id="bos-mode-<?php print $guid; ?>-bucket" placeholder="<?php _e('Bucket', $this->text_domain); ?>" value="<?php echo $bos['bucket']; ?>" />
								</td>
							</tr>
						</tbody>
					</table>
				</section>
				<section class="remote-website-item<?php if ($type != 'qqworld') print ' hidden'; ?>">
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row"><label for="qqworld-mode-<?php print $guid; ?>-home"><?php _e('Website Homepage Address', $this->text_domain); ?></label></th>
								<td>
									<input type="text" id="qqworld-mode-<?php print $guid; ?>-home" class="regular-text host" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][qqworld][host]" placeholder="<?php _e('Website Homepage Address', $this->text_domain); ?> (http://)" value="<?php print $qqworld['host']; ?>" /> /qqworld-cloud-file-storage-system.php
									<p class="description qc-icon info"><?php printf(__('Note: You can only push to the static website of the <a href="%s" target="_blank">domain name</a> bound to the serial number.', $this->text_domain), 'https://www.qqworld.org/account/product-activation'); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="qqworld-mode-<?php print $guid; ?>-token"><?php _e('Token', $this->text_domain); ?></label></th>
								<td>
									<input type="password" class="regular-text" placeholder="<?php _e('Token', $this->text_domain); ?>" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][qqworld][token]" id="qqworld-mode-<?php print $guid; ?>-token" value="" autocomplete="new-password" title="已保存的认证信息不回显；留空保持原值" /> <button type="button" class="button qc-icon format create-token-btn"><?php _e('Generate token', $this->text_domain); ?></button>
									<p class="description"><?php printf(__('Please set the Token, save the settings and click the <a href="%s">here</a> to download the interface file and upload it to the root directory of the cloud storage.', $this->text_domain), admin_url('admin-ajax.php?action=qqworld-collector-cloud-stoarge-qqworld-api-file&token='.$qqworld['token'])); ?><br /><span class="qc-icon info"><?php _e('Note that after changing the Token, the interface file must be downloaded and uploaded again.', $this->text_domain); ?></span></p>
								</td>
							</tr>
						</tbody>
					</table>
				</section>
				<section class="remote-website-item<?php if ($type != 'custom') print ' hidden'; ?>">
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row"><label for="custom-mode-<?php print $guid; ?>-api"><?php _e('API Address', $this->text_domain); ?></label></th>
								<td>
									<input type="text" id="custom-mode-<?php print $guid; ?>-api" class="large-text api" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][custom][host]" placeholder="<?php _e('API Address', $this->text_domain); ?> (http://)" value="<?php print isset($custom['host']) ? $custom['host'] : ''; ?>" />
									<p class="description qc-icon info"><?php _e('Please enter the API address for sending to another website.', $this->text_domain); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="custom-mode-<?php print $guid; ?>-hook-name"><?php _e('Hook Name', $this->text_domain); ?></label></th>
								<td>
									<input type="text" class="large-text" name="<?php print $GLOBALS['QC-SETTINGS-NAME']; ?>[remote-website][<?php print $guid; ?>][custom][hook]" readonly value="qqworld-collector-remote-website-custom-content-<?php print $guid; ?>" />
								</td>
							</tr>
						</tbody>
					</table>
				</section>
			</div>
		</section>
	<?php } } ?>
	</div>
	<p>
		<button id="add-remote-website" type="button" class="button button-large qc-icon add"><?php _e('Add a Remote Website', $this->text_domain); ?></button>
		<?php if ($this->options->qc_remote_website) : ?><a href="<?php print admin_url('admin.php?page=remote-publish'); ?>" class="button button-large qc-icon settings" target="_blank"><?php _e('Remote Publish Control Panel', $this->text_domain); ?></a><?php endif; ?>
	</p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enabled-auto-remote-publish"><?php _e('Enabled Automatic Remote Publish', $this->text_domain); ?></label></th>
				<td>
					<?php
 $this->the_switcher(array( 'id' => 'enabled-auto-remote-publish', 'name' => $GLOBALS['QC-SETTINGS-NAME'] . '[enabled-auto-remote-publish]', 'value' => $this->options->enabled_auto_remote_publish )); ?>
					<p class="description"><?php _e('Remote publish to the remote website when saving a post.', $this->text_domain); ?></p>
				</td>
			</tr>
		<tbody>
	</table>
</div>
<!-- Remote Website - end -->