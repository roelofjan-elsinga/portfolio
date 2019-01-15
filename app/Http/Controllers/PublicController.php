<?php

namespace Main\Http\Controllers;

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

class PublicController extends Controller {

    public function __construct() {
        parent::__construct();

        View::share('page', $this->tagsParser->getTagsForPageName('home'));
    }

    public function index(){
        return view('public.index', [
            'works' => $this->getContent("content/work/snippets/*", 4),
            'work' => $this->parseMarkdownFile("content/blocks/work.md"),
            'social' => $this->parseMarkdownFile("content/blocks/social.md"),
            'about' => $this->parseMarkdownFile("content/blocks/about.md"),
            'contact' => $this->parseMarkdownFile("content/blocks/contact.md")
        ]);
    }

    private function getContent($path, $amount) {
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

    private function parseMarkdownFile($path) {
        $parser = new \Parsedown();
        $filename = resource_path($path);
        $text = File::get($filename);

        return $parser->parse($text);
    }

    public function contact(Request $request){
		if(strlen($request->validation) === 3) {
			$data = ['request' => $request];
			Mail::send('emails.contact', $data, function($message) use ($data) {
				$message->from('system@roelofjanelsinga.nl', 'Roelof Jan Elsinga')
					->to('roelofjanelsinga@gmail.com')
					->subject('Form submission');
			});
		}
        return redirect()->back();
    }

    public function work() {
        return view('public.work', [
            'content' => $this->parseMarkdownFile("content/blocks/work-page.md"),
            'works' => $this->getContent("content/work/snippets/*", 0),
            'page' => $this->tagsParser->getTagsForPageName('work')
        ]);
    }

    public function workDetail($slug) {
        $content = $this->getContent("content/work/{$slug}.md", 1)[0];

        if(!isset($content['text'])) {
            return redirect()->route('public.work');
        }

        return view('public.workdetail', [
            'title' => ucfirst(str_replace("-", " ", $slug)),
            'work' => $content['text'],
            'page' => Page::where('name', 'work')->first()
        ]);
    }

    private function getTextBetweenTags($string, $tagname, $attribute = 'textContent'){
        $d = new \DOMDocument();
        $d->loadHTML($string);
        $return = array();
        foreach($d->getElementsByTagName($tagname) as $item){
            $return[] = $item->$attribute;
        }
        return $return;
    }

    function getTagAttribute($string, $tagname, $source){
        $d = new \DOMDocument();
        $d->loadHTML($string);
        $return = array();
        foreach($d->getElementsByTagName($tagname) as $item){
            $return[] = $item->getAttribute($source);
        }
        return $return;
    }

    private function getThumbnailFromPath(string $path, int $width = 300): string {
        $basename = basename($path);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $filename = str_replace(".{$extension}", "", $basename);

        return "{$filename}_w{$width}.{$extension}";
    }

    public function articles() {
        $articles = collect(
            json_decode(
                File::get(
                    resource_path("content/articles/metadata.json")
                )
            )
        )
            ->sortByDesc('postDate')
            ->values()
            ->map(function($article) {
                $content = $this->parseMarkdownFile("content/articles/{$article->filename}");

                if(strlen($content) > 0) {
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

    public function viewArticle(string $slug) {
        $article = collect(
            json_decode(
                File::get(
                    resource_path("content/articles/metadata.json")
                )
            )
        )
            ->filter(function($article) use ($slug) {
                return $article->filename === "{$slug}.md";
            })
            ->values()
            ->map(function($article) {
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
