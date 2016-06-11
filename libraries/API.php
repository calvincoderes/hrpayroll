<?php

class API {
	
	public static function get( $url, $data = [], $headers = [])
	{
		if ( !parse_url( $url , PHP_URL_QUERY ) )
			$url = $url . ( $data ? '?' . http_build_query( $data ) : '' );
		else
			$url = $url . ( $data ? '&' . http_build_query( $data ) : '' );
		
		$curl = curl_init( $url);
		
		if( $headers )
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		
		curl_setopt( $curl , CURLOPT_RETURNTRANSFER, true );
				
		$response = curl_exec( $curl );

		if ( $response === false ) 
		{
			$info = curl_getinfo( $curl );
			curl_close( $curl );

			return [ 'response' => $info ];
		}

		curl_close( $curl );

		return $response;
	}
	
	public static function post( $url, $data = [], $headers = [])
	{
		if ( !parse_url( $url , PHP_URL_QUERY ) )
			$url = $url . ( $data ? '?' . http_build_query($data)  : '');
		else
			$url = $url . ( $data ? '&' . http_build_query($data) : '' );
		
		$curl = curl_init($url);
		
		if( $headers )
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
						
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$response = curl_exec($curl);
		if ( $response === false ) 
		{
			$info = curl_getinfo($curl);
			curl_close( $curl );
			return [ 'response' => $info ];
		}
		curl_close($curl);
		
		return $response;	
	}
	
	public static function put( $url, $data = [], $headers = [])
	{
		if ( !parse_url( $url , PHP_URL_QUERY ) )
			$url = $url . ( $data ? '?' . http_build_query($data)  : '');
		else
			$url = $url . ( $data ? '&' . http_build_query($data) : '' );
		
		$ch = curl_init($url);

		if( $headers )
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$response = curl_exec($ch);
		if ($response === false) 
		{
			$info = curl_getinfo($ch);
			curl_close($ch);
			return [ 'response' => $info ];
		}
		
		curl_close($ch);
		
		return $response;	
	}
	
	public static function delete( $url, $data = [], $headers = [] )
	{
		if ( !parse_url( $url , PHP_URL_QUERY ) )
			$url = $url . ( $data ? '?' . http_build_query($data)  : '');
		else
			$url = $url . ( $data ? '&' . http_build_query($data) : '' );
		
		$ch = curl_init($url);
		
		if( $headers )
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$response = curl_exec($ch);
		if ($response === false)
		{
			$info = curl_getinfo($curl);
			curl_close($curl);
			return [ 'response' => $info ];
		}
		curl_close($curl);
		
		return $response;	
	}
}