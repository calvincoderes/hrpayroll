<?php

class Asset {

	// Benstore Assets
	public static function cdn($asset) {

	    //Check if we added cdn's to the config file
	    if( !Config::get('app.cdn') )
	        return asset( $asset );

	    //Get file name & cdn's
	    $cdns = Config::get('app.cdn');
	    $assetName = basename( $asset );
	    //remove any query string for matching
	    $assetName = explode("?", $assetName);
	    $assetName = $assetName[0];

	    //Find the correct cdn to use
	    foreach( $cdns as $cdn => $types ) {
	        if( preg_match('/^.*\.(' . $types . ')$/i', $assetName) )
	            return self::cdnPath($cdn, $asset);
	    }

	    //If we couldnt match a cdn, use the last in the list.
	    end($cdns);
	    return self::cdnPath( key( $cdns ) , $asset);

	}

	public static function cdnPath($cdn, $asset) {
	    return  "//" . rtrim($cdn, "/") . "/" . ltrim( $asset, "/");
	}
	
	// Microservices
	public static function microservices( $route ) {
	
		return trim( \Config::get('app.microservice.' . $route ). '/html/v1' );
	}

	// Backend Assets
	public static function bea( $asset ) {

	    //Check if we added cdn's to the config file
	    if( !Config::get('app.bea') )
	        return asset( $asset );

	    //Get file name & cdn's
	    $cdns = Config::get('app.bea');
	    $assetName = basename( $asset );
	    //remove any query string for matching
	    $assetName = explode("?", $assetName);
	    $assetName = $assetName[0];

	    //Find the correct cdn to use
	    foreach( $cdns as $cdn => $types ) {
	        if( preg_match('/^.*\.(' . $types . ')$/i', $assetName) )
	            return self::beaPath($cdn, $asset);
	    }

	    //If we couldnt match a cdn, use the last in the list.
	    end($cdns);
	    return self::beaPath( key( $cdns ) , $asset);
	}

	public static function beaPath($cdn, $asset) {
	    return  "//" . rtrim($cdn, "/") . "/" . ltrim( $asset, "/");
	}

	/*
	* Generate Progress Report of Queued results
	* @author Aimon 2015-03-11
	* @param $filename
	* @return N/A
	*/
	public static function load( $filename ) {
		
		$offset = (int)( Session::has( $filename ) ? Session::get( $filename ) : 0 );

		Session::set( $filename, Session::get( $filename, 0) + Constant::FILE_LIMIT );

		$rows	= $offset + Constant::FILE_LIMIT;
		
		return ['offset' => $offset, 'rows'	=> $rows ];
	}

	/*
	* Process all the queued results
	* @author Aimon 2015-03-11
	* @param $filename, $headers, $offset
	* @return Mixed
	*/
	public static function render( $filename, $headers, $offset ) {

		$fp = fopen(Config::get('app.temp') . $filename . '.xls', 'w+');

		$content = '<table border="1"><thead><tr>';

		// Load Headers
		foreach($headers as $header)
			$content .= '<th>' . $header.  '</th>';

		$content .= '</tr></thead>';

		for($i = 0; $i <= $offset; $i+= Constant::FILE_LIMIT)
			if( file_exists( Config::get('app.temp') . $filename . '-' . $i ) )
				$content .= file_get_contents( Config::get('app.temp') . $filename . '-' . $i, 'r' );

		$content .= '</table>';
		fwrite( $fp, $content );
		fclose( $fp );

		
		for($i = 0; $i <= $offset; $i+= Constant::FILE_LIMIT)
			if( file_exists(Config::get('app.temp') . $filename . '-' . $i) )
				unlink(Config::get('app.temp') . $filename . '-' . $i);
		
		Session::forget( $filename );

		return ['success' => 1, 'file' => $filename . '.xls' ,'link' => URL::to('assets/tmp/' . $filename . '.xls' ) ]; 
	}

	/*
	* Add Result to a queued list
	* @author Aimon 2015-03-11
	* @param $view, $param, $filename, $offset
	* @return int
	*/
	public static function queue( $view, $filename, $load ) {

		// Put File on new Location
		$fp = fopen(Config::get('app.temp') . $filename . '-' . $load['offset'], 'w+');

		fwrite($fp, trim($view) );
		fclose($fp);

		return $load['rows'];
	}
	
	/*
	 * Refining file image location.
	 * @author Geoff 2015-07-13
	 * @param $string
	 * @return $string
	 */
	public static function refineImage( $str ){
		$invlid = [ '/img//img/', '/img//' ];
		$strnew = '';
		if( file_exists( $str ) ){
			return $str;
		} else if( $str[0]  == '/') { 
			return $str;
		} else {
			$strnew = $str;
			foreach($invlid AS $inv_str){
				if (strpos($strnew,$inv_str) !== false) {
					$strnew = str_replace($inv_str, '/img/', $strnew);
				}
			}
			return $strnew;
			//return str_replace('/img/img/', '/img/', $str);
		}
	}
}