<?php

namespace Main\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Main\Http\Requests;
use Main\Http\Controllers\Controller;
use Main\Models\Service;

class ServiceController extends Controller{
    private $service;

    public function __construct(){
        parent::__construct();
        $this->service = new Service;
        View::share('pagetitle', 'Services');
    }

    public function index(){
        return view('dashboard.service.index', [
            'services' => Service::all()
        ]);
    }

    public function create(){
        return view('dashboard.service.edit');
    }

    public function store(Request $request){
        $this->service->fill($request->all())->save();
        return redirect()->route('service.index');
    }

    public function show($id){
        //
    }

    public function edit($id){
        return view('dashboard.service.edit', [
            'service' => Service::find($id)
        ]);
    }

    public function update(Request $request, $id){
        $this->service = Service::find($id);
        $this->service->fill($request->all())->save();
        return redirect()->route('service.index');
    }

    public function destroy($id){
        Service::destroy($id);
        return redirect()->route('service.index');
    }
}
