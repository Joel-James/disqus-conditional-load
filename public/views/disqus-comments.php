<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) || die( 'K. Bye.' );

/**
 * Disqus comments template.
 *
 * Comments template to replace with other templates.
 *
 * @category   Core
 * @package    DCL
 * @subpackage View
 * @author     Joel James <mail@cjoel.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://dclwp.com
 */
?>
<div id="disqus_thread">
	<?php global $dcl_helper; ?>
	<?php if ( $dcl_helper->get_load_method() === 'click' ) : ?>
		<div id="dcl_btn_container">
			<button id='dcl_comment_btn' class="<?php echo esc_html( apply_filters( 'dcl_button_class', $dcl_helper->get_option( 'dcl_btn_class', false, '' ) ) ); ?>">
				<?php echo esc_html( apply_filters( 'dcl_button_text', $dcl_helper->get_option( 'dcl_btn_txt', false, __( 'Load Comments', 'disqus-conditional-load' ) ) ) ); ?>
			</button>
		</div>
	<?php endif; ?>
</div>
