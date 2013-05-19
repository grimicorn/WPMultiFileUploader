<?php
/**
 *	@package WPMFU_HTML
 *	@version 1.1.0
 * 	@since 1.1.0
 *	@author Dan Holloran
 *	@copyright GPLv2 (or later)
 */
class WPMFU_HTML extends WPMFU_Plugin
{
	/**
	* Constructor
	*
	*	@since 1.1.0
	*/
	public function __construct( $config = array() )
	{
		parent::__construct();
	} // __construct()


	/**
	* Makes a list item
	*
	*	@since 1.1.0
	*/
	public function li( $content )
	{
		$html = '';
		$nl = "\n";
		$html .= '<li class="clearfix">' . $nl;
		$html .= $content . $nl;
		$html .= '</li>' . $nl;

		return $html;
	}

} // class WPMFU_HTML()

$wpmfu_html = new WPMFU_HTML();