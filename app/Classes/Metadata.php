<?php
/**
 * Created by PhpStorm.
 * User: roelof
 * Date: 16-2-19
 * Time: 17:48
 */

namespace Main\Classes;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Collection;

class Metadata
{
    public static function forPath(string $path = 'articles'): Collection
    {
        return collect(
            json_decode(
                File::get(
                    resource_path("content/{$path}/metadata.json")
                )
            )
        );
    }
}
