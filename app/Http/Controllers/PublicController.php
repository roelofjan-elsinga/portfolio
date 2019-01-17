<?php

namespace Main\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Main\Http\Requests;
use Main\Http\Controllers\Controller;
use Main\Models\Page;
use Main\Models\Service;
use Main\Models\Work;
use Carbon\Carbon;
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
            'work' => $this->parseMarkdownFile("content/blocks/work.md"),
            'social' => $this->parseMarkdownFile("content/blocks/social.md"),
            'about' => $this->parseMarkdownFile("content/blocks/about.md"),
            'contact' => $this->parseMarkdownFile("content/blocks/contact.md"),
            'site_techniques' => $this->parseMarkdownFile("content/blocks/site_techniques.md")
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
    private function getContent(string $path, int $amount): array {
        $parser = new \Parsedown();
        $path = resource_path($path);
        $paths = glob($path);
        if($amount === 0) {
            $filenames = $paths;
        } else {
            $filenames = array_splice($paths, -$amount, $amount);
        }
        $strings = [];
        foreach($filenames as $filename) {
            if(File::isFile($filename)) {
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
     * @param string $path
     * @return string
     */
    private function parseMarkdownFile(string $path): string
    {
        $parser = new \Parsedown();
        $filename = resource_path($path);
        $text = File::get($filename);

        return $parser->parse($text);
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
            'content' => $this->parseMarkdownFile("content/blocks/work-page.md"),
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
        $content = $this->getContent("content/work/{$slug}.md", 1)[0];

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
            $return[] = $item->$attribute;
        }
        return $return;
    }

    /**
     * @param string $string
     * @param string $tagname
     * @param string $source
     * @return array
     */
    function getTagAttribute(string $string, string $tagname, string $source): array
    {
        $d = new \DOMDocument();
        $d->loadHTML($string);
        $return = array();
        foreach ($d->getElementsByTagName($tagname) as $item) {
            $return[] = $item->getAttribute($source);
        }
        return $return;
    }

    private function getThumbnailFromPath(string $path, int $width = 300): string
    {
        $basename = basename($path);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $filename = str_replace(".{$extension}", "", $basename);

        return "{$filename}_w{$width}.{$extension}";
    }

    public function articles()
    {
        $articles = collect(
            json_decode(
                File::get(
                    resource_path("content/articles/metadata.json")
                )
            )
        )
            ->sortByDesc('postDate')
            ->values()
            ->map(function ($article) {
                $content = $this->parseMarkdownFile("content/articles/{$article->filename}");

                if (strlen($content) > 0) {
                    $title = $this->getTextBetweenTags($content, 'h1');
                    $image = $this->getTagAttribute($content, 'img', 'src');

                    $article->title = isset($title[0]) ? $title[0] : "Untitled article";
                    $article->image = isset($image[0]) ? $image[0] : "";
                    $article->thumbnail = "/images/articles/{$this->getThumbnailFromPath($article->image)}";
                }

                $article->content = $content;
                $article->slug = str_replace(".md", "", $article->filename);

                $article->postDate = Carbon::createFromFormat("Y-m-d", $article->postDate)->format("F jS, Y");
                return $article;
            });

        return view('public.articles', [
            'content' => $this->parseMarkdownFile("content/blocks/articles.md"),
            'articles' => $articles,
            'page' => $this->tagsParser->getTagsForPageName('articles')
        ]);
    }

    public function viewArticle(string $slug)
    {
        $article = collect(
            json_decode(
                File::get(
                    resource_path("content/articles/metadata.json")
                )
            )
        )
            ->filter(function ($article) use ($slug) {
                return $article->filename === "{$slug}.md";
            })
            ->values()
            ->map(function ($article) {
                $content = $this->parseMarkdownFile("content/articles/{$article->filename}");

                $article->content = $content;

                $article->postDate = Carbon::createFromFormat("Y-m-d", $article->postDate)->format("F jS, Y");
                return $article;
            })
            ->first();

        return view('public.view-article', [
            'article' => $article
        ]);
    }
}
