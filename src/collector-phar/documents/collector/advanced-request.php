<p>有些AJAX加载的页面需要使用高级请求将列表链接转换为AJAX的链接，并提供给采集项目进行采集。</p>
<p>点击 <strong>启用高级请求</strong> 按钮即可弹出高级请求设置界面。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/advanced-request/1.png" /></p>
<h2>设置</h2>
<h4>新链接</h4>
<p>在链接结构中输入新链接的结构，这里有3个变量可选。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/advanced-request/2.png" /></p>
<dl>
	<dt>(*)</dt>
	<dd>页码的变量</dd>
	<dt>(*20)</dt>
	<dd>有的页码是offset位移形式的，意思是每次递增的数值乘以20</dd>
	<dt>(o)</dt>
	<dd>有些页码不仅有双位移码，该变量相当于 <strong>((*+1)20)</strong> 变量的效果。</dd>
	<dt>(i:toutiao_signature)</dt>
	<dd>今日头条专用变量，生成签名</dd>
	<dt>(f:urlencode:*)</dt>
	<dd>函数变量：URL编码，*号替换为其他非英文冒号内容，可以是其他变量，多个参数之间用|分隔。</dd>
	<dt>(f:urldecode:*)</dt>
	<dd>函数变量：URL解码，*号替换为其他非英文冒号内容，可以是其他变量，多个参数之间用|分隔。</dd>
	<dt>(f:rand:1000|9999)</dt>
	<dd>1000-9999的随机数</dd>
	<dt>(f:*:*)</dt>
	<dd>其他可用函数，中间的*号替换为其他函数名即可。</dd>
	<dt>(s:switch:*)</dt>
	<dd>目前只支持开关语句，范例：(s:switch:{0}::ent$$1|||study$$2)。意思是如果采集到的{0}变量值是 <strong>ent</strong> 则自动替换成 <strong>1</strong>，如果是 <strong>study</strong> 则替换成 <strong>2</strong>。</dd>
</dl>
<p>然后还可以通过添加关键词功能从来源链接中获取到关键词：</p>
<p><a href="#add-keywords" class="scrollto button button-primary button-large qc-icon link">添加关键词手册</a></p>
<h4>动态分页链接</h4>
<p>有时候需要动态生成下一页的链接，因为某些参数需要从页面中采集。就是说这里的分页是无法用页码来获取的，通常是以某个文章的ID来定位。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/advanced-request/3.png" /></p>
<p>注意，这里的分页范围就不是页码变量了，而是获取多少页。比如如果填3-5就是获取第4-6页。</p>
<p>然后还可以通过添加关键词功能从来源链接中获取到关键词：</p>
<p><a href="#add-keywords" class="scrollto button button-primary button-large qc-icon link">添加关键词手册</a></p>
<h4>请求方法</h4>
<p>在极少数情况下是需要使用POST方式或加载Cookie。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/advanced-request/4.png" /></p>
<table class="wp-list-table widefat fixed striped">
	<thead>
		<tr>
			<th width="40">序号</th>
			<th width="120">方法</th>
			<th>描述</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>GET</td>
			<td>请求指定的页面信息，并返回实体主体。</td>
		</tr>
		<tr>
			<td>2</td>
			<td>HEAD</td>
			<td>类似于get请求，只不过返回的响应中没有具体的内容，用于获取报头</td>
		</tr>
		<tr>
			<td>3</td>
			<td>POST</td>
			<td>向指定资源提交数据进行处理请求（例如提交表单或者上传文件）。数据被包含在请求体中。POST请求可能会导致新的资源的建立和/或已有资源的修改。</td>
		</tr>
		<tr>
			<td>4</td>
			<td>PUT</td>
			<td>从客户端向服务器传送的数据取代指定的文档的内容。</td>
		</tr>
		<tr>
			<td>5</td>
			<td>DELETE</td>
			<td>请求服务器删除指定的页面。</td>
		</tr>
		<tr>
			<td>6</td>
			<td>CONNECT</td>
			<td>HTTP/1.1协议中预留给能够将连接改为管道方式的代理服务器。</td>
		</tr>
		<tr>
			<td>7</td>
			<td>OPTIONS</td>
			<td>允许客户端查看服务器的性能。</td>
		</tr>
		<tr>
			<td>8</td>
			<td>TRACE</td>
			<td>回显服务器收到的请求，主要用于测试或诊断。</td>
		</tr>
		<tr>
			<td>9</td>
			<td>PATCH</td>
			<td>实体中包含一个表，表中说明与该URI所表示的原内容的区别。</td>
		</tr>
		<tr>
			<td>10</td>
			<td>MOVE</td>
			<td>请求服务器将指定的页面移至另一个网络地址。</td>
		</tr>
		<tr>
			<td>11</td>
			<td>COPY</td>
			<td>请求服务器将指定的页面拷贝至另一个网络地址。</td>
		</tr>
		<tr>
			<td>12</td>
			<td>LINK</td>
			<td>请求服务器建立链接关系。</td>
		</tr>
		<tr>
			<td>13</td>
			<td>UNLINK</td>
			<td>断开链接关系。</td>
		</tr>
		<tr>
			<td>14</td>
			<td>WRAPPED</td>
			<td>允许客户端发送经过封装的请求。</td>
		</tr>
		<tr>
			<td>15</td>
			<td>Extension-mothed</td>
			<td>在不改动协议的前提下，可增加另外的方法。</td>
		</tr>
	</tbody>
</table>
<h2 id="add-keywords" class="qc-icon link">添加关键词</h2>
<p>关键词变量是用被花括号包裹的数字表示的。</p>
<h4>填写字符串或从链接字符中获取</h4>
<p>直接选字符串写固定的值，或者用正则从新链接中截取。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/advanced-request/5.png" /></p>
<h4>从链接的HTML内容中采集</h4>
<p>有些关键词必须从新链接的HTML代码中去采集。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/advanced-request/6.png" /></p>