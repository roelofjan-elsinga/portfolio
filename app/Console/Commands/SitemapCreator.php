<?php

namespace Main\Console\Commands;

use AloiaCms\Models\Article;
use AloiaCms\Models\Page;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Main\Models\Work;
use SitemapGenerator\SitemapGenerator;

class SitemapCreator extends \AloiaCms\Publish\Console\SitemapCreator
{
    /**@var string*/
    private $domain;

    /**@var string*/
    private $sitemap_file_path;

    /**@var string*/
    private $sitemap_target_file_path;

    /**
     * SitemapCreator constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->domain = Config::get('aloiacms-publish.site_url');
        $this->sitemap_file_path = Config::get('aloiacms-publish.sitemap_file_path');
        $this->sitemap_target_file_path = Config::get('aloiacms-publish.sitemap_target_file_path');
    }

    public function handle()
    {
        $generator = SitemapGenerator::boot($this->domain);

        $urls = [
            '/' => 1,
            '/articles/' => 0.9
        ];

        foreach ($urls as $url => $priority) {
            $generator->add($url, $priority, $this->lastmod, 'monthly');
        }

        foreach (Page::published() as $page) {
            $generator->add($page->url() . '/', 0.9, $this->lastmod, 'monthly');
        }

        $article_urls = $this->getArticleUrls();

        foreach ($article_urls as $url) {
            $generator->add($url . '/', 0.7, $this->lastmod, 'monthly');
        }

        $this->appendAdditionalUrls($generator);

        $this->persistUrlsToSitemap($generator->toXML());

        $this->createSymlinkForSitemap();

        $this->info("Generated sitemap");
    }

    /**
     * Overwrite the base implementation and add additional URL's.
     *
     * @param SitemapGenerator $generator
     */
    protected function appendAdditionalUrls(SitemapGenerator $generator): void
    {
        $generator->add(route('public.work', [], false) . '/', 0.9, $this->lastmod, 'monthly');

        foreach ($this->getPortfolioUrls() as $url) {
            $generator->add($url . '/', 0.8, $this->lastmod, 'monthly');
        }

        $generator->add(route('resume.show', [], false) . '/', 0.9, $this->lastmod, 'monthly');
        $generator->add(route('resume.show_dutch', [], false) . '/', 0.9, $this->lastmod, 'monthly');
        $generator->add(route('public.open_source', [], false) . '/', 0.9, $this->lastmod, 'monthly');
    }

    /**
     * Get the urls of the articles
     *
     * @param string $path
     * @return array
     */
    private function getArticleUrls(): array
    {
        return Article::published()
            ->filter(function (Article $article) {
                return empty($article->externalUrl()) && empty($article->canonicalLink());
            })
            ->map(function (Article $article) {
                $article_path = Config::get('aloiacms-publish.article_path');

                $article_path_prefix = $article_path[0] === '/' ? '' : '/';

                $article_path_suffix = $article_path[strlen($article_path) - 1] === '/' ? '' : '/';

                return $article_path_prefix . $article_path . $article_path_suffix . $article->slug();
            })
            ->toArray();
    }

    /**
     * Write the data to file
     *
     * @param string $sitemap
     */
    private function persistUrlsToSitemap(string $sitemap)
    {
        if (file_exists($this->sitemap_file_path)) {
            unlink($this->sitemap_file_path);
        }

        file_put_contents($this->sitemap_file_path, $sitemap);
    }

    private function createSymlinkForSitemap()
    {
        if (!file_exists($this->sitemap_target_file_path)) {
            // @codeCoverageIgnoreStart
            // This cannot be executed in the tests and is a known issue
            File::link($this->sitemap_file_path, $this->sitemap_target_file_path);
            // @codeCoverageIgnoreEnd
        }
    }

    /**
     * Get the urls of the portfolio items.
     *
     * @return array
     */
    private function getPortfolioUrls(): array
    {
        return Work::all()
            ->map(function (Work $work) {
                return $work->url;
            })
            ->toArray();
    }
}
