<?php

namespace Main\Models;

use AloiaCms\Models\Model;

class Tag extends Model
{
    protected $folder = 'tags';

    protected $required_fields = [
        'name',
    ];

    public function attachArticle(string $article_slug): Tag
    {
        $attached_articles = $this->get('articles') ?? [];

        if (!in_array($article_slug, $attached_articles)) {
            $attached_articles[] = $article_slug;

            $this->set('articles', $attached_articles)->save();
        }

        return $this;
    }

    public function detachArticle(string $article_slug): Tag
    {
        $attached_articles = $this->get('articles') ?? [];

        if (in_array($article_slug, $attached_articles)) {
            $attached_articles = array_values(
                array_filter($attached_articles, fn ($slug) => $slug !== $article_slug)
            );

            $this->set('articles', $attached_articles)->save();
        }

        return $this;
    }
}