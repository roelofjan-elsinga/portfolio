---
is_scheduled: false
is_published: true
canonical: 'https://medium.com/@roelofjanelsinga/modernizing-log-part-2-graphql-test-results-e8f3b2db676b'
post_date: '2018-03-19'
url: modernizing-log-part-2-graphql-test-results
---

!["Flower bulbs"](/images/articles/1_GdfAu9ucc1ZQdKz39S-0Kg.jpeg)

# Modernizing log: Part 2, GraphQL test results

In the previous log, I mentioned that I had a product page that had too many XHR requests and was overloading the server with a high visitor count. To combat this, I came up with the solution to combine some of these XHR requests into a single call. I wrote that I was going to do this through GraphQL API endpoints. It's a few days later now and I've done exactly what I described.

First of all, I added a screenshot of the old situation. This screenshot includes the initial XHR requests and the asynchronous calls after the view has loaded.

!["The results before implementing GraphQL"](/images/articles/modernizing-log-part-2/1_4tQVRFbsOj21RGUU4CQpgw.png)

As you can see, this page requires 19 resource requests to be fully loaded, which is ridiculous. It even has a call that just gives up and returns an error 500.

This page has two different types of resources: static resources, and dynamic resources. Most of the static resources are loaded before the view renders because they're simply there to display data on the view. The dynamic resources include pricing and data that will change as the state of the application changes. This also includes related products, as they will change with the state of the application (for this particular product).

Realistically I'd be able to merge these 19 resource requests into 2 to 4 requests, or so I thought. So I set out to merge all the static resources first. The initial server set-up took some time, but once that was done, the data structure was a breeze to set up.

The following screenshot shows the merged static resources (the first two).

!["The results after implementing GraphQL"](/images/articles/modernizing-log-part-2/1_w-YC_lehzVlsyMqKEAKjCw.png)

Initially, I tried to merge all the static resources, but then I thought it was illogical. The second request is a resource that shows data related to the logged in user and has nothing to do with the actual product. This is why I decided against merging it with the product resource. As you can see on the screenshots, I now "only" need 10 resource request. All static resources have been combined from 9 into 2 requests.

The next step is to find a way to merge all dynamic resources into 1 or 2 requests as well. At least for the initial rendering. After the data has been loaded, any new data can be loaded through the normal API calls, because speed is no longer the main priority at that point. Since the additional requests after the first load will require user interaction to be triggered, loading times and calculations are less of a strain to the server, because it's easier than reloading all 19 resources it used to have.

If you haven't read the previous part of this log, please do so through the following link, as it will give context to this log. [Modernizing log: Part 1, Conventional REST API to GraphQL](/articles/modernizing-log-part-1-conventional-rest-api-to-graphql)

Do you have any tips on how I should approach merging the dynamic XHR requests? Let me know in the comments, I'd love to learn from you.
