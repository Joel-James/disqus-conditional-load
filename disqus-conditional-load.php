<?php
/**
 * Plugin Name:     Disqus Conditional Load
 * Plugin URI:      https://dclwp.com
 * Description:     Disqus commenting system for WordPress with advanced features like like <strong>lazy load, shortcode</strong> etc.
 * Version:         11.0.0
 * Author:          Joel James
 * Author URI:      https://duckdev.com/
 * Donate link:     https://paypal.me/JoelCJ
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:     disqus-conditional-load
 * Domain Path:     /languages
 *
 * Disqus Conditional Load is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Disqus Conditional Load is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Disqus Conditional Load. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category Core
 * @package  DCL
 * @author   Joel James <mail@cjoel.com>
 * @license  http://www.gnu.org/licenses/ GNU General Public License
 * @link     https://dclwp.com
 */

// If this file is called directly, abort.
defined( 'ABSPATH' ) or exit;

// Define required constants for the plugin.
// These constants can be overwritten.
$constants = array(
	'DCL_NAME' => '404-to-301',
	'DCL_DOMAIN' => '404-to-301',
	'DCL_DIR' => plugin_dir_path( __FILE__ ),
	'DCL_PATH' => plugin_dir_url( __FILE__ ),
	'DCL_BASE_FILE' => __FILE__,
	'DCL_VERSION' => '11.0.0',
	// Set who all can access plugin settings.
	// You can change this if you want to give others access.
	'DCL_ACCESS' => 'manage_options',
);

foreach ( $constants as $constant => $value ) {
	if ( ! defined( $constant ) ) {
		define( $constant, $value );
	}
}

/**
 * Plugin activation actions.
 *
 * Actions to perform during plugin activation.
 * We will be registering default options in this function.
 *
 * @uses   register_activation_hook() To register activation hook.
 * @since  3.0.0
 * @access private
 *
 * @return void
 */
function activate_dcl() {

    //require_once DCL_DIR . 'includes/class-dcl-activator.php';

    //DCL_Activator::activate();
}

// Make use of activation hook.
register_activation_hook( DCL_BASE_FILE , 'activate_dcl' );

// Load all required files for the plugin to work.
// We are loading official DIsqus plugin from vendor.
require_once DCL_DIR . 'vendor/disqus/disqus.php';
require_once DCL_DIR . 'includes/class-disqus-conditional-load.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 10.0.0
 * @access public
 *
 * @return void
 */
function run_dcl() {

	( new Disqus_Conditional_Load() )->run();
}

run_dcl();

//*** Thank you for your interest in DCL - Developed and managed by Joel James ***// 