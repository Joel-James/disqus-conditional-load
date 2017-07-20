<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-disqus-activator.php
 */
function activate_disqus() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-disqus-activator.php';
	Disqus_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-disqus-deactivator.php
 */
function deactivate_disqus() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-disqus-deactivator.php';
	Disqus_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_disqus' );
register_deactivation_hook( __FILE__, 'deactivate_disqus' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-disqus.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    3.0
 */
function run_disqus() {

	$plugin = new Disqus();
	$plugin->run();

}
run_disqus();
