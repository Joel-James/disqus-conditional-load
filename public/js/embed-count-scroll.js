/**
 * Disqus variables.
 */
var disqus_url = embedVars.disqusUrl;
var disqus_identifier = embedVars.disqusIdentifier;
var disqus_container_id = 'disqus_thread';
var disqus_shortname = embedVars.disqusShortname;
var disqus_title = embedVars.disqusTitle;
var disqus_config_custom = window.disqus_config;
var disqus_loaded = false;
var disqus_config = function () {
    /**
     * All currently supported events:
     * onReady: fires when everything is ready,
     * onNewComment: fires when a new comment is posted,
     * onIdentify: fires when user is authenticated
     */
    var dsqConfig = embedVars.disqusConfig;
    this.page.integration = dsqConfig.integration;
    this.page.remote_auth_s3 = dsqConfig.remote_auth_s3;
    this.page.api_key = dsqConfig.api_key;
    this.sso = dsqConfig.sso;
    this.language = dsqConfig.language;

    if (disqus_config_custom)
        disqus_config_custom.call(this);
};

/**
 * Get and set the Disqus comments embed.
 *
 * Get the Disqus comments iframe through ajax
 * and append it to the comments section.
 *
 * @since 11.0.0
 */
var disqus_comments = function() {

    if ( ! disqus_loaded ) {
        disqus_loaded = true;
        var dsq = document.createElement( 'script' );
        dsq.type = 'text/javascript';
        dsq.async = true;
        dsq.src = 'https://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName( 'head' )[0] || document.getElementsByTagName( 'body' )[0]).appendChild( dsq );
    }
};

/**
 * Load Disqus comments on page scroll.
 *
 * Load Disqus comments when visitor scrolls down to the comments
 * area of the page/post.
 *
 * @since 11.0.0
 */
if(document.body.scrollHeight < window.innerHeight) {
    // If no scroll bar found, load comments.
    disqus_comments();
} else if (document.getElementById('disqus_thread') !== null) {
    // Start loading the comments when user scroll down.
    window.onscroll = function() {
        // Remove button.
        disqus_comments();
    }
}

/**
 * Comments count script to show count.
 *
 * Get the total number of comments for the current page
 * from Disqus.com. We need to make an ajax request for this.
 *
 * @since 11.0.0
 */
(function () {
    var nodes = document.getElementsByTagName('span');
    for (var i = 0, url; i < nodes.length; i++) {
        if (nodes[i].className.indexOf('dsq-postid') != -1 && nodes[i].parentNode.tagName == 'A') {
            nodes[i].parentNode.setAttribute('data-disqus-identifier', nodes[i].getAttribute('data-dsqidentifier'));
            url = nodes[i].parentNode.href.split('#', 1);
            if (url.length == 1) { url = url[0]; }
            else { url = url[1]; }
            nodes[i].parentNode.href = url + '#disqus_thread';
        }
    }
    var s = document.createElement('script');
    s.async = true;
    s.type = 'text/javascript';
    s.src = 'https://' + disqus_shortname + '.disqus.com/count.js';
    (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
}());