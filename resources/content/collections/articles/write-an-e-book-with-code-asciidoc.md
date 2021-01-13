---
description: 'Markdown is a simplistic markup language to focus on the content instead of the individual elements, but it''s also very limited. You can use Asciidoc to accomplish the same simplicity while still being able to create more complex structures. In this post, we''re going over how you can convert an Asciidoc file to a PDF book.'
post_date: '2020-12-03'
is_published: true
is_scheduled: false
update_date: '2021-01-13 12:08:16'
linkedin_post: ''
twitter_post: ''
tags:
    - asciidoc
    - ebook
---


![Asciidoctor logo](/images/articles/asciidoctor-logo.png "Asciidoctor logo")
# Asciidoc and Asciidoctor: Write an e-book with code
Writing a book is something most bloggers or content writers have thought about at some point in time. So have I, so I looked at ways I could reuse a few blog posts as a base for a book. As all of these blog posts are markdown files, I initially looked for a way to turn Markdown files into an e-book by converting it to a PDF. There we're a few options available, for example: [themsaid/ibis](https://github.com/themsaid/ibis). This library is easy to use, but also very limited in customization. 

Then I was pointed towards [Asciidoc](https://asciidoc.org/), something I wasn't familiar with. In this post, we'll go over what Asciidoc is and how you can use it to generate PDF, EPUB and MOBI documents. Don't let the official Asciidoc website fool you with its simplistic and outdated looks: it's very modern and can do all the heavy lifting, so you can focus on your content.

## What is Asciidoc?
Asciidoc is a markup language like Markdown, but it has many more features. Like Markdown, you can convert Asciidoc to more common formats like HTML. However, you can do a lot more with it. Markdown is built with basic HTML elements in mind, but sometimes the HTML is too complicated and you'll need to inline HTML code in your Markdown files. Markdown is supposed to be simple. 

Asciidoc, on the other hand, has many plugins you can use to parse the files into other formats. Parsing Asciidoc to HTML is just one of the parsers. There are many more available like PDF, EPUB, Docbook, and MOBI. You can use the same Asciidoc file to create all kinds of different formats of your content. Because you can use the same file to create different types of output files, you can create a format of your content that works for your readers, not just what's easiest for you.

## Pre-requisites for creating PDF's
In order for you to create a PDF from Asciidoc files, we'll need some software. This is what we'll need to get started:

- Ruby >= 2.7
- Asciidoc (apt-get install asciidoc)
- Asciidoctor (included in example Gemfile)
- Asciidoctor-pdf (included in example Gemfile)

And the example Gemfile looks like this:

```ruby
source "https://rubygems.org"

gem "asciidoctor", "~> 2.0.10"
gem "asciidoctor-pdf", "~> 1.5.3"
```

To install these gems, run the following command in the folder where you keep the Gemfile:

```bash
bundle install
```

## Basic Asciidoc configuration
In Markdown, the files only contain content, unless you use a separate parse for things like Yaml Front Matter. For Asciidoc files, all configuration is done in the ".adoc" files themselves. This is convenient, because you'll have everything you need in a single place. Let's go over a basic example that we'll call book.adoc.

```asciidoc
= Title of your book
:author: Author Name
:email: email@example.com
:revnumber: v0.1
:revdate: 02.12.2020
:notitle:
:doctype: book
:chapter-label:
:sectnums:
:toc: left
:toclevels: 2
:toc-title: Table of Contents
:front-cover-image: image::images/cover.jpg[]
:description: This is the description of your book
```

That looks very intimidating, but a lot of it is optional and easy to look up in the documentation. Let's go over what each of these tags mean and why you would want to use them. As a little sidenote, you can also specify the author in a different format:

```asciidoc
= Title of your book
Author Name <email@example.com>
v0.1, 2020-12-012
```

However, I like to work with as much verbosity as possible, to make it as easy on myself as I can. You can choose which format you'd like to follow. 

Besides the author information, we still have these tags left:

#### :notitle: 
This means we don't want to display the title of the book at the front of the book. Instead of this, we'll display an image as the title page using ":front-cover-image:".

#### :doctype: book
We make sure to mark this document as being a book, rather than a website. This sets a few defaults, like alternating left and right pages.

#### :chapter-label:
Here you can specify a prefix for chapter tables. This defaults to "Chapter", resulting in chapter names like this: "Chapter 1. Title of chapter 1". If you don't want the "Chapter" prefix, like me, you can overwrite this behavior and keep it empty. This will now result in "1. Title of chapter 1".

#### :sectnums:
In the previous label (:chapter-label:) we specified a prefix, or rather remove it. But there is still a number in the chapter title. This number is in the chapter, because :sectnums: makes this happen. If you prefer to not have numbers for your sections (1, 1.1, 1.2, 2, etc.), then you can choose to not add this tag.

#### :toc:, :toclevels:, :toc-title:
The tag :toc: tells the Asciidoc parser that we want a Table Of Contents. This will automatically add all chapter and section headers to the table of contents, without any manual work from you. If you prefer to only have chapters in the Table of Contents, you can change the :toclevels: to "1". Having it set to "2" here means that both chapters (1, 2, 3, and 4) and sections (1.1, 1.2, 2.1, 2.2) will be added. You can even set it to 3 or more. This way it'll start adding subsections (like 1.1.1, 1.1.2, etc.) as well. Now that we've specified that we want chapters and sections in the Table of Contents, we can even specify what we want to call the Table Of Contents. In this case, it'll be called: "Table of Contents", but you can name this anything you'd like.

#### :front-cover-image:
Earlier, we went over the fact that we don't want the title of the book on the first page, but rather use an image as our cover. You can specify this behavior by adding this tag with a path to an image. The syntax for adding images in an asciidoc document is "image::./images/cover.jpg[Alt text here]". It's very similar to Markdown.

#### :description:
You can add a description as meta data to your PDF by specifying a value here. This is an optional step, so you can choose not to do this as well.

If you ever get stuck with the formatting or which tags to use, you can look it up on the internet, because unlike Markdown, there is only 1 standard. This makes searching keywords on Google for Asciidoc very easy.

## Basic Asciidoc syntax
Asciidoc syntax is quite easy to learn, but there is a lot of things you can do. To keep this post simple, we'll only go over the most commonly used ones and skip the majority of other ones. If you'd like a full list of the syntax, there is a great guide on the [Asciidoctor website](https://asciidoctor.org/docs/asciidoc-writers-guide/). They describe everything you might want to use. For now, we'll stick with the most common ones. I'll convert these to HTML tags to give them some context:

- == (h1)
- === (h2)
- . (a dot, ol)
- \* (ul)
- image::images/image.jpeg[Alt text] (img)
- \_text_ (italic text)
- \*text* (bold text)
- include::chapters/chapter-1.adoc[] (include a file)

As I mentioned, there are a ton more, but these are the most commonly used ones. If you noticed, an H1 is two equal signs instead of just one. One equal sign is the title of the book, this is why it's all the way at the top of the configuration section.

## Writing the content
Now that we have the configuration and we know the basic syntax, let's write a simple "book" that we can convert to a PDF in the next section. In Asciidoc, you write the content in the same file as the configuration from earlier, but you can also choose to include separate files and write you content in there. You can start writing content under the configuration from earlier, just make sure to leave an empty line like so:

```asciidoc
# ... rest of the configuration
:front-cover-image: image::images/cover.jpg[]
:description: This is the description of your book

== Title of chapter 1
```

Instead of writing the content in the main book.adoc document, you can also include chapters by doing this:

```asciidoc
# ... rest of the configuration
:front-cover-image: image::images/cover.jpg[]
:description: This is the description of your book

include::chapters/chapter-1.adoc[]
```

Now that we have some content, we can generate a PDF from this "book".

## Generating a PDF from an Asciidoc document
If you remember from the prerequisites, we installed the Ruby gems we need to generate a PDF from an Asciidoc document. 
These Gems are going to help us to create a PDf with a single command. 
We've named the main file of our book "book.adoc". We're going to export this file to "book.pdf" using the following command:

```bash
bundle exec asciidoctor-pdf book.adoc
```

There are several things you can specify while using this command, for example the output filename. 
If you want to change the output filename, you can do so by passing a flag to the command:

```bash
bundle exec asciidoctor-pdf book.adoc --o my-amazing-book.pdf
```

As you can see, it's a simple and readable command. Now you'll have your PDF file and you can open it to view your new book.

## Styling your PDF document
Asciidoc has a lot of features, you can change almost everything about it, like the styling of your PDF.
I won't go into details about styling this in this post, but if there is interest (contact me), I could write a post about this.
Instead, I will leave you with a link to the best resource I can find for styling your PDF and this command you could use to apply your styles:

```bash
bundle exec asciidoctor-pdf book.adoc -a pdf-style=themes/light-theme.yml -o my-amazing-book.pdf
```

As you can see, you can specify a stylesheet to apply to your PDF. The best reference for how to write this can be found on 
[GitHub](https://github.com/asciidoctor/asciidoctor-pdf/blob/v1.5.3/docs/theming-guide.adoc).

## Conclusion
Markdown is a simplistic markup language to focus on the content instead of the individual elements, but it's also very limited.
You can use Asciidoc to accomplish the same simplicity while still being able to create more complex structures. 
In this post, we went over how you can convert an Asciidoc file to a PDF and optionally add some styling to it. 
The learning curve can be quite steep, from my personal experience, but once you understand how it works you'll have superpowers.

