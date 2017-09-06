<?php

namespace Main\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Main\Http\Requests;
use Main\Http\Controllers\Controller;
use Main\Models\Page;

class PageController extends Controller{

    public function __construct(){
        View::share('pagetitle', 'Dashboard');
    }

    public function index(){
        return view('dashboard.content.index', [
            'pages' => Page::all()
        ]);
    }

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        //
    }

    public function edit($id){
        return view('dashboard.content.edit', [
            'page' => Page::find($id),
            'pagetitle' => 'Edit content'
        ]);
    }

    public function update(Request $request, $id){
        $page = Page::find($id);
        $page->fill($request->all())->save();
        return redirect()->back();
    }

    public function destroy($id){
        //
    }
}
