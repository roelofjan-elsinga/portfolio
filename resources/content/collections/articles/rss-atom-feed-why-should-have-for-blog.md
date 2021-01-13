---
update_date: '2021-01-13 13:57:19'
description: 'RSS/Atom feed: Why you should have one for your blog. In this post I talk about why you should have syndication feeds for your blog. You can easily and quickly share your content to many different platforms without doing any of the work yourself.'
is_scheduled: false
is_published: true
post_date: '2019-12-11'
url: rss-atom-feed-why-should-have-for-blog
linkedin_post: ''
twitter_post: ''
tags:
    - rss
---
!["RSS logo"](/images/articles/rss-logo.png)
# RSS/Atom feed: Why you should have one for your blog
RSS (Really Simple Syndication) and Atom (Atom Syndication Format) are two ways to syndicate your content across platforms. A lot of people have heard about RSS in some way or another, but fewer people know Atom. Atom is just a more modern version of RSS, but they serve the same purpose: Sharing updates from a source to different destinations. In this post, I'll explain why you should be using a feed, be it Atom or RSS, for your blog. If you're wondering what the differences are between RSS and Atom, you can read about it on [Wikipedia](https://en.wikipedia.org/wiki/Atom_(Web_standard)#Atom_compared_to_RSS_2.0).

## Syndication? What does that mean?
Before I continue, it might be a good idea to explain what syndication actually means. In the journalism world, according to [Dictionary.com](https://www.dictionary.com/browse/syndication?s=t), a syndicate is an agency that acquires content from different sources and distributes that content for simultaneous publication in many different channels (newspapers, websites, etc.). This means a central location can acquire content from all kinds of different locations and then publish that content from a single source to a lot of different places. So to put this in perspective for this blog: This blog contains content from different sources, in this case: me, the writer, and publishes this to a lot of different sources at the same time. So syndication is the process of acquiring and then publishing the content. If you need some more information, the link to Dictionary.com mentioned earlier shows more meanings. Now, let's get into why you should have a syndication feed for your blog.

## Spreading your blog posts far and wide
When you're hosting your blog by yourself, or even when you host it on a website like wordpress.com, you will hopefully publish posts regularly. To reach the maximum amount of people, it's best to post your blog posts in as many places as possible. For example when this blog post publishes, it's automatically posted to [dev.to](https://dev.to/roelofjanelsinga), [MailChimp](https://mailchi.mp/d405013025c9/roelofjanelsinga), [Pinterest](https://nl.pinterest.com/roelofelsinga/blog-posts/), and several RSS readers. So when I publish a post, not only does it appear on my blog, it will be visible in many more places to reach a much larger audience. This is partly because my audience most likely has no clue this blog even exists, but it's also a convenience for them because they get to read my blogs in the places they already visit. So it's a win-win because my content gets read and people don't have to go out of their way to consume my content. 

An easy way for a content creator to reach the target audience is to go to the places where the target audience hangs out. Manually posting your content there could take a lot of time depending on the number of channels you're going through. So being able to do this automatically relieves a lot of pain and saves you a lot of time.

## Automation is exciting
A lot of services can consume and produce an RSS or Atom feed. This makes automation incredibly simple because you only have to update the feed on your blog and all these other services will pick it up. They will then perform some task for you. You don't have to manually tell those services that you published a new post, they will retrieve it from your website. This means that you don't have to do anything yourself when you want to share your blog posts. This is in contrast with sending API requests to other platforms telling them an update is available. You don't have to write any implementation details for sharing your content, but rather, you can use this standardized system to create the feed in one place and then hang back and relax until the other services request the feed and pick up your content. 

## But...RSS is dead, right?
A lot of people think syndication feeds are this outdated technology people used a decade ago. I used to be one of those people until I discovered it's true potential. Syndication feeds allow you to tailor your newsfeed exactly the way you want it to. Instead of going through a newsfeed that's been created by something like a newspaper, where you see every single news article, you can pick and choose which channels you would like to see. This sounds oddly familiar, doesn't it? It sounds like a social media platform, where you decide who you want to follow and hear more from. 

So really, syndication feeds are very modern but get a bad reputation "because it's so old and rusty". Do you know how Spotify, Apple Podcasts, Sticher, and all the other podcast players know which episodes are within a podcast? That's right, RSS. If you've been on Facebook and Twitter in the last year or two, you'll have noticed that you keep missing posts of your friends and people you follow. "I posted this yesterday, didn't you see it?" is what has probably been asked a lot in the past two years. The fact is that no, that person probably hasn't seen your post. This is because news feeds are no longer sorted chronologically, but they go through an algorithm and are sorted by maximum engagement. 

The platforms are trying to keep you on the platform, so they're trying to push content you'll most likely interact with. If you're tired of this, you can sometimes change the settings to show the news feed in chronological order. If not, you always have the option to subscribe to a syndication feed (most platforms have them, just use your favorite search engine). This way, the content is always chronological. You have more things to do in a day than to be on Twitter and Facebook, unless that's your job of course. So take control of your news feed, consume some of the newest pieces of content and get on with your day. So in a way, syndication feeds are a great way to break out of the engagement trap and get on with your day.

## Is implementing a syndication feed difficult?
After reading this far, you might be convinced that a syndication feed is a great thing to have, but now you wonder if it's difficult to implement in your blog. If you're hosting your blog on a blogging service, you most likely already have an RSS or Atom feed for your content. Just look through your settings or use a search engine to find out where to get the link for it. If you're hosting your own custom website, there are open source solutions for this. If you're using PHP and/or my open source CMS, then you can use one of the following packages to help you create your syndication feeds:

- [Atom Feed Generator](https://github.com/roelofjan-elsinga/atom-feed-generator) (plain PHP)
- [RSS Feed Generator](https://github.com/roelofjan-elsinga/rss-feed-generator) (plain PHP)
- [AloiaCMS Publishing Module](https://github.com/roelofjan-elsinga/flat-file-cms-publish) (plugin for my CMS)

In the first two links, you'll also find some examples of what an Atom and RSS feed looks like, so you can always create a feed by hand if you don't want to use any generator or server scripts.

## Conclusion
We're here, at the end. I hope I've convinced or at least informed you about using a syndication feed for your blog. It has helped me out a lot already and adding new content to it is an automatic process for my [CMS](https://aloiacms.com), so I don't even have to worry about it anymore. When my posts get published, they automatically get shared with 4 different platforms and those platforms perform tasks automatically, so I can forget about them. By having these syndication feeds, I can focus on writing blog posts and leave the sharing of content to my [CMS](https://aloiacms.com). If this is something you're looking for as well, I'd highly recommend to embrace this "old" technology and use it for what it does best: sharing your content.

If you have any questions you can contact me on [Twitter](https://twitter.com/RJElsinga) and I'll do my best to answer them for you. If you are looking for an open-source PHP content management system, I'd like to direct you to the website: [AloiaCMS](https://aloiacms.com). You can install it yourself for free.