![How I reduced my docker image by 55%](/images/articles/steel_tower.jpeg)

# How I reduced my docker image by 55%
A smaller docker image has all kinds of benefits, for one, 
it'll download more quickly when you're deploying your application to a new location, 
or you're deploying an updated image to existing applications. 
Being able to quickly updated images is very important. 
Besides that, keeping images clean and not bloated is important for properly working, 
and responsive containers. Read on to find out how I reduced my docker image 
from 1.04gb to 555mb.

## I started out with too many packages
With that said, I started out with a very bloated Ubuntu 18.04 base image for 
my main docker image. This image contained a lot of debugging packages, 
and packages I just plain wasn't using anymore. This caused the built image to be 
1.04gb, which is quite large, especially for a single component in a 
network of services. I noticed a lot of processes that were either slowing 
down over time or were slower than I expected them to be. 

So in my search through the internet to ways of improving the performance, 
I found three simple solutions I could apply right away and these solutions 
have reduced the image size by 55%. These were:

## Using a smaller base image
Use a smaller base image than a full ***ubuntu:18.04*** image. 
Since Ubuntu is largely based on Debian, I thought the logical choice was to use 
***debian:9.7***. This change alone brought the image size down to 860mb. 
This was already a huge reduction, but I wasn't satisfied yet. 
When changing this to ***debian:9.7-slim*** the image was 600mb, another huge reduction.

## Clean your installations
The second solution to the problem was to simply clean out all temporary 
files when using the ***apt-get install*** command. This reduced the size of the image, 
but not by a lot, this saved me about 20mb, so the size was now 580mb. 
To take advantage of this, add the commands below to every 
***apt-get install*** command and this will get rid of all temporary files.
```
apt-get clean && 
rm -rf /var/lib/apt/lists/\* /tmp/\* /var/tmp/*
```

## Don't install recommended packages
Your operating system loves to make installing packages very simply, 
but installing all recommended packages it needs to run without any problems, 
also in a docker image. You can disable this, and you really should. 
By adding the ***--no-install-recommends*** flag to your ***apt-get install*** commands, 
It'll only install the bare minimum needed to run. 
This means that you may have to install a few packages manually, 
but you get rid of a lot of bloatware. 
This brought my image size down to its final 555mb. 

Do you have any more tips on reducing docker images further? 
Make sure to contact me on [Twitter](https://twitter.com/RJElsinga)! I can always use advice on these matters, 
as I'm still learning new things every single day.
