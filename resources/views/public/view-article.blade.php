@extends('public')

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')
    <div class="articles-page py-8 sm:py-0">

        <main class="view-article paragraph-spacing">

            <article>

                {!! $article->content !!}

                <span class="text-sm text-grey-dark">Posted on: {!! $article->postDate !!}</span>

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
      "dateModified": "{{$article->rawUpdatedDate->toIso8601String()}}",
      "datePublished": "{{$article->rawPostDate->toIso8601String()}}",
      "headline": "{{$article->title}}",
      "author": {
        "@type": "Person",
        "name": "Roelof Jan Elsinga"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Roelof Jan Elsinga",
        "logo": {
          "@type": "ImageObject",
          "url": "{{url('/images/icons/favicon-96x96.png')}}"
        }
      },
      "image": [
        "{{url($article->image)}}"
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
        "name": "{{$is_article ? 'Articles' : 'Passions'}}",
        "item": "{{route($is_article ? 'articles' : 'passions.index')}}"
      },
      {
        "@type": "ListItem",
        "position": 3,
        "name": "{{$article->title}}",
        "item": "{{Request::url()}}"
      }]
    }
    </script>

@endsection

@section('footer')

    @include('blocks.mailchimp_form')

    @include('blocks.navigation', ['is_external' => true])

@endsection
