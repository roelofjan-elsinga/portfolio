<?php

namespace Tests;

use AloiaCms\Models\MetaTag;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Mix;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use Tests\Mocks\MockMix;

class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * @var  vfsStreamDirectory
     */
    protected $fs;

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->swap(Mix::class, new MockMix());

        $this->fs = vfsStream::setup('root', 0777, [
            'content' => [
                'pages' => []
            ],
            'collections' => []
        ]);

        Config::set('aloiacms.collections_path', $this->fs->getChild('collections')->url());
        Config::set('aloiacms.pages.file_path', "{$this->fs->getChild('content')->url()}/pages.json");
        Config::set('aloiacms.pages.folder_path', "{$this->fs->getChild('content')->url()}/pages");
        Config::set('aloiacms.taxonomy.file_path', "{$this->fs->getChild('content')->url()}/taxonomy.json");
    }

    protected function create404Tags()
    {
        MetaTag::find('404')
            ->setMatter([
                'title' => 'Title',
                'description' => "Description",
                'author' => 'Author',
                'image_url' => 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg',
            ])
            ->save();
    }
}
