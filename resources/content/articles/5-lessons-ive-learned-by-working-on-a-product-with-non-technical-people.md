!["Light bulbs"](/images/articles/light_bulbs.jpeg)

# 5 Lessons I've learned by working on a product with non-technical people

For the past 4 or so years, I've been working on a product with non-technical people, for non-technical people, 
<a href="https://punchlisthero.com" _target="blank">PunchlistHero</a>. 
Here are the 5 lessons I've learned from this.

## 1. Ask questions
To get started with any work, you need to know what to do. In order to find out what the actual problem the person is facing, 
you have to ask questions, a lot of them. The goal here is to find out what the actual problem is, 
not what the person thinks is wrong in the current situation.

For example, while working on my own product I asked questions like 
"What would be the simplest way for you to save tasks?" only to find out that the actual problem was that at the time, 
this person had to write these tasks on a piece of paper, then go to the office and insert them into a management system. 
You'd think he was now done with the process, but you'd be wrong. 
He then had to email this entire list to all the other people who had to complete these tasks.

So by asking a very general question, I got very distorted answers, 
because that person simply didn't know any better than to write things down multiple times. 
Only through asking more and more questions, like: "How do you do your job right now? 
Walk me through your process." I figured out what the actual problem was. 
I saw several problems here: you have to enter tasks multiple times, 
you have to copy & paste the tasks the tasks into an e-mail, there is no personalized task list for assignees, 
and the whole process just takes far too long.

## 2. Listen, don't interrupt
While people are answering your questions, you need to be quiet and listen. 
This is not simply to be able to hear what they're saying. When people start talking, 
they will often reveal more information than you asked for, 
but they will also give you information that you may not even have thought about asking.

When you listen, keep notes. You can use these notes to ask follow-up questions. 
If you think that simply recording a conversation is enough, you're sadly mistaken. 
A recording is great if you want to preserve any and all information that's being said, 
but you can't use it for follow up questions. The conversation should have a natural flow. 
When the people you're speaking with feel at ease, you will get all the answers you need for your product, 
and hopefully more.

## 3. Look at solutions, not features
Developers have the horrible tendency to jump the gun and come up with features because 
the user asked for them or because they seem to solve the problem at first glance. 
However, people you speak with don't ask for features, they're asking for solutions to problems 
and are simply assuming that a specific feature will solve that problem. Sometimes it will do the job, 
but don't just assume that it does. You have to do a bit of research and come up with ways to solve the problem. 
Sometimes the first answer is wrong and you have to keep digging for better solutions.

An example of a problem I've dealt with is the fact that a person used voice input, instead of typing. 
This caused some issues because people would be assigned the wrong tasks. 
A simple solution would be to just use a dropdown with all the available people. 
That would be fine if you had 10 people, but in this case, it was hundreds. 
An auto-complete element would be fine as well, but that takes up extra space and you'd still 
need to use your finger to select the right person. The actual problem was that the person is 
walking through houses and simply doesn't have time to write down a task and then assign it to another person.

What I came up with was a combination of things. First of all, I added the auto-complete field. 
That way, if you do want to select the person through touch or click, you can. 
The second layer was a bit more involved. This was a server-side solution using Elasticsearch. 
When the assignee was received on the server, it would look if that specific assignee already exists, 
with an exact match. If not, it would try to match it through a fuzzy search in Elasticsearch 
with a minimum relevancy score of 90%, meaning that it was a 90% percent match or more. 
If this still doesn't produce an assignee, it will simply create a new one. 
This already solved 90% of the incorrect assignees. The other 10% could be solved through an extensive merging process, 
where you can assign all tasks to another person and delete the original assignee in one go.

## 4. Learn to make compromises
Sometimes you think you may have the best solution to the problem, which you've used for another 
project before and it worked like a charm. But this may not be the best solution to the problem, 
or the people simply don't know why you even came up with a solution like that. 
This is when you make a compromise, you combine their ideas with your ideas into something you know will work, 
and they would actually want to use. Over time this can always be altered into something that leans more to their 
solution or to your own. But by compromising on this, all parties will feel like they're involved in the final result. 
This will cause them to take a bit of ownership for that solution and present this to others as a good idea.

## 5. Make changes very very slowly
Technical people love new features and new designs. They can explore an application all over again and 
see what's changed. Non-technical people don't like this at all in most cases. 
They just want to do their tasks as quickly as they can. When they're presented with a new design, 
their workflow will be interrupted and they won't be happy with this. Does this mean you can never 
redesign your application? No, of course not! You just have to do this very carefully, incrementally, 
and above all, slowly.

The point is that they don't have to "re-learn" your whole application, but only small parts at a time. 

You want to make their experience better, not terrible. When you change features very slowly, 
you will make their experience better over time and you still get to redesign your application.

If you really "need" to redesign your application, consider versioning everything. 
With this, I mean you start to support multiple environments, multiple versions of the application. 
This seems like a lot of work, but it doesn't have to be. You can simply let the users know that you'll be maintaining 
the current application and fix any bugs that may arise, but you won't add any new features. 
If those users really want the new features, they would have to consider upgrading to the new environment. 
This is how I currently deal with a redesign for <a href="https://punchlisthero.com" _target="blank">PunchlistHero</a>. 
The old version is just a separate branch in the Git repository, so any updates can be done quickly and easily.

**What have you learned from your experiences?**

Do you have any other tips or have you experienced working with non-technical people differently? 
Let me know! I'd love to get in touch on <a href="https://twitter.com/RJElsinga">Twitter</a> and get your take on this topic!