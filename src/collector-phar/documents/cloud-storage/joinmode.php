<h2>视频教程</h2>
<p><a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#video-course--cloud-storage--joinmode'); ?>" target="_blank" class="button button-primary qc-icon link">观看视频教程</a></p>
<h2>设置</h2>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/joinmode/1.png" /></p>
<h3>聚合模式</h3>
<p>开启后可同时使用多个云存储，系统会输出其中速度最快的地址。需要注意的是，<a href="<?php print admin_url('options-permalink.php'); ?>" target="_blank">固定链接</a> 的常用设置里不能设置为朴素，否则聚合云存储地址无效。</p>
<h3>模式</h3>
<p>媒体库中的附件将被同步到勾选的云存储上。建议不要选择太多，这将大大增加同步的时间，更容易造成超时，建议在 帮助文档 里搜索 <strong>404</strong> 和 <strong>504</strong> 的解决方案。</p>
<h3>扫描</h3>
<p>批量将媒体库中的附件同步到选中的云存储上，并将文章内容中的图片地址更换为聚合云存储地址。如果不想使用了还可以将聚合云存储还原。</p>
<p>每隔一段时间建议进行一次速度检测，可以让系统重新判断哪些云存储地址是速度最快的。</p>
<h2>云存储</h2>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/joinmode/2.png" /></p>
<p>可以对单个云存储进行操作。</p>
<h2>媒体库</h2>
<p>可以在 <a href="<?php print admin_url('upload.php?mode=list'); ?>" target="_blank">媒体库列表页</a> 对单个附件进行同步操作。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/joinmode/3.png" /></p>
<p>还可以在媒体库的附件详细页看到各云存储的同步情况。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/joinmode/4.png" /></p>