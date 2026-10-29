<h2>批量更新</h2>
<p>有时候为配合插件的某些功能，比如批量翻译文章名或分类Slug，我们需要对文章和分类进行批量保存更新。</p>
<p>此方法必须手动添加接口才能启动，在主题的 <em>functions.php</em> 的最上面添加以下代码即可：</p>
<pre class="prism"><code class="language-php">add_filter( 'qqworld-collector-auxiliary-allow-bulk-update', '__return_true' );</code></pre>
<p>然后就可以在文章、页面、分类目录、标签的列表页勾选要更新的文章或分类，然后在 <strong>批量编辑</strong> 下拉菜单中选择 <strong>更新</strong>，点击 <strong>应用</strong> 按钮即可。</p>