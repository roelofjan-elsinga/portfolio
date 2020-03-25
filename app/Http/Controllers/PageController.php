<?php

namespace Main\Http\Controllers;

use AloiaCms\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PageController
{
    /**
     * Show the requested page or return 404.
     *
     * @param string $slug
     *
     * @return Response|RedirectResponse
     */
    public function showPage(string $slug)
    {
        $page = Page::find($slug);

        if (!$page->exists()) {
            $page = Page::published()
                ->filter(function (Page $page) use ($slug) {
                    return $page->url() === $slug;
                })
                ->first();

            if (is_null($page)) {
                abort(404);
            }
        }

        $slug_matches_url = $page->url() === $slug || $page->url() === "/{$slug}";

        if (!$slug_matches_url) {
            return redirect()->route('page', $page->url());
        }

        return view('public.view-page', [
            'page' => $page,
        ]);
    }
}
