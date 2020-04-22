---
description: 'Static web hosting has been a pain point for many developers for years, but it doesn''t have to be painful. In this post, we go over how you can use GitHub pages to improve your development cycles and empower everyone to publish content.'
post_date: '2020-04-15'
is_published: true
is_scheduled: false
update_date: '2020-04-22 18:55:00'
---

![GitHub logo](/images/articles/github-logo.png)
# GitHub Pages: Static web hosting made simple

Most developers use some kind of version control system (VCS). One of the most well-known VCS is Git and one of the most well-known services to host Git repositories is GitHub. Hosting websites has been one of those things that have been a pain for many developers for many years, but it doesn't have to be that way. You don't have to deal with SSH, FTP, or some other way to interact with a server just to host a static content website. There is a solution when you use GitHub to host your Git repository: GitHub Pages. I've written about GitHub pages before, about [How to host a lightning-fast website on Github Pages](/articles/how-to-host-on-github-pages). This post is not about how to host your website on GitHub Pages, but why you should consider doing so.

## A quick recap: What is GitHub Pages?

GitHub Pages is a service provided by GitHub to host your static website straight from your repository on the GitHub servers. This can be a static website in many different shapes: 

- a website built with HTML, CSS, and JS files
- a website built with a static site generator like Jekyll
- a website that's dynamic on the client side using JavaScript

As long as your website can be displayed by opening HTML files, your website can be considered a static website and you can host it on GitHub Pages.

## Why host on Github Pages?

There are many benefits by hosting your website on GitHub pages. Some of these are:

- Reliance on the stable GitHub back-end
- Simplified deployment
- It's free (for public repositories)

For this post I'm going to focus on the deployment aspect of these benefits. The ease with which anyone can now deploy changes to their website is really great, so I consider that the most important benefit.

Deploying changes becomes very simple because all you have to do as a developer or designer is push your website to a specific branch in your Git repository. When setting up GitHub Pages for your repository, following the steps I outlined in [How to set up and automatically deploy your website to GitHub Pages](/articles/how-to-set-up-automatically-deploy-website-github-pages), you will have specified the branch on which you want to host your website. Often times this is "master" or "gh-pages". Personally, I prefer to use "master". Anything that's on "master" is what I consider to be published already, so putting that thought into practice and using the master branch as "live" on GitHub pages is the correct approach. If your project is more than just a website, you can consider "gh-pages" as your default deployment branch.

## How could hosting on GitHub Pages impact your workflow?

By using the master branch of your repository as your published website, it means that any time you push your code to the repository it will be published nearly instantly. This has the benefit that you can now start to practice continuous deployment. You don't have to do anything manually after pushing your code, because GitHub takes care of this. This leaves you free to do other things, like writing more code. This also alleviates the pain of having to use SSH or FTP to publish your changes. Anyone with access to the repository is now able to contribute to your project. This includes people that otherwise may not have the technical skills to publish changes. This empowers you, your contributors, and/or your team. In this regard, GitHub Pages helps people feel like they can help out.

Because you can only host static websites on GitHub Pages, it means you will be able to work in the same environment on your local machine as on GitHub Pages. Mistakes that you make locally will show up on your website. This also means that fixing bugs is simple because anything that's broken on your website will also be broken in your local environment. 

It comes down to this: your development cycles can become shorter. The time between writing code on your machine to it showing up on your website can become much shorter. Developers no longer have to worry about publishing code and content writers are now empowered to publish the changes they need to, without relying on the development team.

## Examples of websites hosted on GitHub Pages

This post wouldn't be complete without some examples of different types of static websites hosted on Github Pages. We'll look at two different examples. One is created using Jekyll, a static site generator and the other is built using static assets, such as HTML, CSS, and JS files. These websites could be good examples to follow when hosting your own websites on GitHub Pages.

[Aloia CMS](https://aloiacms.com) is a project using Jekyll, a static site generator. You can view the [website](https://aloiacms.com) and [source code on GitHub](https://github.com/roelofjan-elsinga/aloia-cms-website). 

[Sander Volbeda](https://sandervolbeda.com/) is a great example of a portfolio website using just HTML, CSS, and JS files to create a static website. You can also view the source code for that project on [GitHub](https://github.com/sandervolbeda/personal-website).

Updating both of these websites is as simple as pushing your changes to the master branch. GitHub takes care of the rest.

If you're looking at finding a simpler way to host your static websites, you should give GitHub Pages a try. It simplifies your development cycles and allows technical, but also less technical team members to contribute to the project directly.