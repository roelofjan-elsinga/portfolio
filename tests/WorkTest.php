<?php


namespace Tests;

use Main\Models\Work;

class WorkTest extends TestCase
{
    public function test_work_model_can_be_interacted_with()
    {
        $work = Work::find('testing')
            ->setMatter([
                'image_url' => 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg',
                'image_alt' => 'Logo banner',
                'title' => 'Testing',
                'description' => 'Description',
                'url' => '/testing'
            ])
            ->setBody('# Testing')
            ->save();

        $this->assertSame('Testing', $work->keywords());
        $this->assertSame('Roelof Jan Elsinga', $work->author());
        $this->assertSame('https://roelofjanelsinga.com/images/logo/logo_banner.jpg', $work->thumbnail());
        $this->assertSame('https://roelofjanelsinga.com/images/logo/logo_banner.jpg', $work->image());
    }
}
