---
update_date: '2020-01-07 19:29:01'
description: 'In this post I go over how you can optimize your product without blocking progress along the way. A lot of people can get stuck on features that might be meaningless to the product. Through data you can prioritize features and improvements, which will guide your work towards a specific goal.'
is_scheduled: false
is_published: true
post_date: '2020-01-08'
url: how-to-optimize-your-product-without-blocking-progress
---

!["Drawn graph"](/images/articles/drawn-graph.jpg)
<span class="caption">Photo by Isaac Smith on Unsplash</span>
# How to optimize your product without blocking progress
When building a product it's often top priority to get a first version out of the door. When testing out an idea, getting a prototype in front of people is the most important part of the process. Without a product to get feedback on, you can't improve the product any further in a meaningful way. So when is this feature or prototype done? That's what I'm trying to define in this post. Keep in mind that this is a new topic for me and I'm not a product manager in any way, so take this with a grain of salt.

## Define version 1.0
Before starting work on a product, you should define what "done" means first. This might seem like a strange first step. You're not sure what the customer is looking for yet after all. But this step is an important part of the process. You define a version 1.0 to avoid scope creep, which means that you're adding more features than intended. Scope creep can delay a "final version" and you should try to avoid this at all cost. You need to outline the very least amount of features for the product in order for it to be useful for the customer. These features will most likely change over time, but you need a base from which you can gather feedback. So come up with a few basic but essential features and build your product.

When these features are functional, you're ready to put the prototype in front of users.

## Leave features as basic as possible
After you've defined basic features, you can start to build them. Most software developers, including me, love to over engineer these features. I urge you to try your best to keep these features as basic as possible. These features are here to proof a concept and will very likely change a lot after user feedback. When you've built a fully-featured product, changes become more difficult to apply. When you've kept the product nice and simple, you can make changes to and add and remove features.

So keep the features simple, both in design and function. The best way to test features is to leave out 90% of the details and make it very obvious to the user what something does. You can always extend functionality and customization. The goal of the first version is to get users familiar with the potential capabilities of the product. They shouldn't have to deal with configuration settings in a menu yet. It's best to not allow for any customization until there is a need for any of them. Keep it simple for yourself and the users, until they need more.

## Optimize when you have the data
Optimizing features is one of my favorite things to do, but you can't do this if you have no idea what the user needs. Only optimize when you have enough information to make decisions. This way you can actually measure your optimizations. Without measuring your changes, you're making changes without knowing the impact. This could actually make the product worse, not better. But, if you're not measuring anything, you won't know how the changes impact the users. The only way to find out in that situation is to ask them for feedback.

## Measure, measure, measure
It's very tempting to use Google Analytics and start measuring anything and everything. Don't do this. You need to define very specific things to measure, otherwise you end up with data that could be completely irrelevant. This data could make it very easy to make decisions based on information that doesn't actually represent real world behavior. In fact, I wouldn't even recommend using Google Analytics for very specific products and processes if you're not sure what you'll use the data for. Google Analytics is amazing for static websites to figure out what users do, but using it for more complex processes might be too much work. Let me explain my reasoning on this.

I would try to build something that's built into your product to measure very specific things. This way you know exactly what you're measuring and why. This is where the real benefit of measuring and gathering data comes from. You can do these things in Google Analytics through the "dataLayer" object as well, but again, this might be more work than it helps you. This step depends on what you know how to do and want to do. In most cases, I like to build measuring into the product. That way, I can reuse the measurements and observed behavior for more things than tracking users. Building this into the product serves more than one purpose, which makes it worth it for me in the end.

You can use an event like "user viewed product X 3 times" to track behavior and then send an email to that user with some extra information. Afterwards, you could add the product as a favorite within their account. Building this into the product itself, makes extending any future steps very easy. If you were to use Google Analytics here, you can mark events, but you don't get any extra use out of it.

## Make decisions based on data
When you've gathered your metrics, you need to figure out how you want to optimize your product. It's important to find optimizations that are quite simple to install and which benefit you the most. You want to make a lot of impact with the least amount of effort. These types of optimizations are worth your time. You can use this technique to focus on specific improvements and all changes you need to do. The more difficult a change is to make and the less impact it has on your conversion rate, the lower the priority. 

This concept, is my main point of this post. A lot of teams skip this part of the process and will focus on what's the most fun to build. The effort you put into implementing optimizations might not be worth it. But you will never know if you don't look at the effort and benefit levels with your team. The team needs to agree on the priorities, because if not, you won't be able to focus on getting the best conversions. 

On the technical side, when the whole team agrees on the priorities, it's very easy to come up with a list of improvements. You can motivate the team with some exciting features to build in the middle of a "boring" conversion funnel. I call it boring, because most developers don't care about marketing and conversions. Even if the primary goal of the new features is to raise the conversion rates. They may not care, but they're necessary members of your team to realize your conversion goals. So if you give them exciting technical features to build, they'll be excited about something they don't care for. This is all speaking from experience, because I used to be one of those developers. Luckily I like conversion optimizations now and this is because of this approach. The technical challenges have contributed to my excitement about making conversion funnels better.

## Measure your improvements
After you've implemented your improvements, it's important to keep an eye on measuring your metrics. You want to be able to see if the changes you made actually improved your conversion rate. If it hurt your conversations, you might consider reversing the changes and trying another approach. Again, if you're not measuring, you're making changes based on thin air. These changes could be beneficial or make the conversions worse, but you won't know this if you don't measure anything.

## Conclusion
Building a new product or new feature is a lot more work than building it. Before you start, you need to determine what to make and what it should be capable of doing. You should record these features somewhere, because they will avoid scope creep in the future. Scope creep could delay any new product or feature, so this is something you need to avoid at all costs. When you've got a basic version of the final product, you need to come up with some specific metrics and ways to measure these metrics. 

The metrics are the leading objectives when improving a product. Measuring the impact of changes throughout the development process will allow you to adapt and improve. When you've got the data, you can use this to focus on specific improvements and features. Choose those tasks that are easiest to build and make the biggest impact to your product. These are the most important tasks and help you and your team to focus on the task at hand. When the whole team is on the same page, improving the project becomes a breeze. If you ever forget what to do next, let the data lead the way.

This post is about something I'm still learning a lot about and I'm very new to it. This is an attempt to understand certain workflows better and improve on my development process. So if none of this makes any sense, please reach out, because I'm here to learn as well. You can contact me about any of this on [Twitter](https://twitter.com/RJElsinga).