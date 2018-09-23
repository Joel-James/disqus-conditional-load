<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) || die( 'K. Bye.' );

/**
 * Provide a dashboard view for the plugin.
 *
 * This file is used to markup the dashboard pages of the plugin.
 *
 * @category   Core
 * @package    DCL
 * @subpackage Admin View
 * @author     Joel James <mail@cjoel.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://dclwp.com
 */
?>
<?php $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general'; ?>
<div class="wrap dcl-wrap">

	<h1><?php printf( __( 'Disqus Conditional Load %1$sby %2$sJoel James%3$s', 'disqus-conditional-load' ), '<span class="subtitle">', '<a href="https://duckdev.com" target="_blank">', '</a> ( v'. DCL_VERSION . ' )</span>' ); ?></h1>

	<!-- Settings updated message -->
	<?php settings_errors(); ?>

	<h2 class="nav-tab-wrapper">
		<a href="?page=dcl-settings" class="nav-tab <?php echo 'general' === $tab ? 'nav-tab-active' : ''; ?>"><span class="dashicons dashicons-admin-generic"></span> <?php _e( 'Settings', 'disqus-conditional-load' ); ?></a>
		<a href="?page=dcl-settings&tab=pro" class="nav-tab <?php echo 'pro' === $tab ? 'nav-tab-active' : ''; ?>"><span class="dashicons dashicons-palmtree"></span> <?php _e( 'Pro & Info', 'disqus-conditional-load' ); ?></a>
		<?php do_action( 'dcl_settings_tab', $tab ); // Action hook to add new items to tab. ?>
	</h2>

	<?php if ( 'pro' === $tab ) : ?>
		<?php include_once 'admin-pro.php'; ?>
	<?php else : ?>
		<?php include_once 'admin-general.php'; ?>
	<?php endif; ?>

</div><!-- /.wrap -->
