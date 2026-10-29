<p><strong><?php _e('How to add interval?', $this->text_domain); ?></strong></p>
<p><?php _e('Put the following codes into the theme <em>functions.php</em> file.', $this->text_domain); ?></p>
<pre class="prism"><code class="language-php">function bing_add_schedules($schedules) {
	$schedules['2hours'] = array(
		'interval' => 7200,
		'display' => "<?php _e('Each 2 hours', $this->text_domain); ?>"
	);
	return $schedules;
}
add_filter( 'cron_schedules', 'bing_add_schedules' );</code></pre>