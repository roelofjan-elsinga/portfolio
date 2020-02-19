---
update_date: '2019-08-30 20:13:53'
description: 'Find out which file types I use for certain scenarios and which situations suit a specific file type best. We’ll dive into JSON, YAML, XML, and dotenv.'
is_scheduled: false
is_published: true
post_date: '2019-04-04'
url: my-choice-of-configuraton-file-types
---

![My choice of configuration file types](/images/articles/post-in-json.png)

# How to Pick Right Configuration File Type for Your Project
> Understand & learn about different configuration file types available to setup your project in workspace.

Configuration, people love it and people hate it. You can change the behavior of your application with it and 
customize it to your needs. When this is over lunch complicated, you get frustrated if there is no documentation. 
So how do you choose which file types to use for this? There is no easy answer to this, 
so let me break it down a little bit. In this post, I'm going to highlight four different file types that I have used 
and will use for these kinds of tasks. These file types are JSON, YAML, XML, and dotenv. 

## JSON
The first file type I'll highlight is JSON. JSON is very popular if you need to share data between different 
programming languages, even different applications. It's the go-to method for data transfers between modern API's. 
It's compact, easy to read, and all major programming languages can parse it without any problems. 
This is a very simple way to get started quickly. 

However, there are disadvantages to using JSON as well: You can't use comments in a JSON file or JSON structure. 
This means that you will need to write documentation for your data structure. Writing documentation is a good thing 
anyway, but you don't have the opportunity to clarify any data in the data itself.

I would use JSON files for very simple configurations and settings that you want to be able to parse quickly, 
without much effort. 

*An example of JSON configuration can be found at the top of this post.*

## YAML

![Configuration in YAML](/images/articles/my-choice-of-configuraton-file-types/post-in-yaml.png)
<span class="caption">An example of the YAML version of the JSON configuration from the previous section.</span>

YAML is a compact and yet a readable version of XML, which allows for objects and arrays. 
This makes it useful if you're used to JSON because you can emulate the same data structures in both file formats. 
Unlike JSON, you can actually use comments in your configuration files, allowing for inline documentation, 
possible configuration options, and altogether a more seamless experience for developers.

Of course, all good things also have disadvantages. Not all programming languages have native support for parsing 
the files. Most, if not all languages will have additional libraries you can install to parse these files though. 
So you're not completely stranded when you want to use YAML, but your programing language doesn't support it. 
It also has quite a steep learning curve for writing properly formatted files. If you're used to C type languages, 
this will be a difficult transition. Like Python, YAML needs to be indented properly to work correctly. 
If you accidentally indent a line in a different way than the parse expects, it might assign the chosen properties 
to either a parent or child object. 

I would use YAML for more complex kinds of configuration. It's ability to contain comments, yet still be compact 
allows you to quickly write something new and document this. However, I wouldn't use this for simple configurations, 
because it takes a bit of effort to get it to work.

## XML

![Configuration in XML](/images/articles/my-choice-of-configuraton-file-types/post-in-xml.png)
<span class="caption">An example of the same configuration as before, but this time formatted in XML.</span>

XML, the markup languages a lot of people love to dismiss instantly. "It's old fashioned, get it out of my face!". 
However, because it's been around for a while, it has proven to be very reliable and this also helped to include 
parsers for it in a lot of languages. A lot of languages either have native built-in parsers for it, 
or there are extensions and libraries for that you can use to extract data from it. It also allows for comments, 
so you can inline all the needed documentation if you so choose. It looks like HTML, 
which makes it easier to understand than JSON or YAML. 

There are some dates as well. The configuration files are much larger in size then JSON or YAML. 
This isn't a problem if you don't have a lot of data or if you won't be sharing it with anyone. 
So files size could be relevant or irrelevant depending on your situation. XML parsers are more difficult to use 
than JSON or YAML. Every time I have to parse the data in PHP I get a little overwhelmed by how complex the parser 
actually is. After a while you understand why it works this way though, so it will get better. 
XML files have quite a steep learning curve to writing proper XML. A simple mistake could invalidate your whole XML 
file. Looking at examples and experimenting with this will be useful.

I would use XML for simple, but also very complex data structures. 
It's very simple to create a hierarchy and to add properties to itself. Most languages have native parsers for it, 
so you could get started right away. You can make these files as simple or as difficult as you want. 
It won't be the most readable data, but if you're used to HTML, you will understand what's going on.

## Dotenv

![Configuration in Dotenv](/images/articles/my-choice-of-configuraton-file-types/post-in-dotenv.png)
<span class="caption">Since you can't really use a dotenv file for complex configuration, 
I've decided to use the example below to display some information about this whole website.</span>

Dotenv or .env are by far the simplest configuration files you can think of. 
These are technically used as configuration files for a specific environment, 
but you can change a lot of behavior with the values it holds. Dotenv files are usually specific to a 
single environment and shouldn't be saved in version control. You can use comments in dotenv files, 
but since you most likely won't be sharing these with anyone else, this will be for your own benefit 
and not for others. This type of configuration has a very simple key-value format.

There are a few disadvantages to using dotenv files for configurations. The first is that all keys need to 
be unique and all values are a simple string. So there is no way to save objects or arrays with this. 
Another disadvantage is that you shouldn't add this in version control. 
This means you could have completely different configurations in each environment. 
This sounds bad but is also one of its strengths.  

Dotenv files shouldn't be used for any complex configurations. It should be used for configuring connections to 
external services, hold usernames and passwords, and be used to keep track of the current application environment. 
This is what it's great for, but nothing more complicated.

### What's your go-to configuration file type?

If you're looking for a nice way to store any complex configurations, choose one of the first three. 
If you're looking to keep track of simple data, choose a dotenv file. 
Are you using any other file type for configuration? If so, why are you using this file type specifically? 
I'd love to hear your take on this subject! Let me know on [Twitter](https://twitter.com/RJElsinga) 
what you use to configure your applications.
