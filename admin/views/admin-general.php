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
<?php $options = $this->helper->get_option_group( 'dcl_gnrl_options' ); ?>
<form method="post" action="options.php">
	<fieldset id="dcl-fieldset" <?php echo empty( $this->helper->short_name ) ? disabled( true ) : ''; ?>>
		<?php settings_fields( 'dcl_general' ); ?>
		<table class="form-table">
			<tbody>
			<tr>
				<th>
					<?php esc_html_e( 'How to Load Disqus', 'disqus-conditional-load' ); ?>
				</th>
				<td>
					<select id="dcl_type" class="select" typle="select" name="dcl_gnrl_options[dcl_type]" required="required">
						<option value="click" <?php selected( $options['dcl_type'], 'click' ); ?>><?php esc_html_e( 'On Click', 'disqus-conditional-load' ); ?></option>
						<option value="scroll" <?php selected( $options['dcl_type'], 'scroll' ); ?>><?php esc_html_e( 'On Scroll', 'disqus-conditional-load' ); ?></option>
						<option value="normal" <?php selected( $options['dcl_type'], 'normal' ); ?>><?php esc_html_e( 'Normal (no lazy load)', 'disqus-conditional-load' ); ?></option>
						<option disabled="disabled"><?php esc_html_e( 'On Scroll Start (Pro only)', 'disqus-conditional-load' ); ?></option>
					</select>
					<p class="description">
						<?php esc_html_e( 'This feature will let you prevent Disqus from automatically loading comments and scripts on pages, posts or whatever it is. If you choose "Normal" comments will be loaded normally and no lazy load effect will be there. Also please note that, with "Click" option, we will add a very small inline style to adjust the button alignment.', 'disqus-conditional-load' ); ?>
					</p>
				</td>
			</tr>

			<tr>
				<th>
					<?php esc_html_e( 'Disqus Comments Width', 'disqus-conditional-load' ); ?>
				</th>
				<td>
					<input placeholder="<?php esc_html_e( 'Default', 'disqus-conditional-load' ); ?>" type="number" name="dcl_gnrl_options[dcl_div_width]" value="<?php echo $options['dcl_div_width']; ?>">
					<input type="radio" name="dcl_gnrl_options[dcl_div_width_type]" <?php checked( $options['dcl_div_width_type'], '%' ); ?> value="%">%
					<input type="radio" name="dcl_gnrl_options[dcl_div_width_type]" <?php checked( $options['dcl_div_width_type'], 'px' ); ?> value="px">px
					<p class="description">
						<?php esc_html_e( 'If Disqus comments are not looking good because of the large or smaller width, you can adjust the width of comments division here. Just enter the width size. Leave empty if not required. Please note that we will add a very small inline CSS to adjust this width if you enable this.', 'disqus-conditional-load' ); ?>
					</p>
				</td>
			</tr>

			<tr>
				<th>
					<?php esc_html_e( 'Count Script', 'disqus-conditional-load' ); ?>
				</th>
				<td>
					<input type="radio" name="dcl_gnrl_options[dcl_count_disable]" <?php checked( $options['dcl_count_disable'], 1 ); ?> value="1"><?php esc_html_e( 'Enable', 'disqus-conditional-load' ); ?>
					<input type="radio" name="dcl_gnrl_options[dcl_count_disable]" <?php checked( $options['dcl_count_disable'], 0 ); ?> value="0"><?php esc_html_e( 'Disable', 'disqus-conditional-load' ); ?>
					<p class="description">
						<?php esc_html_e( 'By default Disqus may load a script (count.js) to get the comments count to show somewhere on your pages. Disabling this feature can improve your page loading speed but may conflict with some themes.', 'disqus-conditional-load' ); ?>
					</p>
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Button Text', 'disqus-conditional-load' ); ?>
				</th>
				<td>
					<input placeholder="<?php esc_html_e( 'Load Comments', 'disqus-conditional-load' ); ?>" type="text" name="dcl_gnrl_options[dcl_btn_txt]" value="<?php echo $options['dcl_btn_txt']; ?>" size="20">
					<p class="description">
						<?php esc_html_e( 'If you are loading Disqus using On Click feature, then there will be a button to load comments. If you want to use custom text on the button, enter it here. By default it will be "Load Comments" (Works only with "On Click" option).', 'disqus-conditional-load' ); ?>
					</p>
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Custom Button Class', 'disqus-conditional-load' ); ?>
				</th>
				<td>
					<input type="text" name="dcl_gnrl_options[dcl_btn_class]" value="<?php echo $options['dcl_btn_class']; ?>" size="20">
					<p class="description">
						<?php esc_html_e( 'Here you can add any custom class to the button. By using custom class you can use your own style for comment button. Leave empty if you do not care. (Works only with "On Click" option)', 'disqus-conditional-load' ); ?>
					</p>
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Loading Message', 'disqus-conditional-load' ); ?>
				</th>
				<td>
					<input placeholder="<?php esc_html_e( 'Loading..', 'disqus-conditional-load' ); ?>" type="text" name="dcl_gnrl_options[dcl_message]" value="<?php echo $options['dcl_message']; ?>" size="20">
					<p class="description thin">
						<?php esc_html_e( 'There may be few milliseconds delay before Disqus starts loading when visitors clicks on the button. Enter something here, and we will show that during that delay. By Default it will be "Loading..". You may use html tags like <p><b><h2> (Works only with "On Click" option)', 'disqus-conditional-load' ); ?>
					</p>
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Disable on CPTs', 'disqus-conditional-load' ); ?>
				</th>
				<td>
					<input placeholder="product" type="text" name="dcl_gnrl_options[dcl_cpt_exclude]" value="<?php echo $options['dcl_cpt_exclude']; ?>">
					<p class="description">
						<?php esc_html_e( 'If Disqus adds its scripts on custom post types, and you dont like it, enter the custom post type here. Separate with comma.', 'disqus-conditional-load' ); ?>
					</p>
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Caching Support', 'disqus-conditional-load' ); ?>
				</th>
				<td>
					<input type="radio" name="dcl_gnrl_options[dcl_caching]" <?php checked( $options['dcl_caching'], 1 ); ?> value="1"><?php esc_html_e( 'Enable', 'disqus-conditional-load' ); ?>
					<input type="radio" name="dcl_gnrl_options[dcl_caching]" <?php checked( $options['dcl_caching'], 0 ); ?> value="0"><?php esc_html_e( 'Disable', 'disqus-conditional-load' ); ?>
					<p class="description">
						<?php esc_html_e( 'If you are having issues loading Disqus comments when caching is enabled, please enable this.', 'disqus-conditional-load' ); ?>
					</p>
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Rocker Loader Support', 'disqus-conditional-load' ); ?>
				</th>
				<td>
					<input type="radio" name="dcl_gnrl_options[dcl_cfasync]" <?php checked( $options['dcl_cfasync'], 1 ); ?> value="1"><?php esc_html_e( 'Enable', 'disqus-conditional-load' ); ?>
					<input type="radio" name="dcl_gnrl_options[dcl_cfasync]" <?php checked( $options['dcl_cfasync'], 0 ); ?> value="0"><?php esc_html_e( 'Disable', 'disqus-conditional-load' ); ?>
					<p class="description">
						<?php sprintf( __( 'If you are using Cloudflare Rocker Loader, enable this to have %1$sRocket Loader ignore%2$s the Disqus scripts by adding the %3$sdata-cfasync="false"%4$s attribute to the script tag.', 'disqus-conditional-load' ), '<a href="https://support.cloudflare.com/hc/en-us/articles/200169436-How-can-I-have-Rocket-Loader-ignore-my-script-s-in-Automatic-Mode-" target="_blank">', '</a>', '<code>', '</code>' ); ?>
					</p>
				</td>
			</tr>
			</tbody>
		</table>
		<?php submit_button( __( 'Save All Changes', 'disqus-conditional-load' ) ); ?>
	</fieldset>
</form>