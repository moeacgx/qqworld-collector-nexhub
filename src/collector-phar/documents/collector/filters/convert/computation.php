<p align="center"><img src="<?php print QQWORLD_COLLECTOR_DOCUMENTS_URL; ?>collector/filters/convert/computation/1.png" /></p>
<p><?php _e('Perform operations on the collected numbers. Use variable <em>{d}</em> to represent the collected number.<br />For example: <em>{d} - 200</em>', $this->text_domain); ?></p>
<h2>其他复杂表达式</h2>
<dl>
	<dt>{d} / 100 - 6 </dt>
	<dd>先除以100，再减去6</dd>
	<dt>22 - {d} * 100</dt>
	<dd>先乘以100，再被22减</dd>
	<dt>{d} % 2</dt>
	<dd>求2的余数</dd>
	<dt>(5 + {d}) / (100 - {var:num})</dt>
	<dd>先加5，然后100减去num变量，最后将前数字除以后数字。（括号和其他变量的应用）</dd>
</dl>