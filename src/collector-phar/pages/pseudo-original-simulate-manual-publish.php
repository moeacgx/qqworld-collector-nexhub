<!-- Simulate Manual Publish start -->
<div class="nav-section">
	<table id="cron-list-table" class="wp-list-table widefat striped posts">
		<thead>
			<td class="manage-column column-cb check-column"></td>
			<th scope="col" class="manage-column column-primary"><?php _e('Post Types', $this->text_domain); ?></th>
			<th scope="col" class="manage-column"><?php _e('Taxonomies', $this->text_domain); ?></th>
			<th scope="col" class="manage-column"><?php _e('Post Status', $this->text_domain); ?></th>
			<th scope="col" class="manage-column"><?php _e('Publish Posts', $this->text_domain); ?></th>
			<th scope="col" class="manage-column"><?php _e('Recurrence', $this->text_domain); ?></th>
			<th scope="col" class="manage-column"><?php _e('Will Run On', $this->text_domain); ?></th>
			<th scope="col" class="manage-column"><?php _e('Delete'); ?></th>
		</thead>
		<?php $crons = $this->get_crons('qqworld-collector-pseudo-original-simulate-manual-publish'); ?>
		<tbody id="cron-list">
			<?php
 if (!empty($crons)) foreach ($crons as $cron) { $options = $cron['options']['args'][0]; $options['timestamp'] = wp_next_scheduled( 'qqworld-collector-pseudo-original-simulate-manual-publish', array($options) ); print $this->simulate_manual_publish->get_cron_table_row($options); } ?>
			<tr class="no-cron<?php if (!empty($crons)) print ' hidden'; ?>">
				<td colspan="12"><?php _e('No cron yet.', $this->text_domain); ?></td>
			</tr>
		</tbody>
	</table>
	<h3><?php _e('Create a Cron Task', $this->text_domain); ?></h3>
	<p><?php _e('Automatically search for the oldest articles pending review for publication to achieve the effect of simulating manual publication, which is conducive to SEO.', $this->text_domain); ?></p>
	<form action="">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="post-type"><?php _e('Post Types', $this->text_domain); ?></label></th>
					<td>
						<?php $post_types = get_post_types(array('public' => 1), 'objects'); ?>
						<select id="post-type" name="post_type" class="selectstyle">
						<?php foreach ($post_types as $name => $post_type) : $count = wp_count_posts($name); if (!in_array($name, array('attachment', 'revision', 'nav_menu_item') )) : $selected = $name == 'post' ? ' selected' : ''; ?>
							<option value="<?php echo $name; ?>"<?php print $selected; ?>><?php echo $post_type->labels->name; ?> (<?php print $count->publish; ?>)</option>
						<?php endif; endforeach; ?></select>
						<p class="description"><?php _e('Please select the post type you want to search and publish.', $this->text_domain) ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="taxonomies"><?php _e('Taxonomies', $this->text_domain); ?></label></th>
					<td>
						<div id="categories_block" class="terms_list_container"></div>
						<?php
 $this->the_switcher(array( 'id' => 'taxonomies-each', 'name' => 'each', 'value' => 0 )); ?>
						<p class="description"><?php _e('Each selected term publishes a specified number of posts.', $this->text_domain) ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="post-status"><?php _e('Select post status', $this->text_domain); ?></label></th>
					<td>
						<select id="post-status" name="post_status" class="selectstyle">
						<?php
 $post_statuses = get_post_statuses(); unset($post_statuses['publish']); unset($post_statuses['private']); foreach ($post_statuses as $post_status => $label) { $selected = $post_status == 'pending' ? ' selected' : ''; print '<option value="'.$post_status.'"'.$selected.'>'.$label.'</option>'; } ?>
						</select>
						<p class="description"><?php _e('Please select the post status you want to search and publish.', $this->text_domain) ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="order"><?php _e('Order', $this->text_domain); ?></label></th>
					<td>
						<select id="order" name="order" class="selectstyle">
							<option value="DESC"><?php _e('Descending', $this->text_domain); ?></option>
							<option value="ASC"><?php _e('Ascending', $this->text_domain); ?></option>
							<option value="rand"><?php _e('Random', $this->text_domain); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="publish-posts"><?php _e('Publish Posts', $this->text_domain); ?></label></th>
					<td>
						<input id="publish-posts" type="text" name="number" class="small-text" value="1" />
						<p class="descrpition"><?php _e('Please enter the number of posts to be published regularly, which can be an integer (1) or a range (1-3).', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="from"><?php _e('From', $this->text_domain); ?></label></th>
					<td>
						<input id="from" type="text" name="from" class="regular-text" value="<?php print get_date_from_gmt(date('Y-m-d H:i:s', strtotime('+5minutes'))); ?>" />
						<p class="descrpition"><?php _e('The execution time of the first task.', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="schedule"><?php _e('Start to', $this->text_domain); ?></label></th>
					<td>
						<select id="schedule" name="schedule" class="selectstyle">
						<?php
 $schedules = wp_get_schedules(); foreach ($schedules as $recurrence => $schedule) : ?>
							<option value="<?php echo $recurrence; ?>"><?php echo $schedule['display']; ?></option>
						<?php endforeach; ?>
						</select>
						<p class="descrpition"><?php _e('Please select the time interval to execute the cron task cyclically.', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="exclude-time"><?php _e('Exclude Time', $this->text_domain); ?></label></th>
					<td>
						<input id="exclude-time" type="text" name="exclude_time" value="23:00-08:00" placeholder="e.g. 23:00-08:00" />
						<p class="descrpition"><?php _e('Not released during the exclusion time period.', $this->text_domain); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<button type="button" class="button button-primary qc-icon add" id="add-a-cron-task"><?php _ex('Create a New Cron Task', 'cron', $this->text_domain); ?></button>
			<?php if (!empty($crons)) : ?><button type="button" class="button qc-icon delete" id="clear-all-crons"><?php _e('Clear All Crons', $this->text_domain); ?></button><?php endif; ?>
		</p>
	</form>
	<?php
 $failed_post_ids = get_transient( 'qqworld-collector-failed-post-ids' ); if ($failed_post_ids) : ?>
	<h3><?php _e('Posts that was not successfully published', $this->text_domain); ?></h3>
	<p><?php _e('Posts that were not published successfully for unknown reasons, please publish them manually.', $this->text_domain); ?></p>
	<table id="failed-posts-list-table" class="wp-list-table widefat striped posts">
		<thead>
			<td class="manage-column column-cb check-column"></td>
			<th scope="col" class="manage-column">ID</th>
			<th scope="col" class="manage-column column-primary"><?php _e('Title'); ?></th>
			<th scope="col" class="manage-column" style="width: 100px;"><?php _e('Post Type', $this->text_domain); ?></th>
			<th scope="col" class="manage-column" style="width: 100px;"><?php _e('Post Status', $this->text_domain); ?></th>
			<th scope="col" class="manage-column" style="width: 200px;"><?php _e('Post Date', $this->text_domain); ?></th>
		</thead>
		<?php
 foreach ($failed_post_ids as $post_id) : $post = get_post($post_id); if (isset($post->post_status) && in_array($post->post_status, array_keys($post_statuses))) : ?>
			<tr class="failed-posts-list">
				<th scope="row" class="check-column"></th>
				<td data-colname="ID"><?php print $post->ID; ?></td>
				<td class="column-primary" data-colname="<?php _e('Title'); ?>"><strong><a href="<?php print admin_url('post.php?post='.$post->ID.'&action=edit'); ?>" target="_blank"><?php print $post->post_title; ?></a></strong></td>
				<td data-colname="<?php _e('Post Type', $this->text_domain); ?>"><?php
 $post_type = get_post_type_object($post->post_type); print $post_type->label; ?></td>
				<td data-colname="<?php _e('Post Status', $this->text_domain); ?>"><?php
 $post_status = get_post_status_object($post->post_status); print $post_status->label; ?></td>
				<td data-colname="<?php _e('Post Date', $this->text_domain); ?>"><?php print $post->post_modified; ?></td>
			</tr>
		<?php endif; endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>
	<!--
	<h3><?php _e('Monitor Cron Tasks', $this->text_domain); ?></h3>
	<p><?php _e('Because of various problems, sometimes it will get stuck on a questionable article, which makes it impossible to continue the simulate manual publishing.<br />You can turn on monitoring, and if no new posts is released within the specified time, you will be notified by email.', $this->text_domain); ?></p>
	<form action="">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="monitor-schedule"><?php _e('Recurrence', $this->text_domain); ?></label></th>
					<td>
						<select id="monitor-schedule" name="schedule" class="selectstyle">
						<?php
 $schedules = wp_get_schedules(); foreach ($schedules as $recurrence => $schedule) : ?>
							<option value="<?php echo $recurrence; ?>"><?php echo $schedule['display']; ?></option>
						<?php endforeach; ?>
						</select>
						<p class="descrpition"><?php _e('Please select a time interval for monitoring.', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="monitor-email"><?php _e('E-Mail Address', $this->text_domain); ?></label></th>
					<td>
						<?php
 $users = get_users(array( 'role' => 'administrator', 'number' => 1 )); ?>
						<input type="email" id="monitor-email" name="mail-to" class="regular-text" value="<?php print $users[0]->user_email; ?>" />
						<button id="send-test-email" type="button" class="button qc-icon mail"><?php _e('Send Test E-Mail', $this->text_domain); ?></button>
						<p class="descrpition"><?php _e('Please enter your email address.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note that the email address here cannot be saved. The address of the first administrator is displayed by default. After setting the scheduled task, an email will be sent to the email address you set.', $this->text_domain); ?></span></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="monitor-exclude-time"><?php _e('Exclude Time', $this->text_domain); ?></label></th>
					<td>
						<input id="monitor-exclude-time" type="text" name="exclude_time" value="23:00-08:00" placeholder="e.g. 23:00-08:00" />
						<p class="descrpition"><?php _e('No monitoring during exclusion time.', $this->text_domain); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<?php $crons = $this->get_crons('qqworld-collector-pseudo-original-simulate-manual-publish-monitoring'); ?>
			<span<?php if (!empty($crons)) print ' class="hidden"'; ?>>
				<button type="button" class="button button-primary qc-icon add" id="start-monitoring"><?php _ex('Start Monitoring', 'cron', $this->text_domain); ?></button>
			</span>
			<span<?php if (empty($crons)) print ' class="hidden"'; ?>>
				<button type="button" class="button qc-icon delete" id="stop-monitoring"><?php _e('Stop Monitoring', $this->text_domain); ?></button><span class="spinner is-active" style="float: none; display: inline-block;"></span><strong style="vertical-align: -webkit-baseline-middle; color: #666;"><?php _e('Is monitoring...', $this->text_domain); ?><strong>
			</span>
		</p>
	</form>
	-->
</div>
<!-- Simulate Manual Publish end -->