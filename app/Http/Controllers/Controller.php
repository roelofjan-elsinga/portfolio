<?php

namespace Main\Http\Controllers;

use FlatFileCms\Models\MetaTag;
use FlatFileCms\TagsParser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;

    public function __construct()
    {
        View::share('page', MetaTag::find('home'));
    }
}
