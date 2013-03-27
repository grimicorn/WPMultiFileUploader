<?php
class WPMFU_Plugin
{

	protected $inputName = 'qqfile';


	/*
	* Constructor
	*/
	public function __construct() {
		$this->init_hooks();
	} // __construct()


	/*
	* Init Hooks
	*/
	public function init_hooks()
	{
		// Styles & Scripts
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts_styles' ) );
		// Shortcode
		add_shortcode( 'wp-multi-file-uploader', array( __CLASS__, 'shortcode' ) );
	} // init_hooks()



	/*
	* Generate The Shortcode
	*/
	public function shortcode( $atts ) {
		$default_atts = array();
		$atts = extract( shortcode_atts( $default_atts,$atts ) );

		return $this->build_form();
	}

	/*
	* Output The Upload Form
	*/
	function output_form()
	{
		echo $this->build_form();
	} // output_form()


	function build_form()
	{
		$form = '<ul id="wp_multi_file_uploader" class="unstyled" data-filecount="1" data-ajaxurl="' . site_url( 'wp-admin/admin-ajax.php' ) . '"></ul>';
		return $form;
	}


	/*
	* Enqueue Scripts & Styles
	*/
	public function enqueue_scripts_styles()
	{
		$version = '1.0';
		wp_register_script( 'wpmfu_script', plugins_url( 'assets/js/fineuploader.min.js' , dirname(__FILE__) ), array( 'jquery' ), $version, true );
		wp_enqueue_script( 'wpmfu_script' );
		wp_register_style( 'wpmfu_style', plugins_url( 'assets/css/fineuploader.css' , dirname(__FILE__) ), null, $version );
		wp_enqueue_style( 'wpmfu_style' );
	} // enqueue_scripts_styles()


} // class WPMFU_Plugin