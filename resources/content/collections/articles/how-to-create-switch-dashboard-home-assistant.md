---
description: 'When you''re using Home Assistant for your home automation and you''ve got a few MQTT devices you might want to create simple switches for your devices. However, if you''re like me, this simple task turned out to be a very tough task. In this post we''re going to create a visual toggle for your MQTT devices.'
post_date: '2020-11-18'
is_published: false
is_scheduled: true
update_date: '2020-11-16 17:42:16'
linkedin_post: ''
twitter_post: ''
---
![Home assistant logo banner](/images/articles/home-assistant-logo-banner.png "Home assistant logo banner")
# How to create a simple MQTT switch in Home Assistant
When you're using Home Assistant for your home automation and you've got a few MQTT devices you might want to create simple switches for your devices. However, if you're like me, this simple task turned out to be a very tough task. This post is as much for you as it is for me, because I forget how to do this every time and each time I go through this it takes me hours to get going. In this short post, we're going to do 3 things:

1. Define an MQTT device as a sensor in Home Assistant (optional)
2. Define an MQTT device as as switch in Home Assistant
3. Create a simple on/off switch to toggle a state in your MQTT device

There are a few **prerequisites** when you go through this process:

- You need to be able to edit the configuration.yaml file
- You need to have the "Mosquitto broker" add-on installed in your Home assistant instance

Let's get right into it, so you can get back to building amazing automations.

## 1. Define an MQTT device as a sensor in Home Assistant (optional)
Defining your devices as a sensor is optional and doesn't have anything to do with creating a simple switch in Home Assistant, but it can allow you to create triggers based on the state (on or off) of your MQTT device in the future. So if you want to do this, you can go through this step, otherwise you can go to step 2.

To register your MQTT device as a sensor in Home Assistant, you need to define it in the configuration.yml file. Let's look at a basic example:

```yaml
sensor:
  - platform: mqtt # This is an MQTT device
    name: "LED Switch 1" # Choose an easy-to-remember name
    state_topic: "home/office/led/get" # The topic to read the current state
```

After adding this sensor information, you can access the state of your MQTT device as "sensor.led_switch_1", or whichever name your specified: "sensor.whichever_name_your_chose". You can use this entity as a trigger to automate other things in the future.

## 2. Define an MQTT device as as switch in Home Assistant
Now the most important step of this whole post, defining an MQTT device as as switch in Home Assistant. To do this, open the configuration.yaml file again and add the following configuration:

```yaml
switch:
  - platform: mqtt # Again, it's an MQTT device
    name: "LED Switch 1" # Choose an easy-to-recognize name
    state_topic: "home/office/led/get" # Topic to read the current state
    command_topic: "home/office/led/set" # Topic to publish commands
    qos: 1
    payload_on: 0 # or "on", depending on your MQTT device
    payload_off: 1 # or "off", depending on your MQTT device
    retain: true # or false if you want to wait for changes
```

The [qos](https://assetwolf.com/learn/mqtt-qos-understanding-quality-of-service) depends on your situation, but in short it means this:

- 0: A lot of messages are sent to the device and the connection is very stable
- 1: A message can be sent multiple times to ensure the MQTT received the message
- 2: A message can only be sent a maximum of one time and there is a handshake that makes sure the message is received

If you're building a simple switch, you can choose 1 or 2. Not a lot of messages will be sent and you want to make sure that your MQTT device received the message. You should now restart Home Assistant to make sure the configuration is loaded. Do this by going to: Configuration -> Server Controls -> Restart.

Now wait until your instance comes back online and you can move to the last step.

## 3. Create a simple on/off switch to toggle a state in your MQTT device
Now that we have registered your MQTT device as a switch, we can create a visual element for it on your dashboard. You can modify your dashboard by clicking the three dots at the top right of your dashboard and click "Edit dashboard".

![Home assistant edit dashboard](/images/articles/home-assistant-edit-dashboard-.png "Home assistant edit dashboard")

If you've never edited your dashboard you'll get a message asking if you're sure you want to edit your dashboard. Just say yes and you'll have a screen like the screenshot below.

![Edit home assistant dashboard](/images/articles/edit-home-assistant-dashboard.png "Edit home assistant dashboard")

Click the orange button on the right to add a new element. You'll get an overview and we're interested in either the "Entities" or "Button" card from the screenshot below.

![Create new element in home assistant](/images/articles/create-new-element-in-home-assistant.png "Create new element in home assistant")

If you want a button that lights up when your MQTT device has the "on" state and is off when the state is "off", than choose the "Button" card. If you just want an on/off toggle, choose the "Entities" card. By creating a switch in step 2, you should now be able to easily create a visual element for your MQTT device and toggle its state by pressing a simple button in your dashboard. Like in the screenshot below.

![MQTT switch off state](/images/articles/mqtt-switch-off-state.png "MQTT switch off state")
<span class="caption">MQTT switch off state</span>
	
And when you toggle the switch or press the big lamp in your dashboard, you'll trigger the "on" state of the MQTT device. This will automatically update the state in your dashboard like the screenshot below.
		
![MQTT switch on state](/images/articles/mqtt-on-state.png "MQTT switch on state")
<span class="caption">MQTT switch on state</span>

If you registered your MQTT device as a sensor in step 1, you can now trigger other automations based on the state of your MQTT device when you toggle your switch or press the button. I hope this helped you, I know this cost me hours to figure out by myself, so I'm already saving myself hours next time.