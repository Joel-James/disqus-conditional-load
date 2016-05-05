<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die('Damn it.! Dude you are looking for what?');
}
/********************************************************************************************
* All codes here are taken from official Disqus plugin.										*
* Changes has been made to this file only.													*
* All other functions and files are property of Disqus.										*
* Code structure is also by Disqus.com.														*
* 																							*
* @link       http://disqus.com																*
* @since      1.0.0																			*
*																							*
* @package    DCL																			*
* @subpackage DCL/public																	*
* @author	  Disqus																		*
*********************************************************************************************/
defined('ABSPATH') or die("I am really helpless if you call me directly. Seriously dude !!");
	/*
	* Debug mode active
	*
	* If debug mode active shows current thread id using WordPress post id.
	* This works only with normal WordPress posts/pages
	* Woocommerce pages are exceptional for this condition
	*
	* @since	1.0.0
	*/
	if (DISQUS_DEBUG) {
		echo "<p><strong>Disqus Debug</strong> thread_id: ".get_post_meta($post->ID, 'dsq_thread_id', true)."</p>";
	}
	
	$dcl_gnrl_options = get_option('dcl_gnrl_options');
	$dcl_div_width_type	= ( !empty($dcl_gnrl_options['dcl_div_width_type']) && $dcl_gnrl_options['dcl_div_width_type'] == 'px' ) ? 'px' : '%';
	$dcl_div_style = '';
	
	global $post;
	global $comments;
	// Check if custom div width is enabled.
	if( $dcl_gnrl_options['dcl_div_width'] !=='') {
		$dcl_div_style = 'style="width: '.$dcl_gnrl_options["dcl_div_width"].$dcl_div_width_type.'; margin:0 auto;"';
	}
	
	/*
	* Output disqus_thread only to required pages - Not using currently
	*
	* Do not load everything simply on all pages. This checks if pages required
	* to add Disqus scripts
	*
	* @since	1.0.0
	*/
	//if ( !is_singular( array( 'post', 'page' ) ) ) {
		//return;
	//}
	?>
	
	<!-- Here we load disqus comments -->
	<div class="dcl-disqus-thread" id="comments" <?php echo $dcl_div_style; ?>>
	<div id="disqus_thread">
	<?php
	/*
	* If disqus loading is set to on click we need to add a button to the
	* disqus_thread. Here we output that button.
	* If not on-click then it will not add.
	*
	* @since	1.0.0
	*/
	if($dcl_gnrl_options['dcl_type'] == 'click' ){
		
		$dcl_final_btn_class = $dcl_gnrl_options['dcl_btn_class'];
	
	?>
		<div id='dcl-hidden-div' style='text-align: center;'>
		<button data-disqus-url="<?php echo the_permalink(); ?>" id='dcl_comment_btn' class="<?php echo $dcl_final_btn_class; ?>" style="margin-bottom:20px;margin-top:20px;"><?php echo $dcl_gnrl_options['dcl_btn_txt']; ?></button>
		</div>
		
	<?php } if (!get_option('disqus_disable_ssr') && have_comments()): ?>
			
	<?php if( $dcl_gnrl_options['dcl_type'] == 'normal' ) { ?>
			<!--  comments templete will be loaded here -->
			<div id="dsq-content">
			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')): // Are there comments to navigate through? ?>
            <div class="navigation">
                <div class="nav-previous">
                    <span class="meta-nav">&larr;</span>&nbsp;
                    <?php previous_comments_link( dsq_i('Older Comments')); ?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link(dsq_i('Newer Comments')); ?>
                    &nbsp;<span class="meta-nav">&rarr;</span>
                </div>
            </div> <!-- .navigation -->
			<?php endif; // check for comment navigation ?>

            <ul id="dsq-comments">
                <?php
                    /* Loop through and list the comments. Tell wp_list_comments()
                     * to use dsq_comment() to format the comments.
                     */
                    wp_list_comments(array('callback' => 'dsq_comment'));
                ?>
            </ul>

			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')): // Are there comments to navigate through? ?>
            <div class="navigation">
                <div class="nav-previous">
                    <span class="meta-nav">&larr;</span>
                    &nbsp;<?php previous_comments_link( dsq_i('Older Comments') ); ?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link( dsq_i('Newer Comments') ); ?>
                    &nbsp;<span class="meta-nav">&rarr;</span>
                </div>
            </div><!-- .navigation -->
			<?php endif; // check for comment navigation ?>
			
			</div>
			<?php } ?>

		<?php endif; ?>
	</div>
	</div>
	
	<?php
	
	global $wp_version;

	$embed_vars = array(
		'disqusConfig' => array(
			'platform' => 'wordpress@'.$wp_version,
			'language' => apply_filters( 'disqus_language_filter', '' ),
		),
		'disqusIdentifier' => dsq_identifier_for_post( $post ),
		'disqusShortname' => strtolower( get_option( 'disqus_forum_url' ) ),
		'disqusTitle' => dsq_title_for_post( $post ),
		'disqusUrl' => get_permalink(),
		'options' => array(
			'manualSync' => get_option('disqus_manual_sync'),
		),
		'postId' => $post->ID,
	);

	// Add SSO vars if enabled
	$sso = dsq_sso();
	if ($sso) {
		global $current_site;

		foreach ($sso as $k=>$v) {
			$embed_vars['disqusConfig'][$k] = $v;
		}

		$siteurl = site_url();
		$sitename = get_bloginfo('name');
		$embed_vars['disqusConfig']['sso'] = array(
			'name' => wp_specialchars_decode($sitename, ENT_QUOTES),
			'button' => get_option('disqus_sso_button'),
			'url' => $siteurl.'/wp-login.php',
			'logout' => $siteurl.'/wp-login.php?action=logout',
			'width' => '800',
			'height' => '700',
		);
	}
	
	if ( get_option('dsq_external_js') && $dcl_gnrl_options['dcl_type'] == 'normal' ) {
		wp_register_script( 'dsq_embed_script', plugin_dir_url( __FILE__ ). '../disqus-core/media/js/disqus.js');
		wp_localize_script( 'dsq_embed_script', 'embedVars', $embed_vars );
		wp_enqueue_script( 'dsq_embed_script', plugin_dir_url( __FILE__ ). '../disqus-core/media/js/disqus.js' );
	}
	else {
	?>	
	<?php
	/*
	* This section contains all scripts required for normal Disqus actions.
	* Entire script is developed by disqus.com team.
	* Performing all SSO related action also here.
	* Performing synchronisation
	*
	* @since	1.0.0
	*/
	?>
	<?php if ( is_singular( array('post','page') ) ) { ?>
	<script type="text/javascript">
	/* <![CDATA[ */
		var disqus_url = '<?php echo get_permalink(); ?>';
		var disqus_identifier = '<?php echo dsq_identifier_for_post($post); ?>';
		var disqus_container_id = 'disqus_thread';
		var disqus_domain = '<?php echo DISQUS_DOMAIN; ?>';
		var disqus_shortname = '<?php echo strtolower(get_option('disqus_forum_url')); ?>';
		var disqus_title = <?php echo cf_json_encode(dsq_title_for_post($post)); ?>;
		var disqus_config = function () {
			var config = this; // Access to the config object
			config.language = '<?php echo esc_js(apply_filters('disqus_language_filter', '')) ?>';

			/* Add the ability to add javascript callbacks */
			<?php do_action( 'disqus_config' ); ?>

			/*
			   All currently supported events:
				* preData — fires just before we request for initial data
				* preInit - fires after we get initial data but before we load any dependencies
				* onInit  - fires when all dependencies are resolved but before dtpl template is rendered
				* afterRender - fires when template is rendered but before we show it
				* onReady - everything is done
			 */

			config.callbacks.preData.push(function() {
				// clear out the container (its filled for SEO/legacy purposes)
				document.getElementById(disqus_container_id).innerHTML = '';
			});
			<?php if (!get_option('disqus_manual_sync')): ?>
			config.callbacks.onReady.push(function() {
				// sync comments in the background so we don't block the page
				var script = document.createElement('script');
				script.async = true;
				script.src = '?cf_action=sync_comments&post_id=<?php echo $post->ID; ?>';

				var firstScript = document.getElementsByTagName( "script" )[0];
				firstScript.parentNode.insertBefore(script, firstScript);
			});
			<?php endif; ?>
			<?php
			$sso = dsq_sso();
			if ($sso) {
				foreach ($sso as $k=>$v) {
					echo "this.page.{$k} = '{$v}';\n";
				}
				echo dsq_sso_login();
			}
			?>
		};
	/* ]]> */
	</script>
	
	<?php
	/*
	* This section contains all scripts required to manage trackbacks and pingbacks.
	* Entire script is developed by disqus.com team.
	*
	* @since	1.0.0
	*/
	?>
	
	<script type="text/javascript">
	/* <![CDATA[ */
		var DsqLocal = {
			'trackbacks': [
	<?php
		$count = 0;
		foreach ((array)$comments as $comment) {
			$comment_type = get_comment_type();
			if ( $comment_type != 'comment' ) {
				if( $count ) { echo ','; }
	?>
				{
					'author_name':    <?php echo cf_json_encode(get_comment_author()); ?>,
					'author_url':    <?php echo cf_json_encode(get_comment_author_url()); ?>,
					'date':            <?php echo cf_json_encode(get_comment_date('m/d/Y h:i A')); ?>,
					'excerpt':        <?php echo cf_json_encode(str_replace(array("\r\n", "\n", "\r"), '<br />', get_comment_excerpt())); ?>,
					'type':            <?php echo cf_json_encode($comment_type); ?>
				}
	<?php
				$count++;
			}
		}
	?>
			],
			'trackback_url': <?php echo cf_json_encode(get_trackback_url()); ?>
		};
	/* ]]> */
	</script>
	<?php } ?>
	<?php
	/*
	* This section contains all scripts required loading comments.
	* Entire script is developed by disqus.com team and modified by plugin author.
	* Loads disqus according to users choice
	* Conditional load/ normal load will be performed here
	*
	* @since	1.0.0
	* @author	Joel James
	*/
	?>
	<?php
	
		// Starts disqus conditional code
		dcl_desktop_code();
	}