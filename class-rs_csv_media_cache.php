<?php


/**
 * Class RS_CSV_Media_Cache
 *
 * Media Cache Manager. Singleton.
 *
 */

Class RS_CSV_Media_Cache {

	/** @var null|RS_CSV_Media_Cache  */
	private static $instance = null;

	/** @var  array media caches. */
	private $media_keys;

	private function __construct() {}

	/**
	 * @return RS_CSV_Media_Cache
	 */
	public static function get_instance() {

		if( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * @param string $key
	 *
	 * @return bool
	 */
	public function is_cached( $key ) {
		return isset( $this->media_keys[ md5( $key ) ] );
	}

	/**
	 * @param string $key
	 *
	 * @return int
	 */
	public function get( $key ){
		return $this->media_keys[ md5( $key ) ];
	}

	/**
	 * @param string $key
	 * @param int $id
	 */
	public function set( $key, $id ) {
		$this->media_keys[ md5( $key ) ] = $id;
	}

}