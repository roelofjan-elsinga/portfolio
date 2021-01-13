---
update_date: '2021-01-13 13:57:35'
description: 'Event sourcing: The single source of truth. In this post I''ll explain my reasoning for calling event sourcing the single source of truth. Spoiler alert: It is a very beneficial practice for decentralized applications.'
is_scheduled: false
is_published: true
post_date: '2019-12-04'
url: event-sourcing-single-source-truth
linkedin_post: ''
twitter_post: ''
tags:
    - event-sourcing
---
!["People running together"](/images/articles/people-running-together.jpeg)
# Event sourcing: The single source of truth
Event sourcing is a very fascinating concept in programming. I think it could be used as a single source of truth for a wide range of decentralized applications. Event sourcing is a concept that took me quite a while to get my head around because it's very different from the normal way of dealing with data in some kind of database. In this post, I will quickly go over the concept of event sourcing and how it differs from something like a CRUD application. Then I will go over some aspects of event sourcing that could help make it very easy to create decentralized applications, all using a single source of truth to perform tasks.

## The differences between an event-sourced and CRUD application
CRUD applications are standard practice in a lot of places when it comes to developing applications. CRUD simply means Create Read Update and Delete. In practice, this means that you have 4 different ways of interacting with a data object. This makes it very easy to deal with data because you can deal with data in a way that's pretty intuitive. You can throw it away if you no longer need it, create it if you need it, update it when you need it to and read it when you want to display it. It's a very natural way of thinking about something. 

Event sourcing only has 2 different ways of interacting with the data if you're thinking in terms of database interactions: creating and reading. In essence, event sourcing is nothing more than appending to an existing state of a data object. Let's go over an example to make clear what I mean. Imagine you have a blog post and you want to publish it. In a CRUD application, you can just modify the post record to set published to true and add a timestamp for the publish date. In an event-sourced application, this is a little different, but not more difficult. When you have the existing state of an unpublished blog post, you can simply record an event: "Published blog post". Your database now contains a command that tells the current state of the blog post that it has been published. You won't need to add a publishing date, because the command already contains information about when it was triggered. This trigger date equals the publishing date. 

When it comes to event sourcing, all you need to remember is this: You can only append to the current state of the piece of data. You might now be wondering: but how do you delete or update the blog post? That's simple as well, you record two new events: "Updated blog post" and "Deleted blog post". When you record the "update" command, you can register what the new contents of the blog post should be, all while keeping the old version of the blog post in your database. This is where the single source of truth aspect of the blog post begins.

## The single source of truth
In a CRUD application, you only know the current state of the application, but you have no clue what it looked like yesterday or a year ago. This is because you're updating the current state to reflect a new state, thus getting rid of the old state. In event sourcing, you're constantly appending new information. This means you can look back in time and see what the data looked like a day or a year ago. This is all great, but how does it make event sourcing the single source of truth? Great question, let's get into that.

The way event sourcing works is that it records an event any time anything happens. This means all events related to a single resource are always recorded chronologically. Since you're only appending to the existing state, it's very easy to share these changes to any other application that wants to hear it. 

Let's say you have an existing event-sourced application with a database full of events and you want to create a new application that generates reports based on what happens in the main application. With a CRUD application, you will need to fire events every time something changes. This is fine, but what if you want to know anything about prior changes? Well, you're out of luck, that data simply doesn't exist. With an event-sourced system, the new application can ask the main application for all events related to a single resource. This way, the new application knows exactly what has happened to that resource and the state will always be the same in both applications. When new events are being recorded in the main application, all the new application needs to do is ask for any events that happened after the last event it has retrieved. It won't have to check it's own data, all it needs to do is append to its own state and the data will be synchronized. 

This approach of data sharing not only makes the server load lower for both applications, but it also makes the data reliable across all applications. 

## Data synchronization is no longer an issue
When you have two applications connected to a single event store (a database containing the recorded events), there is no longer a problem when it comes to data synchronization. To explain this concept, I first need to explain how a resource interacts with recorded events. A resource is called an aggregate root in the world of event sourcing. This sounds intimidating, but it's not as bad as it seems. An aggregate root is just an object that is able to record events and use past events to make decisions about incoming events. Example time! 

When an aggregate root receives a command telling it to record a pageview for a blog post, it has the ability to look at all other attributes of that blog post and make a decision. For example: After a single person viewed the blog post 3 times, email that person about blog posts just like it. The aggregate root knows, based on past events, how often someone has viewed the blog post. So when that third view comes in it will record the pageview event, but also "Emailed visitor some related blog posts". Another part of the application, or even a whole different application, can now respond to the new event and email that visitor some interesting blog posts. 

Back to data synchronization. An aggregate root will read all past events every single time it receives a new event, this means that when an event was recorded in a completely different application (but still connected to the event store), the aggregate root knows about this and can use it to make decisions about what to do next. Maybe it records a new event, maybe it records two, three, four, or five. It doesn't really matter, because the next time an aggregate root in a different application reads the current state, it will have all of the new events in memory. 

This same process is very difficult in a CRUD application, because what happens if you accidentally miss a notification about a new update being made? The next time you're comparing the resource, it might look completely different and you might not be able to tell which one is the correct one. This is why I'm saying that event sourcing is the single source of truth. There is no uncertainty because you can recreate the current state from the list of appended events.

## Conclusion
As you can tell, I'm very excited about event sourcing. It's a big paradigm shift, but once you get your head around the concept of event sourcing, you will understand how powerful it really is. If my blog post didn't explain event sourcing clearly enough, there are a lot of amazing resources out there that you can use. An example is this [video](https://www.youtube.com/watch?v=rUDN40rdly8) where Greg Young explains in his words what event sourcing is and when you should use it. Any of his presentations on this topic are great to watch, so go find all of them. I'll list a few:

- [GOTO 2014 • Event Sourcing • Greg Young](https://www.youtube.com/watch?v=8JKjvY4etTY)
- [Greg Young — A Decade of DDD, CQRS, Event Sourcing](https://www.youtube.com/watch?v=LDW0QWie21s)
- [«Event Sourcing is actually just functional code» by Greg Young](https://www.youtube.com/watch?v=kZL41SMXWdM)

All I can say now is that you should have a look at this concept and try it out for yourself. I haven't really looked back after working with it for a few weeks now. It has been a really great resource for building reliable applications so far. If you'd like to talk to me about this topic, reach out to me on [Twitter](https://twitter.com/RJElsinga).