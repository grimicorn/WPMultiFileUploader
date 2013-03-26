<?php
/**
* WPMFU Form Builder
*/
class WPMFU_Form_Builder extends WPMFU_Plugin
{

	/**
	* Constructor
	*/
	function __construct()
	{
		# code...
	} // __constuct


	/**
	* Opens the form
	*/
	public function form_open( $action = '?')
	{
		return '<form action="'.$action.'" method="post" accept-charset="utf-8">';
	} // form_open()


	/**
	* Closes the form
	*/
	public function form_close()
	{
		return '</form>';
	} // form_close()


	/**
	* Input field
	*/
	public function input( $attrs )
	{
		$default_attrs = array(
			'type'					=>	'text',
			'id'						=>	'',
			'placeholder'		=>	'',
			'value'					=>	'',
			'disabled'			=>	false,
			'size'					=> 	null,
			'class'					=>	'wpmfu-input',
			'maxlength'			=>	null,
			'checked'				=>	false,
			'label_text'		=>	'',
			'label_class'		=>	'wpmfu-label',
			'output_label'	=>	true
		);
		extract( shortcode_atts( $default_attrs, $attrs ) );

		// Get the Label
		if ( $label ) {
			$label = $this->label(array(
				'id'					=>	$id,
				'label_text'	=>	$label_text,
				'label_class'	=>	$label_class
			));
		} // if($label)


		$input = '';
		return $label . $input;
	} // input()


	/**
	* Label
	*/
	public function label( $attrs )
	{
		$label = '';
	} // label()


} // end class WPMFU_Form_Builder()