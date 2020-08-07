<?php

namespace Main\Tasks\Publishing;

use AloiaCms\Publish\Tasks\TaskInterface;
use Illuminate\Support\Facades\Artisan;

class GenerateImageSitemap implements TaskInterface
{
    /**
     * Run this task
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('generate:image-sitemap');
    }
}
