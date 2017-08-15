<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) or exit;

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
	<?php $btn_class = $dcl_helper->get_option( 'dcl_btn_class', '' ); ?>
	<?php $btn_text = $dcl_helper->get_option( 'dcl_btn_txt', __( 'Load Comments', DCL_DOMAIN ) ); ?>
	<?php $lazy_method = $dcl_helper->get_option( 'dcl_type', 'normal' ); ?>
	<?php if ( $lazy_method === 'click' ) : ?>
		<button id='dcl_comment_btn' class="<?php echo $btn_class; ?>"><?php echo $btn_text; ?></button>
	<?php endif; ?>
</div>
