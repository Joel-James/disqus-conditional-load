<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die('Damn it.! Dude you are looking for what?');
}
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 * This is used to define dashboard-specific hooks, and public-facing site hooks.
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @link       http://dclwp.com
 * @since      10.0.0
 * @package    DCL
 * @subpackage DCL/includes
 * @author     Joel James <me@joelsays.com>
 */
class DCL {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    10.0.0
	 * @access   protected
	 * @var      DCL_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    10.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    10.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;
	
	/**
	 * The options data of plugin.
	 *
	 * @since    10.0.0
	 * @access   protected
	 * @var      array    $dcl_gnrl_options    The options settings from db.
	 */
	protected $dcl_gnrl_options;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    10.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'disqus-conditional-load';
		$this->version = '10.1.1';
		$this->dcl_gnrl_options = get_option( 'dcl_gnrl_options' );
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->add_dcl_shortcodes();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - DCL_Loader. Orchestrates the hooks of the plugin.
	 * - DCL_Admin. Defines all hooks for the dashboard.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    10.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-dcl-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-dcl-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-dcl-activator.php';
		
		$this->loader = new DCL_Loader();

	}


	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since    10.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new DCL_Admin( $this->get_plugin_name(), $this->get_version(), $this->get_options() );

		$this->loader->add_action( 'admin_notices', $plugin_admin, 'dcl_setup_required_notice' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'dcl_create_menu');
		$this->loader->add_action( 'admin_init', $plugin_admin, 'dcl_options_register' );
		$this->loader->add_filter( 'admin_footer_text', $plugin_admin, 'dcl_dashboard_footer');
		$this->loader->add_filter( 'plugin_action_links', $plugin_admin, 'dcl_plugin_action_links', 10, 5 );
		$this->loader->add_filter( 'plugin_row_meta', $plugin_admin, 'dcl_plugin_row_meta', 10, 2 );
		$this->loader->add_action( 'plugins_loaded', $plugin_admin, 'dcl_upgrade_if_new' );
	}
	

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    10.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     10.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     10.0.0
	 * @return    DCL_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     10.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
	
	/**
	 * Retrieve the options values of the plugin.
	 *
	 * @since     10.0.0
	 * @return    string    The options values of the plugin.
	 */
	public function get_options() {
		return $this->dcl_gnrl_options;
	}


	/**
	 * Register the DCL shortcode with WordPress.
	 *
	 * @since     10.0.0
	 * @return    void.
	 */
	public function add_dcl_shortcodes() {
		// Add the shortcode for disqus comments
		add_shortcode( 'js-disqus', 'dcl_comments_output');
	}

}