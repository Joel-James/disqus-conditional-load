(function($) {
    'use strict';

    /**
     * All of the code for our admin-specific JavaScript source
     * should reside in this file.
     *
     * Note that this assume you're going to use jQuery, so it prepares
     * the $ function reference to be used within the scope of this
     * function.
     *
     * From here, we are able to define handlers for when the DOM is
     * ready:
     *
     * $(function() {
     *
     * });
     *
     * Or when the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and so on.
     */
    var disqus_shortname = jQuery("#disqus_forum_url").val();
	if (typeof ds_loaded == "undefined") {
		var ds_loaded = false; //To track loading only once on a page.
	}
	
	/**
	 * Disqus comments 
	 *
	 */
	function loadDisqus() {
		var disqus_div = jQuery("#disqus_thread"); //The ID of the Disqus DIV tag
		var top = disqus_div.offset().top;
		var disqus_data = disqus_div.data();
		if ( !ds_loaded && jQuery(window).scrollTop() + jQuery(window).height() > top ) {
			ds_loaded = true;
			for (var key in disqus_data) {
				if (key.substr(0,6) == "disqus") {
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

	jQuery(function () {
		var disqus_div = jQuery("#disqus_thread");
		if(document.body.scrollHeight < window.innerHeight){
			loadDisqus();
		} else if (disqus_div.size() > 0) {
			jQuery(window).scroll(loadDisqus);      
		} 
	});
})(jQuery);