@extends('public')

@section('navigation')
    @include('blocks.navigation', ['is_external' => true])
@endsection

@section('content')
    <div class="articles-page items pt-8">

        <div class="paragraph-spacing">
            {!! Block::get('articles') !!}
        </div>

        <main class="articles my-8">

            @foreach($articles as $article)

                @include('blocks.article_preview', ['article' => $article])

            @endforeach

            {!! $articles->links() !!}

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
        "name": "Blog",
        "item": "{{route(Route::currentRouteName())}}"
      }]
    }
    </script>
@endsection