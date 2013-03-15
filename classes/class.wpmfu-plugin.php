<?php
class WPMFU_Plugin
{

	protected $inputName = 'qqfile';

	/*
	* Constructor
	*/
	public function __construct() {
		// Hooks & Actions
		$this->init_hooks();
	} // __construct()


	/*
	* Init Hooks
	*/
	public function init_hooks()
	{
		if ( is_admin() ) {
		} else {
			// Styles & Scripts
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts_styles' ) );
			// Shortcode
			add_shortcode( 'wp-multi-file-uploader', array( __CLASS__, 'shortcode' ) );
		} // if/else(is_admin())

	} // init_hooks()



	/*
	* Generate The Shortcode
	*/
	public function shortcode( $atts ) {
		$default_atts = array(
			'file_types'=>'jpg|jpeg|png|gif|pdf|doc|docx|ppt|pptx|pps|ppsx|odt|xls|xlsx|mp3|m4a|ogg|wav|mp4|m4v|mov|wmv|avi|mpg|ogv|3gp|3g2'
		);
		$atts = extract( shortcode_atts( $default_atts,$atts ) );

		return '<ul id="wp_multi_file_uploader" class="unstyled" data-filecount="1" data-types="'.$file_types.'" data-ajaxurl="'.site_url( 'wp-admin/admin-ajax.php' ).'"></ul>';
	}

	/*
	* Output The Upload Form
	*/
	public function output_form()
	{
		echo '<ul id="wp_multi_file_uploader" class="unstyled" data-filecount="1" data-ajaxurl="' . site_url( 'wp-admin/admin-ajax.php' ) . '"></ul>';
	} // output_form()


	/*
	* Enqueue Scripts & Styles
	*/
	public function enqueue_scripts_styles()
	{
		$version = '1.0.0';
		wp_register_script( 'wpmfu_script', plugins_url( 'assets/js/fineuploader.min.js' , dirname(__FILE__) ), array( 'jquery' ), $version, true );
		wp_enqueue_script( 'wpmfu_script' );
		wp_register_style( 'wpmfu_style', plugins_url( 'assets/css/fineuploader.css' , dirname(__FILE__) ), array(), $version );
		wp_enqueue_style( 'wpmfu_style' );
	} // enqueue_scripts_styles()

} // class WPMFU_Plugin