!["People working together"](/images/articles/people-working-together.jpeg)
<span class="caption">Applying patches to a package to make progress with your application.</span>
# Open source contributions (September 2019)
Last month I've created a blog post mentioning my open-source contributions for august 2019. I found this was a great way to keep track of everything I've learned that month, so I've decided to do the same for September. This month I've been working on 4 packages, 3 of which are completed and could be used by anyone, while one of them is still a proof of concept and is in very early stages.

## The completed packages
The packages below are completed and can be used in any project:

- [roelofjan-elsinga/url-language-extractor](https://github.com/roelofjan-elsinga/url-language-extractor)
- [roelofjan-elsinga/laravel-onesky \*](https://github.com/roelofjan-elsinga/laravel-onesky)
- [roelofjan-elsinga/solarium-luke \*](https://github.com/roelofjan-elsinga/solarium-luke)

The two packages with the asterisk (\*) are forked because the original repository seemed inactive and my proposed changes were required for progression in my projects. This was the first time I forked inactive packages and published them, with my proposed changes, under my own namespace. It was a very interesting experience because I was able to replace the following configuration:

```json
{
  "require": {
    "ageras/laravel-onesky": "dev-master#77e2de4a78bf2172df4129045c40350582aeabdb"
  },
  "repositories":[
    {
      "type": "vcs",
      "url": "https://github.com/roelofjan-elsinga/laravel-onesky"
    }
  ]
}
```

with this:

```json
{
  "require": {
    "roelofjan-elsinga/laravel-onesky": "^1.0"
  }
}
```

That really cleans up the composer.json file for the project.

## The early-stage package

The package below is still in the very early stages of development and shouldn't/can't be used for any project yet. The reason it's already available on GitHub is that I'm trying to formalize the way I'll be generating forms from JSON data. So if you have any thoughts on this, I'd love to hear it.

- [roelofjan-elsinga/flat-file-cms-forms](https://github.com/roelofjan-elsinga/flat-file-cms-forms)

Have you contributed to any open-source projects in September? I'd love to hear what you've been working on (and of course see the code), so let me know on [Twitter](https://twitter.com/RJElsinga).