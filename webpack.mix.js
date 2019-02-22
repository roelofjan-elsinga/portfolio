const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const purgeCss = require('laravel-mix-purgecss');
const {GenerateSW} = require('workbox-webpack-plugin');

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

mix.sass('resources/assets/sass/front.scss', 'public/css/')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.js') ],
    })
    .purgeCss({
        extensions: ['html', 'js', 'php', 'md'],
    })
    .sourceMaps()
    .webpackConfig({
        plugins: [
            new GenerateSW({
                swDest: path.join(`${__dirname}/public`, 'sw.js'),
                clientsClaim: true,
                skipWaiting: true,
                exclude: [/\.css$/],
                runtimeCaching: [
                    {
                        urlPattern: new RegExp(`${process.env.CANONICAL_BASE}`),
                        handler: 'networkFirst',
                        options: {
                            cacheName: `${process.env.APP_NAME}-${process.env.CANONICAL_BASE}`,
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
                        urlPattern: new RegExp('https://fonts.(googleapis|gstatic).com'),
                        handler: 'cacheFirst',
                        options: {
                            cacheName: 'google-fonts',
                            cacheableResponse: {
                                statuses: [0, 200]
                            }
                        }
                    }
                ]
            })
        ]
    })
    .version();
