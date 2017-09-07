var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');

"use strict";

gulp.task('generate-service-worker', function(callback) {
    var path = require('path');
    var swPrecache = require('sw-precache');

    swPrecache.write(path.join('./', 'sw.js'), {
        runtimeCaching: [
            {
                urlPattern: '/(.*)',
                handler: 'networkFirst',
                options: {
                    origin: /roelofjanelsinga/
                }
            },
            {
                urlPattern: '/(.*)',
                handler: 'cacheFirst',
                options: {
                    origin: /\.cloudflare\.com/
                }
            },
            {
                urlPattern: '/(.*)',
                handler: 'cacheFirst',
                options: {
                    origin: /\.googleapis\.com/
                }
            }
        ]
    }, callback);
});

gulp.task('sass', function () {
    return gulp.src('./scss/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 4 versions'],
            cascade: false
        }))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest('./css'));
});

gulp.task('sass:watch', function () {
    gulp.watch('./scss/*.scss', ['sass']);
});
