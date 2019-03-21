<?php

namespace Main\Classes;

use Illuminate\Support\Facades\File;

class Markdown
{
    public static function parseResourcePath(string $path): string
    {
        $parser = new \Parsedown();
        $filename = resource_path($path);
        $text = File::get($filename);

        return $parser->parse($text);
    }
}
