<?php

namespace Main\Models;

use AloiaCms\InlineBlockParser;
use DOMDocument;
use Illuminate\Support\Collection;
use ParsedownExtra;

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

    /**
     * Get the parse file body
     *
     * @return string
     */
    public function body(): string
    {
        if (!$this->parsed_body) {
            $this->parsed_body = (new InlineBlockParser)
                ->parseHtmlString(
                    (new ParseDownExtra())->parse($this->rawBody())
                );
        }

        return $this->parsed_body;
    }

    public function tags(): Collection
    {
        return Tag::all()
            ->filter(fn (Tag $tag) => in_array($this->filename(), $tag->get('articles') ?? []))
            ->values();
    }
}
