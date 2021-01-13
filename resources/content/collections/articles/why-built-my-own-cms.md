---
update_date: '2021-01-13 14:00:42'
description: 'I''ve always been against building my own CMS. Find out why I decided to build my own CMS anyway and what motivated me to build modules for it.'
is_scheduled: false
is_published: true
post_date: '2019-09-18'
url: why-built-my-own-cms
linkedin_post: ''
twitter_post: ''
tags:
    - aloia-cms
---
!["Screenshot flat file cms dashboard"](/images/articles/screenshot-flat-file-cms-dashboard.png)
# Why I built my own CMS
I've always been against building my own content management system (CMS). When anyone asked me to build something like it, I just went with off-the-shelf solutions like WordPress. This was always enough for me because I wasn't building the websites for myself. I was always convinced that I could create my content more easily by just creating HTML files and serving that as content. Setting up a CMS only cost me time and effort to set it up, connect it to a database, and update it regularly. So why did I end up creating my own CMS anyway? There are two reasons for this:

- If I need anything, I can build it.
- If I don't like it, I can change it.

But you can do this with any other CMS. Yes, you're right. I have nothing to say against that because you're absolutely right in saying that. However, for me, the reasons to build my own CMS went slightly deeper than: "I can do this better". I wanted to learn to solve problems when building an application in a limited environment. 

## How it all started
In the beginning, it wasn't even a CMS. It was simply my portfolio website, running on a Laravel application, with a database to persist the data. I hadn't updated my portfolio website in two years and my blog was running on a subdomain. I gave my website a makeover and wanted to do the same for my blog, to make it blend in with my website. This was a struggle, so I decided to read the data for the blog into the laravel application and serve it from my portfolio instead of my dedicated blog. 

### The reason I moved to a file-based system
This worked really well...until I pulled my website from GitHub to make some adjustments. Now I didn't have any blog posts, portfolio items, or any other content. All of this content was saved in a remote database, protected by a firewall. This meant I had to download two different databases and get this to work on my local machine. I couldn't be bothered to do this, because why would I go through all the trouble just for my portfolio website? Instead, I copied all of my content into HTML files and served them from the filesystem. This worked well and it was fast. All content was available through version control and it didn't matter on which system I was working on my website, the content was always right there. 

## How it turned into a CMS
So why did I make this into a separate CMS module? Well, this is where the story gets interesting. At this time, I started a second blog for [Plant care for Beginners](https://plantcareforbeginners.com). I was convinced of the way I could utilize HTML and Markdown files to serve static content and just edit the content of my posts through my code editor. This helped me decide that I wanted to copy and paste my portfolio website including the blogging section for this new website. And this is literally what I did, you might still be able to find references from this new blog to my old website. I copy/pasted my portfolio, removed all stuff I didn't need and got started on writing content for the plant website. But...I found a bug. When I fixed it, I thought: "Well now I have to fix this bug in 2 places, that's annoying". This led me to extract the CMS into a Composer package. This process was completed in a few days of slowly migrating parts of the websites into the package. In the end, I had a fully headless CMS that was managing all content for both websites: my personal blog and the plant blog. 

### When I got too lazy to write posts on my laptop
This is the moment where I thought: "You know what, I want to be able to edit my content on my phone as well!". At that point, the only way to edit content was to change HTML and Markdown files on my laptop through code editors. This worked well, but what if I had the inspiration to write but wasn't close to a computer? I could edit the post on GitHub in their file editor, but every change would need a commit and I only wrote a few sentences at a time. This would add up to a lot of commits for a single post, not ideal. Initially, I started writing my posts on Google Drive. This worked really well for the longest time. The reason I got tired of that was the fact that after finishing the blog post, I had to copy/paste it to Markdown files, convert the WYSIWYG (What you see is what you get) content to Markdown and then commit and push the changes. I could write the content on my phone, but I couldn't publish it from my phone.

### I wanted to write and publish from anywhere
What I needed was a way to be able to edit my content directly in the browser and then publish it to the world from my phone, so I got to work. I created a new package, called [roelofjan-elsinga/flat-file-cms-gui](https://github.com/roelofjan-elsinga/flat-file-cms-gui). This would simply be a Graphical User Interface (GUI) that utilized my headless CMS to allow me to edit all my content in the browser. I kept adding features, like being able to choose from an HTML or Markdown editor. This helped me to support some of my earlier posts that were all written in HTML files. Since all of my newer posts are written in Markdown, I added a markdown editor in the GUI, which allowed me to create and edit posts from anywhere. The headless CMS can parse files and return the content as HTML to allow my blog to display them to readers, but it can also just return the raw data, so I can edit the content in an HTML or Markdown editor. 

## More automation, to help me focus on writing
As you might have noticed, my posts all have a featured image at the top of the page, these images are also displayed in the overview of all blog posts. The images in the overview are actually a thumbnail with a maximum width of 300 pixels. When I was working on blog posts through my code editor, I had to manually resize images to create featured images that are 1200 pixels wide and thumbnails of those images that are 300 pixels wide. This got old really quickly and when the GUI of my CMS was ready, I built a service that could do this for me automatically. All I had to do was upload an image and tell the system if I wanted a thumbnail for that image. After it uploaded, I could copy the link and place it in my markdown files. The system would automatically display the correct thumbnail in the overviews. No more tedious work that the application could do for me automatically, awesome!

So in the end, building my own CMS was just a coincidence. A very happy coincidence might I add. At this moment in time, I've got 3 websites running on the CMS and any bugs I find in one system can be fixed in all of them at the same time. This has really helped me to be much more productive. As an added benefit, I've tried to make it as easy as possible to make extensions to the CMS, so website specific features can utilize the headless CMS in any way they need to. 

## Contributing
If you're interested in contributing to the CMS, please don't hesitate to do so. You can find the components on Github:

- [Headless CMS](https://github.com/roelofjan-elsinga/flat-file-cms)
- [GUI extension for the CMS](https://github.com/roelofjan-elsinga/flat-file-cms-gui)
- [Article Publishing module](https://github.com/roelofjan-elsinga/flat-file-cms-publish)

I'm looking for contributions in the areas of:
- Security
- Write documentation
- Write tests
- General bug fixes
- Easier way of adding additional modules

If you have any other feedback or want to get in contact with me, you can reach me on [Twitter](https://twitter.com/RJElsinga).