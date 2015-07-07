<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die('Damn it.! Dude you are looking for what?');
}
/*
* This page is used to replace the comments area if the comments are loaded in shortcode already.
* We use this file in order to avoid showing default WordPress comments area.
* If we do not return something instead of comments, WordPress will show the default comments
* form. You may change this from,
		***** disqus.php   -   line 966
*
* @link       http://dclwp.com
* @since      10.0.0
*
* @package    DCL
* @subpackage DCL/public
* @author	  Disqus
*/