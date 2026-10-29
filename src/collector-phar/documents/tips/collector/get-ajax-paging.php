<p>遇到AJAX分页的网站，不要急着用最复杂的方式写采集规则，先尝试获取隐藏的分页地址。</p>
<h2>WordPress网站</h2>
<p>这类网站的分页地址通常是无法隐藏的，在地址后面加上 <strong>/page/2</strong> 即第二页的地址。</p>
<h2>非WordPress网站</h2>
<h3>知名CMS</h3>
<p>如果明确知道是哪一类CMS，可以直接参考官方的CMS分页的写法拼出分页的地址，就像WordPress站点一样。</p>
<h3>自制站点</h3>
<p>可以在地址后面用一些常用的分页代码试探，以 <em>http://www.example.com/list</em> 举例，比如：</p>
<ol>
	<li>http://www.example.com/list?page=2</li>
	<li>http://www.example.com/list?p=2</li>
	<li>http://www.example.com/list/page/2</li>
	<li>http://www.example.com/list/2</li>
	<li>http://www.example.com/list-2</li>
	<li>http://www.example.com/list/p2</li>
	<li>自己想...</li>
</ol>
<p>如果实在找不出隐藏的分页地址，再考虑用收藏项目里的高级请求来写采集规则吧。</p>