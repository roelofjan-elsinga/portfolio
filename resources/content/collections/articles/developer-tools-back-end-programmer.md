---
update_date: '2019-08-27 08:16:22'
description: "Any developer will have a set of developer tools they swear by. A set of tools that does\r\neverything we need it to do. People can say that tools are interchangea"
is_scheduled: false
is_published: true
post_date: '2017-08-26'
url: developer-tools-back-end-programmer
---

![Developer tools for a back-end programmer](/images/articles/hammers.jpg)

# Developer tools for a back-end programmer
Any developer will have a set of developer tools they swear by. A set of tools that does everything we need it to do. People can say that tools are interchangeable, and to an extent they certainly are. However, the set of tools a developer uses, often dictate the workflow. With that said, I'd like to move to the part where I tell you which tools I use on a daily basis.

## My developer tools
One of my main programming tools is an IDE called PHPStorm, which I think almost all programmers have at least heard of. The editor comes with built-in terminals, which I find a really useful feature. I usually use 3 or 4 terminals at the same time and the editor makes it very easy to manage all of them. Another useful feature it has that I use a lot is the search functionalities. You can use a few keywords to search for the string in your whole project and it makes developing easier and less tedious.

## Updating and managing code
If for any reason, I ever need to change any live code, I use the command-line editor Nano or Atom combined with Filezilla. Luckily I don't resort to going down this route too often, because any mistakes will immediately be reflected in production. Normally I change all the things I need locally and get it into production through Git and Github, which are two of the other tools that I use on a daily basis. Along with Git, there is, of course, NPM and Composer to get all the required packages in my projects. If you're not using package managers for your projects in 2017, you should check it out. It makes keeping your applications up-to-date a breeze. It also means you can take advantage of thousands of open source packages that have been built by other people.

## Testing
Testing is a very important part of the build process. Luckily Laravel, the PHP framework I use for most of my projects, has PHPUnit support built-in. This means that writing tests is very easy. With a few simple lines of code, you will always know if the methods you write act as you intended them to act. This is a very good process to run before you're ready to publish your code, just to make sure what you wrote actually works.

## Browsers
Sometimes you just really need a browser to test your application. For example while building SPA's I use the Chrome Developer tools almost 100% of the time. There are two browsers I test in and see if everything goes according to plan. The first is, of course, Google Chrome and the second is Firefox with the Firebug plugin installed. This comes with a console and a network tab to see if there are any logged errors and to see what data your browser actually loads or receives from the server. This is very useful for debugging and making sure the browser receives the data you need it to receive.

So there are a few tools I use on a day to day basis to make sure the development process goes according to plan and the code you want to be published gets published in an orderly fashion. Because at the end of the day, you want local code running in a production environment. There is not just one way to get there, everyone will have their own way.