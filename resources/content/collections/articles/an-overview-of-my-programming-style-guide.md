---
is_scheduled: false
is_published: true
url: an-overview-of-my-programming-style-guide
canonical: 'https://medium.com/@roelofjanelsinga/a-overview-of-my-programming-style-guide-a5537b6e8b52'
post_date: '2018-04-29'
external_url: 'https://medium.com/@roelofjanelsinga/a-overview-of-my-programming-style-guide-a5537b6e8b52'
---

!["A lonely road"](/images/articles/0_xDUpNBbkXsdnMj4i.jpeg)

# An overview of my programming style guide

I'm writing this style guide to make my own code more readable and maintainable. This guide attempts to cover all of the code I write and work with, so it will be expanded over time, as I find more things to document. So far, this guide covers Laravel (and PHP in general), and JavaScript.

### 1. Laravel

Since I mainly work with Laravel, I'll base the PHP section of this guide on this Framework. I'll describe things like setting up routes, dealing with service providers, name spacing, unit tests, and exposing API endpoints here. I will not get into how these work, because that's beside the point of this post. All I'm doing here is describing how they should be written and formatted.

#### 1.1 Routes

The routes files will be split according to purpose. There will be name spaces for Web and Api routing. To keep clear overview for other developers, route groups will be used. An example can be found below.

