<?php

namespace Tests;

use Illuminate\Foundation\Mix;
use Illuminate\Support\Facades\Config;
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
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->swap(Mix::class, new MockMix());

        $this->fs = vfsStream::setup('root', 0777, [
            'content' => [
                'pages' => []
            ]
        ]);

        Config::set('flatfilecms.pages.file_path', "{$this->fs->getChild('content')->url()}/pages.json");
        Config::set('flatfilecms.pages.folder_path', "{$this->fs->getChild('content')->url()}/pages");
        Config::set('flatfilecms.taxonomy.file_path', "{$this->fs->getChild('content')->url()}/taxonomy.json");
    }
}
