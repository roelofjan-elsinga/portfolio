---
image_url: /images/work/plantcareforbeginners_1920x1080.jpg
image_alt: Plant care for beginners homepage
title: Plant care for beginners
description: >
  With Plant care for beginners I'm sharing my experiences about caring for plants. I want to help to
  educate others about keeping their plants healthy and how to help them thrive.
url: /portfolio/plantcareforbeginners
project_url: https://plantcareforbeginners.com/
active: true
publish_date: 2019-04-23
---

![Plant care for beginners](/images/work/plantcareforbeginners_1920x1080.jpg "Plant care for beginners homepage")

# Plant care for beginners

With Plant care for beginners I'm sharing my experiences about caring for plants. I want to help to 
educate others about keeping their plants healthy and how to help them thrive. The goal is to write 
about plants I actually care for myself, so I can write about all kinds of tips and tricks that you 
may not know if you just copy and paste other guides.

## What's my role in this project?
My role in this project is doing everything, from design work, creating content and sharing this on 
social media. This has already taught me a lot about reaching the target audience in a place they 
hang out, in this case Instagram. 

## Tools used
To accomplish this goal, there were several tools I used:
- PHP (laravel)
- SCSS (+tailwindcss)

Yes, that's really it. This project is a flat file website. This means that I don't make use of a 
database, but all configuration and content is saved into files on the server. These files are parsed 
to generate meta tags and HTML articles.

## Automation
Because I like to work with API's and automate a lot of processes, I've done a fair amount of automation 
for this project. Everything from pulling in the Instagram feed, to publishing articles, generating sitemaps, 
and generating an RSS feed is all done automatically. The only thing I have to do is create content and 
the system does the rest for me. 

### Pulling in the Instagram posts
When the Instagram feed is pulled in, I keep track of the post URL, image URL, and the post date. These are 
all saved in JSON files, so I can just parse that and serve the content on the homepage. There is no API 
connection necessary to display these images. The Instagram API is currently accessed once a day through a 
cronjob. All the new posts and updated posts are saved to the JSON file and the changes are committed to Git 
with a clear commit message.

### Publishing the blog posts
All blog post meta data is saved in a JSON file, this file also contains the publish date and whether the 
post has been published or not. A cronjob checks the system every day if a post needs to be published. 
If it does, then it'll mark the post as published, generate a sitemap, generate an updated RSS feed, 
and commit all the changes to Git with a clear message. This is very nice, because I never have to think 
about publishing a post manually again and submitting it to Google to index. Yes it even submits the sitemap 
to Google automatically.


<a href="https://plantcareforbeginners.com/" target="_blank" class="link link--underline">View the website</a>
