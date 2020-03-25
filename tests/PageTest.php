<?php


namespace Tests;

use AloiaCms\Models\Page;
use FlatFileCms\Taxonomy\Taxonomy;
use Illuminate\Support\Collection;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $this->expectException(NotFoundHttpException::class);
        $this->withoutExceptionHandling();

        $this->get(route('page', 'testing'));
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
}
