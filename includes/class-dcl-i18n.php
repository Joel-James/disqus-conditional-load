<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) || die( 'K. Bye.' );

/**
 * DCL internationalization class.
 *
 * A class definition that sets textdomain for the plugin to make it compatible
 * with translations.
 *
 * @category   Core
 * @package    DCL
 * @subpackage i18n
 * @author     Joel James <mail@cjoel.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://dclwp.com
 */
class DCL_i18n  {

	/**
	 * Set the textdomain for the plugin.
	 *
	 * @since  2.0.0
	 * @access public
	 *
	 * @return void.
	 */
	public function set_textdomain() {

		load_plugin_textdomain( 'disqus-conditional-load', false, DCL_DIR . '/languages/' );
	}
}