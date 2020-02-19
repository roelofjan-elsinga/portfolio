---
is_scheduled: false
is_published: true
canonical: 'https://medium.com/@roelofjanelsinga/modernizing-log-part-1-conventional-rest-api-to-graphql-f512cb07d2ab'
post_date: '2018-03-14'
url: modernizing-log-part-1-conventional-rest-api-to-graphql
---

!["Books"](/images/articles/1__GgmGZJnFec994dvCDpbWQ.jpeg)

# Modernizing log: Part 1, Conventional REST API to GraphQL

I’ve been working on a Laravel and AngularJS application for two years now. 
It’s slowly becoming more and more complex and it’s starting to become very 
difficult to manage. Every single Angular view needs at least 5 different 
resources to fully work and this is becoming a problem for our servers with a 
high visitor count.

Lately, I’ve been reading about GraphQL and how you can perfectly query all the 
required data you need in a single HTTP request. This would solve a lot of 
problems I’m currently experiencing with PHP-FPM.

So right now I’ll research and set up a testing page with a single HTTP 
request to GraphQL API endpoints. I’m going to see if this reduced the 
high server load I’m currently experiencing. Along with the server load, 
I’m going to have to measure the loading times for this single request. 
The current solution for a product page makes 20 different resource requests, 
but these requests are tiny, so the page loads quickly. However, 
with a high visitor load, this completely overloads PHP-FPM.

So there are two things I’m going to have to test for now: server load 
(preferably seeing a huge reduction), and response times (preferably 
low enough to facilitate a quick page load).

In the next post, I’ll document my findings.

