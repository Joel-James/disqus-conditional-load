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

<div id="tabs" class="ui-tabs dcl-wrap">

	<h2><?php printf( __( 'Disqus Conditional Load <span class="subtitle">by <a href="%s" target="_blank" title="Developed by Joel James">Joel James</a> ( v%d )</span>', DCL_DOMAIN ), 'https://duckdev.com', DCL_VERSION ); ?></h2>
	<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
		<div class="updated">
			<p><strong><?php _e( 'DCL settings updated successfully', DCL_DOMAIN ); ?></strong></p>
		</div>
	<?php endif; ?>
	<ul class="ui-tabs-nav">
		<li class=""><a href="?page=dcl-settings" class="tab-orange tab-premium">DCL Settings <span class="newred_dot">&bull;</span></a></li>
		<li class=""><a href="?page=dcl-settings&tab=pro" class="tab-orange tab-premium">DCL Pro & Info <span class="newred_dot">&bull;</span></a></li>
	</ul>
</div>