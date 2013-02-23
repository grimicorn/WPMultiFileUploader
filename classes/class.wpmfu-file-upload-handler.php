<?php
/**
*
*/
class WPFMU_FileUploadHandler extends WPMFU_Plugin
{

	/*
	* Constructor
	*/
	function __construct(){}


		/*
	* Process the upload.
	*/
	public function handle_upload(){
		// Get size and name
		if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
			$uploadedfile = $_FILES['qqfile'];
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
			if ( $movefile ) {

				$wp_upload_dir = wp_upload_dir();
				$filename = str_replace( $wp_upload_dir['url'] . '/', '', $movefile['url'] );
		    $attachment = $this->add_attachment( $movefile['url'] );
		    return array(
		    	'success' 		=> $movefile,
		    	'attachmentId'	=> $attachment
		    );
			} else {
		    // Result
				return array( 'success' => false );
			} // if/else($movefile)
	} // handle_upload


	/*
	* Handle Attachment
	*/
	public function add_attachment( $url )
	{

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
	  $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	  wp_update_attachment_metadata( $attach_id, $attach_data );

	  return $attach_id;
	} //add_attachment()


	/*
	* Handle Response
	*/
	public function handle_response()
	{
		// Return Result
		$result = $this->handle_upload();

		header("Content-Type: text/plain");
		echo json_encode($result);
		die();
	} // handle_response()


} // class WPFMU_FileUploadHandler