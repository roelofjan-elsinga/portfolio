<?php

namespace Main\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Main\Http\Requests;
use Main\Http\Controllers\Controller;
use Main\Models\Page;

class DashboardController extends Controller{

    public function __construct(){
        View::share('pagetitle', 'Dashboard');
    }

    public function index(){
        return view('dashboard.index', [
            'home' => Page::where('name', 'home')->first(),
            'work' => Page::where('name', 'work')->first(),
            'service' => Page::where('name', 'service')->first(),
            'about' => Page::where('name', 'about')->first(),
            'contact' => Page::where('name', 'contact')->first(),
            'footer' => Page::where('name', 'footer')->first()
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
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }
}
