<?php

class WP_Outside_Links_In_New_Tabs_ParserTest extends WP_UnitTestCase {
	
	protected $_class_instance;
	
	function setUp() {
		
		$this->_class_instance = new WP_Outside_Links_In_New_Tabs_Parser();
		
	}
	
	function test_parse() {
		
		$input = '<a href="http://www.binarystash.net">BinaryStash</a>';
		$expected_output = '<a href="http://www.binarystash.net" target="_blank">BinaryStash</a>';
		
		$output = $this->_class_instance->parse($input);
		
		$this->assertEquals($expected_output,$output);
		
	}
	
}

