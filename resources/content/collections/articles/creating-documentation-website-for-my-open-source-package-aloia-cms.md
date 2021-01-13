---
update_date: '2021-01-13 13:58:34'
description: 'Creating a documentation website for my open source package Aloia CMS'
is_scheduled: false
is_published: true
post_date: '2019-11-20'
url: creating-documentation-website-for-my-open-source-package-aloia-cms
linkedin_post: ''
twitter_post: ''
tags:
    - aloia-cms
---
!["Aloia cms documentation website"](/images/articles/aloia-cms-documentation-website.png)
# Creating a documentation website for my open-source package Aloia CMS
As some of you might know, I've been working on a content management system. I've described [Why I built my own CMS](/articles/why-built-my-own-cms) in an earlier post. Then, after I wrote [How to write good documentation](/articles/how-to-write-good-documentation) I thought to myself: "I just wrote about this, but I'm talking the talk and not walking the walk". 
Let's change this and make it as easy as possible to read the documentation and make amendments to it.

## Let's host the website on GitHub Pages
After the initial realization that I have poor documentation for my project, I started looking into some ways to make the documentation more accessible to people other than me. I quickly landed on GitHub Pages for hosting the website, as this requires no effort on my side to host the website, take care of SSL certificates and some other basic stuff. I wanted to encourage myself to actually write good documentation and if I had to take care of all of those things first, it just becomes a burden and I won't want to write anything. 

As you know, GitHub Pages only hosts static websites, but I wasn't ready to write plain HTML and CSS, because where's the fun in that? I remembered from back in the day that Jekyll is a static site generator and guess what? GitHub Pages supports Jekyll. This meant I found what I needed to get started. 

## Get a basic website out of the door
I knew I wanted to use Jekyll, but I had no clue how to make a Jekyll project and what to do. After trying to create my own project from scratch I was ready to give up. I had no clue what was going on and this took too much effort to get something simple out of the door. However, after some browsing, I found there was such a thing as Jekyll templates. Great, a chance for me to take a shortcut. I created a very basic website and published this. Below you'll find a screenshot of what it looked like:

!["First version of Aloia cms website"](/images/articles/first-version-of-aloia-cms-website.png)
<span class="caption">This was the very first version of the website</span>

As you can see, it's very basic and makes heavy use of the existing template. This was a good start, but there isn't any documentation at all. 

## Time to write some basic documentation
After publishing the first version of the documentation website, I kept working on a newer, less basic version. The current version of [the documentation website](https://aloiacms.com/) is still quite basic but has some branding and actual documentation. The biggest challenge is to figure out what to document and what to leave out. I decided to start out with some very basic things like what the project is and for whom this project is. The next logical things to document are what system requirements need to be met and how to install the content management system in Laravel applications. 

I included a page that describes some plugins I've written for the content management system because I use them for my projects (this website is one of them) and it has a lot of added benefit for me. This is not strictly documentation per se, but it does help people understand what the project is and what it's not. The project is a drop-in CMS for established projects, it's not a standalone CMS. 