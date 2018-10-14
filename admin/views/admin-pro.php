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
<div class="metabox-holder">
<div class="columns-2">

	<div class="postbox-container">
		<div class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Buy DCL Pro', 'disqus-conditional-load' ); ?></h3>
			<div class="inside">
				<p>
					<span class="description">
						<?php printf( __( 'Get all these additional and upcoming features + to help my development and other efforts. Assured %1$smoney back%2$s if you are not satisfied.', 'disqus-conditional-load' ), '<a href="http://dclwp.com/refund-policy/">', '</a>' ); ?>
						<strong><?php esc_html_e( 'Immediate download after purchase.', 'disqus-conditional-load' ); ?></strong>
					</span>
				</p>
				<p class="dcl-buy-btn">
					<a href="https://dclwp.com/" title="<?php esc_html_e( 'Buy Now', 'disqus-conditional-load' ); ?>"><img src="<?php echo DCL_PATH; ?>assets/img/buy-now-dcl.png" alt="<?php esc_html_e( 'Buy DCL Pro', 'disqus-conditional-load' ); ?>"></a>
				</p>
			</div>
		</div>
	</div>

	<div class="postbox-container">
		<div class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Load on "Scroll Start"',  'disqus-conditional-load' ); ?></h3>
			<div class="inside">
				<p>
					<span class="description">
						<?php printf( __( 'This is a %1$sMOST WANTED%2$s feature! Seriously.', 'disqus-conditional-load' ), '<strong>', '</strong>' ); ?>
						<?php printf( __( 'Using this feature your Disqus comments will start loading right after visitor starts scrolling the page. That means %1$sno waiting for visitors, but not loading on page load.%2$s Cool feature, isn\'t it?', 'disqus-conditional-load' ), '<strong>', '</strong>' ); ?>
					</span>
				</p>
			</div>
		</div>
	</div>

	<div class="postbox-container">
		<div class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Disqus Comments Widget', 'disqus-conditional-load' ); ?></h3>
			<div class="inside">
				<p>
					<span class="description">
						<?php printf( __( 'This feature will give you a new widget called "DCL Disqus Comments". You will be able to %1$sshow Disqus comments on your sidebar or any other widgets!%2$s Very useful because WordPress shortcode doesn\'t work in widgets by default.', 'disqus-conditional-load' ), '<strong>', '</strong>' ); ?>
					</span>
				</p>
			</div>
		</div>
	</div>

	<div class="postbox-container">
		<div class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Popular Comments Widget', 'disqus-conditional-load' ); ?></h3>
			<div class="inside">
				<p>
					<span class="description">
						<?php esc_html_e( 'And here is another one! This will add a new widget called "DCL Popular Comments".', 'disqus-conditional-load' ); ?>
						<?php printf( __( 'You will be able to %1$sshow popular Disqus comments%2$s from your website on your sidebar or any other widget areas! Helping you to boost the user engagement', 'disqus-conditional-load' ), '<strong>', '</strong>' ); ?>
					</span>
				</p>
			</div>
		</div>
	</div>

	<div class="postbox-container">
		<div class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Beautiful Button Styles', 'disqus-conditional-load' ); ?></h3>
			<div class="inside">
				<p>
					<span class="description">
						<?php printf( __( 'With DCL Pro, you will get many %1$sbeautiful inbuilt button styles%2$s. You don\'t have to write CSS to style your button. Choose from the awesome buttons that we have already included in DCL Pro. Don\'t worry you will be still able to use your custom class too.', 'disqus-conditional-load' ), '<strong>', '</strong>' ); ?>
					</span>
				</p>
			</div>
		</div>
	</div>

	<div class="postbox-container">
		<div class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Count on Button', 'disqus-conditional-load' ); ?></h3>
			<div class="inside">
				<p>
					<span class="description">
						<?php printf( __( 'Want to show the total comments count for each articles on the button? Yes, it is possible when you use DCL Pro. If you have comments already, it will %1$sdisaply the count of the comments on your button%2$s just after the button text.', 'disqus-conditional-load' ), '<strong>', '</strong>' ); ?>
					</span>
				</p>
			</div>
		</div>
	</div>

	<div class="postbox-container">
		<div class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Woocommerce & Easy Digital Downloads', 'disqus-conditional-load' ); ?></h3>
			<div class="inside">
				<p>
					<span class="description">
						<?php printf( __( 'How about showing comments for Woocommerce products and EDD? Normally if you use Disqus, you won\'t be able to show Woocommerce review. But now you can %1$sshow comments in new tab%2$s as well as %1$sinside product description%2$s. And you are ready to integrate Disqus comments with EDD products too!', 'disqus-conditional-load' ), '<strong>', '</strong>' ); ?>
					</span>
				</p>
			</div>
		</div>
	</div>

	<div class="postbox-container">
		<div class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Separate Options for Desktop and Mobile', 'disqus-conditional-load' ); ?></h3>
			<div class="inside">
				<p>
					<span class="description">
						<?php printf( __( 'DCL Pro will allow you to use separate lazy loading options in %1$smobile and desktop%2$s devices. For example, you can use On Scroll load in mobile devices while using On Click on desktop devices. You may enable or disable lazy loading only on mobile/desktop', 'disqus-conditional-load' ), '<strong>', '</strong>' ); ?>
					</span>
				</p>
			</div>
		</div>
	</div>

	<div id="postbox-container-1" class="postbox-container">
		<div class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Priority Email Support', 'disqus-conditional-load' ); ?></h3>
			<div class="inside">
				<p>
					<span class="description">
						<?php printf( __( 'Own a Pro license to always be at the front of the queue and get support rapidly. All you have to do is to enter your valid license key when you contact us. You will be provided with an option for that. We will try our best to resolve any issues %1$swithin 24 hours%2$s', 'disqus-conditional-load' ), '<strong>', '</strong>' ); ?>
					</span>
				</p>
			</div>
		</div>
	</div>

