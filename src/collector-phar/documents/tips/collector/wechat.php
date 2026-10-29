<p>之前的方法失效了，请使用新方法。</p>
<h2>准备工作</h2>
<h3>抓包工具Fiddler</h3>
<p>开启抓包工具，如不知道如何使用抓包工具请参考：<a class="qc-icon link" href="https://www.qqworld.org/archives/5872" target="_blank">https://www.qqworld.org/archives/5872</a>。</p>
<h3>微信公众号PC客户端</h3>
<p>打开微信公众号PC客户端，进入要采集的公众号，点击任意一篇文章。</p>
<h2>开始抓包</h2>
<p>新规则需要获取3个参数，分别是 <strong>公众号的ID</strong>、<strong>列表签名</strong> 和 <strong>历史列表的Cookies</strong>。</p>
<h3>参数1：公众号的ID</h3>
<p>从抓包工具中找到该文章的长地址，范例：</p>
<pre class="prism"><code class="language-markup" style="word-break: break-all;">https://mp.weixin.qq.com/s?__biz=MzI4MjU0MDcwOA==&mid=2247486822&idx=1&sn=94e36594deeebcb117cd5fa1a7d390db&chksm=eb9922addceeabbbeee1922a4ad297af627eda6ff70aa62cf7c14643415bf589a6a344c8ec73&scene=126&sessionid=1655558969&key=fe9e8f66b168c8e4764e09d78c499e50e6976be92cd4f6507a1a1f10fac11f74572d42eb2c090bc257ec6acc97e970752fc01918f81d453e3b2d81a3df54c75b121afce12af5c7fba84463d6fdb86c4bf0c201af43fec8b752b489d18f8b9ffe4bfabb162f42798e5cf50b931c464bd42dfbd8f7c2ec185b7cad7927014f713d&ascene=15&uin=MzgzMjc0ODM1&devicetype=Windows+10+x64&version=6307001d&lang=zh_CN&session_us=gh_791959367cdd&exportkey=Ad6xkVbLyaOYYi13Aa7H%2BdE%3D&acctmode=0&pass_ticket=MoC%2FlsYnMFaru2Xm1ouZ%2FsdeyJEmdELKzwMoaq%2FDiga1N%2BFxzV9JjkyOrFy8YFXh&wx_header=0&fontgear=2</code></pre>
<p>在地址前面的位置找到 <strong>MzI4MjU0MDcwOA==</strong> 即是第1个参数：<strong>公众号的ID</strong>，填到采集规则 <strong>采集列表</strong> ⏵ <strong>高级请求</strong> ⏵ <strong>新链接</strong> 中的 <em>{0}</em> 变量中去。</p>
<p class="qc-icon info">关键步骤：将该地址复制到浏览器地址栏访问一次，载入完成后可以关掉，也不需要抓包工具了。</p>
<h3>参数2：列表签名</h3>
<p>将 <strong>公众号的ID</strong> 拼成如下所示的历史列表的地址，复制到浏览器地址栏打开<em>（注意，如果没有执行参数1的关键步骤是无法访问的）</em>：</p>
<pre class="prism"><code class="language-markup">https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzI4MjU0MDcwOA==&scene=124#wechat_redirect</code></pre>
<p class="qc-icon info">注意，如果地址中有 <strong>&amp;amp;</strong> 要改成 <strong>&amp;</strong>。</p>
<p>在源代码中找到以下代码：</p>
<pre class="prism"><code class="language-markup">window.appmsg_token = "1170_d0MDUnpCKxpbRPrNvIIGA4jX7KOkEYyAO9WKnw~~";</code></pre>
<p>其中 <strong>1170_d0MDUnpCKxpbRPrNvIIGA4jX7KOkEYyAO9WKnw~~</strong> 就是第2个参数：<strong>列表的签名</strong>，将其 填到采集规则 <strong>采集列表</strong> ⏵ <strong>高级请求</strong> ⏵ <strong>新链接</strong> 中的 <em>{1}</em> 变量中去。</p>
<h3>参数3：历史列表地址的Cookies</h3>
<p>获取历史列表地址的Cookie（<a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#tips--collector--get-cookies'); ?>" target="_blank">如何获取cookie</a>）填到采集规则 <strong>采集列表</strong> ⏵ <strong>如何请求</strong> ⏵ <strong>请求页头（Headers）</strong> 中去。</p>
<p>至此3个参数都填好了，可以愉快地采集了。</p>