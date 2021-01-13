<?php

namespace Main\Http\Controllers;

use Main\Models\Article;
use AloiaCms\Models\MetaTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
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
            'blog_posts' => $this->getMostRecentPosts(),
        ]);
    }

    private function getMostRecentPosts(): Collection
    {
        return Cache::remember('recent-posts', now()->addDay(), function () {
            return Article::published()
                ->sortByDesc(fn (Article $article) => $article->getPostDate())
                ->values()
                ->take(2);
        });
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
                ->sortByDesc(fn (Work $work) => $work->publish_date),
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
     * Display the Atom feed
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function atomFeed()
    {
        return \response()->file(public_path('atom.xml'));
    }

    /**
     * Display the RSS feed
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function rssFeed()
    {
        return \response()->file(public_path('rss.xml'));
    }

    public function contact(ContactRequest $request)
    {
        Mail::to('contact@roelofjanelsinga.com')
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
