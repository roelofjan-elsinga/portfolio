@extends('public')

@section('navigation')
    @include('blocks.navigation', ['is_external' => true])
@endsection

@section('content')
    <div class="articles-page items pt-8 max-w-md mx-auto">

        <div class="paragraph-spacing">
            {!! Block::get('articles') !!}
        </div>

        <main class="articles my-8">

            <form action="{{route('articles')}}" method="get" class="block mb-8">
                <label for="q" class="font-bold mb-2 block">What are your looking for?</label>

                <div class="flex rounded">
                    <input type="text" class="bg-gray-200 border-blue-darkest p-4 text-blue-800 rounded-l flex-grow"
                           placeholder="Search blog posts" name="q" value="{{request()->has('q') ? request()->get('q') : ''}}">

                    <button type="submit" class="bg-gray-400 text-black rounded-r duration-300 px-4">
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