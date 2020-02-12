<?php

namespace Main\Http\Controllers;

use ContentParser\ContentParser;
use FlatFileCms\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Main\Http\Requests\ContactRequest;
use Main\Mail\ContactMail;
use Main\Models\OpenSource;
use Main\Models\Work;
use Symfony\Component\Yaml\Yaml;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.index', [
            'works'      => Work::all()
                ->sortByDesc(function (Work $work) {
                    return $work->publish_date;
                })
                ->take(2),
            'projects'   => OpenSource::all()
                ->filter(function (OpenSource $project) {
                    return $project->featured;
                })
                ->sortByDesc(function (OpenSource $project) {
                    return $project->publish_date;
                })
                ->take(4),
            'blog_posts' => Article::published()
                ->sortByDesc(function (Article $article) {
                    return $article->getPostDate();
                })
                ->take(2),
        ]);
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
            'works'   => Work::all()
                ->sortByDesc(function (Work $work) {
                    return $work->publish_date;
                }),
            'page'    => $this->tagsParser->getTagsForPageName('work'),
        ]);
    }

    public function open_source()
    {
        return view('public.open_source', [
            'projects' => OpenSource::all()
                ->sortByDesc(function (OpenSource $project) {
                    return $project->publish_date;
                }),
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
        $work = Work::find($slug);

        if (!$work->exists()) {
            return abort(404);
        }

        return view('public.workdetail', [
            'title' => ucfirst(str_replace('-', ' ', $slug)),
            'work'  => $work->body(),
            'page'  => $this->arrayToClass([
                'title'       => $work->title,
                'author'      => 'Roelof Jan Elsinga',
                'description' => $work->description,
                'image_large' => url($work->image()),
                'image_small' => url($work->image()),
                'keywords'    => str_replace(' ', ',', $work->title)
            ]),
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
                return $article->getPostDate();
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
        $article = Article::find($slug);

        if (!$article->exists()) {
            return abort(404);
        }

        return view('public.view-article', [
            'article' => $article,
            'page'    => $this->arrayToClass([
                'title'       => $article->title(),
                'author'      => 'Roelof Jan Elsinga',
                'description' => substr(strip_tags($article->description()), 0, 160),
                'image_large' => url($article->image()),
                'image_small' => url($article->image()),
                'keywords'    => str_replace(' ', ',', $article->title()),
                'canonical'   => $article->canonicalLink(),
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

    /**
     * Display the Atom feed
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function atomFeed()
    {
        $atom_feed = Storage::get('atom.xml');

        return response($atom_feed, 200, [
            'Content-Type' => 'application/atom+xml',
        ]);
    }

    /**
     * Display the RSS feed
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function rssFeed()
    {
        $rss_feed = Storage::get('rss.xml');

        return response($rss_feed, 200, [
            'Content-Type' => 'application/rss+xml',
        ]);
    }

    public function contact(ContactRequest $request)
    {
        Mail::to('roelofjanelsinga@gmail.com')
            ->send(
                new ContactMail(
                    $request->get('name'),
                    $request->get('email'),
                    $request->get('message')
                )
            );

        return redirect()->back()->with('contact_success', true);
    }
}
