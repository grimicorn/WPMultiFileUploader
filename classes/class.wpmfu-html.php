<?php
/**
* WPMFU HTML
*/
class WPMFU_HTML extends WPMFU_Plugin
{
	/**
	* Constructor
	*/
	public function __construct( $config = array() )
	{
		parent::__construct();
	} // __construct()


	/**
	* Makes a list item
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