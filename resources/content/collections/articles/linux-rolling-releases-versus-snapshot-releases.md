---
update_date: '2020-01-15 16:34:51'
description: 'In this post I explain the differences between a rolling release and a snapshot release distro. This post is aimed at people that are just starting out with Linux of want to explore and make the switch to Linux.'
is_scheduled: false
is_published: true
post_date: '2020-01-15'
url: linux-rolling-releases-versus-snapshot-releases
---
!["Linux logo"](/images/articles/linux-logo.jpg)
# Linux: Rolling releases vs Snapshot releases
There are many, many Linux distros out there and it's both amazing and confusing! It's going hand in hand with the open source way of thinking: Don't like it? Fork it and improve it! That's exactly what the enormous amount of Linux distros stands for. People found a distro they liked, but something wasn't right, so they changed it and made it into a new one. This is both the greatest and most confusing aspect of the Linux desktop. It's confusing for the newcomers because they have no clue where to start on their Linux journey. I'm writing this post to explain one aspect of the Linux ecosystem: rolling releases and snapshot releases. What are the differences and which one should you use?

## What is a rolling release distro?
A rolling release distro is a distribution that continuously updates individual software packages and makes them available to its users as soon as they're published. This means that you as the user of the distro always have the newest version of the software installed. It means you get to enjoy new features as soon as they're released. It also means that many things could break if you haven't updated your system in a while or if incompatibilities are introduced between software packages. The goal of rolling releases is to get updates to users as quickly as possible.

A great example of a rolling release distro is Arch Linux and all distros that are based on top of it, like Manjaro or EndeavourOS.

## What is a snapshot release distro?
A snapshot release distro is a distro that's being released every few months and contains heavily tested and verified software packages making sure everything is stable and "everything just works". This also means that available software is usually a few versions older than the newest version. These older versions are stable and are guaranteed to work. That's the main goal of snapshot releases: stability. Packages are usually upgraded for every new version of the distro, which could be anywhere between every few months to every few years. When you're on a specific version, you can expect everything to work. The downside is that you won't have the newest version of the software you're using.

A great example of a snapshot release is Debian and all distros that are based on top of it, like Ubuntu.

## Which one should you use?
So now you can ask the question: Which one should I use? That's a great question and gets a boring answer: it depends. It all depends on your needs. If you're always working with the newest software and don't mind to deal with any bugs if it means you can use the bleeding edge of software, go for a rolling release distro. If you want your computer "to just work" and don't mind being a few versions behind the latest version, a snapshot release is perfect for your needs. Both types of distros have their advantages and disadvantages. It's up to you to decide what you prefer and would like to work with on a daily basis. 

There is a small side note when you want to go for a rolling release distro and that is that you should probably not go for one as your first Linux experience. You're likely to encounter bugs when using a rolling release distro and unless you already know how to work around or fix some of these bugs, you might have a hard time using a distro like this for a longer period of time. A snapshot release is a better choice when you're new to Linux. You can get your feet wet in the world of Linux without too much risk of ending up with a broken system. Once you've encountered and solved some bugs in your snapshot releases, you're ready to work with a rolling release distro if that's what you want to do.

Here are some great examples of distros you can use for both types:

**Rolling release distros:**
- Arch Linux
- EndeavourOS
- Manjaro

**Snapshot releases:**
- Debian
- Ubuntu
- Elementary OS
- Pop!_OS
- Zorin OS
- Peppermint OS

## The distro types I use
Now that I've explained the different types of distros I will get into a real-world scenario and tell you what I'm using on a daily basis and why. For my home system, I use both a snapshot release (Ubuntu 18.04 LTS) and a rolling release distro (EndeavourOS). The reason for this mix of release types is that the system with the snapshot release used to be my work system. This is something I will get into in the next paragraph. The other system uses a rolling-release distro. I've worked with Linux for 3 years at this point, so I'm quite comfortable with the terminal and fixing any bugs in my system. I'm also a person who likes to have the latest version of the software, to take full advantage of new features. So the only logical choice to me was to try a rolling release distro. The reason I specifically went with EndeavourOS and not with Manjaro is resource usage. EndeavourOS is a very lightweight distro and I'm running it on an old laptop, which now works perfectly again.

For work, I use a snapshot release distro: Ubuntu 18.04 LTS. I've chosen this because I need everything "to just work". At work, I don't want to spend time on fixing my machine when I'm writing and running code. Some software might be out-of-date, but by adding packages through "Snap" I'm still able to install the latest software that automatically updates itself. By using snaps, if a software package breaks, only that package breaks, nothing else. I can downgrade it to a lower version until it works again. I don't think I will ever use a rolling release distro for work unless I become a rolling release distro ninja. 

## Conclusion
I've explained the difference between a rolling release and a snapshot distro and I've given you my real-world implementation of these types of distros. Now you get to decide which one you want to use for your Linux journey. Do you want the latest and greatest and don't mind getting your hands dirty? Go for a rolling release distro! Do you want everything "to just work" and want the distro to be stable at all times? Use a snapshot release distro. That's the beauty of the Linux desktop: You get to pick exactly what you want and what you need. The freedom the Linux ecosystem gives you is truly remarkable and it's one of the reasons I've stuck with it for a few years now.

If you have any questions about this topic or if you're just looking for a distro that would fit your wants and needs, reach out to me on [Twitter](https://twitter.com/RJElsinga). I'm more than happy to talk to you about Linux!