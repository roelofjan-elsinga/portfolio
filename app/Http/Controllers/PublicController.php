<?php

namespace Main\Http\Controllers;

use Carbon\Carbon;
use ContentParser\ContentParser;
use FlatFileCms\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.index', [
            'works'      => $this->getWorkPreviews(2),
            'projects'   => $this->getWorkPreviews(4, 'content/open_source/previews.yml'),
            'blog_posts' => Article::published()
                ->sortByDesc(function (Article $article) {
                    return $article->rawPostDate();
                })
                ->take(2),
        ]);
    }

    /**
     * Parse the previews.yml file to retrieve work preview data.
     *
     * @param int    $amount
     * @param string $preview_path
     *
     * @return Collection
     */
    private function getWorkPreviews(int $amount = 0, string $preview_path = 'content/work/previews.yml'): Collection
    {
        $work = Yaml::parseFile(resource_path($preview_path));

        $previews = array_reverse($work['previews']);

        if ($amount > 0) {
            return Collection::make(array_slice($previews, 0, $amount));
        }

        return Collection::make($previews);
    }

    /**
     * Parse the content from Markdown files.
     *
     * @param string $path
     * @return array
     */
    private function getContent(string $path): array
    {
        $parser = new \Parsedown();

        $path = resource_path($path);

        $strings = [];

        if (File::isFile($path)) {
            $file = File::get($path);
            $strings[] = [
                'filename' => $path,
                'text'     => $parser->parse($file),
            ];
        }

        $strings = array_reverse($strings);

        return $strings;
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function work()
    {
        return view('public.work', [
            'content' => ContentParser::forFile(resource_path('content/blocks/work-page.md'))->parse(),
            'works'   => $this->getWorkPreviews(),
            'page'    => $this->tagsParser->getTagsForPageName('work'),
        ]);
    }

    public function open_source()
    {
        return view('public.open_source', [
            'projects' => $this->getWorkPreviews(0, 'content/open_source/previews.yml'),
            'page'     => $this->tagsParser->getTagsForPageName('open_source'),
        ]);
    }

    /**
     * @param string $slug
     *
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|\Illuminate\View\View
     */
    public function workDetail(string $slug)
    {
        $contents = $this->getContent("content/work/{$slug}.md");

        if (count($contents) === 0) {
            return abort(404);
        }

        $content = $contents[0];

        return view('public.workdetail', [
            'title' => ucfirst(str_replace('-', ' ', $slug)),
            'work'  => $content['text'],
            'page'  => $this->tagsParser->getTagsForPageName('work'),
        ]);
    }

    /**
     * View the articles page.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articles()
    {
        $request = Request::capture();

        $articles = Article::published()
            ->sortByDesc(function (Article $article) {
                return $article->rawPostDate();
            })
            ->values();

        $current_page = $request->get('page') ?? 1;

        $page_articles = collect($articles)->forPage($current_page, 10);

        $paginator = new LengthAwarePaginator($page_articles, count($articles), 10, $current_page, [
            'path' => '/articles',
        ]);

        return view('public.articles', [
            'articles'        => $paginator,
            'pagination_tags' => [
                'prev' => $current_page > 1 ? $paginator->url($current_page - 1) : null,
                'next' => $current_page < $paginator->lastPage() ? $paginator->url($current_page + 1) : null,
            ],
            'view_route_name' => 'articles.view',
            'page'            => $this->tagsParser->getTagsForPageName('articles'),
        ]);
    }

    /**
     * View an article.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewArticle(string $slug)
    {
        $article = Article::forSlug($slug);

        if (is_null($article)) {
            return abort(404);
        }

        return view('public.view-article', [
            'article' => $article,
            'page'    => $this->arrayToClass([
                'title'       => "{$article->title} - Roelof Jan Elsinga",
                'author'      => 'Roelof Jan Elsinga',
                'description' => substr(strip_tags($article->description), 0, 160),
                'image_large' => url($article->image),
                'image_small' => url($article->image),
                'keywords'    => str_replace(' ', ',', $article->title),
                'canonical'   => isset($article->canonical) ? $article->canonical : null,
            ]),
            'is_article' => true,
        ]);
    }

    /**
     * Convert an array to a stdClass.
     *
     * @param array $input
     *
     * @return \stdClass
     */
    private function arrayToClass(array $input)
    {
        $class = new \stdClass();

        foreach ($input as $key => $value) {
            $class->{$key} = $value;
        }

        return $class;
    }

    public function atomFeed()
    {
        $atom_feed = Storage::get('atom.xml');

        return response($atom_feed, 200, [
            'Content-Type' => 'application/atom+xml',
        ]);
    }
}
