<?php

namespace Main\Providers;

use AloiaCms\Publish\Console\SitemapCreator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SitemapCreator::class, function () {
            return new \Main\Console\Commands\SitemapCreator();
        });
    }
}
