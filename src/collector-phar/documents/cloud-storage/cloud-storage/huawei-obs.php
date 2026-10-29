<p>稳定、安全、高效、易用的云存储服务，具备标准Restful API接口，可存储任意数量和形式的非结构化数据标准存储价格下调，低至￥0.099/GB/月起。</p>
<h1>图文教程</h1>
<p>首先需要注册华为云（<a href="https://www.huaweicloud.com" target="_blank">www.huaweicloud.com</a>）账户。</p>
<p>进入华为云中的<strong>对象存储OBS</strong>首页，开通<strong>华为云OBS对象存储服务</strong>。 </p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/huawei-obs/1.png" /></p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/huawei-obs/2.png" /></p>
<p>进入管理控制台后，点击 <strong>创建桶</strong> 按钮：</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/huawei-obs/3.png" /></p>
<p>按照你的网站受众用户所在区域选择<strong>所属区域</strong> ，填写桶名称，读写权限选择<strong>公共读</strong>。 </p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/huawei-obs/4.png" /></p>
<p>注意要实名认证之后才能创建。创建之后回到OBS控制台首页，点击立即获取密钥（AK和SK）：</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/huawei-obs/5.png" /></p>
<p>在 <strong>访问密钥</strong> 中点击 <strong>新增访问密钥</strong> 按钮，伴随密钥的建立，会下载一个文件，该文件中包含 <strong>AK</strong> 和 <strong>SK</strong>。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/huawei-obs/6.png" /></p>
<p>再次回到OBS控制台首页，点击新建好的存储桶，在右侧弹出了对话框中可以找到<strong>访问地址</strong>，当然你也可以绑定自己的<strong>CDN域名</strong>。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/huawei-obs/7.png" /></p>
<p>好了，现在已经获取了 <strong>桶名称</strong>，<strong>所属区域</strong>，<strong>访问地址</strong>，<strong>AK</strong> 和 <strong>SK</strong>，将这些参数填到 <a rel="noreferrer noopener" aria-label="QQWorld收藏家（在新窗口打开）" href="https://www.qqworld.org/prouct/qqworld-collector" target="_blank">QQWorld收藏家</a> 中 <strong>云存储</strong> 的 <strong>阿里云对象存储服务（OBS）</strong>设置中去。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/huawei-obs/8.png" /></p>
<p>设置好之后，只要是上传或抓取到媒体库的图片，都会被自动同步。之前未同步的图片，也可以通过两种<strong>扫描</strong>方式进行同步。</p>