<?php

/**
 *
 * Class RS_CSV_Importer_Media_Plus
 *
 * @uses RS_CSV_Importer
 *
 */
Class RS_CSV_Importer_Media_Plus extends RS_CSV_Importer {


	/** @var  RS_CSV_Media_Cache */
	private $cache;


	public function __construct() {
		parent::__construct();
		add_filter( 'ext2type', array( $this, 'ext2type' ) );

		$this->cache = RS_CSV_Media_Cache::get_instance();

	}

	/**
	 * Insert post and postmeta using `RSCSV_Import_Post_Helper` class.
	 *
	 * @param array $post
	 * @param array $meta
	 * @param array $terms
	 * @param string $thumbnail The uri or path of thumbnail image.
	 * @param bool $is_update
	 *
	 * @return RSCSV_Import_Post_Helper
	 */
	public function save_post( $post, $meta, $terms, $thumbnail, $is_update ) {

		$h = parent::save_post( $post, $meta, $terms, $thumbnail, $is_update );

		$meta = $this->migrate_meta_to_media( $h, $meta );
		$h->setMeta( $meta );

		return $h;
	}

	/**
	 *
	 * Allowed File Types.
	 *
	 * @use ext2type
	 * @param array $types
	 *
	 * ```
	 * array(
	 *    'image'       => array( 'jpg', 'jpeg', 'jpe',  'gif',  'png',  'bmp',   'tif',  'tiff', 'ico' ),
	 *    'audio'       => array( 'aac', 'ac3',  'aif',  'aiff', 'm3a',  'm4a',   'm4b',  'mka',  'mp1',  'mp2',  'mp3', 'ogg', 'oga', 'ram', 'wav', 'wma' ),
	 *    'video'       => array( '3g2',  '3gp', '3gpp', 'asf', 'avi',  'divx', 'dv',   'flv',  'm4v',   'mkv',  'mov',  'mp4',  'mpeg', 'mpg', 'mpv', 'ogm', 'ogv', 'qt',  'rm', 'vob', 'wmv' ),
	 *    'document'    => array( 'doc', 'docx', 'docm', 'dotm', 'odt',  'pages', 'pdf',  'xps',  'oxps', 'rtf',  'wp', 'wpd', 'psd' ),
	 *    'spreadsheet' => array( 'numbers',     'ods',  'xls',  'xlsx', 'xlsm',  'xlsb' ),
	 *    'interactive' => array( 'swf', 'key',  'ppt',  'pptx', 'pptm', 'pps',   'ppsx', 'ppsm', 'sldx', 'sldm', 'odp' ),
	 *    'text'        => array( 'asc', 'csv',  'tsv',  'txt' ),
	 *    'archive'     => array( 'bz2', 'cab',  'dmg',  'gz',   'rar',  'sea',   'sit',  'sqx',  'tar',  'tgz',  'zip', '7z' ),
	 *    'code'        => array( 'css', 'htm',  'html', 'php',  'js' ),
	 * );
	 * ```
	 *
	 * @return Array
	 */
	public function ext2type( Array $types ) {
		return apply_filters( 'really_simple_csv_importer_media_ext2type', $types );
	}

	/**
	 * @param RSCSV_Import_Post_Helper $h
	 * @param $meta
	 *
	 * @return mixed
	 */
	public function migrate_meta_to_media( RSCSV_Import_Post_Helper $h, $meta ) {

		foreach ( $meta as $key => $value ) {

			//同一のモノがあった場合は、キャッシュから取ってくる。
			if ( $this->cache->is_cached( $value ) ) {
				$meta[ $key ] = $this->cache->get( $value );
			}
			else if ( $this->is_media( $value ) ) {
				$file         = $h->remoteGet( $value );
				$attachment   = $h->setAttachment( $file );
				$meta[ $key ] = $attachment;
				$this->cache->set( $value, $attachment );
			}
		}
		return $meta;
	}


	/**
	 * @param string $value
	 *
	 * @return bool
	 */
	public function is_media( $value ) {
		if ( is_string( $value ) && parse_url( $value, PHP_URL_SCHEME ) ) {
			$path_arr = explode( ".", $value );
			$ext      = array_pop( $path_arr );
			if ( wp_ext2type( $ext ) ) {
				return true;
			}
		}
		return false;
	}

}
