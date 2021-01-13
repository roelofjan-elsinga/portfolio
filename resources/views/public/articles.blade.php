@extends('public')

@section('navigation')
    @include('blocks.navigation', ['is_external' => true])
@endsection

@section('content')
    <div class="articles-page items pt-8 mx-auto flex flex-col md:flex-row md:space-x-4">

        <main class="articles mb-8 max-w-md">

            @include('blocks.breadcrumbs', ['pages' => [['url' => route('articles'), 'title' => 'Blog']]])

            <div class="paragraph-spacing mb-8">
                {!! Block::get('articles') !!}
            </div>

            @foreach($articles as $article)

                @include('blocks.article_preview', ['article' => $article])

            @endforeach

            {!! $articles->links('public.pagination') !!}

        </main>

        <aside class="flex-1">
            <div class="bg-theme-lightest rounded p-8 sticky" style="top: 16px;">
                <h3 class="mb-4">Tags</h3>

                <ul class="list-none -ml-0">
                    @foreach($tags as $tag)
                        <li class="mb-2">
                            <a href="{{route('articles.tags', $tag->get("name"))}}">
                                {{$tag->get("name")}} ({{count($tag->get("articles"))}})
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>
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

@push('styles')
    <script data-ad-client="ca-pub-6555141565377417" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endpush