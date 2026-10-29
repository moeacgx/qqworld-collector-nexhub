<?php
 namespace QQWorld\Framework\Intl; class DateTimeFactory { public function create($time = 'now', \DateTimeZone $timezone = null) { return new \DateTime($time, $timezone); } } 