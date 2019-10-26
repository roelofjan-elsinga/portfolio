<?php


namespace Tests;

use FlatFileCms\Page;
use FlatFileCms\Taxonomy\Taxonomy;
use Illuminate\Support\Collection;
use org\bovigo\vfs\vfsStream;

class PageTest extends TestCase
{
    public function test_existing_page_can_be_displayed()
    {
        Page::update(
            Collection::make([
                [
                    'title' => 'Homepage title',
                    'description' => 'Homepage description',
                    'summary' => 'Homepage summary',
                    'template_name' => 'template',
                    'isPublished' => true,
                    'isScheduled' => false,
                    'filename' => 'testing.md',
                    'postDate' => date('Y-m-d'),
                ]
            ])
        );

        file_put_contents(vfsStream::url('root/content/pages/testing.md'), '# Testing');

        $this
            ->get(route('page', 'testing'))
            ->assertViewIs('public.view-page')
            ->assertOk();
    }

    public function test_non_existing_page_returns_404()
    {
        $this
            ->get(route('page', 'testing'))
            ->assertStatus(404);
    }

    public function test_partial_slug_is_redirected_to_full_url()
    {
        Page::update(
            Collection::make([
                [
                    'title' => 'Homepage title',
                    'description' => 'Homepage description',
                    'summary' => 'Homepage summary',
                    'template_name' => 'template',
                    'isPublished' => true,
                    'isScheduled' => false,
                    'filename' => 'testing.md',
                    'postDate' => date('Y-m-d'),
                    'category' => 'static'
                ]
            ])
        );

        Taxonomy::addChildToCategoryWithName('home', [
            'category_name' => 'static',
            'category_url_prefix' => 'static'
        ]);

        file_put_contents(vfsStream::url('root/content/pages/testing.md'), '# Testing');

        $this
            ->get(route('page', 'testing'))
            ->assertRedirect('static/testing');
    }

    public function test_page_with_non_existent_taxonomy_is_treated_as_home_category()
    {
        Page::update(
            Collection::make([
                [
                    'title' => 'Homepage title',
                    'description' => 'Homepage description',
                    'summary' => 'Homepage summary',
                    'template_name' => 'template',
                    'isPublished' => true,
                    'isScheduled' => false,
                    'filename' => 'testing.md',
                    'postDate' => date('Y-m-d'),
                    'category' => 'pages'
                ]
            ])
        );

        file_put_contents(vfsStream::url('root/content/pages/testing.md'), '# Testing');

        $this
            ->get(route('page', 'testing'))
            ->assertViewIs('public.view-page')
            ->assertOk();
    }
}
