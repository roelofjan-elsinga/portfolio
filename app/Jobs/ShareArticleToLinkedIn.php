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

    private LinkedIn $linkedIn;

    /**
     * Create a new job instance.
     *
     * @param LinkedIn $linkedIn
     */
    public function __construct(LinkedIn $linkedIn)
    {
        $this->linkedIn = $linkedIn;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Article $article)
    {
        $linkedin_auth = json_decode(Storage::get('linkedin.json'), true);

        $this->linkedIn
            ->share()
            ->withAccessToken($linkedin_auth['access_token'])
            ->article(
                $article->description(),
                route('articles.view', $article->slug()),
                $article->title(),
                $article->description()
            )
            ->publicly();
    }
}
