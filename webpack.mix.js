const mix = require('laravel-mix');
const purgeCss = require('laravel-mix-purgecss');

require('laravel-mix-workbox');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .styles([
        'node_modules/@fortawesome/fontawesome-free/css/fontawesome.css',
        'node_modules/@fortawesome/fontawesome-free/css/brands.css',
        'node_modules/@fortawesome/fontawesome-free/css/solid.css',
    ], 'public/css/fontawesome.css')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')
    .sass('resources/assets/sass/front.scss', 'public/css/')
    .sass('resources/assets/sass/resume.scss', 'public/css/')
    .options({
        processCssUrls: false,
        postCss: [ require('tailwindcss') ],
    })
    .purgeCss({
        extensions: ['html', 'js', 'php', 'md'],
        whitelist: ['ul', 'ol']
    })
    .version()
    .webpackConfig({
        output: { publicPath: '' }
    })
    .generateSW({
        swDest: path.join(`${__dirname}/public`, 'sw.js'),
        clientsClaim: true,
        skipWaiting: true,
        exclude: [
            /\.(?:png|jpg|jpeg|svg)$/,
            'mix.js'
        ],
        runtimeCaching: [
            {
                urlPattern: new RegExp(`https://roelofjanelsinga.com`),
                handler: 'NetworkFirst',
                options: {
                    cacheName: `roelofjanelsinga-https://roelofjanelsinga.com`,
                    fetchOptions: {
                        mode: 'no-cors',
                    },
                    matchOptions: {
                        ignoreSearch: true,
                    },
                    cacheableResponse: {
                        statuses: [0, 200]
                    }
                }
            },
            {
                // Match any request that ends with .png, .jpg, .jpeg or .svg.
                urlPattern: /\.(?:png|jpg|jpeg|svg)$/,

                // Apply a cache-first strategy.
                handler: 'CacheFirst',

                options: {
                    // Use a custom cache name.
                    cacheName: 'images',
                },
            },
            {
                urlPattern: new RegExp('https://fonts.(googleapis|gstatic).com'),
                handler: 'CacheFirst',
                options: {
                    cacheName: 'google-fonts',
                    cacheableResponse: {
                        statuses: [0, 200]
                    }
                }
            }
        ]
    });
