---
description: 'There are many amazing alternatives to using a database to store data for your website. Find out why I chose to use static files to store all content for my blog.'
is_scheduled: false
is_published: true
post_date: '2019-03-25'
url: why-i-dont-use-database-for-my-blog
---

!["Why I don't use a database for my blog"](/images/articles/stack_wood.jpeg)

# Why I don't use a database for my blog
A database is a go-to way to store data for most developers, 
and for a great reason: It's really great at retaining data. 
Then why did I decide to not use a database for my blog and instead opt 
for JSON/YAML/Markdown files? Simple! **Portability, version control, 
and performance.** Oh, and it's fun to learn something new...

## Portability
When I did a redesign of my old website, it was still using a database. 
I hadn't worked on the website for about 2 years. I pulled the code from Github 
and tried to launch it on my local machine. I got it to work, but obviously, 
I didn't have any data for it to display. I didn't have a local installation 
of MySQL and didn't find a good reason to install a database engine, 
download a database, and import it just for 5-6 previous work records 
and about 30 content blocks that I was going to replace anyway. 
So I decided to use Markdown for the previous work and just get rid of the 
database altogether.

This meant that no matter where I opened the local version of my blog, 
I had all my content available without any hurdles. There was no need for 
an external system, just a Laravel application with a few content files. 
This means I have a consistent development and production environment and 
I can set up an identical blog in another place in about 2 minutes without 
any configuration.

Working with files instead of a CMS with a database, allows me to use any 
file type I want. I chose to use Markdown files for my content. 
Only having to care about the importance of titles, texts, 
and other basic content types is very liberating. When working with any other 
CMS I've always felt like I was bound to HTML. 
If I wanted to add another paragraph, I had to either use a great editor to 
generate this for me or manually write HTML elements. This got very tedious, 
slowly stopping me from creating content altogether. This is very sad because 
I love creating content, but the means I had to go through to create it 
just sucked the joy out of it for me. Being able to use markdown and just 
completely letting go of this has rejuvenated my pleasure of creating content. 

## Version control
All my content is kept in files, which means you can keep these files in 
some kind of version control. This is probably one of my favorite "features" 
of this project. I can see exactly when I've made changes to my posts, 
as you would in WordPress, but without any database. 
I have a wide range of options for a Git GUI, or just the command line if 
that's what I feel like at that moment. I can edit any of my posts on any 
system that supports Git, and have it available on another system 
if and when I need it. This might sound like a silly gimmick to you, 
but I write my posts on 3 devices at any point in time. 

## Performance
Fetching data from a database has been the biggest bottleneck of any of my 
projects. This could be due to sloppy query design, but often it has to 
do with the fact that your system is requesting an external service for 
some data. Even if the database is on the same machine, there could be a 
slight delay between fetching and receiving data. When you have a remote 
database, you will instantly notice a performance drop, because data is 
fetched through an internet connection. There are simply too many variables 
for me, especially for a simple blog. The application just needs to read 
data and display it to the user, adding an external dependency for this 
seemed like unnecessary complexity. 

Having all content on the same storage device as the application makes 
reading the data near instant. It lets you write the content in whatever 
way you find the easiest to work with. I chose to write some of the 
configurations in JSON and some in YAML and I can do this because I have 
absolute control over the way I decided to save my content. You can make 
this as simple or as complicated as you want yourself. This way you can 
very quickly add or change content in a way you're comfortable with.

## It's fun to learn something new
If I wanted to do the same old thing, I would've used a database. 
But then I would've missed out on a lot of learning opportunities. 
Because by restricting myself by not allowing myself to use a database, 
I learned to parse YAML files and handle data saved in other file types 
and use it however I see fit. I feel like I'm in absolute control over 
my own content, no matter which device I'm working on and this is very 
freeing and makes creating content a true pleasure.

Have you ever worked on a project that didn't use a traditional database 
to store content? What are your experiences with it? Did you enjoy it or 
absolutely despises it? Let me know on [Twitter](https://twitter.com/RJElsinga)!
