<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) || die( 'K. Bye.' );

/**
 * Helper functions for Disqus Conditional Load.
 *
 * Common functions that can be commonly used in DCL, in order to
 * avoid duplicating multiple times.
 *
 * @category   Core
 * @package    DCLAdmin
 * @subpackage Helper
 * @author     Joel James <mail@cjoel.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://dclwp.com
 */
class DCL_Helper {

	/**
	 * DCL plugin options.
	 *
	 * @var array
	 * @access public
	 */
	public $options;

	/**
	 * Available lazy load options.
	 *
	 * @var array
	 * @access public
	 */
	public $methods;

	/**
	 * Disqus short name.
	 *
	 * @var string
	 * @access public
	 */
	public $short_name;

	/**
	 * Disqus public key.
	 *
	 * @var string
	 * @access public
	 */
	public $public_key = false;

	/**
	 * Check if DCL is ready to run.
	 *
	 * @var bool
	 * @access public
	 */
	public $dcl_ready = false;

	/**
	 * Set the required properties of the core class.
	 *
	 * @param array $options DCL options.
	 *
	 * @since  11.0.0
	 * @access public
	 */
	public function __construct( $options = array() ) {

		$this->options = $options;

		// Disqus short name.
		$this->short_name = strtolower( get_option( 'disqus_forum_url' ) );

		// Disqus public key.
		$this->public_key = esc_attr( get_option( 'disqus_public_key' ) );

		// Check if DCL is ok to run.
		$this->dcl_ready = $this->dcl_ready();

		/**
		 * Filter hook to alter lazy load methods.
		 *
		 * @param array Lazy load methods.
		 *
		 * @since 11.0.0
		 */
		$this->methods = apply_filters( 'dcl_lazy_load_methods', array( 'scroll', 'click' ) );
	}

	/**
	 * Check if it is safe to run DCL.
	 *
	 * @since  11.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public function dcl_ready() {

		// Verify that Disqus is not active, or active version is compatible.
		if ( $this->is_disqus_active() && ! $this->is_disqus_compatible() ) {
			return false;
		}

		return true;
	}

	/**
	 * Check if current page is a DCL page.
	 *
	 * This function can be used to check if we are on a custom DCL page,
	 * before processing any other actions. Useful to load assets.
	 *
	 * @since  11.0.0
	 * @access public
	 * @global string $pagenow Current page.
	 *
	 * @return bool
	 */
	public function is_dcl_page() {

		global $pagenow;

		$is_it = false;

		// DCL page slugs.
		$dcl_pages = array( 'dcl-settings' );

		// Check current page slug and compare with our slugs. Yeah, we ignore other guys.
		if ( 'admin.php' === $pagenow && isset( $_GET['page'] ) && in_array( $_GET['page'], $dcl_pages, true ) ) {
			$is_it = true;
		}

		/**
		 * Filter to alter the dcl page check.
		 *
		 * @param $is_it bool Is current page a dcl page?
		 *
		 * @since 11.0.0
		 */
		return apply_filters( 'dcl_is_current_page_dcl', $is_it );
	}

	/**
	 * Check if official Disqus plugin latest version is installed already.
	 *
	 * If user installed and activated official Disqus plugin already,
	 * we can avoid loading Didqus from our plugin's vendor directory.
	 *
	 * @since  11.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public function is_disqus_active() {

		/**
		 * Filter hook to alter Disqus official plugin directory.
		 *
		 * @since 11.0.0
		 */
		$disqus_file = apply_filters( 'dcl_disqus_file', 'disqus-comment-system/disqus.php' );

		return $this->plugin_active( $disqus_file );
	}

	/**
	 * Check if compatible Disqus version is installed.
	 *
	 * Our compatible version has a core class called "Disqus".
	 *
	 * @since  11.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public function is_disqus_compatible() {

		return $this->is_disqus_active() && function_exists( 'run_disqus' );
	}

	/**
	 * Check if given plugin is active on the site
	 *
	 * @param string $plugin Plugin file.
	 *
	 * @since  11.0.0
	 * @access private
	 *
	 * @return bool
	 */
	private function plugin_active( $plugin ) {

		// If in case helper function does not exist.
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		return is_plugin_active( $plugin );
	}

	/**
	 * Get single DCL option value from options.
	 *
	 * @param string $key Option key.
	 * @param bool|string $group Settings group.
	 * @param bool $default Default value.
	 *
	 * @since  11.0.0
	 * @access public
	 *
	 * @return mixed
	 */
	public function get_option( $key = '', $group = false, $default = false ) {

		// Return default value if not found or key is empty.
		if ( empty( $key ) && empty( $group ) ) {
			return $this->options;
		} elseif ( ! empty( $key ) && empty( $group ) ) {
			// This is for free version to get options.
			return $this->get_option_group( 'dcl_gnrl_options', $key, $default );
		} elseif ( empty( $key ) && ! empty( $group ) ) {
			// This can be used as alias for `get_option_group` method.
			return $this->get_option_group( $group, false, $default );
		}

		return $default;
	}

	/**
	 * Get DCL options group value from options.
	 *
	 * @param bool|string $group Settings group.
	 * @param string $key Option key.
	 * @param bool $default Default value.
	 *
	 * @since  11.0.0
	 * @access public
	 *
	 * @return mixed
	 */
	public function get_option_group( $group, $key = false, $default = false ) {

		// Return default value if not found or key is empty.
		if ( empty( $group ) ) {
			return $this->options;
		} elseif ( ! empty( $key ) && ! empty( $group ) && isset( $this->options[ $group ] ) && isset( $this->options[ $group ][ $key ] ) ) {
			return $this->options[ $group ][ $key ];
		} elseif ( ! empty( $group ) && isset( $this->options[ $group ] ) ) {
			return $this->options[ $group ];
		}

		return $default;
	}

	/**
	 * Check if any lazy load method is active.
	 *
	 * Check if any of the lazy load methods are enabled to
	 * load Disqus comments.
	 *
	 * @since  11.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public function is_lazy() {

		// Get loading method.
		$type = $this->get_option( 'dcl_type' );

		// Is lazy loaded?
		$is_lazy = in_array( $type, $this->methods, true );

		/**
		 * Filter hook to change lazy load check.
		 *
		 * @param bool $is_lazy Is lazy?
		 * @param string $type Lazy load type.
		 *
		 * @since 11.0.0
		 */
		return apply_filters( 'dcl_is_lazy', $is_lazy, $type );
	}

	/**
	 * Get comments loading method.
	 *
	 * Get the lazy loading method name or if not lazy
	 * load enabled, return normal.
	 *
	 * @since  11.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_load_method() {

		// Get loading method.
		$type = $this->get_option( 'dcl_type' );

		/**
		 * Filter hook to change load method.
		 *
		 * @param string $type Lazy load type.
		 *
		 * @since 11.0.0
		 */
		return apply_filters( 'dcl_load_method', $type );
	}

	/**
	 * Check if current visitor's user agent is a bot.
	 *
	 * Check if user agent string matches bots, spiders or crawlers.
	 * If user agent is not set, consider visitor as bot.
	 *
	 * @since  11.0.
	 * @access private
	 *
	 * @return bool
	 */
	public function is_bot() {

		// If user agent is not set, flag them as bot.
		if ( ! isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
			return true;
		}

		// Check if any type of bot, spider or crawler is visiting.
		if ( preg_match( '/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'] ) ) {
			return true;
		}

		return false;
	}
}
