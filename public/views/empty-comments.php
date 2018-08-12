<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) || die( 'K. Bye.' );

/**
 * Blank file to replace comments template.
 *
 * This is a blank file used to replace the comments template if comments shortcode
 * is used to display the comments. Unless we replace it, 2 instance of Disqus comments
 * may appear on the page.
 *
 * @category   Core
 * @package    DCL
 * @subpackage View
 * @author     Joel James <mail@cjoel.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://dclwp.com
 */

/**
 * Action hook to do something on empty comments area.
 *
 * This hook can be used to show any messages, images, text instead
 * of blank file, when comments template is being replaced by DCL if
 * shortcode is used.
 *
 * @since 11.0.0
 */
do_action( 'dcl_empty_comments' );