<?php

namespace Main\Console\Commands;

use SitemapGenerator\SitemapGenerator;
use Symfony\Component\Yaml\Yaml;

class SitemapCreator extends \FlatFileCms\Publish\Console\SitemapCreator
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
        $projects = Yaml::parseFile(resource_path('content/work/previews.yml'));

        return collect($projects['previews'])
            ->map(function ($preview) {
                return $preview['url'];
            })
            ->toArray();
    }
}
