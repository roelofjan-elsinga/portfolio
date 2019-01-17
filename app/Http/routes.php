<?php

Route::get('/', ['as' => 'home', 'uses' => 'PublicController@index']);
Route::get('articles', ['as' => 'articles.index', 'uses' => 'PublicController@articles']);
Route::get('articles/{slug}', ['as' => 'articles.view', 'uses' => 'PublicController@viewArticle']);
Route::post('/contact', ['as' => 'contact', 'uses' => 'PublicController@contact']);


Route::get('/portfolio', ['as' => 'public.work', 'uses' => 'PublicController@work']);
Route::get('/portfolio/{slug}', ['as' => 'public.workDetail', 'uses' => 'PublicController@workDetail']);

/*Resources*/
Route::resource('public', 'PublicController');