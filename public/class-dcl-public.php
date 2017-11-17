<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) or exit;

/**
 * Public facing functionality for Disqus Conditional Load.
 *
 * A class definition that includes attributes and functions used across the public
 * facing side of the plugin.
 *
 * @category   Core
 * @package    DCLPublic
 * @subpackage Public
 * @author     Joel James <mail@cjoel.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://dclwp.com
 */
class DCL_Public extends DCL_Helper {

	/**
	 * Define the public functionality of the plugin.
	 *
	 * Set the required properties of the core class.
	 *
	 * @param array $options Plugin options.
	 *
	 * @since  10.0.0
	 * @access public
	 */
	public function __construct( $options ) {

		// Initialize helper class.
		parent::__construct( $options );
	}

	/**
	 * Dequeue scripts registered by Disqus.
	 *
	 * Unregister scripts added by Disqus and we will load them
	 * later for optimising the speed.
	 *
	 * @since  11.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function dequeue_script() {

		// If lazy loading is enabled.
		if ( $this->is_lazy() ) {
			wp_dequeue_script( 'disqus_embed' );
		}

		// If comment count script was disabled.
		if ( $this->get_option( 'dcl_count_disable' ) ) {
			wp_dequeue_script( 'disqus_count' );
		}
	}

}
