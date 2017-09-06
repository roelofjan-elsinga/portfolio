<?php

/* Logged in */
Route::group(['middleware' => ['auth']], function() {
    Route::get('logout', ['as' => 'auth.getLogout', 'uses' => 'Auth\AuthController@getLogout']);
    Route::get('dash', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    Route::get('work/{id}/destroy', ['as' => 'work.destroy', 'uses' => 'WorkController@destroy']);
    Route::get('service/{id}/destroy', ['as' => 'service.destroy', 'uses' => 'ServiceController@destroy']);

    Route::resource('page', 'PageController');
    Route::resource('dashboard', 'DashboardController');
    Route::resource('work', 'WorkController', ['except' => 'destroy']);
    Route::resource('service', 'ServiceController', ['except' => 'destroy']);
});

/*Authentication*/
Route::get('/', ['as' => 'home', 'uses' => 'PublicController@index']);
Route::post('/contact', ['as' => 'contact', 'uses' => 'PublicController@contact']);


Route::get('/portfolio', ['as' => 'public.work', 'uses' => 'PublicController@work']);
Route::get('/portfolio/{slug}', ['as' => 'public.workDetail', 'uses' => 'PublicController@workDetail']);

Route::get('admin', ['as' => 'auth.getLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'auth.postLogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('register/{one?}/{two?}/{three?}/{four?}/{five?}', ['as' => 'auth.getRegister', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register/{one?}/{two?}/{three?}/{four?}/{five?}', ['as' => 'auth.postRegister', 'uses' => 'Auth\AuthController@postRegister']);

/*Resources*/
Route::resource('public', 'PublicController');

//Controllers    
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
