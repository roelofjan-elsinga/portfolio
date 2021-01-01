<?php

namespace Main\Providers;

use AloiaCms\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Main\Models\Article;
use Main\Models\Work;
use Spatie\Export\Exporter;

class ExportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Exporter $exporter)
    {
        App::setLocale('nl');
        Config::set('APP_URL', 'https://roelofjanelsinga.nl');

        $exporter->crawl(false);
        $exporter->paths([
            '',
            'articles',
            'resume',
            'mijn-cv',
            'open-source-contributions',
            'portfolio',
        ]);

        $exporter->paths(
            Page::all()
                ->map(fn (Page $page) => $page->filename())
                ->toArray()
        );

        $articles = Article::published();

        $exporter->paths(
            $articles
                ->map(fn (Article $article) => route('articles.view', $article->filename(), false))
                ->toArray()
        );

        $paginator = new LengthAwarePaginator($articles, count($articles), 10, 1, [
            'path' => '/articles',
        ]);

        $exporter->paths(
            Collection::make($this->getPages($paginator->lastPage()))
                ->map(function (int $page) {
                    return $page === 1
                        ? route('articles', [], false)
                        : route('articles', ['page' => $page], false);
                })
                ->toArray()
        );

        $exporter->paths(
            Work::all()
                ->map(fn (Work $work) => route('public.workDetail', $work->filename(), false))
                ->toArray()
        );
    }

    private function getPages(int $lastPage): array
    {
        $pages = [];

        $i = 1;

        while ($i<=$lastPage) {
            $pages[] = $i;
            $i++;
        }

        return $pages;
    }
}
