<?php
/**
 *	@package WPMFU_Plugin
 *	@version 1.1.0
 *	@since 1.0.0
 *	@author Dan Holloran
 *	@copyright GPLv2 (or later)
 */
class WPMFU_Plugin
{

	protected $inputName = 'qqfile';

	/**
	* Constructor
	*
	*	@since 1.0.0
	*/
	public function __construct( $config = array() ) {
		$this->init_hooks();
	} // __construct()


	/**
	* Init Hooks
	*
	* @since 1.0.0
	*/
	public function init_hooks()
	{
		// Front End Styles & Scripts
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts_styles' ) );

		// Admin Styles & Scripts
		add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_admin_scripts_styles' ) );
	} // init_hooks()


	/**
	* Build the uploader form
	*
	* @since 1.0.0
	*/
	function build_form( $attrs = array() )
	{
		extract( $attrs );
		global $post;

		$allowed_mime_types = ( gettype( $allowed_mime_types ) == 'array' ) ? implode( ',', $allowed_mime_types) : $allowed_mime_types;
		$form = '';
		$form .= '<ul ';
		$form .= 'id="wp_multi_file_uploader" ';
		$form .= 'class="unstyled" ';
		$form .= 'data-filecount="1" ';
		$form .= 'data-mimetypes="'.$allowed_mime_types.'" ';
		$form .= 'data-maxsize="'.$max_file_size.'" ';
		$form .= 'data-postid="'.$post->ID.'" ';
		$form .= 'data-ajaxurl="' . site_url( 'wp-admin/admin-ajax.php' ) . '">';
		$form .= '</ul>';

		return $form;
	} // build_form()


	/**
	* Enqueue Scripts & Styles
	*
	* @since 1.0.0
	*/
	public function enqueue_scripts_styles()
	{
		global $wpmfu_plugin;
		wp_register_script( 'wpmfu_script', plugins_url( 'assets/js/fineuploader.min.js' , dirname(__FILE__) ), array( 'jquery' ), WPMFU_VERSION, true );
		wp_enqueue_script( 'wpmfu_script' );
		wp_register_style( 'wpmfu_style', plugins_url( 'assets/css/wpmfu-plugin.css' , dirname(__FILE__) ), null, WPMFU_VERSION );
		wp_enqueue_style( 'wpmfu_style' );
	} // enqueue_scripts_styles()


	/**
	* Enqueue Administrator Scripts & Styles
	*
	*	@since 1.0.0
	*/
	public function enqueue_admin_scripts_styles()
	{
		global $wpmfu_plugin;
		global $post;

		// Make sure we are on the correct page
		if ( isset( $post ) AND $post->post_type != 'wpmfu_forms_type') return false;

		// Enqueue scripts and styles
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-mouse' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-droppable' );
	} // enqueue_admin_scripts_styles()

} // class WPMFU_Plugin

$wpmfu_plugin = new WPMFU_Plugin();