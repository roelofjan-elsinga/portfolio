---
description: 'If you''re looking to improve the performance of your website and you haven''t tried service workers yet, you should. Adding them gives you a big boost in web performance. Read here how I did it and let me show you how you can too.'
post_date: '2020-08-05'
is_published: true
is_scheduled: false
update_date: '2020-08-06 06:37:20'
linkedin_post: 'I''ve been able to improve the mobile performance of one of my websites drastically. I did this by only adding a Service Worker. A Service Worker is a script that runs in your browser which helps to optimize asset loading on your website, even allowing the caching of assets in the browser for offline usage. '
twitter_post: ''
---
![Speedy zoomed in on Camera](/images/articles/speedy-zoomed-in-on-camera.jpeg)
# Boost web performance with Service Workers
If you've been working on the performance of your websites for a while and haven't tried service workers yet, keep reading. A Service Worker is a script that runs in your browser which helps to optimize asset loading on your website, even allowing the caching of assets in the browser for offline usage. This is not an in-depth tutorial about the ins and outs of service worker, but rather an insight in the benefit the service worker brings to your website's Pagespeed (and SEO) score.

## Before the Service Worker
An insight wouldn't mean anything if we don't have a before and after situation. In the following two screenshots you see the before screenshots for the mobile and desktop scores.

![Pagespeed score before service worker](/images/articles/pagespeed-score-before-service-worker.png "Pagespeed score before service worker")
<span class="caption">Pagespeed score (desktop) before Service Worker (June 20th 2020)</span>

As you can see, the score for desktop was quite good already and didn't need a lot of improvement. However, if we look at the score for mobile there is different situation.

![Pagespeed score before service worker mobile](/images/articles/pagespeed-score-before-service-worker-mobile.png "Pagespeed score before service worker mobile")
<span class="caption">Pagespeed score (mobile) before Service Worker (June 20th 2020)</span>

The score for the mobile version wasn't great and really needed some improvement, especially since most traffic (80%+) to this website is on mobile devices.

## In comes the service worker
As the website I've run this test on is built with Laravel, I use Laravel Mix for compiling Sass and other assets. Laravel Mix has a plugin to generate a service worker: [laravel-mix-workbox](https://laravel-mix.com/extensions/workbox). With this extension you can very easily generate a service worker for the compiled assets. 

This is an excerpt of the configuration I use to generate the service worker:

<script src="https://gist.github.com/roelofjan-elsinga/1504426161dbe1ae15014c946bd57f8b.js"></script>

The most important thing to not here is that you need to include the "webpackConfig" section. If you don't do this, the Service Worker will attempt to cache your assets with an extra leading slash: "//css/style.css". This will throw errors and will cause the Service Worker to not lauch, because it won't lauch if there are any errors. So by adding "webpackConfig" with the new publicPath, you solve this issue.

You can use this same configuration if you're using Webpack to bundle and compile your assets. Simply replace "generateSW" with "new GenerateSW" and include it in the plugins section of your webpack.config.js file.

Now that you have the sw.js file, you need to include it in your webpage:

<script src="https://gist.github.com/roelofjan-elsinga/78624db71a67657a22fbf447bce03df7.js"></script>

## After the service worker
Now that we have the service worker installed on your webpage, we can check our Pagespeed score once again. These are the screenshots for the Pagespeed scores on mobile and desktop after including the service worker.

![Pagespeed score after service worker](/images/articles/pagespeed-score-after-service-worker.png "Pagespeed score after service worker")
<span class="caption">Pagespeed score (desktop) after Service Worker (August 6th 2020)</span>

As you can see, the score is now 99 instead of 95. It's a nice boost to our score, but the desktop version never needed the extra boost. Mobile on the other hand has made a massive jump:

![Pagespeed score after service worker mobile](/images/articles/pagespeed-score-after-service-worker-mobile.png "Pagespeed score after service worker mobile")
<span class="caption">Pagespeed score (mobile) after Service Worker (August 6th 2020)</span>

The mobile score is now 90, and made a jump from 53 to 90, which is quite a difference. The Service worker has caused the score to jump quite a bit and load the static assets much more efficiently. 

## Other actions taken to improve the score
This gain wasn't the only reason why the mobile score made such a large gain, there were other contributing factors. These include:

- Lazy loading images through loading="lazy"
- Properly sizing images with Gumlet
- Trigger loading the Facebook Messenger widget on a click, instead of every pageload

These factors all played a role, in the resulting score, but it doesn't take away that the service worker still provided the biggest boost.
## Conclusion
Adding a service worker to your website can massively improve the Pagespeed score, your UX, and even your SEO score. So if you're able to do this for your projects and you're looking to get some extra performance out of your website, including a service worker is the easiest performance boost you can make.