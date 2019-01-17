<?php

namespace Main\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Main\Classes\TagsParser;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $tagsParser;

    public function __construct()
    {
        $this->tagsParser = new TagsParser();
    }
}
