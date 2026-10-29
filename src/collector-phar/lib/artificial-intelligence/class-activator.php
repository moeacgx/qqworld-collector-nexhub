<?php
namespace qqworld_collector\module\artificial_intelligence; if (!defined('ABSPATH')) { exit; } class QQWorld_AI_Activator { private static $db_version = '1.0.0'; private static $table_sessions; private static $table_messages; private static $table_tools; public static function activate() { global $wpdb; self::$table_sessions = $wpdb->prefix . 'qqworld_ai_sessions'; self::$table_messages = $wpdb->prefix . 'qqworld_ai_messages'; self::$table_tools = $wpdb->prefix . 'qqworld_ai_tools'; self::create_tables(); self::create_options(); flush_rewrite_rules(); } public static function deactivate() { flush_rewrite_rules(); } private static function create_tables() { global $wpdb; $charset_collate = $wpdb->get_charset_collate(); $sql_sessions = "CREATE TABLE " . self::$table_sessions . " (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            uuid varchar(36) NOT NULL,
            title varchar(255) NOT NULL DEFAULT '新对话',
            model varchar(100) NOT NULL,
            provider varchar(50) NOT NULL,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY uuid (uuid),
            KEY provider (provider),
            KEY created_at (created_at)
        ) $charset_collate;"; $sql_messages = "CREATE TABLE " . self::$table_messages . " (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            session_id bigint(20) NOT NULL,
            role enum('system','user','assistant') NOT NULL,
            content longtext NOT NULL,
            model_used varchar(100) DEFAULT NULL,
            tokens_used int(11) DEFAULT 0,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            KEY session_id (session_id),
            KEY role (role),
            KEY created_at (created_at),
            CONSTRAINT fk_messages_session FOREIGN KEY (session_id) REFERENCES " . self::$table_sessions . "(id) ON DELETE CASCADE
        ) $charset_collate;"; $sql_tools = "CREATE TABLE " . self::$table_tools . " (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            message_id bigint(20) NOT NULL,
            tool_name varchar(100) NOT NULL,
            tool_args longtext DEFAULT NULL,
            tool_result longtext DEFAULT NULL,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            KEY message_id (message_id),
            KEY tool_name (tool_name),
            CONSTRAINT fk_tools_message FOREIGN KEY (message_id) REFERENCES " . self::$table_messages . "(id) ON DELETE CASCADE
        ) $charset_collate;"; require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); dbDelta($sql_sessions); dbDelta($sql_messages); dbDelta($sql_tools); update_option('qqworld_ai_db_version', self::$db_version); } private static function create_options() { add_option('qqworld_ai_db_version', self::$db_version); add_option('qqworld_ai_provider_config', ''); } public static function get_table_sessions() { global $wpdb; return $wpdb->prefix . 'qqworld_ai_sessions'; } public static function get_table_messages() { global $wpdb; return $wpdb->prefix . 'qqworld_ai_messages'; } public static function get_table_tools() { global $wpdb; return $wpdb->prefix . 'qqworld_ai_tools'; } public static function get_db_version() { return self::$db_version; } } 