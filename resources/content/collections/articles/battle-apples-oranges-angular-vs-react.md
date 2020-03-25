---
is_scheduled: false
is_published: true
post_date: '2017-09-09'
url: battle-apples-oranges-angular-vs-react
---
![The battle of apples and oranges: Angular vs React vs VueJS](/images/articles/apples.jpg)

# The battle of apples and oranges: Angular vs React vs VueJS

People keep asking about which framework to use (Angular, React, or VueJS), 
and which one is better. I can understand they want to know which one to use for 
projects, but it's a silly question. It's comparing apples to oranges. 
I'll explain why you should use one over the other for a specific situation, 
but it's only my humble opinion.

## Angular
Before I start with Angular, I will have to clarify that I'm biased towards it. 
I have been using AngularJS for 3 years and I've put a considerable amount of 
time in Angular 4 (just Angular from now on). For now, we'll stick to Angular 
though because AngularJS is not really updated anymore and it's becoming outdated. 
So when should you use Angular? Well, when you're building a medium to a large 
application. The set-up time is longer than both React and VueJS, 
but it's also the full package. Where React and VueJS are only used as the user 
interface, Angular is the user interface and it has other things "included".  
I say included here, but they have been removed from the Angular core and included 
in separate modules since Angular version 4 launched. Angular uses TypeScript 
instead of Javascript, which is a big turn off for a lot of people, 
but I've come to really enjoy it. I mentioned that Angular is mainly good for 
medium or large applications because it's not very easily used as a "drop-in" 
framework. You either make all pages through Angular or you make none.

## React
As I said earlier, React only deals with the user interface. 
If you want things like a router or any way to interact with the server, 
you'll need to find modules yourself and integrate it with React. 
Many people like this, as it gives you all the freedom to choose whichever 
module you please. React can be used as a drop-in framework, 
so you can make parts of the page with React instead of having to make the 
entire page with a single framework, like Angular. 
Since React can easily be used as a drop-in framework but also includes a 
router module, it can be used for small to large applications. 
The set-up time is minimal, but it does have a fair learning curve. 
Where Angular uses TypeScript, React uses JSX. It means that all the 
logic and the templates can be built in a single file.

## VueJS
I'd like to call VueJS "All the right things of AngularJS". 
AngularJS will always have a special place in my heart and that's why 
I'm liking what VueJS is doing. VueJS is also a framework that only deals 
with the user interface, just like React. It does have a router and modules 
to deal with server interaction available, so it's fairly similar to 
React in that way. It's also a drop-in framework, which means you can 
use VueJS for small applications. I wouldn't recommend using it for medium 
or larger applications just yet. It's a new framework and the file 
organization needs some work because it can get messy. 
That's why I recommend using it for smaller applications. 
You can set it up in a breeze, so you can get started quickly. 
VueJS actually uses plain Javascript, which I really appreciate. 
There isn't really anything new to learn except some of the directives 
that AngularJS and Angular have as well.

## Comparison
I hope that clears up the battle of the apples and oranges a little bit. 
The frameworks are completely different and don't even have the same use case. 
You can use Angular for large applications and has all the most-used modules 
built-in. React and VueJS are both for the user interface alone and they 
don't include any of the modules that deal with server interaction. 
This means the developer is free to choose any modules to fill these gaps. 
React and VueJS are comparable because they are both only for the user interface, 
but they still don't serve the same use case. 
React is for small to large applications because the file organization is 
simpler than VueJS. VueJS is for small applications only for now, 
simply because it hasn't had the time to mature just yet. 
You can use any of these frameworks to make single page applications, 
or React and VueJS for some dynamic elements.

If you like to talk about this subject further, 
follow me on twitter @RJElsinga or Instagram @roelof1001.
