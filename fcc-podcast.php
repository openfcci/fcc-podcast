<?php
/**
 * Plugin Name: FCC Podcasts
 * Description: General use podcasts plugin for FCC employees with JW player content. Use the AreaVoices Contributor Theme to take full advantage of the podcast-to-blog-post functionality, however the podcast channel functional is theme-agnostic.
 * Plugin URI:  https://github.com/openfcci/fcc-podcast/
 * Author:      Forum Communications Company
 * Author URI:  http://www.forumcomm.com/
 * License:     GPL v2 or later
 * Text Domain: fccpod
 * Version:			1.17.02.06
 */

# Exit if accessed directly
defined( 'ABSPATH' ) || exit;

# Declare Constants
define( 'FCCPOD__PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'FCCPOD__PLUGIN_DIR',  plugin_dir_url( __FILE__ ) );

/*--------------------------------------------------------------
# PLUGIN ACTIVATION/DEACTIVATION HOOKS
--------------------------------------------------------------*/

/**
 * Plugin Activation Hook
 */
function fccpod_plugin_activation() {
	# Flush our rewrite rules on activation.
	flush_rewrite_rules();
	# Update Jetpack Social Sharing Options
	fccpod_update_jetpack_sharing_options();
}
register_activation_hook( __FILE__, 'fccpod_plugin_activation' );

/**
 * Add 'postcasts' to Jetpack Social Sharing options
 */
function fccpod_update_jetpack_sharing_options() {
	if ( $sharing_options = get_option( 'sharing-options' ) ) {
		$sharing_options['global']['show'][] = 'podcasts';
		update_option( 'sharing-options', $sharing_options );
	}
}

/**
 * Plugin Deactivation Hook
 */
function fccpod_plugin_deactivation() {
	# Flush our rewrite rules on deactivation.
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'fccpod_plugin_deactivation' );


/*--------------------------------------------------------------
 # LOAD INCLUDES FILES Pt. 1
 --------------------------------------------------------------*/

# Register the Custom Post Types: 'podcasts' & 'stations'
require_once( plugin_dir_path( __FILE__ ) . '/includes/register-custom-post-types.php' );

# Insert Custom Terms
if ( ! get_option( 'fccpod_podcast_terms' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . '/includes/insert-custom-terms.php' );
}

# JW Platform/BOTR API
if ( ! class_exists( 'BotrAPI' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/botr/api.php' );
}

# Page Template Redirects
require_once( plugin_dir_path( __FILE__ ) . '/includes/template-functions.php' );

# JW Platform/Player API Functions
require_once( plugin_dir_path( __FILE__ ) . '/includes/jw-api.php' );

/*--------------------------------------------------------------
 # LOAD INCLUDES FILES Pt. 2 - Advanced Custom Fields
 --------------------------------------------------------------*/

# 1. customize ACF path
add_filter( 'acf/settings/path', 'my_acf_settings_path' );
function my_acf_settings_path( $path ) {
	$path = FCCPOD__PLUGIN_PATH . 'includes/advanced-custom-fields-pro/';
	return $path;
}

# 2. customize ACF dir
add_filter( 'acf/settings/dir', 'my_acf_settings_dir' );
function my_acf_settings_dir( $dir ) {
	$dir = FCCPOD__PLUGIN_DIR . 'includes/advanced-custom-fields-pro/';
	return $dir;
}

# 3. Hide ACF field group menu item
//add_filter( 'acf/settings/show_admin', '__return_false' );

# 4. Include ACF
include_once( plugin_dir_path( __FILE__ ) . 'includes/advanced-custom-fields-pro/acf.php' );

/*--------------------------------------------------------------
 # LOAD INCLUDES FILES Pt. 3
 --------------------------------------------------------------*/

# ACF: Load Custom Functions & Filters
require_once( plugin_dir_path( __FILE__ ) . '/includes/acf-functions.php' );

# ACF: Add Admin Pages
require_once( plugin_dir_path( __FILE__ ) . '/includes/admin-settings-page.php' );

# ACF: Load Custom Fields
require_once( plugin_dir_path( __FILE__ ) . '/includes/acf-fields.php' );

# Insert Post Functions
require_once( plugin_dir_path( __FILE__ ) . '/includes/update-post-functions.php' );

/*--------------------------------------------------------------
 # ADMIN NOTICES (NOTE: deprecated, network-options now used)
 --------------------------------------------------------------*/

/**
* Set Admin Notices
*
* @author Josh Slebodnik <josh.slebodnik@forumcomm.com>
* @since 0.16.02.08
* @version 1.16.05.26
*/
function add_admin_notices() {
	if ( ! get_site_option( 'jw_api_key' ) || ! get_site_option( 'jw_api_secret' ) ) {
		require_once( plugin_dir_path( __FILE__ ) . '/includes/admin-notices.php' );
	}
}
//add_action( 'init', 'add_admin_notices' );

/*--------------------------------------------------------------
 # ENQUEUE STYLES & SCRIPTS
 --------------------------------------------------------------*/

/**
 * Load 'Podcasts' Admin Scripts
 *
 * Set Podcast Post Titles to Read-Only (admin_title_disable.js)
 * Autopopulate Podcast Fields with jwplayer info (autopopulate.js)
 *
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @author Braden Stevenson <braden.stevenson@forumcomm.com>
 * @since 0.16.02.04
 * @version 1.16.05.26
 */
function load_on_podcasts_admin() {
	global $my_admin_page;
	$screen = get_current_screen();
	if ( 'podcasts' != $screen->id ) {
		return;
	} # Else Proceed
	wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . '/includes/js/autopopulate.js' );
}
add_action( 'admin_enqueue_scripts', 'load_on_podcasts_admin' );

/**
 * Hides the title in the Podcasts post editor screen
 *
 * @since 1.16.07.01
 * @since 1.16.07.06
 */
function fccpod_hide_podcasts_title() {
	global $my_admin_page;
	$screen = get_current_screen();
	if ( 'podcasts' != $screen->id ) {
		return;
	} # Else Proceed
	echo '<style type="text/css">#titlediv { display: none; }</style>';
}
add_action( 'admin_head', 'fccpod_hide_podcasts_title' );


/*--------------------------------------------------------------
 # AJAX
 --------------------------------------------------------------*/

/**
 * Podcasts AJAX Request
 *
 *	 Validates the segment JW key.
 * Returns and populates the duration, date and size fields.
 *
 * @author Braden Stevenson <braden.stevenson@forumcomm.com>
 * @since 0.16.01.27
 * @version 1.16.05.26
 * @link http://wptheming.com/2013/07/simple-ajax-example/
 */
function jwplayer_ajax_request() {
	if ( isset( $_REQUEST ) ) {
		# The $_REQUEST contains all the data sent via ajax
		$key = $_REQUEST['key'];

		# Now we'll return it to the javascript function
		# Anything outputted will be returned in the response
		$duration = fccpod_jw_conversion_duration( $key );
		$date = fccpod_jw_date_admin( $key );
		$size = fccpod_jw_size( $key );

		# Build the array and echo it as JSON
		$jwplayer_array = array( $duration, $date, $size );
		echo json_encode( $jwplayer_array );
	}
	# Always die in functions echoing ajax content
	die();
}
add_action( 'wp_ajax_jwplayer_ajax_request', 'jwplayer_ajax_request' );

/*--------------------------------------------------------------
 # PODCASTS FEED
 --------------------------------------------------------------*/

/**
 * Add 'Podcasts' Feed
 *
 * Add a new feed type at [example.com]/feed/podcasts
 *
 * @since 0.16.02.03
 * @version 1.16.05.26
 * @uses add_podcasts_feed()
 * @link https://codex.wordpress.org/Rewrite_API/add_feed
 */
function fccpod_do_podcasts_feed() {

	# Load the functions file
	require_once( plugin_dir_path( __FILE__ ) . '/includes/podcasts-feed-functions.php' );
	# Declare the feed
	add_feed( 'podcasts', 'add_podcasts_feed' );
}
add_action( 'init', 'fccpod_do_podcasts_feed' );

/*--------------------------------------------------------------
 # TinyMCE Character Limit
 --------------------------------------------------------------*/
function fccpod_tinymce_init() {
	// Hook to tinymce plugins filter
	add_filter( 'mce_external_plugins', 'fccpod_tinymce_plugin' );
}
add_filter( 'init', 'fccpod_tinymce_init' );

function fccpod_tinymce_plugin( $init ) {
	global $my_admin_page;
	$screen = get_current_screen();
	if ( 'podcasts' != $screen->id ) {
		return;
	} # Else Proceed
	$init['keyup_event'] = plugin_dir_url( __FILE__ ) . '/includes/js/limitchars.js';
	return $init;
}
