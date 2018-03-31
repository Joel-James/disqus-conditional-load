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
	 * DCL Helper instance.
	 *
	 * @var DCL_Helper
	 */
	private $helper;

	/**
	 * Define the public functionality of the plugin.
	 *
	 * Set the required properties of the core class.
	 *
	 * @param array $helper Plugin options.
	 *
	 * @since  10.0.0
	 * @access public
	 */
	public function __construct() {

		global $dcl_helper;

		$this->helper = $dcl_helper;
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
			__( 'DCL Settings', DCL_DOMAIN ),
			DCL_ACCESS,
			'dcl-settings',
			array( $this, 'admin_page' )
		);

		/**
		 * Action hook to register new submenu item under Disqus.
		 *
		 * @param $hook DCL Settings page hook.
		 *
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
	 * @uses   wp_enqueue_style To register styles.
	 *
	 * @return void
	 */
	public function enqueue_styles() {

		// No. We don't load our custom css all over the admin. We are not idiots!
		if ( $this->helper->is_dcl_page() ) {

			// Use minified assets if SCRIPT_DEBUG is turned off.
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			// Use minified assets if SCRIPT_DEBUG is turned off.
			$dir = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : 'min/';

			// Register DCL admin page styles.
			wp_enqueue_style( DCL_NAME, DCL_PATH . 'admin/assets/css/' . $dir . 'admin' . $suffix . '.css', array(), DCL_VERSION, 'all' );
		}
	}

	/**
	 * Custom footer text about DCL.
	 *
	 * Add some custom text to DCL admin pages. Don't add to other pages.
	 * We can show Pro version link, reviews link etc.
	 *
	 * @since  10.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function footer_text() {

		if ( $this->helper->is_dcl_page() ) {

			// Custom footer text with links to reviews and pro version.
			printf(
				__( 'Thank you for choosing this DCL | <a href="%s">Upgrade to DCL Pro</a> | <a href="%s">Rate it %s</a>', DCL_DOMAIN ),
				esc_url( 'https://dclwp.com' ),
				esc_url( 'https://wordpress.org/support/plugin/disqus-conditional-load/reviews/?filter=5#postform' ),
				'&#9733; &#9733; &#9733; &#9733; &#9733;'
			);

			/**
			 * Hook to add custom text along with DCL text.
			 *
			 * @since 11.0.0
			 */
			do_action( 'dcl_admin_footer_text' );
		}
	}

	/**
	 * Custom plugin action link to DCL pages.
	 *
	 * Add a quick link to DCL settings page from WordPress plugins
	 * listing page screen.
	 *
	 * @param array  $links Existing links.
	 * @param string $file  Plugin file name.
	 *
	 * @since 10.0.0
	 * @access public
	 *
	 * @return array $links Altered links.
	 */
	public function action_links( $links, $file ) {

		// Check if it is our plugin listing slot.
		if ( basename( $file ) === basename( DCL_BASE_FILE ) ) {

			// Prepare our custom link.
			$link = sprintf ( __( '<a href="%s">Settings</a>', DCL_DOMAIN ), 'admin.php?page=dcl-settings' );
			// Insert our custom link at the beginning.
			array_unshift( $links, $link );

			/**
			 * Hook to add custom links to DCL plugin action links.
			 *
			 * @param array $links Current array of links.
			 *
			 * @since 11.0.0
			 */
			do_action( 'dcl_admin_action_links', $links );
		}

		return $links;
	}

	/**
	 * Plugin row meta links for DCL.
	 *
	 * @param array $input Already defined meta links
	 * @param string $file Plugin file path and name being processed
	 *
	 * @since  10.0.0
	 * @access public
	 *
	 * @return array $input
	 */
	public function plugin_row_meta( $input, $file ) {

		// DCL base file path.
		$dcl_file = DCL_NAME . '/' . basename( DCL_BASE_FILE );

		// Check if currently processing file is DCL.
		if ( $dcl_file === $file ) {

			// Our custom link to Pro.
			$link = array( sprintf( __( '<a href="%s">Upgrade to Pro</a>', DCL_DOMAIN ), 'https://dclwp.com' ) );
			// Merge them to existing links.
			$input = array_merge( $input, $link );

			/**
			 * Hook to add custom links to DCL plugin row links.
			 *
			 * @param array $link Current array of links.
			 *
			 * @since 11.0.0
			 */
			do_action( 'dcl_plugin_row_meta', $link );
		}

		return $input;
	}

}
