---
update_date: '2019-09-27 08:42:18'
description: 'In this post I''ll explain how you can fix CORS headers for usage in a single page application. I give code examples with comments for Nginx and Apache.'
is_scheduled: false
is_published: true
post_date: '2019-09-27'
url: how-to-fix-cors-headers-single-page-application
---

!["Private mailbox"](/images/articles/private-mailbox.jpeg)
# How to fix CORS headers in a single page application
Making cross-domain XHR requests can be a pain when building a web application as a single page application, fully written in JavaScript. Your browser will send an additional request to your server, a so called Preflight request. This request won't have the normal request type you're used to (GET, POST, PUT, DELETE), but it'll have type OPTIONS. **But what does it mean and how do you solve it?**

## What is a Preflight request?
A preflight request is a simple request your browser automatically sends to the server when you're requesting data through an AJAX call in JavaScript when you're not requesting data from the same domain name. This also applies when you request data on localhost but on a server running on a different port, example:

```
# No preflight request will be sent here, the domains are the same (localhost:8000)
http://localhost:8000 -> GET http://localhost:8000/api/resources

# A preflight request will be sent here, the domains are the different (localhost:4200, localhost:8000)
http://localhost:4200 -> GET http://localhost:8000/api/resources
```

When the domain differs, the browser will send an OPTIONS request *before* it sends the GET request. This OPTIONS request is simply there for the browser to ask the server if it can request this data. So if the server response with some explanatory headers and a 200 OK response, the browser will send the GET request and your application will have the data it needs.

## How to solve this situation?
Solving this situation is quite simple: you just have to add headers to your response indicating what the browser is allowed to request and what not. Below will follow a few examples that you can copy/paste, be mindful how much you want to allow the browser to do though.

### Nginx
This section contains the settings you should use for Nginx, Apache will be further down. For this to work on Nginx, we'll make use of the **add_header** directive: [Documentation can be found here](http://nginx.org/en/docs/http/ngx_http_headers_module.html)

**Allow all requests**
```
# Allow all domains to request data
add_header Access-Control-Allow-Origin *;

# Allow all request methods (POST, GET, OPTIONS, PUT, PATCH, DELETE, HEAD)
add_header Access-Control-Allow-Methods *;

# Allow all request headers sent from the client
add_header Access-Control-Allow-Headers *;

# Cache all of these permissions for 86400 seconds (1 day)
add_header Access-Control-Max-Age 86400;
```

**Allow all requests from certain domains**
```
# Allow http://localhost:4200 to request data
add_header Access-Control-Allow-Origin http://localhost:4200;

add_header Access-Control-Allow-Methods *;

add_header Access-Control-Allow-Headers *;

add_header Access-Control-Max-Age 86400;
```

**Allow certain request types to be made**
```
add_header Access-Control-Allow-Origin *;

# Allow GET and HEAD requests to be made
add_header Access-Control-Allow-Methods GET, HEAD;

add_header Access-Control-Allow-Headers *;

add_header Access-Control-Max-Age 86400;
```

**Allow certain headers to be sent**
```
add_header Access-Control-Allow-Origin *;

add_header Access-Control-Allow-Methods *;

# Allow only the Authorization and Content-Type headers to be sent
add_header Access-Control-Allow-Headers Authorization, Content-Type;

add_header Access-Control-Max-Age 86400;
```

### Apache
The same headers used in the section for Nginx will work in this section, you'll just have to implement it slightly differently. You can place them in a .htaccess file or straight into the Apache site configuration or global configuration.

```
<IfModule mod_headers.c>
    Header add Access-Control-Allow-Origin *
		Header add Access-Control-Allow-Methods *
		Header add Access-Control-Allow-Headers *
		Header add Access-Control-Max-Age *
</IfModule>
```

As you can see, you will need to enable the headers module for Apache if this hasn't been done already.

I hope this post helped solve the problem, I know I got stuck with this for a few hours before I found this seemingly simple solution. If you have any other questions or comments, you can send them to me on [Twitter](https://twitter.com/RJElsinga).