<?php
/**
 * Plugin Name:       Disqus Conditional Load
 * Plugin URI:        http://dclwp.com
 * Description:       Advanced version of Disqus plugin with much more features like <strong>lazy load, shortcode</strong> etc.
 * Version:           10.1.1
 * Author:            Joel James
 * Author URI:        http://www.joelsays.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       disqus-conditional-load
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die('Damn it.! Dude you are looking for what?');
}

// Defines plugin constants
if(!defined('DCL_VERSION')) {
	define( 'DCL_VERSION', '10.1.1' );
}
if(!defined('DCLPATH')){
	define( 'DCLPATH', home_url( PLUGINDIR . '/disqus-conditional-load/' ) );
}
if(!defined('DCL_PLUGIN_DIR')) {
	define( 'DCL_PLUGIN_DIR', __FILE__ );
}
if(!defined('DCL_DISQUS_PAGE')) {
	define( 'DCL_DISQUS_PAGE', admin_url( 'edit-comments.php?page=disqus' ) );
}
if(!defined('DCL_SETTINGS_PAGE')) {
	define( 'DCL_SETTINGS_PAGE', admin_url( 'admin.php?page=dcl-settings' ) );
}
// Set who all can access DCL settings. You can change this if you want to give others access.
if(!defined('DCL_ADMIN_PERMISSION')) {
	define( 'DCL_ADMIN_PERMISSION', 'manage_options' );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dcl-activator.php
 */
function activate_dcl() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dcl-activator.php';
	DCL_Activator::activate();
}
register_activation_hook( __FILE__, 'activate_dcl' );

/**
 * The core plugin class that is used to define
 * dashboard-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-dcl.php';
require_once plugin_dir_path( __FILE__ ) . 'public/dcl-functions.php';
require_once plugin_dir_path( __FILE__ ) . 'disqus-core/disqus.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    10.0.0
 */
function run_dcl() {

	$plugin = new DCL();
	$plugin->run();

}
run_dcl();

//*** Thank you for your interest in DCL - Developed and managed by Joel James ***// 