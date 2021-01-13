<?php

namespace Main\Listeners;

use AloiaCms\Events\PostModelDeleted;
use AloiaCms\Events\PostModelSaved;
use AloiaCms\Models\Article as BaseArticle;
use Illuminate\Events\Dispatcher;
use Main\Jobs\DeleteArticle;
use Main\Jobs\SaveArticle;
use Main\Models\Article;

class ModelSubscriber
{
    public function handleSaveEvent(PostModelSaved $event)
    {
        switch (get_class($event->model)) {
            case BaseArticle::class:
                SaveArticle::dispatch(Article::find($event->model->filename()));
                break;
            case Article::class:
                SaveArticle::dispatch($event->model);
                break;
        }
    }

    public function handleDeleteEvent(PostModelDeleted $event)
    {
        switch (get_class($event->model)) {
            case BaseArticle::class:
                DeleteArticle::dispatch(Article::find($event->model->filename()));
                break;
            case Article::class:
                DeleteArticle::dispatch($event->model);
                break;
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param Dispatcher $events
     * @return void
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            PostModelSaved::class,
            'Main\Listeners\ModelSubscriber@handleSaveEvent'
        );

        $events->listen(
            PostModelDeleted::class,
            'Main\Listeners\ModelSubscriber@handleDeleteEvent'
        );
    }
}
