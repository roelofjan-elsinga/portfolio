---
description: 'SEO is very important to help people to find your website. To help Google understand the content of your website you can use Structured data to provide more context about your website and individual pages. In this post we go over how you can implement this in your website.'
post_date: '2020-05-06'
is_published: true
is_scheduled: false
update_date: '2021-01-13 12:14:03'
linkedin_post: ''
twitter_post: ''
tags:
    - seo
---
![Search performance plant care for beginners](/images/articles/search-performance-for-plant-care-for-beginners.png)
# Technical SEO: How to add structured data to your website
Structured data is a way to normalize your data and Google uses it to understand better what your website and specific pages are about. This is where you can help Google by providing this kind of information on your website. In turn, Google can use this to improve the appearance of your website in the search results. If you've ever seen an FAQ, company details, and news articles in your search results, then you've seen what structured data can do for your website.

In this post, we'll go over a few common structured data types that you can add to your website today. Structured data might sound like something that's complicated, but all it is is a JSON object in your HTML content. These are the structured data types we'll go over in this post:

- Article
- Breadcrumb
- FAQ
- Logo
- Sitelinks searchbox

These are types that you can add to a blog, but you can pick and choose which one applies to your situation. You can find the full list of available data types on [Google Developers](https://developers.google.com/search/docs/data-types/article). They may be worth checking out if your needs differ from what I'm describing in this post.

## Where do I place the structured data?
Structured data is a script with a type, it's not content that will be displayed on the page. This means you can place this code snippet really anywhere in your HTML file. It's easier to maintain if everything is grouped together at the bottom of the page. I'm using blocks and components for this website, so I always place the related structured data inside of that component. This could mean that the structured data for the breadcrumbs is all the way at the top of your page and the rest of your code snippets at the bottom of the page. 

## Article
An article can be an actual article, but also a blog post. First, let's show the structured data for the previous blog post that I posted on this website. This will give you a good look at what this structured data looks like:

<script src="https://gist.github.com/roelofjan-elsinga/17519a9199f025aac0078a8181429a18.js"></script>

As you can see, this code snippet contains a few attributes to identify what kind of structured data we're dealing with: @type and mainEntityOfPage. The JSON object also includes a @context to tell anyone parsing this data that this is a schema of some sort. Then you find the dateModified and datePublished attributes. These dates will be used to display the publish and sometimes the modification date in the search results in Google. Notice how the screenshot below shows "22 Apr, 2020": 

![Screenshot of Google Search results for GitHub Pages](/images/articles/screenshot-google-search-result-jekyll.png)
<span class="caption">Screenshot of Google Search results for GitHub Pages</span>

Google was able to add this to the search result because I made that information available through structured data in the HTML. 

Then we have the "headline" attribute. In most cases, this is just the title of your article or blog post. The author attribute is a special attribute because this is a nested data type. You can recognize nested data types by the @type attribute. In this case, we make sure to specify that an author is a Person with the name "Roelof Jan Elsinga". This is not displayed in the screenshot above, but it does help Google to make better sense of the content on the page. 

The publisher attribute, like the author attribute, is a nested data type that itself contains another nested data type (logo). You can add your own name or the name of the company you work for at the name for the publisher and the URL in the logo should point to your logo or that of your company.

The last two attributes are about the article/blog post itself. The image is an array of the images you want to feature for this particular post. In my case, this is always the header image, but you can add multiple images. The description is optional, but I use the same value as the description meta tag. 

## Breadcrumb
Breadcrumbs are a great way to show your visitors where they are on your website. Besides having visual breadcrumbs on your pages, you can add this as structured data as well. This will help Google to improve the breadcrumbs in the search results. Have a look at the screenshots below and notice the difference in the breadcrumbs. 

![Screenshot of search result without breadcrumbs](/images/articles/screenshot-of-search-result-without-breadcrumbs.png)
<span class="caption">Screenshot of a search result without breadcrumbs</span>

The first one doesn't have any structured data set up, so Google breaks the URL apart and uses that as the title for the section of the website. 

![Screenshot of search result with breadcrumbs](/images/articles/screenshot-of-search-result-with-breadcrumbs.png)
<span class="caption">Screenshot of a search result with breadcrumbs</span>

The second screenshot does have structured data with a proper title for the section of the website. This helps to improve the awareness of the location of the page within the website. Now let's see what this looks like as structured data.

<script src="https://gist.github.com/roelofjan-elsinga/302ad77b12423ee039cc651ec82ff4a2.js"></script>

Like before, we make sure to mark this JSON object as being a schema and we define this object is of type "BreadcrumbList". The next attribute "itemListElement" contains all depths within your website to get to the current page. This snippet is from the [page behind the second screenshot](https://plantcareforbeginners.com/articles/how-to-care-for-calathea-ornata), you can look at the page source of that page and you'll see this snippet in the HTML of that page. The attribute "itemListElement" is an array containing list items. Each list item is a nested data type. 

The attributes of that "ListItem" are position, name, and item. Position means the depth of the page on your website, starting at 1. The homepage is always position 1. In this case, "Plant guides" is at position 2. Looking at the second screenshot, you can see this as the second item in the breadcrumbs as well. The item attribute in the structured data is the URL belonging to the current depth level you're looking at. 

## FAQ
If you write tutorials or blog posts about topics you're an expert in, it's often a great idea to include an FAQ on the page for your visitors to get answers to questions they might have. These FAQs should be visible to your visitors as well as being included as structured data. If you only include these FAQs as structured data and not also include a visual representation of it, Google might punish you for this and your SEO benefits are gone. For the FAQ we'll look at the page we went over in the Breadcrumb section. Below you'll find a screenshot of the FAQ on the page as a visual representation.

![Screenshot of FAQ on Plant care for Beginners](/images/articles/screenshot-of-faq-on-plant-care-for-beginners.png)
<span class="caption">Screenshot of FAQ on Plant care for Beginners</span>

This is a visual representation of the FAQ that users can interact with. Now that you have this available on the page, you can add it as structured data as well. This looks like the following snippet.

<script src="https://gist.github.com/roelofjan-elsinga/f49c8746c7f4f40354a0e3b9c74b2256.js"></script>

I've removed the last two questions to not make the code snippet too long and I've redacted the remaining two answers because the actual content is not important for this post. To create structured data for your page, set the @type of the JSON object to FAQPage. The mainEntity is an array of questions and answers. The questions and answers are both nested data types of Question and Answer. The question you're displaying in your FAQ section can be added to the "name" attribute of the question and you can add the given answer to the "text" attribute of the nested answer data type. 

Google uses the FAQs to compile a list of questions and answers in the search results. When you're the one that answered the question in your content and/or structured data, you're answer and website get featured like the screenshot below.

![Screenshot of FAQ in Google search results](/images/articles/screenshot-of-faq-in-google-search-results.png)
<span class="caption">Screenshot of FAQ in Google search results</span>

This is a great way to drive more traffic to your website through Google searches.

## Logo
If you have a business website, the chances of you having a logo in one way or another are fairly high. This logo is something you should have on the menu at the top but is also something you can add to your website using structured data. Along with the logo, you can add other business details like the website and the name of the business. Let's see what this looks like as a code snippet.

<script src="https://gist.github.com/roelofjan-elsinga/7b41379280fce58b2f8e983b532a2bed.js"></script>

To define a logo, Google uses the "Organization" data type and only needs the "logo" and "url" attribute. The other attribute "name" is defined on the Organization data type but is not required by Google. So you can add this, but it's optional. This structured data is short and simple and that means you can add it to almost all of your websites. There are a few guidelines you should keep in mind when it comes to submitting a logo. You can read find these in the [Type definition on Google Developers](https://developers.google.com/search/docs/data-types/logo#definitions).

## Sitelinks searchbox
Have you ever seen a search result with an embedded search box and wanted that for your website as well? Well, that's what you can use structured data for as well. The most important part to get this to work properly is that you need a search page that takes a search term in the URL. An example of my own [blog](https://roelofjanelsinga.com/articles) is: 
```
https://roelofjanelsinga.com/articles?q=search+terms+here
```

This doesn't have to be a query parameter, it could also be part of the URL:
```
https://example.com/search/search+terms+here
```

As long as you can add the search query in the URL in some way, this will be possible for your website as well. Let's look at what this code snippet looks like for my website.

<script src="https://gist.github.com/roelofjan-elsinga/f04aedeb41149e62a0c998d7bf490c3a.js"></script>

In this code snippet, we're defining a website with potential actions to take on this website. In this case, a potential action on my website is to search for blog posts. So first of all, we need to define this data to be of type "WebSite". We need to define the URL of your website and then add an array of "potentialActions". Each item in the "potentialActions" array is a nested data type. In this case, it's a "SearchAction". 

A search action needs the URL of your search page and a placeholder for the search terms people can fill in in the search results on Google. This placeholder is called "{search_term_string}". This placeholder can have a different name if you prefer something else. The placeholder name is defined in the "query-input" attribute. So if you want to use "{placeholder_search_term}", you need to define this in the "query-input" attribute like so: "required name=placeholder_search_term". 

## Conclusion
There are many more structured data types that might be interesting for you to use on your website. You could add products, events, fact checks, and even recipes with ingredients. You can have a look at the [full list of structured data types](https://developers.google.com/search/docs/data-types/article) to pick and choose which ones are relevant for your website. 

Google does a lot of assumptions to display your website in the search results, but you can help Google to improve the presentation of your website. You can add structured data to your HTML pages to define things such as article information, breadcrumbs, FAQs, a logo, and even which actions visitors can take on your website. This will help Google to understand what your website and individual pages are all about and how your website is structured. Over time this could have a positive effect on your SEO rankings and all you had to do was help Google to understand your website better. 

If you have any questions about this post, you can read out to me on [Twitter](https://twitter.com/RJElsinga) and I'll do my best to guide you to implement structured data on your website.