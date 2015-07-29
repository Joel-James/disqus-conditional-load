<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die('Damn it.! Dude you are looking for what?');
}

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and enqueue the 
 * dashboard-specific stylesheet and JavaScript.
 *
 * @link       http://dclwp.com
 * @since      10.0.0
 * @package    DCL
 * @subpackage DCL/admin
 * @author     Joel James <me@joelsays.com>
 */
class DCL_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    10.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    10.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    10.0.0
	 * @var      string    $plugin_name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    10.0.0
	 */
	public function enqueue_styles() {

		global $pagenow;
		
		if (( $pagenow == 'admin.php' ) && ( $_GET['page'] == 'dcl-settings')) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/min/admin.css', array(), $this->version, 'all' );
		}
		if ( is_rtl() ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/min/admin-rtl.css', array(), $this->version, 'all' );
		}

	}
	
	
	/**
	 * Redirect to installation page
	 *
	 * If Disqus is not setup, let us redirect them to setup.
	 * @since	10.0.0
	 * @uses	get_option()	To get the activation redirect option from db.
	 * @return	void.
	 */
	public function dcl_setup_redirect() {  
		
		if ( get_option('dcl_do_activation_redirect') ) {
			delete_option('dcl_do_activation_redirect');
			if( !dsq_is_installed() ) {
				exit(wp_redirect( DCL_DISQUS_PAGE ));
			}
		}
	}
	
	/**
	 * Run upgrade functions
	 *
	 * If DCL is upgraded, we may need to perform few updations in db
	 * This function is used for that.
	 * @since	10.0.2
	 * @uses	get_option()	To get the activation redirect option from db.
	 * @return	void.
	 */
	public function dcl_upgrade_if_new() {
	
		if ( !get_option('dcl_version_no') || ( get_option('dcl_version_no') <= DCL_VERSION  ) ) {
			
			if( !class_exists( 'DCL_Activator' ) ) {
				include_once( plugin_dir_path( __FILE__ ) . '../includes/class-dcl-activator.php' );
			}
			DCL_Activator::activate();
			update_option('dcl_version_no', DCL_VERSION );
		}
	}

	/**
	* Creating admin page for DCL.
	*
	* @since	1.0.0
	* @author	Joel James
	* @action	hook	add_menu_page	  Action hook to add new admin menu.
	* @action	hook	add_submenu_page	Action hook to add new submenu menu.
	*/
	public function dcl_create_menu() {
	
		add_menu_page(
			'DCL Settings',
			'DCL Settings', 
			DCL_ADMIN_PERMISSION, 
			'dcl-settings', 
			array( $this, 'dcl_admin_page' ),
			plugin_dir_url( __FILE__ ) . 'images/js-icon.png'
		);
		
		add_submenu_page( 
			'dcl-settings', 
			'Disqus Settings', 
			'Disqus Settings', 
			DCL_ADMIN_PERMISSION, 
			'dcl-disqus-redirect', 
			array( $this, 'dcl_disqus_page' ) 
		);
		
		add_submenu_page( 
			'dcl-settings', 
			'DCL Pro', 
			'Pro Features', 
			DCL_ADMIN_PERMISSION, 
			'dcl-settings&tab=pro', 
			array( $this, 'dcl_admin_page' ) 
		);
		
	}

	/**
	* Admin options page display.
	*
	* Includes admin page contents to manage options.
	* Including an Html content page.
	*
	* @since    1.0.0
	* @author	Joel James
	*/
	public function dcl_admin_page() {
		require plugin_dir_path( __FILE__ ) . 'partials/dcl-admin-display.php';
	}
	
	/**
	* Redirect to Disqus page.
	*
	* Function to make a redirect to Dsqus settings page.
	* This is used to add a new nav for user friendly.
	* @since    1.0.0
	* @uses		wp_redirect()	WordPress redirection hook.
	* @author	Joel James
	*/
	public function dcl_disqus_page() {
		exit(wp_redirect( DCL_DISQUS_PAGE ));
	}
	
	/**
	* Registering DCL options.
	*
	* @since	1.0.0
	* @author	Joel James
	* @action	hooks 		register_setting       Hook to register options in db.
	*/
	public function dcl_options_register(){
		register_setting( 
			'dcl_gnrl_options', 
			'dcl_gnrl_options' 
		);
	}
	


	/**
	* Custom footer text.
	*
	* Function to alter the default footer text and add DCL
	* custom texts and links.
	* This will be applied only to DCL admin pages.
	*
	* @var	string	$pagenow 	Global variable which gives current page details.
	* @since    1.0.0
	* @return	$string		HTML content for footer or nothing.
	* @author	Joel James
	*/
	public function dcl_dashboard_footer () {
		global $pagenow;
		if (( $pagenow == 'admin.php' ) && ( in_array ( $_GET['page'], array('dcl-settings')))) {
			echo 'Thank you for choosing this plugin | <a href="http://dclwp.com">Upgrade to DCL Pro</a> | <a href="https://wordpress.org/support/view/plugin-reviews/disqus-conditional-load?filter=5#postform">Rate it &#9733; &#9733;</a>';
		} else {
			return;
		}
	}

	/**
	* Custom Plugin Action Link.
	*
	* Function to add a quick link to DCL, when being listed on your
	* plugins list view.
	*
	* @since    1.0.0
	* @return	$links		Links to display.
	* @author	Joel James
	*/
	public function dcl_plugin_action_links( $links, $file ) {
		$plugin_file = basename('disqus-conditional-load.php');
		if (basename($file) == $plugin_file) {
			if (!dsq_is_installed()) {
				$settings_link = '<a href="edit-comments.php?page=disqus">'.dsq_i('Configure').'</a>';
			} else {
				$settings_link = '<a href="admin.php?page=dcl-settings">'.dsq_i('Settings').'</a>';    
			}
			array_unshift($links, $settings_link);
		}
		return $links;
	}


	/**
	 * Plugin row meta links
	 *
	 * @author Michael Cannon <mc@aihr.us>
	 * @since 10.0.0
	 * @param array $input already defined meta links
	 * @param string $file plugin file path and name being processed
	 * @return array $input
	 */
	function dcl_plugin_row_meta( $input, $file ) {
		
		if ( $file != 'disqus-conditional-load/disqus-conditional-load.php' )
			return $input;

		$dcl_link = array(
			'<a href="http://dclwp.com/" target="_blank">Upgrade to Pro</a>'
		);

		$input = array_merge( $input, $dcl_link );

		return $input;
	}
	
}