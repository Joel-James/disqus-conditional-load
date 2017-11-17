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
class Disqus_Conditional_Load extends DCL_Helper  {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the required properties of the core class.
	 *
	 * @since  10.0.0
	 * @access public
	 */
	public function __construct() {

		if ( $this->can_run( true ) ) {

			// Get dcl settings.
			$options = get_option( 'dcl_gnrl_options', array() );

			// Initialize helper class.
			parent::__construct( $options );

			// Load all required files.
			$this->load_dependencies();
			// Set plugin locale.
			//$this->locale();
		}
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

		// If official Disqus plugin is active, we don't need to load Disqus again.
		if ( ! $this->is_disqus_compatible() ) {
			// Load disqus from our vendor directory.
			//require_once DCL_DIR . 'vendor/disqus/disqus/disqus.php';
		}

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

		if ( $this->can_run() ) {
			$this->admin_hooks();
			//$this->public_hooks();
		}
	}

	/**
	 * Check if it is safe to run DCL.
	 *
	 * @param bool $notice Should show admin warning notice?
	 *
	 * @since  11.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public function can_run( $notice = false ) {

		// Verify that Disqus is not active, or active version is compatible.
		if ( $this->is_disqus_active() && ! $this->is_disqus_compatible() ) {

			if ( $notice ) {
				// If a incompatible version is active, show error.
				add_action( 'admin_notices', array( $this, 'incompatible_alert' ) );
			}

			return false;
		}

		return true;
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

			add_action( 'admin_menu', array( $admin, 'create_menu' ), 15 );
			add_action( 'admin_init', array( $admin, 'register_settings' ) );
			add_action( 'admin_enqueue_scripts', array( $admin, 'enqueue_styles' ) );

			add_filter( 'admin_footer_text', array( $admin, 'footer_text' ) );
			add_filter( 'plugin_action_links', array( $admin, 'action_links' ), 10, 5 );
			add_filter( 'plugin_row_meta', array( $admin, 'plugin_row_meta' ), 10, 2 );
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

			add_action( 'wp_print_scripts', array( $public, 'dequeue_script' ), 100 );
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

	/**
	 * Alert message if incompatible Disqus plugin is active.
	 *
	 * Alert use about the active incompatible plugin.
	 *
	 * @since  11.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function incompatible_alert() {

		$html = '<div class="notice notice-error">';
        $html .= '<p>';
		$html .= __( 'An incompatible version of Disqus plugin is already active. <strong>Disqus Conditional Load</strong> will not work, until you deactivate it or update your Disqus official plugin to latest version (3.0+). <strong>Disqus Conditional Load</strong> can work even if you deactivate official Disqus plugin.', DCL_DOMAIN );
		$html .= '</p>';
		$html .= '</div>';

		/**
		 * Filter hook to alter message content.
		 *
		 * @param string $html Message content.
		 *
		 * @since 11.0.0
		 */
		echo apply_filters( 'dcl_incompatible_alert_text', $html );
	}

}
