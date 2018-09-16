<?php

/**
 * Fired only when the DCL is uninstalled 😞.
 *
 * Removes everything that DCL added to your db.
 * Please note that we are not deleting Disqus core settings from database.
 * The reason why we are not deleting Disqus settings is, on their official
 * plugin they are keeping settings in db even after the plugin removal.
 *
 *
 * @category   Core
 * @package    DCL
 * @subpackage Uninstall
 * @author     Joel James <mail@cjoel.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://dclwp.com
 */
// If uninstall not called from WordPress, kill.
defined( 'ABSPATH' ) || die( 'K. Bye.' );

// Do not clear setting if Pro version is already active.
if ( ! is_plugin_active( 'disqus-conditional-load-pro/disqus-conditional-load-pro.php' ) ) {

	// Attempts to uninstall Disqus official plugin settings.
	// @todo Check if official plugin is installed independently.
	if ( ! is_plugin_active( 'disqus-comment-system/disqus.php' )
	     && file_exists( DCL_DIR . 'vendor/disqus/disqus/uninstall.php' )
	) {
		require_once DCL_DIR . 'vendor/disqus/disqus/uninstall.php';
	}

	// Options registered by DCL.
	$dcl_options = array(
		'dcl_gnrl_options',
		'dcl_do_activation_redirect',
		'dcl_version_no',
	);

	// Loop through each options.
	foreach ( $dcl_options as $option ) {
		delete_option( $option );
	}
}

/******* What if I told you, this is the end of Disqus Conditional Load ********/