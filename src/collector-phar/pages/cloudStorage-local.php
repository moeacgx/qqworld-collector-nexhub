<section class="cloud-storage-form<?php if ($guid != $this->guid) echo ' hidden'; ?>">
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="<?php print $this->guid; ?>-host"><?php _e('Domain & Folder', $this->text_domain); ?></label></th>
				<td>
					<select id="local-protocol" name="<?php print $this->field_name; ?>[protocol]" class="selectstyle">
						<option value="//"<?php selected('//', $this->protocol); ?>>//</option>
						<option value="http://"<?php selected('http://', $this->protocol); ?>>http://</option>
						<option value="https://"<?php selected('https://', $this->protocol); ?>>https://</option>
					</select>
					<input type="text" name="<?php print $this->field_name; ?>[host]" class="regular-text" placeholder="<?php _e('Host', $this->text_domain); ?>" id="<?php print $this->guid; ?>-host" value="<?php echo $this->host; ?>" /> <span>/wp-contents/uploads/2014/11/example.jpg</span>
					<p class="description"><?php _e("Set new url structure.", $this->text_domain); ?></p
					<?php if (!empty($this->host)) : ?>
					<p class="description"><strong><?php _e('You need add this code below into wp-config.php:', $this->text_domain); ?></strong></p>
					<pre><code class="language-php">define( 'WP_CONTENT_URL', '<?php echo $this->protocol,$this->host; ?>/wp-content' );<br />
define( 'COOKIE_DOMAIN', '<?php $url = parse_url(site_url()); echo $url['host']; ?>' );</code></pre><?php endif; ?>
				</td>
			</tr>
		<tbody>
	</table>
</section>