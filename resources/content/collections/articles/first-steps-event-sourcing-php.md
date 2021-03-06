---
update_date: '2021-01-13 14:02:02'
description: 'I''ve taken the first steps in working with event sourcing and in particular, event sourcing in PHP. It''s a very confusing concept, but once I got the gist of it, I was convinced of its value.'
is_scheduled: false
is_published: true
post_date: '2019-08-13'
url: first-steps-event-sourcing-php
linkedin_post: ''
twitter_post: ''
tags:
    - event-sourcing
    - php
---
!["Explore"](/images/articles/explore.jpg)
# Taking the first steps with event sourcing in PHP
I've taken the first steps in working with event sourcing and in particular, event sourcing in PHP. It's a very confusing concept, but once I got the gist of it, I was convinced of its value. So you might be wondering, what is the biggest value of event sourcing for you? I'll explain those values in this post.

## Preserving valuable data
When using event sourcing, as opposed to a traditional CRUD system, you're saving events instead of data. This has the benefit that you can keep track of any and all data changes over time. The key aspect here is *over time*. Because in a traditional application, you only know the state of the data *right now*. You don't know what it looked like yesterday or last week, but only what it looks like now. For many cases, this is perfectly fine, but for some other processes, like keeping track of transactions, you need the history of data changes. By using event sourcing, you preserve data. You never make changes to data, you simply amend a new version of the data.

## Generating reports after the fact
When using a traditional way of keeping track of your data, you only know what your data looks like *right now*. This makes it very difficult to write reports about things that happened in the past because you don't actually have the data. The thing you'll have to tell your superiors is: I can't do that or it won't be accurate, but I've implemented it and it'll be possible for next quarter. This is a situation you'd rather not find yourself in. Event sourcing allows you to generate reports or projections about anything that has already happened and is recorded, and also about events that still need to take place. This is one of the aspects of event sourcing that really blew my mind when I started to understand the concept.

## The ability to revert and replay changes
The fact that event sourcing allows you to record every single event taken place since the beginning, also allows you to look at a situation as if you were in the past. It's very similar to *git log*, where you can see what has been changed by whom and when. This can also be done with event sourcing and it really helps to be able to understand why some data is the way it is, simply by looking at the changes through time. Event sourcing also allows you to simply choose a desired state of the data and then treat that as the *latest version*, effectively removing all changes taken place after that situation. This is comparable to reverting a branch to a certain commit in Git. 

All-in-all, I'm very impressed with the concept of event sourcing and I hope to implement it more and more in certain cases. The fact that all the valuable data is preserved and you have Git-like abilities with data in some sort of database or file system is very powerful. 

I've written this post because I like to keep myself up-to-date about my progress in skills. I've seen great gains in my programming skills since I've started to write blog posts and this motivates me to keep learning. 