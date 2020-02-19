---
update_date: '2019-10-14 13:33:35'
description: 'In this post, I go through the steps you can take to write good documentation. You can use these in any kind of project and will allow others to help you when you need it.'
is_scheduled: false
is_published: true
post_date: '2019-10-30'
url: how-to-write-good-documentation
---

!["Blank page"](/images/articles/blank-page.jpg)
# How to write good documentation
Writing documentation is often more important than writing code itself. Why? Well, if no one knows how to use your code, no one will use it. You need to be able to explain how your code works and why it works the way it does. This way, other developers will know how to write code in the same style you do. If you provide examples for the way you're implementing your code, others will understand the context in which to use your software.

So the question remains, how do you write good documentation? There are a few steps you need to take to get to a good collection of explainable concepts:

1. Determine the most important goal people have to your piece of software
2. Determine the most important aspects of your software
3. Find out which piece of software will stay reasonably unchanged from now on

You can use these three points to determine WHAT to document. You might think you should document everything, but that's not necessarily true. You should document what you deem to be the most important part of your software and what others will be using most often. When those concepts are crystal clear, you can document the more hidden parts of your code, if it's needed.

## Basic rules for good documentation
You've gathered a small list of things to document, great! Now we can move onto the part where you start writing. However, there are a few things you need to keep in mind when writing documentation:

1. Write documentation that is inviting and clear
2. Write comprehensive documentation
3. Write documentation that is skimmable
4. Write documentation that offers examples of how to use the code
5. Write documentation that has repetition, when useful
6. Write up-to-date documentation
7. Write documentation that is easy to contribute to
8. Write documentation that is easy to find

This list was compiled in a great article called [The eight rules of good documentation](https://www.oreilly.com/ideas/the-eight-rules-of-good-documentation) by Adam Scott. For an in-depth explanation of each of these concepts, I'd like to point you to that article.

These rules might seem very obvious, but you'd be surprised how often these rules are not kept in mind when writing documentation. When explaining concepts, you should use a very friendly tone. You want people to read about your software and you shouldn't make them feel less of a developer for not immediately understanding your code. You should also go into detail, giving wide-ranging examples of how to implement the software, but not writing the same thing ten times. 

## Explain concepts without overwhelming the reader
When writing about your code and there are several ways to interact with, for example, a class, you don't have to document every single way to do this. You can provide the way you have implemented the software in your projects and let them explore the other ways to interact with the code. All you have to do is paint a picture and help the developers understand how and why you chose to write the software the way you did.

## Keep your documentation up-to-date
When writing documentation you should make sure that others can easily update the documentation. This has the added benefit that new features, which others have built, can be documented for you and others. This also means that the documentation is very likely to stay up to date with the usage of the code. There is nothing more frustrating about a piece of software than documentation that hasn't been updated in a while and all code examples don't resemble the implementations anymore. Stay on top of this, take the time to update the documentation. Others, but also yourself in a few months will thank you for it.

## Make sure people can find your documentation
Last but not least, make sure your documentation can be found in a very obvious place. If you want your documentation to have added value, people should be able to find it and navigate through it. There are plenty of examples of great documentation where the main priority of the documentation was to quickly find and read through the documentation. The [Laravel documentation](https://laravel.com) is one of those. There are also terrible pieces of documentation, I won't name them, but they're often automatically generated from the code. These automatically generated documentation websites cover too much ground and do this in such a way that you might as well read through the source code because at least you'll be able to click through that. Don't do this, because this will raise more questions than it answers.

Now you've some basic guidelines to keep in mind when writing documentation. So there is only one thing left to do: Write great documentation! You'll do yourself and others a huge favor by being able to provide documentation for your software. Any new code will adhere to this documentation and it'll free you up to write code, instead of just fixing code others wrote. If you have any additions or questions, you can contact me on [Twitter](https://twitter.com/RJElsinga) at any time.