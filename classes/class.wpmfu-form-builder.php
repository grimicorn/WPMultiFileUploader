<?php
/**
 *	@package WPMFU_Form_Builder
 *	@version 1.1.0
 *	@since 1.1.0
 *	@author Dan Holloran
 *	@copyright GPLv2 (or later)
 */
class WPMFU_Form_Builder extends WPMFU_HTML
{

	/**
	* Constructor
	*
	*	@since 1.1.0
	*/
	function __construct( $config = array() )
	{
		parent::__construct();
	} // __constuct


	/**
	* Opens the form
	*
	*	@since 1.1.0
	*/
	public function form_open( $form_id = 1, $action = '?')
	{
		return '<form action="'.$action.'" method="post" id="wpmfu_form_'.$form_id.'" class="wpmfu-form" accept-charset="utf-8">';
	} // form_open()


	/**
	* Closes the form
	*
	*	@since 1.1.0
	*/
	public function form_close()
	{
		return '</form>';
	} // form_close()

	/**
	* Multi Uploader
	*
	*	@since 1.1.0
	*/
	public function multi_uploader( $wrap_li = true )
	{
		$html = '';
		$form = $this->build_form();
		if ( $wrap_li ) {
			$html .= $this->li( $form );
		} //if()

		return $html;
	} // multi_uploader()


	/**
	* Submit Button
	*
	*	@since 1.1.0
	*/
	public function submit( $attrs = array() )
	{
		$default_attrs = $this->default_attrs();
		$default_attrs['type'] =	'submit';
		$default_attrs['id'] =	'wpmfu_submit';
		$default_attrs['value'] =	'Submit';
		$default_attrs['class'] =	'wpmfu-input wpmfu-submit';
		$default_attrs['output_label']	=	false;
		return $this->input( shortcode_atts( $default_attrs, $attrs ) );
	} // submit()


	/**
	* Hidden Input
	*
	*	@since 1.1.0
	*/
	public function hidden( $attrs = array() )
	{
		$default_attrs = $default_attrs = $this->default_attrs();
		$default_attrs['type'] =	'hidden';
		$default_attrs['class'] = 'wpmfu-input wpmfu-hidden pull-left';
		$default_attrs['output_label'] = false;
		return $this->input( shortcode_atts( $default_attrs, $attrs ) );
	} // checkbox()


	/**
	* Radio Input
	*
	*	@since 1.1.0
	*/
	public function radio( $attrs = array() )
	{
		$default_attrs = $default_attrs = $this->default_attrs();
		$default_attrs['type'] = 'radio';
		$default_attrs['class'] = 'wpmfu-input wpmfu-checkbox pull-left';
		return $this->input( shortcode_atts( $default_attrs, $attrs ) );
	} // checkbox()


	/**
	* Checkbox Input
	*
	*	@since 1.1.0
	*/
	public function checkbox( $attrs = array() )
	{
		$default_attrs = $default_attrs = $this->default_attrs();
		$default_attrs['type']	= 'checkbox';
		$default_attrs['class']	= 'wpmfu-input wpmfu-checkbox';
		return $this->input( shortcode_atts( $default_attrs, $attrs ) );
	} // checkbox()


	/**
	* Text Field Input
	*
	*	@since 1.1.0
	*/
	public function text( $attrs = array() )
	{
		$default_attrs = $default_attrs = $this->default_attrs();
		$default_attrs['type'] = 'text';
		$default_attrs['class'] = 'wpmfu-input wpmfu-text';
		return $this->input( shortcode_atts( $default_attrs, $attrs ) );
	} // text()


	/**
	* Generic Input field
	*
	*	@since 1.1.0
	*/
	public function input( $attrs = array() )
	{
		extract( shortcode_atts( $this->default_attrs(), $attrs ) );

		// Get the Label
		$label = '';
		if ( $output_label ) {
			$label = $this->label(array(
				'id'					=>	$id,
				'label_text'	=>	$label_text,
				'label_class'	=>	$label_class,
				'label_after'	=>	$label_after
			));
		} // if($label)

		// For checkbox and radio buttons
		if ( $type == 'checkbox' OR $type == 'radio' ) {
			$checked = ( $checked )  ? " checked='{$checked}' " : '';
		} else {
			$checked = '';
		}

		// Build the input field
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

		// Put Together the label and input
		$html = '';
		$nl = "\n";
		if ( $label_after ) {
			$html .= $input . $nl;
			$html .= $label . $nl;
		} else {
			$html .= $label . $nl ;
			$html .= $input . $nl;
		} // if/else()

		if ( $wrap_li ) {
			$html = $this->li( $html );
		} // if()

		return $html;

	} // input()


	/**
	* Label
	*
	*	@since 1.1.0
	*/
	public function label( $attrs = array() )
	{
		$default_attrs = array(
			'label_text'		=>	'',
			'label_class'		=>	'wpmfu-label',
			'id'						=>	'',
			'label_after'		=>	false
		);
		extract( shortcode_atts($default_attrs, $attrs ) );

		// Needed if the label is after the form
		if ( $label_after )
			$label_class .= ' wpmfu-label-after';

		// Build Label
		$label = '';
		$label .= "<label for='{$id}' class='{$label_class}'>{$label_text}</label>";

		return $label;
	} // label()


	/**
	* Default Attributes
	*
	*	@since 1.1.0
	*/
	protected function default_attrs()
	{
		return array(
			'type'					=>	'text',
			'id'						=>	'',
			'placeholder'		=>	null,
			'value'					=>	'',
			'disabled'			=>	false,
			'size'					=> 	null,
			'class'					=>	'wpmfu-input pull-left',
			'maxlength'			=>	null,
			'checked'				=>	false,
			'label_text'		=>	'',
			'label_class'		=>	'wpmfu-label pull-left',
			'output_label'	=>	true,
			'label_after'		=>	false,
			'wrap_li'				=>	true
		);
	} // default_attrs()


	/**
	* HTML
	*
	*	@since 1.1.0
	*/
	public function html( $html, $wrap_li = true ){
		if ( $wrap_li ) {
			$html .= $this->li( $html );
		} // if()
		return $html;
	}

} // end class WPMFU_Form_Builder()

$wpmfu_form_builder = new WPMFU_Form_Builder();