<?php

namespace Main\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Main\Classes\LinkedIn\LinkedIn;
use Main\Models\Article;

class SharePostToLinkedIn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'share:linkedin {--slug=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Share a post to LinkedIn';

    private LinkedIn $linkedIn;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LinkedIn $linkedIn)
    {
        parent::__construct();

        $this->linkedIn = $linkedIn;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!Storage::exists('linkedin.json')) {
            $this->error("No LinkedIn access token available!");
            return;
        }

        $linkedin_auth = json_decode(Storage::get('linkedin.json'), true);

        if (is_null($this->option('slug'))) {
            $this->error("No article slug submitted!");
            return;
        }

        $article = Article::find($this->option('slug'));

        if (!$article->exists()) {
            $this->error("No article found for that slug!");
            return;
        }

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

        $this->info("Published \"{$article->title()}\" to LinkedIn");
    }
}
