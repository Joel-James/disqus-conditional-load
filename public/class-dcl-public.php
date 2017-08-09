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
 * @package    DCLAdmin
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

}
