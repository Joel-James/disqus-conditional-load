<?php

/**
 * Fired only when the DCL is uninstalled.
 *
 * Removes everything that DCL added to your db.
 * Please note that we are not deleting Disqus core settings from database.
 * The reason why we are not deleting Disqus settings is, on their official
 * plugin they are keeping settings in db even after the plugin removal.
 *
 *
 * @link		http://dclwp.com
 * @since		10.0.0
 * @author		Joel James
 * @package		DCL
 */

// If uninstall not called from WordPress, then exit. That's it!

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
if( get_option( 'dcl_gnrl_options' ) ) {
	delete_option( 'dcl_gnrl_options' );
}
if( get_option( 'dcl_do_activation_redirect' ) ) {
	delete_option( 'dcl_do_activation_redirect' );
}
if( get_option( 'dcl_version_no' ) ) {
	delete_option( 'dcl_version_no' );
}

/******* The end. Thanks for using DCL plugin ********/
