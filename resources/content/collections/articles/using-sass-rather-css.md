---
update_date: '2019-08-26 17:43:46'
description: "When I first started out with web design & development,\r\nCSS was this tool to make HTML pages look better.\r\nThis was just before responsive web design started bec"
is_scheduled: false
is_published: true
post_date: '2017-06-01'
url: using-sass-rather-css
---

![Why I use SASS rather than just CSS](/images/articles/macbook-colors.jpg)

# Why I use SASS rather than just CSS

## CSS to LESS
When I first started out with web design & development, 
CSS was this tool to make HTML pages look better. This was just before responsive web design started becoming the new industry standard for web design. Websites were zoomed out and broke on mobile devices, but this was normal at that time. The first time I started learning about the media queries within CSS was when I was introduced to Twitter Bootstrap, which I still use to this day. I still use this, because nowadays I'm more of a web developer than a web designer, so most CSS is not done by me anymore. Anyway, Twitter Bootstrap got me into using more of the features CSS3 offers. During my internship, I started to look for ways to make writing CSS more efficient, because I caught myself copying and pasting styles constantly. This is where I discovered LESS. LESS gave me what I wanted at the time, nested CSS. This helped me to reduce copying and pasting CSS for the most part.

## LESS to SASS
Yet I felt like LESS wasn't quite there yet after I'd been using it for a few months. Jerke and a guy I worked with, led me to start out with SASS. This is where I knew I found what I was looking for all along. SASS offers nested CSS, but also functions and mixins. This helped me to (almost) never copy CSS again. One of the great things I have been using a lot more lately is functions. These help me to calculate exactly what margins, widths, and heights should be. Obviously, since I discovered Flexbox this has been used less, but it still has its applications. 
Before, when I started out with LESS, I used a program called Panda to compile my CSS files. This all changed when I switched to SASS. This is where Grunt came in. Grunt constantly watches and compiles my SASS files, so I can instantly test the changes I have made.

## A single file
But back to using SASS rather than CSS. One of the advantages of using SASS (and LESS) is that I can easily include all "modules" (files) in one main file. This way I can make Grunt/Gulp/Webpack watch for changes in all files when it detects this, it compiles one new file. This helps to keep the file loading on the website efficient, but it doesn't trade efficiency for ease of use. What I mean with this is that when I was using normal CSS files, I needed to create multiple files to keep different functionalities separated. Obviously, this is not the way I wanted to work. With SASS it loads one single file, that is made up out of an unlimited amount of separate files. These I can easily manage these different files, while Grunt does all the compiling for me. That way ease of use is not compromised.

## Mixins
Another important thing about SASS that I mentioned earlier was the ability to use mixins in my files. This means that I can make standard "classes" within the SASS files and easily include these in styling for other elements. For example I want to make an orange button. 
In plain CSS you could make two different classes, one being ".button" and one being ".orange-button". The button class could make up the shape, font, and border styles. The orange-button class could just make the button orange and implement custom hover styles. What a mixin does is simpler. A mixin could be defined, taking two arguments, color and hover-color. Then in the orange-button class, the mixin could be called by using: button(orange, a-darker-orange). This reduces code and in my opinion, makes it easier to quickly style different elements.

## Manageable
Using SASS has made styling websites for me much more fun again. Before I started to use SASS I hated it, because I knew I needed to work in yet another file. I had to include this file in the HTML file and it was just tedious. Then I'm not even talking about the enormous CSS files that I was already using. Then I had to try to find the right class or ID and hope for the best this doesn't actually change anything else. Using SASS has made working on specific elements much more manageable, 
especially with Grunt having my back by compiling my main SASS file in the background. While using SASS it has reduced my frustrations with styling. 
It has made it easier, more efficient, and it gave me the opportunity to really structure the files how I want without having to load yet another file in my HTML file.