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
			// Add Options Page
			add_action( 'admin_menu', array( &$this, 'add_options_page' ) );
			// Register Options
			add_action( 'admin_init', array( &$this, 'register_settings' ) );
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
	function shortcode( $atts ) {
		$atts = extract( shortcode_atts( array( 'default'=>'values' ),$atts ) );
		return '<ul id="wp_multi_file_uploader" class="unstyled" data-filecount="1" data-ajaxurl="' . site_url( 'wp-admin/admin-ajax.php' ) . '"></ul>';
	}

	/*
	* Output The Upload Form
	*/
	function output_form()
	{
		echo '<ul id="wp_multi_file_uploader" class="unstyled" data-filecount="1" data-ajaxurl="' . site_url( 'wp-admin/admin-ajax.php' ) . '"></ul>';
	} // output_form()


	/*
	* Enqueue Scripts & Styles
	*/
	public function enqueue_scripts_styles()
	{
		$version = '1.0';
		wp_register_script( 'wpmfu_script', plugins_url( 'assets/js/fineuploader.min.js' , dirname(__FILE__) ), array( 'jquery' ), $version, true );
		wp_enqueue_script( 'wpmfu_script' );
		wp_register_style( 'wpmfu_style', plugins_url( 'assets/css/fineuploader.css' , dirname(__FILE__) ), array(), $version );
		wp_enqueue_style( 'wpmfu_style' );
	} // enqueue_scripts_styles()


	/*
	*	Add Options Page
	*/
	function add_options_page()
	{
		add_options_page(
			'WP Multi File Uploader Options',
			'WPMFU Settings',
			'manage_options',
			'wp-multi-file-uploader',
			array( &$this, 'options_page' )
		);
	} // add_options_page()


	/*
	* Output Options Page
	*/
	function options_page()
	{
		require_once "options-page/options-page.php";
	} // options_page()


	/*
	* Register Plugin Settings
	*/
	function register_settings()
	{
		$pagename = 'wpmfu-plugin';
		$main_settings_page = 'wpmfu_plugin_main';

		// Register Setting
		register_setting(
			'wpmfu_plugin_options',
			'wpmfu_plugin_options',
			array( &$this, 'plugin_options_validate' )
		);

		// Settings Section
		add_settings_section(
			$main_settings_page,
			'',
			array( &$this,'wpmfu_plugin_main_plugin_section_text' ),
			$pagename
		);

		// Add Settings Field
		add_settings_field(
			'wpfmu_css_file',
			'Override CSS File',
			array( &$this, 'wpmfu_plugin_css_file_setting' ),
			$pagename,
			$main_settings_page
		);
	} // register_settings()


	/*
	* Handles Validation of the Plugin Options
	*/
	function validate_plugin_options()
	{
		// $newinput['text_string'] = trim($input['text_string']);
		// return $newinput;
	} // validate_plugin_options()


	/*
	* Outputs The Section Text
	*/
	function wpmfu_plugin_main_plugin_section_text(){
		// echo '<p>Settings</p>';
	} // wpmfu_plugin_main_plugin_section_text()

	/*
	* Outputs CSS File Setting
	*/
	function wpmfu_plugin_css_file_setting(){
		$options = get_option( 'wpmfu_plugin_options', false );
		// echo "<input id='wpfmu_css_file' name='wpmfu_plugin_options[css-file]' size='40' type='text' value='{$options['wpfmu_css_file']}' />";
	} // wpmfu_plugin_css_file_setting()

} // class WPMFU_Plugin