<?php

namespace Main\Classes;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class Metadata
{
    public static function forPath(string $path = 'articles'): Collection
    {
        if ($path === 'articles') {
            return collect(
                json_decode(
                    File::get(
                        config('flatfilecms.articles.file_path')
                    )
                )
            );
        }

        return collect(
            json_decode(
                File::get(
                    resource_path("content/{$path}/metadata.json")
                )
            )
        );
    }
}
