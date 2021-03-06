<?php

Route::permanentRedirect('login', 'cms/login');
Route::permanentRedirect('blog', 'articles');

Route::get('/', ['as' => 'home', 'uses' => 'PublicController@index']);
Route::post('contact', ['as' => 'contact', 'uses' => 'PublicController@contact']);
Route::get('tags/{tag}', ['as' => 'articles.tags', 'uses' => 'ArticleController@tags']);
Route::get('articles/{page?}', ['as' => 'articles', 'uses' => 'ArticleController@index'])->where('page', '[0-9]+');
Route::get('articles/{slug}', ['as' => 'articles.view', 'uses' => 'ArticleController@show']);
Route::permanentRedirect('/passions', '/articles');

Route::get('passions/{slug}', function ($slug) {
    return Redirect::to("articles/{$slug}", 301);
});

Route::get('feed', ['as' => 'feed', 'uses' => 'PublicController@atomFeed']);
Route::get('feed/rss', ['as' => 'feed.rss', 'uses' => 'PublicController@rssFeed']);

Route::get('resume', ['as' => 'resume.show', 'uses' => 'ResumeController@browser']);
Route::get('mijn-cv', ['as' => 'resume.show_dutch', 'uses' => 'ResumeController@browserDutch']);

Route::get('open-source-contributions', ['as' => 'public.open_source', 'uses' => 'PublicController@open_source']);

Route::get('portfolio', ['as' => 'public.work', 'uses' => 'PublicController@work']);
Route::get('portfolio/{slug}', ['as' => 'public.workDetail', 'uses' => 'PublicController@showWork']);

/*Resources*/
Route::resource('public', 'PublicController');

Route::prefix('auth')
    ->group(function () {
        Route::get('linkedin/redirect', 'AuthController@logInRedirect')->name('auth.logInRedirect');
        Route::get('linkedin', 'AuthController@oAuthCallback')->name('auth.callbackLinkedIn');
    });

Route::get('/{slug}', ['as' => 'page', 'uses' => 'PageController@showPage'])->where('slug', '.*');
