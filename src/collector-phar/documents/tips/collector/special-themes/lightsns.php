<h2>自定义字段</h2>
<dl>
	<dt>类型</dt>
	<dd>
		<p>字段名：<em>post_type</em>，值 <em>bbs</em> 就是论坛帖子。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/lightsns/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/lightsns/1.png" /></a></p>
		<h3>其他类型</h3>
		<ul>
			<li class="hidden">帖子：<em>bbs</em></li>
			<li>动态：<em>words</em></li>
			<li>音乐：<em>music</em></li>
			<li>文章：<em>single</em></li>
			<li>视频：<em>video</em></li>
			<li>普通内容：<em>normal</em></li>
			<li>付费内容：<em>pay_see</em></li>
			<li>问答悬赏：<em>answer</em></li>
			<li>VIP可见：<em>vip_see</em></li>
			<li>登录可见：<em>login_see</em></li>
			<li>回复可见：<em>comment_see</em></li>
		</ul>
	</dd>
	<dt>最后评论时间</dt>
	<dd>帖子需要添加的字段，<p>字段名：<em>last_comment_time</em>，值用字符串写 <em>{$:current_time}</em></p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/lightsns/2.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/lightsns/2.png" /></a></p></dd>
	<dt>下载信息</dt>
	<p>字段名：<em>download_data</em>，值 <em>{var:baidu_url}|{var:baidu_code}|</em>，如果是多个下载地址，直接重复并用英文逗号分隔，如 <em>{var:baidu_url}|{var:baidu_code}|,{var:lanzou_url}||</em>。</p><p align="center"><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/lightsns/3.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>tips/collector/special-themes/lightsns/3.png" /></a></p>
	<dt>浏览次数</dt>
	<dd><p>字段名：<em>post_views</em></p></dd>
	<dt>视频时长</dt>
	<dd><p>字段名：<em>video_time</em></p></dd>
	<dt>视频封面</dt>
	<dd><p>字段名：<em>video_img</em></p></dd>
	<dt>视频地址</dt>
	<dd><p>字段名：<em>video_url</em></p></dd>
	<dt>帖子价格</dt>
	<dd><p>字段名：<em>post_price</em></p></dd>
	<dt>隐藏内容（用于：付费可见、会员可见、回复可见）</dt>
	<dd><p>字段名：<em>post_price_cnt</em>，将下载内容的变量写入，如：<em>百度网盘：{var:baidu_url}，提取码：{var:baidu_code}</em></p></dd>
</dl>
<h2>特殊设置</h2>
<p>论坛帖子需要的设置<strong>（注意！其他类型不需要）</strong>，将文章的 <em>post_parent</em> 设置为 <em>999999999</em>，有两种方法：
<ol>
	<li>在单个收藏项目的规则设置里找到 <strong>适配主题</strong> 选项，选择 <strong>LightSNS轻社交系统</strong> 即可，推荐这种方法。</li>
	<li>或者将下列代码放到主题的 <em>functions.php</em> 里去：
		<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-collection-project-format-post-content', function($post) {
	$post['post_parent'] = 999999999;
	return $post;
});</code></pre></li>
</ol>