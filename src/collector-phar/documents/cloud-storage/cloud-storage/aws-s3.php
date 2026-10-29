<p>现在，公司需要能够轻松安全地大规模收集、存储和分析其数据。Amazon S3 是专为从任意位置存储和检索任意数量的数据而构建的对象存储，这些数据包括来自网站和移动应用程序、公司应用程序的数据以及来自 IoT 传感器或设备的数据。它旨在提供 99.999999999% 的持久性，并存储每个行业的市场领导者使用的数百万个应用程序的数据。S3 提供了全面的安全性和合规性功能，甚至可满足最严格的法规要求。它让客户能够灵活地管理数据，以实现成本优化、访问控制和合规性。S3 提供了即时查询功能，使您可以在 S3 中直接对静态数据进行强大的分析。此外，Amazon S3 是最受支持的可用云存储服务，拥有来自最大的第三方解决方案社区、系统集成商合作伙伴和其他 AWS 产品的集成。</p>
<p><a href="http://www.wordpress.gov/wp-admin/admin.php?page=qqworld-collector-documents#video-course--cloud-storage--aws-s3" target="_blank" class="button button-primary button-large qc-icon link">视频教程</a></p>
<h2>设置方法</h2>
<p>去<a href="https://aws.amazon.com" target="_blank">亚马逊云服务AWS</a>注册一个账号，并新建一个S3云存储的存储桶。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>cloud-storage/cloud-storage/aws-s3/1.png" /></p>
<p>先填写S3的域名和目录，这里表达的是S3存储里文件的路径格式。</p>
<p>然后填写访问密钥 ID、私有访问密钥，区域和存储桶名称。</p>
<p>填好之后保存设置，如果连接成功，系统会给你盖个绿色的章。：）</p>
<h3>同步网站资源</h3>
<p>很遗憾的是，S3没有镜像回源功能，所以建议不要使用同步网站资源，兼容性不好。</p>