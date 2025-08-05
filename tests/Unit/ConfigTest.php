<?php
/**
 * Unit tests for the Config class - Following TDD approach.
 *
 * @package VendorName\PluginName\Tests\Unit
 * @since 1.0.0
 */

namespace VendorName\PluginName\Tests\Unit;

use VendorName\PluginName\Utils\Config;
use VendorName\PluginName\Tests\BaseTestCase;
use Brain\Monkey;

/**
 * Config class unit tests.
 * 
 * Example of TDD (Test-Driven Development):
 * 1. RED: Write failing tests first
 * 2. GREEN: Write minimal code to make tests pass
 * 3. REFACTOR: Improve the code while keeping tests green
 */
class ConfigTest extends BaseTestCase {

	/**
	 * Test that the Config class can be instantiated.
	 * 
	 * @covers \VendorName\PluginName\Utils\Config::__construct
	 */
	public function test_config_can_be_instantiated(): void {
		$config = new Config();
		$this->assertInstanceOf( Config::class, $config );
	}

	/**
	 * Test that default configuration values are returned.
	 * 
	 * @covers \VendorName\PluginName\Utils\Config::get
	 */
	public function test_get_returns_default_values(): void {
		$config = new Config();
		
		// Test getting a default value.
		$default_value = $config->get( 'nonexistent_key', 'default_value' );
		$this->assertEquals( 'default_value', $default_value );
	}

	/**
	 * Test that configuration values can be set and retrieved.
	 * 
	 * @covers \VendorName\PluginName\Utils\Config::set
	 * @covers \VendorName\PluginName\Utils\Config::get
	 */
	public function test_can_set_and_get_config_values(): void {
		$config = new Config();
		
		// Set a configuration value.
		$config->set( 'test_key', 'test_value' );
		
		// Get the configuration value.
		$value = $config->get( 'test_key' );
		$this->assertEquals( 'test_value', $value );
	}

	/**
	 * Test that configuration values can be checked for existence.
	 * 
	 * @covers \VendorName\PluginName\Utils\Config::has
	 */
	public function test_can_check_if_config_key_exists(): void {
		$config = new Config();
		
		// Check non-existent key.
		$this->assertFalse( $config->has( 'nonexistent_key' ) );
		
		// Set a key and check it exists.
		$config->set( 'existing_key', 'value' );
		$this->assertTrue( $config->has( 'existing_key' ) );
	}

	/**
	 * Test that configuration values persist WordPress options.
	 * 
	 * @covers \VendorName\PluginName\Utils\Config::get
	 * @covers \VendorName\PluginName\Utils\Config::set
	 */
	public function test_config_integrates_with_wordpress_options(): void {
		// Mock WordPress option functions.
		Monkey\Functions\when( 'get_option' )
			->justReturn( array( 'wp_key' => 'wp_value' ) );
		
		Monkey\Functions\when( 'update_option' )
			->justReturn( true );
		
		$config = new Config();
		
		// Should be able to get WordPress option.
		$value = $config->get( 'wp_key' );
		$this->assertEquals( 'wp_value', $value );
		
		// Should be able to set WordPress option.
		$result = $config->set( 'new_wp_key', 'new_wp_value' );
		$this->assertTrue( $result );
	}

	/**
	 * Test that config can return all values.
	 * 
	 * @covers \VendorName\PluginName\Utils\Config::all
	 */
	public function test_can_get_all_config_values(): void {
		// Mock WordPress get_option to return some values.
		Monkey\Functions\when( 'get_option' )
			->justReturn( array( 'key1' => 'value1', 'key2' => 'value2' ) );
		
		$config = new Config();
		$all_values = $config->all();
		
		$this->assertIsArray( $all_values );
		$this->assertArrayHasKey( 'key1', $all_values );
		$this->assertEquals( 'value1', $all_values['key1'] );
	}
}
