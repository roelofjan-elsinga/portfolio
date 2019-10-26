<?php


namespace Tests;

class ResumeTest extends TestCase
{
    public function test_can_view_resume()
    {
        $this
            ->get(route('resume.show'))
            ->assertViewIs('resume.show')
            ->assertOk();
    }
}
