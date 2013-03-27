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
	* Multi Uploader
	*/
	public function multi_uploader()
	{
		return $this->build_form();
	}

	/**
	* Submit Button
	*/
	public function submit( $attrs = array() )
	{
		$default_attrs = array(
			'type'					=>	'submit',
			'id'						=>	'wpmfu_submit',
			'value'					=>	'Submit',
			'class'					=>	'wpmfu-input wpmfu-submit',
			'output_label'	=>	false
		);
		extract( shortcode_atts( $default_attrs, $attrs ) );
	} // submit()


	/**
	* Input field
	*/
	public function input( $attrs = array() )
	{
		$default_attrs = array(
			'type'					=>	'text',
			'id'						=>	'',
			'placeholder'		=>	null,
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
		$label = '';
		if ( $output_label ) {
			$label = $this->label(array(
				'id'					=>	$id,
				'label_text'	=>	$label_text,
				'label_class'	=>	$label_class
			));
		} // if($label)

		if ( $type == 'checkbox' OR $type == 'radio' ) {
			$checked = ( $checked )  ? " checked='{$checked}' " : '';
		} else {
			$checked = '';
		}

		$input = '';
		$input .= "<input";
		$input .= " type='{$type}'";
		$input .= " class='{$class}'";
		$input .= " id='{$id}'";
		$input .= " name='{$id}'";
		$input .= " value='{$value}'";
		if ( !is_null( $placeholder ) ) $input .= " placeholder='{$placeholder}'";
		if ( $disabled ) $input .= ' disabled="disabled"';
		if ( !is_null( $maxlength ) ) $input .= " maxlength='{$maxlength}'";
		if ( !is_null( $size ) ) $input .= " size='{$size}'";
		$input .= $checked;
		$input .= ">";
		return $label . $input;
	} // input()


	/**
	* Text Field - Input Alias
	*/
	public function text( $attrs = array() )
	{
		$default_attrs = array(
			'type'					=>	'text',
			'id'						=>	'',
			'placeholder'		=>	'',
			'value'					=>	'',
			'class'					=>	'wpmfu-input wpmfu-text',
			'label_text'		=>	''
		);
		return $this->input( shortcode_atts( $default_attrs, $attrs ) );
	} // text()


	/**
	* Label
	*/
	public function label( $attrs = array() )
	{
		$default_attrs = array(
			'label_text'		=>	'',
			'label_class'		=>	'wpmfu-label',
			'id'						=>	''
		);
		extract( shortcode_atts($default_attrs, $attrs ) );
		$label = '';
		$label .= "<label for='{$id}' class='{$label_class}'>{$label_text}</label>";

		return $label;
	} // label()


} // end class WPMFU_Form_Builder()