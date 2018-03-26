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
<h3><?php _e( 'Conditional Load Settings', DCL_DOMAIN ); ?> &hellip;</h3>
<form method="post" action="options.php">
	<?php settings_fields( 'dcl_gnrl_options' ); ?>
    <table class="form-table">
        <tbody>
        <tr valign="top">
            <th scope="row">
                <label><?php _e( 'How to Load Disqus', DCL_DOMAIN ); ?><br>
                    <span class="description thin"><?php _e( 'to improve performance', DCL_DOMAIN ); ?></span>
                </label>
            </th>
            <td>
                <select id="dcl_type" class="select" typle="select" name="dcl_gnrl_options[dcl_type]" required>
                    <option value="click" <?php selected( $options['dcl_type'], 'click' ); ?>><?php _e( 'On Click', DCL_DOMAIN ); ?></option>
                    <option value="scroll" <?php selected( $options['dcl_type'], 'scroll' ); ?>><?php _e( 'On Scroll', DCL_DOMAIN ); ?></option>
                    <option value="normal" <?php selected( $options['dcl_type'], 'normal' ); ?>><?php _e( 'Normal (no lazy load)', DCL_DOMAIN ); ?></option>
                    <option disabled><?php _e( 'On Scroll Start (Pro only)', DCL_DOMAIN ); ?></option>
                </select>
                <br/>
                <span class="description thin"><?php _e( 'This feature will let you prevent Disqus from automatically loading comments and scripts on pages, posts or whatever it is. If you choose "Normal" comments will be loaded normally and no lazy load effect will be there.', DCL_DOMAIN ); ?></span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <label><?php _e( 'Disqus Comments Width', DCL_DOMAIN ); ?><br>
                    <span class="description thin"><?php _e( 'to match your theme', DCL_DOMAIN ); ?>/span>
                </label>
            </th>
            <td>
                <input placeholder="Default" type="number" name="dcl_gnrl_options[dcl_div_width]" value="<?php echo $options['dcl_div_width']; ?>" size="20">
                <input type="radio" name="dcl_gnrl_options[dcl_div_width_type]" <?php checked( $options['dcl_div_width_type'], '%' ); ?> value="%">%
                <input type="radio" name="dcl_gnrl_options[dcl_div_width_type]" <?php checked( $options['dcl_div_width_type'], 'px' ); ?> value="px">px<br/>
                <span class="description thin"><?php _e( 'If Disqus comments are not looking good because of the large or smaller width, you can adjust the width of comments division here. Just enter the width size. Leave empty if not required.', DCL_DOMAIN ); ?></span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <label><?php _e( 'Count Script', DCL_DOMAIN ); ?><br>
                    <span class="description thin"><?php _e( 'only load if needed', DCL_DOMAIN ); ?></span>
                </label>
            </th>
            <td>
                <select id="dcl_count_disable" class="select" typle="select" name="dcl_gnrl_options[dcl_count_disable]">
                    <option value="1" <?php selected( $options['dcl_count_disable'], 1 ); ?>>Enable</option>
                    <option value="0" <?php selected( $options['dcl_count_disable'], 0 ); ?>>Disable</option>
                </select>
                <br/>
                <span class="description thin"><?php _e( 'By default Disqus may load a script (count.js) to get the comments count to show somewhere on your pages. Disabling this feature can improve your page loading speed but may conflict with some themes.', DCL_DOMAIN ); ?></span>
            </td>
        </tr>
        <div id="button_prop">
            <tr valign="top">
                <th scope="row">
                    <label><?php _e( 'Button Text', DCL_DOMAIN ); ?><br>
                        <span class="description thin"><?php _e( 'to attract visitors', DCL_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input placeholder="Load Comments" type="text" name="dcl_gnrl_options[dcl_btn_txt]" value="<?php echo $options['dcl_btn_txt']; ?>" size="20"><br/>
                    <span class="description thin"><?php _e( 'If you are loading Disqus using On Click feature, then there will be a button to load comments. If you want to use custom text on the button, enter it here. By default it will be "Load Comments" (Works only with "On Click" option).', DCL_DOMAIN ); ?></span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label><?php _e( 'Custom Button Class', DCL_DOMAIN ); ?><br>
                        <span class="description thin"><?php _e( 'to customize the button', DCL_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="text" name="dcl_gnrl_options[dcl_btn_class]" value="<?php echo $options['dcl_btn_class']; ?>" size="20"><br/>
                    <span class="description thin"><?php _e( 'Here you can add any custom class to the button. By using custom class you can use your own style for comment button. Leave empty if you do not care. (Works only with "On Click" option)', DCL_DOMAIN ); ?></span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label><?php _e( 'Loading Message', DCL_DOMAIN ); ?><br>
                        <span class="description thin"><?php _e( 'to impress visitors', DCL_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input placeholder="<?php _e( 'Loading..', DCL_DOMAIN ); ?>" type="text" name="dcl_gnrl_options[dcl_message]" value="<?php echo $options['dcl_message']; ?>" size="20"><br/>
                    <span class="description thin"><?php _e( 'There may be few milliseconds delay before Disqus starts loading when visitors clicks on the button. Enter something here, and we will show that during that delay. By Default it will be "Loading..". You may use html tags like <code>&lt;p&gt; &lt;b&gt; &lt;h2&gt;</code>(Works only with "On Click" option)', DCL_DOMAIN ); ?></span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label><?php _e( 'Disable on CPTs', DCL_DOMAIN ); ?><br>
                        <span class="description thin"><?php _e( 'to skip custom post types', DCL_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input placeholder="product" type="text" name="dcl_gnrl_options[dcl_cpt_exclude]" value="<?php echo $options['dcl_cpt_exclude']; ?>"><br/><br/>
                    <span class="description thin"><?php _e( 'If Disqus adds its scripts on custom post types, and you dont like it, enter the custom post type here. Separate with comma.', DCL_DOMAIN ); ?></span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label><?php _e( 'Caching Support', DCL_DOMAIN ); ?><br>
                        <span class="description thin"><?php _e( 'to work with caching plugins', DCL_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <select id="dcl_caching" class="select" name="dcl_gnrl_options[dcl_caching]">
                        <option value="1" <?php selected( $options['dcl_caching'], 1 ); ?>><?php _e( 'Enable', DCL_DOMAIN ); ?></option>
                        <option value="0" <?php selected( $options['dcl_caching'], 0 ); ?>><?php _e( 'Disable', DCL_DOMAIN ); ?></option>
                    </select>
                    <br/>
                    <span class="description thin">If you are having issues loading Disqus comments when caching is enabled, please enable this.</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label><?php _e( 'Rocker Loader Support', DCL_DOMAIN ); ?><br>
                        <span class="description thin">to ignore the Disqus script</span>
                    </label>
                </th>
                <td>
                    <select id="dcl_cfasync" class="select" name="dcl_gnrl_options[dcl_cfasync]">
                        <option value="1" <?php selected( $options['dcl_cfasync'], 1 ); ?>><?php _e( 'Enable', DCL_DOMAIN ); ?></option>
                        <option value="0" <?php selected( $options['dcl_cfasync'], 0 ); ?>><?php _e( 'Disable', DCL_DOMAIN ); ?></option>
                    </select>
                    <br/>
                    <span class="description thin"><?php _e( 'If you are using Cloudflare Rocker Loader, enable this to have <a href="https://support.cloudflare.com/hc/en-us/articles/200169436-How-can-I-have-Rocket-Loader-ignore-my-script-s-in-Automatic-Mode-" target="_blank">Rocket Loader ignore</a> the Disqus scripts by adding the <code>data-cfasync="false"</code> attribute to the script tag.', DCL_DOMAIN ); ?></span>
                </td>
            </tr>
        </div>
        </tbody>
    </table>
	<?php submit_button( __( 'Save All Changes', DCL_DOMAIN ) ); ?>
</form>