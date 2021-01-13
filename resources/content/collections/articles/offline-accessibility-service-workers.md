---
update_date: '2021-01-13 14:15:15'
description: "Web applications are great. They're fast, they can be used on all platforms and often feel\r\nlike they're a real native application with accessibility .\r\nBut then,"
is_scheduled: false
is_published: true
post_date: '2017-06-09'
url: offline-accessibility-service-workers
linkedin_post: ''
twitter_post: ''
tags:
    - service-workers
---
![Offline accessibility with service workers](/images/articles/guy-swimming.jpg)

# Offline accessibility with service workers
Web applications are great. They're fast, they can be used on all platforms and often feel like they're a real native application with accessibility. But then, your internet stops working and you only had to check that little note you made earlier. Too bad, you can't connect to the application and you can't see that note you made earlier bummer! Service workers to the rescue!

To really make web applications competitive against native applications, 
you'll need to simulate or even enhance the expected behaviour of such apps. This means that the app should feel quick and responsive, you should be able to access it whenever and wherever you want and it should benefit you when you need it. So let's split this expected behaviour into three sections: quick and responsive, accessible whenever and wherever, and personal benefit.

## Quick and responsive
One aspect of a native application over a web application is usually that the native application feels quicker. You don't have to wait for something to appear on your screen, whereas for web applications you often have to wait for data to show content on your screen. This is a deal breaker for a lot of people. A true app should be quick. One solution for this is browser caching through Nginx or Apache through Cache-Control and Expire in your response headers. The browser will attempt to cache the requested resources in the browser, thus making the second load of your application nearly instantaneous. This is an amazing first step because your application instantly feels a lot faster. However, the browser will still need to request data from the server to even receive response headers, which isn't possible when you don't have any internet. This is where service workers play a huge role.

## Accessible whenever, wherever
I mentioned in the previous paragraph that browser caching is a great way to reduce bootstrapping time, but it won't work if you're not connected to the internet. Service workers are the solution here. A service worker essentially is a middle man, built into the browser. This middle man can intercept any request made from the browser to the server and customize its behaviour. This sounds a little vague, but hang in there. You have to imagine that this middle man is receiving a request from you (through the browser). The worker will then look in its memory to see if you've requested this resources before. This resource can be anything from a JS file to a CSS file, HTML, image, etc. If the worker does find the resource in its memory, it will return this. Did you see what just happened? The request never touched the server. It requested something and the service worker returned a cached version of the requested resource. You can create a web application like this that is available, even when you're not connected to the internet.

Offline accessibility is only one of the benefits of service workers. 
Imagine you're in a remote location and you're connected to the internet, 
but your connection is incredibly slow. Normally when you're offline the website will fail to load straight off the bat, but not this time. It will attempt to download all the resources like it normally would, with a slow connection. This can cause the website to load in 3 minutes instead of 3 seconds, which is terrible user experience. Tadaa! Another task for the service worker. This little worker will recognize the situation and will return the cached version instead of attempting to request the resource from the server. The load time is once again three seconds! Service worker out!

## Personal benefit
That offline web application is great and everything, but if you still need the internet to save data, your web application will still fail its purpose. It'll look like it's working, but in reality, it doesn't do anything else besides being pretty and fast. The solution here is maybe not the most obvious to some of you, but you can make use of a fantastic feature of HTML5 called IndexedDB. This is an in-browser database that can contain JSON objects in a simple key-value pair database. When your app is unable to save any data to your actual database, it can use IndexedDB as an offline fallback and synchronize with your server at a later point in time when you do have an internet connection.

What does this mean for your app? Well it means that it looks pretty, it's fast, and it's actually fully functional. This will get your web application to be more and more competitive with native applications. First of all, your application will behave like a normal native application, no matter what the situation might be. Second of all, don't tell everyone, but it's much cheaper and easier to build web applications than it is to build native applications. That's what I call a win-win situation. So to round up: use service workers to make your web application to behave more like a native application in less than optimal situations.