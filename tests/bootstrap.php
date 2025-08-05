<?php
/**
 * PHPUnit bootstrap file for WP Plugin TDD Boilerplate plugin tests.
 *
 * @package VendorName\PluginName\Tests
 * @since 1.0.0
 */

// Load Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

// Initialize Brain Monkey.
\Brain\Monkey\setUp();

// Define plugin constants for tests.
if ( ! defined( 'PLUGIN_NAME_FILE' ) ) {
	define( 'PLUGIN_NAME_FILE', __DIR__ . '/../plugin-name.php' );
}

if ( ! defined( 'PLUGIN_NAME_DIR' ) ) {
	define( 'PLUGIN_NAME_DIR', dirname( PLUGIN_NAME_FILE ) );
}

if ( ! defined( 'PLUGIN_NAME_URL' ) ) {
	define( 'PLUGIN_NAME_URL', 'http://example.com/wp-content/plugins/plugin-name/' );
}

// Define WordPress constants commonly used in tests.
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', '/tmp/wordpress/' );
}

if ( ! defined( 'WP_CONTENT_DIR' ) ) {
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
}

if ( ! defined( 'WP_PLUGIN_DIR' ) ) {
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
}

if ( ! defined( 'WPINC' ) ) {
	define( 'WPINC', 'wp-includes' );
}

// Mock WordPress functions and classes that are commonly used.
\Brain\Monkey\Functions\when( 'plugin_basename' )->alias(
	function ( $file ) {
		return 'plugin-name/plugin-name.php';
	}
);
\Brain\Monkey\Functions\when( 'plugin_dir_path' )->justReturn( PLUGIN_NAME_DIR . '/' );
\Brain\Monkey\Functions\when( 'plugin_dir_url' )->justReturn( PLUGIN_NAME_URL );
\Brain\Monkey\Functions\when( 'load_plugin_textdomain' )->justReturn( true );
\Brain\Monkey\Functions\when( 'add_action' )->justReturn( true );
\Brain\Monkey\Functions\when( 'add_filter' )->justReturn( true );
\Brain\Monkey\Functions\when( 'remove_action' )->justReturn( true );
\Brain\Monkey\Functions\when( 'remove_filter' )->justReturn( true );
\Brain\Monkey\Functions\when( 'do_action' )->justReturn( true );
\Brain\Monkey\Functions\when( 'apply_filters' )->returnArg( 1 );
\Brain\Monkey\Functions\when( 'wp_parse_args' )->alias(
	function ( $args, $defaults ) {
		if ( is_object( $args ) ) {
			$args = get_object_vars( $args );
		} elseif ( ! is_array( $args ) ) {
			parse_str( $args, $args );
		}
		
		return is_array( $defaults ) ? array_merge( $defaults, $args ) : $args;
	}
);

// Shutdown Brain Monkey after tests.
register_shutdown_function(
	function () {
		\Brain\Monkey\tearDown();
	}
);