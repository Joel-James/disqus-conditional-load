<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) or exit;

/**
 * Admin functionality for Disqus Conditional Load.
 *
 * A class definition that includes attributes and functions used across the dashboard.
 *
 * @category   Core
 * @package    DCLAdmin
 * @subpackage Admin
 * @author     Joel James <mail@cjoel.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://dclwp.com
 */
class DCL_Admin {

	/**
	 * DCL plugin options.
	 *
	 * @since  11.0.0
	 * @access public
	 */
	private $options;

	/**
	 * Define the admin functionality of the plugin.
	 *
	 * Set the required properties of the core class.
	 *
	 * @param array $options Plugin options.
	 *
	 * @since  10.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct( $options ) {

		$this->options = $options;
	}

	/**
	 * Create a submenu page for Disqus settings.
	 *
	 * Register new submenu for DCL under Disqus menu, so it won't be
	 * confusing for users to find settings page.
	 *
	 * @uses   add_submenu_page() To register submenu.
	 * @since  3.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function create_menu() {

		$hook = add_submenu_page(
			'disqus',
			__( 'Disqus Conditional Load - Settings', DCL_DOMAIN ),
			__( 'Advanced - DCL', DCL_DOMAIN ),
			DCL_ACCESS,
			'dcl-settings',
			array( $this, 'admin_page' )
		);

		/**
		 * Action hook to register new submenu item under Disqus.
		 *
		 * @param $hook DCL Settings page hook.
		 * @since 11.0.0
		 */
		do_action( 'dcl_admin_menu', $hook );
	}

	/**
	 * Admin options page display for DCL.
	 *
	 * Admin page template to manage plugin settings and
	 * other options.
	 *
	 * @since  3.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function admin_page() {

		include_once DCL_DIR . 'admin/views/admin-display.php';
	}

	/**
	 * Registering DCL settings.
	 *
	 * Register all DCL settings options using WordPress settings API.
	 *
	 * @since  3.0.0
	 * @access public
	 * @uses   register_setting().
	 *
	 * @return void
	 */
	public function register_settings() {

		register_setting( 'dcl_gnrl_options', 'dcl_gnrl_options' );
	}

	/**
	 * Register the stylesheet for the DCL dashboard.
	 *
	 * This function is used to register all the required stylesheets for
	 * dashboard. Styles will be registered only for our plugin pages.
	 *
	 * @since  3.0.0
	 * @access public
	 * @global string $pagenow Current page.
	 * @uses   wp_enqueue_style To register styles.
	 *
	 * @return void
	 */
	public function enqueue_styles() {

		global $pagenow;

		// No. We don't load our custom css all over the admin. Load only on dcl page.
		if ( 'admin.php' === $pagenow && isset( $_GET['page'] ) && $_GET['page'] === 'dcl-settings' ) {

			// Use minified assets if SCRIPT_DEBUG is turned off.
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			// Register DCL admin page styles.
			wp_enqueue_style(
				DCL_NAME,
				DCL_PATH . 'admin/assets/css/admin' . $suffix . '.css',
				array(),
				DCL_VERSION,
				'all'
			);
		}
	}

}
