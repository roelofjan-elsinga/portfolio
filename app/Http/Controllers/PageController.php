<?php

namespace Main\Http\Controllers;

use FlatFileCms\Page;
use FlatFileCms\Taxonomy\Taxonomy;
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
        $page = Page::forSlug($slug, true);

        if (is_null($page)) {
            $redirect = $this->getRedirectResponseForPage($slug);

            if (!is_null($redirect)) {
                return $redirect;
            }

            abort(404);
        }

        return view('public.view-page', [
            'page' => $page,
        ]);
    }

    /**
     * Determine whether the request URL can be redirected to the proper nested URL.
     *
     * @param string $slug
     *
     * @return RedirectResponse|null
     */
    private function getRedirectResponseForPage(string $slug): ?RedirectResponse
    {
        $page = Page::forSlug($slug);

        if (!is_null($page)) {
            $taxonomy = Taxonomy::byName($page->category());

            if (is_null($taxonomy)) {
                return null;
            }

            return redirect()->to("{$taxonomy->fullUrl()}/{$slug}", 301);
        }

        return null;
    }
}
