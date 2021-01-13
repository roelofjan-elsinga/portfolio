---
update_date: '2021-01-13 13:57:01'
description: 'Linux: How it saved my old laptop. I this post I''m going to talk about my transition from using Windows for everything to using Linux for everything and how this impacted my decision to revive an old laptop that I thought was broken.'
is_scheduled: false
is_published: true
post_date: '2019-12-18'
url: linux-how-it-saved-my-old-laptop
linkedin_post: ''
twitter_post: ''
tags:
    - linux
---
!["Endeavouros screenshot"](/images/articles/endeavouros-screenshot.png)
# Linux: How it saved my old laptop
Windows comes pre-installed on almost all consumer non-mac laptops on the market at the moment. This is fine for most people because it serves a very wide target audience. However, I'm not one of those people. I like to control everything on my computer, be able to delete anything I want to and I hate pre-installed advertisements and bloatware. This is one of the reasons I've gravitated towards Linux based systems. But before we get to that step, I'd like to tell you my history with Windows and why I moved away from it.

## Back when I used Windows
Back when I used Windows on my computers, I had to reinstall it every once in a while to get rid of viruses, to replace any corrupt files, and to get a speed boost when launching my operating system. I thought this was very normal and most of my friends also went through this process every few months or so. This was fine for Windows XP and Windows 7, the installation was quite quick and after the installation had completed everything would work with some minimal installations. Everything was good in Windows land.

But then, Windows 8 appeared from the shadows. It was the long-awaited successor of the amazing Windows 7…what would Microsoft do to top this? Well, they dropped the ball, unfortunately. Windows 8, I think we can all agree, was ahead of its time and therefore not well received. It was also much slower compared to Windows 7, so it felt like a downgrade instead of an upgrade. Not long after, Microsoft came with Windows 10 and gave everyone who was currently using Windows 7 and Windows 8 a free upgrade. Windows 10 was quicker and much smoother, it didn't get into your way as much as Windows 8. Peace was once again returned to Windows land, well sort of.

## My trusted laptop died
Then my trusted laptop, running Windows 10 died. It had the perfect web development setup running XAMPP and everything was carefully crafted to work the way I wanted it. But it was all lost. When I got my new laptop, I had to go through the Windows 10 setup, eager to get into the desktop environment and set up my work environment the way it was on my fallen laptop. The set-up began and didn't seem to end, it took a good 20 minutes between turning on my laptop and seeing the desktop for the first time. I hated every minute of it because I wanted to get back into my workflow, but the operating system got in my way. This is when I decided I had enough of Windows. It was no longer a convenience to me, but a burden.

For work, I had worked on a virtual machine for a while. A virtual machine running Ubuntu. I had gotten very familiar with it and decided I wanted to work with it all the time, not just at work for some specific tasks. I created a partition on my new laptop and created a Windows/Ubuntu dual boot, just in case I ever wanted to go back to Windows. Spoiler alert: I never touched Windows again and ended up removing the installation within 6 months. Ubuntu was my new operating system.

## Ubuntu: The new workhorse
I installed Ubuntu on my new laptop for the first time. It was an exciting moment because I knew I probably wouldn't go back to using Windows. After the installation, which only took about 20 minutes, I could instantly get back into my work. I knew I had made the right choice and quickly installed everything I needed through the command line and got back to work as if it had always been this way.

Fast forward a year and I never felt the need to reinstall Ubuntu because it became too slow or because I had caught a nasty virus. The system still felt as quick and stable as the day I had installed it. At this point in time, Windows wasn't even on my radar anymore. The Windows partition had been wiped to serve as extra storage for some of my web projects. This is also the time where I started to come up with an idea. I was convinced my old laptop was still working, it just needed some serious help.

## Reviving my old laptop
Reviving my old laptop was no simple task, but I was determined to see it through. After creating a bootable USB and charging the laptop for a few hours, I pressed the power button. And as expected, the laptop turned on. But that was all it did because Windows couldn't find a boot drive, even though the drive in the laptop worked. After this happened, I plugged in the USB drive, restarted the laptop and booted from the USB drive.

The installation took about 20 minutes and afterward I had a fully working system. The installation fixed the connection to the boot drive and I'm still not sure why this ever broken on the Windows installation. I had a working laptop, again after it had been on my shelf for about two years. Ubuntu made the laptop usable again, I could actually boot up in a desktop environment.

## Finding a distro for the older hardware
Even though Ubuntu was installed and the laptop was able to boot again, it wasn't the best user experience. The laptop was 4 years old at this point and it had gotten slower. It's by no means a low-end system, but it's also not very fast. This meant that running Ubuntu was still too slow for my liking, I needed something that took up fewer resources. This is how I landed upon Fedora. Fedora seemed to perform a little bit better, but it was still too slow. I thought to myself: "There must be a distro that takes low enough resources to be able to run smoothly on this laptop". It took a while, but I have found one: EndeavourOS.

EndeavourOS is essentially an Arch Linux installation that installs the bare essentials for you. This means it also has a graphical user interface for the installation process, instead of the command line installation Arch Linux has. It installs a modified XFCE desktop environment, a file manager, a browser, and a few other essentials. It's distro built on top of Arch Linux that tries to stay as close to Arch Linux as possible. The lack of bloatware means it's fast, really fast. It's the smoothest user experience of any of the other distro's I've installed on this laptop and while using it I often don't even realize I'm working on my old laptop.

The fact that I don't even notice I'm working on a different laptop is exactly what I'm looking for in a distro. The whole installation took 10–15 minutes, it was surprisingly quick. Afterward, I could instantly get it what I wanted to do and didn't have to wait on anything. It really has become a system as I like to see it: simple, fast, and doesn't get into your way at all. The EndeavourOS experiment is not over, because I will continue to use it until it no longer fits my needs. This whole blog post was written and edited from that old laptop. The laptop that was forgotten about and discarded as being broken. That laptop has a new life now with a very bright future.

Thank you for making it this far, I hope you enjoyed reading this post. It was great writing about the past and bringing back all the good and bad memories and I'm very hopeful about the future. If you have any questions about EndeavourOS, you can send me a tweet or DM me at [Twitter](https://twitter.com/RJElsinga) and I will do my best to answer your question.