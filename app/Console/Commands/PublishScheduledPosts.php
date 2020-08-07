<?php

namespace Main\Console\Commands;

use Main\Tasks\Publishing\ClearCachedPosts;
use Main\Tasks\Publishing\GenerateImageSitemap;
use Main\Tasks\Publishing\PublishPostToLinkedIn;

class PublishScheduledPosts extends \AloiaCms\Publish\Console\PublishScheduledPosts
{
    /**
     * The tasks to perform in this command
     *
     * @var array
     */
    protected $custom_tasks = [
        GenerateImageSitemap::class,
        PublishPostToLinkedIn::class,
        ClearCachedPosts::class,
    ];

    protected function tasks(): array
    {
        $tasks = parent::tasks();

        return array_merge($tasks, $this->custom_tasks);
    }
}
