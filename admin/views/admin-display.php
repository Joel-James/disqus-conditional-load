<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) or exit;

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

<div class="dcl-wrap">

	<h2><?php printf( __( 'Disqus Conditional Load <span class="subtitle">by <a href="%s" target="_blank" title="Developed by Joel James">Joel James</a> ( v%d )</span>', DCL_DOMAIN ), 'https://duckdev.com', DCL_VERSION ); ?></h2>
	<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php _e( 'DCL settings updated successfully', DCL_DOMAIN ); ?></strong></p>
		</div>
	<?php endif; ?>
	<?php $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : ''; ?>
	<h2 class="nav-tab-wrapper">
		<a href="?page=dcl-settings" class="nav-tab <?php echo $tab === '' ? 'nav-tab-active' : ''; ?>"><span class="dashicons dashicons-admin-generic"></span> <?php _e( 'Settings', DCL_DOMAIN ); ?></a>
		<a href="?page=dcl-settings&tab=pro" class="nav-tab <?php echo $tab === 'pro' ? 'nav-tab-active' : ''; ?>"><span class="dashicons dashicons-cart"></span> <?php _e( 'DCL Pro & Info', DCL_DOMAIN ); ?></a>
	</h2>

	<?php if ( isset( $_GET['tab'] ) && $_GET['tab'] === 'pro' ) : ?>
		<?php require_once 'pro-details.php'; ?>
	<?php else : ?>
		<?php require_once 'general-settings.php'; ?>
	<?php endif; ?>
</div>