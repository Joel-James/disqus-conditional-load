<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die('Damn it.! Dude you are looking for what?');
}

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link		http://dclwp.com
 * @since		10.0.0
 * @package		DCL
 * @subpackage	DCL/includes
 * @author		Joel James <me@joelsays.com>
 */
class DCL_Activator {

    /**
     * Function to run during activation
     * Transfering old options to new - DCL
     *
     * DCL Coding sturucture and options are changed to new sturcture.
     * So we need to transfer old values to new structure. This file will 
     * be used once. After transferring, we will never use these functions.
     *
     * @uses		update_option	To create/update the DCL settings.
     * @since    10.0.0
     * @author 	Joel James
     */
    public static function activate() {

        // Set default values for the plugin

        $dcl_type = self::transfer('js_type', 'dcl_type', 'scroll');
        $dcl_width = self::transfer('', 'dcl_div_width', '');
        $dcl_div_width_type = self::transfer('dcl_div_width_type', 'dcl_div_width_type', 'px');
        $dcl_button = self::transfer('js_button', 'dcl_btn_txt', 'Load Comments');
        $dcl_class = self::transfer('js_class', 'dcl_btn_class', '');
        $dcl_message = self::transfer('js_message', 'dcl_message', 'Loading...');
        $dcl_count_old = self::transfer('js_count_disable', 'dcl_count_disable', 'yes');
        $dcl_caching = self::transfer('dcl_caching', 'dcl_caching', 0);
        $dcl_cfasync = self::transfer('dcl_cfasync', 'dcl_cfasync', 0);
        $dcl_cpt_exclude = self::transfer('dcl_cpt_exclude', 'dcl_cpt_exclude', '');


        // Count disable value structure changed. So we are transfering to new structure
        $dcl_count_new = ( $dcl_count_old == 'yes' ) ? 0 : 1;

        // New general settings array to be added
        $newGnrlOptions = array(
            'dcl_type' => $dcl_type,
            'dcl_div_width' => $dcl_width,
            'dcl_div_width_type' => $dcl_div_width_type,
            'dcl_count_disable' => $dcl_count_new,
            'dcl_btn_txt' => $dcl_button,
            'dcl_btn_class' => $dcl_class,
            'dcl_message' => $dcl_message,
            'dcl_caching' => $dcl_caching,
            'dcl_cfasync' => $dcl_cfasync,
            'dcl_cpt_exclude' => $dcl_cpt_exclude
        );

        update_option('dcl_gnrl_options', $newGnrlOptions);

        // Add new option that checks for redirect after activation.
        add_option('dcl_do_activation_redirect', true);
    }

    /**
     * Function to get existing settings
     *
     * This function used to check if the new setting is already available
     * in datatabse, then consider that. Otherwise check for the old one 
     * and if available, takes that.
     * If both the values are not available, then creates new default setting.
     *
     * @var		string		Transferred settings value.
     * @since    10.0.0
     * @author 	Joel James
     * @return	$fresh		New value after transfer
     */
    public static function transfer($old, $new, $fresh) {

        // let us check if new options already exists
        if (get_option('dcl_gnrl_options')) {
            $dcl_option = get_option('dcl_gnrl_options');
            // If exists, then take that option value
            $fresh = (!empty($dcl_option[$new])) ? $dcl_option[$new] : $fresh;
            // Check if old value is available for the same option
            if (get_option($old)) {
                // If available delete it, as we are moving to new settings
                delete_option($old);
            }
        }
        // Fine, new options doesn't exist, then let us search for old
        else if (get_option($old)) {
            // Take old value and set it to new
            $fresh = get_option($old);
            // Delete it, as we are moving to new settings
            delete_option($old);
        }

        return $fresh;
    }

}
