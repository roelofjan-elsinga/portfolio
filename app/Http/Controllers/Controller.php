<?php

namespace Main\Http\Controllers;

use FlatFileCms\Page;
use FlatFileCms\TagsParser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;

    protected $tagsParser;

    public function __construct()
    {
        $this->tagsParser = new TagsParser();
        View::share('page', $this->tagsParser->getTagsForPageName('home'));
    }
}
