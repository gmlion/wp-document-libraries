<?php
/*
Plugin Name: Document Libraries
Plugin URI: http://www.e-verbavolant.it
Description: Libraries of documents that can be easily embedded into posts
Version: 0.1
Author: Gianmarco Leone
Author URI: http://www.e-verbavolant.it
License: GPLv2 or later
*/

/*

*/

// don't load directly
if (!defined('ABSPATH')) die('-1');

require('DocumentLibraries.php');

$_GLOBALS['document_libraries'] = new DocumentLibraries();

function document_libraries_load_plugin_textdomain() {
  load_plugin_textdomain( 'document_libraries', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
 
add_action( 'plugins_loaded', 'document_libraries_load_plugin_textdomain' );
?>