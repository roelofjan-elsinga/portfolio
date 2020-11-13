<?php

namespace Main\Models;

class ContentBlock extends \AloiaCms\Models\ContentBlock
{
    /**
     * Serve as an entry for Facade usage
     *
     * @param string $block_name
     * @return string
     */
    public function get(string $block_name): string
    {
        if (app()->getLocale() !== config('app.default_locale')) {
            $original_name = $block_name;
            $block_name = $block_name . '_' . app()->getLocale();
        }

        $instance = self::find($block_name);

        if (!$instance->exists() && isset($original_name)) {
            $instance = self::find($original_name);
        }

        return $instance->body();
    }
}
