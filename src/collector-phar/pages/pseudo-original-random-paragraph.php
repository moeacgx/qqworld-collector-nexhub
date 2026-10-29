<!-- Random Paragraph - start -->
<div class="nav-section">
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="enable-random-paragraphs"><?php _e('Enable', $this->text_domain); ?></label></th>
				<td><?php
 $this->the_switcher(array( 'id' => 'enable-random-paragraphs', 'name' => $this->settings_name . '[random-paragraphs][enabled]', 'value' => $this->options->qc_pseudo_original_enabled_random_paragraphs )); ?><p class="description"><?php _e('Insert random paragraphs when saving the post.', $this->text_domain); ?></p>
				<?php if ($this->options->qc_database_wipe_tag_comment) : ?><p class="description qc-icon info"><?php printf(__('Please turn off <a href="%s" target="_blank">Wipe Tag Comment</a> function, which will cause random paragraphs to be generated repeatedly.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-database#wipe')); ?></p><?php endif; ?>
				<p class="description qc-icon info"><?php _e('If you only need to call it when collecting, no need to enable this.', $this->text_domain); ?></p>
				</td>
			</tr>
			<!--<tr valign="top">
				<th scope="row"><label for="random-paragraphs-position"><?php _e('Position', $this->text_domain); ?></label></th>
				<td>
					<ul>
						<li><label><input type="radio" name="<?php print $this->settings_name; ?>[random-paragraphs][position]" value="random" <?php checked('random', $this->options->qc_pseudo_original_random_paragraphs_position); ?> /> <?php _ex('Random', 'position', $this->text_domain); ?></label></li>
						<li><label><input type="radio" name="<?php print $this->settings_name; ?>[random-paragraphs][position]" value="front" <?php checked('front', $this->options->qc_pseudo_original_random_paragraphs_position); ?> /> <?php _ex('Front', 'position', $this->text_domain); ?></label></li>
						<li><label><input type="radio" name="<?php print $this->settings_name; ?>[random-paragraphs][position]" value="back" <?php checked('back', $this->options->qc_pseudo_original_random_paragraphs_position); ?> /> <?php _ex('Back', 'position', $this->text_domain); ?></label></li>
					</ul>
					<p class="description"><?php _e('Please choose where to insert random paragraphs when saving the post.', $this->text_domain); ?></p>
				</td>
			</tr>-->
			<tr>
				<th scope="row"><label for="random-paragraphs-post-types"><?php _e('Post Types', $this->text_domain); ?></label></th>
				<td>
					<?php
 $args = array( 'public' => 1, 'show_ui' => 1 ); $post_types = get_post_types($args, 'objects'); ?>
					<ul id="post_types_list_for_delete">
					<?php
 foreach ($post_types as $name => $post_type) : if ( !in_array($name, array('attachment')) ) : ?>
						<li><label><input name="<?php print $this->settings_name; ?>[random-paragraphs][post-types][]" type="checkbox" value="<?php echo $name; ?>" <?php checked(1, in_array($name, $this->options->qc_pseudo_original_random_paragraphs_post_types)); ?> /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
					<?php endif; endforeach; ?></ul>
					<p class="description"><?php _e('Please select the post types you want to insert random paragraphs.', $this->text_domain) ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="random-paragraphs-back"><?php _e('Paragraphs', $this->text_domain); ?></label><br /><?php _e('Insert at the end of the post content.', $this->text_domain); ?></th>
				<td>
					<textarea rows="30" class="large-text" id="random-paragraphs-back" name="<?php print $this->settings_name; ?>[random][paragraphs]" placeholder="<?php _e('Paragraphs', $this->text_domain); ?>"><?php print $this->options->qc_pseudo_original_random_paragraphs; ?></textarea>
					<p class="symbol-block">
						<a class="symbol" href="#" title="<?php _e('Post Link', $this->text_domain); ?>">{var:post_link}</a>
						<a class="symbol" href="#" title="<?php _e('Post Title', $this->text_domain); ?>">{var:post_title}</a>
						<a class="symbol" href="#" title="<?php _e('Post Excerpt', $this->text_domain); ?>">{var:post_excerpt}</a>
						<a class="symbol" href="#" title="<?php _e('Category', $this->text_domain); ?>">{var:category}</a>
						<a class="symbol" href="#" title="<?php _e('Post Tag', $this->text_domain); ?>">{var:post_tag}</a>
						<a class="symbol" href="#" title="<?php _e('Post Meta', $this->text_domain); ?>">{var:post_meta:meta_key}</a>
						<a class="symbol" href="#" title="<?php _e('Hook', $this->text_domain); ?>">{h:hook_name}</a>
						<a class="symbol" href="#" title="<?php _e('Custom Category', $this->text_domain); ?>">&lt;cat:1&gt;&lt;/cat:1&gt;</a>
						<a class="symbol" href="#" title="<?php _e('Taxonomies', $this->text_domain); ?>">&lt;tax:category:1&gt;&lt;/tax:category:1&gt;</a>
					</p>
					<p class="description"><?php _e('The content here can be called in a pseudo original filter in the collection project.<br />Separated by &lt;!--s--&gt;.', $this->text_domain); ?></p>
					<p class="description"><?php _e('For examples:', $this->text_domain); ?></p>
					<pre class="prism"><code class="language-xml">静夜四无邻，荒居旧业贫。