</div>

<div class="columns-1">

	<div class="postbox-container dcl-credits-box">
		<div class="postbox">
			<h3 class="hndle"><span class="dashicons dashicons-smiley"></span> <?php esc_html_e( 'Like this plugin?', 'disqus-conditional-load' ); ?></h3>
			<div class="inside">
				<p>
					<span class="description">
						<?php printf( __( 'This plugin is being developed and managed by %1$sJoel James%2$s and not affiliated with Disqus. That being said, the commenting system is completely maintained by %3$sDisqus%4$s', 'disqus-conditional-load' ), '<a href="https://duckdev.com/" target="_blank"><strong>', '</strong></a>', '<a href="http://disqus.com/" target="_blank">', '</a>' ); ?>
					</span>
				</p>
				<p><span class="dashicons dashicons-cart"></span> <strong><a href="https://dclwp.com/" target="_blank" title="<?php esc_html_e( 'Upgrade now', 'disqus-conditional-load' ); ?>"><?php esc_html_e( 'Upgrade to DCL Pro', 'disqus-conditional-load' ); ?></a></strong></p>
				<p><span class="dashicons dashicons-star-filled"></span> <strong><a href="https://wordpress.org/support/view/plugin-reviews/disqus-conditional-load?filter=5#postform" target="_blank" title="<?php esc_html_e( 'Rate now', 'disqus-conditional-load' ); ?>"><?php esc_html_e( 'Rate this on WordPress', 'disqus-conditional-load' ); ?></a></strong></p>
				<p><span class="dashicons dashicons-heart"></span> <strong><a href="https://paypal.me/JoelCJ" target="_blank" title="<?php esc_html_e( 'Donate now', 'disqus-conditional-load' ); ?>"><?php esc_html_e( 'Make a small donation', 'disqus-conditional-load' ); ?></a></strong></p>
				<p><span class="dashicons dashicons-admin-plugins"></span> <strong><a href="https://github.com/joel-james/disqus-conditional-load/" target="_blank" title="<?php esc_html_e( 'Contribute now', 'disqus-conditional-load' ); ?>"><?php esc_html_e( 'Contribute to the Plugin', 'disqus-conditional-load' ); ?></a></strong></p>
				<p><span class="dashicons dashicons-twitter"></span> <strong><a href="https://twitter.com/home?status=I'm%20using%20Disqus%20Conditional%20Load%20plugin%20by%20%40Joel_James%20to%20lazy%20load%20%40Disqus%20in%20my%20%40WordPress%20site%20-%20it%20is%20awesome!%20%20https://dclwp.com/" target="_blank" title="<?php esc_html_e( 'Tweet now', 'disqus-conditional-load' ); ?>"><?php esc_html_e( 'Tweet about the Plugin', 'disqus-conditional-load' ); ?></a></strong></p>
			</div>
		</div>
	</div>

</div>
	</div>
