---
update_date: '2020-02-21 14:21:49'
description: 'In this post, I go over the steps you have to take to set up an internet-facing personal cloud using nothing more than a Raspberry Pi, Nextcloud, and an external hard drive.'
is_scheduled: false
is_published: true
post_date: '2020-02-19'
url: how-to-setup-personal-cloud-raspberrypi-nextcloud
---
!["Raspberry pi + nextcloud"](/images/articles/raspberry-pi-nextcloud.png)
# How to set up a personal cloud using a Raspberry Pi and Nextcloud

Setting up your personal cloud has never been easier than now and it allows you to stop relying on big cloud providers like Google and Dropbox. In this post I will go over the following aspects of this set-up:

1. The requirements before we can get started
2. Installing the required software on your Raspberry Pi
3. Plugging in your external hard drive
4. Mount your hard drive in the file system
5. Enabling the "External storages" plugin in Nextcloud
6. Exposing your Nextcloud installation to the internet

## The requirements before we can get started

1. Raspberry Pi (3 or 4, but preferably 4) with power cable
2. Micro SD card with Raspbian
3. External hard drive, preferably externally powered
4. Time / Motivation to set it up (an important step, it took me 4 years)

## Installing the required software on your Raspberry Pi

You can find a Raspberry Pi image on the internet that allows you to have Nextcloud set up already. This is great, but this is not something I used. I use a Raspberry Pi 4 4gb, which means I can run multiple services besides Nextcloud on a single machine, so I wanted the operating system to be as plain/vanilla as possible. Luckily, there are many ways to install Nextcloud and one of them is to use Snaps. This is a way to very easily install applications in their own container, which means they're generally safer than installing them directly into your operating system. This only applies if the snap doesn't use classic mode, which this snap luckily does not.

If you want to install snaps on your Raspberry Pi running Raspbian, you need to install snap itself first. You can do this by running the following command:

```bash
sudo apt-get install snapd
```

Once this has finished, you can install snaps on your Raspberry pi, just as you would on any other Linux distribution. To install the Nextcloud snap, run this command:

```bash
sudo snap install nextcloud
```

After this finishes you have Nextcloud installed onto your Raspberry Pi. All that's left to do is run the program. You can do this through the snap command:

```bash
sudo snap run nextcloud
```

You now have a running Nextcloud instance. To access this instance on another computer in your network, you'll need to figure out what your local IP address is. You can find this on the Raspberry Pi by running:

```bash
ifconfig
```

and looking for an IP address that starts with "inet 192.168". If you type this IP address into your browser on another device in your network, you'll get the page to create an account on your Nextcloud installation.

## Plugging in your external hard drive

Now that you have your Nextcloud installed and running on the Raspberry Pi, it's time to plug in your external hard drive. This is the part where I recommend using a Raspberry Pi 4 instead of the Raspberry Pi 3. The Raspberry Pi 4 has 2 USB3.0 ports and the Raspberry Pi 3 only has USB2.0 ports. The USB3.0 ports will make sure you can read and write your data 10 times faster than the older ports. You can still use your Raspberry Pi 3 though, but the result won't be as fast as it could be. 

You can now plug in your external hard drive and run the following command on your Raspberry Pi:

```bash
lsblk
```

Find your hard drive in the list. This is most likely the device with "sda" as a name. Verify this by looking at the size of the disk in the same row. For me this says 7.3T, as I have an 8TB drive.

Write down the device name, as we'll need this for later.

## Mount your hard drive in the file system

Now that we know the name of our hard drive, we'll mount it in the file system, so we can tell Nextcloud where to save the files. First of, we're going to create a folder for the hard drive to live, you can do this as follows:

```bash
sudo mkdir /media/harddrive1
```

You can name this folder differently if you want, but make sure to remember this name, because we'll need it for the following step. Now that you created a folder where your hard drive will live, it's time to mount it into the file sytem. This is easier than it sounds, but you will need the terminal for this. We're going to mount the hard drive in the "/etc/fstab" file, which means the hard drive will automatically be mounted when you restart your Raspberry Pi. To do this, run the following command:

