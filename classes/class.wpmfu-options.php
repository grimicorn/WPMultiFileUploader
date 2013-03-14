<?php
/**
* WPMFU Options
*/
class WPMFU_Options extends WPMFU_Plugin
{
	private $option_key;

	/*
	* Constructor
	*/
	public function __construct()
	{
		parent::__construct();
		$this->option_key = 'wpmfu_options';
	} // __construct()


	/*
	* Init Hooks
	*/
	public function init_hooks()
	{

		if ( is_admin() ) {
			// Add Options Page
			add_action( 'admin_menu', array( &$this, 'add_options_page' ) );
			// Styles & Scripts
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_scripts_styles' ) );
		} // if ( is_admin() )
	} // init_hooks()


	/*
	*	Add Options Page
	*/
	public function add_options_page()
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
	public function options_page()
	{
		require_once "options-page/options-page.php";
	} // options_page()


	/*
	* Save Options
	*/
	public function save_options()
	{
		if ( empty( $_POST['submit'] ) ) return;

		// No need to store or sue the submit value
		unset( $_POST['submit']);

		// :TODO Add error checking once more options are added
		$options = $_POST;
		update_option( $this->option_key, $options );
	} // save_options()


	/*
	* Get Options
	*/
	public function get_options()
	{
		return get_option( $this->option_key );
	} // get_options()


	/*
	* Enqueue Scripts & Styles
	*/
	public function enqueue_admin_scripts_styles()
	{
		$current_screen = get_current_screen();
		if ( $current_screen->id == 'settings_page_wp-multi-file-uploader' ) {
			$version = '1.0.0';
			wp_register_style( 'wpmfu_admin_style', plugins_url( 'assets/css/admin.css' , dirname(__FILE__) ), array(), $version );
			wp_enqueue_style( 'wpmfu_admin_style' );
		} // if()
	} // enqueue_scripts_styles()



} // class WPMFU_Options