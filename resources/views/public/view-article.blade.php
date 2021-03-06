@extends('public')

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')
    <div class="articles-page py-8 sm:py-0 max-w-md mx-auto" id="top">

        @include('blocks.breadcrumbs', ['pages' => [['url' => route('articles'), 'title' => 'Blog'], ['url' => request()->url(), 'title' => $article->title()]]])

        <main class="view-article paragraph-spacing">

            <article>

                {!! $article->body() !!}

                <span class="text-sm text-gray-600">{{__('article.posted_on')}}: {!! $article->getPostDate()->format('F jS, Y') !!}</span>

            </article>

        </main>
    </div>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "https://google.com/article"
      },
      "dateModified": "{{!is_null($article->getUpdateDate()) ? $article->getUpdateDate()->toIso8601String() : $article->getPostDate()->toIso8601String()}}",
      "datePublished": "{{$article->getPostDate()->toIso8601String()}}",
      "headline": "{{$article->title()}}",
      "author": {
        "@type": "Person",
        "name": "Roelof Jan Elsinga"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Roelof Jan Elsinga",
        "logo": {
          "@type": "ImageObject",
          "url": "{{url('/images/icons/favicon-96x96.png')}}",
          "height": 96,
          "width": 96
        }
      },
      "image": [
        "{{url($article->image())}}"
      ],
      "description": "{{$page->description}}"
    }
    </script>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Roelof Jan Elsinga",
        "item": "{{route('home')}}"
      },
      {
        "@type": "ListItem",
        "position": 2,
        "name": "{{'Articles'}}",
        "item": "{{route('articles')}}"
      },
      {
        "@type": "ListItem",
        "position": 3,
        "name": "{{$article->title()}}",
        "item": "{{request()->url()}}"
      }]
    }
    </script>

@endsection

@push('styles')
    <script data-ad-client="ca-pub-6555141565377417" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <link rel="preload" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.0/styles/default.min.css" as="style">
    <link rel="preload" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.0/highlight.min.js" as="script">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.0/highlight.min.js"></script>
    <script>
        window.hljs.initHighlightingOnLoad()
    </script>
@endpush