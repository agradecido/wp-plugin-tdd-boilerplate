<?php
/**
 * Main plugin class for WP Plugin TDD Boilerplate
 *
 * This file contains the main Plugin class that handles the initialization and core 
 * functionality of the WP Plugin TDD Boilerplate plugin
 *
 * @package VendorName\PluginName
 * @since 1.0.0
 * @version 1.0.0
 * @author Javier Sierra <jsierra@manerasdevivir.com>
 * @license GPL-2.0-or-later
 * @link https://www.manerasdevivir.com
 */

namespace VendorName\PluginName;

defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class for WP Plugin TDD Boilerplate.
 *
 * Handles plugin initialization, hook registration, and core functionality coordination.
 * Follows the singleton pattern for plugin initialization and serves as the main
 * entry point for all plugin features.
 *
 * Features managed:
 * - Plugin initialization and textdomain loading
 * - Custom post type registration
 * - Hook and filter registration
 * - Module coordination (FAR-614 through FAR-617)
 *
 * @since 1.0.0
 * @version 1.0.0
 */
final class Plugin {

	/**
	 * Plugin instance.
	 *
	 * @since 1.0.0
	 * @var Plugin|null
	 */
	private static ?Plugin $instance = null;

	/**
	 * Plugin version.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public const VERSION = '1.0.0';

	/**
	 * Plugin text domain.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public const TEXT_DOMAIN = 'plugin-name';

	/**
	 * Bootstraps the plugin initialization.
	 *
	 * Sets up the plugin textdomain and registers necessary hooks for initialization.
	 * This method should be called only once during plugin activation.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public static function init(): void {
		// Load plugin textdomain for internationalization.
		load_plugin_textdomain( 
			self::TEXT_DOMAIN, 
			false, 
			\dirname( plugin_basename( __FILE__ ), 2 ) . '/languages' 
		);

		// Register initialization hooks.
		add_action( 'init', array( self::class, 'register_post_types' ) );
	}

	/**
	 * Registers custom post types if needed.
	 *
	 * Placeholder method for registering custom post types that may be needed
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public static function register_post_types(): void {
		// Placeholder for CPT registration.
	}
}