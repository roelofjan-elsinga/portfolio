---
description: 'Debugging your infrastructure with Netdata'
post_date: '2020-09-23'
is_published: false
is_scheduled: true
update_date: '2020-09-16 18:41:28'
linkedin_post: ''
twitter_post: ''
---
![Netdata cloud dashboard](/images/articles/netdata-cloud-dashboard.png)
<span class="caption">Graphics from the <a href="https://www.netdata.cloud/blog/introducing-the-all-new-netdata-cloud/" rel="nofollow">Netdata blog</a></span>
# Fixing hidden infrastructure issues with Netdata
Fixing issues for a single application is usually not the most difficult thing in the world. You'll have to keep track of a limited amount of aspects that could potentially go wrong. But what happens when you're developing an entire platform consisting of multiple services? How do you keep track of potential issues between them at scale? And how do you deal with discovering issues if different services are spread out over multiple nodes? 

Well, you're going to need a good monitoring solution that you can very easily deploy on multiple nodes at the same time. For this, you could use Netdata to keep track of your entire infrastructure at a single glance.

In this post, I'm explaining why Netdata is a great option for your infrastructure monitoring and how it has helped me to fix a major problem with my infrastructure within the first hour of installing it in my servers.

## What is Netdata?
Netdata is monitoring software for servers, but really anything that runs Linux. So you could also install this on your workstation and keep track of your system resources that way. Netdata comes with a built-in dashboard that you can access at [https://localhost:19999](https://localhost:19999) on your local machine and you'll see all system information you could want. However, when you've deployed this on multiple servers, you can feed this same information into Netdata Cloud and view multiple servers in your dashboard at the same time.

![Netdata Cloud dashboard with multiple servers](/images/articles/netdata-overview-of-multiple-servers.png)
<span class="caption">Netdata Cloud dashboard with multiple servers</span>

## Why Netdata?
Netdata is very easy to install and comes with a few really nice features, which makes it perfect for infrastructure montoring. You can install the Netdata client on your devices (including all nodes in your infrastructure) and connect it to a single dashboard: Netdata Cloud. This is a free dashboard you can feed all of your nodes' information into to create a clean overview of your servers and their health statuses. This dashboard shows you CPU usage, RAM usage, inbound/outbound bandwidth, and a lot more information that you could use to figure out the health of your nodes.

Information is all great, but it's not good enough if deploying Netdata to all your servers automatically isn't possible. Luckily, you can install Netdata using bash scripts, and adding each individual node to your Netdata Cloud dashboard is yet again a bash script. This means you can automate this process using, you could've expected this, Ansible.

Running a few bash scripts is quite easy, just make sure you know what you're executing when you run bash scripts from the internet.

Installing the client is a single line, which you'll need to run on your target node:

```bash
bash <(curl -Ss https://my-netdata.io/kickstart.sh)
```

After you've created an account on [Netdata Cloud](https://app.netdata.cloud), all you need to do to link the Netdata client to your Cloud account is run a script similar to this on your target node:

```bash
sudo netdata-claim.sh -token=your_token -rooms=your_room -url=https://app.netdata.cloud
```

You'll be given a token and room identifier in Netdata Cloud, so don't worry about copy/pasting this code above. Now your server will automatically be connected to Netdata Cloud and you'll be able to see all kinds of metrics. Below are some of the metrics you might see in your dashboard:

![Netdata system overview](/images/articles/netdata-system-overview.png)
<span class="caption">Netdata system overview</span>

## How Netdata helped me fix a major issue within the first hour
Now that you know what Netdata is and have gotten a little overview of what it can show you, let's go into how it helped me to fix a major (hidden) issue within the first hour of deploying it in my infrastructure. 

As a little back story, one of the servers is running an Apache Solr instance to serve as a search engine and it has been quite slow over the past few months. Apache Solr has a nice dashboard that shows the memory usage and the JVM memory usage, as it's built using Java.

![Apache Solr memory usage overview](/images/articles/solr-memory-usage-overview.png)
<span class="caption">Apache Solr memory usage overview</span>

This was always stuck around 90% of memory usage, so I assumed that the performance issues had to do with RAM usage. This let me down a path of upgrading the server within AWS to give the Solr instance more memory to work with, but this didn't have the desired result. 

After installing Netdata on this server, I saw that the CPU was almost constantly hitting 100% usage, which was strange as the server wasn't under heavy load at the time. So after a bit of searching around on our favorite search engine, I found this [Jira issue](https://issues.apache.org/jira/browse/SOLR-13349). This pointed out that the version we were running (7.7.1) was causing memory issues and that it was patched in the next version (7.7.2). So after upgrading the Apache Solr server to the latest 7.7.x version (7.7.3) the problems were completely solved. The search engine was at least 3 times quicker, even under heavy load, while indexing large amounts of documents. 

It would've taken me much longer to solve this issue without Netdata, because the memory statistics in the Apache Solr dashboard were misleading, while the usage statistics in Netdata showed the real cause of the problem. 