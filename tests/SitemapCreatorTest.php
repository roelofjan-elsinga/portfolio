<?php


namespace Tests;

use Illuminate\Support\Facades\Config;

class SitemapCreatorTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        if (!is_dir(__DIR__.'/test')) {
            mkdir(__DIR__.'/test');
        }

        Config::set('flatfilecms-publish.site_url', 'http://localhost');
        Config::set('flatfilecms-publish.sitemap_file_path', __DIR__.'/test/sitemap-original.xml');
        Config::set('flatfilecms-publish.sitemap_target_file_path', __DIR__.'/test/sitemap.xml');
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->recursively_remove_directory(__DIR__.'/test');
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
