!["Sand walker"](/images/articles/0_xqnRu6Z6PGP8I4ab.jpeg)

# How I reduced the runtime of a Cronjob by 94%

We all need Cronjob for certain automation tasks, but sometimes these tasks take so long that they become a huge burden to you and your ecosystem. I had a Cronjob that took 36 hours and improved it to fully run in 2 hours. Let's get into how I did this!

### Clean up your code

The first step was to clean up my code. Some scripts had to go through three or four methods to get the required data and be formatted properly. This did actually have a valid reason (when I first wrote the scripts): I wanted to avoid repeating code. I needed the data in similar formats that the other methods provided me, so I would simply grab that data and modify it to fit my needs instead of writing a new customized (but very similar) method to get the data how I need it right away.

This worked but turned out to be very slow in the long run. I figured I'd rather have the quick and efficient code, instead of slow code that's not repeated anywhere. So I moved all code into a single method and kept reducing the code until it was clean. This already sped up the script by about 2 hours.

### Caching

Another performance gain was achieved by caching as much data as I possibly could. If the data was unlikely to change throughout the life-cycle of the Cronjob and would be requested repeatedly, I added a caching layer on top of it. This didn't speed up the script as much as I thought it would, because not a lot of resources are repeated throughout the life-cycle. This did however, buy me a 30 minute boost. Not a complete waste of time, but not significant enough to really make a difference.

### Asynchronous jobs

I achieved the biggest performance gain by moving some of the long-running parts of the script to asynchronous jobs. This includes jobs that interact with the database, image manipulation, and larger calculations. This sped up the script from about 33 hours to 2.5 hours. These processes had very little to do with the progression of the main script, so I decided to completely separate them from the main process into their own little-secluded tasks.

### The take away

If there is a script you expect would take a long time, or at the very least has blocking processes, use asynchronous jobs. These jobs will be completed at their own time and will not block the progress of the main script. However, you will need to keep in mind that any data processed in these jobs are not available in your main process. If you absolutely need the data that the jobs generate for your main script, there is, unfortunately, no easy way to make this into an asynchronous job, because you simply can't expect something to be done exactly when you want it to be done. But if it's just some image manipulation or a lot of calculations that are not needed to progress the main script, make it asynchronous!

If you have any questions or remarks, please leave me a comment and I'd love to help you out. If you have any tips on how to get better results than I described here, let me know too! I'd love to learn from you!