<?php

class Backtrack {

	public static function debug($data, $exit = false){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		
		if( $exit == true ) {
			exit;
		}
	}

	public static function lastQuery( $return_only = false ) {
		$queries = \DB::getQueryLog();
		$last_query = end($queries);
		if( !$return_only )
			self::debug( vsprintf( str_replace( '?', '\'%s\'', $last_query['query'] ), $last_query['bindings'] ) );
		
		return vsprintf( str_replace( '?', '\'%s\'', $last_query['query'] ), $last_query['bindings'] );
	}

	public static function arrayStripTags($array) {
		$result = array();
		foreach ($array as $key => $value) {
			$key = strip_tags($key);
			if (is_array($value))
				$result[$key] = Backtrack::arrayStripTags($value);
			else
				$result[$key] = strip_tags($value);
		}
		return $result;
	}
	
	public static function getRouteName(){
		return explode(".", Route::currentRouteName())[0];
	}
	
	public static function urlExists($url){
        $url = str_replace("http://", "", $url);
        
        if ( strstr($url, "/") ) {
            $url = explode("/", $url, 2);
            $url[1] = "/".$url[1];
        } else {
            $url = array($url, "/");
        }

        $fh = fsockopen( $url[0], 80 );
        if ( $fh ) {
            fputs($fh,"GET ".$url[1]." HTTP/1.1\nHost:".$url[0]."\n\n");
            if (fread($fh, 22) == "HTTP/1.1 404 Not Found") { 
            	return false; 
            } else { 
            	return true;
            }
        } else { 
        	return false;
        }
    }
    
	public static function validUrlHeader($url){
		$file_headers = get_headers($url);
		
		if ($file_headers[0] == 'HTTP/1.0 404 Not Found') {
			return false;
		} else {
			return true;
		}
	}
	
}