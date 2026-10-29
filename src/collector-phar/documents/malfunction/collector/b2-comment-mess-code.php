<h1>使用B2主题采集评论出现&amp;#ff0c;乱码</h1>
<p>解决方法是修改主题的 <strong>TempParts/circle/circle-comments.php</strong> 文件的第87行，将：</p>
<pre class="prism"><code class="language-php">&lt;p v-text="child.comment_content"&gt;&lt;/p&gt;</code></pre>
<p>改成：</p>
<pre class="prism"><code class="language-php">&lt;p v-html="child.comment_content"&gt;&lt;/p&gt;</code></pre>