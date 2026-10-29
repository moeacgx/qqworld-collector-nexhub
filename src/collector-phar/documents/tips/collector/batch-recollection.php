<p>有时候收藏项目设置有些问题，导致采集到了大量的文章出错，这时候难道需要全部删除重新再来一次吗？</p>
<h2>批量重新采集文章</h2>
<p>在主题的 <em>functions.php</em> 里加入如下代码：</p>
<pre class="prism"><code class="language-php">if (isset($_GET['gogogo'])) {
	set_time_limit(0);
	add_action('init', function() {
		print '<pre>';
		$ids_log_path = __DIR__ . '/ids.log';
		for ($paged=0; $paged<1000; $paged++) {
			$args = array(
				'post_type' => get_post_types(),
				'post_status' => 'any',
				'meta_key' => '_collection_project',
				//'meta_value' => 1541, // 也可以删掉下方的 meta_compare 一行，直接填收藏项目的ID，专门扫描该项目
				'meta_compare' => 'EXISTS',
				'posts_per_page' => 1000,
				'offset' => 1000*$paged
			);
			// 读取缓存的ID
			if (file_exists($ids_log_path)) {
				$ids = file_get_contents($ids_log_path);
				$ids = explode("\n", $ids);
				$ids = array_filter($ids);
				$args['post__not_in'] = $ids;
			}
			$posts = get_posts($args);
			if (!empty($posts)) {
				foreach ($posts as $post) {
					$results = $GLOBALS['QC']->collector->ajax->collect_again($post->ID);
					if ( $results ) {
						error_log($results['ID']."\n", 3, $ids_log_path);
					}
				}
			} else {
				break;
			}
		}
		print '</pre>';
		print 'Done.';
		exit;
	});
}</code></pre>
<p>然后用 <a href="<?php print home_url('?gogogo'); ?>" target="_blank"><?php print home_url('?gogogo'); ?></a> 来运行该代码，运行完之后会显示 <strong>Done.</strong>。</p>
<p>另外，该方法会在 <em>functions.php</em> 同目录生成缓存文件 <em>ids.log</em>，在运行完之后可以删除。</p>
<h2>批量修改已记录的来源地址</h2>
<p>有些采集到的来源地址也是有问题的，需要修复后才能批量重新采集，可以在主题的 <em>functions.php</em> 里加入如下代码进行修改：</p>
<pre class="prism"><code class="language-php">if (isset($_GET['gogogo'])) {
	set_time_limit(0);
	add_action('init', function() {
		global $wpdb;
		$keyword = 'mini.eastday.com'; // 找出带有错误链接关键词的记录
		$sql = "SELECT `meta_id`,`meta_value` FROM `{$wpdb->postmeta}` WHERE `meta_key` = 'source-link' AND `meta_value` LIKE '%{$keyword}%'";
		$results = $wpdb->get_results($sql);
		if (!empty($results)) foreach ($results as $result) {
			// 使用正则将来源地址的"?"以及之后的内容删除
			$meta_value = preg_replace('/\?[^\?]*$/i', '', $result->meta_value);
			$sql = "UPDATE `{$wpdb->postmeta}` SET `meta_value`='{$meta_value}' WHERE `meta_id`={$result->meta_id}";
			$res = $wpdb->query($sql);
		}
		print 'Done.';
		exit;
	});
}</code></pre>
<p>然后用 <a href="<?php print home_url('?gogogo'); ?>" target="_blank"><?php print home_url('?gogogo'); ?></a> 来运行该代码，运行完之后会显示 <strong>Done.</strong>。</p>