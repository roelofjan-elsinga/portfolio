<?php

namespace Tests;

use AloiaCms\Models\Article;
use AloiaCms\Models\MetaTag;
use Main\Models\Work;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ViewsTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testHomepageLoads()
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

        $this
            ->get(route('public.open_source'))
            ->assertViewIs('public.open_source')
            ->assertOk();
    }

    public function testArticlesPageLoads()
    {
        MetaTag::find('articles')
            ->setMatter([
                'title' => 'Title',
                'description' => "Description",
                'author' => 'Author',
                'image_url' => 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg',
            ])
            ->save();

        $this
            ->get('/articles')
            ->assertViewIs('public.articles')
            ->assertOk();
    }

    public function testPassionsPageLoads()
    {
        $this
            ->get('/passions')
            ->assertRedirect('/articles');
    }

    public function testPortfolioPageLoads()
    {
        MetaTag::find('work')
            ->setMatter([
                'title' => 'Title',
                'description' => "Description",
                'author' => 'Author',
                'image_url' => 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg',
            ])
            ->save();

        $this
            ->get('/portfolio')
            ->assertOk();
    }

    public function testViewArticleLoads()
    {
        $this->withoutExceptionHandling();

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

    public function testViewPassionLoads()
    {
        $this
            ->get('/passions/plants-in-my-living-space')
            ->assertRedirect('/articles/plants-in-my-living-space');
    }

    public function testViewPortfolioLoads()
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

    public function testViewNonExistentArticleReturns404()
    {
        $this->expectException(NotFoundHttpException::class);
        $this->withoutExceptionHandling();

        $this
            ->get('/articles/the-post-i-never-wrote');
    }

    public function testViewNonExistentPortfolioReturns404()
    {
        $this->expectException(NotFoundHttpException::class);
        $this->withoutExceptionHandling();

        $this
            ->get('/portfolio/a-company-i-dont-like');
    }
}
