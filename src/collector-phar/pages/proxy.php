<div class="wrap" id="qqworld-collector-settings">
	<form id="proxy-form" action="options.php" method="post">
		<?php settings_fields($this->settings_name); ?>
		<div class="tab-content">
			<h2><?php _e('Proxy', $this->text_domain); ?></h2>
			<p><?php _e("I hope you have fast proxy server.", $this->text_domain); ?></p>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="enabled-proxy"><?php _e('Enabled', $this->text_domain); ?></label></th>
						<td>
							<?php
 $this->the_switcher(array( 'id' => 'enabled-proxy', 'name' => $this->settings_name . '[enabled]', 'value' => $this->options->qc_proxy_enabled )); ?>
							<p class="description">
								<?php _e('Automatically use proxy server to capture remote pictures.', $this->text_domain); ?><br />
								<span class="qc-icon info"><?php _e('Note that there is a separate proxy server switch in each collection project rule, there is no need to enable this.', $this->text_domain); ?></span>
							</p>
						</td>
					</tr>
					<tr valign="top" class="not-for-auto<?php if ($this->options->qc_proxy_mode == 'auto') print ' hidden'; ?>">
						<th scope="row"><label for="proxy-types"><?php _e('Proxy Types', $this->text_domain); ?></label></th>
						<td>
							<?php
 $proxy_types = array( 'CURLPROXY_HTTP' => __('HTTP Proxy', $this->text_domain), 'CURLPROXY_SOCKS4' => __('Socks4 Proxy', $this->text_domain), 'CURLPROXY_SOCKS5' => __('Socks5 Proxy', $this->text_domain), 'CURLPROXY_SOCKS4A' => __('Socks4A Proxy', $this->text_domain), 'CURLPROXY_SOCKS5_HOSTNAME' => __('Socks5 Hostname Proxy', $this->text_domain) ); ?>
							<select id="proxy-types" name="<?php print $this->settings_name; ?>[type]" class="selectstyle">
								<?php
 foreach ($proxy_types as $value => $label) : $disabled = $value != 'CURLPROXY_HTTP' && version_compare(PHP_VERSION, '7.1.0', '<') ? ' disabled' : ''; ?>
									<option value="<?php print $value; ?>" <?php selected($value, $this->options->qc_proxy_type); print $disabled ?>><?php print $label; ?></option>
								<?php endforeach; ?>
							</select>
							<p class="description"><?php _e('Versions lower than php7.1 only support HTTP proxies.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="proxy-mode"><?php _e('Proxy Mode', $this->text_domain); ?></label></th>
						<td>
							<?php
 ?>
							<select id="proxy-mode" name="<?php print $this->settings_name; ?>[mode]" class="selectstyle">
								<option value="auto" <?php selected('auto', $this->options->qc_proxy_mode); ?> disabled><?php _e('Free Automatic Proxy', $this->text_domain); ?></option>
								<option value="static" <?php selected('static', $this->options->qc_proxy_mode); ?>><?php _e('Static Proxy', $this->text_domain); ?></option>
								<option value="dynamic" <?php selected('dynamic', $this->options->qc_proxy_mode); ?>><?php _e('Dynamic Proxy', $this->text_domain); ?></option>
								<!--<optgroup label="<?php _e('Dynamic Proxy', $this->text_domain); ?> ------------">
								<?php foreach ($dynamic_proxy as $value => $label) : ?>
									<option value="<?php print $value; ?>" <?php selected($value, $this->options->qc_proxy_mode); ?> disabled><?php print $label; ?></option>
								<?php endforeach; ?>
								</optgroup>-->
							</select>
							<p class="description">
								<?php printf(__('<strong>%s</strong>: Free built-in proxy, recommended.', $this->text_domain), __('Free Automatic Proxy', $this->text_domain)); ?> <span class="qc-icon info">(<?php _e('Unavailable', $this->text_domain); ?>)</span><br />
								<?php printf(__('<strong>%s</strong>: If you can find free or paid proxy server IP and port, you can use this mode, one per line.', $this->text_domain), __('Static Proxy', $this->text_domain)); ?><br />
								<?php printf(__('<strong>%s</strong>: Fill in the interface URL of the paid proxy server, but it is recommended to manually obtain the IP and port list and fill in the static address.', $this->text_domain), __('Dynamic Proxy', $this->text_domain)); ?>
							</p><br />
						</td>
					</tr>
					<tr valign="top" class="for-dynamic<?php if ($this->options->qc_proxy_mode != 'dynamic') print ' hidden'; ?>">
						<th scope="row"><label for="expiration-time"><?php _e('Expiration Time', $this->text_domain); ?></label></th>
						<td>
							<input type="number" class="small-text" name="<?php print $this->settings_name; ?>[expiration-time]" id="expiration-time" value="<?php print $this->options->qc_proxy_expiration_time; ?>" />
							<p class="description"><?php _e("The dynamic proxy's IP address and port cache expiration time, once expired, it will be reacquired. in seconds.", $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top" class="not-for-auto<?php if ($this->options->qc_proxy_mode == 'auto') print ' hidden'; ?>">
						<th scope="row"><label for="proxy_address"><?php _e('Proxy Address', $this->text_domain); ?></label></th>
						<td>
							<textarea name="<?php print $this->settings_name; ?>[address]" type="text" id="proxy_address" class="large-text" rows="5"><?php echo $this->options->qc_proxy_address; ?></textarea>
							<p class="for-static<?php if ($this->options->qc_proxy_mode != 'static') print ' hidden'; ?>"><button type="button" class="button button-primary" id="check-proxy-address"><?php _e('Detect whether the proxy address is valid (delete invalid addresses)', $this->text_domain); ?></button></p>
							<?php $cache = $GLOBALS['QC']->cache->get_cache('qqworld-collector-proxy-' . $this->options->qc_proxy_mode . '-' . $blog_id); ?>
							<p class="for-dynamic<?php if ($this->options->qc_proxy_mode != 'dynamic' || !$cache) print ' hidden'; ?>">
								<a href="<?php print admin_url('admin-ajax.php?action=qqworld-collector-view-dynamic-proxy-cache'); ?>" target="_blank" class="button button-primary qc-icon search"><?php _e('View Dynamic Proxy Cache', $this->text_domain); ?></a>
								<button type="button" class="button qc-icon delete" id="delete-dynamic-proxy-cache"><?php _e('Delete Dynamic Proxy Cache', $this->text_domain); ?></button>
							</p>
							<p class="description"><?php _e('Static proxy can fill in multiple lines, one IP:port per line.', $this->text_domain); ?><br /><?php printf(__('<strong>For example:</strong> %s', $this->text_domain), '<dl><dt>'.__('Static Proxy', $this->text_domain).'</dt><dd>127.0.0.1:8087<br />47.96.124.77:1080<br />32.96.49.66:53317<br />192.168.1.1:1080@username:password</dd><dt>'.__('Dynamic Proxy', $this->text_domain).'</dt><dd>http://www.proxy.org/mo.php?sxb=&tqsl=300&port=&export=&ktip=&sxa=&submit=%CC%E1++%C8%A1</dd>'); ?></p>
							<p class="description qc-icon info"><?php _e('Notice: Some proxy servers require an IP whitelist, otherwise your server cannot use it.', $this->text_domain); ?></p>
							<p class="description qc-icon info"><?php _e('Notice: The content obtained by the dynamic address should be exactly the same as the static proxy list format.', $this->text_domain); ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="proxy_timeout"><?php _e('Timeout', $this->text_domain); ?></label></th>
						<td>
							<input name="<?php print $this->settings_name; ?>[timeout]" type="number" class="small-text" id="proxy_timeout" value="<?php echo $this->options->qc_proxy_timeout; ?>" /> <?php _e("Second(s)", $this->text_domain); ?>
							<p class="description"><?php _e("Set timeout period on proxy.", $this->text_domain); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</div>
	</form>
</div>