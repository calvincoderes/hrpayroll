<?php
//ROUTES
Route::group(['middleware' => ['web','auth'] ], function () {
       # Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@getIndex']);


Route::any('/drafts', function() {
	if( \Request::ajax() ) {
		$request = \Request::all();

		if( !empty($request['session_id']) ) {
			$url = explode('?', $request['url']);

			$module = '';
			$query = '';

			if( count($url) >= 1 ) {
				$module = $url[0];
				$query = !empty($url[1]) ? $url[1] : '';

				parse_str($query, $query);

				if(isset($query['session_id']))
					unset($query['session_id']);


					$data = [
							'session_id' => $request['session_id'],
							'module' => $module,
							'query' => http_build_query($query),
							'values' => json_encode($request)
					];

					\App\Models\Draft::where('session_id', '=', $request['session_id'] )->delete();
					\App\Models\Draft::insert($data);
			}
		}
	}
});

	Route::any('/drafts-extract', function() {
		$draft = \App\Models\Draft::where('session_id', '=', \Request::get('session_id') )->first();
		$values = json_decode($draft->values, TRUE);

		return $values;
	});

	\Crud::resource( 'products' );
	\Crud::resource( 'categories' );
	\Crud::resource( 'groups' );
	\Crud::resource( 'vendors' );
	\Crud::resource( 'sizes' );
	\Crud::resource( 'holidays' );
	\Crud::resource( 'featured_category' );
	\Crud::resource( 'orders' );
	\Crud::resource( 'draft' );
	\Crud::resource( 'attractions' );

});


Route::get('/', function () {
    return redirect('login');
});


Route::group(['middleware' =>[ 'web']], function () {
		Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
		Route::post('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
	});
	
	
Route::group( [ 'middleware' => ['web'] ], function () {
		Route::auth();

		//dd(Auth::user() );
	
		Route::get('/home', 'HomeController@index');
});

