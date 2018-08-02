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

class PublicController extends Controller{
    public function __construct(){
        View::share('page', Page::where('name', 'home')->first());
    }

    public function index(){
        return view('public.index', [
            'works' => $this->getContent("content/work/snippets/*", 4),
            'home' => Page::where('name', 'home')->first(),
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
            'page' => Page::where('name', 'work')->first()
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
}
