<?php

class String {

	public static function clean( $string ) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	   return preg_replace('/[^A-Za-z0-9\-\_]/', '', $string); // Removes special chars.
	}

	public static function getURLQueries( $url ) {
		/*$url_segment = explode( '?', $url );

		if( !empty($url_segment[1]) ) {
			parse_str($url_segment[1], $parsed_str);

			$parsed_str = array_unique( $parsed_str );

			return '?' . http_build_query( $parsed_str );
		}*/

		$parts = parse_url($url);
		$query_string = !empty($parts['query']) ? $parts['query'] : '';
		parse_str( $query_string, $query );

		if( isset($query['session_id']) )
			unset($query['session_id']);
		return $query ? '?' . http_build_query($query) : null;
	}
}
