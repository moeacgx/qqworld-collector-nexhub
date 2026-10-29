<h1>首先测试水印功能是否正常工作</h1>
<p>在 水印 - <a href="<?php print admin_url('admin.php?page=qqworld-collector-watermark#image-watermark'); ?>" target="_blank">图片水印</a> 设置中，点击预览图下方的 <strong>预览水印效果</strong> 按钮，可以测试水印功能是否正常工作。</p>
<h2>测试失败</h2>
<p>应该是上传的水印文件丢失，建议在FTP或宝塔的文件管理器中查看水印文件是否存在，如果不在，建议用FTP或宝塔文件管理器重传一个。</p>
<p class="qc-icon info">注意：如果开启了云存储，并且设置了同步后删除本地附件，请关闭云存储以后再上传水印图片，且切记不要删除本地的水印图片。</p>
<h2>测试成功</h2>
<h3>可能情况一：被设置过滤掉了</h3>
<p>建议检查水印 - <a href="<?php print admin_url('admin.php?page=qqworld-collector-watermark#common'); ?>" target="_blank">通用</a> 设置，有些选项会导致特定情况或超标图片尺寸不会打水印。</p>
<h3>可能情况二：浏览器或CDN缓存</h3>
<p>其实水印已经打上了，但是因为有缓存所以无法看到，建议去FTP或宝塔文件管理器中查看图片水印是否打上了，如果是，清缓存。</p>