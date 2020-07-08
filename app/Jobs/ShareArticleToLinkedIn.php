<?php

namespace Main\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Main\Classes\LinkedIn\LinkedIn;
use Main\Models\Article;

class ShareArticleToLinkedIn implements ShouldQueue
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
    public function handle(LinkedIn $linkedIn)
    {
        $linkedin_auth = json_decode(Storage::get('linkedin.json'), true);

        $linkedIn
            ->share()
            ->withAccessToken($linkedin_auth['access_token'])
            ->article(
                $this->article->description(),
                route('articles.view', $this->article->slug(), true),
                $this->article->title(),
                $this->article->description()
            )
            ->publicly();
    }
}
