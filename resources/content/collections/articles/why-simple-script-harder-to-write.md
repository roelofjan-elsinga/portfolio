---
update_date: '2021-01-13 13:59:33'
description: 'Why is a simple script often harder to write? Find out why it''s much more difficult to write a simple script that solves a complicated problem than writing an elaborate solution.'
is_scheduled: false
is_published: true
post_date: '2019-10-16'
url: why-simple-script-harder-to-write
linkedin_post: ''
twitter_post: ''
tags:
    - development
---
!["Spider web with drips of water"](/images/articles/spider-web-with-drips-of-water.jpeg)
# Why is a simple script often harder to write?
If you're just starting out, you often want to come up with complex solutions to problems. Sometimes you do this to learn a new skill or to show off your problem-solving skills. Complex solutions are often perceived as knowing a lot and being good at something. This is sometimes a valid assumption, but in a large majority of the time a simple solution is exactly what you want to write and this often requires a lot of skill, let me explain why.

## Seeing a simple solution takes practice
You can look at any problem and come up with some kind of solution, anyone can do this. What separates you from the rest is when you can do this in the simplest way possible. You might wonder, but why is this important? Well if everyone understands the code you've written, it's easy to maintain and won't cause a lot of confusion. Simple code is likely to survive multiple rounds of refactoring. Seeing the simplest solution is a skill you need to practice because it's the result of filtering many solutions in your head and coming up with the best fitting one. 

If you make a mistake and pick a difficult solution, it might bite you later on in the process. This definitely doesn't mean, only make the right choices. In fact, it's the opposite, make mistakes and a lot of them. You learn from mistakes and you'll never make the mistake again after you've figured out what went wrong and why. Often times, you might write an overcomplicated solution. This has the effect that the efficiency of your script might be a lower priority and it loses you X amount of time every time it runs. This solution needs to be refactored a few times by the one who originally wrote it to serve as a great learning opportunity. Every time the script is refactored, you will learn something new and gradually you'll figure out how to write complex scripts in a very simple and maintainable way. 

## Putting the script into a larger context
Senior engineers are often more concerned with the architecture of the application overall. This often means they're great at separating different concerns into different scripts. For example, a script might be used in slightly different ways in 3-4 locations. Instead of constantly adding to this number with yet another implementation of the same script, perhaps it's better to standardize how to use the script, extract it into a class and use the class instead. If you really need a different use for it, create a class that extends the base class or write an adapter. The point is, senior engineers have done this countless times, so they're very likely to recognize a scenario where a script might be extracted into a class and will do so from the start. Engineers that don't yet have the experience of extracting a script like that for many times might just copy/paste the same script, adjust it in a few places and be satisfied with the result. Not knowing that same script might haunt them in the future. But when it starts to haunt you, you'll have a great learning experiment and you'll make the same mistake less often.

## Learn through making mistakes
In short, being able to go through all possible solutions in your head and picking the simplest, most maintainable solution is a 
skill that you need to practice. It's difficult and you will make mistakes, but making mistakes is necessary. You need to make mistakes to figure out what works and what doesn't work. You can always ask more experienced engineers, but until you really understand why something works the way it works, you won't really remember what you did last time you occurred a certain scenario. So fail often and learn from your mistakes quickly.

If you have anything you'd like to add to this post, please contact me on [Twitter](https://twitter.com/RJElsinga). I'd love to learn from your experiences and would like to pass your knowledge on to others.