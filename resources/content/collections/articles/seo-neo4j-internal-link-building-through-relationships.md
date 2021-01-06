---
description: 'Internal link building is a great way to signal to search engines which pages are the most important to you on your website. In this post, I''m going over 3 iterations of internal link building I''ve implemented in the past 18 months and how I''ve tried to make increasingly more relevant links between pieces of content.'
post_date: '2021-01-06'
is_published: true
is_scheduled: false
update_date: '2021-01-06 16:23:56'
linkedin_post: ''
twitter_post: ''
---
![Neo4j Logo](/images/articles/neo4j-logo.png "Neo4j Logo")
# SEO & Neo4j: Internal link building through relationships
Internal link building is a great way to signal to search engines which pages are the most important on your website. However, you can also use internal links as a way to group content and give individual pieces of content more context. If you have a blog with 5 posts, this process isn't very difficult and time-consuming. However, when you have over 25 posts this becomes increasingly difficult and you need to look for some ways to link pieces of content together automatically. 

In this post, I'm going to highlight the progress I've made with a project of mine: [Plant care for Beginners](https://plantcareforbeginners.com). I'll go over the 3 iterations of internal link building I've implemented in the past 18 months and how I've tried to make increasingly more relevant links between pieces of content. 

These 3 versions are:
1. [Link the 3 most recent guides](#recent)
2. [Link the 3 most relevant guides (based on tags)](#tags)
3. [Link the 3 most relevant guides (based on tags and reader behavior)](#behavior)

Let's get into the 3 iterations of link building and why I chose to move from one to the other.

## 1. Link the 3 most recent guides {#recent}
When I started linking guides together, I only did this to keep visitors on the website by giving them more content to read. Prior to this, the content was the content and there weren't any suggestions for "Other content you might enjoy". To start out, I've listed the 3 most recent guides under every other guide. This way, readers had somewhere to go after the finished reading the guide. 

It was an improvement on the current situation, but it didn't benefit the SEO rankings of the website as much as I expected it would. Why? Well, every time a new guide was published, every guide was linking to the new guide, whether it was relevant to the current topic or not. This might give the new guide a little bit of "link juice", but more often than not, readers wouldn't click on the link to the new guide, because it wasn't relevant to the content they were reading at that point in time. The new guide didn't offer them what they wanted or needed, so the "link juice" was wasted.

## 2. Link the 3 most relevant guides (based on tags) {#tags}
A logical next step was to manually suggest related content. The easiest way to add some sort of relevancy to any piece of content is by adding tags, a lot of them. By adding tags, I was able to create groups of related content. The more tags two guides have in common, the more relevant they likely are for each other.

I implemented a tag-based relevancy model and the results were quite good. Most linked guides had something in common with the guide the reader was currently on. However, purely matching based on tags and sorting which guide had the most tags in common is still not completely accurate. More than a few times I had seen a suggested guide under the content that was vaguely related to the content, but I knew there were guides that were much more relevant to the current guide. There just wasn't a good way to fix this using only tags (without playing the system and adding more tags).

## 3. Link the 3 most relevant guides (based on tags and reader behavior) {#behavior}
I asked myself: "How can you add more relevancy between guides?" The simple (yet not so simple) answer I found was by looking at reader behavior. Which guides do readers look at in a single session? After reading a guide, do they look for more information or do they leave? With that idea, I looked at some ways to "calculate" which guides are most relevant based on tags and reader behavior. I couldn't use the current system, flat files, because that would be far too slow. MySQL also wasn't a great option because it's too much data and too many joins in a query, this would be too slow. 

Then I found Neo4j, a lightning fast graph database where relationships are a core concept. Using Neo4j, I can quickly and easily find the most relevant guides other readers looked at after looking at the current guide. Combine this with the most relevant guide (based on tags) and I can find the 3 most relevant guides for a guide within milliseconds. This is a great solution, because:
- This is quick enough for production use
- It helps the readers find content that is related to what they're reading right now
- It signals the search engines and other crawlers which pieces of content belong together and give each other context

Using this new model to find the most related content, I'm able to help both person and machine. This is what I was looking for since the beginning and it the perfect solution for me at this point in time.

## Conclusion
Through 3 iterations I've tried to group content using tags and reader behavior by linking between the different pieces of content. I've used this strategy to signal to crawlers and search engines which content adds context to other pieces of content, while adding to the UX of my readers. By adding tags to the different pieces of content, I've been able to influence the relevant links between pages a little bit, but this wasn't quite water tight. By adding reader behavior to this data model, I've been able to show people the content that I think is relevant to them, but also what other readers, that are reading the same page, find relevant.

In this case, readers are helping each other find relevant content without having to do anything more than read what's available. In an ideal world, I won't have to use tags any more, because the model will be able to figure out what readers should read next. But that's still in the future and might be a post a year down the road.