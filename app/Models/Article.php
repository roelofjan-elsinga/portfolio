<?php

namespace Main\Models;

use DOMDocument;

class Article extends \AloiaCms\Models\Article
{
    public function images(): array
    {
        $document = new DOMDocument();

        $document->loadHTML($this->body());

        $nodes = $document->getElementsByTagName('img');

        $images = [];

        foreach ($nodes as $image) {
            $images[] = [
                'url' => $image->getAttribute('src'),
                'alt' => trim($image->getAttribute('alt'), "\"")
            ];
        }

        return $images;
    }
}
