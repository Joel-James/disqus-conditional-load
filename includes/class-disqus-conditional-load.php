<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) or exit;

/**
 * Main Disqus Conditional Load plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @category   Core
 * @package    DCL
 * @subpackage Core
 * @author     Joel James <mail@cjoel.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://dclwp.com
 */
class Disqus_Conditional_Load {

	/**
	 * DCL plugin options.
	 *
	 * @since  11.0.0
	 * @access public
	 */
	private $options;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the required properties of the core class.
	 *
	 * @since  10.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {

		$this->options = get_option( 'dcl_gnrl_options', array() );

		// Load all required files.
		$this->load_dependencies();
		// Set plugin locale.
		//$this->locale();
	}

	/**
	 * Include plugin's required files.
	 *
	 * Load all required files for this plugin's functionality.
	 * All classes and helper functions will be loaded by this action.
	 *
	 * @since  3.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function load_dependencies() {

		include_once DCL_DIR . 'public/class-dcl-public.php';
		include_once DCL_DIR . 'admin/class-dcl-admin.php';
	}

	/**
	 * Plugin activation actions.
	 *
	 * Actions to perform during plugin activation.
	 * We will be registering default options in this function.
	 *
	 * @uses   register_activation_hook() To register activation hook.
	 * @since  3.0.0
	 * @access private
	 *
	 * @return void
	 */
	public function run() {

		$this->admin_hooks();
		//$this->public_hooks();
	}

	/**
	 * Plugin activation actions.
	 *
	 * Actions to perform during plugin activation.
	 * We will be registering default options in this function.
	 *
	 * @uses   register_activation_hook() To register activation hook.
	 * @since  3.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function admin_hooks() {

		// Required only when admin.
		if ( is_admin() ) {

			$admin = new DCL_Admin( $this->options );

			add_action( 'admin_menu', array( $admin, 'create_menu' ) );
			add_action( 'admin_init', array( $admin, 'register_settings' ) );
			add_action( 'admin_enqueue_scripts', array( $admin, 'enqueue_styles' ) );
		}
	}

	/**
	 * Plugin activation actions.
	 *
	 * Actions to perform during plugin activation.
	 * We will be registering default options in this function.
	 *
	 * @uses   register_activation_hook() To register activation hook.
	 * @since  3.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function public_hooks() {

		// Required only when public side of the site.
		if ( ! is_admin() ) {

			$public = new DCL_Public( $this->options );

			add_filter( 'respond_link', array( $public, 'respond_link' ), 99 );
		}
	}

	/**
	 * Initialize internationalization class.
	 *
	 * Load text domain for the internationalization functionality.
	 *
	 * @since  3.0.0
	 * @access private
	 *
	 * @return void.
	 */
	private function locale() {

		$locale = new DCL_i18n();

		add_action( 'plugins_loaded', array( $locale, 'set_textdomain' ) );
	}

}