```bash
sudo nano /etc/fstab
```

A file will be opened in the terminal. You will see two rows that start with "PARTUUID". Move your cursor down with the arrow keys and create a new line under those two lines. Next copy and paste the following snippet in there. To copy and paste, you'll most likely have to copy the text and right-click in the terminal to paste. Most terminals don't support pasting with "CTRL + V".

```bash
/dev/sda1	/media/harddrive1	auto	uid=1000,gid=1000,noatime 0 0
```

Let me explain what happens here:

- /dev/sda1 is the name of the hard drive, the sda1 part is what you saw when you ran the "lsblk" command, so be sure this is correct

- /media/harddrive1 is the folder you created earlier. So if you chose a different name, be sure to enter that here

- uid=1000,gid=1000 is the id of the current user and the id of the group. If you've created a different user than the default user that came with Raspbian, find out the uid by running:

```bash
id -u
```

and the gid by running:

```bash
id -g
```

and fill those in the line instead of 1000.

You have now mounted the hard drive in the file system. It's time to go back into Nextcloud.

## Enabling the "External storages" plugin in Nextcloud

You've installed Nextcloud and mounted the hard drive into the file system of your Raspberry Pi. Next, you need to go into your Nextcloud dashboard and click on your user in the top right. A menu will appear and you need to click on "Apps". On the new screen, you click on "Disabled apps" in the menu on the left side. Next, click on the "Enable" button on the "External storage support" entry. This will enable the ability to use external storage in Nextcloud, such as your external hard drive.

When the plugin is enabled, click on your user in the top right again and choose "Settings" this time. On the left side, you'll get a menu and under "Administration" you'll find "External storages". Click on that and you'll see a new page where you can add external storages. To be able to add your external hard drive, choose a name for "Folder name". This could be anything you want. I simply named it "Hard drive". In the drop-down with "Add storage", select the option "Local". The form will change and you'll be able to fill in more information. You can skip all of the fields except "Configuration". This is where you fill in the folder you created earlier, so if you've been following the examples, this should be:

```bash
/media/harddrive1
```

Once you've filled that in, you can press the checkmark at the end of the form and a green checkmark will appear at the beginning of your form. You can now go back to your files by pressing the Nextcloud logo in the top left. Your hard drive should now be visible in the list of files and folders.

## Exposing your Nextcloud installation to the internet

You now have a fully functional Nextcloud installation, but it's only accessible from within your own network. In a lot of cases, this is enough and you can stop reading any further. But if you want to be able to access your Nextcloud from anywhere in the world, keep on reading. 

I won't cover all of these steps in detail, as some are optional and others are different for everyone. These are the general steps of exposing your Nextcloud instance to the internet and at least have some basic protection. Also, another thing to keep in mind is that I've been able to do this part because I could use a domain name that I owned and I'm not sure how to do this if you don't have a domain name you can use for this.

The steps are:

1. Open port 80 and 443 on your router and point them to the machine running Nextcloud

2. Point a domain name to your external IP address, use a service like [https://whatismyipaddress.com/](https://whatismyipaddress.com/) to find your external IP address. 

3. Run this command to enable HTTPS in Nextcloud: 

```bash
sudo /snap/bin/nextcloud.enable-https lets-encrypt
```

4. Add the domain you selected as a trusted domain using this command: 

```bash
sudo snap run nextcloud.occ config:system:set trusted_domains 1 --value=your.fancy.domain
```

5. Restart Nextcloud using: 

```bash
sudo snap restart nextcloud
```

You can now go to the domain you used earlier and see your Nextcloud instance, complete with SSL. Your installation is now available from anywhere in the world and you have some basic security measures set up, so your connection to and from Nextcloud is secure. Any further steps are also new to me, so I won't be able to help you with this yet. Hopefully, in the future I can add to this post to add extra security measures and to make sure your data is even safer than it is now.

I hope this post helped you to set up your Nextcloud instance and expose it to the internet. If you have any questions, you can contact me on [Twitter](https://twitter.com/RJElsinga) and I'll do my best to help you out.