---
update_date: '2019-11-20 23:38:58'
description: 'In this post I describe how you can host a lightning fast website on Github Pages for free. There are several ways of approaching this situation. Out of all the great solutions I describe how to do this with Jekyll.'
is_scheduled: false
is_published: true
post_date: '2019-11-27'
url: how-to-host-on-github-pages
---

!["Github logo"](/images/articles/github-logo.png)
# How to host a lightning-fast website on Github Pages
When you have a website that's either static or doesn't require a database, you have a lot of options when it comes to hosting your website. One of them is hosting your website right out of your GitHub repository through GitHub pages. In this post, I'm going to explain what GitHub Pages is and how you can use it to host your website on the reliable GitHub servers, for free. Yes, that's right, hosting a website on GitHub pages is free, but only when using a public repository.  

## How the hosting works
The hosting on GitHub pages is very simple: everything in the repo can be served to the client. This means if you have an index.html in the repository at the root level, this will be served at the root of the domain. There are exceptions to this rule when you're using some static site generators, but I'll get to those later on in the post.

## Hosting a private repository
You can host a website on GitHub pages, even if the repository is private. When your repository is private, there are a few limitations when it comes to hosting it through GitHub pages. As Github describes on their documentation ["About GitHub Pages"](https://help.github.com/en/github/working-with-github-pages/about-github-pages): 

GitHub Pages is available in public repositories with GitHub Free, and in public and private repositories with GitHub Pro, GitHub Team, GitHub Enterprise Cloud, and GitHub Enterprise Server.

So yes, you can host a website from a private repository, but you'll need to upgrade your plan to a paid plan. This is quite cheap though, so it might be worth it for you.

## Hosting a dynamic website on GitHub Pages
You can't host any traditional server-side dynamic websites on GitHub pages, but there are some solutions. One solution is to run a client-side dynamic website through JavaScript. You can load in any JavaScript files into the index.html file and make your website dynamic through client-side routing.

Another way to make a "dynamic" website is to use a static site generator. This sounds strange because you're generating a static website, how can that be dynamic? Well, it's dynamic when developing the website. You can use variables and create templates. For me, this was always the biggest deterrent from building static websites with HTML and CSS. I don't like to copy/paste HTML code and having to edit pages in multiple locations. With a static site generator, you can create templates, so you only have to change things in one location. When you generate the static website, everything will be converted to static HTML and CSS, so you don't have to do think about it anymore.

When you choose to use a client-side dynamic application, you can just upload all assets to the repository and you're done. You can skip the next part in this post and go straight to the part where I show you how to set up the repository to be used as a website. If you want to use the static generator approach, go to the next section and I'll show you what the workflow looks like.

## Using a static site generator with GitHub Pages
Static site generators are great and there are a lot of them out there. You can use something that's based on JavaScript/React if you're already familiar with those techniques. A great example of that approach is GatsbyJS. It's based on ReactJS and builds a static site for you when you're done. So you can build your entire website in ReactJS as you normally would and then tell GatsbyJS to convert it to an HTML/CSS website. This way you can build a website without having to learn new technologies, and that's very convenient.

If you're familiar with the Twig templating engine for PHP or the Liquid templating engine, you can use Jekyll. I use Jekyll for my projects, but as you can see, it's just a matter of preference. One isn't better than the other, so go with what you like to use.

### Use Jekyll to build a static website
In this post, I will go over Jekyll, since I know that best and I can paint a realistic picture for you. I won't go over installing Jekyll, because I think the team behind Jekyll had done a great job describing this process [on their website](https://jekyllrb.com/docs/installation/). Essentially, Jekyll is an extension of the Ruby programming language, but don't let this scare you because it's simpler than you'd expect. As a PHP developer, I was very hesitant to using Jekyll, because I don't know anything about Ruby and it seemed very intimidating. But if you follow the guides step by step, you will be fine. At a certain point, you won't have to deal with Ruby any more and you get to build your website. So just take your time with it and don't be afraid to make mistakes.

After you've installed Jekyll and you're ready to get started, it's easiest to choose an existing Jekyll theme and customize that to fulfill your requirements. You can find out how to use [Jekyll themes](https://jekyllrb.com/docs/themes/) by reading the documentation. I tried to start to build from scratch, but that was very confusing as a first attempt and I almost gave up on using Jekyll. When I found a nice base theme and used that to start with, I had a great time because everything started to fall into place. When you have some reference code that you can learn from, it's a lot easier to build your website. If you want to use the base theme I used to start, you can find it on GitHub, it's called [Pixyll](https://github.com/johno/pixyll).

Initially, I used the template as it came from GitHub, without any modifications. I wrote my content and pushed it to master. Now there is a helpful thing about Jekyll, that I'm not sure the other static site generators are capable of and that is that GitHub can automatically build and publish websites built with Jekyll. So all I had to do was build the dynamic aspect of the website and push it to master. GitHub takes care of building and publishing. 

After having pushed several updates with new content to GitHub, I wanted to customize the styles and templates of my website. Because you're working with dynamic templates, you can make any changes to the layout files and have them reflect the pages instantly. You can add and remove any HTML code you want. You can even change the global variables and use them in your templates to make them dynamic. For example, you can add a title variable in your configuration file and then add them in your templates using the Twig templating engine: 

```html
{{ site.title }}
```
You can use the tags above if you have something like this in your \_config.yaml file:
```yml
title: This is a title
```

If you ever get stuck or have a question, the Jekyll documentation has the answers you're looking for. It's not often that the documentation is so complete that it answers all the questions you might have about working with the software. It's some of the best documentation I have ever seen and I strive to write my documentation as well as the Jekyll team has.

## Using a GitHub repository as a GitHub Pages website
Setting up a repository to serve as a static website is very simple. It's only a few steps and you can follow the steps on [the official guide for setting up GitHub Pages](https://pages.github.com/) or follow the steps below:

1. Go to your repository on GitHub
2. Click on "Settings"
3. Scroll down to "GitHub Pages"
4. Set the source to the master branch and press Save
5. And done!

You can now view your website at **https://your_username.github.io/repository_name**.

If you want to use a custom domain, like **https://your_domain.com**, then you should look [Configuring a custom domain on GitHub Pages](https://help.github.com/en/github/working-with-github-pages/configuring-a-custom-domain-for-your-github-pages-site). These pages will tell you exactly what you need to do to be able to serve the static website at any domain you own.

## Now what?
Now you have a static website running on GitHub Pages. This includes a free SSL certificate and you don't have to worry about managing servers and hosting at all. So, in the end, you have a lightning-fast website, running on the GitHub servers, which are very reliable. When you want to update the content of the website, just make your changes locally and push to master. GitHub will automatically update your website and you'll be able to see your changes reflected on your website within a minutes. So if you have a content website and don't want to worry about hosting, security and any other settings, just GitHub Pages.