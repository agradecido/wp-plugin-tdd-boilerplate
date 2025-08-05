<?php
/**
 * Plugin Name: WP Plugin TDD Boilerplate
 * Description: Audience segmentation and personalized content engine for www.manerasdevivir.com.
 * Version: 1.0.0
 * Author: Javier Sierra <jsierra@manerasdevivir.com>
 * Text Domain: plugin-name
 * Domain Path: /languages
 * Requires at least: 6.0
 * Tested up to: 6.4
 * Requires PHP: 8.0
 * Network: false
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Main plugin file for WP Plugin TDD Boilerplate
 *
 * This plugin provides a boilerplate for developing WordPress plugins 
 * using Test-Driven Development (TDD) principles.
 * 
 * @package VendorName\PluginName
 * @since 1.0.0
 * @version 1.0.0
 * @author Javier Sierra <jsierra@manerasdevivir.com>
 * @license GPL-2.0-or-later
 * @link https://www.manerasdevivir.com
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/vendor/autoload.php';

use VendorName\PluginName\Plugin;

// Bootstrap the plugin.
Plugin::init();