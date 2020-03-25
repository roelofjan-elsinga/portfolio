---
update_date: '2019-08-26 14:40:04'
description: 'Yes! I know! Another caching post! But caching is very, very important! With that out of the way, I''d like to explain why it''s so important. Not just for your h'
is_scheduled: false
is_published: true
post_date: '2016-12-29'
url: the-importance-of-server-side-caching
---
![The importance of server-side caching](/images/articles/airshow.jpg)

# The importance of server-side caching
Yes! I know! Another caching post! But caching is very, very important! With that out of the way, I'd like to explain why it's so important. Not just for your hardware, but also for your users. Before I explain my thoughts on caching, I should mention what my understanding and interpretation of the term "caching" is. Caching for me means to temporarily save data in a very easy to read and easy to process format, so it can be retrieved effortlessly and used right away. What I'm really saying with this is that data has been processed, formatted in a way your application will need it, and then saved to an entity. This entity can be several things, for example, a flat database table, a file of some sort (.txt or .json for example), or memory in Memcached (Memcache for Windows) or Redis.

### It saves CPU cycles
So with that said, let's get right to it. As I mentioned in the previous paragraph, caching is important for your hardware. Not necessarily for the lifespan of it, but more for the resources that can be used for other tasks. If you'd have to query a database multiple times with it returning the same result, you found a task to use cache. Instead of constantly retrieving the same (static) data and processing it in the same way, thus wasting CPU/RAM resources, is costly. Instead, you can cache the data on the first request, and serve the data from the caching layer afterward. If you do this, you have just saved CPU/RAM resources that can be used for other tasks.

### It makes your application faster
But it doesn't just save hardware resources, it's also quicker. Think about it: querying data from the database, processing this data, formatting the data to make it ready for usage versus requesting the data from a caching layer and receiving this data. This speed boost can significantly reduce loading times of your application, making the user experience better. I remember the huge difference in retrieval time between non-cached data and cached data. Non-cached could easily take 5 or 6 seconds on a single task, while the cached data was retrieved within a second. For most simple tasks this is still very slow, but it at least shows a significant decrease in loading times. This particular caching job caused a homepage of my app to be loaded a full 3 to 4 seconds faster. And this was before I switched from file caching to Redis caching, decreasing the cached requests by at least 50%.

I mentioned the user experience quickly before. There is nothing more annoying than long loading times and it will definitely make users leaving your website. Google said at their Chrome Dev Conference last year that if your app doesn't have a first draw (showing some kind of screen) within 3-5 seconds, 50% of visitors will leave your website. Now I'm not a user experience expert at all, so I can't confirm or deny this statement, but it makes sense. Often time I'll do the same thing. With that said, if you can make your app load quicker in any way, do it. If you have a lot of static data that needs to be loaded from a database upon first entry in your application, make sure to cache all of this. Make the first draw as quick as you can. When caching data to files or the database does not work well enough, try Memcached. When this is still not quick enough, go all out with Redis.

### Everything has disadvantages
I can only praise caching and leave it at that, but that wouldn't paint the whole picture. Of course, there are also disadvantages to it. For example, it's very tough to cache data that changes a lot. It's definitely possible, but you end of having to synchronize the cached data with the new data on every single (important) change. This makes it hell for developers. My rule of thumb on this is: when the data can change at least once a day or it will need to be available right away when changed, do not cache it. If, however, the data never really changes or you really need a performance boost for something, go ahead and cache it. Make it easier for yourself, not harder. The amount of times I was wondering why the page wasn't updating because of cache is too high. Learn from my mistakes and don't cache anything if you're working on that particular part of your application.