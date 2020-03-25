---
is_scheduled: false
is_published: true
post_date: '2016-10-20'
url: researching-home-servers
---

![Video streaming](/images/articles/video-streaming.jpg "Researching Home Servers")

# Researching Home Servers

Ever since I got a Raspberry Pi 2, in December 2015, 
I've been very interested in setting up a home server 
to be able to save all my files and access them from anywhere I want. 
Besides file storage I've been looking at ways to integrate this with my web development projects. 
Using the Pi 2 for this is great, especially being able to use SSH to remotely access it 
and use Git to load all the up-to-date files on it.

So an ideal home server would be able to do both of these things for me, 
both file storage and local web hosting. Additionally I would be able to use this home server 
for video streaming purposes. Originally I was using my Raspberry Pi for this, 
and this worked well for the web hosting, but not so much for file storage. 
It was a hassle to get my external hard drives hooked up to it, 
to manage all the folders and to keep it organized.

A solution presented itself to me in the form of FreeBSD, in particular FreeNAS. 
This way I can simply install the Operating System(OS) on a flash drive and boot 
the entire system from that, while using multiple hard drives for file storage. 
Looking at guides and videos on YouTube, I figured that 4 hard drives would be ideal 
for this setup. I will also need a sufficient amount of RAM memory and CPU power to 
be able to use a ZFS file system with FreeNAS. This way the data on the hard drives 
is safe in case 1 or 2 hard drives stops working.

On the downside, this system would mean it's not as energy efficient as a Raspberry Pi, 
but which system is? I will have to research how I can make sure this new system, 
built with FreeNAS, is quick, reliable, but also very energy efficient and low in power usage. 
More posts will follow on this and hopefully at that point I have more concrete ideas 
about system specifications, specific components I'd like to use and the estimated cost 
of this whole project.