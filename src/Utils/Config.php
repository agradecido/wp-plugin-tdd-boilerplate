<?php
/**
 * Configuration management utility for WP Plugin TDD Boilerplate plugin.
 *
 * This file contains the Config class that handles plugin configuration storage
 * and retrieval using WordPress options API. It provides a centralized way to
 * manage plugin settings and preferences.
 *
 * The class implements a simple key-value storage system with WordPress integration,
 * allowing for persistent configuration across plugin usage.
 *
 * @package VendorName\PluginName\Utils
 * @since 1.0.0
 * @version 1.0.0
 * @author Javier Sierra <jsierra@manerasdevivir.com>
 * @license GPL-2.0-or-later
 * @link https://www.manerasdevivir.com
 */

namespace VendorName\PluginName\Utils;

defined( 'ABSPATH' ) || exit;

/**
 * Configuration manager class.
 *
 * Handles plugin configuration storage and retrieval using WordPress options API.
 * Provides methods to get, set, check existence, and retrieve all configuration values.
 * 
 * The configuration is stored as a single WordPress option to minimize database queries
 * and improve performance. All configuration data is cached in memory during the 
 * request lifecycle.
 *
 * Usage example:
 * ```php
 * $config = new Config();
 * $config->set('feature_enabled', true);
 * $enabled = $config->get('feature_enabled', false);
 * ```
 *
 * @since 1.0.0
 * @version 1.0.0
 */
class Config {

	/**
	 * Option name for storing plugin configuration in WordPress options table.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private const OPTION_NAME = 'plugin_name_config';

	/**
	 * Configuration data cache.
	 *
	 * Stores all configuration values in memory to avoid multiple database queries
	 * during a single request lifecycle.
	 *
	 * @since 1.0.0
	 * @var array<string, mixed>
	 */
	private array $config = array();

	/**
	 * Constructor.
	 *
	 * Initializes the configuration manager and loads existing configuration
	 * from WordPress options into memory cache.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->load_config();
	}

	/**
	 * Get a configuration value.
	 *
	 * Retrieves a configuration value by key. If the key doesn't exist,
	 * returns the provided default value.
	 *
	 * @since 1.0.0
	 * @param string $key The configuration key to retrieve.
	 * @param mixed  $default_value Default value to return if key doesn't exist.
	 * @return mixed The configuration value or default value.
	 */
	public function get( string $key, $default_value = null ) {
		return $this->config[ $key ] ?? $default_value;
	}

	/**
	 * Set a configuration value.
	 *
	 * Sets a configuration value and immediately persists it to the WordPress
	 * options table. The value is also updated in the memory cache.
	 *
	 * @since 1.0.0
	 * @param string $key The configuration key to set.
	 * @param mixed  $value The configuration value to store.
	 * @return bool True on success, false on failure.
	 */
	public function set( string $key, $value ): bool {
		$this->config[ $key ] = $value;
		return $this->save_config();
	}

	/**
	 * Check if a configuration key exists.
	 *
	 * Determines whether a given configuration key exists in the stored
	 * configuration data.
	 *
	 * @since 1.0.0
	 * @param string $key The configuration key to check.
	 * @return bool True if the key exists, false otherwise.
	 */
	public function has( string $key ): bool {
		return array_key_exists( $key, $this->config );
	}

	/**
	 * Get all configuration values.
	 *
	 * Returns a copy of all stored configuration values as an associative array.
	 * Useful for debugging or bulk operations.
	 *
	 * @since 1.0.0
	 * @return array<string, mixed> All configuration values.
	 */
	public function all(): array {
		return $this->config;
	}

	/**
	 * Load configuration from WordPress options.
	 *
	 * Retrieves the configuration from the WordPress options table and stores
	 * it in the memory cache. If no configuration exists, initializes with
	 * an empty array.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function load_config(): void {
		$option_value = get_option( self::OPTION_NAME, array() );
		$this->config = is_array( $option_value ) ? $option_value : array();
	}

	/**
	 * Save configuration to WordPress options.
	 *
	 * Persists the current configuration cache to the WordPress options table.
	 * This method is called automatically when setting configuration values.
	 *
	 * @since 1.0.0
	 * @return bool True on success, false on failure.
	 */
	private function save_config(): bool {
		return update_option( self::OPTION_NAME, $this->config );
	}
}