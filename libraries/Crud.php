<?php

class Crud {
		
	public static function resource( $route ) {

		$class = studly_case($route);
		
		# Render the resource
		if( strlen($route) > 32)
			self::customResource( $route, $class . 'Controller' ) ;
		else
			Route::resource( $route, $class . 'Controller' );	
	}

	public static function customResource( $route, $controller ) {
		Route::get(  $route, [  'alias' => $route . '.index', 'uses' => $controller . '@index'  ] );
		Route::get(  $route . '/create',  [  'alias' => $route . 'create', 'uses' => $controller . '@create'  ] ) ;
		Route::post(  $route . '',  [  'alias' => $route . '.store', 'uses' => $controller . '@store'  ] );
		Route::get(  $route . '/{id}', [  'alias' => $route . '.show', 'uses' => $controller . '@show'  ] );
		Route::get(  $route . '/{id}/edit',  [  'alias' => $route . '.edit', 'uses' => $controller . '@edit'  ]  );
		Route::put(  $route . '/{id}',  [  'alias' => $route . '.update', 'uses' => $controller . '@update'  ] );
		Route::get(  $route . '/{id}', [  'alias' => $route . '.destroy', 'uses' => $controller . '@destroy'  ] );
	}	
}