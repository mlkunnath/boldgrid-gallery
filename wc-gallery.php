<?php
/**
 * Plugin Name: BoldGrid Gallery
 * Plugin URI: http://www.boldgrid.com
 * Description: Extend WordPress galleries to display masonry gallery and slider gallery
 * Version: 1.2
 * Author: BoldGrid.com <wpb@boldgrid.com>
 * Author URI: http://www.boldgrid.com
 * Text Domain: boldgrid-gallery
 * Domain Path: /languages
 * License: GPLv2 or later
 */

// Prevent direct calls.
if ( false === defined( 'WPINC' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

// Define Editor version.
if ( false === defined( 'BOLDGRID_GALLERY_VERSION' ) ) {
	define( 'BOLDGRID_GALLERY_VERSION', '1.2' );
}

// Define Editor Path.
if ( false === defined( 'BOLDGRID_GALLERY_PATH' ) ) {
	define( 'BOLDGRID_GALLERY_PATH', dirname( __FILE__ ) );
}

// Define Editor configuration directory, if not defined.
if ( false === defined( 'BOLDGRID_GALLERY_CONFIGDIR' ) ) {
	define( 'BOLDGRID_GALLERY_CONFIGDIR', BOLDGRID_GALLERY_PATH . '/boldgrid/includes/config' );
}

// If DOING_CRON, then check if this plugin should be auto-updated.
if ( true === defined( 'DOING_CRON' ) && DOING_CRON ){
	// Ensure required definitions for pluggable.
	if ( false === defined( 'AUTH_COOKIE' ) ) {
		define( 'AUTH_COOKIE', null );
	}

	if ( false === defined( 'LOGGED_IN_COOKIE' ) ) {
		define( 'LOGGED_IN_COOKIE', null );
	}

	// Load the pluggable class, if needed.
	require_once ABSPATH . 'wp-includes/pluggable.php';

	// Include the update class.
	require_once BOLDGRID_GALLERY_PATH . '/boldgrid/includes/class-boldgrid-gallery-update.php';

	// Instantiate the update class.
	$plugin_update = new Boldgrid_Gallery_Update();

	// Check and update plugins.
	$plugin_update->wp_update_this_plugin();
}

// BoldGrid: Original code is below (lines 58-146).
/* @formatter:off */

function wc_gallery_using_woocommerce() {
	return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
}

define( 'WC_GALLERY_VERSION', '1.52' );
define( 'WC_GALLERY_PREFIX', 'wc_gallery_' );
define( '_WC_GALLERY_PREFIX', '_wc_gallery_' );
define( 'WC_GALLERY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WC_GALLERY_USING_WOOCOMMERCE', wc_gallery_using_woocommerce() );
define( 'WC_GALLERY_CURRENT_VERSION', get_option( WC_GALLERY_PREFIX . 'current_version' ) );
define( 'WC_GALLERY_PLUGIN_BASENAME', plugin_basename( plugin_dir_path( realpath( __FILE__ ) ) . 'wc-gallery.php' ) );

global $wc_gallery_options;
global $wc_gallery_theme_support;

$wc_gallery_theme_support = array(
	'icon' => array(
		'size_w' => '48',
		'size_h' => '48',
		'crop' => true,
		'enable' => true,
	),
	'square' => array(
		'size_w' => '300',
		'size_h' => '300',
		'crop' => true,
		'enable' => true,
	),
	'small' => array(
		'size_w' => '250',
		'size_h' => '9999',
		'crop' => false,
		'enable' => true,
	),
	'standard' => array(
		'size_w' => '550',
		'size_h' => '9999',
		'crop' => false,
		'enable' => true,
	),
	'big' => array(
		'size_w' => '800',
		'size_h' => '9999',
		'crop' => false,
		'enable' => true,
	),
	'fixedheightsmall' => array(
		'size_w' => '9999',
		'size_h' => '180',
		'crop' => false,
		'enable' => true,
	),
	'fixedheightmedium' => array(
		'size_w' => '9999',
		'size_h' => '300',
		'crop' => false,
		'enable' => true,
	),
	'fixedheight' => array(
		'size_w' => '9999',
		'size_h' => '500',
		'crop' => false,
		'enable' => true,
	),
	'carouselsmall' => array(
		'size_w' => '210',
		'size_h' => '150',
		'crop' => true,
		'enable' => true,
	),
	'carousel' => array(
		'size_w' => '400',
		'size_h' => '285',
		'crop' => true,
		'enable' => true,
	),
	'slider' => array(
		'size_w' => '1100',
		'size_h' => '500',
		'crop' => true,
		'enable' => true,
	),
);

require_once( plugin_dir_path( __FILE__ ) . 'includes/vendors/wpc-settings-framework/init.php' );
require_once( dirname(__FILE__) . '/includes/functions.php' ); // Adds basic filters and actions
require_once( dirname(__FILE__) . '/includes/options.php' ); // define options array
require_once( dirname(__FILE__) . '/includes/scripts.php' ); // Adds plugin JS and CSS
// require_once( dirname(__FILE__) . '/includes/widgets.php' ); // include any widgets

// BoldGrid:
/* @formatter:on */

// Load boldgrid-gallery.
require_once BOLDGRID_GALLERY_PATH . '/boldgrid/includes/class-boldgrid-gallery.php';
$boldgrid_gallery = new Boldgrid_Gallery();
$boldgrid_gallery->init();
