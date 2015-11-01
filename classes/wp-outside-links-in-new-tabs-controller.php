<?php

class WP_Outside_Links_In_New_Tabs_Controller {
	
	function __construct() {
		
		add_filter( 'the_content', array($this,'parse_content') );
		
	}
	
	function parse_content($content) {
		
		$parser = new WP_Outside_Links_In_New_Tabs_Parser();
		return $parser->parse($content);
		
	}
	
}