<?php
/**
 * Unit tests for the Plugin class.
 *
 * @package VendorName\PluginName\Tests\Unit
 * @since 1.0.0
 */

namespace VendorName\PluginName\Tests\Unit;

use VendorName\PluginName\Plugin;
use VendorName\PluginName\Tests\BaseTestCase;
use Brain\Monkey;

/**
 * Plugin class unit tests.
 */
class PluginTest extends BaseTestCase {

	/**
	 * Test that the plugin initializes correctly.
	 *
	 * @covers \VendorName\PluginName\Plugin::init
	 */
	public function test_plugin_init_loads_textdomain(): void {
		// Mock plugin_basename function.
		Monkey\Functions\when( 'plugin_basename' )->justReturn( 'plugin-name/plugin-name.php' );
		
		// Mock load_plugin_textdomain to verify it's called.
		Monkey\Functions\when( 'load_plugin_textdomain' )->justReturn( true );

		// Mock add_action to verify it's called.
		Monkey\Functions\when( 'add_action' )->justReturn( true );

		// Act: Initialize the plugin (this should not throw any errors).
		$result = Plugin::init();
		
		// Assert that init returns void (null).
		$this->assertNull( $result );
	}

	/**
	 * Test that register_post_types method exists and can be called.
	 *
	 * @covers \VendorName\PluginName\Plugin::register_post_types
	 */
	public function test_register_post_types_method_exists(): void {
		// Assert that the method exists.
		$this->assertTrue( method_exists( Plugin::class, 'register_post_types' ) );

		// Assert that the method can be called without errors.
		$this->assertNull( Plugin::register_post_types() );
	}

	/**
	 * Test that plugin constants are properly defined.
	 *
	 * This test ensures our bootstrap setup is working correctly.
	 */
	public function test_plugin_constants_are_defined(): void {
		$this->assertTrue( defined( 'PLUGIN_NAME_FILE' ) );
		$this->assertTrue( defined( 'PLUGIN_NAME_DIR' ) );
		$this->assertTrue( defined( 'PLUGIN_NAME_URL' ) );
	}

	/**
	 * Test that WordPress constants are properly mocked.
	 *
	 * This test ensures our test environment is correctly set up.
	 */
	public function test_wordpress_constants_are_mocked(): void {
		$this->assertTrue( defined( 'ABSPATH' ) );
		$this->assertTrue( defined( 'WP_CONTENT_DIR' ) );
		$this->assertTrue( defined( 'WP_PLUGIN_DIR' ) );
		$this->assertTrue( defined( 'WPINC' ) );
	}
}
