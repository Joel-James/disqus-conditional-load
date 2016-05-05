<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die('Damn it.! Dude you are looking for what?');
}

/**
 * The public-facing functionality of the plugin.
 *
 * Currently this class not doing anything for us. We may use it later.
 *
 * @link       http://dclwp.com
 * @since      10.0.0
 * @package    DCL
 * @subpackage DCL/public
 * @author     Joel James <me@joelsays.com>
 */
class DCL_Public {

    /**
     * Change the respond/comments links
     * 
     * By default the respond links may be #respond.
     * Incase Disqus is unable to do that,
     * We will change that to #disqus_thread
     * 
     * @since 10.2.0
     * 
     * @return void
     */
    public function change_respond_link(){

        return get_permalink() . '#disqus_threads';
    }
}
