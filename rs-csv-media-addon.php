<?php
/*
Plugin Name: Rs-csv-media-addon
Version: 0.1-alpha
Description: PLUGIN DESCRIPTION HERE
Author: YOUR NAME HERE
Author URI: YOUR SITE HERE
Plugin URI: PLUGIN SITE HERE
Text Domain: rs-csv-media-addon
Domain Path: /languages
*/


add_filter( 'really_simple_csv_importer_class', 'really_simple_csv_importer_class');

function really_simple_csv_importer_class() {

	if( class_exists('RS_CSV_Importer') and !class_exists('RS_CSV_Media') ) {
		require_once dirname(__FILE__)."/class-rs_csv_media.php";
		return 'RS_CSV_Media';
	}

}


