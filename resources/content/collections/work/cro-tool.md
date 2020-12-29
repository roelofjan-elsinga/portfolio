---
image_url: /images/work/cro-tool-homepage_640.jpg
thumbnail_url: /images/work/cro-tool-homepage_500.jpg
image_alt: CRO-tool homepage
title: CRO-tool
description: >
  CRO-tool is a tool to create hypotheses for CRO using psychological theories. 
  It includes a thorough search engine to find the theories you need to get started.
url: /portfolio/cro-tool
project_url: https://cro-tool.com/
active: true
publish_date: 2020-02-18
---

![CRO-tool homepage](/images/work/cro-tool-homepage_640.jpg)

# CRO-tool

CRO-tool is a tool to create hypotheses for CRO using psychological theories. It includes a thorough search engine to 
find the theories you need to get started. In the future, hypothesis creation tools, and data collections tools will be added.

## The goal of the project
The goal of this project is to make the lives of CRO professionals a little easier. Psychological theories are all over the internet, 
but there is not a central place where all of them can be found, let alone searched through. 
CRO-tool aims to be this central place and utilizes a very popular search engine, Elasticsearch, 
to help people find what they need more quickly.  


## What's my role in this project?
My role in this project is the development of the public facing website, the search engine infrastructure, 
the back-end management tools, and the blog. 

## Tools used
To build this application, I've used the following tools and techniques:
- PHP (laravel)
- Elasticsearch
- Docker
- Event sourcing
- PHPUnit
- SCSS (+tailwindcss)

This application is quite data-heavy, so using Elasticsearch was the easiest way to 
make the correct and relevant data show up for searches.

## Event sourcing
I built he entire system using Event sourcing. I've done this to be able to make the data replicatable across environments.
Event sourcing also helps to trigger events, determine if changes need to be made and much more. 
This is a much easier way to automate processes without having to write custom checks in multiple processes.

Changes to the data could trigger events if the aggregate determines this needs to be done. 
Event sourcing also allows the application to not unnecessarily write data to a database if nothing changed.


<a href="https://cro-tool.com/" target="_blank" class="link link--underline">View the website</a>
