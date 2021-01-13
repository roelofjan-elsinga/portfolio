---
is_scheduled: false
is_published: true
post_date: '2016-10-27'
url: benefits-single-page-application
description: 'Realtime information, partial page loads, quickly navigating to pages. Javascript has a lot to offer and is getting more and more popular. Websites aren''t just '
update_date: '2021-01-13 14:16:02'
linkedin_post: ''
twitter_post: ''
tags:
    - javascript
---
![Manhattan at nigh](/images/articles/manhattan.jpg "Benefits of a single page application")

# Benefits of a single page application

Realtime information, partial page loads, quickly navigating to pages. Javascript has a lot to offer and is getting more and more popular. Websites aren't just plain Javascript and jQuery any more. More and more Javascript frameworks and libraries are being developed and are quickly taking over the roles of traditional web development techniques. The LAMP (Linux, Apache, MySQL, and PHP) stack is slowly losing ground to faster, more flexible ways of development, like the MEAN (MongoDB, ExpressJS, AngularJS, and NodeJS) stack. Javascript allows for quicker navigation through websites and applications and even allow developers to develop application for phones.

### Smoother user interactions

Speed and flexibility are nice and all, but how does this apply to a real world solution? Well first of all a single page application (SPA) invites the user for a more interactive experience. Because a SPA loads all its data on the initial loading process, loading times are shorter while navigating between pages. This behaviour is very similar to the process of loading a native mobile application. The application seems smoother to the users, unlike a typical website, in which you'll have to wait until the next page is loaded. A typical website doesn't feel dynamic, it feels like a stack of static pages, through which you can click. A native application feels more like a stack of layers, within layers. These layers can change and respond to user input. Something a typical website will never be able to do in a smooth manner. SPA's however are trying to replicate this dynamic feeling of a native application, but in a web environment. Through asynchronous calls and responsive Javascript, pages are loaded more quickly and are better able to respond to user input, improving the user experiences throughout the entire application.

### Lower server load

Second of all, a single page application generally takes up less bandwidth and less computing power from the server. This is because of a very simple reason, the server doesn't constantly need to serve entire web pages. Instead it serves partial pages and loads data asynchronously, causing less strain from the I/O of CPU. Typical websites work synchronously, meaning one task gets completed before the other one starts processing. Javascript allows for asynchronous calls, this means the server can queue tasks. It will then complete one task from the queue after another per CPU thread. Meaning it will be able to do multiple tasks at the same time, causing the single page application to out perform any typical web application for the same task.

### Convertable to a hybrid application

And finally, the third benefit highlighted in this post, convertibility. More and more companies are bringing out applications for iPhone, Android, etc. these days. Often, these applications are made from scratch and are being built by iOS and Android developers. This is a very costly process, often costing 50.000+ for a single application. What if there was a way to convert your existing website into a mobile application, without a lot of extra development? Well with single page applications, made with Javascript, this is possible. There are countless of programs that can help you convert a simple website to a hybrid application, PhoneGap for example. This program essentially builds a shell around your website, allowing it to execute like a mobile application on your phone. A single page application, built on Javascript can easily be converted into such an application, as long as the underlying API endpoints are accessible by the application. Of course this will never be as smooth as an actual native mobile application, but it offers for a quick and easy way of testing out a mobile application.

These points are just a few of many of the benefits of single page applications. But keep in mind that benefits always come with trade offs. There are also disadvantages of building single page applications, and these will be highlighted in a next blog post. The highlighted points in this article are some of the main parts I have encountered building several single page applications of the past year. I'm sure more advantages and disadvantages will show up, but only time will tell.