雨中黄叶树，灯下白头人。
以我独沉久，愧君相见频。
平生自有分，况是蔡家亲。
&lt;!--s--&gt;
岧峣太华俯咸京，天外三峰削不成。
武帝祠前云欲散，仙人掌上雨初晴。
河山北枕秦关险，驿路西连汉畤平。
借问路傍名利客，何如此处学长生。</code></pre>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="random-paragraphs-front"><?php _e('Paragraphs', $this->text_domain); ?></label><br /><?php _e('Insert at the front of the post content.', $this->text_domain); ?></th>
				<td>
					<textarea rows="30" class="large-text" id="random-paragraphs-front" name="<?php print $this->settings_name; ?>[random][paragraphs-front]" placeholder="<?php _e('Paragraphs', $this->text_domain); ?>"><?php print $this->options->qc_pseudo_original_random_paragraphs_front; ?></textarea>
					<p class="symbol-block">
						<a class="symbol" href="#" title="<?php _e('Post Link', $this->text_domain); ?>">{var:post_link}</a>
						<a class="symbol" href="#" title="<?php _e('Post Title', $this->text_domain); ?>">{var:post_title}</a>
						<a class="symbol" href="#" title="<?php _e('Post Excerpt', $this->text_domain); ?>">{var:post_excerpt}</a>
						<a class="symbol" href="#" title="<?php _e('Category', $this->text_domain); ?>">{var:category}</a>
						<a class="symbol" href="#" title="<?php _e('Post Tag', $this->text_domain); ?>">{var:post_tag}</a>
						<a class="symbol" href="#" title="<?php _e('Post Meta', $this->text_domain); ?>">{var:post_meta:meta_key}</a>
						<a class="symbol" href="#" title="<?php _e('Hook', $this->text_domain); ?>">{h:hook_name}</a>
						<a class="symbol" href="#" title="<?php _e('Taxonomies', $this->text_domain); ?>">&lt;tax:category:1&gt;&lt;/tax:category:1&gt;</a>
					</p>
					<p class="description"><?php _e('Separated by &lt;!--s--&gt;.', $this->text_domain); ?></p>
					<p class="description"><?php _e('For examples:', $this->text_domain); ?></p>
					<pre class="prism"><code class="language-xml">静夜四无邻，荒居旧业贫。
雨中黄叶树，灯下白头人。
以我独沉久，愧君相见频。
平生自有分，况是蔡家亲。
&lt;!--s--&gt;
岧峣太华俯咸京，天外三峰削不成。
武帝祠前云欲散，仙人掌上雨初晴。
河山北枕秦关险，驿路西连汉畤平。
借问路傍名利客，何如此处学长生。</code></pre>
				</td>
			</tr>
			<tr valign="top"<?php if (!$this->options->qc_pseudo_original_enabled_random_paragraphs) print ' class="hidden"'; ?>>
				<th scope="row"><label for="random-paragraphs-scan"><?php _e('Scan', $this->text_domain); ?></label></th>
				<td>
					<span id="quick-manage-random-paragraphs">
						<button type="button" data-mode="add" class="scan-random-paragraphs-all button button-primary qc-icon refresh"><?php _e('Add Random Paragraphs', $this->text_domain); ?></button>
						<button type="button" data-mode="wipe" class="scan-random-paragraphs-all button qc-icon delete"><?php _e('Wipe Random Paragraphs', $this->text_domain); ?></button>
					</span>
					<p class="description">
						<?php _e('<strong>Add Random Paragraphs</strong>: Scan all posts and automatically add Random Paragraphs.', $this->text_domain); ?><br />
						<?php _e('<strong>Wipe Random Paragraphs</strong>: Scan all posts and automatically wipe Random Paragraphs.', $this->text_domain); ?>
					</p>
					<br />
					<?php
 $this->the_switcher(array( 'id' => 'random-baidu-included', 'name' => $this->settings_name . '[random][baidu-included]', 'value' => $this->options->qc_pseudo_original_random_baidu_included )); ?><p class="description"><label for="random-baidu-included"><?php _e('Check whether it is included by Baidu, only add Random Paragraphs to posts that Baidu has not included, and only wipe Random Paragraphs from posts that have been included in Baidu.', $this->text_domain); ?></label></p>
				</td>
			</tr>
		</tbody>
	</table>
	<h2><?php _e('Suggestion Paragraphs', $this->text_domain); ?></h2>
	<p><?php _e('Added a recommended paragraph panel to the post editing page to help you get inspiration from paragraphs manually.', $this->text_domain); ?></p>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="suggestion-paragraphs-baidu-cookies"><?php _e('Baidu Search Cookies', $this->text_domain); ?></label></th>
				<td>
					<textarea class="large-text" id="suggestion-paragraphs-baidu-cookies" name="<?php print $this->settings_name; ?>[suggestion-paragraphs][baidu-cookies]" placeholder="Cookie: UM_distinctid=16e5b28df47217-0833dff79c853a-7711a3e-1fa400-16e5b28df4838d..." rows="3"><?php print $this->options->qc_pseudo_original_suggestion_paragraphs_baidu_cookies; ?></textarea>
					<p><?php printf(__('Please get cookies from <a href="%s" target="_blank">Baidu</a>.', $this->text_domain), 'https://www.baidu.com')?></p>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<!-- Random Paragraph - end -->