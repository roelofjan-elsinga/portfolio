---
is_scheduled: false
is_published: false
url: how-aloia-cms-made-me-more-productive
post_date: '2020-03-25'
description: "Aloia CMS is a CMS I'm currently actively developing, so this post is a very obvious milestone in this process.\r\nI love writing blog posts, that's why you see on"
update_date: '2020-03-25 15:08:06'
---
!["Rotating cogs"](/images/articles/rotating-cogs.jpeg)

# How Aloia CMS has made me more productive

Aloia CMS is a CMS I'm currently actively developing, so this post is a very obvious milestone in this process. I love writing blog posts, that's why you see one here every single week. What I don't like about most content management systems that I've used before is that you need to have a certain workflow to be able to work with it. I love writing, but I hate the effort you need to go through to be able to write. I don't want hurdles, I want to write. 

## Taking control of my own workflow
Avoiding hurdles at all cost is one of the reasons I've developed Aloia CMS. In the beginning it was just a headless CMS and markdown files. This was great, because writing in Markdown is something I enjoy doing. Then, when I didn't have a laptop, but still wanted to write a blog post, I wasn't able to. I needed a laptop to write my markdown files, publish them to GitHub and publish the changes on my server. This ruined my workflow, because I once again had hurdles to overcome.  As I mentioned, I don't want to go through hurdles, so I created a dashboard that's accessible on my phone.

## Making extensions possible
As often happens, wishes and requirements of websites change. So did mine. From a simple blog with some recent work, I wanted a website that I could easily extend with extra content types, new pages, and custom content. The old version of Aloia CMS (version 0.x) was not flexible for this any more. The available content types were baked into the CMS, because this was completely fine prior to these requirement changes. I needed a way to make this flexible, so I looked at how Laravel solves this.

Laravel makes uses of a "Model". If you want different content types, you can simply extend that model and add custom behavior to it. This was exactly the kind of flexibility I needed from a CMS, so that's what I built for Aloia CMS. This feature was released in version 1.0.0 in February of 2020 and served it's purpose well. The CMS codebase was leaner because of this.

## Simplifying the upgrade path
I hate hurdles and I didn't want to ruin any one else's day by publishing a breaking change to the CMS without defining a very clear upgrade path. I provided a simple Artisan command that migrates all content that was managed by the CMS to the new format. Running this command took a few milliseconds. That's a lot quicker than manually migrating any and all content that was previously supported and now was considered legacy. Providing this helper help me to migrate my entire website from version 0.x to 1.x. I hate hurdles and don't want to be the one to create them either.

With the release of version 1.0.0, I deprecated most of the old code, but kept it in place. This old code had one purpose left, migrate the old content to a new format. These deprecated scripts would make it more inviting to upgrade from 0.x to 1.x, because theoretically, you didn't "have to" upgrade. The old code still worked. If you want a new version with some new shiny features, but you can't be bothered to execute one command, you're still able to use the system.

## Simplifying the file structure
In the old version of Aloia CMS, the file structure was kind of all over the place. It needed multiple files to manage content and its meta data. When I started to post on dev.to and created a [documentation website for Aloia CMS](https://aloiacms.com), I was introduced to the concept of front matter. This was a huge revelation, because this allowed me to keep the content and meta data in a structured manner in a single file. For me, this was the way forward. Starting with Aloia CMS 1.0.0, front matter was the way to embed meta data into your content files. All content types have some meta data, which meant that I could put this into the base Model. Any model that extend the base model can now easily save meta data and content to a file. without having to worry about the underlying code. The CMS was once again working for me, not the other way around.

## Conclusion
Through this entire process I've gone through iterations of "How can I annoy myself less". If I find something that seems weird or looks like a hurdle, it's something that most likely gets changed in the next version. Since Aloia CMS at the core is still a headless CMS, it has no specific workflow. By consciously separating the dashboard and underlying CMS, I was able to create a dashboard that does exactly what I want it to. If you have different needs for a dashboard, you can very easily build something yourself and interact with the core CMS that way. Workflows are just a highly individual thing and really shouldn't be something forced upon you by the creators. The creators should give you the core functionality and allow you to shape your own workflow. 

If you have a Laravel project that you'd like to add basic CMS functionalities to you should defintely have a look at [Aloia CMS](https://aloiacms.com). Even though I'm highly biased because I built it, it's actually a really nice way to add a CMS to your Laravel application without needing a database or have any external dependencies.