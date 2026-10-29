<p>MinIO 是全球领先的对象存储先锋，目前在全世界有数百万的用户. 在标准硬件上，读/写速度上高达183 GB / 秒 和 171 GB / 秒。<br />
对象存储可以充当主存储层，以处理Spark、Presto、TensorFlow、H2O.ai等各种复杂工作负载以及成为Hadoop HDFS的替代品。<br />
MinIO用作云原生应用程序的主要存储，与传统对象存储相比，云原生应用程序需要更高的吞吐量和更低的延迟。而这些都是MinIO能够达成的性能指标。</p>
<h2>安装方法</h2>
<p>去 <a href="https://www.minio.org.cn/download.shtml" target="_blank">Minio</a> 分别下载 <strong>服务器</strong> 和 <strong>客户端</strong> 文件，放到同一个目录。</p>
<h2>启动服务</h2>
<p>在安装目录执行以下命令：</p>
<pre class="prism"><code class="language-php">minio server F:\Data --console-address ":9001"</code></pre>
<p>其中 <em>F:\Data</em> 是数据目录，用来保存上传的文件，<em>9001</em> 是服务端口，可自行修改。</p>
<p>然后就可以通过 <?php print $_SERVER['REQUEST_SCHEME']; ?>://<?php print $_SERVER['REMOTE_ADDR']; ?>:9001 访问服务端，去新建一个 Bucket，即存储桶，并且将存储桶设置里的 <em>Summary</em> -> <em>Access Policy</em> 改为 <em>public</em> 就可以直链访问。</p>
<h2>设置QQWorld收藏家插件</h2>
<h3>域名 & 目录</h3>
<p>注意这里要填客户端的地址，默认是 <em>9000</em> 端口，建议用你的二级域名反向代理这个地址。</p>
<h3>服务端首页URL</h3>
<p>注意这里要填服务器的地址，默认是 <em>9001</em> 端口，可以不需要用域名反向代理。</p>
<h3>用户名和密码</h3>
<p>填写可以操作该Bucket的用户名和密码。</p>
<h3>存储桶（Bueckt）</h3>
<p>...</p>
<p>设置妥当后保存，应该可以看到连接成功了。</p>
<p>MinIO是个非常强大且复杂的云存储程序，堪比OSS，如果想更深入地了解建议百度。</p>