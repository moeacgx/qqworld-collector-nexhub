<?php
namespace qqworld_collector; class patch { public function __construct() { global $wp_version; if (version_compare($wp_version, '5.0', '>=')) { } } } new patch; ?>