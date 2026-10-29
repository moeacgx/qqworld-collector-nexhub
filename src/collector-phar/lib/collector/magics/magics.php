<?php
namespace qqworld_collector\module\collecting\magics; require_once dirname(__DIR__) . '/security-boundaries.php'; use qqworld_collector\lib; class magics extends lib { public function __construct() { add_action( 'qqworld-collector-magics-load_libs', array($this, 'load_libs') ); add_filter( 'qqworld-collector-magic-collecting-for-type', array($this, 'magic_collecting'), 10, 5 ); } public function load_libs($magic) {
        $local_path = \qqworld_collector\security\local_magic_path(__DIR__, $magic);
        if ($local_path === false) return false;
        $class = __NAMESPACE__ . '\\' . $magic;
        if (!class_exists($class, false)) {
            if (!class_exists(__NAMESPACE__ . '\\magic_collecting', false)) {
                require_once __DIR__ . '/class.magic_collecting.php';
            }
            require_once $local_path;
        }
        return class_exists($class, false);
    }
public function magic_collecting($items, $magic_type, $type, $source_link, $download_args) { if (!$this->load_libs($magic_type)) return $items; $items = apply_filters( 'qqworld-collector-magic-collecting-'.$magic_type.'-for-' . $type, $items, $magic_type, $type, $source_link, $download_args ); return $items; } } ?>