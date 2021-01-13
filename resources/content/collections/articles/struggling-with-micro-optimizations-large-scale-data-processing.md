---
update_date: '2021-01-13 14:00:02'
description: 'I''m struggling with micro optimizations on large scale data processing. Find out in what way I''m trying to improve the runtime of the calculations by saving processing cycles.'
is_scheduled: false
is_published: true
post_date: '2019-10-02'
url: struggling-with-micro-optimizations-large-scale-data-processing
linkedin_post: ''
twitter_post: ''
tags:
    - growth
---
!["Clock on the wall"](/images/articles/clock-on-the-wall.jpeg)
# Struggling with micro-optimizations on large scale data processing

Recently I worked on a problem that didn't seem solvable. It was a problem that a bit difficult to explain, but let me try. A process exists which is calculating a price, including discounts, seasonal pricing, blocked dates, etc. This means it's quite a long process because there are hundreds of variables that could impact the final price. When you request a single price, for a given date including a stay duration (price per day and pricing per week, etc.) it'll give you an answer quite quickly, usually within 120ms. This is pretty good for a single calculation, but what if you have to do thousands? That's when it becomes problematic.

## Thousands of calculations: every millisecond counts
When you're calculating something 1000's of times, every millisecond adds up to seconds. Let's take the 120ms as a normal calculation speed for a single calculation and see what happens when we're calculating this 5000 times. 

```
5000 * 120ms = 600.000 ms = 600 seconds = 10 minutes
```

As you can see, that's quite a long time to do 5000 calculations, so let's see what happens when we improve the calculation speed by just 1 millisecond:

```
5000 * 119ms = 595.000 ms = 595 seconds = 9 minutes and 55 seconds
```

As you can see, a small improvement of 1 ms already has an impact of 5 seconds. Of course, in the big picture, what is 5 seconds on 10 minutes? Not as much as you'd like of course.

## What is the problem?
So these numbers are nice, but what does it mean? Well, I'm working on a system that continuously indexes large amounts of documents into a search engine running on Apache Solr. The indexing process goes well, the search engine works well, but the calculation stage, when creating these documents is the real bottleneck. As the variables to calculate the price change often, prices have to be calculated for each day, for all available stay durations. You might be wondering what this looks like, let me try to visualize this with some data:

Imagine you have available dates on a random date like 2019-09-14 and the first blocked date is at 2019-09-21, you can still make a booking for 1 day, all the way up to 1 week (check-in and check-out can happen on the same day), but you can't make a booking for 2 weeks, as the second week is already blocked off. This means that we need to calculate prices for 2019-09-14 for the following stay durations: 1, 2, 3, 4, 5, 6, 7. This is 7 calculations for a single day. For the 2019-09-15 we need to calculate prices for the following stay durations: 1, 2, 3, 4, 5, 6. As you can see, we won't need to calculate the price for 7 days, because you won't be able to make a booking for 7 days, as the last day would be blocked by another booking.

We can't simply use the price for 1 day and multiply this by 7 to get the week price, because sometimes a discount only applies to a booking that's 1 week or more, which means that you'd display a price that's much too high for a week if you just multiplied the day price. Long story short, we need to calculate the price for each stay duration separately to make sure it's accurate.

## What I've already tried
There are a few things I've already tried, including:
- Deferring calculations to asynchronous processes
- Making assumptions about the consistency of the pricing and caching pricing

**Deferring calculations to asynchronous processes** was an absolute disaster, because this did several things that caused huge problems in other areas, including flooding the task queue with tasks (30k - 40k tasks that blocked other tasks for longer periods of times) and writing to the search engine far too often. Writing to the search engine often, in very small batches takes a long time because it's an HTTP request and the search index needs to be rebuilt often. This needs to be batched into larger chunks to achieve better performance.

**Making assumptions about the consistency of the pricing and caching pricing** works quite well, but you can't guarantee the data indexed is correct. The way I implemented this was as follows: The price throughout the week rarely changes, so when I'm calculating a price for 2019-09-14, I cache this and apply this to the date range 2019-09-14 until 2019-09-20. This has the benefit that you have to do 7 times fewer calculations, but it also allows for possible errors in pricing. This would result in a total calculation time of:

```
( 5000 / 7 ) * 120ms = 85.800 ms = 85.8 seconds = 1 minute and 25.8 seconds
```

This is much better but has its trade-offs.

## I'm still looking for a better solution
For now, the problem has been "solved", but this is not a good permanent solution. Ideally, this process wouldn't take longer than 5 seconds, but I have no solution that would help achieve this as of yet. If you have any ideas on how to improve this process, please let me know. It's very difficult to shave off a few milliseconds for the single calculation, but this might be a possible solution. Of course, eliminating unnecessary calculations is even better. Programming isn't all about finding amazing solutions, you also really struggle to deal with something all the time. This is why I've written this post. I'm trying to highlight that I'm struggling with some tasks all the time. 

If you'd like to get in contact with me about this, possibly with some advice for me, you can contact me on [Twitter](https://twitter.com/RJElsinga) or send me an e-mail at *roelofjanelsinga@gmail.com*.