!["How to generate a sitemap"](/images/articles/binoculars.jpeg)

# How to generate a sitemap
In a previous post, [SEO and personal marketing for developers](/articles/seo-and-personal-marketing-for-developers), I mentioned that you need to generate a sitemap in order to submit all the important pages from your website to the Google Search Console. But how do you generate a sitemap? What does it look like? These are the questions I'll answer in this post.

## An example of a sitemap file
Before I start, I'd like to show you an example of a sitemap file. It's really quite simple and it's easy to add new urls to it.

```xml
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://example.com/</loc>
        <lastmod>2019-01-01</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
</urlset>
```

That's it, that's all you need to do to create a sitemap. As you can see, an "urlset" element is wrapping everything. Then you have the "url" element. This element contains all information about a single URL, like **the URL (found in the loc element), the last modified date (lastmod), the page priority (priority), and the change frequency of the page (changefreq)**.

## Accepted values for the URL information
- **loc**: Any URL found on your website
- **priority**: A number between 0 and 1, 1 being the most important page, 0 being the least important.
- **lastmod**: any date in the "yyyy-mm-dd" format
- **changefreq**: yearly, monthly, weekly, daily, etc.

## Manually creating an XML file
After reading through the information in the previous two sections, 
you can get started creating your own sitemap. You can simply make this manually if you don't have a large number of pages you want to include in your sitemap. If you have a lot of pages, this could be a lot of work and you can use an automated service for this. If you have the opportunity to write a script to do this automatically for you in PHP, you can go to the next section. 

## Automatically creating an XML file
If you're using PHP for your website, you could make use of a package I've created for this specific use-case. You can find it on [Packagist](https://packagist.org/packages/roelofjan-elsinga/sitemap-generator) and install it with composer: 

```bash
composer require roelofjan-elsinga/sitemap-generator
```

You can incorporate that package in any script you might be using to create a sitemap. After you've added all of your links, you can save the generated XML to a sitemap.xml file that's accessible through the browser. 

## Where do you put the sitemap XML file?
The easiest location to place your generated sitemap is at *"yourwebsite.com/sitemap.xml"*. This is a very predictable place for it and you want to make it as simple as possible to index all of your URL's. After you've placed the sitemap file in the correct location, verify if you can access the file from the browser by going to *"yourwebsite.com/path/to/sitemap.xml"*. If you're seeing your URL's correct, you're ready to go to the next step. 

## Submitting the sitemap to Google Search Console
Now that you have a sitemap, you're ready for this last step. Submitting your sitemap to Google Search Console. This step is quite simple luckily. First, make sure you've set up Google Search Console for your website, you can find out how by reading ["SEO and personal marketing for developers"](/articles/seo-and-personal-marketing-for-developers). When you are in the search console, click on "Sitemaps" in the sidebar on the left. Here you can enter the URL of the sitemap. Mine would be *"roelofjanelsinga.com/sitemap.xml"*. My domain is already entered in the form, so all I have to fill out is sitemap.xml. That's it, Google can now find all of your pages and index them into the search systems. 

If you have any questions or any additions to this post, let me know on [Twitter](https://twitter.com/RJElsinga)! I'm happy to help you or make changes to this post if you caught a mistake or have some better information I can add.