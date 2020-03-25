<?php

namespace Tests;

use AloiaCms\Models\Article;
use AloiaCms\Models\MetaTag;
use Main\Models\OpenSource;
use Main\Models\Work;

class ViewsTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_homepage_loads()
    {
        MetaTag::find('home')
            ->setMatter([
                'title' => 'Title',
                'description' => "Description",
                'author' => 'Author',
                'image_url' => 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg',
            ])
            ->save();

        $this->withoutExceptionHandling();

        $this
            ->get('/')
            ->assertViewIs('public.index')
            ->assertOk();
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_homepage_loads_with_data()
    {
        MetaTag::find('home')
            ->setMatter([
                'title' => 'Title',
                'description' => "Description",
                'author' => 'Author',
                'image_url' => 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg',
            ])
            ->save();

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

        OpenSource::find('testing')
            ->setMatter([
                'name' => 'testing',
                'github_url' => 'https://github.com/roelofjan-elsinga/portfolio',
                'description' => 'Description',
                'featured' => true,
                'publish_date' => '2020-01-01'
            ])
            ->save();

        Article::find('testing')
            ->setMatter([
                'is_scheduled' => false,
                'is_published' => true,
                'url' => 'testing',
            ])
            ->setBody('# Testing')
            ->setPostDate(now())
            ->save();

        $this->withoutExceptionHandling();

        $this
            ->get('/')
            ->assertViewIs('public.index')
            ->assertOk();
    }

    public function test_open_source_page_loads()
    {
        MetaTag::find('open_source')
            ->setMatter([
                'title' => 'Title',
                'description' => "Description",
                'author' => 'Author',
                'image_url' => 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg',
            ])
            ->save();

        OpenSource::find('testing')
            ->setMatter([
                'name' => 'testing',
                'github_url' => 'https://github.com/roelofjan-elsinga/portfolio',
                'description' => 'Description',
                'featured' => true,
                'publish_date' => '2020-01-01'
            ])
            ->save();

        $this
            ->get(route('public.open_source'))
            ->assertViewIs('public.open_source')
            ->assertOk();
    }

    public function test_articles_page_loads()
    {
        MetaTag::find('articles')
            ->setMatter([
                'title' => 'Title',
                'description' => "Description",
                'author' => 'Author',
                'image_url' => 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg',
            ])
            ->save();

        Article::find('testing')
            ->setMatter([
                'is_scheduled' => false,
                'is_published' => true,
                'url' => 'testing',
            ])
            ->setBody('# Testing')
            ->setPostDate(now())
            ->save();

        $this
            ->get('/articles')
            ->assertViewIs('public.articles')
            ->assertOk();
    }

    public function test_passions_page_loads()
    {
        $this
            ->get('/passions')
            ->assertRedirect('/articles');
    }

    public function test_portfolio_page_loads()
    {
        MetaTag::find('work')
            ->setMatter([
                'title' => 'Title',
                'description' => "Description",
                'author' => 'Author',
                'image_url' => 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg',
            ])
            ->save();

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

        $this
            ->get('/portfolio')
            ->assertOk();
    }

    public function test_view_article_loads()
    {
        Article::find('testing')
            ->setMatter([
                'is_scheduled' => false,
                'is_published' => true,
                'url' => 'testing',
            ])
            ->setBody('# Testing')
            ->setPostDate(now())
            ->save();

        $this
            ->get('/articles/testing')
            ->assertViewIs('public.view-article')
            ->assertOk();
    }

    public function test_view_passion_gets_redirected_to_articles()
    {
        $this
            ->get('/passions/plants-in-my-living-space')
            ->assertRedirect('/articles/plants-in-my-living-space');
    }

    public function test_view_portfolio_loads()
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

        $this
            ->get('/portfolio/testing')
            ->assertViewIs('public.workdetail')
            ->assertOk();
    }

    public function test_view_non_existent_article_returns_404()
    {
        $this->create404Tags();
        $this
            ->get('/articles/the-post-i-never-wrote')
            ->assertNotFound();
    }

    public function test_view_non_existent_portfolio_returns_404()
    {
        $this->create404Tags();

        $this
            ->get('/portfolio/a-company-i-dont-like')
            ->assertNotFound();
    }
}
