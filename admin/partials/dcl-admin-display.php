<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die('Damn it.! Dude you are looking for what?');
}
/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://dclwp.com
 * @since      10.0.0
 *
 * @package    DCL
 * @subpackage DCL/admin/partials
 */
?>

<!-- This should be primarily consist of HTML with a little bit of PHP in it. -->
		
		<div id="tabs" class="ui-tabs">
			<h2>Disqus Conditional Load <span class="subtitle">by <a href="http://www.joelsays.com/about-me/" target="_blank" title="Developed by Joel James">Joel James</a> ( v<?php echo $this->version; ?> )</span></h2>
			<?php if( isset($_GET['settings-updated']) ) { ?>
				<div class="updated">
					<p><strong>DCL settings updated successfully</strong></p>
				</div>
			<?php } ?>
			<ul class="ui-tabs-nav">
			<?php
			$class_gnrl = '';
			$class_pro = '';
			
			if( isset($_GET['tab']) && $_GET['tab'] == 'pro') {
				$class_pro = 'ui-tabs-active ui-state-active';
			}
			else {
				$class_gnrl = 'ui-tabs-active ui-state-active';
			}

			?>
		        <li class="<?php echo $class_gnrl; ?>"><a href="?page=dcl-settings" class="tab-orange tab-premium">DCL Settings <span class="newred_dot">&bull;</span></a></li>
				<li class=""><a href="<?php echo DCL_DISQUS_PAGE; ?>#adv" class="tab-orange tab-premium">Disqus Settings <span class="newred_dot">&bull;</span></a></li>
		        <li class="<?php echo $class_pro; ?>"><a href="?page=dcl-settings&tab=pro" class="tab-orange tab-premium">DCL Pro & Info <span class="newred_dot">&bull;</span></a></li>
				<?php // echo dcl_output_tabs(); ?>
		    </ul>
			<?php if ( ! isset( $_REQUEST['updated'] ) ) $_REQUEST['updated'] = false; ?>
			
			<?php if( isset($_GET['tab']) && $_GET['tab'] == 'pro') { ?>
				<div id="dcl-tab-int">
					<?php include_once('dcl-admin-pro-tab.php'); ?>
				</div>
			<?php }

			else { ?>

			<form method="post" action="options.php">

			<?php settings_fields( 'dcl_gnrl_options' ); ?>
				<div id="conditional">
					<?php include_once('dcl-admin-general-tab.php'); ?>
				</div>
			<?php submit_button( 'Save All Changes' ); ?>
			</form>
			<?php } ?>

				<?php // include_once('dcl-admin-footer.php'); ?>
		</div>
