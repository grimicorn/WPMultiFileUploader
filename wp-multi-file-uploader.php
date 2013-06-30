<?php
/**
 *	@version 1.1.2
 *	@author Dan Holloran
 *	@copyright GPLv2 (or later)
 */
/*
Plugin Name: WP Multi File Uploader
Plugin URI: http://dholloran.github.com/WPMultiFileUploader/
Description: Wordpress plugin that allows a user to submit multiple files from a form on your Wordpress site via AJAX to Wordpress default uploads fold and adds an attachment to the Wordpress media gallery.
Author: Dan Holloran
Version: 1.1.2
Author URI: http://danholloran.com/
*/

define( 'WPMFU_VERSION', '1.1.2' );


/**
* Required files
*/
require_once "classes/class-wpmfu-init.php";					// Handles plugin install/activate/deactivate/uninstall
require_once "classes/class-wpmfu-plugin.php";				// Base plugin class
// require_once "inc/wpmfu-post-type.php"; 							// WPMFU Form Post Type
require_once "classes/class.wpmfu-html.php";					// Handles common html tasks
require_once "classes/class.wpmfu-form-builder.php";	// Handles building the forms

/**
* Handles Activation/Deactivation/Install
*/
register_activation_hook( __FILE__, array( 'WPMFU_Init', 'on_activate' ) );
register_deactivation_hook( __FILE__, array( 'WPMFU_Init', 'on_deactivate' ) );
register_uninstall_hook( __FILE__, array( 'WPMFU_Init', 'on_uninstall' ) );

// Requires
require_once "classes/class-wpmfu-file-upload-handler.php";

/**
*	Setup Theme/Template File Function
*
* @since 1.0.0
*/
function wp_multi_file_uploader( $atts = array(), $shortcode = false )
{
	global $wpmfu_file_upload_handler;
	global $wpmfu_plugin;
	global $post;
	extract( $atts );
	$max_file_size = $wpmfu_file_upload_handler->max_file_size();

	// We do not want to override/change the user inputed file types
	// this is the default action of shortcode_atts() so we just
	// make our default match the input if it exists
	$allowed_mime_types = ( isset( $allowed_mime_types ) ) ? $allowed_mime_types : $wpmfu_file_upload_handler->allowed_mime_types();

	// Make sure allowed mime types is an array
	if ( gettype( $allowed_mime_types ) == 'string' ) {
		$allowed_mime_types = explode( ',', $allowed_mime_types );
	}// if()

	// Add a few things to the DB/Global scope so we can make sure
	// no one has tampered with the JS data attributes that control
	// client side file validation
	update_option( "wpmfu_{$post->ID}", array(
		"allowed_mime_types"	=>	$allowed_mime_types,
		"max_file_size"				=>	$max_file_size
	));
	$GLOBALS["allowed_mime_types"] = $allowed_mime_types;
	$GLOBALS["max_file_size"] = $max_file_size;

	// Merge attributes
	$default_atts = array(
		'allowed_mime_types'	=>	$allowed_mime_types,
		'max_file_size'				=>	$max_file_size
	);
	$atts = shortcode_atts( $default_atts, $atts );

	if ( $shortcode ) {
		return $wpmfu_plugin->build_form( $atts );
	} else {
		echo $wpmfu_plugin->build_form( $atts );
		return '';
	}
} // wp_multi_file_uploader()


/**
* Setup The Shortcode
*
* @since 1.0.0
*/
function wp_multi_file_uploader_shortcode( $atts = array() ) {
	if ( gettype( $atts ) != 'array' ) {
		$atts = array();
	}
	return wp_multi_file_uploader( $atts, true );
}
add_shortcode( 'wp-multi-file-uploader', 'wp_multi_file_uploader_shortcode' );


/**
* AJAX Callback
*
* @since 1.0.0
*/
add_action( 'wp_ajax_wp_multi_file_uploader', 'wp_multi_file_uploader_callback' );
add_action( 'wp_ajax_nopriv_wp_multi_file_uploader', 'wp_multi_file_uploader_callback' );
function wp_multi_file_uploader_callback()
{
	$file_uploader = new WPFMU_FileUploadHandler();
	$file_uploader->handle_response();
} // wp_multi_file_uploader_callback()

