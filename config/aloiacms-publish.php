<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Flat File CMS Publish Atom feed file location
    |--------------------------------------------------------------------------
    |
    | This file path will be used to save the atom feed to an XML file
    |
    */

    'atom_file_path' => public_path('atom.xml'),

    /*
    |--------------------------------------------------------------------------
    | Flat File CMS Publish RSS feed file location
    |--------------------------------------------------------------------------
    |
    | This file path will be used to save the RSS feed to an XML file
    |
    */

    'rss_file_path' => public_path('rss.xml'),

    /*
    |--------------------------------------------------------------------------
    | Flat File CMS Publish Sitemap file location
    |--------------------------------------------------------------------------
    |
    | This file path will be used to save the sitemap to an XML file
    |
    */

    'sitemap_file_path' => public_path('sitemap.xml'),

    /*
    |--------------------------------------------------------------------------
    | Flat File CMS Publish Sitemap target file path
    |--------------------------------------------------------------------------
    |
    | This target file path will be used to create a symlink for the original
    | version to the target location.
    |
    */

    'sitemap_target_file_path' => public_path('sitemap.xml'),

];
