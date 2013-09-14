<?php
/**
 *	@package WPMFU_Plugin
 *	@version 1.1.0
 *	@since 1.0.0
 *	@author Dan Holloran
 *	@copyright GPLv2 (or later)
 */
class WPFMU_FileUploadHandler extends WPMFU_Plugin
{

	/**
	* Constructor
	*
	*	@since 1.0.0
	*/
	function __construct(){
		parent::__construct();
	}


	/**
	* Process the upload.
	*
	*	@since 1.0.0
	*/
	public function handle_upload(){
		// Make sure all files are allowed
		if ( !$this->check_file_type( $_FILES['qqfile']['name'] ) ) {
			return array( 'success' => false );
		} // if()

		// Get size and name
		if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
		$uploadedfile = $_FILES['qqfile'];
		$upload_overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		if ( $movefile ) {
			$wp_upload_dir = wp_upload_dir();
			$filename = str_replace( $wp_upload_dir['url'] . '/', '', $movefile['url'] );
			$attachment = $this->add_attachment( $movefile['url'], $movefile['file'] );
			return array(
				'success' 		=> $movefile,
				'attachmentId'	=> $attachment
			);
		} else {
			return array( 'success' => false );
		}

		return array( 'success' => false );
	} // handle_upload


	/**
	* Create Image Sizes
	*
	* @since 1.1.2
	*/
	function create_image_sizes( $filepath )
	{
		$sizes = array();
		foreach( get_intermediate_image_sizes() as $s ) {
			$sizes[$s] = array( 'width' => '', 'height' => '', 'crop' => true );
			$sizes[$s]['width'] = get_option( "{$s}_size_w" ); // For default sizes set in options
			$sizes[$s]['height'] = get_option( "{$s}_size_h" ); // For default sizes set in options
			$sizes[$s]['crop'] = get_option( "{$s}_crop" ); // For default sizes set in options
		} // foreach()

		$sizes = apply_filters( 'intermediate_image_sizes_advanced', $sizes );
		$metadata = array();
		foreach( $sizes as $size => $size_data ) {
			$resized = image_make_intermediate_size( $filepath, $size_data['width'], $size_data['height'], $size_data['crop'] );
			if ( $resized )
				$metadata[$size] = $resized;
		} // foreach()
		return $metadata;
	} // create_image_sizes()


	/**
	* Handle Attachment
	*
	* @since 1.0.0
	*/
	public function add_attachment( $url, $filepath )
	{
		$meta = $this->create_image_sizes( $filepath );
		$wp_upload_dir = wp_upload_dir();
		$filename = str_replace( $wp_upload_dir['url'] . '/', '', $url );
		$wp_filetype = wp_check_filetype(basename($filename), null );

		$attachment = array(
			 'guid' => $url,
			 'post_mime_type' => $wp_filetype['type'],
			 'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
			 'post_content' => '',
			 'post_status' => 'inherit'
		);
		$attach_id = wp_insert_attachment( $attachment, $url );
		// you must first include the image.php file
		// for the function wp_generate_attachment_metadata() to work
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		$attach_data = wp_generate_attachment_metadata( $attach_id, $url );
		$attach_data['sizes'] = $meta;
		wp_update_attachment_metadata( $attach_id, $attach_data );

		return $attach_id;
	} //add_attachment()


	/**
	* Handle Response
	*
	*	@since 1.0.0
	*/
	public function handle_response()
	{
		// Return Result
		$result = $this->handle_upload();

		header("Content-Type: text/plain");
		echo json_encode( $result );
		die();
	} // handle_response()


	/**
	* Get WordPress Default Allowed Mime Types
	*
	* @since 1.1.0
	*/
	public function allowed_mime_types()
	{
		// Work through the WordPress supported mime types
		$wp_allowed_mime_types = get_allowed_mime_types();
		$allowed_mime_types = array();
		foreach ( $wp_allowed_mime_types as $key => $value ) {
			$mime_types = explode( '|', $key);
			// Build mime types array out of WordPress allowed mime types
			foreach ( $mime_types as $mime_type ) {
				$allowed_mime_types[] = $mime_type;
			} // foreach()
		} // foreach()


		return $allowed_mime_types;
	} // allowed_mime_types()


	/**
	* Check File Type
	*
	* @since 1.1.0
	*/
	public function check_file_type( $file_name )
	{
		global $post;
		// Get file info
		$filetype = wp_check_filetype( $file_name );
		// Get the default wpmfu options for the current post
		$wpmfu_post_options = get_option( "wpmfu_{$_POST['postId']}", array() );

		// Make sure the file type is allowed
		if ( in_array( $filetype['ext'], $wpmfu_post_options['allowed_mime_types'] ) ) {
			return true;
		}

		return false;
	} // check_file_type()


	/**
	* Get WordPress/PHP max file size
	*
	* @since 1.1.0
	*/
	public function max_file_size() {
		$max_upload = (int)(ini_get('upload_max_filesize'));
		$max_post = (int)(ini_get('post_max_size'));
		$memory_limit = (int)(ini_get('memory_limit'));
		if ( defined( WP_MEMORY_LIMIT ) ) {
			$upload_mb = min( $max_upload, $max_post, $memory_limit, WP_MEMORY_LIMIT );
		} else {
			$upload_mb = min( $max_upload, $max_post, $memory_limit );
		}


		return $upload_mb;
	} // max_file_size()

} // class WPFMU_FileUploadHandler

$wpmfu_file_upload_handler = new WPFMU_FileUploadHandler();