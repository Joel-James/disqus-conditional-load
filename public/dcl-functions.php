<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die('Damn it.! Dude you are looking for what?');
}
/**
 * Public functions of DCL.
 *
 * All custom function related to DCL should be writter here.
 *
 * @link       http://dclwp.com
 * @since      10.0.0
 *
 * @package		DCL
 * @subpackage	DCL/public
 * @author		Joel James
 */	
	
	/**
	 * The options data of this plugin.
	 *
	 * @since    10.0.0
	 * @var      string    $dcl_gnrl_options    Options values from database.
	 */
	$dcl_gnrl_options = get_option('dcl_gnrl_options');
		
	/**
	* Get Disqus Conditional Code.
	*
	* This function is used to get the conditional load script
	* to output to the page/post
	*
	* @since    10.0.0
	* @author	Joel James
	* @echo		$script		Disqus comments script.
	*/
	function dcl_conditional_code() {
		
		global $dcl_gnrl_options;
		
		$base = is_ssl() ? 'https://' : 'http://';

		$script = '<script type="text/javascript">
					var disqus_shortname = "'.strtolower(get_option("disqus_forum_url")).'";
					if (typeof ds_loaded == "undefined") {
						var ds_loaded = false; //To track loading only once on a page.
					}
					function loadDisqus()
					{
						var disqus_div = jQuery("#disqus_thread"); //The ID of the Disqus DIV tag
						var top = disqus_div.offset().top;
						var disqus_data = disqus_div.data();
						if ( !ds_loaded && jQuery(window).scrollTop() + jQuery(window).height() > top ) 
						{
							ds_loaded = true;
							for (var key in disqus_data) 
							{
								if (key.substr(0,6) == "disqus") 
								{
									window["disqus_" + key.replace("disqus","").toLowerCase()] = disqus_data[key];
								}
							}
							var dsq = document.createElement("script");
							dsq.type = "text/javascript";
							dsq.async = true;
							dsq.src = "'.$base.'" + window.disqus_shortname + ".disqus.com/embed.js";
							jQuery("#dcl-hidden-div").html("'.$dcl_gnrl_options["dcl_message"].'");
							(document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0]).appendChild(dsq);
						}    
					}
					';
		
		echo $script;
	}

	/**
	* Get Scroll - Conditional Code.
	*
	* This function is used to get the conditional load script
	* to output disqus comments 'On Scroll'
	*
	* @since    10.0.0
	* @author	Joel James
	* @echo		$scroll		Conditional load script.
	*/
	function dcl_scroll_code(){

		$scroll = dcl_conditional_code();
		$scroll .= 'jQuery(function () 
					{
						var disqus_div = jQuery("#disqus_thread");
						if(document.body.scrollHeight < window.innerHeight){
							loadDisqus();
						}
						else if (disqus_div.size() > 0) 
						{
							jQuery(window).scroll(loadDisqus);      
						} 
					}
					);
					</script>';
		
		echo $scroll;
	}


	/**
	* Get On Click - Conditional Code.
	*
	* This function is used to get the conditional load script
	* to output disqus comments 'On Click'
	*
	* @since    10.0.0
	* @author	Joel James
	* @echo		$click		Conditional load script.
	*/
	function dcl_click_code(){

		$click = dcl_conditional_code();
		$click = 'jQuery(function () {
					jQuery("#dcl_comment_btn").click(loadDisqus);
					});
				</script>';
		
		echo $click;
	}


	
	/**
	* Get Normal Disqus Code.
	*
	* This function is used to get the disqus script
	* normally, without lazy load.
	*
	* @since    10.0.0
	* @modified 14/8/2015
	* @author	Joel James
	* @echo		$normal		Disqus comments script call.
	*/
	function dcl_disqus_normal_code() {
		
		$normal = "";
		$normal = "<script type='text/javascript'>
					/* <![CDATA[ */
					var ds_loaded = true;
					var dcl_loaded = 1;
					(function() {
						var dsq = document.createElement('script'); dsq.type = 'text/javascript';
						dsq.async = true;
						dsq.src = '//' + disqus_shortname + '.' + '".DISQUS_DOMAIN."' + '/' + 'embed' + '.js' + '?pname=wordpress&pver=".DISQUS_VERSION."';
						(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
					})();
					/* ]]> */
					</script>";
		echo $normal;
	}
	
	
	/**
	* Load comments normally to jump to a comments.
	*
	* This function is used to load comments normally if the
	* url contains #comments. It will take the users directly to
	* a particular comment.
	*
	* @since    10.0.0
	* @modified 14/8/2015
	* @author	Joel James
	* @echo		$script		Normal disqus code with hash checking.
	*/
	function dcl_disqus_hash_load() {
		$script = "";
		$script = "<script type='text/javascript'>
					/* <![CDATA[ */
					var hash = window.location.hash;
					if(hash!==''){
					var ds_loaded = true;
					var dcl_loaded = 1;
					(function() {
						var dsq = document.createElement('script'); dsq.type = 'text/javascript';
						dsq.async = true;
						dsq.src = '//' + disqus_shortname + '.' + '".DISQUS_DOMAIN."' + '/' + 'embed' + '.js' + '?pname=wordpress&pver=".DISQUS_VERSION."';
						(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
					})();}
					/* ]]> */
					</script>";
		echo $script;
	}

	
	/**
	* Add Disqus comments script to the page.
	*
	* This function is used to add the comment script that we prepared
	* above to a page where it is required.
	*
	* @since    10.0.0
	* @author	Joel James
	*/
	function dcl_desktop_code() {
			
		global $dcl_gnrl_options;

		if($dcl_gnrl_options['dcl_type'] !== 'normal'){
			add_action('wp_footer', 'dcl_'.$dcl_gnrl_options["dcl_type"].'_code', 100);
			add_action('wp_footer', 'dcl_disqus_hash_load', 100);
		} else {
			// Output disqus normal load script
			add_action('wp_footer', 'dcl_disqus_normal_code', 100);
		}
	}
	
	
	/**
	* Check if Bot is visiting.
	*
	* This function is used to check if a bot is being viewed our site content.
	* If bot, we don't have to load everything.
	*
	* @reference http://stackoverflow.com/questions/677419/how-to-detect-search-engine-bots-with-php
	* @since    10.1.1
	* @author	Joel James
	*/
	function dcl_is_bot() {
	
		$botlist = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
		"looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
		"Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
		"crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
		"msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
		"Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
		"Mediapartners-Google", "Sogou web spider", "WebAlta Crawler","TweetmemeBot",
		"Butterfly","Twitturls","Me.dium","Twiceler");
	 
		foreach($botlist as $bot){
			if(strpos($_SERVER['HTTP_USER_AGENT'],$bot)!==false)
			return true;	// Is a bot
		}
	 
		return false;	// Not a bot
	}

	
	/**
	* Check if [js-disqus] shortcode is active.
	*
	* This function is used to check if a shortcode is found on the page.
	* This can be used to check any shortcode.
	*
	* @since    10.0.0
	* @author	Joel James
	* @return	$found		True if shortcode found, else false
	*/
	function dcl_check_shortcode( $dcl_shortcode = false ) {

		global $post;
		
		$post_obj = get_post( $post->ID );
		
		$found = false;

		if ( !$dcl_shortcode ) {
			return $found;
		}
		else if ( stripos( $post_obj->post_content, '[' . $dcl_shortcode . ']' ) !== false ) {
			$found = true;
		}
		
		return $found;
	}


	/**
	* Creating comments output.
	*
	* include the disqus comments file to show comments
	* if the shortocde is used some where.
	* You can use dcl_comments_output() to show comments
	* anywhere in the site when DCL is active.
	*
	* @since    10.0.0
	* @author	Joel James
	* @return	$output		Comments file content.
	*/
	function dcl_comments_output() {

		ob_start();
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/dcl-comments.php';
		
		$output = ob_get_contents();;
		
		ob_end_clean();

		return $output;
	}