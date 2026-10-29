<p>以火车头发布到帝国系统为例，首先要准备好火车头的接口文件，最好是解密的，比如 <strong>ecmspush.php</strong>。</p>
<h2>步骤一：获取火车头投送的数据</h2>
<p>先建一个 <strong>ecmspush.php</strong> 的空文件放置在帝国CMS根目录，在里面写入如下代码：</p>
<pre class="prism"><code class="language-php">&lt;?php
error_log(var_export($_REQUEST, true), 3, __DIR__.'/log.txt');
?&gt;</code></pre>
<p>然后用火车头向这个文件发布一篇文章，你会在帝国CMS根目录找到 <strong>log.txt</strong> 文件，这里的数据如下所示就是火车头投送的数据，接下来我们要用QQWorld收藏家模拟火车头投送这样的数据。</p>
<pre class="prism"><code class="language-php">Array(
    'pass' => '123456',
    'classid' => 2,
    'title' => '标题',
    'smalltext' => '简介',
    'titlepic' => 'https://www.xyxz.net/wp-content/uploads/2023/04/285760OIFqde1680963785.webp',
    'loginin' => 'shuyang8',
    'classtype' => 2,
    'checked' => 1,
    'enews' => 'AddNews',
    'v_editnum' => '8=8',
    'ftitle' => '副标题',
    'keyboard' => '关键字',
    'writer' => '作者',
    'befrom' => '自己导测试的',
    'newstext' => '内容',
    'autopage' => 1,
    'autosize' => 5000
)</code></pre>
<p class="qc-icon info">注意，必须确保你的PHP有权限在这个目录下写入文件。<br />你还需要弄清楚这个数组各个键值分别代表什么意思，哪个是标题，哪个是内容等等。</p>
<h2>步骤二：建立远程站点</h2>
<p>在 <strong>QQWorld收藏家</strong> 的 <a href="<?php print admin_url('admin.php?page=qqworld-collector-settings#home'); ?>" target="_blank"><strong>远程站点设置</strong></a> 里添加一个 <strong>远程站点</strong>，选择 <strong>自定义</strong>，填写接口文件的的地址：</p>
<p><a href="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/remote-publish/send-to-api/1.png" target="_blank"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/remote-publish/send-to-api/1.png" /></a></p>
<h2>步骤三：将Wordpress网站的数据转换成火车头接口的数据</h2>
<p>在上一步建好远程站点后，会自动获得一个 <strong>钩子名</strong>，我们将用这个钩子来对发送的数据进行重新整理，将以下代码放置在主题的 <strong>functions.php</strong> 里：</p>
<pre class="prism"><code class="language-php">add_filter('qqworld-collector-remote-website-custom-content-s-1696230566852', function($post, $post_id) {
	// $post 变量是默认投送的数据，需要将其转换成火车头投送的数据结构
	return Array(
		'pass' => '123456',
		'classid' => 2,
		'title' => $post['post_title'], // 这里替换成文章标题
		'smalltext' => $post['post_excerpt'], // 这里替换成文章摘要
		'titlepic' => $post['meta_input']['_thumbnail_id'], // 这里替换成特色图地址
		'loginin' => 'shuyang8',
		'time' => isset($post['post_modified']) ? $post['post_modified'] : date('Y-m-d H:i:s', current_time('mysql')),
		'classtype' => 2,
		'checked' => 1,
		'enews' => 'AddNews',
		'v_editnum' => '8=8',
		'ftitle' => '', // 没有副标题，就留空
		'keyboard' => isset($post['term_input']['post_tag']) && $post['term_input']['post_tag'] ? implode(',', $post['term_input']['post_tag']) : '', // 这里替换成标签，并把数组转换成字符串，为防止标签为空而出错，做了一个判断
		'writer' => $post['post_author']['display_name'], // 这里替换成用户名
		'befrom' => '', // 没有来源，也留空
		'newstext' => $post['post_content'],  // 这里替换成文章内容
		'autopage' => 1,
		'autosize' => 5000
	);
}, 10, 2);</code></pre>
<p>添加好之后，用 <strong>步骤一</strong> 里的 <strong>ecmspush.php</strong> 文件用一样的方法来校验收藏家投送的数据是否合格，如果没问题，将 <strong>ecmspush.php</strong> 文件替换成真正的接口文件即可，注意不要改名。<br />然后就可以开始远程发布了，注意除非火车头的接口代码里有排除重复的功能，否则尽量不要重复远程发布同一篇文章。</p>
<p><strong>$post</strong> 的其他参数请参考如下代码：</p>
<pre class="prism"><code class="language-php">Array(
	'post_author' => Array( // 用户信息
		'user_login' => 'xxxxx', // 登录名
		'user_nicename' => '3-6', // 用户昵称
		'user_email' => 'xxxxx@example.com', // 用户邮箱地址
		'user_url' => 'http://www.example.com', // 用户主页地址
		'display_name' => 'xxxxx' // 用户显示名
	),
	'post_date' => '2023-07-03 17:31:26', // 发布日期
	'post_content' => '英语四级作文：如何减肥英语四级作文：如何减肥英语四级作文：如何减肥英语四级作文：如何减肥，英语四级作文：如何减肥英语四级作文：如何减肥，英语四级作文：如何减肥英语四级作文：如何减肥英语四级作文：如何减肥英语四级作文：如何减肥，英语四级作文：如何减肥英语四级作文：如何减肥英语四级作文：如何减肥，英语四级作文：如何减肥英语四级作文：如何减肥英语四级作文：如何减肥，英语四级作文：如何减肥英语四级作文：如何减肥。', // 文章内容
	'post_title' => '英语四级作文：如何减肥', // 文章标题
	'post_excerpt' => '英语四级作文：如何减肥英语四级作文：如何减肥英语四级作文：如何减肥', // 文章摘要
	'post_name' => 'yingyu-siji-zuowen',  // 文章名（SLug）
	'post_modified' => '2023-08-20 11:35:34', // 修改日期
	'post_type' => 'post', // 文章类型
	'meta_input' => Array( // 自定义字段
		'source-link' => 'https://www.example.com/word/1917353.html', // 来源地址（仅收藏家采集的文章才有）
		'_thumbnail_id' => 'http://www.example.com/wp-content/uploads/2022/08/68563-8VwX7z.jpg'  // 特色图地址
	),
	'term_input' => Array( // 分类法
		'category' => Array( // 分类目录
			'0' => '未分类'
		),
		'post_tag' => Array( // 标签
			'0' => 'web',
			'1' => '作文',
			'2' => '减肥',
			'3' => '如何',
			'4' => '英语'
		)
	)
)</code></pre>