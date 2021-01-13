---
update_date: '2021-01-13 13:55:27'
description: 'In this post I go over what I learned from publishing my first Golang package. I tell you about why I did this and what my workflow was to achieve this goal.'
is_scheduled: false
is_published: true
post_date: '2020-01-29'
url: what-i-learned-from-publishing-my-first-golang-package
linkedin_post: ''
twitter_post: ''
tags:
    - go
    - growth
---
!["Golang packages"](/images/articles/golang-packages.jpg)
<span class="caption">Box icon made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></span>
# What I learned from publishing my first Golang package
Earlier this week (January 27th, 2020) I published my first public Golang package. I don't know if it's any good and if it's even structured as it should be. Nonetheless, the package has already helped me work through a lot of challenges. So why did I publish it and what are my intentions with it? Let's dive in!

## Practice makes perfect
One of the most important aspects of Golang is the use of packages. If you're trying to do anything in your script, you will need to import packages to provide the tools you need. I thought it was necessary to find out how to create packages myself as packages are one of the most important things to understand in Golang. This way I can learn how to distribute packages and how to extract parts of the source code and use it in many projects. 

## Golang packages are simple
I've been developing PHP and JavaScript applications for close to five years at this point. During this time I've distributed and contributed to about a dozen PHP packages and one JavaScript library. There was quite a tough learning curve for both because there are all kinds of things you need to think about when developing these packages. On this aspect, I can only comment on PHP packages, because I'm still very confused about developing and distributing JavaScript libraries. So when it comes to PHP I needed to set up all kinds of settings in Composer and it was very intimidating. Of course, once you get the idea it's very simple and it's exactly like building a web application. Developing PHP packages locally is still a mystery to me. I'm going through hoops to create symlinks in folders to be able to see my changes on the screen. When the packages don't have a web interface, I only write unit tests to verify it works. In summary, you go through a lot of hoops to develop a simple package.

So what is this process like in Golang? Two words: A breeze. Developing a package in Golang is by far the easiest process I've gone through with any language and framework. What a relief! When you're developing your application and want to structure your code into folders, you're already forced to create a new package. Every folder is its own package. These packages expose a certain set of functions and the rest is all contained within the folder. This means you can check that specific folder into Git and push it to GitHub. That's it. You can use this package locally as if it's in the same project as your other code. This means you don't have to create symlinks or go through any other hoops. When you're done with your package, push your changes to GitHub. Now you can import your package in any project you're working on. Let's use my first package as an example:

GitHub URL: [https://github.com/roelofjan-elsinga/dates](https://github.com/roelofjan-elsinga/dates)

With this URL, you can run the following command in your Golang workspace:

```bash
go get https://github.com/roelofjan-elsinga/dates
```

and import it into your project like so:

```golang
import "github.com/roelofjan-elsinga/dates"
```

and that's it, you're done. I was so surprised to find out this was all it took to publish my sub-folder as its own package. 

## Why did I publish my first package?
Three weeks ago I started my deep-dive into Golang because I was trying to solve a business goal. If you missed it, you can read more about ["The impact of migrating from PHP to Golang"](https://roelofjanelsinga.com/articles/the-impact-of-migrating-from-php-to-golang). When I wrote this application, I created quite a few packages within the application, as this was a large process. Earlier this week, on the day I published this Go package, I started a second application to solve another business goal. In this second application, I faced some of the same problems I had in the first application. But the difference was that this time I had already solved the problem...in another application. This was the perfect opportunity to create a package. I followed the steps above and imported the package into the new application ten minutes later. 

When I heard that Golang is great for developer productivity I dismissed it at first, because there are so many other tools and languages out that that claim this very thing. I was convinced it was great for productivity when I went through this process. I have never created a fully-fledged package and imported it into a new project quite this quickly. I've worked with PHP for 5 years and Golang for 3 weeks, but creating a package in Golang was much faster and easier. Don't get me wrong, I'm not putting PHP down. PHP is and will be my main language. I've gone through the bad times (PHP 5.2 - PHP 5.4) and the wonderful times (PHP 5.6 - PHP 7.4) and I will most likely stick with it for many years to come.

## Will I maintain and publish more Golang packages?
I will maintain any package in any language I've published, so the Golang packages are no exception to this. I will also publish more Golang packages when this solves a pain I'm experiencing. This is no different than the PHP packages I've published so far. These were pieces of software that I was using in many places and I didn't want to maintain several instances of the same software. The packages that I've published and will publish in the future are all about scratching my own itch. If I don't experience a problem myself it's very difficult to write a solution for it and then distribute it. The next time I experience a problem in one application that I've already solved in another, I will create a package for it. This way I benefit from my earlier efforts and I'm able to give back to the amazing communities that have helped me for the past five years. 

## Conclusion
I wrote my first Golang package because I had already solved the problem I was facing in another application. I didn't want to maintain two instances of the same software and decided to publish this package. I don't know if it's any good, but it has already helped me solve many problems. When I went through the process of publishing this package I found out how simple it really was to create and distribute this piece of software. If even someone with as little experience as me can publish a package, then the creators of the language did something right. This process taught me a lot about the workflow for this new language and has convinced me to continue building and distributing packages. 

If you're interested in having a look at the package I wrote you can find it on [GitHub](https://github.com/roelofjan-elsinga/dates). While you're there and happen to know Golang yourself, I'd love any contributions and feedback. I'm very new to this language and want to learn the best practices. I'm also very interested in performance improvements, so if you have any suggestions for me, let me know! If you want to discuss this post, you can reach out to me on [Twitter](https://twitter.com/RJElsinga). I'd love to hear from you!