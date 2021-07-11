---
description: 'MQTT Discovery is a wonderful feature of Home Assistant which helps you connect new MQTT devices to your smart home with ease. MQTT Discovery saves me a lot of time when I connect new NodeMCU powered devices to my smart home and let''s me spend more time enjoying the device and less time configuring it.'
post_date: '2021-07-11'
is_published: true
is_scheduled: false
update_date: '2021-07-11 13:29:54'
linkedin_post: ''
twitter_post: ''
tags:
    - arduino
    - mqtt
    - automation
    - homeassistant
---
![NodeMCU with Sensors in waterproof casing](/images/articles/nodemcu-with-sensors.jpg)
# MQTT Discovery with a NodeMCU and Home Assistant
In November (2020), I started to work with MQTT to set up a few smart devices in Home Assistant. 
I described how to [create a simple MQTT switch in Home Assistant](/articles/how-to-create-switch-dashboard-home-assistant).
That process works really well, but it requires manual work.
If there is anything I don't want to several times, I will find a way to automate the process.
Luckily, Home Assistant has an amazing feature that helps you to automate this process: [MQTT discovery](https://www.home-assistant.io/docs/mqtt/discovery/).

In this post, I'll go over a few things that I've done to use this feature to automate my MQTT devices.
I will be sharing my Arduino program in case you're looking to use this for your own projects as well.

These are the topics I'm going to write about:

1. What is MQTT Discovery?
2. How can you use MQTT Discovery on an NodeMCU?

Let's go to it! This feature is one of my favorite discoveries recently, so I hope you enjoy it as well!

## What is MQTT Discovery?
MQTT Discovery is essentially a way to tell your MQTT broker, Mosquitto running inside of Home Assistant in this case, which topics it needs to listen to.
In the post that I've linked to in the introduction, I've explained how you can manually tell Mosquitto to listen to a certain topic.
This works fine, but if you have more than 2 or 3 devices, this can get old really quickly.

When you use MQTT Discovery, the MQTT device, in this case an Arduino, sends a message to a discovery topic on the MQTT broker telling it exactly which topic it should listen to for messages.
This way, your MQTT device announces itself to the broker, without you having to manually configure the broker.
Practically, this means that your MQTT broker will know about any and all devices that have announced themselves, without you having to do anything.

Home Assistant has such a discovery topic built-in: [MQTT discovery topic](https://www.home-assistant.io/docs/mqtt/discovery/#discovery-topic).
My main use of the MQTT devices are plant sensors. 
In total, there are 3 sensors on the device right now.
Each of these sensors have their own "state", which means they all need their own discovery topic as well.
In my case, my discovery topics are: 
- homeassistant/sensor/plant_sensor_1/temperature/config
- homeassistant/sensor/plant_sensor_1/humidity/config
- homeassistant/sensor/plant_sensor_1/moisture/config

If you were to register each of these sensors manually for each MQTT device, you would do more configuration than actually enjoying your smart devices.
By using MQTT Discovery, all I have to do is connect the Arduino to a power source and the MQTT broker instantly knows about the device and its various sensors.
Pretty cool!

## How can you use MQTT Discovery on an NodeMCU?
So what does it actually look like to code MQTT Discovery on your Arduino or NodeMCU?
Well it's actually quite similar to coding it manually in Home Assistant.
Instead of configuring each sensor in Home Assistant, you're configuring it in your Arduino program and sending that to Home Assistant.

In this code sample I will skip over a few things.
I won't discuss these specific things, as they will differ for you:

- Wi-Fi setup in your Arduino program
- Reading Sensor data in your Arduino program
- Sending MQTT sensor data to Home Assistant

I'll discuss each of these topics in separate posts, as they're not relevant for this topic.
I will, however, include them in the code sample for the full picture.
Enough talk, let's see some code!

### Sending the discovery message
Sending the discovery message requires a few things:

- Active Wi-Fi connection
- Configured Pubsub client

I won't go into specifics here, but you can find the working code for this in the full code sample below.

I break my disovery messages into functions, so I can group them together while not pollution the heart of the Arduino program.
This is a discovery message for the temperature sensor of this certain device:

<script src="https://gist.github.com/roelofjan-elsinga/219e61d1a403220cb17892bf2d02e226.js"></script>

As you can see, this script specifies a value_template for this specific sensor.
I'm sending the entire state of this MQTT device, which includes the values of 3 sensors, as a JSON object to Home Assistant.
Home Assistant doesn't know what to do with that, so we need to tell it how to get the value of the temperature sensor from this JSON object.
"value_json" parses the incoming JSON string as a JSON object, so we can use the dot notation to get nested values.
I'm using a pipe to specify a default value (0 in this case) in case there is no moisture sensor or there is something wrong.

By sending this JSON object to the MQTT discovery topic, Home Assistant knows what to do with the messages it receives.

For more context on how this discovery function fits in the whole program, I'm including my full script below.

### The Full Arduino program
As promised, here is the full script:

<script src="https://gist.github.com/roelofjan-elsinga/b1a86660234889a358efa2a19adca36d.js"></script>

It might look a little strange, because the loop function is empty.
This is because I'm using the "Deep sleep" mode of this NodeMCU to preserve energy.
After this script has sent all sensor data to Home Assistant, the NodeMCU turns itself off and back on after 60 seconds.
This way, I can use normal batteries to power this device and have them last much longer.

Again, this is my personal use for it and it might differ from you own uses.

## Conclusion
MQTT discovery has made my experience with MQTT devices infinitely better.
I don't have to worry about manually registering devices in Home Assistant any more, because the devices register themselves now.
This leaves very little room for typos and other human error.
It makes using new devices as simple as powering it on and leaving it alone.
It's great to combine this with something like Grafana and InfluxDB, because you'll see the sensor values show up right after you plug in your device.

I hope this was helpful to you! 
I will be posting more about some of the topics I've skipped in this post, like Wi-Fi connections for the NodeMCU.