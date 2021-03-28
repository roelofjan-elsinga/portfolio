<?php

namespace Main\Http\Controllers;

use AloiaCms\Models\MetaTag;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Main\Classes\ArticlePaginator;
use Main\Models\Article;
use Main\Models\Tag;

class ArticleController extends Controller
{
    /**
     * View the articles page.
     *
     * @return Factory|View
     * @throws Exception
     *
     */
    public function index(?int $page = null)
    {
        $articles = $this->getPublishedArticles();

        $current_page = $page ?? 1;

        $page_articles = collect($articles)->forPage($current_page, 10);

        $paginator = new ArticlePaginator($page_articles, count($articles), 10, $current_page, [
            'path' => '/articles'
        ]);

        return view('public.articles', [
            'articles' => $paginator,
            'pagination_tags' => [
                'prev' => $current_page > 1 ? $paginator->url($current_page - 1) : null,
                'next' => $current_page < $paginator->lastPage() ? $paginator->url($current_page + 1) : null,
            ],
            'page' => MetaTag::find('articles'),
            'tags' => Tag::all()->sortByDesc(fn (Tag $tag) => count($tag->get("articles") ?? []))
        ]);
    }

    private function getPublishedArticles(): Collection
    {
        return Cache::remember('published-posts', now()->addDay(), function () {
            return Article::published()
                ->sortByDesc(function (Article $article) {
                    return $article->getPostDate();
                })
                ->values();
        });
    }

    /**
     * View an article.
     *
     * @param string $slug
     *
     * @return Factory|View
     */
    public function show(string $slug)
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

    public function tags(string $tag_name)
    {
        $articles = Collection::make(Tag::find($tag_name)->get('articles') ?? [])
            ->map(fn (string $article_slug) => Article::find($article_slug))
            ->sortByDesc(fn (Article $article) => $article->getPostDate());

        return view('public.tags', [
            'articles' => $articles,
            'page' => $this->arrayToClass([
                'title' => "Blog posts about " . ucfirst($tag_name),
                'author' => 'Roelof Jan Elsinga',
                'description' => "Find blog posts about {$tag_name} from all blog posts",
                'image_url' => "https://roelofjanelsinga.com/images/logo/logo_banner.jpg",
                'keywords' => "blog, {$tag_name}",
                'canonical' => route("articles.tags", $tag_name, true)
            ]),
            'tag_name' => $tag_name,
            'pagination' => false,
            'tags' => Tag::all()->sortByDesc(fn (Tag $tag) => count($tag->get("articles") ?? []))
        ]);
    }
}
