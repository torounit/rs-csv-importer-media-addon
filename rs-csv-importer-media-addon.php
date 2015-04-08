<?php
/*
Plugin Name: RS CSV Importer Media Add-On.
Version: 0.1-alpha
Description: Really Simple CSV Importer Add-on. Media's URL (Images, Documents... etc) in CSV, Download Media and Convert value url to attachment ID.
Author: Toro_Unit
Author URI: http://www.torounit.com
Plugin URI: PLUGIN SITE HERE
Text Domain: rs-csv-importer-media-addon
Domain Path: /languages
*/


add_filter( 'really_simple_csv_importer_class', 'really_simple_csv_importer_class' );

function really_simple_csv_importer_class( $class ) {

	if ( ! class_exists( 'RS_CSV_Importer' ) ) {
		return $class;
	}

	if ( ! class_exists( 'RS_CSV_Importer_Media' ) ) {
		require_once dirname( __FILE__ ) . "/class-rs_csv_importer_media.php";
	}

	return 'RS_CSV_Importer_Media';

}


