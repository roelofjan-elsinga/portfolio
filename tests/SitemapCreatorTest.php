<?php


namespace Tests;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Main\Models\Work;
use org\bovigo\vfs\vfsStream;

class SitemapCreatorTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('sitemap');

        $path = storage_path('framework/testing/disks/sitemap');

        Config::set('aloiacms-publish.site_url', 'http://localhost');
        Config::set('aloiacms-publish.sitemap_file_path', $path . '/sitemap-original.xml');
        Config::set('aloiacms-publish.sitemap_target_file_path', $path . '/sitemap.xml');
    }

    public function test_portfolio_items_are_added_to_sitemap()
    {
        Work::find('testing')
            ->setMatter([
                'image_url' => 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg',
                'image_alt' => 'Logo banner',
                'title' => 'Testing',
                'description' => 'Description',
                'url' => '/testing'
            ])
            ->setBody('# Testing')
            ->save();

        Storage::disk('sitemap')->assertMissing(['sitemap-original.xml', 'sitemap.xml']);

        $this
            ->artisan('aloiacms:publish:sitemap')
            ->assertExitCode(0);

        Storage::disk('sitemap')->assertExists(['sitemap-original.xml', 'sitemap.xml']);
    }
}
