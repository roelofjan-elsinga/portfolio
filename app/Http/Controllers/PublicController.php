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
        $text = $this->parseMarkdownFile("content/blocks/about.md");

        dd($text);

        return view('public.index', [
            'works' => Work::orderBy('id', 'asc')->take(4)->get(),
            'worksCount' => Work::count(),
            'services' => Service::all(),
            'home' => Page::where('name', 'home')->first(),
            'work' => Page::where('name', 'work')->first(),
            'service' => Page::where('name', 'service')->first(),
            'about' => Page::where('name', 'about')->first(),
            'contact' => Page::where('name', 'contact')->first(),
            'footer' => Page::where('name', 'footer')->first()
        ]);
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
            'works' => Work::orderBy('id', 'asc')->get(),
            'page' => Page::where('name', 'work')->first()
        ]);
    }

    public function workDetail($slug) {
        return view('public.workdetail', [
            'work' => Work::where('slug', $slug)->first(),
            'page' => Page::where('name', 'work')->first()
        ]);
    }
}
