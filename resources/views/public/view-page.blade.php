@extends('public')

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')

    <div class="articles-page">

        @include('blocks.breadcrumbs', ['pages' => [['url' => request()->url(), 'title' => $page->title()]]])

        <main class="view-article paragraph-spacing">
            {!! $page->body() !!}
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
        "name": "{{$page->title()}}",
        "item": "{{request()->url()}}"
      }]
    }
    </script>

@endsection