<?php

namespace Main\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Main\Models\Article;
use Main\Models\Tag;

class SaveArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Article $article;

    /**
     * Create a new job instance.
     *
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tags = $this->article->get('tags') ?? [];

        // Attach new tags
        foreach ($tags as $tag_name) {
            $tag = Tag::find($tag_name);

            if (!$tag->exists()) {
                $tag->set('name', $tag_name);
            }

            $tag->attachArticle($this->article->filename())->save();
        }

        // Remove old tags
        foreach ($this->article->tags() as $tag) {
            if (!in_array($tag->filename(), $tags)) {
                $tag->detachArticle($this->article->filename())->save();
            }
        }
    }
}
