<?php

namespace Tests;

class ViewsTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testHomepageLoads()
    {
        $this->get('/')
             ->assertOk();
    }

    public function testArticlesPageLoads()
    {
        $this->get('/articles')
            ->assertOk();
    }

    public function testPassionsPageLoads()
    {
        $this->get('/passions')
            ->assertRedirect('/articles');
    }

    public function testPortfolioPageLoads()
    {
        $this->get('/portfolio')
            ->assertOk();
    }

    public function testViewArticleLoads()
    {
        $this->get('/articles/company-culture')
            ->assertOk();
    }

    public function testViewPassionLoads()
    {
        $this->get('/passions/plants-in-my-living-space')
            ->assertRedirect('/articles/plants-in-my-living-space');
    }

    public function testViewPortfolioLoads()
    {
        $this->get('/portfolio/punchlisthero')
            ->assertOk();
    }

    public function testViewNonExistentArticleReturns404()
    {
        $this->get('/articles/the-post-i-never-wrote')
            ->assertNotFound();
    }

    public function testViewNonExistentPassionReturns404()
    {
        $this->get('/passions/working-too-hard')
            ->assertRedirect('/articles/working-too-hard');
    }

    public function testViewNonExistentPortfolioReturns404()
    {
        $this->get('/portfolio/a-company-i-dont-like')
            ->assertNotFound();
    }
}
