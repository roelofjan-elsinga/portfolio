---
update_date: '2019-08-26 13:18:19'
description: 'A few months ago I started saving data in the browser. It wasn''t for performance reason, but for functional reasons. I used LocalStorage for saving data that ne'
is_scheduled: false
is_published: true
post_date: '2016-12-15'
url: indexeddb-caching-your-data-on-the-client-side
---
![IndexedDB](/images/articles/speed.jpg)

# IndexedDB: Caching your data on the client-side

A few months ago I started saving data in the browser. It wasn't for performance reason, but for functional reasons. I used LocalStorage for saving data that needs to be available to the web app and the user at any point, even after simple refreshes. This worked perfectly for a long time until the app grew larger and larger. At this point, I had 5 to 10 XHR requests per view. This was easily achievable in the beginning when it was 2 or 3. Most pages used the same data, the same non-changing data. This is when I started thinking about caching all of this data, making the experience for the user better, because the app would load faster. Not only the users are benefitting though, but the server also gets fewer requests, causing it to perform better for concurrent users.

### Why no localStorage?

So why was localStorage not good anymore? Well, there are two simple reasons for this. First of all, the limited storage space. LocalStorage data can only be saved as a string. The string lengths can only be so long before errors will start to occur. IndexedDB, on the other hand, saves data as actual objects. This way data can instantly be used in the application. Besides saving data as objects instead of a string, IndexedDB is asynchronous. This is important because it doesn't block the DOM. Not blocking the DOM is important when larger tasks are being processed and you don't want to confuse the user with a non-responsive application. LocalStorage and SessionStorage are both synchronous and do block the DOM, but they're not supposed to be used for larger tasks. IndexedDB is better for this task.

### Why would you cache the data on the client?

But why use IndexedDB at all? Isn't it just another layer that you need to pay attention to when you're developing an application? Absolutely, but also look at what it can do for you, as a developer, your server, and your users. If done correctly, you can harness IndexedDB to cache all your incoming "static" data. What this accomplishes is that you only have to load a specific resource once. When you loaded it from the server, you can save it and use the saved resource next time it's needed. This accomplishes two things. One, your server doesn't have to take duplicate requests from an individual user. Two, the requested page will load quicker, since the request to the server is no longer necessary and the resource is already saved to the RAM memory. This will be beneficial to the user experience of your application.

If you use localStorage, IndexedDB or nothing at all, making an application as efficient as possible is very important. It's important for your users, but also for your server. Nothing is worse than overloading the server or causing a bad user experience. Whatever you do, make sure you do it well. If that means you will need to use a caching solution like localStorage, sessionStorage, or IndexedDB (WebSQL is deprecated, don't use it) go for what best fits your needs. Do you need something simple like keeping data close between views? Give localStorage or sessionStorage a try. It's excellent for small tasks. If you need a more complex caching solution, that is capable of saving larger sets of data and does not block the DOM, IndexedDB is exactly what you should be using. To make this even better, use it in combination with service workers and you're on your way to make a web application that's not only available when you're online, but also when you have no internet connection whatsoever.
