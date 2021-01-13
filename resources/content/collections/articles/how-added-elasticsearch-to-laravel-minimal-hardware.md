---
update_date: '2021-01-13 13:54:05'
description: 'In this post, I go over the steps I have taken to add Elasticsearch to an existing Laravel application on very minimal hardware resources. I also discuss the hurdles I had to overcome to achieve this.'
is_scheduled: false
is_published: true
post_date: '2020-03-11'
url: how-added-elasticsearch-to-laravel-minimal-hardware
linkedin_post: ''
twitter_post: ''
tags:
    - laravel
    - elasticsearch
---
!["Cro tool homepage"](/images/articles/cro-tool-homepage.jpg)
# How I added Elasticsearch to a Laravel application on a server with minimal resources

Recently I've replaced the search functionality on [cro-tool.com](https://cro-tool.com) from a database-driven search engine to Elasticsearch. This wasn't an easy process and there were several hurdles to overcome, but the final result was worth all the effort it took to put this together.

Let's start at the beginning. Before this transition, I had to specify which fields I wanted to search in, how these results should be ordered on the search page, and how the fields should be matched (LIKE %%, etc.). This meant a lot of manual work went on to displaying search results correctly. Joins and where clauses were used to find records, but what happens when none of the results matched the SQL query? Well, there were no results. SQL databases don't really understand relevancy in records, so it took manual work to accomplish something similar to what's already built-in into dedicated search engines.

## Elasticsearch to the rescue

The last problem I highlighted in the previous paragraph, displaying relevant search results, was something I wanted to solve because I'd rather show less relevant search results than no search results at all. A search engine is great at enabling you to do this. To find a good option for a search engine, I looked at my own experience. I work with Apache Solr on a daily basis and I love using it. But I also know it can be heavy on the resources. So I went with Elasticsearch instead. I knew the server resources were very limited, so going with an actual search engine was already a gamble. I thought that Elasticsearch was lower on resource usage, but this thought is based on thin air and I haven't actually checked if this is accurate. 

I knew Laravel has an official package, called laravel/scout, which has a few implementations that enable you to use Elasticsearch as the search engine, instead of Algolia. This was another reason for me to use Elasticsearch because it'd be able to quickly integrate it into the existing Laravel application, without rewriting a lot of the existing logic.

## Integration Elasticsearch in Laravel

I knew I was going to use Elasticsearch and I knew I was going to use laravel/scout, so I searched for a composer package to connect these two and found matchish/laravel-scout-elasticsearch. It seems to be fully featured and even allows you to customize the request before it is sent to the search engine, perfect!

After installing the package and publishing the configuration files I went to work and set up the code needed to be able to index documents into Elasticsearch.

## Setting up Elasticsearch

If you know me, you know I'm a huge fan of Docker and docker-compose. So naturally I set up the docker-compose.yml file to launch an Elasticsearch server for me, this is the configuration I used:

```yml
version: "2.3"
services:
  elasticsearch:
    image: elasticsearch:7.6.1
    container_name: elasticsearch
    environment:
      - discovery.type=single-node
      - "ES_JAVA_OPTS=-Xms256m -Xmx256m"
    ports:
      - "127.0.0.1:9200:9200"
    volumes:
      - ./storage/elasticsearch:/usr/share/elasticsearch/data
```

As you can see, I tell the Java runtime engine to only use 256mb of RAM. This is a very small amount, but the data set is not very large and I'm dealing with a server with low resources. The docker-compose file also tells the Elasticsearch container to open up port 9200, but only on the localhost. I don't want to open this server to the internet and only applications on the same machine can access it directly. As you can see, I've included a volume, so all data in Elasticsearch will be written to the storage/elasticsearch folder in your Laravel application. This folder obviously contains a .gitignore file, because I don't want this data in my Git repository.

## Deploying the new search engine

When the search functionality was converted from database queries to API requests to Elasticsearch, it was time to deploy everything. Everything went well...until I tried to run the Elasticsearch docker container. The server didn't have enough RAM to run the Java Runtime and the container refused to launch. This was the moment I had to get creative with my solutions.

## Solving memory issues

I had two options: upgrade the server or migrate the current Apache installation to Nginx. I chose the latter for the following reason: Apache uses more RAM, even when no one is visiting the website. It spawns workers and keeps them open until new visitors are there to use them. Nginx, on the other hand, is able to spawn workers as they're needed. This means that if there is no one on the website, it's not spawning any workers and that means it runs much lighter on idle. When there are more visitors, Apache keeps spawning workers for new visitors and this adds up over time. Nginx uses these workers much more efficiently and is able to serve these visitors with fewer resources. This is why I thought that switching to Nginx might give me enough free resources to be able to launch Elasticsearch.

After the migration, I was indeed able to launch Elasticsearch, as the RAM usage was several times lower using Nginx than Apache. Even when multiple people were visiting the website, the RAM usage stayed under control. This is partly because I specified the maximum amount of memory the Java Runtime is allowed to use for Elasticsearch.

## Conclusion

Running Elasticsearch on a server with low resources is possible, but it's not something that's going to be easy to accomplish at all times. For this particular situation, I had to migrate the current Apache installation to Nginx in order to launch the Elasticsearch container with Docker. The final result is great because you get the functionality of a full-blown search engine on server hardware that would otherwise not even be considered to be enough. Of course, this is not a permanent solution, because as soon as the website gets busier, the server resources will need to be upgraded. This solution does allow me to drag that process out a little bit longer though, and that's never a bad thing.