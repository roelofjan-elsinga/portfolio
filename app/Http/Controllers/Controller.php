<?php

namespace Main\Http\Controllers;

use AloiaCms\Models\MetaTag;
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

    /**
     * Convert an array to a stdClass.
     *
     * @param array $input
     *
     * @return \stdClass
     */
    protected function arrayToClass(array $input)
    {
        $class = new \stdClass();

        foreach ($input as $key => $value) {
            $class->{$key} = $value;
        }

        return $class;
    }
}
