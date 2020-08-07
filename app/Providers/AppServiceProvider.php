<?php

namespace Main\Providers;

use AloiaCms\Publish\Console\PublishScheduledPosts;
use AloiaCms\Publish\Console\SitemapCreator;
use Illuminate\Support\ServiceProvider;
use Main\Classes\LinkedIn\LinkedIn;

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

        $this->app->bind(LinkedIn::class, function () {
            $instance = new LinkedIn(
                config('services.linkedin.key'),
                config('services.linkedin.secret'),
                config('services.linkedin.redirect_uri'),
            );

            return $instance
                ->state(config('services.linkedin.state'));
        });

        $this->app->bind(PublishScheduledPosts::class, function () {
            return new \Main\Console\Commands\PublishScheduledPosts();
        });
    }
}
