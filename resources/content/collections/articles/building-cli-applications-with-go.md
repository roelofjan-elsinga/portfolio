---
description: 'CLI applications are very useful for performing tasks and automations in many different environments. In this post I go over how you can get started writing applications like this in Go.'
post_date: '2020-05-13'
is_published: true
is_scheduled: false
update_date: '2020-05-14 13:51:31'
---
![CLI tool in Go](/images/articles/cli-tool-in-go.png)
# Building CLI applications with Go
Command Line Interface (CLI) applications can automate your work in many ways. They can be used to build your applications, deploy code, run processes, and do all kinds of other miscellaneous tasks. Developers often favor CLI tools because they don't require a user interface, often have consistent behavior in different environments, and are much easier to configure and distribute. The Go community has become much bigger in the past few years and because of this, there are several CLI tools that have migrated from bash scripts to Go binaries. There is no better time to learn how to write a CLI application yourself.

In this post, we're going over how to build a simple CLI tool in Go. You might be wondering: why should I use Go for this? These are the reasons for me: the code is expressive, it can be compiled to a binary which is easy to distribute, and it's very fast. This post is not an in-depth tutorial on how to write Go applications, because the implementation of these scripts is up to you, the developer. That's why I'm going to stick with a simple "Hello, World!" application and add some complexity, so you can start building CLI tools in Go for your own projects.

This post assumes you have already installed Go on your system.

## The basic "Hello, World!" application
The basic "Hello, World!" application is a nice way to see some of the syntaxes in Go in action. To get started writing a simple CLI application in Go, let's begin with the "Hello, World!" application:

<script src="https://gist.github.com/roelofjan-elsinga/3165abc10e766e9af54a5a9cba16b4c8.js"></script>

What does this code mean? First, we define this file as the entry point to our CLI application by specifying "package main". You can give the file itself any name you'd like. I usually stick with "main.go" to be clear about which file is the entry point of the application.

As this file is the entry point to the application we have to define a function that will be executed when you run it. You do this by specifying a "main" function. The body of the entry function is printing the famous "Hello, World!" to the terminal. So when we run the command:

```bash
go run main.go
```

You will see "Hello World!" in the terminal. Now that we can print something to the terminal, let's add some complexity and configuration options by working with flags.

## Adding flags to the application
Flags are used to configure an application. These flags can be used in a lot of different programming languages, including Go. For this example, I want to customize the message that's displayed in the terminal by passing some data to the application through flags. Let's see how we can customize the behavior or our CLI application based on some input from the user:

<script src="https://gist.github.com/roelofjan-elsinga/39cc6df5483622bdcbf27c9307b2b8c6.js"></script>

You can see that we define two flags for our application. One of the flags is called "message" and the other is called number. Again, these names are up to you and your needs. We define the type of flags (flag.Int, flag.String), enter the name of the flag, the default value, and a helpful message about what this flag means.

Now that we've added the help messages, we can run a help command:

```bash
go run main.go --help
```

This will return the possible flags you can use on this command:

```
Usage of /tmp/go-build456763591/b001/exe/main:
  -message string
    The message you'd like to print to the terminal (default "Hello, World!")
  -number int
    The number you'd like to add to your message (default 1)
exit status 2
```

This is helpful in case you ever need to run your binary but don't have the source code to look at. It's also great for distributing your application because you can tell the user which options are available. At the bottom of the main function, you can see that I'm passing the message variable like so: \*message. This is because the message variable doesn't actually have a value, but it's a pointer to a place in memory. By adding the asterisk in front of it, you retrieve the value from memory and you can print it to the terminal like a normal string. The other variable, number, is passed to the Println method like "strconv.Itoa(\*number)" because the value of \*number is an int and not a string. Since Go is a strictly typed language, you'll need to convert it to a string before you can do any string concatenation.

So now that we can run the application like before, without the flags, and see a new text show up:

```bash
go run main.go
```

**Shows**: "This is the message you want to display: Hello, World! with number 1"

As you can see, the flags still have the default value. Now let's try adding custom values:

```bash
go run main.go --message "Hello, Internet!" --number 42
```

**Shows**: "This is the message you want to display: Hello, Internet! with number 42"

As the new message has a space, you'll need to use double quotes to treat the string as a single value. As you can see, the sentence printed to the terminal now contains the values you passed to the command. 

## Using flags to write a simple automation
Now that we know how to pass values to our CLI application, it's good to make this application actually do something for us. We'll write a simple script that reads contents from a file and writes those to another file. We want to customize the source and target file. The package we'll use for this is [ioutil](https://golang.org/pkg/io/ioutil/). This is a simple application, but by using these techniques you're able to write complex automations and build your applications in such a way that it does exactly what you need it to.

Let's look at the code for this scenario:

<script src="https://gist.github.com/roelofjan-elsinga/69826bce71435742d9a343d1867486f0.js"></script>

Like before, we define two flags. One represents the source file and the other the target file. In my case, I've created a source.json file and added that filename as the default value for the application. This is the content of source.json:

```json
{
    "message": "This is a message from the source file"
}
```

After parsing the flags, we read the contents of the source file by using ioutil.ReadFile(\*sourceFile). This returns the data in bytes and also an error if something went wrong. If there was an error we display an error message in the terminal to notify the consumer of the application that something went wrong while reading the source file. Perhaps you didn't have a source file. If that's the case, the application lets you know by showing this message:

```bash
go run main.go --source src.json
```

**Shows**: "Found an error while reading the source file: open src.json: no such file or directory"

After displaying the message we make sure to exit the application because we don't have all the information we need to continue. By returning exit code 1, we make sure the terminal knows something went wrong. Now that we know we have the contents of the file in memory, we can write it to the target file by using "ioutil.WriteFile()", passing the target filename, the file contents, and the proper file permissions. 

Again, we check if something went wrong and notify the consumer if that was the case. If everything went correctly you get the following output:

```bash
go run main.go --source source.json --target target.json
```

**Shows**: "Copied the contents of source.json to target.json"

You should now have a new file called target.json with the same contents as the source.json file. This is a very simple example, but you can see how you can capture the user input and using it to perform some kind of action based on that input. The number of different applications you can make with something simple as these input flags is as big as your imagination.

## Conclusion
Writing CLI applications doesn't have to be difficult. Whether you write shell scripts, Node.js, PHP, or Go, they offer developers a very wide range of possibilities. CLI applications can make your life a lot easier by writing all kinds of automations in a lot of different environments. This post was all about writing CLI applications in Go because it's expressive, you can compile it to a binary, and the execution of these automations is very fast.

Now that we've covered the basics of building a CLI application in Go, the types of applications and options you offer to configure these applications are endless. For example, you could build an application where you perform certain tasks while offering the user to skip some of the tasks. This is all up to what you want and what your needs are. I hope this post showed you some new things that you could use to start writing your own CLI applications in Go.

If you'd like to talk more about this you can contact me on [Twitter](https://twitter.com/RJElsinga).