---
description: 'In January of 2020, I started learning Go. In these past 9 months, I''ve been able to build multiple applications to contribute to faster applications, easier deployments, and more stability in the infrastructure. In this post, I go over what I''ve built and what I learned.'
post_date: '2020-09-17'
is_published: true
is_scheduled: false
update_date: '2020-09-16 14:04:25'
linkedin_post: 'In January of 2020, I started learning Go. In these past 9 months, I''ve been able to build multiple applications to contribute to faster applications, easier deployments, and more stability in the infrastructure. The simplicity of the language and amazing performance were very compelling reasons to pick up Go. In this post, I go over what I''ve built and what I learned.'
twitter_post: ''
---

![Go logo](/images/articles/cli-tool-in-go.png)
# Learning Go: What I've learned in 9 months
If you've developed any applications that run on servers, you have probably heard of Go (Golang). It's a compiled language with very little moving parts, so you won't have to spend a long time to get to know the programming language and start building applications with it. Besides being relatively easy to learn, it's also known for being lightning fast, because the code you write is compiled into binaries, which can run on your system natively. 

Those two aspects, quick to learn and amazing performance, compelled me to pick it up in January of this year (2020). There were a few things that I had been optimizing in PHP for months and just didn't get the performance improvements I was hoping for.

Once I figured out how to use Go, I had 2 applications running in production within 2 weeks of picking it up. Now, 9 months later, I've sprinkled some Go here and there to improve performance significantly on multiple occasions. 

These are some of the projects I've developed in those 9 months:
1. A CLI application to index documents into Apache Solr using its REST API
2. A GraphQL server as an API Gateway for REST endpoints using [graphql-go/graphql](https://github.com/graphql-go/graphql)
3. A Drop-in utility webserver to improve existing data processing performance using [Echo](https://echo.labstack.com/)

In this post, I'll go over these 3 projects and explain what I've learned from them and why they came into existence.

## CLI Application to index documents in Apache Solr
![Solr logo](/images/articles/solr_logo.png)
CLI applications are a great way to pack a lot of functionality into a little package and perform tasks very effectively and predictably. The CLI application to index documents in Apache Solr didn't start out that way. The 2 applications I mentioned in the intro were designed to each take over a small part of this process. I used both applications as filters to reduce the amount of data going through PHP. After merging these applications, it turned out that 60% of the entire process was now in Go and the performance boost was significant. 

### Overcoming bottlenecks
As the new execution time of this script was mere milliseconds instead of seconds, an unexpected bottleneck showed up: HTTP latency. The latency was "only" 10 milliseconds, but this is quite significant when the total execution time is now 5 milliseconds instead of 5 seconds. The fact that I was bottlenecked by HTTP, motivated me to migrate more from PHP to Go. Over the course of a month, I had migrated the entire data processing script to Go. 

Once again, I ran into a bottleneck: PHP was still responsible for retrieving data from the databases, send it to the Go server, and index the data in Apache Solr. As it's PHP, these steps were executed sequentially, rather than concurrently. But Go was built for concurrency, so why not just migrate everything and let PHP delegate tasks instead of performing them? That's exactly what I did. As I no longer needed complex data from PHP and I didn't have to return any data, I no longer needed a web server and converted the application to a CLI tool.

### Clearer path of execution
Months later, this CLI tool is still going strong and works like this: PHP executes the binary with basic input arguments, Go retrieves all data from the database, processes it, and then submits it to Apache Solr. Rather than doing generating documents sequentially, it's done concurrently.

I learned to identify parts of larger processes that could be improved by outsourcing the execution to Go. Identifying these parts was the toughest challenge, harder than learning Go and building the applications.

I've written several blog posts about this topic, in case you'd like to get more in-depth:
- [The impact of migrating from PHP to Golang](/articles/the-impact-of-migrating-from-php-to-golang)
- [Building CLI applications with Go](/articles/building-cli-applications-with-go)

## GraphQL server as an API Gateway
![Golang with GraphQL](/images/articles/golang-with-graphql.png)
GraphQL is an amazing abstraction layer for your API enpoints. You can abstract many different systems without exposing these to the consumer of your API. Another benefit is that you can point your API consumers to a single, self-documenting, place to retrieve all of their data instead of making them fetch their data from 4 different places and combine it on their side. GraphQL serves as an API gateway.

### Chasing performance
I've built a GraphQL server in PHP in the past and this worked quite well, but the performance wasn't always great when you're fetching a lot of data. As I'd just finished the CLI Application and saw the performance boosts there, I decided to build a GraphQL server in Go. The idea was to migrate the slowest parts of the GraphQL server in PHP first and see where to go from there. 

The biggest challenge was the different way these two GraphQL implementations are positioned into the architecture. The GraphQL server in PHP is built into the platform, but the GraphQL server in Go is a standalone API gateway that utilizes existing API endpoints to retrieve data.

Now, after having worked with the standalone API gateway for a few weeks, I'm glad to say that this approach is working well. Managing dataflows is much easier if you're treating the GraphQL server as an API gateway instead of a query language for a database. 

I've written more about this project here:
- [GraphQL: Centralize existing REST API endpoints for easier development](/articles/graphql-centralize-existing-rest-api-endpoints)

## Utility webserver for data processing performance boost
!["PHP plus Golang"](/images/articles/php-plus-golang.jpg)
This utility web server looks a lot like the two filter applications I developed in the first two weeks of using Go. It's processing larger amounts of data much more efficiently than PHP could and returns only that which PHP needs to perform its tasks. This web server improved the runtime of this particular process from 10-20 seconds to 3-4ms. 

### Suggestion actions through API responses
A summary of this application is this: The application takes a list of existing items from the database and a list of items retrieved from an API endpoint. The list of items from the API endpoint is the source of truth and the application needs to determine what to do with all of the items. 

These are the actions it recommends for the PHP script:
1. Create a new item (item doesn't exist, but is found in the list from the API endpoint)
2. Update an item (item has been changed in the list of the API endpoint)
3. Do nothing (item already exists and hasn't been changed)
4. Delete an item (item was not found in the list from the API endpoint)

### Bottlenecks of sequential execution
This isn't very difficult to do by itself, but if you have two large lists, it's a slow process. This was never a problem in PHP, because these lists were usually limited to 10 items each. But when they started to grow to hundreds each, sequential execution of this became problematic. Doing this cycle once, twice, or ten times is no problem, but it adds up if you need to do it thousands of times. Go is able to do this much faster and instruct PHP what to do with these items in milliseconds, rather than seconds. The calculations are still done sequentially, because the delegation is still done in PHP, but the performance boost from seconds to milliseconds is a huge improvement. 

If the past tells me anything, this entire process might be migrated to in its entirety Go by next year.

## TLDR
I started learning Go in January (2020) and it has been an amazing journey for the past months. I've learned to write entire applications in a few days, rather than a few weeks or months. The simplicity of the language and the performance boosts it brings are very compelling reasons to start learning it. 

Over the past months of working with Go, I've developed multiple notable applications, that have run in production at some point, of which most are still around. Outsourcing some of the more resource intensive processes from PHP to Go has contributed to faster applications, easier deployments, and overall more stability. Memory issues and sitting around waiting for something to finish are in the past now. 

The biggest challenges weren't learning Go or developing the applications, but determining what and how much to migrate to solve the problems. The choice to migrate something is always based on the effort it takes versus the headaches it resolves. So far, more headaches have been resolved than the effort it took. 