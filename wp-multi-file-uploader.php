<?php
/**
 * @package WP_Multi_File_Uploader
 * @version 1.1.0
 */
/*
Plugin Name: WP Multi File Uploader
Plugin URI: http://danholloran.com/wp-multi-file-uploader/
Description: Wordpress plugin that allows a user to submit multiple files from a form on your Wordpress site via AJAX to Wordpress default uploads fold and adds an attachment to the Wordpress media gallery.
Author: Dan Holloran
Version: 1.0.0
Author URI: http://danholloran.com/
*/

/**
* Required files
*/
require_once "classes/class-wpmfu-init.php";					// Handles plugin install/activate/deactivate/uninstall
require_once "classes/class-wpmfu-plugin.php";				// Base plugin class
require_once "inc/wpmfu-post-type.php"; 							// WPMFU Form Post Type
require_once "classes/class.wpmfu-form-builder.php";	// Handles building the forms

/**
* Handles Activation/Deactivation/Install
*/
register_activation_hook( __FILE__, array( 'WPMFU_Init', 'on_activate' ) );
register_deactivation_hook( __FILE__, array( 'WPMFU_Init', 'on_deactivate' ) );
register_uninstall_hook( __FILE__, array( 'WPMFU_Init', 'on_uninstall' ) );


/**
*	Setup Theme/Template File Function
*/
function wp_multi_file_uploader()
{
	global $wpmfu_plugin;
	echo $wpmfu_plugin->build_form();
} // wp_multi_file_uploader()


/*
* Setup The Shortcode
*/
function wp_multi_file_uploader_shortcode( $atts ) {
	$default_atts = array();
	$atts = extract( shortcode_atts( $default_atts, $atts ) );
	global $wpmfu_plugin;
	return $wpmfu_plugin->build_form( $atts );
}
add_shortcode( 'wp-multi-file-uploader', 'wp_multi_file_uploader_shortcode' );


/**
* AJAX Callback
*/
add_action( 'wp_ajax_wp_multi_file_uploader', 'wp_multi_file_uploader_callback' );
add_action( 'wp_ajax_nopriv_wp_multi_file_uploader', 'wp_multi_file_uploader_callback' );
function wp_multi_file_uploader_callback()
{
	// Instantiate File Upload Handler Class
	require_once "classes/class-wpmfu-file-upload-handler.php";
	$file_uploader = new WPFMU_FileUploadHandler();
	$file_uploader->handle_response();
} // wp_multi_file_uploader_callback()

