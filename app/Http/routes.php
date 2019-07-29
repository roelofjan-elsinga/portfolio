<?php

Route::get('/', ['as' => 'home', 'uses' => 'PublicController@index']);
Route::get('articles', ['as' => 'articles', 'uses' => 'PublicController@articles']);
Route::get('articles/{slug}', ['as' => 'articles.view', 'uses' => 'PublicController@viewArticle']);
Route::get('passions', ['as' => 'passions.index', 'uses' => 'PublicController@passions']);
Route::get('passions/{slug}', ['as' => 'passions.view', 'uses' => 'PublicController@viewPassion']);
Route::get('feed', ['as' => 'feed', 'uses' => 'PublicController@atomFeed']);
Route::post('/contact', ['as' => 'contact', 'uses' => 'PublicController@contact']);


Route::get('/portfolio', ['as' => 'public.work', 'uses' => 'PublicController@work']);
Route::get('/portfolio/{slug}', ['as' => 'public.workDetail', 'uses' => 'PublicController@workDetail']);

Route::group(['middleware' => 'guest', 'namespace' => 'Auth'], function () {
    Route::get('login', ['as' => 'auth.getLogin', 'uses' => 'LoginController@getLogin']);
    Route::post('login', ['as' => 'auth.login', 'uses' => 'LoginController@login']);
});

/*Resources*/
Route::resource('public', 'PublicController');
