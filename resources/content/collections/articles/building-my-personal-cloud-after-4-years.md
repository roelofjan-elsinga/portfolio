---
update_date: '2020-02-13 12:34:32'
description: 'In this post I revisit a blog post I wrote 4 years ago. At that time I was looking at building a home server and predicted some technologies. 4 years later I''ve finally built the home server and it was easier than you might imagine.'
is_scheduled: false
is_published: true
post_date: '2020-02-12'
url: building-my-personal-cloud-after-4-years
---

!["Raspberry pi + nextcloud"](/images/articles/raspberry-pi-nextcloud.png)
# Building my personal cloud after 4 years

About 4 years ago I wrote my very first blog post ["Researching home servers"]([https://roelofjanelsinga.com/articles/researching-home-servers](https://roelofjanelsinga.com/articles/researching-home-servers)). In that post I talked about my Raspberry Pi 2 and using FreeNas to accomplish my goals of building my own file server at home and access it from anywhere. Well, it has finally happened and I didn't use FreeNas to accomplish this. 

## The Raspberry Pi

In order for a Raspberry Pi to work in this setup, I needed the latest version, the Raspberry Pi 4 4GB. This new version of the Raspberry Pi has USB 3.0 and built-in Wi-Fi. This makes it the ideal machine to run all the time, as it doesn't consume a lot of energy, but still be powerful enough to deal with multiple reads and writes at the same time. I specifically looked for a way to use Wi-Fi instead of ethernet to connect the Raspberry Pi to the network. This might be a controversial choice because a lot of the time you should use a cable to get the best internet speeds. I don't like to mess around with cables and the wireless connection is just as fast as the wired connection for my devices. The fewer cables the better in this case.

## An 8TB external hard drive

The micro SD card on the Raspberry Pi is only 16GB and that's obviously not enough to be able to store all of my data from my machines. So I went for a future proof hard drive that won't be full for at least a few years. The external hard drive connects to the Pi through USB 3.0 and is mounted into the Partition table under "/etc/fstab". This helps with the reliability of the availability of the hard drive. By mounting it in the filesystem it could be unmounted at any point and you wouldn't be able to store any data in it anymore. Actually adding the hard drive as a partition ensures it's available where you say it should be available unless something goes wrong that is.

## The software to connect it all

To connect the external hard drive to the Pi and make it available in the network I use Nextcloud. This is meant as a local Dropbox-like environment. So no FreeNas like I was initially thinking of using. Unlike FreeNas where you can create a Samba share and map this as a network drive in your operating system, Nextcloud works through an app or through the browser. This is where you can use it just like you would Google Drive and Dropbox. I chose this solution because I wanted something that took the least effort. I had tried OpenMediaVault as well, but this disabled the network capabilities on the Raspberry Pi and I had to reinstall Raspbian. 

Another reason I went for Nextcloud is the fact that you can install the software through Snap packages, which means I'm no longer bound to a specific Linux distribution. Initially, I tried to run Ubuntu Mate and Ubuntu server on the Raspberry Pi 4 but this didn't go as well as I expected. I went with Raspbian because it's lightweight and developed by the Raspberry Pi team themselves, which means it has to work with all models. 

The fact that I can now run my personal cloud on a Linux machine, as opposed to FreeNas which is FreeBSD based, means that I'm very comfortable tweaking and installing things. If something goes wrong, I know how to fix it. I never took this into account when I wrote the other post 4 years ago.

## Exposing it to the internet

Exposing this set-up to the internet is something I'm not looking forward to and that's why I haven't done that yet. I want to research how to expose something from my home network to the internet a bit more first. I want to be sure that I've at least taken basic security measures to make sure my data and network are safe. So if you have any tips, besides using SSL because that's obvious, I'm very interested to hear what your solutions are.

## Conclusion

This whole experiment was very nostalgic because I went through a lot of the things I went through 4 years ago. And the fact that this post relates to the very first blog post I've ever written was surprising. I long thought that post would be a dead-end, but as it turns out it was just a very long and slow journey. In the end, I ended up with a Raspberry Pi 4 4GB with an 8TB external hard drive running Nextcloud on my home network. I can now move all of my data to that disk and keep the important data as a second backup on a separate external hard drive. This all relates to the saying that if you have the data once, you have none of it. So far I haven't exposed this set-up to the internet yet, because I want to make sure I'm being safe with it before exposing myself to all kinds of malicious traffic.