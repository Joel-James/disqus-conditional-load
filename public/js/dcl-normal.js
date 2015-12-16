(function($) {
    'use strict';

	/**
	 * Normal Disqus comments script.
	 * This script will load Disqus comments along with your page load.
	 * This is not a lazy load script
     */
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

})(jQuery);