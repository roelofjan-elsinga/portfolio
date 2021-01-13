---
is_scheduled: false
is_published: true
canonical: 'https://medium.com/@roelofjanelsinga/modernizing-log-part-3-optimizing-graphql-queries-bea400c86a3d'
post_date: '2018-05-02'
url: modernizing-log-part-3-optimizing-graphql-queries
description: "First, let me refresh your memory about what results I've had so far.\r\nThe initial situation was as follows:"
update_date: '2021-01-13 14:13:13'
linkedin_post: ''
twitter_post: ''
tags:
    - graphql
---
!["Sports car"](/images/articles/0_TZbsjFf22AO6FfeA.jpeg)

# Modernizing log: Part 3, Optimizing GraphQL queries

In the last blog, I left you with some first testing results for a product page. 
If you haven't read it, you can do so by reading 
["Modernizing log: Part 2, GraphQL test results"](/articles/modernizing-log-part-2-graphql-test-results). In that post, 
I described what I had grouped all static resources under two resource calls, 
instead of nine. Well, there are exciting updates that I will share with you now!

First, let me refresh your memory about what results I've had so far. 
The initial situation was as follows:

![The initial situation](/images/articles/modernizing-log-part-3/initial_situation.png)
<span class="caption left">The results before implementing GraphQL</span>

As I mentioned in my last post, this page required 19 (data) resources, 
to be fully loaded. This was becoming a huge problem because the server would 
start to reject requests after viewing a few boats. This all had to do with the 
"X-RateLimit-Limit" header. In simple terms, the website requested too many data 
points in a given period of time.

When I initially implemented GraphQL, I got a significant reduction of XHR 
requests. I went from 19 (data) resources, to "only" 10. See the screenshot 
below for these requests:

![Situation after GraphQL](/images/articles/modernizing-log-part-3/results-after-graphql.png)
<span class="caption left">The results after implementing GraphQL</span>

That situation looks a lot cleaner already right? Well, I wasn't done yet! 
All I did in that particular round of improvements, was grouping static resources, 
to the best of my abilities. However, I figured out that it's possible to 
batch GraphQL queries, so you only require a single XHR request to get multiple 
data sources. This is where I tried to gain the most progress. I've posted a 
screenshot with the results of that improvement below.

![Situation after Batching](/images/articles/modernizing-log-part-3/results-after-batching.png)
<span class="caption left">The results after batching GraphQL queries</span>

There are several new things going on in this screenshot other than GraphQL. 
I've added cache busting for HTML templates. This adds the benefit that the 
clients only download HTML files when they've actually updated in a new build 
of the application. Additionally, the first two calls have nothing to do with 
the actual product page itself. They are simply optimizations to then chunking 
of translations for the website. Before, every user had to download all languages. 
Now, that's only one, unless the active language gets switched of course.

Anyway, as you can see, all static resources have been combined into a single 
XHR request (the third request). The application then registers a page view and 
loads the user notifications for the first time (mind you, this is a hard refresh, 
not a simple state change). Lastly, all the dynamic resources are loaded. 
Which are now only three, instead of six. In total, this product page now needs 
six XHR requests, and that is including the registering of a page view and the 
initial user notifications. So since starting to implement GraphQL, I've gone 
from 19 to 6 requests.

This page is done for now, until I find a way (and a need) to further optimize 
these resources. Do you have any tips on how I could further improve these 
requests? Let me know in the comments, I'd love to learn from you.
