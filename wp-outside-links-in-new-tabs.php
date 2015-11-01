<?php
/**
 * Plugin Name: WP Outside Links In New Tabs
 * Description: Opens external links found in the content of posts and pages into new tabs
 * Version: 1.0.0
 * Author: BinaryStash
 * Author URI:  http://www.binarystash.net
 * License: GPLv2 (http://www.gnu.org/licenses/gpl-2.0.html)
 */
 
/*
 * Define constants
 */
if(!defined('WP_OUTSIDE_LINKS_IN_NEW_TABS_URL')){
	define('WP_OUTSIDE_LINKS_IN_NEW_TABS_URL', plugin_dir_url(__FILE__) );
}

if(!defined('WP_OUTSIDE_LINKS_IN_NEW_TABS_DIR')){
	define('WP_OUTSIDE_LINKS_IN_NEW_TABS_DIR', realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR );
}

/*
 * Include classes
 */
 
$wp_outside_links_in_new_tabs_classes = array(
	'wp-outside-links-in-new-tabs-controller.php',
	'wp-outside-links-in-new-tabs-parser.php'
); 
 
foreach( $wp_outside_links_in_new_tabs_classes as $class ) {
	
	include WP_OUTSIDE_LINKS_IN_NEW_TABS_DIR . 'classes' . DIRECTORY_SEPARATOR . $class;
	
}

/*
 * Include third-party components
 */

$wp_outside_links_in_new_tabs_third_party_components = array(
	'htmlawed' . DIRECTORY_SEPARATOR . 'loader.php'
); 
 
foreach( $wp_outside_links_in_new_tabs_third_party_components as $component ) {
	
	include WP_OUTSIDE_LINKS_IN_NEW_TABS_DIR . 'third-party' . DIRECTORY_SEPARATOR . $component;
	
}
 
/**
 * Initialize plugin
 */
function wp_outside_links_in_new_tabs_instantiate() {
	new WP_Outside_Links_In_New_Tabs_Controller();
}

if ( get_bloginfo("version") >= 3.9 ) {
	//Initialize plugin only if Wordpress version >= 3.9
	add_action( 'plugins_loaded', 'wp_outside_links_in_new_tabs_instantiate', 15 );
}


