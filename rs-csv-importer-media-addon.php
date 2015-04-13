<?php
/*
Plugin Name: RS CSV Importer Media Add-On.
Version: 0.1-alpha
Description: Really Simple CSV Importer Add-on. Media's URL (Images, Documents... etc) in CSV, Download Media and Convert url to attachment ID.
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

	require_once dirname( __FILE__ ) . "/class-rs_csv_importer_media.php";
	require_once dirname( __FILE__ ) . "/class-rs_csv_media_cache.php";

	return 'RS_CSV_Importer_Media';

}

add_filter('really_simple_csv_importer_media_ext2type', 'really_simple_csv_importer_media_ext2type');

function really_simple_csv_importer_media_ext2type( $types ) {
	return array(
		'image'       => array( 'gif',  'png',  'bmp',   'tif',  'tiff', 'ico' ),
	);
}
