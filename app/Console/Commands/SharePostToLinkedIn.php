<?php

namespace Main\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Main\Classes\LinkedIn\LinkedIn;
use Main\Jobs\ShareArticleToLinkedIn;
use Main\Models\Article;

class SharePostToLinkedIn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'share:linkedin {--slug=} {--date=}';

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

        if (!is_null($this->option('slug'))) {

            $article = Article::find($this->option('slug'));

            if (!$article->exists()) {
                $this->error("No article found for that slug!");
                return;
            }

        } else {

            $date = $this->option('date') ?? date('Y-m-d');

            $article = Article::all()
                ->filter(function (Article $post) use ($date) {

                    return $post->getPostDate()->toDateString() === $date && $post->isPublished();
                })
                ->first();

            if (is_null($article)) {
                $this->warn("No article published on {$date}, nothing to share!");
                return;
            }

        }

        ShareArticleToLinkedIn::dispatchNow($article);

        $this->info("Published \"{$article->title()}\" to LinkedIn");
    }
}
