<?php

namespace Main\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Main\Classes\Canonical;
use Main\Classes\Metadata;
use Main\Http\Controllers\PublicController as Controller;

class AtomFeedGenerator extends Command
{
    private $domain;
    private $lastmod;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a sitemap for the website';

    public function __construct()
    {
        parent::__construct();

        $this->domain = Canonical::getCanonicalDestination();
        $this->lastmod = Carbon::now();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $articles = Metadata::forPath()
            ->map(function ($article) {
                $article->type = 'articles';
                return $article;
            });

        $passions = Metadata::forPath('passions')
            ->map(function ($article) {
                $article->type = 'passions';
                return $article;
            });

        $articles = $articles->merge($passions)
            ->sortBy('postDate')
            ->filter(function ($article) {
                return !isset($article->url);
            });

        $atom_string = $this->generateAtomHeader();

        $atom_string = $this->appendTitleAndAuthor($atom_string);

        $atom_string = $this->appendArticleEntries($atom_string, $articles);

        $atom_string = $this->appendAtomFooter($atom_string);

        Storage::put('atom.xml', $atom_string);

        $this->info("Generated Atom feed");
    }

    private function generateAtomHeader(): string
    {
        return "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<feed xmlns=\"http://www.w3.org/2005/Atom\">\n";
    }

    private function appendTitleAndAuthor(string $atom_string): string
    {
        return "{$atom_string}\n    
              <title>Roelof Jan Elsinga</title>
              <link href=\"https://roelofjanelsinga.com\"/>
              <updated>{$this->lastmod->toAtomString()}</updated>
              <author>
                <name>Roelof Jan Elsinga</name>
              </author>
              <id>https://roelofjanelsinga.com/</id>
              <link rel=\"self\" href='https://roelofjanelsinga.com/feed'/>
        ";
    }

    private function appendArticleEntries($atom_string, $articles): string
    {
        $entries = $articles
            ->map(function ($article) {
                $createdAt = Carbon::createFromFormat('Y-m-d', $article->postDate)->setTimeFromTimeString("12:00:00");

                $article = (new Controller())->mapArticleForViewing($article, $article->type);

                if (isset($article->updateDate)) {
                    $updatedAt = Carbon::createFromFormat('Y-m-d H:i:s', $article->updateDate);
                } else {
                    $updatedAt = $createdAt;
                }

                $url = str_replace('.md', '', $article->filename);

                $description = strip_tags($article->content, ENT_QUOTES);

                $image_string = '';

                if (isset($article->image)) {
                    $image_url = Canonical::getCanonicalDestination() . $article->image;

                    $image_size = getimagesize($image_url);

                    $image_string = "<media:content xmlns:media=\"http://search.yahoo.com/mrss/\" 
                                url=\"{$image_url}\" medium=\"image\" 
                                type=\"{$image_size['mime']}\" width=\"{$image_size[0]}\" height=\"{$image_size[1]}\" />";
                }

                $summary = rtrim(mb_strimwidth($description, 0, 300))."[...]";

                return "<entry>
                            <title>{$article->title}</title>
                            <link href=\"{$this->domain}/{$article->type}/{$url}\"/>
                            <id>{$this->domain}/{$article->type}/{$url}</id>
                            <updated>{$updatedAt->toAtomString()}</updated>
                            <published>{$createdAt->toAtomString()}</published>
                            <content>{$description}</content>
                            <summary>{$summary}</summary>
                            {$image_string}
                          </entry>\n";
            })->implode('');

        return $atom_string . $entries;
    }

    private function appendAtomFooter($atom_string): string
    {
        return "{$atom_string}\n</feed>";
    }
}
