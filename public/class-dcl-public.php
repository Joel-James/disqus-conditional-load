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
class DCL_Public {

	/**
	 * Disqus public class instance.
	 *
	 * @var Disqus_Public
	 */
	private $disqus_public;

	/**
	 * DCL helper class.
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
	 * Dequeue scripts registered by Disqus.
	 *
	 * We need to remove Disqus embed script is any lazy load method is enabled.
	 * We will load our custom script later to lazy load comments.
	 *
	 * @since  11.0.0
	 * @access public
	 * @uses   wp_dequeue_script
	 *
	 * @return void
	 */
	public function dequeue_scripts() {

		// Continue only if all worked fine.
		if ( ! $this->dcl_can_load( 'embed' ) ) {
			return;
		}

		// Check if lazy load enabled.
		$is_lazy = $this->helper->is_lazy();

		// If lazy load enabled, remove embed script.
		if ( $is_lazy ) {
			wp_dequeue_script( 'disqus_embed' );
		}

		// We don't need an extra script for count.
		// We will include them in one file.
		wp_dequeue_script( 'disqus_count' );
		// We don't need comment-reply js.
		wp_dequeue_script( 'comment-reply' );
	}

	/**
	 * Register custom scripts for Disqus.
	 *
	 * Register our custom script for Disqus comments and
	 * set the localized variables.
	 *
	 * @since  11.0.0
	 * @access public
	 * @uses   wp_dequeue_script
	 *
	 * @return void
	 */
	public function enqueue_scripts() {

		global $post, $dcl_helper;

		// We need Disqus_Public class.
		if ( ! class_exists( 'Disqus_Public' ) ) {
			return;
		}
		// If a bot is the visitor, do not continue.
		if ( $this->helper->is_bot() ) {
			return;
		}
		// Do not continue if comments can't be loaded.
		if ( ! $this->dcl_embed_can_load_for_post( $post ) ) {
			return;
		}

		// Get the file name.
		$file = $this->get_script_name();
		// Use minified assets if SCRIPT_DEBUG is turned off.
		$dir = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : 'min/';

		// Enqueue the file.
		wp_enqueue_script( 'dcl_comments', DCL_PATH . 'public/js/' . $dir . $file, array(), DCL_VERSION, true );
		// Custom vars for dcl.
		$custom_vars = array(
			'dcl_progress_text' => $dcl_helper->get_option( 'dcl_message', __( 'Loading Comments....', DCL_DOMAIN ) ),
		);

		$custom_vars = apply_filters( 'dcl_custom_vars', $custom_vars );

		/**
		 * Filter hook to alter count vars.
		 *
		 * @param string Script name.
		 * @param string Lazy load method.
		 *
		 * @since 11.0.0
		 */
		$count_vars = apply_filters( 'dcl_count_vars', array( 'disqusShortname' => $this->helper->short_name ) );

		/**
		 * Filter hook to alter comment embed vars.
		 *
		 * @param string Script name.
		 * @param string Lazy load method.
		 *
		 * @since 11.0.0
		 */
		$embed_vars = apply_filters( 'dcl_script_file_name', Disqus_Public::embed_vars_for_post( $post ) );

		// Localize and set all variables.
		wp_localize_script( 'dcl_comments', 'countVars', $count_vars );
		wp_localize_script( 'dcl_comments', 'embedVars', $embed_vars );
		wp_localize_script( 'dcl_comments', 'dclCustomVars', $custom_vars );
	}

	/**
	 * Add additional script tags for rocket loader.
	 *
	 * For rocket loader support we need to add an additional tag to the
	 * script tag. Otherwise rocket loader will not ignore our script.
	 *
	 * @param string $tag Script tag.
	 * @param string $handle Script handle.
	 * @param string $src Script src.
	 *
	 * @return string
	 */
	public function add_additional_attrs( $tag, $handle, $src ) {

		global $dcl_helper;

		// Add only to our script.
		if ( $handle === 'dcl_comments' && (bool) $dcl_helper->get_option( 'dcl_cfasync', 0 ) ) {
			$tag = '<script type="text/javascript" src="' . $src . '" data-cfasync="false"></script>';
		}

		return $tag;
	}

	/**
	 * Get script file name based on the lazy load setting.
	 *
	 * We have custom script files based on the DCL settings
	 * chosen by the user. We have created custom scripts by combining
	 * count scripts if not disabled.
	 *
	 * @since 11.0.0
	 * @access private
	 *
	 * @return string Custom script file name.
	 */
	private function get_script_name() {

		// Base name of the file.
		$file = 'embed';

		// Lazy load method.
		$method = $this->helper->get_load_method();

		// If count is not disabled.
		if ( (bool) $this->helper->get_option( 'dcl_count_disable', 1 ) ) {
			$file .= '-count';
		}

		// If a valid lazy load method.
		if ( in_array( $method, $this->helper->methods ) ) {
			$file .= '-' . $method;
		}

		// Use minified assets if SCRIPT_DEBUG is turned off.
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		/**
		 * Filter hook to alter file name.
		 *
		 * @param string Script name.
		 * @param string Lazy load method.
		 *
		 * @since 11.0.0
		 */
		return apply_filters( 'dcl_script_file_name', $file . $suffix .'.js', $method );
	}

