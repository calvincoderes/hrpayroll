<?php

//ROUTES
// Route::group(['middleware' => ['web','auth'] ], function () {
       # Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@getIndex']);

			 

			 
Route::any('/generate-default-password', function() {
	$password = bcrypt('root');
	return $password;
});



	
Route::get('/', function () {
    return redirect('login');
});
// Route::group(['middleware' =>[ 'web']], function () {
		Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
		Route::post('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
	// });
	
	
Route::group( [ 'middleware' => ['web'] ], function () {
	Route::auth();
});

Route::group( [ 'middleware' => ['web', 'auth'] ], function () {
	Route::get('/home', 'HomeController@index');
	\Crud::resource( 'company-management' );
	\Crud::resource( 'employee-management' );
	\Crud::resource( 'shift-management' );
	\Crud::resource( 'holiday-management' );
	\Crud::resource( 'timekeeping' );
	\Crud::resource( 'reports' );
		
});

