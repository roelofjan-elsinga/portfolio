<?php

namespace Main\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Main\Classes\Markdown;
use Main\Classes\Metadata;
use PHPHtmlParser\Dom;
use Symfony\Component\Yaml\Yaml;

class PublicController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        View::share('page', $this->tagsParser->getTagsForPageName('home'));
    }

    public function index()
    {
        return view('public.index', [
            'works' => $this->getWorkPreviews(2),
            'work' => Markdown::parseResourcePath("content/blocks/work.md"),
            'social' => Markdown::parseResourcePath("content/blocks/social.md"),
            'about' => Markdown::parseResourcePath("content/blocks/about.md"),
            'contact' => Markdown::parseResourcePath("content/blocks/contact.md"),
            'site_techniques' => Markdown::parseResourcePath("content/blocks/site_techniques.md")
        ]);
    }

    /**
     * Parse the previews.yml file to retrieve work preview data
     *
     * @param int $amount
     * @return array
     */
    private function getWorkPreviews(int $amount = 0): array
    {
        $work = Yaml::parseFile(resource_path('content/work/previews.yml'));

        $previews = array_reverse($work['previews']);

        if ($amount > 0) {
            return array_slice($previews, 0, $amount);
        }

        return $previews;
    }

    /**
     * Parse the content from Markdown files
     *
     * @param string $path
     * @param int $amount
     * @return array
     */
    private function getContent(string $path, int $amount): array
    {
        $parser = new \Parsedown();
        $path = resource_path($path);
        $paths = glob($path);
        if ($amount === 0) {
            $filenames = $paths;
        } else {
            $filenames = array_splice($paths, -$amount, $amount);
        }
        $strings = [];
        foreach ($filenames as $filename) {
            if (File::isFile($filename)) {
                $file = File::get($filename);
                $strings[] = [
                    "filename" => $filename,
                    "text" => $parser->parse($file)
                ];
            }
        }
        $strings = array_reverse($strings);
        return $strings;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function contact(Request $request): RedirectResponse
    {
        if (strlen($request->validation) === 3) {
            $data = ['request' => $request];
            Mail::send('emails.contact', $data, function ($message) use ($data) {
                $message->from('system@roelofjanelsinga.nl', 'Roelof Jan Elsinga')
                    ->to('roelofjanelsinga@gmail.com')
                    ->subject('Form submission');
            });
        }
        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function work()
    {
        return view('public.work', [
            'content' => Markdown::parseResourcePath("content/blocks/work-page.md"),
            'works' => $this->getWorkPreviews(),
            'page' => $this->tagsParser->getTagsForPageName('work')
        ]);
    }

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|\Illuminate\View\View
     */
    public function workDetail(string $slug)
    {
        $contents = $this->getContent("content/work/{$slug}.md", 1);

        if (count($contents) === 0) {
            return abort(404);
        }

        $content = $contents[0];

        if (!isset($content['text'])) {
            return redirect()->route('public.work');
        }

        return view('public.workdetail', [
            'title' => ucfirst(str_replace("-", " ", $slug)),
            'work' => $content['text'],
            'page' => $this->tagsParser->getTagsForPageName('work')
        ]);
    }

    /**
     * @param string $string
     * @param string $tagname
     * @param string $attribute
     * @return array
     */
    private function getTextBetweenTags(string $string, string $tagname, string $attribute = 'textContent'): array
    {
        $d = new \DOMDocument();
        $d->loadHTML($string);
        $return = array();
        foreach ($d->getElementsByTagName($tagname) as $item) {
            if ($item->childNodes->length === 1) {
                $return[] = $item->$attribute;
            }
        }
        return $return;
    }

    /**
     * @param string $string
     * @param string $tagname
     * @param string $source
     * @return array
     */
    public function getTagAttribute(string $string, string $tagname, string $source): array
    {
        $d = new \DOMDocument();
        $d->loadHTML($string);
        $return = array();
        foreach ($d->getElementsByTagName($tagname) as $item) {
            $return[] = $item->getAttribute($source);
        }
        return $return;
    }

    /**
     * @param string $path
     * @param int $width
     * @return string
     */
    private function getThumbnailFromPath(string $path, int $width = 300): string
    {
        $basename = basename($path);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $filename = str_replace(".{$extension}", "", $basename);

        return "{$filename}_w{$width}.{$extension}";
    }

    /**
     * @param Collection $articles
     * @param string $path
     * @return Collection
     */
    private function mapArticlesForPath(Collection $articles, string $path = 'articles'): Collection
    {
        return $articles->map(function ($article) use ($path) {
            $content = Markdown::parseResourcePath("content/{$path}/{$article->filename}");

            if (strlen($content) > 0) {
                $title = $this->getTextBetweenTags($content, 'h1');
                $image = $this->getTagAttribute($content, 'img', 'src');

                $article->title = isset($title[0]) ? $title[0] : "Untitled article";
                $article->image = isset($image[0]) ? $image[0] : "";
                $article->thumbnail = "/images/{$path}/{$this->getThumbnailFromPath($article->image)}";
            }

            $article->content = $content;
            $article->slug = str_replace(".md", "", $article->filename);

            $article->postDate = Carbon::createFromFormat("Y-m-d", $article->postDate)->format("F jS, Y");
            return $article;
        });
    }

    /**
     * @param $article
     * @param string $path
     * @return mixed
     */
    public function mapArticleForViewing($article, string $path = 'articles')
    {
        $content = Markdown::parseResourcePath("content/{$path}/{$article->filename}");

        $article->content = $content;

        $article->title = $this->getTextBetweenTags($content, 'h1')[0];
        $article->image = $this->getTagAttribute($content, 'img', 'src')[0];
        $article->description = $this->getDescriptionFromContent($content);

        $article->postDate = Carbon::createFromFormat("Y-m-d", $article->postDate)->format("F jS, Y");
        return $article;
    }

    /**
     * View the passions overview page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function passions()
    {
        $articles = Metadata::forPath('passions')
            ->sortByDesc('postDate')
            ->values();

        $articles = $this->mapArticlesForPath($articles, 'passions');

        return view('public.articles', [
            'content' => Markdown::parseResourcePath("content/blocks/passions.md"),
            'articles' => $articles,
            'view_route_name' => 'passions.view',
            'page' => $this->tagsParser->getTagsForPageName('passions')
        ]);
    }

    /**
     * View a passion post
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewPassion(string $slug)
    {
        $article = Metadata::forPath('passions')
            ->filter(function ($article) use ($slug) {
                return $article->filename === "{$slug}.md";
            })
            ->values()
            ->map(function ($article) {
                return $this->mapArticleForViewing($article, 'passions');
            })
            ->first();

        if (is_null($article)) {
            return abort(404);
        }

        return view('public.view-article', [
            'article' => $article,
            'page' => $this->arrayToClass([
                'title' => "{$article->title} - Roelof Jan Elsinga",
                'author' => 'Roelof Jan Elsinga',
                'description' => substr(strip_tags($article->description), 0, 160),
                'image_large' => url($article->image),
                'image_small' => url($article->image),
                'keywords' => str_replace(' ', ',', $article->title)
            ])
        ]);
    }

    /**
     * View the articles page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articles()
    {
        $articles = Metadata::forPath()
            ->sortByDesc('postDate')
            ->values();

        $articles = $this->mapArticlesForPath($articles);

        return view('public.articles', [
            'content' => Markdown::parseResourcePath("content/blocks/articles.md"),
            'articles' => $articles,
            'view_route_name' => 'articles.view',
            'page' => $this->tagsParser->getTagsForPageName('articles')
        ]);
    }

    /**
     * View an article
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewArticle(string $slug)
    {
        $article = Metadata::forPath()
            ->filter(function ($article) use ($slug) {
                return $article->filename === "{$slug}.md";
            })
            ->values()
            ->map(function ($article) {
                return $this->mapArticleForViewing($article);
            })
            ->first();

        if (is_null($article)) {
            return abort(404);
        }

        return view('public.view-article', [
            'article' => $article,
            'page' => $this->arrayToClass([
                'title' => "{$article->title} - Roelof Jan Elsinga",
                'author' => 'Roelof Jan Elsinga',
                'description' => substr(strip_tags($article->description), 0, 160),
                'image_large' => url($article->image),
                'image_small' => url($article->image),
                'keywords' => str_replace(' ', ',', $article->title)
            ])
        ]);
    }

    /**
     * Generate a description from the text content of the given HTML string
     *
     * @param string $content
     * @return string
     */
    private function getDescriptionFromContent(string $content): string
    {
        $paragraphs = $this->getTextBetweenTags($content, 'p');

        $paragraphs_with_text_content = array_filter($paragraphs, function ($paragraph) {
            return !empty(strip_tags($paragraph));
        });

        if (count($paragraphs_with_text_content) > 0) {
            return substr(head($paragraphs_with_text_content), 0, 160);
        }

        return "";
    }

    /**
     * Convert an array to a stdClass
     *
     * @param array $input
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
            'Content-Type' => 'application/atom+xml'
        ]);
    }
}
