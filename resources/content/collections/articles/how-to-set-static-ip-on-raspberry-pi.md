---
description: 'Setting a static IP on a Raspberry Pi has a lot of benefits and is actually quite easy. In this post, I''ll take you through 3 steps to get this working on your credit card-sized computer.'
post_date: '2020-04-08'
is_published: true
is_scheduled: false
update_date: '2020-04-08 16:10:33'
---
![Raspberry Pi](/images/articles/raspberry-pi.jpeg)
# How to set a static IP address on a Raspberry Pi

Raspberry Pi's are getting faster and can do more things in your house than ever before. If you've ever tried to set up a service on your Raspberry Pi, you know that one of the most important things you need for everything to work is the IP address of your Raspberry Pi. If you don't use static IP addresses for your services, the IP will reset after every reboot of the credit card-sized computer. This could make it so your services are no longer reachable and you have to go out of your way to update the new IP address in all places that you set it before. But luckily there is a very easy solution to avoid this situation: a static IP address. 

Setting a static IP on a Raspberry Pi has a lot of benefits and is actually quite easy. In this post, I'll take you through 3 steps to get this working on your credit card-sized computer. Before we get to those steps, I'll explain what a static IP address actually is and why there are several ways of achieving the same result.

## What is a static IP address?

A static IP address means that your devices will have the same IP address on your LAN at all times, even after rebooting the computer. This has the benefit that you always know which services live at which IP address and it allows you to build complex systems using all kinds of devices. 

## What are some ways to set a static IP address?

I mentioned that there are multiple ways to set a static IP address. One of them is to assign an IP address inside of your router for your device. This is usually the best way to do this because it avoids any IP conflicts. The router will be the one to assign the IP addresses and there won't be any duplicates. 

There is another way, and that's the way we'll go through in this post: assigning a static IP address inside of the device. This means that the device will ask the router to assign it to the requested IP address. So in simple terms, instead of the router telling the device: "Hey, you're 192.168.1.10" the device asks the router "Can I be 192.168.1.10, please?". This could cause IP conflicts if you have a lot of different devices that all need to be managed through the router. But I've personally only seen this in large office buildings and not in my own home.

## Setting a static IP address in your Raspberry Pi

Now that you know what we're going to do, let's actually do it! First, start your Raspberry Pi by plugging it in and open a terminal. You can do this either through the device itself of SSH, but I recommend doing it through the device itself.

Open the configuration:

```bash
nano /etc/dhcpcd.conf
```

Now go all the way to the bottom of the file and add these lines:

```bash
interface wlan0
static ip_address=192.168.1.10/24
static routers=192.168.0.1
static domain_name_servers=192.168.0.1
```

Let's go through this line by line:

- interface wlan0: We're targeting the Wi-Fi connection, for wired use eth0 instead of wlan0
- static ip_address=192.168.1.10/24: We're setting the static IP to: 192.168.1.10. You can change this to any IP address you prefer.
- static routers=192.168.0.1: Here you fill in the IP address of your router, this can differ for you, so be sure to check this.
- static domain_name_servers=192.168.0.1: Set the name_server to your router as well. This makes sure that your Raspberry Pi will let the router resolve any network connectivity you might have.

When you've added/updated those values, you can save the file and run the last command to make these changes take effect:

```bash
sudo systemctl restart dhcpcd
```

This will restart the network service and request your static IP. If you don't have any network connectivity within 10-20 seconds you might have run into an IP conflict and you'll have to repeat the previous steps, selecting a different static IP address.

If you do this through SSH, you will be logged out after you run the last command, because the device will temporarily be disconnected from the network. After 10-20 seconds you can log in using the static IP you've selected.

## Conclusion

Setting a static IP address in your Raspberry Pi is a simple 3 step process and has countless of benefits. One of them is that it makes your services easier to find within your network. You'll be able to find any existing services on the same IP address, even after restarting your Raspberry Pi.

If you have any questions or suggestions on how to do this more easily, you can find me on [Twitter](https://twitter.com/RJElsinga).