<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) || die( 'K. Bye.' );

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
final class Disqus_Conditional_Load {

	/**
	 * Single instance of DCL main class.
	 *
	 * @var Disqus_Conditional_Load
	 *
	 * @since 11.0.0
	 */
	public static $instance;

	/**
	 * Admin class instance.
	 *
	 * @var DCL_Admin
	 *
	 * @since 11.0.0
	 */
	public $admin;

	/**
	 * Public class instance.
	 *
	 * @var DCL_Public
	 *
	 * @since 11.0.0
	 */
	public $public;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the required properties of the core class.
	 *
	 * @since  10.0.0
	 * @access public
	 */
	private function __construct() {

		global $dcl_helper;

		// Get dcl settings.
		$options = array(
			'dcl_gnrl_options' => get_option( 'dcl_gnrl_options', array() ),
		);

		// DCL helper class instance.
		$dcl_helper = new DCL_Helper( $options );

		// Run dcl if ready.
		if ( $dcl_helper->dcl_ready ) {

			// Load all required files.
			$this->load_dependencies();

			// Set plugin locale.
			$this->locale();

		} else {
			// If a incompatible version is active, show error.
			add_action( 'admin_notices', array( $this, 'incompatible_alert' ) );
		}
	}

	/**
	 * Main Disqus_Conditional_Load instance.
	 *
	 * Insures that only one instance of Disqus_Conditional_Load exists in memory.
	 * Also prevents needing to define globals all over the place.
	 *
	 * @since 11.0.0
	 *
	 * @return Disqus_Conditional_Load
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Disqus_Conditional_Load ) ) {
			// Main plugin class.
			self::$instance = new Disqus_Conditional_Load();

			global $dcl_helper;

			if ( $dcl_helper->dcl_ready ) {

				// Public class instance.
				self::$instance->public = new DCL_Public();

				// Admin class instance.
				self::$instance->admin = new DCL_Admin();

				self::$instance->run();
			}
		}

		return self::$instance;
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

		global $dcl_helper;

		// Internationalization.
		include_once DCL_DIR . 'includes/class-dcl-i18n.php';

		// If official Disqus plugin is active, we don't need to load Disqus again.
		if ( ! $dcl_helper->is_disqus_compatible() ) {
			global $DISQUSVERSION;
			// Make sure disqus version is set.
			$DISQUSVERSION = DCL_DISQUS_VERSION;
			// Load disqus from our vendor directory.
			require_once DCL_DIR . 'vendor/disqus-comment-system/disqus.php';
		}

		// Public functionality.
		include_once DCL_DIR . 'public/class-dcl-public.php';

		// Admin functionality.
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

		global $dcl_helper;

		if ( $dcl_helper->dcl_ready ) {

			$this->admin_hooks();

			$this->public_hooks();

			/**
			 * Action hook to run after DCL starts running.
			 *
			 * @since 11.0.0
			 */
			do_action( 'dcl_running' );
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
	private function admin_hooks() {

		// Required only when admin.
		if ( is_admin() ) {
			$admin = self::$instance->admin;

			add_action( 'admin_menu', array( $admin, 'create_menu' ), 15 );
			add_action( 'admin_init', array( $admin, 'register_settings' ) );
			add_action( 'admin_enqueue_scripts', array( $admin, 'enqueue_styles' ) );

			add_filter( 'admin_footer_text', array( $admin, 'footer_text' ) );
			add_filter( 'plugin_action_links', array( $admin, 'action_links' ), 10, 5 );
			add_filter( 'plugin_row_meta', array( $admin, 'plugin_row_meta' ), 10, 2 );

			// Show alert if Disqus is not configured.
			add_action( 'admin_notices', array( $admin, 'not_configured_alert' ) );
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
			$public = self::$instance->public;

			add_action( 'wp_print_scripts', array( $public, 'dequeue_scripts' ), 100 );
			add_action( 'wp_enqueue_scripts', array( $public, 'enqueue_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $public, 'add_inline_styles' ) );
			add_action( 'comments_template', array( $public, 'remove_disqus_template' ), 15 );

			add_filter( 'comments_template', array( $public, 'comments_template' ), 100 );
			add_filter( 'script_loader_tag', array( $public, 'add_additional_attrs' ), 10, 3 );

			// DCL comments shortcode.
			add_shortcode( 'dcl-comments', array( $public, 'comment_shortcode' ) );
			// Backward compatibility for shortcode.
			add_shortcode( 'js-disqus', array( $public, 'comment_shortcode' ) );

			// Rewrite the comments link to Disqus thread.
			add_filter( 'respond_link', array( $public, 'comments_link' ), 99 );
			add_filter( 'get_comments_link', array( $public, 'comments_link' ), 99 );
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
		$html .= sprintf( __( 'An incompatible version of Disqus plugin is already active. %1$sDisqus Conditional Load%2$s will not work, until you %1$sdeactivate%2$s it or update your Disqus official plugin to latest version (3.0+).', 'disqus-conditional-load' ), '<strong>', '</strong>' );
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
