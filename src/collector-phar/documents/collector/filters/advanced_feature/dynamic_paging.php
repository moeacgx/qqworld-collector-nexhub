<p>对采集到的链接进行进一步处理，通常用在内容格式化过滤器之后。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/filters/advanced_feature/dynamic_paging/1.png" /></p>
<p>使用方法类似 <a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--advanced-request'); ?>" target="_blank">高级请求 - 动态分页链接</a>。</p>
<h2>添加关键词</h2>
<p>关键词变量是用被花括号包裹的数字表示的。</p>
<h4>填写字符串或从链接字符中获取</h4>
<p>直接选字符串写固定的值，或者用正则从新链接中截取。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/advanced-request/5.png" /></p>
<h4>从链接的HTML内容中采集</h4>
<p>有些关键词必须从新链接的HTML代码中去采集。</p>
<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/advanced-request/6.png" /></p>
<h2>注意事项</h2>
<p>由于该过滤器会将字符串的内容转换为数组，所以在内容处理完之后，需要使用<a href="<?php print admin_url('admin.php?page=qqworld-collector-documents#collector--filters--advanced_feature--array_to_string'); ?>" target="_blank">合并数组</a>过滤器将数组转为字符串</p>
<p>经典案例请在收藏项目中搜索<strong>马蜂窝</strong>。</p>