<?php


namespace Main\Tasks\Publishing;


use AloiaCms\Publish\Tasks\TaskInterface;
use Illuminate\Support\Facades\Artisan;

class PublishPostToLinkedIn implements TaskInterface
{
    /**
     * Run this task
     */
    public function run()
    {
        Artisan::call('share:linkedin');
    }
}