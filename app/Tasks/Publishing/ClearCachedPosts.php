<?php

namespace Main\Tasks\Publishing;

use AloiaCms\Publish\Tasks\TaskInterface;
use Illuminate\Support\Facades\Cache;

class ClearCachedPosts implements TaskInterface
{
    /**
     * Run this task
     */
    public function run()
    {
        Cache::forget('published-posts');
        Cache::forget('recent-posts');
    }
}
