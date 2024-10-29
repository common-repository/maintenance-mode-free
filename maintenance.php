<?php
/*
Plugin Name: Maintenance Mode Free
Plugin URI: http://shapedplugin.com/plugin/maintenance-mode-pro
Description: This plugin enables maintenance mode.
Author: ShapedPlugin
Author URI: http://shapedplugin.com
Version: 1.2
*/

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.


$maintenance_version = '1.2';

define( 'MAINTENANCE_PATH', plugin_dir_path( __FILE__ ) );
define( 'MAINTENANCE_URL', plugin_dir_url( __FILE__ ) );


// active modules
defined( 'CS_ACTIVE_FRAMEWORK' ) or define( 'CS_ACTIVE_FRAMEWORK', true );
defined( 'CS_ACTIVE_METABOX' ) or define( 'CS_ACTIVE_METABOX', false );
defined( 'CS_ACTIVE_SHORTCODE' ) or define( 'CS_ACTIVE_SHORTCODE', false );
defined( 'CS_ACTIVE_CUSTOMIZE' ) or define( 'CS_ACTIVE_CUSTOMIZE', false );

/*--------------------------------------------------------------
##  Inclusion inline Scripts and Styles
--------------------------------------------------------------*/
if ( file_exists( MAINTENANCE_PATH . '/templates/inc/styles.php' ) ) {
	require_once( MAINTENANCE_PATH . '/templates/inc/styles.php' );
}

/*--------------------------------------------------------------
## Inclusion CodeStar Framework
--------------------------------------------------------------*/

if ( file_exists( MAINTENANCE_PATH . '/admin/codestar-framework/cs-framework.php' ) ) {
	require_once( MAINTENANCE_PATH . '/admin/codestar-framework/cs-framework.php' );
}

if ( file_exists( MAINTENANCE_PATH . '/admin/inc/config-star.php' ) ) {
	require_once( MAINTENANCE_PATH . '/admin/inc/config-star.php' );
}

/*--------------------------------------------------------------
##  Load Text Domain
##  @since 1.2
--------------------------------------------------------------*/
add_action( 'plugins_loaded', 'maintenance_load_textdomain' );

function maintenance_load_textdomain() {
	load_plugin_textdomain( 'maintenance-mode-free', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

/*--------------------------------------------------------------
## Load Styles and Scripts
--------------------------------------------------------------*/

if ( ! function_exists( 'maintenance_style_script_load' ) ) {
	function maintenance_style_script_load() {

		if ( cs_get_option( 'maintenance_main_setting' ) == 'enabled' && ! is_user_logged_in() ) {
			/* Styles */
			wp_enqueue_style( 'bootstrap', MAINTENANCE_URL . 'templates/assets/css/bootstrap.min.css', array(), '20160519', 'all' );
			wp_enqueue_style( 'maintenance-style', MAINTENANCE_URL . 'templates/assets/css/style.css', array(), '20160519', 'all' );
			wp_enqueue_style( 'maintenance-responsive', MAINTENANCE_URL . 'templates/assets/css/responsive.css', array(), '20160519', 'all' );

			/* Scripts */
			wp_enqueue_script( 'pulgins-js', MAINTENANCE_URL . 'templates/assets/js/pulgins.js', array( 'jquery' ), 20160519, true );
			wp_enqueue_script( 'respond-js', MAINTENANCE_URL . 'templates/assets/js/respond.js', array( 'jquery' ), 20160519, true );
			wp_enqueue_script( 'scripts-js', MAINTENANCE_URL . 'templates/assets/js/scripts.js', array( 'jquery' ), 20160519, true );
		}
	}
	add_action( 'wp_enqueue_scripts', 'maintenance_style_script_load' );
}


/*--------------------------------------------------------------
## Load Admin Script and Styles
--------------------------------------------------------------*/
add_action( 'admin_enqueue_scripts', 'maintenance_script_load' );
if ( ! function_exists( 'maintenance_script_load' ) ) {
	function maintenance_script_load() {
		wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );
		wp_enqueue_script( 'admin-scripts', MAINTENANCE_URL . 'admin/inc/admin-script.js', array( 'jquery' ), null, true );

		wp_enqueue_style( 'jquery-style', MAINTENANCE_URL . 'admin/inc/jquery-ui.css' );

	}
}


/**
 * Config
 */
if ( cs_get_option( 'maintenance_main_setting' ) == 'enabled' ) {
	if ( ! class_exists( 'MAINTENANCE_COMING_SOON' ) ) {
		class MAINTENANCE_COMING_SOON {
			function __construct() {
				$this->plugin_includes();
			}

			function plugin_includes() {
				add_action( 'template_redirect', array( &$this, 'maintenance_redirect_mm' ) );
			}

			function is_valid_page() {
				return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
			}

			function maintenance_redirect_mm() {
				if ( is_user_logged_in() ) {
					//do not display maintenance page
				} else {
					if ( ! is_admin() && ! $this->is_valid_page() ) {  //show maintenance page
						$this->load_sm_page();
					}
				}
			}

			function load_sm_page() {
				header( 'HTTP/1.0 503 Service Unavailable' );
				include_once( "templates/template.php" );
				exit();
			}
		}


		$GLOBALS['maintenance_coming_soon'] = new MAINTENANCE_COMING_SOON();
	}

}

/* Plugin Action Links */
function maintenance_mode_free_action_links( $links ) {
	$links[] = '<a href="http://shapedplugin.com/plugin/maintenance-mode-pro/" style="color: red; font-weight: bold;" target="_blank">Go Pro!</a>';
	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'maintenance_mode_free_action_links' );


/* Plugin Action Banner Links */
add_action('toplevel_page_maintenance-options', 'maintenance_mode_free_action_banner_links');
function maintenance_mode_free_action_banner_links(){
	echo '<div class="pro-plugin-box">
	<h2 class="title"><div class="dashicons dashicons-update"></div> Pro Version</h2>
	<p>Upgrade to <a href="http://shapedplugin.com/plugin/maintenance-mode-pro/">Pro</a> to  get 10+ background and huge custom options with Social Links and Subscriptions Option</p>
	<a class="button button-primary" title="Pro Version" href="http://shapedplugin.com/plugin/maintenance-mode-pro/" target="_blank">Buy Pro Version Now</a>
	<a class="button" title="Pro Version Demo" href="http://shapedplugin.com/demo/maintenance-mode-pro/" target="_blank">Live Demo</a>

</div>

<div class="pro-plugin-box">
	<h2 class="title"><div class="dashicons dashicons-welcome-widgets-menus"></div> Our Stunning Themes</h2>
	<p>Need a fresh look of your website? Take a visit to our stunning themes, they may give your site a better look</p>
	<a class="button" title="WordPress Theme" href="http://shapedtheme.com/"
	target="_blank">WordPress Theme</a>
</div>

<div class="pro-plugin-box">
	<h2 class="title"><div class="dashicons dashicons-editor-help"></div> Support</h2>
	<p>Our active support team is ready to help. Don\'t hesitate to ask for help on our support forum</p>
	<a class="button" title="Support Forum" href="http://shapedplugin.com/support/"
	target="_blank">Support Forum</a>
</div>';


}

