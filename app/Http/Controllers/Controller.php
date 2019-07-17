<?php

namespace Main\Http\Controllers;

use FlatFileCms\Page;
use FlatFileCms\TagsParser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;

    protected $tagsParser;

    public function __construct()
    {
        $this->tagsParser = new TagsParser();
        View::share('page', $this->tagsParser->getTagsForPageName('home'));
        View::share('pages', Page::all()->filter(function (Page $page) {
            return $page->isPublished() && $page->isInMenu();
        }));
    }
}
