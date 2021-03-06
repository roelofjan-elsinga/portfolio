<?php

return [

    'permissions' => [

        /*
         * This value represents the user the webserver uses to serve the static files
         * */
        'user' => env('FILE_OWNER', 'www-data'),

        /*
         * This value represents the user group the webserver user belongs to
         * */
        'group' => env('FILE_GROUP', 'www-data'),

        /*
         * This value represents any other folder/file path you want to update when setting the file permissions
         * */
        'additional_paths' => [
            storage_path('app/atom.xml'),
            storage_path('app/rss.xml'),
            storage_path('app/sitemap.xml')
        ],

    ],

];
