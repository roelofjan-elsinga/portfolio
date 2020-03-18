---
update_date: '2019-08-26 18:59:07'
description: "Single Page Applications (SPA's) are amazing to build and work with,\r\nbut there are a lot of disadvantages as well. This post describes some of the things that\r\nI"
is_scheduled: false
is_published: true
post_date: '2017-06-06'
url: learned-building-single-page-applications
---
![What I've learned building Single page applications](/images/articles/girl-on-laptop.jpg)

# What I've learned building Single page applications
Single Page Applications (SPA's) are amazing to build and work with, but there are a lot of disadvantages as well. This post describes some of the things that I have learned while building SPA's. It also contains tips to help developers building or thinking about building SPA's.

So first up is the challenge of having proper titles, meta tags, and general SEO requirements. In some Javascript frameworks (like ReactJS and Angular) this problem has already been solved. Some older generations of Javascript frameworks like AngularJS (version 1.x), this problem still persists. When you don't do anything to properly generate SEO tags/titles/texts, Google and Facebook will simply not find anything for your website apart from the URL.

## Meta tags with Javascript
A very simple, but in some situations pretty tricky solution would be to use prerender.io. This service uses PhantomJS to render an entire webpage, to show titles, tags, and texts. This way, when Google or Facebook crawl your website, they will see all the proper information they need for search results or Facebook's open graph cards. At my job we use this service, but not without any problems. First of all, you need to make sure you're using HTML5 polyfills for everything. This is because we made use of Javascripts Promises, but PhantomJS didn't recognize what this meant, so it simply didn't render our pages, causing us to pull out our hair over it. When we discovered Promises were the problem, we switched to using Angular's $q promise instead of solving the problem. So if SEO is very important to you and your application, make sure the framework you choose has built-in functionality to render your pages properly for Facebook, Google, etc. A great starting point would be to use Angular2 or ReactJS.

## File organization
Another thing I have learned is that file structures are incredibly important. Consistency in file and code placement is important. What does this mean? Well, this means that code and modules need to be separated by function, not by type. What this means is that you shouldn't put all controllers in one folder, all services in another folder and all directives in yet another. What I'm saying is that you should put all code, templates, etc. belonging to specific functionality in a separate folder. This may seem tough to start out with, and for small applications, this is not necessary, but for large applications, this makes your life so much easier. The number of times it took me so long I just gave up and did a full-on text search over all files to find the one I needed is too high. If I had started to structure my filesystem like this from the beginning I could simply find the folder that belonged to that specific function and have all the code I needed right there. It's a real time-saver.

## API calls
The last thing I have learned while building SPA's is that the API structure in your back-end is incredibly important. Starting out I wrote a single API call for each page, collecting a lot of data in one server response. This is slow and is the wrong way to go. The asynchronous nature of SPA's makes it easier to use several smaller API calls to get the data you need. While you have one request in a queue, other processes can still take place. This helps me to load screens and it's data much quicker than waiting for larger requests. When the application only loads one massive response, the pages need to wait before they're ready to go. So when you structure the API endpoints in the backend, make sure to keep the responses small. This will help you break up the loading times so users using the application will have a smoother experience.