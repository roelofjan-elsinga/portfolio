---
description: 'In this post, I''m showing you how you can proxy API calls to your server during Angular development and make the development process very painless.'
is_scheduled: false
is_published: true
post_date: '2019-12-11'
url: proxy-api-calls-to-your-server-during-angular-development
update_date: '2021-01-13 13:57:27'
linkedin_post: ''
twitter_post: ''
tags:
    - angular
---
!["Angular logo"](/images/articles/angular-logo.jpg)
# Proxy API calls to your server during Angular development
When you're developing an Angular application, you'll most likely use "ng serve" to display your application. When you're trying to request data through API calls to "/api/some/resource" you get a 404 response. But why? Well Angular sends the API request to http://localhost:4200/api/some/resource. Because you're not specifying a domain in your services, just a path, Angular will send the request to the current domain, which is fine for development, but will break in development.

This is where the built-in proxy comes into play. When you're using "ng serve", you're serving the application at http://localhost:4200. This means the services will call the API at http://localhost:4200/api/some/resource, however, your API server doesn't exist at that URL and returns a 404 for everything. Your API server is served at something like http://localhost:8000/api/some/resource. By creating this proxy, the development server accepts the requests at port 4200 and sends them to port 8000 behind the scenes. So now you get your data instead of a 404.

## The code for this to work

This is the config you would be using for the situation I painted here:

```json
{
  "/api": {
    "target": "http://localhost:8000",
    "secure": false
  }
}
```

This config should be placed in a new file called: "proxy.conf.json" and you should place this in the src folder of your Angular project. Next, you need to point to this file in "angular.json". Open the file and search for the "serve" section. Here you can add a "proxyConfig" key to the options. You should end up with something similar to this:

```json
"serve": {
    "builder": "...",
    "options": {
        "proxyConfig": "src/proxy.conf.json"
    }
}
```