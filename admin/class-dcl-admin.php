<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) || die( 'K. Bye.' );

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
			__( 'Disqus Conditional Load - Settings', 'disqus-conditional-load' ),
			__( 'DCL Settings', 'disqus-conditional-load' ),
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

		register_setting( 'dcl_general', 'dcl_gnrl_options' );
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

			// Register DCL admin page styles.
			wp_enqueue_style( DCL_NAME, DCL_PATH . 'assets/css/admin.min.css', array(), DCL_VERSION, 'all' );
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
				// translators: These are the links to upgrade and leave a review.
				esc_html__( 'Thank you for choosing this DCL | %1$sUpgrade to DCL Pro%4$s | %2$sRate it %3$s%4$s', 'disqus-conditional-load' ),
				'<a href="https://dclwp.com" target="_blank">',
				'<a href="https://wordpress.org/support/plugin/disqus-conditional-load/reviews/?filter=5#postform" target="_blank">',
				'&#9733; &#9733; &#9733; &#9733; &#9733;',
				'</a>'
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
			// Translators: Link to DCL settings.
			$link = sprintf( __( '%1$sSettings%2$s', 'disqus-conditional-load' ), '<a href="admin.php?page=dcl-settings">', '</a>' );
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
	 * @param array  $input Already defined meta links.
	 * @param string $file Plugin file path and name being processed.
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
			// Translators: Link to pro.
			$link = array( sprintf( __( '%1$sUpgrade to Pro%2$s', 'disqus-conditional-load' ), '<a href="https://dclwp.com">', '</a>' ) );
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

	/**
	 * Show alert if Disqus is not configured.
	 *
	 * @since 11.0.0
	 *
	 * @return void
	 */
	public function not_configured_alert() {

		global $dcl_helper;

		// If not configured.
		if ( empty( $dcl_helper->short_name ) && $dcl_helper->is_dcl_page() ) {
			$html = '<div class="notice notice-warning">';
			$html .= '<p>';
			$html .= sprintf( __( '%1$sDisqus Conditional Load%2$s will not work, unless you %3$sfinish Disqus setup%4$s.', 'disqus-conditional-load' ), '<strong>', '</strong>', '<a href="' . admin_url( 'admin.php?page=disqus' ) . '">', '</a>' );
			$html .= '</p>';
			$html .= '</div>';

			/**
			 * Filter hook to alter message content.
			 *
			 * @param string $html Message content.
			 *
			 * @since 11.0.0
			 */
			echo apply_filters( 'dcl_not_configured_alert_text', $html );
		}
	}
}
