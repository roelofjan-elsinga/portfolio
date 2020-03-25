<?php


namespace Tests;

use AloiaCms\Models\Page;

class PageTest extends TestCase
{
    public function test_existing_page_can_be_displayed()
    {
        Page::find('testing')
            ->setExtension('md')
            ->setMatter([
                'title' => 'Homepage title',
                'description' => 'Homepage description',
                'summary' => 'Homepage summary',
                'template_name' => 'template',
                'is_published' => true,
                'is_scheduled' => false,
                'post_date' => date('Y-m-d'),
            ])
            ->setBody('# Testing')
            ->save();

        $this
            ->get(route('page', 'testing'))
            ->assertViewIs('public.view-page')
            ->assertOk();
    }

    public function test_non_existing_page_returns_404()
    {
        $this->create404Tags();

        $this
            ->get(route('page', 'testing'))
            ->assertNotFound();
    }

    public function test_partial_slug_is_redirected_to_full_url()
    {
        Page::find('testing')
            ->setExtension('md')
            ->setMatter([
                'title' => 'Homepage title',
                'description' => 'Homepage description',
                'summary' => 'Homepage summary',
                'template_name' => 'template',
                'is_published' => true,
                'is_scheduled' => false,
                'post_date' => date('Y-m-d'),
                'url' => 'static/testing'
            ])
            ->setBody('# Testing')
            ->save();

        $this
            ->get(route('page', 'testing'))
            ->assertRedirect('static/testing');
    }

    public function test_full_url_results_in_shown_page()
    {
        Page::find('testing')
            ->setExtension('md')
            ->setMatter([
                'title' => 'Homepage title',
                'description' => 'Homepage description',
                'summary' => 'Homepage summary',
                'template_name' => 'template',
                'is_published' => true,
                'is_scheduled' => false,
                'post_date' => date('Y-m-d'),
                'url' => 'static/testing'
            ])
            ->setBody('# Testing')
            ->save();

        $this
            ->get(route('page', 'static/testing'))
            ->assertViewIs('public.view-page')
            ->assertOk();
    }
}
