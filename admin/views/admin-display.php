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
<?php $current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general'; ?>
<?php $options = $this->helper->get_option(); ?>
<div id="tabs" class="ui-tabs dcl-wrap">

	<h2><?php printf( __( 'Disqus Conditional Load <span class="subtitle">by <a href="%s" target="_blank" title="Developed by Joel James">Joel James</a> ( v%d )</span>', 'disqus-conditional-load' ), 'https://duckdev.com', DCL_VERSION ); ?></h2>
	<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e( 'DCL settings updated successfully', 'disqus-conditional-load' ); ?></strong></p>
		</div>
	<?php endif; ?>
	<ul class="ui-tabs-nav">
		<li class="<?php echo 'general' === $current_tab ? 'ui-state-active' : ''; ?>">
			<a href="?page=dcl-settings" class="tab-premium"><?php esc_html_e( 'DCL Settings', 'disqus-conditional-load' ); ?><span class="newred_dot">&bull;</span></a>
		</li>
		<li class="<?php echo 'pro' === $current_tab ? 'ui-state-active' : ''; ?>">
			<a href="?page=dcl-settings&tab=pro" class="tab-premium"><?php esc_html_e( 'DCL Pro & Info', 'disqus-conditional-load' ); ?><span class="newred_dot">&bull;</span></a>
		</li>
	</ul>

	<?php if ( 'pro' === $current_tab ) : ?>
		<?php include_once 'admin-pro.php'; ?>
	<?php else : ?>
		<?php include_once 'admin-general.php'; ?>
	<?php endif; ?>
</div>