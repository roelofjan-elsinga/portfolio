@extends('public')

@section('meta')
    <meta name="keywords" content="{{ $page->keywords }}">
    <meta name="description" content="{{ $page->description }}">
    <meta name="author" content="{{ $page->author }}">

    <link rel="author" href="https://plus.google.com/u/0/+RoelofJanElsinga"/>

    <meta property="og:title" content="{{ $title }} | Roelof Jan Elsinga"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ Request::url() }}"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ Request::url() }}">
    <meta name="twitter:title" content="{{ $title }} | Roelof Jan Elsinga">

    <title>{{ $title }} | Roelof Jan Elsinga</title>
@endsection

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')

    <div class="articles-page py-8 sm:py-0">

        <main class="view-article paragraph-spacing">

            <article>

                {!! $work !!}

            </article>

        </main>
    </div>

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
        "name": "My previous projects",
        "item": "{{route('public.work')}}"
      },
      {
        "@type": "ListItem",
        "position": 3,
        "name": "{{$title}}",
        "item": "{{Request::url()}}"
      }]
    }
    </script>
@endsection

@section('footer')

    @include('blocks.mailchimp_form')

    @include('blocks.navigation', ['is_external' => true])

@endsection
