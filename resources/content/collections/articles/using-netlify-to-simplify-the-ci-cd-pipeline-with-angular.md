---
update_date: '2021-01-13 13:58:47'
description: 'In this post I describe how I transformed a mono repository platform to a platform with two distinct applications and using Netlify to simplify the CI/CD pipeline with Angular. '
is_scheduled: false
is_published: true
post_date: '2019-11-13'
url: using-netlify-to-simplify-the-ci-cd-pipeline-with-angular
linkedin_post: ''
twitter_post: ''
tags:
    - netlify
    - angular
---
!["Netlify and angular"](/images/articles/netlify-and-angular.png)
# Using Netlify to simplify the CI/CD pipeline with Angular
For the past few years, I've maintained a mono repository for my day job. This repository included a complete Laravel application and a complete Angular application (first AngularJS, later Angular). This all worked well together but became more difficult to maintain as the development team changed members and responsibilities over time. In this post, I'll walk you through the old situation, through an intermediate scenario, to the current architecture. As most architecture decisions are very much bound to a specific use case and definitely doesn't work for everyone, I will clearly explain what my choices were and why I chose to do it in a certain way.

In this post I will go through these stages:

1. Mono repository: Laravel + AngularJS
2. Mono repository: Laravel + Angular (6.x to newest)
3. Two repositories: hosted to be backward compatible with the previous stage
4. Two repositories: hosted separately

## Stage 1: Mono repo with Laravel and AngularJS
Stage 1 is the stage in which I was learning to build production-ready applications. This meant I was making the least amount of "external" connections. In my mind, an external connection was having to deal with two separate physical locations in which I was running some code. During this stage, Laravel was serving a very basic blade file which in turn booted the AngularJS application. This was quite easy, as AngularJS could very easily be used as a drop-in front-end framework. So all I needed to do was make the server serve the correct HTML to the browser and from there AngularJS took over and booted an application for the visitor. 

During this stage is when I was already working with API calls, which meant that Laravel was responsible for serving the barebones HTML to boot AngularJS, but also be able to respond to API calls with the correct data. This worked very well for a very long time (2 years).

## Stage 2: Mono repo with Laravel and Angular (6.x to newest)
Stage 2 is where I learned a lot about JavaScript and optimizations. Since AngularJS was starting to show it's age and the application was getting larger and more difficult to manage, I made the choice to upgrade to Angular, which was version 6 at the time. I had built other applications with the new Angular framework combined with Laravel and was very impressed with how quickly the application booted. AngularJS took a good few seconds to fully load, sometimes up to 6 seconds. This was unacceptable, but I was running out of things to optimize...the application was ready for an upgrade.

During this stage, I migrated the entire AngularJS application to Angular. This took about 4 months, but this time was well worth the work. The application booted very quickly and it was much easier to manage. Since everything was TypeScript instead of JavaScript, we had fewer runtime bugs and the application was built using modules and components. This meant we could very easily chunk and lazy load modules, which made the application much more lightweight.

Everything seemed great, but yet this is only at stage 2 out of 4, so what happened? Well, the team changed members and responsibilities. Before, I was the one to manage Laravel and the Angular (and AngularJS) application. But I was trying to move more to the Laravel side of things and less towards Angular. So my colleague took over some of my tasks when it came to developing the front-end application. My mono repo, with it's complicated and non-standard building tasks was history.

## Stage 3: Two repositories: hosted to be backward compatible
Stage 3 is strange, but also a great step in the right direction. We made the move to completely cut out Angular from the Laravel repository. This brought many great advantages, but the most important one was that the usage of the Angular CLI became much easier. This meant we could start to use "ng serve" for the first time. This made developing the Angular application a breeze. 

At this time, we also started to move into automated tests, which meant that both the Laravel application and the Angular application went through a CI pipeline. This on its own has brought many improvements to the quality of our work when it comes to writing reliable applications. Having two separate repositories for the two separate applications made it possible for us to use two different CI pipelines, as this wasn't possible before.

The second part of the title for this section mentions that the two applications were hosted to be backward compatible. This sounds strange, but let me explain why I did this. This was done with the very simple reason that it didn't require any new or updated code in the Laravel application. So essentially we had two different applications, that somehow needed to be merged to become one again for the production environment. As the Laravel application was dependent on the presence of the Angular application. Laravel still served both the API and the Angular Application in one. This meant that I had to write a bash script to perform a semi-automatic deployment, where the Angular application was built in my local environment, then zipped in a tar file, uploaded to the server through SSH, extracted, and finally some clean up was done. Yes...very overcomplicated, but it was perfect for making it easy to work on the Angular application.

When I initially built this workflow, I knew it was only going to be temporary, because I don't want others to ask me to deploy changes, simply because they don't understand how. That's just not worth anyone's time. The next logical step was automatic deployment, and that's what the next stage is all about.

## Stage 4: Two repositories: hosted separately
Stage 4 is blissful. I finally made it here, after almost 4 years of hacking away at "work in progress" workflows. So what is stage 4? Well, stage 4 is where everything is done with developer satisfaction in mind. Automatic testing and automatic deployment. Stage 4 is a full-blown CI/CD pipeline in place, so anyone can deploy changes by themselves. 

You might be wondering how I got to this stage. Well, let's start with Netlify. I discovered Netlify just recently, after having all of Twitter be enthusiastic about it for a very long time. I realize I'm very late to the hype train with this, but I never really had an opportunity to have a look, until recently. So just for our internal purposes I signed up for Netlify and put our Angular application on it. This was primarily used for testing and viewing deployment previews when pull requests came in on GitHub. After having done this for about 3 weeks, I thought: "Hey, why are we not using this in production?". So I got to work and a week later I was ready. The Angular application is now hosted on Netlify and any changes are automatically deployed. This means that I don't have to be bothered to deploy changes and my colleagues are empowered to deploy their changes, run A/B tests, and show their proposed changes to the rest of the team. 

The Laravel application is solely responsible for processing API calls, okay and some administration pages that are made with the Laravel framework. Since I'm currently the only one making changes to the Laravel application, there is no automatic deployment strategy, but automatic testing is in place. Automatic deployment is the next logical step, but this will happen when it's really needed like it was for Angular.

## Conclusion
So was this enormous change worth everything? 1000% yes! I've been able to empower my colleagues to continuously push changes to production without any downtime or help from colleagues. So this change has made it amazing to work on the Angular application once again. This change alone was completely worth all of the work I put into it, but there is more. The front-end website has also become faster. Netlify's post-processing has made this website perform much better compared to the old situation and the lighthouse scores prove it (it was between 7 and 45 and is now 67). It's still not the highest score, but at least now we can very easily push improvements to get this to 100%. 

I loved writing this post! I'm very excited that I've been able to build all of this, through years of trial and error, to make our platform better and contribute to the developer's satisfaction when fixing bugs and building new features. Thank you for reading this far! If you have any questions or just like to say hi, you can contact me on [Twitter](https://twitter.com/RJElsinga).