<?php

namespace Main\Providers;

use AloiaCms\Models\Page;
use Illuminate\Support\Facades\App;
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

        $exporter->paths(
            Article::published()
                ->map(fn (Article $article) => route('articles.view', $article->filename(), false))
                ->toArray()
        );

        $exporter->paths(
            Work::all()
                ->map(fn (Work $work) => route('public.workDetail', $work->filename(), false))
                ->toArray()
        );
    }
}
