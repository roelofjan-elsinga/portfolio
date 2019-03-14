![Build bridges with API based application structures](/images/articles/bridge-forest.jpg)

# Build bridges with API based application structures

There is nothing more fun than working with API's during my work day. 
It's programming like any other day, but it's also so much more! 
It's connecting other services with your own, using them to enhance your application and 
making it much richer with functionalities. You're essentially using other 
fine-tuned services to benefit your own service and sometimes to offload some aspects of 
your application, like social login buttons through Google, Facebook, and Github. 
I mentioned in an earlier post "What I've learned building Single page applications" 
a little bit about how I've been using API calls during my day. 
I'd like to clarify one thing before we dive into my fascinations with API's. 
I see an API call as any form of data transfer between two different applications, 
so it's not limited to HTTP.

## What I'm using right now
Currently I'm working on a project that involves 4 major connections so far, 
and it's only just started. My application connects to Sendgrid for sending of all 
my system emails, Zapier for offloading data to other services 
(there are literally 750 applications connected to it, it's wonderful), 
GraphCMS for the content management of the application, and Tubbber for all 
search and database related functionalities. So what does my application actually 
do by itself? Not all that much, except using all the different API's to 
give different kinds of data some context.

## API based structures are gaining popularity
This has type of application architecture has become more popular in the last few years. 
A few years ago, all aspects of your application or platform were combined in one big package, 
applications nowadays are more broken up, they're more modular. 
This means that each individual component has a very specific task, one task it can do 
really well. You'll notice that testing these functionalities is a lot easier as well, 
which is another added benefit.

## Spreading risks
This is a huge benefit to larger corporate systems, because when one of these services breaks, 
your applications can still partially run normally. If you cache all data going to and from all 
your API calls, your users may not even experience any problems at all when one of the 
components of your architecture goes down. Not only does this architecture spread the 
risks of losing different components, it also spreads hardware usage, 
meaning you can downgrade your main server to a smaller size, since it won't need to do 
everything in one place any more. If you're lucky, you can use all your connecting 
components for free and it just saves you money.

## It fascinates me
An aspect of this whole architecture that fascinates me a lot is the fact that all 
these applications can work together flawlessly. The applications could be using completely 
different programming languages, yet they work together. As long as they share a 
common data structure or are at least able to parse the same data (JSON, XML), 
they will be compatible. I can provide one great example of this is, because 
I built a search engine for my work. This search engine utilizes Solr, 
which is built on top of Java. I built the main system with PHP, but through JSON exchanges 
I can get information easily.

I like API's, because with only a few simple lines of code, you can trigger a huge 
calculation elsewhere. This event will then return get the exact data you requested, 
the only thing you have to do is ask. You can also use an array of API's to 
improve all the connected applications, not just your own application. 
For example, you can grab data from Facebook and use it to enrich your own data. 
You can then use this data to enrich data in a program like Google tag manager or Salesforce.

API's are amazing to me, so I want to share some platforms to start with. Have a look at:

- [Facebook](https://developers.facebook.com/)
- [Instagram](https://www.instagram.com/developer/)
- [Twitter](https://dev.twitter.com/)
- [Zapier](https://zapier.com/)

If you like to talk about this subject further, follow me on twitter @RJElsinga or 
Instagram @roelof1001.