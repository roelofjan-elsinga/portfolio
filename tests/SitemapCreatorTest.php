<?php


namespace Tests;

use Illuminate\Support\Facades\Config;
use org\bovigo\vfs\vfsStream;

class SitemapCreatorTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $path = vfsStream::url('root/content/test');

        if (!is_dir($path)) {
            mkdir($path);
        }

        Config::set('flatfilecms-publish.site_url', 'http://localhost');
        Config::set('flatfilecms-publish.sitemap_file_path', $path . '/sitemap-original.xml');
        Config::set('flatfilecms-publish.sitemap_target_file_path', $path . '/sitemap.xml');
    }

    public function test_portfolio_items_are_added_to_sitemap()
    {
        $this->assertFalse(file_exists(Config::get('flatfilecms-publish.sitemap_file_path')));
        $this->assertFalse(file_exists(Config::get('flatfilecms-publish.sitemap_target_file_path')));

        $this
            ->artisan('flatfilecms:publish:sitemap')
            ->assertExitCode(0);

        $this->assertTrue(file_exists(Config::get('flatfilecms-publish.sitemap_file_path')));
        $this->assertTrue(file_exists(Config::get('flatfilecms-publish.sitemap_target_file_path')));
    }
}
