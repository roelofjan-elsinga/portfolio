---
title: 'The techstack I used to build this website'
description: 'On this page I explain how I''ve built my portfolio website in detail, including links to the techniques used.'
summary: 'On this page I explain how I''ve built my portfolio website in detail, including links to the techniques used.'
template_name: public
update_date: '2020-06-03 10:35:11'
in_menu: false
is_homepage: false
image: 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg'
category: home
menu_name: ''
post_date: ''
is_published: true
is_scheduled: false
url: /how-i-built-this-website
meta_data: null
author: null
canonical: ''
keywords: null
---
## The techstack I used to build this website

I've built this website with a few different technologies. Some of them I use more often than others:

#### DigitalOcean
For years, I've hosted most of my projects on a droplet from [DigitalOcean](https://m.do.co/c/8c63b70c9106). The main thing that caught my attention was that I could get a private server for only $5 per month. These days I just really appreciate the simplistic interface and the ability to manage a server with a few clicks. I know this sounds like a sales pitch, but it's my honest opinion.

#### Apache
The webserver for this website is Apache. Even though I'm mostly using Nginx these days, I maintain my Apache skills a little bit by hosting this website with it. Several years ago I started hosting on this server with Apache and it's never given me a problem (read: excuse to switch to Nginx). I take the "if it's not broken, don't fix it" approach in this case. I will probably switch to Nginx in the future, but not because Apache is not a great webserver.  
            
#### Laravel
I've used [Laravel](https://laravel.com/) to keep everything in place and to serve the content on this website. I've been using Laravel for every single project for the past 4 years and keep discovering new features every day.

#### Aloia CMS
Aloia CMS is a drop-in flat file content management system and I use it to make it easier for me to manage my content when I'm not close to my laptop. This way I can create and update content from my phone, while I'm not at home, or really any other scenario. If you're interested to find out more, you can look at the project on [aloiacms.com](https://aloiacms.com).

#### Tailwindcss + SCSS
I'm a full-stack web developer and no front-end developer, so I know how to CSS, because it's part of my job. However, I don't find writing CSS enjoyable or 
interesting in any way. This is why I'm using [Tailwindcss](https://tailwindcss.com/) for all styling on this website. When the utility classes get repetitive, I replace them with reusable classes which are all defined in SCSS files.

#### Markdown
Do you enjoy all the content on this website? Well that's all written in 
<a href="https://www.markdownguide.org/" class="link link--underline">Markdown</a>. That's right...this website doesn't make use of a database. Since this is a simple website with some content, I'm simply writing all content in markdown files, just like I would on Github. This helps me focus on the content rather than the styling.

#### XML
Aloia CMS generates several XML files automatically when blog posts are published. These files include a 
<a href="https://roelofjanelsinga.com/sitemap.xml" class="link link--underline">sitemap</a> of all of the pages on this website, the second is an 
<a href="https://roelofjanelsinga.com/feed" class="link link--underline">Atom feed</a> and 
<a href="https://roelofjanelsinga.com/feed/rss" class="link link--underline">RSS feed</a> for all of my blog posts.

#### Design inspiration
I'm not a great designer, so I couldn't have built this website without an excellent example made by <a href="http://www.gilhuybrecht.com/" class="link link--underline">Gil Huybrecht</a>. 

#### Want to dig in the code?
You can check out all source code for this website on <a href="https://github.com/roelofjan-elsinga/portfolio" class="link link--underline">Github</a>.
