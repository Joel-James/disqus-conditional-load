<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) or exit;

/**
 * Provide a dashboard view for the plugin.
 *
 * This file is used to markup the general settings page.
 *
 * @category   Core
 * @package    DCL
 * @subpackage Admin View
 * @author     Joel James <mail@cjoel.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://dclwp.com
 */
?>
<form method="post" action="options.php">

	<?php settings_fields( 'dcl_gnrl_options' ); ?>
	<?php $options = get_option( 'dcl_gnrl_options' ); ?>

	<table class="form-table">
		<tbody>

			<tr>
				<th><?php _e( 'How to Load Disqus', DCL_DOMAIN ); ?></th>
				<td>
					<select name="dcl_gnrl_options[dcl_type]" required>
						<option value="click" <?php selected( $options['dcl_type'], 'click' ); ?>><?php _e( 'On Click', DCL_DOMAIN ); ?></option>
						<option value="scroll" <?php selected( $options['dcl_type'], 'scroll' ); ?>><?php _e( 'On Scroll', DCL_DOMAIN ); ?></option>
						<option value="normal" <?php selected( $options['dcl_type'], 'normal' ); ?>><?php _e( 'Normal (no lazy load)', DCL_DOMAIN ); ?></option>
						<option disabled><?php _e( 'On Scroll Start (Pro only)', DCL_DOMAIN ); ?></option>
					</select>
					<p class="description"><?php _e( 'This feature will let you prevent Disqus from automatically loading comments and scripts on pages, posts or whatever it is.', DCL_DOMAIN ); ?></p>
					<p class="description"><?php _e( 'If you choose "Normal" comments will be loaded normally and no lazy load effect will be there.', DCL_DOMAIN ); ?></p>
				</td>
			</tr>

			<tr>
				<th><?php _e( 'Disqus Comments Width', DCL_DOMAIN ); ?></th>
				<td>
					<input placeholder="<?php _e( 'Default', DCL_DOMAIN ); ?>" type="number" name="dcl_gnrl_options[dcl_div_width]" value="<?php echo $options['dcl_div_width']; ?>" size="20">
					<input type="radio" name="dcl_gnrl_options[dcl_div_width_type]" <?php checked( $options['dcl_div_width_type'], '%' ); ?> value="%">%
					<input type="radio" name="dcl_gnrl_options[dcl_div_width_type]" <?php checked( $options['dcl_div_width_type'], 'px' ); ?> value="px">px
					<p class="description"><?php _e( 'If Disqus comments are not looking good because of the large or smaller width, you can adjust the width of comments division here.', DCL_DOMAIN ); ?></p>
					<p class="description"><?php _e( 'Just enter the width size. Leave empty if not required.', DCL_DOMAIN ); ?></p>
				</td>
			</tr>

			<tr>
				<th><?php _e( 'Count Script', DCL_DOMAIN ); ?></th>
				<td>
					<select name="dcl_gnrl_options[dcl_count_disable]">
						<option value="1" <?php selected( $options['dcl_count_disable'], 1 ); ?>>Enable</option>
						<option value="0" <?php selected( $options['dcl_count_disable'], 0 ); ?>>Disable</option>
					</select>
					<p class="description"><?php _e( 'By default Disqus may load a script (count.js) to get the comments count to show somewhere on your pages.', DCL_DOMAIN ); ?></p>
					<p class="description"><?php _e( 'Disabling this feature can improve your page loading speed but may conflict with some themes.', DCL_DOMAIN ); ?></p>
				</td>
			</tr>

			<tr>
				<th><?php _e( 'Button Text', DCL_DOMAIN ); ?></th>
				<td>
					<input placeholder="<?php _e( 'Load Comments', DCL_DOMAIN ); ?>" type="text" name="dcl_gnrl_options[dcl_btn_txt]" value="<?php echo $options['dcl_btn_txt']; ?>" size="20">
					<p class="description"><?php _e( 'If you are loading Disqus using On Click feature, then there will be a button to load comments.', DCL_DOMAIN ); ?></p>
					<p class="description"><?php _e( 'If you want to use custom text on the button, enter it here. By default it will be "Load Comments" (Works only with "On Click" option).', DCL_DOMAIN ); ?></p>
				</td>
			</tr>

			<tr>
				<th><?php _e( 'Custom Button Class', DCL_DOMAIN ); ?></th>
				<td>
					<input type="text" name="dcl_gnrl_options[dcl_btn_class]" value="<?php echo $options['dcl_btn_class']; ?>" size="20">
					<p class="description"><?php _e( 'Here you can add any custom class to the button. By using custom class you can use your own style for comment button.', DCL_DOMAIN ); ?></p>
					<p class="description"><?php _e( 'Leave empty if you don\'t care. (Works only with "On Click" option).', DCL_DOMAIN ); ?></p>
				</td>
			</tr>

			<tr>
				<th><?php _e( 'Loading Message', DCL_DOMAIN ); ?></th>
				<td>
					<input placeholder="<?php _e( 'Loading..', DCL_DOMAIN ); ?>" type="text" name="dcl_gnrl_options[dcl_message]" value="<?php echo $options['dcl_message']; ?>" size="20">
					<p class="description"><?php _e( 'There may be a millisecond delay before Disqus starts loading when visitors clicks on the button. Enter something here, and we will show that during that delay.', DCL_DOMAIN ); ?></p>
					<p class="description"><?php printf( __( 'By Default it will be "Loading..". You may use html tags like %s. (Works only with "On Click" option).', DCL_DOMAIN ), '<code>&lt;p&gt; &lt;b&gt; &lt;h2&gt;</code>' ); ?></p>
				</td>
			</tr>

			<tr>
				<th><?php _e( 'Disable on CPTs', DCL_DOMAIN ); ?></th>
				<td>
					<input placeholder="product" type="text" name="dcl_gnrl_options[dcl_cpt_exclude]" value="<?php echo $options['dcl_cpt_exclude']; ?>">
					<p class="description"><?php _e( 'If Disqus adds its scripts on custom post types, and you dont like it, enter the custom post type here. Separate with comma.', DCL_DOMAIN ); ?></p>
				</td>
			</tr>

			<tr>
				<th><?php _e( 'Caching Support', DCL_DOMAIN ); ?></th>
				<td>
					<select name="dcl_gnrl_options[dcl_caching]">
						<option value="1" <?php selected( $options['dcl_caching'], 1 ); ?>>Enable</option>
						<option value="0" <?php selected( $options['dcl_caching'], 0 ); ?>>Disable</option>
					</select>
					<p class="description"><?php _e( 'If you are having issues loading Disqus comments when caching is enabled, please enable this.', DCL_DOMAIN ); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<?php submit_button( __( 'Save settings', DCL_DOMAIN ) ); ?>
</form>