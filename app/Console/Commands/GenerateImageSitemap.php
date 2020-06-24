<?php

namespace Main\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Main\Models\Article;
use SimpleXMLElement;

class GenerateImageSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:image-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an image sitemap';

    private string $sitemap_image = 'http://www.google.com/schemas/sitemap-image/1.1';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $xml = new Simphttps://roelofjanelsinga.com/images.xmlleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset></urlset>', null, false);

        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        $url_base = config('view.canonical.destination');

        Article::published()
            ->each(function (Article $article) use ($xml, $url_base) {
                $slug = route('articles.view', $article->filename(), false);

                $url = $xml->addChild('url');
                $url->addChild('loc', "{$url_base}{$slug}");

                foreach ($article->images() as $img) {
                    $image = $url->addChild('image:image', null, $this->sitemap_image);
                    $image->addChild('image:loc', $url_base.$img['url'], $this->sitemap_image);

                    if (!is_null($img['alt'])) {
                        $image->addChild('image:caption', $img['alt'], $this->sitemap_image);
                        $image->addChild('image:title', $img['alt'], $this->sitemap_image);
                    }
                }
            });

        $this->info("Generated images sitemap");

        Storage::put('images.xml', $xml->asXML());

        $this->info("Saved images sitemap");

        if (!File::exists(public_path('images.xml'))) {
            File::link(storage_path('app/images.xml'), public_path('images.xml'));
            $this->info("Created symlink for images sitemap");
        }
    }
}
