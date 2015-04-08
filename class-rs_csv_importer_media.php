<?php


Class RS_CSV_Importer_Media extends RS_CSV_Importer {

	/** @var  array media caches. */
	private $media_keys;


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
	 * @param RSCSV_Import_Post_Helper $h
	 * @param $meta
	 *
	 * @return mixed
	 */
	public function migrate_meta_to_media( RSCSV_Import_Post_Helper $h, $meta ) {

		foreach ( $meta as $key => $value ) {

			if ( isset( $this->media_keys[ md5( $value ) ] ) ) {
				$meta[ $key ] = $this->media_keys[ md5( $value ) ];
			} else if ( $this->is_media( $value ) ) {
				$file                              = $h->remoteGet( $value );
				$meta[ $key ]                      = $h->setAttachment( $file );
				$this->media_keys[ md5( $value ) ] = $meta[ $key ];
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