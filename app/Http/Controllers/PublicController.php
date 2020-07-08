<?php

namespace Main\Http\Controllers;

use AloiaCms\Models\ContentBlock;
use ContentParser\ContentParser;
use AloiaCms\Models\Article;
use AloiaCms\Models\MetaTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Main\Http\Requests\ContactRequest;
use Main\Mail\ContactMail;
use Main\Models\OpenSource;
use Main\Models\Work;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.index', [
            'works' => Work::all()
                ->sortByDesc(function (Work $work) {
                    return $work->publish_date;
                })
                ->take(2),
            'projects' => OpenSource::all()
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     *
     */
    public function work()
    {
        return view('public.work', [
            'works' => Work::all()
                ->sortByDesc(function (Work $work) {
                    return $work->publish_date;
                }),
            'page' => MetaTag::find('work'),
        ]);
    }

    public function open_source()
    {
        return view('public.open_source', [
            'projects' => OpenSource::all()
                ->sortByDesc(function (OpenSource $project) {
                    return $project->publish_date;
                }),
            'page' => MetaTag::find('open_source'),
        ]);
    }

    /**
     * @param string $slug
     *
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|\Illuminate\View\View
     */
    public function showWork(string $slug)
    {
        $work = Work::find($slug);

        if (!$work->exists()) {
            abort(404);
        }

        return view('public.workdetail', [
            'title' => ucfirst(str_replace('-', ' ', $slug)),
            'work' => $work->body(),
            'page' => $this->arrayToClass([
                'title' => $work->title,
                'author' => 'Roelof Jan Elsinga',
                'description' => $work->description,
                'image_url' => url($work->image()),
                'keywords' => str_replace(' ', ',', $work->title)
            ]),
        ]);
    }

    /**
     * View the articles page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     *
     */
    public function articles()
    {
        $request = Request::capture();

        $articles = Article::published()
            ->sortByDesc(function (Article $article) {
                return $article->getPostDate();
            })
            ->values();

        if ($request->has('q') && !empty($request->get('q'))) {
            $articles = $articles
                ->filter(function (Article $article) use ($request) {
                    return strpos(strtolower($article->title()), strtolower($request->get('q'))) !== false
                        || strpos(strtolower($article->description()), strtolower($request->get('q'))) !== false
                        || strpos(strtolower($article->body()), strtolower($request->get('q'))) !== false;
                })
                ->values();
        }

        $current_page = $request->get('page') ?? 1;

        $page_articles = collect($articles)->forPage($current_page, 10);

        $paginator = new LengthAwarePaginator($page_articles, count($articles), 10, $current_page, [
            'path' => '/articles',
        ]);

        return view('public.articles', [
            'articles' => $paginator,
            'pagination_tags' => [
                'prev' => $current_page > 1 ? $paginator->url($current_page - 1) : null,
                'next' => $current_page < $paginator->lastPage() ? $paginator->url($current_page + 1) : null,
            ],
            'view_route_name' => 'articles.view',
            'page' => MetaTag::find('articles'),
        ]);
    }

    /**
     * View an article.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showArticle(string $slug)
    {
        $article = Article::find($slug);

        if (!$article->exists()) {
            abort(404);
        }

        return view('public.view-article', [
            'article' => $article,
            'page' => $this->arrayToClass([
                'title' => $article->title(),
                'author' => 'Roelof Jan Elsinga',
                'description' => substr(strip_tags($article->description()), 0, 160),
                'image_url' => url($article->image()),
                'keywords' => str_replace(' ', ',', $article->title()),
                'canonical' => $article->canonicalLink(),
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
