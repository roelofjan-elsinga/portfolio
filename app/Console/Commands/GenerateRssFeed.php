<?php

namespace Main\Console\Commands;

use DOMDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use XSLTProcessor;

class GenerateRssFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:rss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate RSS feed from Atom feed';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $chan = new DOMDocument();
        $chan->load(Config::get('aloiacms-publish.atom_file_path'));

        $sheet = new DOMDocument();
        $stylesheet_path = __DIR__ . '/../../../vendor/roelofjan-elsinga/aloia-cms-publish/resources/atom2rss.xsl';
        $sheet->load($stylesheet_path);

        $processor = new XSLTProcessor();
        $processor->registerPHPFunctions();
        $processor->importStylesheet($sheet);

        file_put_contents(
            Config::get('aloiacms-publish.rss_file_path'),
            $processor->transformToXML($chan)
        );
    }
}
