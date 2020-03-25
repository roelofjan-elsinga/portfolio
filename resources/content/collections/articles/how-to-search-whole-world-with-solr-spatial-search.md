---
update_date: '2019-03-13 07:26:00'
description: 'When using a Polygon or MultiPolygon for searching on a SpatialField with IsWithin(), you can''t use a square shape unless it''s counter-clockwise.'
is_scheduled: false
is_published: true
post_date: '2019-02-26'
url: how-to-search-whole-world-with-solr-spatial-search
---
![Solr logo](/images/articles/solr_logo.png)

# How to search "the whole world" with Solr Spatial Search

As it turns out, when using a **Polygon** or **MultiPolygon** for searching on a SpatialField 
with IsWithin(), you can't use a square shape. Unless you use it in a 
counter-clockwise manner, which didn't work for me. According to the WKT standards, 
a square is not a valid shape, so to solve this problem, 
simply add two points in the middle of the longitude line.

My initial solution was a self-closing shape that only had its four corners defined. 
But this either returned errors or gave me no results. This means that
```
MULTIPOLYGON(
    (
        (
            179 85.05112877980659, 
            179 -85.05112877980659, 
            -179 -85.05112877980659, 
            -179 85.05112877980659, 
            179 85.05112877980659
        )
    )
)
```
which is a self-closing square, gives an error. When using values like 175 and -175, 
which are not good enough for my case, you don't get an error, 
but I simply didn't get any search results.

But (notice the two extra points: 0 -85.05112877980659 and 0 85.05112877980659)
```
MULTIPOLYGON(
    (
        (
            179 85.05112877980659, 
            179 -85.05112877980659, 
            0 -85.05112877980659, 
            -179 -85.05112877980659, 
            -179 85.05112877980659, 
            0 85.05112877980659, 
            179 85.05112877980659
        )
    )
)
```
is completely valid and will get you the results you want.

*The reason I'm not using -180 to 180 and -90 to 90 is that the values I used are 
the maximum values Google uses for its maps. I use Google maps as an input for 
saving Polygons and MultiPolygons, 
so there is no point in going past those maximum values.*

I wasted three hours on this, so you don't have to! Let me know on 
[Twitter](https://twitter.com/RJElsinga) if you've ever been stuck on a bug 
like this that seems easy, but you end up spending hours on it anyway!

