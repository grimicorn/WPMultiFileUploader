<?php
/**
 * @package WP_Multi_File_Uploader
 * @version 1.0
 */
/*
Plugin Name: WP Multi File Uploader
Plugin URI: http://danholloran.com/wp-multi-file-uploader/
Description: Multi File Uploader
Author: Dan Holloran
Version: 1.0
Author URI: http://danholloran.com/
*/


// Handles Activation/Deactivation/Install
require_once "classes/class-wpmfu-init.php";
register_activation_hook( __FILE__, array( 'WPMFU_Init', 'on_activate' ) );
register_deactivation_hook( __FILE__, array( 'WPMFU_Init', 'on_deactivate' ) );
register_uninstall_hook( __FILE__, array( 'WPMFU_Init', 'on_uninstall' ) );

// Instantiate Plugin Class
require_once "classes/class-wpmfu-plugin.php";
$wp_multi_file_uploader = new WPMFU_Plugin();

	/*
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

