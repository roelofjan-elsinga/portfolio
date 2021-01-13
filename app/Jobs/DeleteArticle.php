<?php

namespace Main\Jobs;

use AloiaCms\Models\Article as BaseArticle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Main\Models\Article;

class DeleteArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Article $article;

    /**
     * Create a new job instance.
     *
     * @param BaseArticle $article
     */
    public function __construct(BaseArticle $article)
    {
        $this->article = Article::find($article->filename());
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->article->tags() as $tag) {
            $tag->detachArticle($this->article->filename())->save();
        }
    }
}
