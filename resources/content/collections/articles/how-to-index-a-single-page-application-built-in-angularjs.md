---
update_date: '2021-01-13 14:15:28'
description: 'Find out how to properly index a single page application for Google and other search engines with Prerender.'
is_scheduled: false
is_published: true
post_date: '2017-01-12'
url: how-to-index-a-single-page-application-built-in-angularjs
linkedin_post: ''
twitter_post: ''
tags:
    - angular
---
![Magnifier](/images/articles/magnifier.jpg)

# How to index a single page application built in AngularJS

The age (read: a few years) old question...how do you index a single page application? I have covered this topic briefly in a previous post about Isomorphic JavaScript. Single Page Applications are fantastic for the user experience, but of course, it also has a few disadvantages, one of which is actually a user experience killer. I will describe the two disadvantages that I have found using AngularJS (I know, I haven't completely switched to Angular 2, calm yourselves) and a solution to combat both of these problems in this post. So to get started, the disadvantages that I have found: the initial page load takes long which causes users to leave your website and indexing your website, or any social media sharing is a pain. I know these issues have mostly been resolved with Angular 2, but I know a lot of people out there are still using AngularJS, so this is why this is still relevant.

### Disadvantages

So the first disadvantage: the initial page load takes ages. This depends completely on the complexity of the app, but the one I work on is very complex, so it takes a good 4 - 5 seconds for the first draw to happen. This means that the user has a white screen of nothingness for about 5 seconds before the application actually bootstraps and shows a page. This is annoying, because it seems like the website is broken, therefore people leave your website before it's even loaded. A super simple way to at least let the users know that the page is loading...is to show a loading symbol. This very simple chance may retain some of the users that otherwise would've left your website. So that's step one. Step 2 is to either lazy load parts of your application or to make sure the scripts load as quickly as they possibly can, through a CDN or a static domain for example. These changes make leave the user with a white screen (with a loader in it) for about 3 seconds before the application has loaded and is ready for the user. It's a huge improvement, but it's not quite there yet.

The second disadvantage is the dynamic nature of a single page application. This means that none of the content on the pages is actually...well on the pages. The pages don't even exist. Everything is loaded on runtime. This causes the long initial load, but the swift interface after the scripts have loaded. It's also a very bad thing for SEO. Search engines and web crawlers are simply not built or prepared to deal with dynamic websites. They don't seem to understand that websites these days are very dynamic and often need to load a lot of javascript before they even work. If we take the Facebook and Twitter social cards as an example... well you won't see a page title, or a description, or a featured picture, or even any meta tags. The Facebook open graph crawler simply doesn't understand what to do with your web app.

### Server-side rendering! Or not?

So the (easy, not so easy) solution is to use server-side rendering or prerendering. These terms are two very different things. For a framework like AngularJS, in which the controllers and directives are tightly coupled with the DOM (the HTML) server-side rendering is almost impossible. So that option is out. That leaves us with prerendering pages. What does this mean? Well, it means that the server serves a static version of the page when this is desired. This is the most useful for Facebook's open graph crawler because it finally understands the data it's receiving. There is a title, description, tags, and images and it just works. A less and slightly strange solution could be to make the loading screens of your applications resemble the view it's about to serve. Right now there is one well-known prerender service available through prerender.io. I have been using their service for over a year and it works, well enough. It's open-source and can be pulled from Github.

### I wanted something better

However, I wanted something else, more of a Hybrid solution. Right now we use a sitemap generator that crawls all the pages and makes an enormous sitemap for Google. But to me, this seems like two jobs that could be combined into one. I mean if you're crawling every single page on the website anyway, why not prerender all those pages at the same time? Well, this is what I built. It's a solution that not only serves static pages when they're requested, but it's also a website indexer that's able to index any page on the fly in case it's not prerendered yet. So have I built this in Node? No, I have not. I actually built the crawler in Python. Why? Well, I've built a crawler in it before. That one was like most crawlers only able to index static pages. So I enhanced it with PhantomJS to be able to fully render dynamic pages and save them to a file. I then integrated this Python project in my Laravel project, synchronizing all of the cached pages to an S3 drive for swift requests. If you're interested to check it out, you can clone it from Github. If you think you can do better (and I think most of you can, because I'm a huge Python Noob), create pull requests to improve it with me. Anyway, this solution is able to crawl, index, and cache static files of the entire website, which I think is pretty cool!