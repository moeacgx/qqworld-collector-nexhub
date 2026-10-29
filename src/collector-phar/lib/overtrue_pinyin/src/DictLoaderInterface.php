<?php
 namespace Overtrue\Pinyin; use Closure; interface DictLoaderInterface { public function map(Closure $callback); public function mapSurname(Closure $callback); } 