=== Disqus Conditional Load ===
Contributors: joelcj91
Donate link: https://dclwp.com/
Tags: disqus, disqus conditional load, comment hide, hide disqus, disqus comments, disqus on click, disqus auto load, disqus, woocommerce comments, edd comments
Requires at least: 3.0
Tested up to: 4.3
Stable tag: 10.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use Disqus comments with advanced features like lazy load, shortcode, widgets etc. Don't let Disqus to slow your site down.

== Description ==

DCL is an advanced version of Disqus Commenting System, with which experience the boosted page loading speed difference. This free plugin adds advanced features like lazy loading and SHORTCODE, comment widgets, script disabling etc to your Disqus powered website.

**Disqus Conditional Load, popular features..**

- All the features from official Disqus plugin.
- Lazy load Disqus comments using - OnScroll,OnClick and Normal.
- SEO Friendly.
- Use **shortcode** to load comments anywhere.
- **Custom Post Types** support.
- Adjust Disqus container width
- Disable/Enable count scripts if not using.
- Developer friendly.
- Available [@GitHub](https://github.com/joel-james/disqus-conditional-load/).

[Installation](https://wordpress.org/plugins/disqus-conditional-load/installation/) | [Docs](https://dclwp.com/docs/) | [Screenshots](https://wordpress.org/plugins/disqus-conditional-load/screenshots/)

> #### Disqus Conditional Load Pro
> This plugin has a premium version with more cool advanced features like.<br />
>
> - **On Scroll Start** lazy loading - MOST WANTED!<br />
> - Seperate options for mobile and desktop.<br />
> - Woocommerce support without breaking review tab.<br />
> - Easy Digital Downloads support.<br />
> - Comment Count on Button.<br />
> - Disqus Comments as Widget.<br />
> - Disqus **Popular Comments Widget**<br />
> - Beautiful inbuilt button styles.<br />
> - Priority support over email.<br />
>
> [Upgrade to DCL Pro](https://dclwp.com/)


= Other Features by Disqus =

* Support for importing existing comments.
* Adjust the Disqus comments width.
* You can use SHORTCODE to load disqus where ever on the page.
* Prevent auto load of Disqus Comments.
* Choose how to load Disqus comments ( On, scroll down, scroll start or click ).
* Custom comment button class
* Ability to disable even count.js script.
* Auto-sync (backup) of comments with Disqus and WordPress database
* Threaded comments and replies
* Notifications and reply by email
* Subscribe and RSS options
* Aggregated comments and social mentions
* Powerful moderation and admin tools
* Full spam filtering, blacklists and whitelists
* Support for Disqus community widgets
* Connected with a large discussion community
* Increased exposure and readership

**Bug Reports**

Bug reports for DCL are always welcome. [Report here](https://dclwp.com/bugs/). Please _do not_ send support requests here.

**More information**

- [Disqus Conditional Load Pro](https://dclwp.com/), containing more [advanced features](https://dclwp.com/features/).
- Follow the developer [@Twitter](https://twitter.com/Joel_James)
- Other [WordPress plugins](https://profiles.wordpress.org/joelcj91/#content-plugins) by [Joel James](https://www.joelsays.com)

**Disqus Comments - Overview**

Disqus, pronounced "discuss", is a service and tool for web comments and discussions. Disqus makes commenting easier and more interactive, while connecting websites and commenters across a thriving discussion community.

If you do not yet have a Disqus account, [registering for Disqus is free and only takes you about 30 seconds](https://disqus.com/profile/signup/). Optionally you can do this after installing the plugin.

== Installation ==

**Please make sure that you have deactivated Disqus official plugin first**,
because this plugin is a stand alone plugin. You don't have to use Disqus plugin if you use this one. If you try to activate this along with Disqus, it will throw a `Fatal Error` for sure. All Disqus features are available too.!

= Installing the plugin =
1. In your WordPress admin panel, go to *Plugins > New Plugin*, search for **Disqus Conditional Load** and click "*Install now*"
2. Alternatively, download the plugin and upload the contents of `disqus-conditional-load.zip` to your plugins directory, which usually is `/wp-content/plugins/`.
3. Activate the plugin
4. Log into your Disqus account from *Comments->Disqus*, then choose the forum shortname you would like to install.

= Setup Disqus for your website =
1. Go to Disqus and [register](https://disqus.com/profile/signup/) or [login](https://disqus.com/profile/login/).
2. Add your website details and register.
3. Once you finish this, you can follow above step to istall the plugin.

= Configuring Advanced Features =
1. Go to *DCL Settings*
2. There you can configure Disqus with advanced features.



= Need more help? =
Please take a look at the [DCL documentation](https://dclwp.com/docs) or [open a support request](http://wordpress.org/support/plugin/disqus-conditional-load/).

= Upgrade to DCL Pro =
If you like this plugin, consider [upgrading to the Pro version of Disqus Conditional Load](https://dclwp.com/) for an even better plugin!

== Frequently Asked Questions ==

= Which is the best lazy load option? =
Both scroll and click are awesome. Use according to your preference.

= How can I register with Disqus? =
Go to Disqus and [register](https://disqus.com/profile/signup/)

= How to use shortcode? =
Use the following shortcode in your post/page where you want to show comments.

`
[js-disqus]
`

= What are the main differences between DCL Pro and Free? =
Please have a look at the [DCL Pro vs Free comparision](https://dclwp.com/features) page on official website.

= More documentation =
More detailed documentation can be found on the [DCL documentation](https://dclwp.com/docs/) section.

== Other Notes ==

= Bug Reports =

Bug reports for DCL are always welcome. [Report here](https://dclwp.com/bugs/). Please _do not_ send support requests here.


== Screenshots ==

1. Comments Moderation Dashboard
2. Disqus Comments UI
3. General Settings ( Some options are Pro only ).
4. Sample Buton when On Click lazy load enabled.
5. **Pro only:** Integration Settings.
6. **Pro only:** Widget Settings.


== Changelog ==

= 10.1.1 =

**Improvements**

- [Big SEO improvement](https://dclwp.com/big-seo-improvement-disqus-seo/) - Showing synced WordPress comments to Search engine bots even if lazy load.
- Tested with WordPress 4.3

= 10.1.0 =

**Bug Fixes**
- Fixed wrong output error in dcl-functions.php - Thanks to [Syed Irfaq R](https://github.com/irazasyed)
- Tested with WordPress 4.2.4.

= 10.0.7 =

**Bug Fixes**
- Fixed issues with custom post type support
- Removed activation set up redirect since it is causing issues on few servers ( Nginx )
- Added warning message if Disqus is not configured properly.
- Removed DCL settings sub menu links since it is causing redirect error.

= 10.0.5 =

**Bug Fixes**
- Fixed issue with count.js

= 10.0.3 =

**Bug Fixes**
- Fixed not loading when 'Render Javascript in external files' unchecked.
- Fixed Activator class error.
- Fixed undefined variable from Disqus.

= 10.0.2 =

**Improvements**
- Fixed old options not being transferred when updating.

= 10.0.1 =

**New Feature**

- Now you can adjust Disqus comments section width.

**Improvements**

- Big improvements in coding standard.
- Changed to OOPS structure. Thanks to - [Tom McFarlin](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate),
- Released new dedicated website for the plugin.
- Included latest version of Disqus Commenting System.

= 9.0.9 =
* Fixed issues with Woocommerce review

= 9.0.8 =
* Moved jQuery code to footer for performance

= 9.0.7 =
* A small bug fix

= 9.0.6 =
* Fixed a bug ( Not going directly to a particular comments if link contains #comments )

= 9.0.5 =
* Fixed issue with custom posts

= 9.0.4 =
* Fixed issue with woocommerce review tab

= 9.0.3 =
* Fixed ssl issue
* Fixed comments not loading on urls having #comments

= 9.0.2 =
* Added new feature - Disabling count.js.
* Releases [Pro Version](http://store.joelsays.com/).
* Improved admin page

= 9.0.1 =
* Fixed few bugs.
* Added ability to disable lazy load (But shortcode can be used)
* Removed old version jQuery

= 9.0.0 =
* Fixed one serious issue regarding count notification.

= 8.0.9 =
* Small bug fix on default values.
* Performance improved.

= 8.0.8 =
* Added normal Disqus load when access comment id via url.
* Modified admin tab.
* Suggested by - [Ian](http://iag.me/).
* Fixed alignment issue.

= 8.0.7 =
* Added easy-to-use tabbed admin page.
* Ability to show normal Disqus comments in SHORTCODE is not found.
* Custom loading message to show before loading Disqus comments.
* Improved performance.

= 8.0.6 =
* Fixed one jQuery bug.
* Removed unwanted jQuery codes.

= 8.0.5 =
* Fixed conflict issue with some plugins.
* Improved performance.

= 8.0.4 =
* Fixed jquery conflict issue.
* Reported by - Raman, Rick
* Fixed one bug.
* Improved performance.

= 8.0.3 =
* Fixed alignment issues on admin page.
* Hidden unwanted things from comments template.
* Improved performance.

= 8.0.2 =
* Bug fix.
* Removed some unwanted scripts that caused javascript errors.
* Reported by - [Josef](http://www.blog-it-solutions.de/)
* Hidden default WordPress comments (it was showing without style before Disqus loads)

= 8.0.1 =
* Support forum added

= 8.0 =
* Integrated with official Disqus plugin.
* Added all official plugin features.
* Custom class usage on button.
* Moved menu to comments menu
* Bug fixes.

= 7.5 =
* Bug fix.

= 7.4 =
* Bug fix.

= 7.2 =
* Added more advanced features.
* Withdrawn PRO version. All features are free!!

= 6.2 =
* Subversion update with structure fix.

= 6.0 =
* option to disable comments on home page/front page.

= 5.0 =
* Improved admin menu

= 4.0 =
* Fixed issues on scroll option.
* Improved codes.
* Works without Disqus Installed.

= 3.5 =
* If username not given it will not load
* Redirect to admin page after activation

= 2.0 =
* Added admin menu
* Added two methods (onclick and onscroll)
* User can change settings from admin page.

= 1.0 =
* Added first version without admin menu

== Upgrade Notice ==

= 10.1.1 =
- Big SEO improvement - Showing synced WordPress comments to Search engine bots even if lazy load.