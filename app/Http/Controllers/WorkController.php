<?php

namespace Main\Http\Controllers;

use Eventviva\ImageResize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Main\Http\Requests;
use Main\Http\Controllers\Controller;
use Main\Models\Page;
use Main\Models\Work;

class WorkController extends Controller{

    private $work;

    public function __construct() {
        parent::__construct();
        $this->work = new Work;
        View::share('pagetitle', 'Work');
    }

    public function index(){
        return view('dashboard.work.index', [
            'works' => Work::all()
        ]);
    }

    public function create(){
        return view('dashboard.work.edit');
    }

    public function store(Request $request){
        $this->work->fill($request->all());
        $this->work->link = (parse_url($request->website, PHP_URL_SCHEME) ? '' : 'http://') . $request->link;
        if(Input::hasFile('image')) {
            if(Input::hasFile('image')) {
                $this->uploadImage(Input::file('image'));
            }
        }
        $this->work->save();
        return redirect()->route('work.index');
    }

    public function show($id){
        //
    }

    public function edit($id){
        return view('dashboard.work.edit', [
            'work' => Work::find($id)
        ]);
    }

    public function update(Request $request, $id){
        $this->work = Work::find($id);
        $this->work->fill($request->all());
        $this->work->link = (parse_url($request->website, PHP_URL_SCHEME) ? '' : 'http://') . $request->link;
        if(Input::hasFile('image')) {
            File::delete(public_path('images/work/'.$this->work->image_large));
            File::delete(public_path('images/work/'.$this->work->image_small));
            $this->uploadImage(Input::file('image'));
        }
        $this->work->save();
        return redirect()->route('work.index');
    }

    public function destroy($id){
        $this->work = Work::find($id);
        if($this->work->image_large != null) {
            File::delete(public_path('images/work/'.$this->work->image_large));
            File::delete(public_path('images/work/'.$this->work->image_small));
        }
        Work::destroy($id);
        return redirect()->back();
    }

    private function uploadImage($file) {
        $destinationPath = public_path('/images/work/');
        $image = new ImageResize($file->getPathName());

        $image->resizeToBestFit(1920, 1080);
        $filename = $this->makeImageNameUnique($file, '1920x1080');
        $image->save($destinationPath . $filename, IMAGETYPE_JPEG);
        $this->work->image_full = $filename;

        $image->crop(500, 500);
        $filename = $this->makeImageNameUnique($file, '500x500');
        $image->save($destinationPath . $filename, IMAGETYPE_JPEG);
        $this->work->image_large = $filename;

        $image->crop(100, 100);
        $filename = $this->makeImageNameUnique($file, '100x100');
        $image->save($destinationPath . $filename, IMAGETYPE_JPEG);
        $this->work->image_small = $filename;
    }

    private function makeImageNameUnique($file, $res) {
        $image = $file->getClientOriginalName();
        $img_name = strtolower(pathinfo($image, PATHINFO_FILENAME)) . '_' . $res . '_' . time();
        $img_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        return $img_name . '.' . $img_ext;
    }
}
