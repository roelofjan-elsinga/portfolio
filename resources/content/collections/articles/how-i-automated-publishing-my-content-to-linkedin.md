---
description: 'Sharing content to many platforms helps you to get the word out about your expertise. Automating this frees you up to create the content. In this post, I got over how I automated publishing my content to LinkedIn.'
post_date: '2020-07-08'
is_published: true
is_scheduled: false
update_date: '2020-07-23 11:52:08'
linkedin_post: ''
twitter_post: ''
---
![How I automated publishing my content to LinkedIn](/images/articles/automating-publishing-to-linkedin.jpg)
# How I automated publishing my content to LinkedIn
As you might have read in earlier posts, my blog is built using Laravel and my own CMS [Aloia CMS](https://aloiacms.com). This CMS is as flexible as I'd like it to be and I can make changes by extending behavior in PHP. I've migrated everything to Aloia CMS last year, as it made creating content very easy and it lowered the barriers to write content rather than have to work around current systems. Aloia CMS allows me to shape my own workflow and not shape my workflow to fit a certain system. 

As the CMS conforms to my own workflow, I was able to add all kinds of hidden automation in the system over time. The first one was sharing my content with other platforms through an Atom feed. The RSS feed followed quite quickly, as not every platform was capable of parsing an Atom feed. I could effortlessly syndicate my content to several platforms, including MailChimp, Pinterest, and Dev.to. Unfortunately, there are still a few platforms that I use to share my content that doesn't support RSS or Atom feeds. One of these platforms is LinkedIn. As I'd like to focus on the content rather than the process of syndicating the content, I set out to automate the process of sharing my blog posts on LinkedIn.

## Share on LinkedIn API
Creating content is something I enjoy a lot, but having to share this with all the platforms can become tedious over time. To overcome this burden, I wanted to automate syndicating this content. As LinkedIn doesn't support RSS or Atom feeds to publish the posts, there was another way out: API endpoints.

LinkedIn has API endpoints that you can use to publish articles, text posts, and images from any application. As I've built automation and API connections many times before, this was not much of a challenge. LinkedIn uses the standard OAuth 2.0 authentication method: Redirecting the user to LinkedIn to allow your application access to their information, receiving an authorization code, and then requesting an access token to interact with LinkedIn as the user that allowed your application access.

As the documentation is a bit of a mess at times, I'm going to list the exact pages I've used to get this to work. This is not a tutorial, so I won't do a step-by-step process in this post, but I will nudge you in the right direction.

1. [Create a LinkedIn application](https://www.linkedin.com/developers/apps/new)
2. After creating the LinkedIn application, you'll need to request these permissions: "Share on LinkedIn" and "Sign in with LinkedIn". You can do this under the "Products" section:

![Permissions in LinkedIn application](/images/articles/products-in-linkedin-application.png)

3. [Set a redirect URL for your website](https://docs.microsoft.com/en-us/linkedin/shared/authentication/authorization-code-flow?context=linkedin/consumer/context#step-1-configure-your-application). This is where you'll receive the authorization code.
4. [Request an authorization code](https://docs.microsoft.com/en-us/linkedin/shared/authentication/authorization-code-flow?context=linkedin/consumer/context#step-2-request-an-authorization-code). You should use these permissions in the scope: r_liteprofile, w_member_social.
5.  [Request an access token](https://docs.microsoft.com/en-us/linkedin/shared/authentication/authorization-code-flow?context=linkedin/consumer/context#step-3-exchange-authorization-code-for-an-access-token). This token is valid for 2 months (60 days) and will be used to publish on behave of the user that authenticates your application with LinkedIn.
6.  [Share your content on LinkedIn](https://docs.microsoft.com/en-us/linkedin/consumer/integrations/self-serve/share-on-linkedin?context=linkedin/consumer/context#creating-a-share-on-linkedin). You'll need to add "Authorization: Bearer token-here" to your request headers.

Of course, you'll need to handle any errors during this process and you should set up some system to refresh the access token before it expires.

## LinkedIn API Quirks
The LinkedIn API seems to contain a few technical choices that aren't standard practice these days and that means it requires a few different things that you wouldn't expect. These quirks include using several unexpected headers:

- Using "Content-Type: application/x-www-form-urlencoded" to get an access token (would expect application/json)
- Using "X-Restli-Protocol-Version: 2.0.0" to share your content to LinkedIn. This is required.

The POST request to share your content to LinkedIn is easy enough to copy/paste from the examples about [Creating a Share on LinkedIn](https://docs.microsoft.com/en-us/linkedin/consumer/integrations/self-serve/share-on-linkedin#creating-a-share-on-linkedin). 

## Automatically sharing blog posts to LinkedIn
Now that the API connection is set up, it's just a matter of sharing the blog posts to LinkedIn. There are many ways to do this, like triggering jobs or events to set your automation in motion. However, as sharing the blog posts instantly is not very important to me, I set up a cron job to do this for me. My blog publishes scheduled posts every day at noon if a blog post one is scheduled for that day. If I didn't schedule any posts, I can still manually publish a post. The cron job looks at the publishing dates of all of my posts and figures out which one was published on that day and automatically shares it through the API to LinkedIn at 18:00 (6 PM). This way I don't have to think about publishing anything to any platform manually anymore. 

Automation takes care of all of the repeatable actions I usually do manually and frees me up to focus on writing content instead. This goes hand in hand with my philosophy about using my own CMS, focus on creating content, not on everything around it. Any obstacle that you might face while creating content is a potential deterrent to stop creating content.

## Conclusion
Sharing content to many platforms automatically helps you to get the word out about your expertise and it frees up the time you'd have normally spend on manually sharing your content to those platforms. A lot of platforms support RSS or Atom feeds to automatically publish your content but not all of them. LinkedIn, for example, doesn't support syndicating content through RSS feeds, but it does have API endpoints to be able to automate this. In this post, I went over the steps I took to set up publishing my blog posts to LinkedIn automatically through API endpoints and cron jobs.

I automate everything that's repeatable and might be an obstacle in the content creation process. Roadblocks are the potential to stop creating content and that's why I go out of my way to solve those roadblocks and make the process as smooth as possible.

If you're looking to do this for yourself or your business, you can always contact me and set up a plan of action.