	/**
	 * Shortcode content for comments shortcode (js-disqus).
	 *
	 * Output comments template as output of js-disqus shortcode.
	 * This shortcode will work only on a singular post/page.
	 *
	 * @since 11.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function comment_shortcode() {

		global $post;

		// Don't load embed if it's not a single post page.
		if ( ! is_singular() || ! $this->dcl_embed_can_load_for_post( $post ) ) {
			return;
		}

		ob_start();

		// Load the comments template.
		comments_template();

		$output = ob_get_contents();;

		ob_end_clean();

		// Now set the comments template as an empty file.
		add_filter( 'comments_template', array( $this, 'empty_comments' ), 30 );

		return $output;
	}

	/**
	 * Set and empty file as comments template.
	 *
	 * Get the empty file to replace the comments template with.
	 *
	 * @since 11.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function empty_comments() {

		return DCL_DIR . 'public/views/empty-comments.php';
	}

	/**
	 * Customized disqus comments template.
	 *
	 * Get our customized Disqus comments template.
	 *
	 * @param string $template Comments template.
	 *
	 * @since 11.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function disqus_comments_template( $template ) {

		global $post;

		if ( ! $this->helper->is_bot() && $this->dcl_embed_can_load_for_post( $post ) ) {
			return DCL_DIR . 'public/views/disqus-comments.php';
		}

		return $template;
	}

	/**
	 * Remove Disqus comments template.
	 *
	 * We should show default WordPress comments to search engine
	 * crawlers and bots for SEO benefit.
	 *
	 * @since 11.0.0
	 * @access private
	 *
	 * @return void
	 */
	public function dcl_comments_template() {

		// Remove comments template filter.
		remove_filter( 'comments_template', array( $this->disqus_public, 'dsq_comments_template' ) );
	}

	/**
	 * Add inline style to adjust comments width.
	 *
	 * We need just one line of style to adjust the width. So adding
	 * a separate css file just for this is not a good idea.
	 *
	 * @since 3.0
	 * @access public
	 *
	 * @return void
	 */
	public function add_inline_styles() {

		global $dcl_helper;

		$custom_css = '';

		$load_method = $dcl_helper->get_load_method();
		// Get the assigned width.
		$width = ( int) $dcl_helper->get_option( 'dcl_div_width', 0 );
		// Get the width type.
		$width_type = $dcl_helper->get_option( 'dcl_div_width_type', '%' );
		// Add width style if required.
		if ( $width > 0  && in_array( $width_type, array( '%', 'px' ) ) ) {
			$custom_css .= "#disqus_thread{width: {$width}{$width_type};margin: 0 auto;}";
		}
		// Add button style if required.
		if ( $load_method === 'click' ) {
			$custom_css .= '#dcl_btn_container{text-align: center;margin-top:10px;margin-bottom:10px}';
		}

		// Make sure we need to add inline style.
		if ( ! empty( $custom_css ) ) {
			// Register a dummy stylesheet for inline styles.
			wp_register_style( 'dcl-front-style-dummy', false );
			wp_enqueue_style( 'dcl-front-style-dummy' );
			// Add inline.
			wp_add_inline_style( 'dcl-front-style-dummy', $custom_css );
		}
	}

	/**
	 * Determines if Disqus is configured and can the comments embed on a given page.
	 *
	 *  This function is taken from Disqus official plugin.
	 *
	 * @param WP_Post $post The WordPress post used to determine if Disqus can be loaded.
	 *
	 * @since 3.0
	 * @access private
	 *
	 * @return boolean Whether Disqus is configured properly and can load on the current page.
	 */
	private function dcl_embed_can_load_for_post( $post ) {

		// Checks if the plugin is configured properly
		// and is a valid page.
		if ( ! $this->dcl_can_load( 'embed' ) ) {
			return false;
		}
		// Make sure we have a $post object.
		if ( ! isset( $post ) ) {
			return false;
		}
		// Don't load embed for certain types of non-public posts because these post types typically still have the
		// ID-based URL structure, rather than a friendly permalink URL.
		$illegal_post_statuses = array(
			'draft',
			'auto-draft',
			'pending',
			'future',
			'trash',
		);

		if ( in_array( $post->post_status, $illegal_post_statuses ) ) {
			return false;
		}

		// Don't load embed when comments are closed on a post.
		if ( 'open' != $post->comment_status ) {
			return false;
		}

		// Don't load embed if it's not a single post page.
		if ( ! is_singular() ) {
			return false;
		}

		return true;
	}

	/**
	 * Determines if Disqus is configured and can load on a given page.
	 *
	 * This function is taken from Disqus official plugin.
	 *
	 * @param string $script_name The name of the script Disqus intends to load.
	 *
	 * @since 3.0
	 * @access private
	 *
	 * @return boolean Whether Disqus is configured properly and can load on the current page.
	 */
	private function dcl_can_load( $script_name ) {

		// Don't load any Disqus scripts if there's no shortname.
		if ( ! $this->helper->short_name ) {
			return false;
		}

		// Don't load any Disqus scripts on feed pages.
		if ( is_feed() ) {
			return false;
		}

		$site_allows_load = apply_filters( 'dsq_can_load', $script_name );

		if ( is_bool( $site_allows_load ) ) {
			return $site_allows_load;
		}

		return true;
	}
}