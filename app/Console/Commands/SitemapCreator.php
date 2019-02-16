<?php

namespace Main\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Main\Classes\Canonical;
use Main\Classes\Metadata;
use Symfony\Component\Yaml\Yaml;

class SitemapCreator extends Command
{

    private $domain;
    private $lastmod;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:sitemap';

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
        $this->lastmod = Carbon::now()->toDateString();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $sitemap_strings = [];

        $main_urls = [
            '/'
        ];

        $this->generateSiteMapForUrls($sitemap_strings, $main_urls, 1);

        $secondary_urls = [
            '/articles',
            '/passions',
            '/portfolio'
        ];

        $this->generateSiteMapForUrls($sitemap_strings, $secondary_urls, 0.9);

        $article_urls = $this->getArticleUrls();

        $this->generateSiteMapForUrls($sitemap_strings, $article_urls, 0.7);

        $passions_urls = $this->getArticleUrls('passions');

        $this->generateSiteMapForUrls($sitemap_strings, $passions_urls, 0.6);

        $portfolio_urls = $this->getPortfolioUrls();

        $this->generateSiteMapForUrls($sitemap_strings, $portfolio_urls, 0.8);

        $this->persistUrlsToSitemap($sitemap_strings);

        $this->createSymlinkForSitemap();

    }

    /**
     * @param array $sitemap_strings
     * @param array $urls
     * @param int|float $priority
     */
    private function generateSiteMapForUrls(array &$sitemap_strings, array $urls, $priority)
    {
        foreach($urls as $url) {
            $sitemap_strings[] = "<url><loc>{$this->domain}{$url}</loc><lastmod>{$this->lastmod}</lastmod><changefreq>monthly</changefreq><priority>{$priority}</priority></url>";
        }
    }

    /**
     * Get the urls of the articles
     *
     * @param string $path
     * @return array
     */
    private function getArticleUrls(string $path = 'articles'): array
    {
        $meta_data = Metadata::forPath($path);

        return $meta_data
            ->filter(function($article) {
                return !isset($article->url);
            })
            ->map(function($article) use ($path) {
                $slug = str_replace('.md', '', $article->filename);

                return "/{$path}/{$slug}";
            })
            ->toArray();
    }

    /**
     * Get the urls of the portfolio items
     *
     * @return array
     */
    private function getPortfolioUrls(): array
    {
        $projects = Yaml::parseFile(resource_path('content/work/previews.yml'));

        return collect($projects['previews'])
            ->map(function($preview) {
                return $preview['url'];
            })
            ->toArray();
    }

    /**
     * Write the data to file
     *
     * @param array $urls
     */
    private function persistUrlsToSitemap(array $urls)
    {
        $filename = "sitemap.xml";

        Storage::delete($filename);

        Storage::put($filename, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>");

        Storage::append($filename, "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">");

        foreach ($urls as $url) {
            Storage::append($filename, $url);
        }

        Storage::append($filename, "</urlset>");
    }

    private function createSymlinkForSitemap()
    {
        if (!File::exists(public_path('sitemap.xml'))) {
            File::link(storage_path('app/sitemap.xml'), public_path('sitemap.xml'));
        }
    }
}
