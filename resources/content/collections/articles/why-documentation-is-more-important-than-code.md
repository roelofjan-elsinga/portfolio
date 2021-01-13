---
update_date: '2021-01-13 13:54:32'
description: 'In this post I go over some point why documentation is (almost) more important than code for any application. If you want new people to get up to speed quickly and have them contribute quicker, you might want to document the macro, meso, and micro aspects of your application.'
is_scheduled: false
is_published: true
post_date: '2020-02-26'
url: why-documentation-is-more-important-than-code
linkedin_post: ''
twitter_post: ''
tags:
    - development
    - documentation
---
!["Book pages"](/images/articles/book-pages.jpeg)
# Why documentation is (almost) more important than code
Code is great and it makes your application do the things it needs to do. But what happens when you hire a new person on the team or you start to use new technologies to accomplish your goals? You need some kind of reference to explain the flows within the application code base and code is usually not great at providing this overview. You need proper documentation to explain the code, company jargon, and application flows. In this post, I'll go over three levels of documentation that you have in an ideal world. I understand the ideal situation is rarely the reality, so in that case, use bits and pieces of these levels.

The levels I'll be talking about are the following:

- Macro-level: What does that jargon mean and how does the business work?
- Meso level: How do processes flow through our application?
- Micro-level: How does this code work and why is it here?

## What does that jargon mean and how does the business work?
When you're new to a team, you won't understand some words that the people around you use on a daily basis. This is normal. At some point, you'll need to know what they mean to be able to contribute to the business and specifically the application. In other words, you need to know what the domains in the company are. Domains are a concept from DDD (Domain-driven design). This means that you structure your code into very specific use cases of your application. The language used here is business-specific, not programming language-specific. This means that if you're talking about a specific domain, let's go with "Checking out", you can talk to anyone in the company and they'll be able to understand what you're talking about. 

Okay...so what does that mean? Well, it means that you need to document all the domains that exist in your application and in your business. New hires won't exactly know how your business works in detail, so documenting the different domains and jargon will allow them to quickly get up to speed when talking to anyone in the company. By specifying exactly what each domain and jargon means, you leave no room for confusion about what the other person might refer to.

Let's go through an example:

```
While [domain] I encountered a bug in the system. 
```

You can replace domain with something specific to the business, in this case, let's use "Checking out". This makes: While checking out I encountered a bug in the system.

When you don't have a clear application structure and no documentation about how to process goes through your application, you're going to spend a lot of time searching through code to find where the bug occurred. When you have a very clear application structure but no documentation, you'll at least know in which section to look for any bugs. You won't know exactly where, but the scope of your search is greatly reduced. When you don't have a clear application structure, but your documentation is great, you'll be able to pinpoint the right place to fix the bug and if you have both a clear application structure and great documentation, you'll have the bug fixed in no time.

So documenting domain and jargon language helps you to get your new hires up to speed quickly, but it also helps to solve bugs more quickly. 

## How do processes flow through our application?
When you're new to a codebase, it can be very difficult to figure out how processes flow. You can find entry points and responses quite easily, but finding out how processes work by simply looking at code is very difficult. Finding the main processes within a system is usually easier to find if the application is structured well. If the main purposes of the system aren't immediately clear by glancing at the folder structure, this is something you should document.

Having very good documentation but a very messy system is still acceptable because at least there is a clear path through the application if you can reference a manual. If you have clear documentation and a very clear application structure, then you have a unicorn on your hands and you should do everything in your power to maintain this. You can do this by continuously writing documentation, writing tests, and refactoring code that isn't up to the standard that has been set. 

So the main goal of documentation is to explain how the application works, but you're also supposed to document your code right? Correct, but that's only one of the levels you should document. So let's get to that right now.

## How does this code work and why is it here?
We're finally there the easiest, but often overlooked part of this documentation journey. Documenting code is what most teams do, but not all teams do this as effectively as they could. I've encountered my own documentation mistakes plenty of times. This is where I use self-documenting method names in my code, but then add a comment that essentially copies the method name. 

For example: 

```
generateTransactionObjectForPurchase
```

with the amazing comment:

```
This method generates a transaction object for a purchase
```

Then I just think to myself: "Great, that literally told me nothing about why this is needed". A much better comment would be something along the lines of:

```
We need to generate specific transactions from this purchase to be able 
to submit this to a payment provider.
```

It still stays true to the method name, but it explains why this part of the process is necessary and where it fits into the flow. When the time comes when this gets refactored, the developer knows why this code is here and what purpose it serves. It could happen that the code is no longer necessary, in which case you can just delete it. But if the documentation doesn't explain this, you won't know if it's needed without specifically going through the code. This developer might be you a year down the line, so do yourself a huge favor and explain why code is there. It's fine if the explanation spans multiple lines because it'll only help you to debug the current situation quicker.

## Conclusion

In this post I've explained why documentation is very important for a project on three different levels:

- Macro-level: What does the company jargon mean and how does the business work?
- Meso level: How do processes flow through our application?
- Micro-level: How does this code work, why is it here, and where does it fit in the process flow?

Documentation is important to get new hires up to speed with the company jargon, the application flows, and the code, to make communication between different people within the company go more smoothly, and to be able to locate and solve bugs quicker. 

Having an application structure that very clear to understand by just looking at folder names is very difficult and takes time. If you can't take care of that (right away), having great documentation will still help new hires to contribute to the application faster. 

If you have anything to add to this post, I'd love to hear from you on [Twitter](https://twitter.com/RJElsinga)!