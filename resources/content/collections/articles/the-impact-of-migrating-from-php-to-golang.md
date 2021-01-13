---
update_date: '2021-01-13 13:56:08'
description: 'Find out how I reduced the execution time of a script by 99%. In this post I go over the impact of migrating from PHP to Golang. I recently migrated a business process from PHP to Golang and it had more benefits than just a performance increase.'
is_scheduled: false
is_published: true
post_date: '2020-01-22'
url: the-impact-of-migrating-from-php-to-golang
linkedin_post: ''
twitter_post: ''
tags:
    - php
    - go
---
!["PHP plus Golang"](/images/articles/php-plus-golang.jpg)
<span class="caption">PHP logo by Colin Viebrock <a href="https://creativecommons.org/licenses/by-sa/4.0/">(CC BY-SA 4.0)</a></span>
# The impact of migrating from PHP to Golang
Recently I migrated a large business process from PHP to Golang for several reasons. You might not expect this, but I didn't make this choice without good reason. I didn't do the switch to learn the language. Before we get into the reasons for migrating the process from PHP to Golang, let's get into what the problem was that I needed to solve. 

## What is the problem I needed to solve?
In an earlier blog post, ["Struggling with micro-optimizations on large scale data processing"](https://roelofjanelsinga.com/articles/struggling-with-micro-optimizations-large-scale-data-processing), I described that I was struggling to make a process perform better. This process was the indexing of data documents into Apache Solr. The Solr server is amazing and performs well, but generating the data documents was the bottleneck. This process requires me to make anywhere from 1000 to 10000 calculations per entity. There are 12000 entities that need to go through this process, 1 calculation took about 20ms. This isn't terrible by itself, but having to do this 1-by-1, it adds up. To be able to generate records for all entities would take on average 5000 calculations * 12000 entities * 20ms = 333 hours and 20 minutes. This is unacceptable, as this needs to happen at least once every 24 hours. I was at a loss at how to solve this until I encountered Golang.

In short, these were the problems I ran into and needed to find a solution for:

1. Millions of "slow" calculations
2. Synchronous, single-threaded calculations
3. 333 hours worth of calculations every 24 hours

## How did I expect Golang to solve my problems?
When I encountered Golang, I was very overwhelmed. The enormous amount of data types compared to the handful found in PHP was hard to understand. It wasn't until I watched a few presentations that I knew what Golang was capable of doing. The main feature I was looking into to help solve the problem was concurrency. Doing 1 calculation at a time was too slow. Being able to do 8 calculations (8 threads on the CPU) at a time would, at least theoretically, improve the performance of this process by about 8 times. This would get the runtime down from 333 hours to "only" 42 hours. You still can't run 42 hours worth of calculations in 24 hours on the same hardware, but there were potential improvements. 

Another advantage that I was looking for right away was the fact that Golang is a compiled language, which means it's compiled from human-readable code into binary code. This is able to run "on the metal" in both my development environment and on the server. I reasoned that being able to do calculations at native speed would improve my code a lot. But, I had no benchmark to know how much it would improve the speed of the calculation. To make this simple for me, I would be happy with a 3x execution time improvement. This would take the total runtime down from 42 hours to 14 hours. This would mean that the entire process finally fits within the required 24-hour execution window. 

So why Golang and not something like Java or C? Because I had more experience with Golang and I've heard many great stories of fellow PHP developers who've managed to learn Golang with relative ease. This was enough motivation for me to take a deep dive into this new language. A new language to me.

## What were my biggest obstacles in the migration process?
When migrating this large process to Golang, the first goal was to find a starting point. My team and I developed this process, refactored it and added onto it for 4 years. So I'm sure you can imagine how big this task was. I created many different ways of interacting with this process over the years. This helped to reduce code duplication, but it made it very difficult to change any code. Picking a starting point was difficult, but once I found one I could get to work. The starting point was calculating a price for a start date and an end date, the easiest scenario I could come up with. It took me 4 days to migrate this process, including tests for everything. After the 4 days, the process worked well and was fast, but there was a major bottleneck.

The first version of the migrated script was a Goroutine that would execute when the webserver received a request. This was a problem because according to my calculations I would need 60 million calculations, which means 60 million API calls. Everything was running on a single machine, so at least the internet wasn't the bottleneck here, but the local network was. It took 15ms for PHP to create a request, send this to Golang, which took 0.2 ms to 8ms to do the calculation. This meant I had about the same execution duration (an average of 5ms + 15ms = 20ms) as only using PHP. At this point, I wondered if I wasted 4 days building something that didn't benefit me at all.

The solution came with the realization that I was still doing 1 calculation at a time: 1 API request at a time. I was using Goroutines and channels to calculate prices much quicker, but I was still doing the separate entities synchronously. I decided to move an earlier step in the process, where I generated a list of dates to calculate prices for, from PHP to Golang. This way I could calculate prices for all required dates concurrently. This increased the execution time in Golang to about 1 second, but it meant I only needed one request per entity. I could now calculate all prices for a single entity in 1 second, when this was 5000 * 20ms = 100 seconds before the migration. With that change I cut down the total process execution time down to 12000 entities * 1 second = 3 hours and 20 minutes. Keep in mind that all these numbers are very rough averages. 

Now there is one obstacle left: I still need to make 12000 API requests. Ideally, I would only make one request, but I realize this is overkill. If that were the case, I should move the entire process to Golang, never needing PHP. This is an option I'm looking at, but I won't do it for now. I was able to cut the process down from 333 hours to about 3.5 hours at the lowest and that will do for now.

## What was the impact of migrating to Golang?
As I showed in the previous section, the changes would reduce the execution time would by 99%. I would like to clarify that I can't attribute all these performance gains by only switching to Golang. Throughout the process of rewriting the processes from PHP to Golang, I've improved the architecture and code itself a lot. The PHP code was so difficult to change in some places due to a large number of dependencies, that it was doing unnecessary calculations. It was, for example, translating things that were not relevant to price calculations. I needed these translations in different parts of the application, so the entire process was doing too much work. When rewriting this in Golang, I removed all these things and only left the part of the code that was responsible for calculation prices. So keep in mind that streamlined processes have something to do with the performance gains as well.

The impact of Golang was incredible nonetheless. The original process used anywhere from 60-70% of the CPU resources on the server. The Golang threads only took up 0.2-2% per thread (1.6-16% in total for 8 threads). So the resource usage and the execution time were much lower. The low resource usage also meant that I could increase the times I run the process per day. This was about once per week in the prior situation and is now several times per day. The servers used to run out of memory every single day and required manual restarts: this is now a thing of the past. The server doesn't run out of memory anymore and is now doing more than it was before. 

In short, these are the solutions Golang brought to this process:

1. Concurrent processes
2. Low resource usage (60-70% -> 2% CPU)
3. Native performance
4. Low latency
5. Running the calculation process several times per day instead of once per week

## Conclusion
Switching one of the main business processes, calculating prices and indexing these into Apache Solr, used to be a major headache. The process was slow and used a lot of server resources. By rewriting this into Golang and streamlining the internal processes have improved the execution time by 99%: from 333 hours to 3.5 hours. By leveraging the built-in features of the programming language, I was able to rejuvenate this process in less than 2 weeks. 

The lower resource usage of Golang meant that the process went from using 60-70% to 1.6-16% of the CPU. This, in turn, helped to stabilize the processing server and it hasn't run out of memory since I published the new process. This used to be a daily issue and now hasn't happened a single time in 2 weeks. 

Leveraging the fact that Golang has built-in testing tools, the process is also completely covered by tests. I used these testing tools to build the Golang program through TDD. These tests help me sleep at night, knowing that the script does exactly what I intended it to do. 

So would I recommend this? Well as always: it depends. If you're running into issues that you can solve by cleaning up your code, then it's not worth it. But if you need the concurrency and the native performance and want a simple language to help you achieve this, then Golang is a great choice.

You've reached the end! Thank you for reading this far, I appreciate your time and patience. If you have any questions or feedback for me, you can reach me on [Twitter](https://twitter.com/RJElsinga). I'm happy to talk to you about this more!