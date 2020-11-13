@extends('public')

@section('navigation')
    @include('blocks.navigation', ['is_external' => true])
@endsection

@section('content')
    <div class="articles-page items pt-8 max-w-md mx-auto">

        @include('blocks.breadcrumbs', ['pages' => [['url' => route('articles'), 'title' => 'Blog']]])

        <div class="paragraph-spacing">
            {!! Block::get('articles') !!}
        </div>

        <main class="articles my-8">

            <form action="{{route('articles')}}" method="get" class="block mb-8">
                <label for="q" class="font-bold mb-2 block">{{__('article.search_title')}}</label>

                <div class="flex rounded">
                    <input type="text"
                           class="bg-theme-lightest p-4 text-theme-darkest rounded-l flex-grow placeholder-theme-darkest placeholder-opacity-50"
                           placeholder="{{__('article.search_placeholder')}}" name="q" value="{{request()->has('q') ? request()->get('q') : ''}}">

                    <button type="submit"
                            class="text-lg sm:flex-xl hover:bg-theme-light inline-block bg-theme-lighter text-theme-darkest p-4 duration-300 font-bold rounded-r">
                        <span class="fas fa-search"></span>
                    </button>
                </div>

                @if(request()->has('q'))
                    <p class="mt-2">
                        You're currently searching for: <strong>{{request()->get('q')}}</strong>
                    </p>
                @endif
            </form>

            @foreach($articles as $article)

                @include('blocks.article_preview', ['article' => $article])

            @endforeach

            {!! $articles->links('public.pagination') !!}

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

@push('styles')
    <script data-ad-client="ca-pub-6555141565377417" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endpush