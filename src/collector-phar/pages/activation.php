<div class="wrap" id="qqworld-collector-settings">
	<div id="qqworld-collector-notice" class="hidden notice is-dismissible notice-warning">
		<p class="help"><?php printf(__('After purchasing the %s, remember to <a href="%s" target="_blank">comment</a> within half a year and get %s of the points to redeem the coupon, Each order can be obtained once.', $this->text_domain), __('QQWorld Collector', $this->text_domain), 'https://www.qqworld.org/product/qqworld-collector#comments', '10%'); ?></p>
	</div>
	<?php
 $is_local_edition = apply_filters( 'qqworld-activation-is-local-edition', false ); $is_local = apply_filters( 'qqworld-activation-is-local', false); if ($is_local_edition) : ?>
		<div id="qqworld-collector-notice" class="notice is-dismissible notice-success">
			<p class="help"><?php _e('Welcome to the LAN mode of <strong>QQWorld Collector Deluxe</strong>.', $this->text_domain); ?></p>
		</div>
	<?php elseif ($is_local) : $ip = apply_filters( 'qqworld-collector-dnsgetgecordip', $_SERVER['SERVER_NAME']); ?><div id="qqworld-collector-notice" class="notice is-dismissible notice-error">
		<p class="help"><?php printf(__('The LAN site (%s) cannot be activated.', $this->text_domain), $ip); ?></p>
	</div><?php endif; ?>
	<h2 class="qc-icon medal"><?php _e('QQWorld Collector Deluxe', $this->text_domain); ?> - <?php _e('Product Activation', $this->text_domain); ?></h2>
	<p><?php _e("QQWorld Collector Deluxe is a WordPress universal cloud collecting plug-in that can customize the crawler and integrates many functions such as grab remote images, watermark and cloud storage. It is known as the golden goose by users. <br />Can collect the vast majority of websites, such as WeChat official account and TouTiao official account, etc. It doesn't matter if you could not make collection rules. You can request for free making!", $this->text_domain); ?></p>
	<figure id="banner-container">
		<img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/banner-772x250.jpg" width="772" height="250" id="banner" />
	</figure>

	<h2 id="qqworld-collector-nav-tab-wrapper" class="nav-tab-wrapper">
		<a href="#activation" class="nav-tab qc-icon unlock"><?php _e('Activation', $this->text_domain); ?></a>
		<a href="#shopping-guide" class="nav-tab qc-icon cart"><?php _e('Shopping Guide', $this->text_domain); ?></a>
		<a href="#save-money" class="nav-tab qc-icon seo"><?php _e('Save Money', $this->text_domain); ?></a>
		<a href="#upgrade" class="nav-tab qc-icon download"><?php _e('Upgrade', $this->text_domain); ?></a>
		<a href="#sdk" class="nav-tab qc-icon settings"><?php _e('Software Development Kit', $this->text_domain); ?></a>
		<a href="#environment" class="nav-tab qc-icon tree"><?php _e('Environment', $this->text_domain); ?></a>
		<a href="#edition-differences" class="nav-tab qc-icon diff"><?php _e('Edition Differences', $this->text_domain); ?></a>
		<a href="#customer-service" class="nav-tab qc-icon profile"><?php _e('Customer Service', $this->text_domain); ?></a>
	</h2>
	<!-- Activation - start -->
	<div class="nav-section">
		<?php do_action( 'qqworld-collector-activation-list' ); ?>
	</div>
	<!-- Activation - end -->
	<!-- Shopping Guide - start -->
	<div id="shopping-guide-container" class="nav-section hidden">
		<h1 align="center"><?php _e('Introduce Video', $this->text_domain); ?></h1>
		<p align="center"><?php printf(__('Redirect to youtube.com to view HD video, See the help documentation for more <a href="%s" target="_blank">video tutorials</a>. or go to <a href="%s" target="_blank">Tencent WeiYun</a> to download 1080p video.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#video-course--collecting'), 'https://share.weiyun.com/5oYlXvE'); ?></p>
		<div id="introduce-video-block">
			<section class="qqworld-aspect-ratio" data-ratio="16:10">
				<iframe src="<?php _e('https://www.youtube.com/embed/LtrQITIhScQ', $this->text_domain); ?>" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe>
			</section>
		</div>
		<h1 align="center"><?php _e('Why choose QQWorld Collector', $this->text_domain); ?></h1>
		<ul id="why-choose-list">
			<li>
				<figure class="svg thunder"></figure>
				<h2><?php _ex('Powerful', 'shopping guide', $this->text_domain); ?></h2>
				<p><?php _ex('Comparing with similar software in the market, it is difficult to find WP collector plug-in that can be comparable to QQWorld Collector.', 'shopping guide', $this->text_domain); ?></p>
			</li>
			<li>
				<figure class="svg money"></figure>
				<h2><?php _ex('Cheap Price', 'shopping guide', $this->text_domain); ?></h2>
				<p><?php _ex('Compared with some collection software, one set of QQWorld collector flagship edition can be purchased for a service fee of one year and used for a lifetime.', 'shopping guide', $this->text_domain); ?></p>
			</li>
			<li>
				<figure class="svg project"></figure>
				<h2><?php _e('Collection Project', $this->text_domain); ?></h2>
				<p><?php _ex('Advanced collection project <sup>&#9312;</sup> setting theory, has the rich help document and video tutorials for reference, any one can easily make collections of the simple project <sup>&#9312;</sup>, if encounter difficulties, please ask the customer service.', 'shopping guide', $this->text_domain); ?></p>
			</li>
			<li>
				<figure class="svg project"></figure>
				<h2><?php _ex('Free Shop', 'shopping guide', $this->text_domain); ?></h2>
				<p><?php _ex('Built-in collection project <sup>&#9312;</sup> store, contains a large number of collection project <sup>&#9312;</sup> available for free download, and continue to increase.', 'shopping guide', $this->text_domain); ?></p>
			</li>
			<li>
				<figure class="svg write"></figure>
				<h2><?php _ex('Free Write', 'shopping guide', $this->text_domain); ?></h2>
				<p><?php printf(_x('If collection project <sup>&#9312;</sup> is not included in the shop, buy the Master Edition or Ultimate Edition (not Basic Edition) users can free for help in the <a href="%s" target="_blank">account</a>.', 'shopping guide', $this->text_domain), 'https://www.qqworld.org/account/ask-for-help'); ?></p>
			</li>
			<li>
				<figure class="svg write"></figure>
				<h2><?php _ex('Pay to Write', 'shopping guide', $this->text_domain); ?></h2>
				<p><?php _ex('Basic Edition users can pay to customer service writing, will be charged according to the complexity of a certain fee, ranging from &#165;20 to &#165;50.', 'shopping guide', $this->text_domain); ?></p>
			</li>
		</ul>
		<p><?php _ex('Note: the collection project <sup>&#9312;</sup>, namely the acquisition rules, or web crawler.', 'shopping guide', $this->text_domain); ?>
		<h1 align="center"><?php _e('Edition Introduction', $this->text_domain); ?></h1>
		<p align="center"><?php printf(__("If you don't know how to choose, there is a smart shopping guide form program in the description of the <a href=\"%s\" target=\"_blank\">purchase page</a> to help you.", $this->text_domain), 'https://www.qqworld.org/product/qqworld-collector'); ?></p>
		<h3><?php _e('Functional Edition', $this->text_domain); ?></h3>
		<table class="wp-list-table widefat striped posts">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column"></td>
					<th class="manage-column column-primary"><?php _e('Edition', $this->text_domain); ?></th>
					<th class="manage-column"><?php _e('Description', $this->text_domain); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Cloud Storage Edition', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you only need the cloud storage function, please purchase the Cloud Storage Edition, which supports 6 kinds of cloud storage in China, as well as AWS S3, FTP, sina chart bed, etc. You can automatically delete local attachments after synchronization and establish the remote cloud media library.', 'shopping guide', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Professional Edition', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you only need to capture remote image and watermark function, please buy Professional Edition.', 'shopping guide', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Server Edition', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you need to capture remote images, watermarks, and cloud storage, buy the Server Edition.', 'shopping guide', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Website Master Edition', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you need to capture remote image, watermark and collection function, but do not need cloud storage, please buy Website Master Edition, can be timed batch collection of Tmall, WeChat public number, toutiao today and taobao toutiao most of the sites.', 'shopping guide', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Enterprise Edition', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you need to capture remote image, watermark, cloud storage and collection function, but do not need static cache, please buy Enterprise Edition, can be timed batch collection of Tmall, WeChat public number, toutiao today and taobao toutiao most of the sites.', 'shopping guide', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Ultimate Edition', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you want full functionality, buy the Ultimate Edition.', 'shopping guide', $this->text_domain); ?></td>
				</tr>
			</tbody>
		</table>
		<h3><?php _e('General Differences', $this->text_domain); ?></h3>
		<p><?php _e('Related to site type and number of active domains, The following is the difference between the general activation mode of <strong>Subscription License</strong> and <strong>Permanent License</strong>.', $this->text_domain); ?></p>
		<table class="wp-list-table widefat striped posts">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column"></td>
					<th class="manage-column column-primary" style="width: 150px;"><?php _e('Title'); ?></th>
					<th class="manage-column"><?php _e('Basic Edition', $this->text_domain); ?></th>
					<th class="manage-column"><?php _e('Single Site Edition', $this->text_domain); ?></th>
					<th class="manage-column"><?php _e('Multisite Edition', $this->text_domain); ?></th>
					<th class="manage-column"><?php _e('Unlimited Edition', $this->text_domain); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Verification Method', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php _e('Top Level Domain', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php _e('Top Level Domain', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php _e('Top Level Domain', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('Top Level Domain', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Activating Quantity', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>">1<?php _e(' (Include Subdomain)', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>">1<?php _e(' (Include Subdomain)', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>">1<?php _e(' (Include Subdomain)', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('Unlimited', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Free Writing Rules', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php _e('None'); ?></td>
					<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php printf(_n('%d time / day', '%d times / day', 1, $this->text_domain), 1); ?></td>
					<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php printf(_n('%d time / day', '%d times / day', 4, $this->text_domain), 4); ?></td>
					<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php printf(_n('%d time / day', '%d times / day', 5, $this->text_domain), 5); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Suitable for', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php _e('Start-up Webmaster', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php _e('Webmaster', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php _e('Company', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('Company &amp; Big Webmaster', $this->text_domain); ?></td>
				</tr>
			</tbody>
		</table>
		<h3><?php _e('Website Edition', $this->text_domain); printf(__(' (%s)', $this->text_domain), __('Subscription License', $this->text_domain)); ?></h3>
		<p><?php _e('Subscription license, renewal is required upon expiration, but domain names can be changed indefinitely. The following table will help you choose the activation mode that suits your website under the subscription authorization.', $this->text_domain); ?></p>
		<table class="wp-list-table widefat striped posts">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column"></td>
					<th class="manage-column column-primary" style="width: 150px;"><?php _e('Title'); ?></th>
					<th class="manage-column"><?php _e('Basic Edition', $this->text_domain); ?></th>
					<th class="manage-column"><?php _e('Single Site Edition', $this->text_domain); ?></th>
					<th class="manage-column"><?php _e('Multisite Edition', $this->text_domain); ?></th>
					<th class="manage-column"><?php _e('Unlimited Edition', $this->text_domain); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Change Domain', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php _e('Unlimited', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php _e('Unlimited', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php _e('Unlimited', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('Unlimited', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('License Date', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php printf(_n('%d month', '%d months', 3, $this->text_domain), 3); ?></td>
					<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php printf(_n('%d year', '%d years', 1, $this->text_domain), 1); ?></td>
					<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php printf(_n('%d year', '%d years', 1, $this->text_domain), 1); ?></td>
					<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php printf(_n('%d year', '%d years', 1, $this->text_domain), 1); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Buying Advice', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php _e('If you only want short-term applications, please purchase this version.', $this->text_domain)?></td>
					<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php _e('If you need to change the domain name frequently and serve many websites, please purchase this version.', $this->text_domain)?></td>
					<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php printf(_x('If your site is <a href="%s" target="_blank" rel="noopener">Multi-Site mode</a>, please purchase this edition, just activate the main site domain name, unlimited sub site available.', 'shopping guide', $this->text_domain), 'https://www.qqworld.org/archives/5426'); ?></td>
					<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('If you have more than 4 websites, please purchase an unlimited version to activate unlimited domain names across servers.', $this->text_domain); ?></td>
				</tr>
			</tbody>
		</table>
		<h3><?php _e('Website Edition', $this->text_domain); printf(__(' (%s)', $this->text_domain), __('Permanent License', $this->text_domain)); ?></h3>
		<p><?php _e('Permanent license, no expiration, but paid to change the domain name. The form below will help you choose the activation mode that suits your site under a permanent license.', $this->text_domain); ?></p>
		<table class="wp-list-table widefat striped posts">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column"></td>
					<th class="manage-column column-primary" style="width: 150px;"><?php _e('Title'); ?></th>
					<th class="manage-column"><?php _e('Basic Edition', $this->text_domain); ?></th>
					<th class="manage-column"><?php _e('Single Site Edition', $this->text_domain); ?></th>
					<th class="manage-column"><?php _e('Multisite Edition', $this->text_domain); ?></th>
					<th class="manage-column"><?php _e('Unlimited Edition', $this->text_domain); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Change Domain', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php printf(__('You must unlock to change your domain name (%s of unit price)', $this->text_domain), '40%'); ?></td>
					<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php printf(__('%s times, Excessive need to unlock (%s of unit price, same as the unlock price of Basic Edition)', $this->text_domain), '5', '20%'); ?></td>
					<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php printf(__('%s times, Excessive need to unlock (%s of unit price)', $this->text_domain), '5', '20%'); ?></td>
					<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('Unlimited', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('License Date', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php _e('Permanent', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php _e('Permanent', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php _e('Permanent', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('Permanent', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary">
						<strong><?php _e('Buying Advice', $this->text_domain); ?></strong>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php _e('Suitable for single sites, If you do not need to change domain names frequently, please purchase this edition.', $this->text_domain)?></td>
					<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php _e("If you don't have a lot of websites, but you may want to change your domain more frequently, please purchase this edition.", $this->text_domain)?></td>
					<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php printf(_x('If your site is <a href="%s" target="_blank" rel="noopener">Multi-Site mode</a>, please purchase this edition, just activate the main site domain name, unlimited sub site available.', 'shopping guide', $this->text_domain), 'https://www.qqworld.org/archives/5426'); ?></td>
					<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('If you have more than 4 websites, please purchase an unlimited version to activate unlimited domain names across servers.', $this->text_domain); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- Shopping Guide - end -->
	<!-- Save Money - start -->
	<div id="promote-container" class="nav-section hidden">
		<h1><?php _e('Group Purchase', $this->text_domain); ?></h1>
		<p><?php _e('You can buy product like PinDuoDuo in the purchase page. But if it is urgent please do not open group, suggest you and friends together to buy.', $this->text_domain); ?></p>
		<h1><?php _e('Promote Earning Points', $this->text_domain); ?></h1>
		<p><?php _e('By promoting earning points, points can be exchanged for coupons, used to purchase new license or upgrade editions, and even withdraws.', $this->text_domain); ?></p>
		<h2>1. <?php _e('Promotion Through Link', $this->text_domain); ?></h2>
		<p><?php _e('Regardless of whether or not to buy products can be promoted, but can only be promoted to new registered users, and all products purchased by new users who have been registered by your promotion will give you points.', $this->text_domain); ?> (10%-20%)</p>
		<p class="qc-icon info"><strong><?php _e('For example: if you promote users buy a 499 yuan item, you will get 4990 points to redeem 49.9 yuan coupon.', $this->text_domain); ?></strong></p>
		<p><img src="https://www.qqworld.org/wp-content/uploads/images/temp/link-promotion.png" /></p>
		<p><a href="https://www.qqworld.org/account/points/#promotion" class="button button-primary qc-icon link"><?php _e('Get my promotion link', $this->text_domain); ?></a></p>
		<h2>2. <?php _e('Promotion Through Coupon', $this->text_domain); ?></h2>
		<p><?php printf(__('Only users who have purchased Unlimited Edition have exclusive coupon. Any orders that use your coupon will give you %s of the points reward.', $this->text_domain), '10%'); ?></p>
		<!--<p><img src="https://www.qqworld.org/wp-content/uploads/2021/05/coupon-promotion.png" /></p>-->
		<p><a href="https://www.qqworld.org/account/points/#coupon-promotion" class="button button-primary qc-icon link"><?php _e('Get my exclusive coupon', $this->text_domain); ?></a></p>
	</div>
	<!-- Save Money - end -->
	<!-- Upgrade - start -->
	<div class="nav-section hidden">
		<?php do_action( 'qqworld-collector-upgrade-page' ); ?>
		<h3><?php _e('Manual Upgrade', $this->text_domain); ?></h3>
		<p><?php _e('Please download the latest version from the fastest network disk.', $this->text_domain); ?></p>
		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<th scope="col" class="manage-column column-primary"><?php _e('QQWorld Project Network Disk', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Baidi Network Disk', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('LanzouYun', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Microsoft OneDrive', $this->text_domain); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td data-colname="<?php _e('QQWorld Project Network Disk', $this->text_domain); ?>" class="column-primary"><a href="https://pan.qqworld.org/QQWorld%E6%94%B6%E8%97%8F%E5%AE%B6%E8%B1%AA%E5%8D%8E%E7%89%88" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Download', $this->text_domain); ?></a><button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show detail'); ?></span></button></td>
					<td data-colname="<?php _e('Baidi Network Disk', $this->text_domain); ?>"><a href="https://pan.baidu.com/s/161RZyGiZa8ooo6lfVOUjBQ" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Download', $this->text_domain); ?></a> <?php ?></td>
					<td data-colname="<?php _e('LanzouYun', $this->text_domain); ?>"><a href="https://qqworld.lanzoui.com/b020h5vwd" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Download', $this->text_domain); ?></a> <?php printf(_x('Password: %s', 'lanzou', $this->text_domain), '3gl6'); ?></td>
					<td data-colname="<?php _e('Microsoft OneDrive', $this->text_domain); ?>"><a href="https://1drv.ms/u/s!AsNzbb2xx8DUiVgSQbEqnCD0NNTL?e=Mss1P0" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Download', $this->text_domain); ?></a></td>
				</tr>
			</tbody>
		</table>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for=""><?php _e('How to Upgrade', $this->text_domain); ?></th>
					<td>
					<p><?php _e("The easy way is to delete the plugin, upload the zip package in the plugins page to automatically install the plugin.<br />Don't worry, it will not lose any data.", $this->text_domain); ?></p>
					<?php
 $plugin_url = is_multisite() ? admin_url('network/plugins.php') : admin_url('plugins.php'); $add_plugin_url = is_multisite() ? admin_url('network/plugin-install.php') : admin_url('plugin-install.php'); ?>
					<p><strong><?php _e('Details', $this->text_domain); ?></strong></p>
					<ol class="how-to-upgrade">
						<li><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/upgrade/1.png" /><p><?php printf(_x('<a href="%s" target="_blank">Download</a> zip file of new version.', 'update plugin', $this->text_domain), 'https://pan.baidu.com/s/161RZyGiZa8ooo6lfVOUjBQ'); ?></p></li>
						<li><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/upgrade/2.png" /><p><?php printf(_x('<a href="%s" target="_blank">Deactivate and delete</a> the QQWorld Collector.', 'update plugin', $this->text_domain), $plugin_url); ?></p></li>
						<li><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/upgrade/3.png" /><p><?php printf(_x('<a href="%s" target="_blank">Upload and install</a> the new version.', 'update plugin', $this->text_domain), $add_plugin_url); ?></p></li>
						<li><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/upgrade/4.png" /><p><?php printf(_x('<a href="%s" target="_blank">Activate</a> the QQWorld Collector.', 'update plugin', $this->text_domain), admin_url('plugins.php')); ?></p></li>
						<li><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/upgrade/5.png" /><p><?php printf(_x('<a href="%s" target="_blank">Activate</a> the Product of QQWorld Collector.', 'update plugin', $this->text_domain), admin_url('admin.php?page=qqworld-collector')); ?></p></li>
					</ol>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- Upgrade - end -->
	<!-- Software Development Kit - start -->
	<div class="nav-section hidden">
		<p><?php _e('The following functions work only after the Software Development Kit (SDK) is installed.', $this->text_domain); ?><br /><span class="qc-icon info"><?php _e('Note that only the active licensed version will see the SDK list and install automatically.', $this->text_domain) ?></span></p>
		<table id="sdk-table" class="wp-list-table widefat striped plugins">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column"></td>
					<th scope="col" class="manage-column column-primary"><strong><?php _e('Name', $this->text_domain); ?></strong></th>
					<th scope="col" class="manage-column"><?php _e('Status', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Automatic Installation', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Manual Installation', $this->text_domain); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php
 $sdks = array( 'collection-project' => array( 'label' => __('Collection Project', $this->text_domain), 'items' => array() ), 'cloud-storage' => array( 'label' => __('Cloud Storage', $this->text_domain), 'items' => array() ), 'artificial-intelligence' => array( 'label' => __('Artificial Intelligence', $this->text_domain), 'items' => array() ), 'translate' => array( 'label' => __('Translate', $this->text_domain), 'items' => array() ) ); $sdks = apply_filters( 'qqworld-collector-sdks', $sdks ); foreach ($sdks as $sdk) : ?>
				<tr class="label"><th colspan="5"><?php print $sdk['label']; ?></th></tr>
				<?php if (count($sdk['items'])) : foreach ($sdk['items'] as $item) : $installed = file_exists($item['path']); ?>
				<tr class="<?php print $installed ? 'active' : 'uninstalled'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Name', $this->text_domain); ?>" class="column-primary"><strong><?php print $item['label']; ?></strong></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php print $installed ? '<span class="install yes">' . __('Installed', $this->text_domain) . '</span>' : '<span class="install no">' . __('Not Installed', $this->text_domain) . '</span>'; ?></td>
					<td data-colname="<?php _e('Automatic Installation', $this->text_domain); ?>"><button data-url="<?php print $item['download']; ?>" data-path="<?php print $item['path']; ?>" data-extract="<?php print $item['extract'] ? 1 : 0; ?>" type="button" class="install-sdk button-primary qc-icon download"><?php _e('Install Now', $this->text_domain); ?></button></td>
					<td data-colname="<?php _e('Manual Installation', $this->text_domain); ?>"><?php print $item['manual']; ?></td>
				</tr>
					<?php endforeach; else: ?>
				<tr class="active"><th scope="row" class="check-column"></th><td colspan="4" class="text-aligncenter"><?php _e('No installable Software Development Kit (SDK)', $this->text_domain); ?></td></tr>
				<?php endif; endforeach; ?>
			</tbody>
		</table>
	</div>
	<!-- Software Development Kit - end -->
	<!-- Environment - start -->
	<div class="nav-section hidden">
		<p><?php _e('This table will tell you the operating environment that this plug-in needs.', $this->text_domain); ?><br />
		<span class="qc-icon info"><?php _e('Note that the importance of medium and below is not necessarily required. Please read clearly to determine if your website needs to be opened.', $this->text_domain); ?></span></p>
		<table id="environment-list-table" class="wp-list-table widefat striped plugins">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column"></td>
					<th scope="col" class="manage-column column-primary"><?php _e('Title'); ?></th>
					<th scope="col" class="manage-column"><?php _e('Description', $this->text_domain); ?></th>
					<th scope="col" class="manage-column" style="width: 80px;"><?php _e('Importance', $this->text_domain); ?></th>
					<th scope="col" class="manage-column" style="width: 80px;"><?php _e('Status', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _ex('Method', 'environment', $this->text_domain); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td class="manage-column column-cb check-column"></td>
					<th scope="col" class="manage-column column-primary"><?php _e('Title'); ?></th>
					<th scope="col" class="manage-column"><?php _e('Description', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Importance', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _e('Status', $this->text_domain); ?></th>
					<th scope="col" class="manage-column"><?php _ex('Method', 'environment', $this->text_domain); ?></th>
				</tr>
			</tfoot>
			<tbody id="the-environment">
				<?php do_action('qqworld-collector-environment-list-before'); ?>
				<?php $is_supported = version_compare(phpversion(), '7.3', '>='); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('PHP Version', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php printf(__('Plugin must run on PHP %s or higher.', $this->text_domain), 7.3); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance veryhigh"><span><?php _e('Very High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Upgrade PHP to at least version %s (Current: %s).', $this->text_domain), 7.3, phpversion()); ?></td>
				</tr>
				<?php
 if (!apply_filters( 'qqworld-activation-is-ultimate-edition', false)) : $home_domain = parse_url(home_url(), PHP_URL_HOST); $site_domain = parse_url(site_url(), PHP_URL_HOST); if ($home_domain && $site_domain) : $is_supported = $home_domain == $site_domain; if (!$is_supported) : ?><tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Home URL &amp; Site URL', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php printf(__('<strong>%s</strong> <em>(%s)</em> and <strong>%s</strong> <em>(%s)</em> must be exactly the same.', $this->text_domain), __('WordPress Address (URL)'), $home_domain, __('Site Address (URL)'), $site_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance veryhigh"><span><?php _e('Very High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Go to modify the <a href="%s" target="_blank">general settings</a>.', $this->text_domain), is_multisite() ? network_admin_url('site-settings.php?id='.get_current_blog_id()) : admin_url('options-general.php')); ?></td>
				</tr><?php endif; endif; endif; ?>
				<?php
 if (!apply_filters('qqworld-collector-activated', false) && !get_option('permalink_structure')) : ?>
				<tr class="unsupported">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _ex('Rewrite', 'activation', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Very few themes require rewrite to activate a copy of the plugin.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance midium"><span><?php _e('Midium', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php _e('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Set the <a href="%s" target="_blank">permalink</a> structure, don\'t choose <strong>plain</strong>.', $this->text_domain), admin_url('options-permalink.php')); ?></td>
				</tr>
				<?php
 endif; $free_edition_path = 'qqworld-auto-save-images/qqworld-auto-save-images.php'; $is_supported = !is_plugin_active( $free_edition_path ); if (!$is_supported) : deactivate_plugins( $free_edition_path ); ?><tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Plugin Conflict', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Cannot be enabled at the same time as the free version.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance high"><span><?php _e('Very High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php _e('Disable or delete QQWorld auto save images.', $this->text_domain); ?></td>
				</tr><?php endif; ?>
				<?php
 ?>
				<?php
 list($num_cpus, $num_threads) = $this->num_cpus(); $is_supported = $num_cpus!=1 || ($num_threads!=1 && $num_threads!=0); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Number of CPU Core', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Collecting images is very resource intensive, Single-core CPUs tend to cause server stalls during acquisition.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance midium"><span><?php _e('Midium', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__("The number of cores for upgrading the CPU is at least 2. (Current server's cpu core number: %d, Threads: %d)", $this->text_domain), $num_cpus, $num_threads); if(!$is_supported) : ?><br /><span class="qc-icon info"><?php _e('The detection results are for reference only and may not be compatible with all systems. If the server is confirmed to be multi-core, it can be ignored.', $this->text_domain); ?></span><?php endif; ?></td>
				</tr>
				<?php
 list($totalphymem, $freephymem, $usedphymem) = $this->get_memory(); if ($totalphymem) : $is_supported = $totalphymem >= 1024; ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Physical Memory', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Too small a memory can cause the plugin to not work properly.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance high"><span><?php _e('High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__("Expand server memory capacity to more than 1GB. (Current : %s GB)", $this->text_domain), round($totalphymem/1024, 2)); ?></td>
				</tr><?php endif; ?>
				<?php $is_supported = class_exists('Memcache'); ?>
				<tr class="hidden <?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary">Memcached</td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Memcached is a free and open source, high performance, distributed memory object caching system.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance low"><span><?php _e('Low', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'Memcached'); ?></td>
				</tr>
				<?php $is_supported = function_exists('opcache_compile_file') && ini_get('opcache.enable') == 1; ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary">OPcache</td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('OPcache improves PHP performance by storing precompiled script bytecode in shared memory, thereby removing the need for PHP to load and parse scripts on each request.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance veryhigh"><span><?php _e('Very High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules and set <strong>opcache.enable</strong> in <em>php.ini</em> to 1.', $this->text_domain), 'OPcache'); ?><br /><span class="qc-icon info"><?php printf(__('After installation, it is recommended to optimize the parameters of OPCache, please refer to the <a href="%s" target="_blank">document</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#tips--zend-opcache')); ?></span></td>
				</tr>
				<?php $is_supported = function_exists('curl_init'); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary">cURL</td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('cURL is a file transfer tool that works under the command line using URL syntax to collect remote attachments or web pages.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance veryhigh"><span><?php _e('Very High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'cURL'); ?></td>
				</tr>
				<?php $is_supported = function_exists('file_get_contents') && ini_get('allow_url_fopen') == 1; ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('File System Functions', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Collect remote attachments or web pages.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance veryhigh"><span><?php _e('Very High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php _e('Please Make sure the server configuration <strong>allow_url_fopen=1</strong> in php.ini.', $this->text_domain); ?></td>
				</tr>
				<?php $is_supported = function_exists('openssl_encrypt'); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('OpenSSL', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Used to grab ssl(https) links.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance veryhigh"><span><?php _e('Very High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'OpenSSL'); ?></td>
				</tr>
				<?php ?>
				<!--<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Server Default Time Zone', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('It must be set to 0 time zone (UTC), otherwise it will cause the post date to be messed up or the scheduled task to fail.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance veryhigh"><span><?php _e('Very High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Set default time zone to 0 (UTC).', $this->text_domain), 'xmlrpc'); ?></td>
				</tr>-->
				<?php $is_supported = function_exists('xmlrpc_encode_request'); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Extensible Markup Language-Remote Procedure Call', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Remote publishing for Wordpress.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance midium"><span><?php _e('Midium', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'xmlrpc'); ?></td>
				</tr>
				<?php $is_supported = extension_loaded('gd'); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary">GD</td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('A GD image function library that processes images.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance high"><span><?php _e('High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'GD2'); ?></td>
				</tr>
				<?php $is_supported = class_exists('Imagick'); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('ImageMagick high performance graphics library', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Convert webp, jfif and bmp image types to other image format.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance high"><span><?php _e('High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'imageMagick'); ?></td>
				</tr>
				<?php if ($is_supported) : $formats = Imagick::queryFormats(); $is_supported = in_array('WEBP', $formats); if (!$is_supported) : ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('WEBP format support of ImageMagick', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Convert webp image type to other image format.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance high"><span><?php _e('High', $this->text_domain); ?></span></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php _e('WEBP format is not supported, it is recommended to reinstall Imagemagick or change PHP version.', $this->text_domain); ?><br /><span class="qc-icon info"><?php printf(__('The BT Panel no longer supports WEBP, please see the <a href="%s" target="_blank">solution</a>.', $this->text_domain), admin_url('admin.php?page=qqworld-collector-documents#tips--auto-save-attachments--gd-webp')); ?></span></td>
					</tr>
				<?php endif; else : ?>
					<?php $is_supported = function_exists('imagecreatefromwebp'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('WEBP library', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Convert webp image type to jpg.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance midium"><span><?php _e('Midium', $this->text_domain); ?></span></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Upgrade PHP to at least version %s', $this->text_domain), 5.5); ?><br /><?php _e('Notice: The BaoTa panel does not compile the WEBP module, even if the version matches.', $this->text_domain); ?></td>
					</tr>
					<?php $is_supported = function_exists('imagecreatefrombmp'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary">BMP</td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Convert bmp image type to jpg.', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance midium"><span><?php _e('Midium', $this->text_domain); ?></span></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php
 if (version_compare(PHP_VERSION, '7.2.0', '>=')) { printf(__('Upgrade PHP to at least version %s', $this->text_domain), 7.2); } else { printf(__('Your php version is lower than 7.2.0, so you are using an unofficial BMP handler.', $this->text_domain), 7.2); } ?></td>
					</tr>
				<?php endif; ?>
				<?php $is_supported = function_exists('finfo_open'); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('File Infomation', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('This is a module required for auto save attachment and cloud storage.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance veryhigh"><span><?php _e('Very High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'fileinfo'); ?></td>
				</tr>
				<?php $is_supported = function_exists('mb_convert_encoding'); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Conversion Character Encoding', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Convert HTML to UTF8 encoding during collection.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance veryhigh"><span><?php _e('Very High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'mbstring'); ?></td>
				</tr>
				<?php $backtrack_limit = ini_get('pcre.backtrack_limit'); $is_supported = $backtrack_limit == -1; ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Regular Expression Limit', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Use regular expressions to collect large contents of the article content.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance verylow"><span><?php _e('Very Low', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Change the <em>%s</em> value in php.ini to %s, current value is %s.', $this->text_domain), 'pcre.backtrack_limit', '-1', $backtrack_limit); ?></td>
				</tr>
				<?php if (apply_filters( 'qqworld-collector-activated-module-cloud-storage', false )) : ?>
					<?php $is_supported = function_exists('ftp_connect'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('FTP', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Use <strong>Cloud Storage</strong> -&gt; <strong>FTP</strong> -&gt; <strong>FTP</strong> type.', $this->text_domain); ?><p><em class="qc-icon info"><?php _e('Note that most users do not need this feature.', $this->text_domain); ?></em></p></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance low"><span><?php _e('Low', $this->text_domain); ?></span></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'ftp'); ?></td>
					</tr>
					<?php $is_supported = function_exists('ssh2_connect'); ?>
					<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
						<th scope="row" class="check-column"></th>
						<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('SSH2', $this->text_domain); ?></td>
						<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Use <strong>Cloud Storage</strong> -&gt; <strong>FTP</strong> -&gt; <strong>SFTP over SSH</strong> type.', $this->text_domain); ?><p><em class="qc-icon info"><?php _e('Note that most users do not need this feature.', $this->text_domain); ?></em></p></td>
						<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance low"><span><?php _e('Low', $this->text_domain); ?></span></td>
						<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
						<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Install the <em>%s</em> of php modules', $this->text_domain), 'ssh2'); ?></td>
					</tr>
				<?php endif; ?>
				<?php $is_supported = intval(ini_get('memory_limit')) > 128; ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Memory Limit', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e("Running this plugin requires a lot of memory, and the server's default memory limit parameter is too small and can cause fatal errors.", $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance high"><span><?php _e('High', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Set <strong>%s</strong> in <em>php.ini</em> to <strong>%s</strong> or <strong>%s</strong>.', $this->text_domain), 'memory_limit', '256M', '1024M'); ?></td>
				</tr>
				<?php
 $wp_config = file_get_contents(ABSPATH . 'wp-config.php'); $is_supported = preg_match('/WP_MEMORY_LIMIT/i', $wp_config); ?>
				<tr class="hidden <?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Memory Limit of PHP', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Specify the maximum amount of memory that can be consumed by PHP, Prevent certain programs from causing Wordpress to run out of memory..', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance verylow"><span><?php _e('Very Low', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>">
						<?php _e("Add <strong>define( 'WP_MEMORY_LIMIT', '256M' );</strong> into the front of the content of <em>wp-config.php</em>.<br />Note: If you need to run a very complex program, such as collecting video and uploading it to cloud storage, don't add this item, which will cause the thread to run out of memory and fail.", $this->text_domain); ?>
					</td>
				</tr>
				<?php
 $upload_max_filesize = ini_get('upload_max_filesize'); $is_supported = intval($upload_max_filesize) > 99 || strstr($upload_max_filesize, 'G'); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Upload Max Filesize', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('If your attachment file size is large, you may not be able to upload it to the media library or cloud storage.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance verylow"><span><?php _e('Low', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Change the <em>upload_max_filesize</em> value in php.ini to 100M, current value is %s.', $this->text_domain), $upload_max_filesize); ?></td>
				</tr>
				<?php
 $max_input_vars = ini_get('max_input_vars'); $is_supported = $max_input_vars > 5000; ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Max Input Variable', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('The maximum number of variables that can be used in the form, if the collection project you created is too complex, exceeding the form item limit will result in an inability to save.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance verylow"><span><?php _e('Very Low', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Change the <em>max_input_vars</em> value in php.ini to 10000 or more, current value is %d.', $this->text_domain), $max_input_vars); ?></td>
				</tr>
				<?php
 $ini = ini_get('open_basedir'); $is_supported = empty($ini); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('File Operations Base Directory', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('The directory synchronization site resource could not be scanned in the cloud storage.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance low"><span><?php _e('Low', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php _e('Clear the value of <strong>open_basedir</strong> in php.ini, or in .htaccess or .user.ini in the root of the website.<br />For example, in the Pagoda panel, there is a website setting called <strong>Preventing Cross-Site Attacks</strong> that automatically generates this setting to <em>.user.ini</em>.', $this->text_domain); ?></td>
				</tr>
				<!--<?php $is_supported = !class_exists('Redis'); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Remote Dictionary Server (Redis)', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Open source database caching may cause data delay and is not suitable for frequently updated websites.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance low"><span><?php _e('Low', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Uninstall %s.', $this->text_domain), __('Remote Dictionary Server (Redis)', $this->text_domain)); ?></td>
				</tr>
				<?php $is_supported = !class_exists('Memcache'); ?>
				<tr class="<?php print $is_supported ? 'active' : 'unsupported'; ?>">
					<th scope="row" class="check-column"></th>
					<td data-colname="<?php _e('Title'); ?>" class="column-primary"><?php _e('Memcached', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Description', $this->text_domain); ?>"><?php _e('Open source database caching may cause data delay and is not suitable for frequently updated websites.', $this->text_domain); ?></td>
					<td data-colname="<?php _e('Importance', $this->text_domain); ?>" class="importance low"><span><?php _e('Low', $this->text_domain); ?></span></td>
					<td data-colname="<?php _e('Status', $this->text_domain); ?>"><?php
 print $is_supported ? __('Supported', $this->text_domain) : __('Unsupported', $this->text_domain); ?></td>
					<td data-colname="<?php _ex('Method', 'environment', $this->text_domain); ?>"><?php printf(__('Uninstall %s.', $this->text_domain), __('Memcached', $this->text_domain)); ?></td>
				</tr>-->
				<?php do_action('qqworld-collector-environment-list-after'); ?>
			</tbody>
		</table>
	</div>
	<!-- Environment - end -->
	<!-- Edition Differences - start -->
	<div class="nav-section hidden">
		<table id="product-info" class="wp-list-table widefat striped posts">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column"></td>
					<th class="manage-column column-primary"><?php _ex('Feature Description', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Master Edition', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Server Edition', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Professional Edition', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td class="manage-column column-cb check-column"></td>
					<th class="manage-column column-primary"><?php _ex('Feature Description', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Master Edition', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Server Edition', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Professional Edition', 'activation', $this->text_domain); ?></th>
					<th class="manage-column aligncenter"><?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?></th>
				</tr>
			</tfoot>
			<tbody>
				<tr class="priceRowTop">
					<th scope="row" class="check-column"></th>
					<td class="column-primary"></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>249.00</span>'); ?></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>199.00</span>'); ?></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>149.00</span>'); ?></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>99.00</span>'); ?></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>65.00</span>'); ?></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>49.00</span>'); ?></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary qc-svg collection">
						<strong><?php _e('Collection Project', $this->text_domain); ?></strong>
						<ol>
							<li><?php _e('Self-built collection project, set collection rules, using object-oriented programming compared to 2.x, it is very convenient to collect AJAX loaded pages and filter any collected content.', $this->text_domain); ?></li>
							<li><?php _e('Manual collection, you can select the posts to be collected, you can collect them by importing archive links or singular post links.', $this->text_domain); ?></li>
							<li><?php _e('Automatically collect, set up scheduled tasks, and let the website automatically collect posts.', $this->text_domain); ?></li>
							<li><?php _e('A template that automatically adds a header template and a footer template to the collected posts in the collection project.', $this->text_domain); ?></li>
							<li><?php _e('Collection project store with video tutorials. You can purchase collection project directly.', $this->text_domain); ?></li>
							<li><?php _e('Basically, as long as it is not a digital signature encrypted website, it can be collected.', $this->text_domain); ?></li>
						</ol>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Master Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary qc-svg attachments">
						<strong><?php _e('Auto Save Attachment', $this->text_domain); ?></strong>
						<ol>
							<li><?php _e('Support for new editors of Wordpress 5.0.', $this->text_domain); ?></li>
							<li><?php _e('Automatically save remote attachments, as long as the file format allowed by the Wordpress media library can be crawled.', $this->text_domain); ?></li>
							<li><?php _e('Format the HTML code of the collected remote image.', $this->text_domain); ?></li>
							<li><?php _e('You can not use the media library.', $this->text_domain); ?></li>
							<li><?php _e('Scan the post to automatically save remote attachments from the old post to local.', $this->text_domain); ?></li>
							<li><?php _e('Set up scheduled tasks to scan posts.', $this->text_domain); ?></li>
							<li><?php _e('Set thumbnail crop position.', $this->text_domain); ?></li>
						</ol>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Master Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary qc-svg watermark">
						<strong><?php _e('Watermark', $this->text_domain); ?></strong>
						<ol>
							<li><?php _e('Both image watermark and text watermark are supported.', $this->text_domain); ?></li>
							<li><?php _e('Scan the media library to watermark the image.', $this->text_domain); ?></li>
						</ol>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Master Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary qc-svg translate">
						<strong><?php _e('Translate', $this->text_domain); ?></strong>
						<ol>
							<li><?php _e("You can use Baidu translation, Google free translation, Google translation and Simplified and Traditional chinese to translate the content of the article automatically or manually.", $this->text_domain); ?></li>
							<li><?php _e('Support automatic translation, manual translation or translation at the time of collection.', $this->text_domain); ?></li>
							<li><?php _e('Automatically translate post name.', $this->text_domain); ?></li>
						</ol>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Master Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary qc-svg cloud-storage">
						<strong><?php _e('Cloud Storage', $this->text_domain); ?></strong>
						<p class="description"><?php _e("A domain that serves no cookies. The idea here is that you use a cookie-free domain to serve images, CSS files, scripts and whatnot, so that your users don't waste time and bandwidth transmitting cookies for them.", $this->text_domain); ?></p>
						<ol>
							<li><?php _e('JoinMode of cloud storage.', $this->text_domain); ?></li>
							<li><?php _e("Cookie-free domain: use the local server save attachments, the idea here is that you use a cookie-free domain to serve images, CSS files, scripts and whatnot, so that your users don't waste time and bandwidth transmitting cookies for them.", $this->text_domain); ?></li>
							<li><?php _e('Controllable Cloud Storage: FTP, Aliyun OSS, QiNiu Cloud Storage, UpYun Cloud Storage, Tencent COS, Baidu BOS, UCloud UFile Storage. Most of these cloud storage require payment, but data security is higher.', $this->text_domain); ?></li>
							<li><?php _e('Others Cloud Storage: Sina images storage, SM.MS etc. These cloud storage are free, but the resources are less controllable and have the potential to be lost.', $this->text_domain); ?></li>
						</ol>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Master Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary qc-svg proxy">
						<strong><?php _e('Proxy', $this->text_domain); ?></strong>
						<ol>
							<li><?php _e("Static Proxy: You can directly fill in the IP and port of the proxy server, I hope you have fast proxy server.", $this->text_domain); ?></li>
							<li><?php _e('You can use HTTP, Socks4, Socks5 multiple proxies.', $this->text_domain); ?></li>
						</ol>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Master Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>

				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary qc-svg database">
						<strong><?php _e('Database', $this->text_domain); ?></strong>
						<p class="description"><?php _e("Help you to handle database content easily.", $this->text_domain); ?>
						<ol>
							<li><?php _e('Modify some characters in the database in batches.', $this->text_domain); ?></li>
							<li><?php _e('Batch restore the address of the controllable cloud storage to the local address.', $this->text_domain); ?></li>
							<li><?php _e('Automatically wipe specified tags or attributes in the post content.', $this->text_domain); ?></li>
						</ol>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Master Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary qc-svg anchor">
						<strong><?php _e('Automatic Anchor', $this->text_domain); ?></strong>
						<p class="description"><?php _e('Automatically add tags anchor to the keywords in the post content.', $this->text_domain); ?></p>
						<ol>
							<li><?php _e('The anchor link is automatically set according to the manually set keywords when the post content is output.', $this->text_domain); ?></li>
							<li><?php _e('Automatically set up existing article tags.', $this->text_domain); ?></li>
						</ol>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Master Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary qc-svg pseudo-original">
						<strong><?php _e('Pseudo Original', $this->text_domain); ?></strong>
						<p class="description"><?php _e('Automatically replace the keywords in the post content.', $this->text_domain); ?></p>
						<ol>
							<li><?php _e('Built-in tens of thousands of thesaurus.', $this->text_domain); ?></li>
							<li><?php _e('The thesaurus can be built manually.', $this->text_domain); ?></li>
						</ol>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Master Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary qc-svg static-cache">
						<strong><?php _e('Static Cache', $this->text_domain); ?></strong>
						<p class="description"><?php _e("If you don't need interactive features, just show the site as fast as it can, and you'll like this static caching system like a domestic system like Empire CMS.", $this->text_domain); ?></p>
						<ol>
							<li><?php _e('<strong>Pure Static Cache</strong>: This mode is the fastest, but does not support website interaction.', $this->text_domain); ?></li>
							<li><?php _e('<strong>Half Static Cache</strong>: This mode supports website interaction and loads the static cache only for users who are not logged in.', $this->text_domain); ?></li>
							<li><?php _e('Static Cache for Joinmode of cloud storage', $this->text_domain); ?></li>
						</ol>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Master Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
					<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
				</tr>
				<tr>
					<th scope="row" class="check-column"></th>
					<td class="column-primary qc-svg cleaner">
						<strong><?php _e('Cleaner', $this->text_domain); ?></strong>
						<p class="description"><?php _e('If you have a huge media library and do not know how many attachments has not bean used. this tool will help you to find out.', $this->text_domain); ?></p>
						<ol>
							<li><?php _e('Scan for attachments that are not in use and automatically delete them.', $this->text_domain); ?></li>
							<li><?php _e('Attachments to post are automatically deleted when the post is deleted.', $this->text_domain); ?></li>
							<li><?php _e('Automatically delete duplicated posts.', $this->text_domain); ?></li>
							<li><?php _e('Automatically delete empty posts.', $this->text_domain); ?></li>
						</ol>
						<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
					</td>
					<td data-colname="<?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Enterprise Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Master Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Server Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Professional Edition', 'activation', $this->text_domain); ?>" class="column-mark green"></td>
					<td data-colname="<?php _ex('Cloud Storage Edition', 'activation', $this->text_domain); ?>" class="column-mark red"></td>
				</tr>
				<tr class="priceRowBottom">
					<th scope="row" class="check-column"></th>
					<td class="column-primary"></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>249.00</span>'); ?></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>199.00</span>'); ?></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>149.00</span>'); ?></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>99.00</span>'); ?></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>65.00</span>'); ?></td>
					<td align="center"><?php printf(__('From %s', $this->text_domain), '<span class="price"><sup>&#165;</sup>49.00</span>'); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- Edition Differences - end -->
	<!-- Customer Service - start -->
	<div class="nav-section hidden">
		<table id="contact-list" class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for=""><?php _ex('Developer', 'contact', $this->text_domain); ?></label></th>
					<td><?php _e('Michael Wang', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Official Website', $this->text_domain); ?></label></th>
					<td><a href="https://www.qqworld.org" target="_blank" class="button button-primary qc-icon link"><?php _e("QQWorld's Projects", $this->text_domain); ?></a></td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Email'); ?></label></th>
					<td><a href="mailto:<?php _e('Michael Wang', $this->text_domain); ?> <admin@qqworld.org>" class="button button-primary qc-icon mail">admin@qqworld.org</a></td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Tencent QQ', $this->text_domain); ?></label></th>
					<td>
						<p><a href="http://wpa.qq.com/msgrd?v=3&uin=172269588&site=qq&menu=yes">172269588</a></p>
						<p><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/qrcode/qq-follow.png" class="qr-code" /></p>
						<p><?php printf(__('%s: ', $this->text_domain), sprintf(__('QQ Group No.%d', $this->text_domain), 1)); ?><strong>3372914</strong><br />
						<?php printf(__('%s: ', $this->text_domain), sprintf(__('QQ Group No.%d', $this->text_domain), 2)); ?><strong>1978289</strong></p>
						<p><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/qrcode/qq-group-1.png" class="qq qr-code" /></p>
						<p><?php _e('Please use the QQ APP to scan the QR code.', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Wechat', $this->text_domain); ?></label></th>
					<td>
						<p>kbzyzwxq (<?php printf(__('%s: ', $this->text_domain), __('WeChat Official Account', $this->text_domain)); _e('qqworld-project', $this->text_domain); ?>)</p>
						<p><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/qrcode/wechat-follow.png" class="wechat qr-code" /></p>
						<p class="hidden"><strong><?php _e('Wechat Group', $this->text_domain); ?></strong></p>
						<p class="hidden"><img src="https://www.qqworld.org/wp-content/uploads/images/qrcode/wechat-group-1.png" class="qr-code" /></p>
						<p><?php _e('Please use the WeChat APP to scan the QR code.', $this->text_domain); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Alipay', $this->text_domain); ?></label></th>
					<td><img src="<?php echo QQWORLD_COLLECTOR_URL; ?>images/qrcode/alipay-follow.png" class="qr-code" />
					<p><?php _e('Please use the Alipay APP to scan the QR code.', $this->text_domain); ?></p></td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Cellphone', $this->text_domain); ?></label></th>
					<td><a href="tel:13294296711" class="button button-primary qc-icon phone">13294296711</a></td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- Customer Service - end -->
</div>