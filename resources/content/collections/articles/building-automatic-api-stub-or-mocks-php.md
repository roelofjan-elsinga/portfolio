---
update_date: '2021-01-13 14:01:26'
description: 'Testing your code is essential if you want to write code that doesn''t break your application. Find out how I''m going to use automatic stubs to test the implementation of API''s instead of the actual API calls.'
is_scheduled: false
is_published: true
post_date: '2019-08-21'
url: building-automatic-api-stub-or-mocks-php
linkedin_post: ''
twitter_post: ''
tags:
    - php
    - testing
---
!["Keyboards Black and White"](/images/articles/keyboards-bw.jpeg)
# Building automatic API Stubs and/or using Mocks in PHP
Testing your code is essential if you want to write code that doesn't break your application. You should use tests as an assurance that your code does what it's supposed to do, nothing more, nothing less. When you have code that interacts with external services, testing this code becomes more difficult. You're not responsible for the accessibility of other services, but theses still influence the state of your application. Any problems in external services, or the connection to those services, will break your tests if they're not operational. This is not (always) representative of the actual state of your application and can cause false negatives. Don't get me wrong, you should put in place scenarios that deal with these problems, but they shouldn't change your testing expectations. One input should trigger a certain response, a response that's predictable.

## The reason to build and use an API stub generator
Some of my unit tests, which were using the Google Geo coding API returned failing assertions. These tests weren't failing because of our written code, but because our company moved to a new office. This meant that our IP address changed, which was why Google invalidated our API token. The token had an IP restriction and we were no longer accessing the services using our white listed IP address. Then I added another layer of complexion when I enabled a VPN connection on my laptop, which invalided my IP address. The fact that my tests were making false assertions, because a service wasn't accessible any more was a sign. The code handled the API responses, but the expected result was never returned. My code was working, but the tests didn't reflect this.

## Where the automatic stubs come in
The idea is to build a package to record all API calls you make to external services during a test run. I will do this by saving URL's and/or request headers in a mock file along with the received response. This helps me to run the tests with actual calls to the API only once and return stubbed values in later tests. Since I'm testing the handling of data in my unit tests, I still need to make use of these API results. But the added API call doesn't prove the reliability of the acceptance tests, which is the point of writing tests.

## Why using mocks might be a better choice
The whole goal of copying the API responses is to get the actual responses, without making API calls. But, if you're using part of the responses, like in my case, an intact response is not the most important part. The most important part is an accurate partial response for the case I'm testing. I need to be able to predict a certain behavior for a certain API response. So by providing a mock with some data, I can mock the exact response I need to test the response of the test script. This allows me to write predictable code and write tests for a single input and a single output.

At this point I'm not quite sure what I'll go with. Once I've implemented a solution, I'll update this post and describe the solution in detail.