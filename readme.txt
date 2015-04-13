=== RS CSV Importer Media Add-On ===
Contributors:       Toro_Unit
Donate link:        http://www.amazon.co.jp/registry/wishlist/COKSXS25MVQV
Tags:               importer, csv, rscsv,
Requires at least:  4.1
Tested up to:       4.2
Stable tag:         1.0.0
License:            GPLv2 or later
License URI:        http://www.gnu.org/licenses/gpl-2.0.html

Really Simple CSV Importer Add-on. Media's URL (Images, Documents... etc) in CSV, Download Media and Convert url to attachment ID.

== Description ==

[Really Simple CSV Importer](https://wordpress.org/plugins/really-simple-csv-importer/) Add-on.

Media's URL (Images, Documents... etc) in CSV, Download Media and Convert url to attachment ID.


== Installation ==

1. Install and Activate [Really Simple CSV Importer](https://wordpress.org/plugins/really-simple-csv-importer/).
2. Upload the entire `/rs-csv-importer-media-addon` directory to the `/wp-content/plugins/` directory.
3. RS CSV Importer Media Add-On through the 'Plugins' menu in WordPress.


== Frequently Asked Questions ==

= Is it possible to change the file type that allows the upload? =

Use `really_simple_csv_importer_media_ext2type` for change file extension to allowed.

`
add_filter('really_simple_csv_importer_media_ext2type', 'really_simple_csv_importer_media_ext2type');

function really_simple_csv_importer_media_ext2type( $types ) {
    return array(
        'image'       => array( 'jpg', 'jpeg', 'jpe', 'gif', 'png' ),
        'audio'       => array( 'mp3', 'ogg', 'wav', 'wma' ),
        'video'       => array( 'mov', 'mp4', 'mpeg', 'mpg', 'ogm', 'ogv', 'wmv' ),
        'document'    => array( 'doc', 'docx', 'odt', 'pages', 'pdf', 'psd' ),
        'spreadsheet' => array( 'ods', 'xls', 'xlsx' ),
        'interactive' => array( 'swf', 'key', 'ppt', 'pptx', 'odp' ),
        'text'        => array( 'asc', 'csv', 'tsv', 'txt' ),
        'archive'     => array( 'dmg', 'gz', 'rar', 'tar', 'tgz', 'zip'),
        'code'        => array( 'css', 'htm', 'html', 'php', 'js' ),
    );
}
`

== Changelog ==

= 1.0.0 =
* First Release.