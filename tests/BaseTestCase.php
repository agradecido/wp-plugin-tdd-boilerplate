<?php
/**
 * Base test case for WP Plugin TDD Boilerplate plugin tests.
 *
 * This file contains the BaseTestCase abstract class that provides common setup,
 * teardown, and helper methods for all test classes in the WP Plugin TDD Boilerplate plugin.
 *
 * The class integrates Brain Monkey for WordPress function mocking and Mockery
 * for advanced mocking capabilities, providing a solid foundation for both
 * unit and integration testing.
 *
 * @package VendorName\PluginName\Tests
 * @since 1.0.0
 * @version 1.0.0
 * @author Javier Sierra <jsierra@manerasdevivir.com>
 * @license GPL-2.0-or-later
 * @link https://www.manerasdevivir.com
 */

namespace VendorName\PluginName\Tests;

use Brain\Monkey;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

defined( 'ABSPATH' ) || exit;

/**
 * Abstract base test case class.
 *
 * Provides common setup and teardown for all tests, including Brain Monkey
 * initialization for WordPress function mocking and common helper methods
 * for creating mock objects and asserting WordPress hook interactions.
 *
 * Features:
 * - Automatic Brain Monkey setup and teardown
 * - Mockery integration with PHPUnit
 * - Common WordPress function mocking
 * - Helper methods for creating mock posts and users
 * - Hook assertion utilities
 *
 * Usage:
 * ```php
 * class MyTest extends BaseTestCase {
 *     public function test_something(): void {
 *         $post = $this->createMockPost(['ID' => 123]);
 *         $this->assertEquals(123, $post->ID);
 *     }
 * }
 * ```
 *
 * @since 1.0.0
 * @version 1.0.0
 */
abstract class BaseTestCase extends TestCase {

	use MockeryPHPUnitIntegration;

	/**
	 * Set up before each test.
	 *
	 * Initializes Brain Monkey for WordPress function mocking and sets up
	 * common WordPress function mocks that are used across most tests.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	protected function setUp(): void {
		parent::setUp();
		Monkey\setUp();
		
		// Mock common WordPress functions.
		$this->mockCommonWordPressFunctions();
	}

	/**
	 * Tear down after each test.
	 *
	 * Cleans up Brain Monkey and Mockery state to ensure test isolation.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	protected function tearDown(): void {
		Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * Mock common WordPress functions used across tests.
	 *
	 * Sets up default mocks for WordPress functions that are commonly used
	 * throughout the plugin, such as sanitization, translation, and option functions.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	protected function mockCommonWordPressFunctions(): void {
		Monkey\Functions\when( 'esc_html' )->returnArg();
		Monkey\Functions\when( 'esc_attr' )->returnArg();
		Monkey\Functions\when( 'esc_url' )->returnArg();
		Monkey\Functions\when( 'sanitize_text_field' )->returnArg();
		Monkey\Functions\when( 'wp_kses_post' )->returnArg();
		Monkey\Functions\when( '__' )->returnArg();
		Monkey\Functions\when( '_e' )->returnArg();
		Monkey\Functions\when( '_x' )->returnArg();
		Monkey\Functions\when( '_n' )->returnArg();
		Monkey\Functions\when( 'get_option' )->justReturn( false );
		Monkey\Functions\when( 'update_option' )->justReturn( true );
		Monkey\Functions\when( 'delete_option' )->justReturn( true );
	}

	/**
	 * Helper method to create a mock WordPress post.
	 *
	 * Creates a mock post object with default properties that can be overridden
	 * with custom values. Useful for testing post-related functionality.
	 *
	 * @since 1.0.0
	 * @param array<string, mixed> $args Post arguments to override defaults.
	 * @return \stdClass Mock post object with specified properties.
	 */
	protected function createMockPost( array $args = array() ): \stdClass {
		$defaults = array(
			'ID'           => 1,
			'post_title'   => 'Test Post',
			'post_content' => 'Test content',
			'post_status'  => 'publish',
			'post_type'    => 'post',
			'post_author'  => 1,
		);

		$post_data = wp_parse_args( $args, $defaults );
		$post      = new \stdClass();

		foreach ( $post_data as $key => $value ) {
			$post->$key = $value;
		}

		return $post;
	}

	/**
	 * Helper method to create a mock WordPress user.
	 *
	 * Creates a mock user object with default properties that can be overridden
	 * with custom values. Useful for testing user-related functionality.
	 *
	 * @since 1.0.0
	 * @param array<string, mixed> $args User arguments to override defaults.
	 * @return \stdClass Mock user object with specified properties.
	 */
	protected function createMockUser( array $args = array() ): \stdClass {
		$defaults = array(
			'ID'           => 1,
			'user_login'   => 'testuser',
			'user_email'   => 'test@example.com',
			'display_name' => 'Test User',
			'user_roles'   => array( 'subscriber' ),
		);

		$user_data = wp_parse_args( $args, $defaults );
		$user      = new \stdClass();

		foreach ( $user_data as $key => $value ) {
			$user->$key = $value;
		}

		return $user;
	}

	/**
	 * Helper method to mock WordPress hooks.
	 *
	 * Sets up a mock for a WordPress hook function with a specified return value.
	 *
	 * @since 1.0.0
	 * @param string $hook Hook name to mock.
	 * @param mixed  $return_value Value to return from the hook.
	 * @return void
	 */
	protected function mockHook( string $hook, $return_value = true ): void {
		Monkey\Functions\when( $hook )->justReturn( $return_value );
	}

	/**
	 * Helper method to assert that a WordPress hook was called.
	 *
	 * Verifies that a specific WordPress hook was called the expected number of times.
	 *
	 * @since 1.0.0
	 * @param string $hook Hook name to check.
	 * @param int    $times Number of times the hook should have been called.
	 * @return void
	 */
	protected function assertHookCalled( string $hook, int $times = 1 ): void {
		Monkey\Functions\expect( $hook )->times( $times );
	}
}