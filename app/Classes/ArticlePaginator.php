<?php

namespace Main\Classes;

use Illuminate\Pagination\LengthAwarePaginator;

class ArticlePaginator extends LengthAwarePaginator
{
    /**
     * Get the URL for a given page number.
     *
     * @param  int  $page
     * @return string
     */
    public function url($page)
    {
        if ($page <= 0) {
            $page = 1;
        }

        return route('articles', [
            'page' => $page === 1 ? null : $page,
            'q' => $this->getOptions()['q']
        ], false);
    }
}