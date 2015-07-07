<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die('Damn it.! Dude you are looking for what?');
}
/**
 * The public-facing functionality of the plugin.
 *
 * Currently this class not doing anything for us. We may use it later.
 *
 * @link       http://dclwp.com
 * @since      10.0.0
 * @package    DCL
 * @subpackage DCL/public
 * @author     Joel James <me@joelsays.com>
 */
class DCL_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    10.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    10.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	/**
	 * The options of plugin.
	 *
	 * @since    10.0.0
	 * @access   protected
	 * @var      string    $options    The options from db.
	 */
	private $dcl_gnrl_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    10.0.0
	 * @var      string    $plugin_name       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $dcl_gnrl_options ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = $dcl_gnrl_options;
	}


}
