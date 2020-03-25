<?php

namespace Main\Console\Commands;

use Main\Models\Work;
use SitemapGenerator\SitemapGenerator;

class SitemapCreator extends \AloiaCms\Publish\Console\SitemapCreator
{
    /**
     * Overwrite the base implementation and add additional URL's.
     *
     * @param SitemapGenerator $generator
     */
    protected function appendAdditionalUrls(SitemapGenerator $generator): void
    {
        $generator->add('/portfolio', 0.9, $this->lastmod, 'monthly');

        foreach ($this->getPortfolioUrls() as $url) {
            $generator->add($url, 0.8, $this->lastmod, 'monthly');
        }
    }

    /**
     * Get the urls of the portfolio items.
     *
     * @return array
     */
    private function getPortfolioUrls(): array
    {
        return Work::all()
            ->map(function (Work $work) {
                return $work->url;
            })
            ->toArray();
    }
}
