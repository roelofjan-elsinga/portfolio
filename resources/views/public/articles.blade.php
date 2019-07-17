@extends('public')

@section('navigation')
    @include('blocks.navigation', ['is_external' => true])
@endsection

@section('content')
    <div class="articles-page items paragraph-spacing pt-8 md:pt-0">

        {!! Block::get('articles') !!}

        <main class="articles my-8">

            @foreach($articles as $article)

                <article>
                    <div class="image">
                        <img src="{{asset($article->thumbnail)}}" />
                    </div>

                    <div class="content pt-8">
                        <h3 class="pt-4 sm:pt-0">
                            {{$article->title}}
                        </h3>

                        <span class="muted">Posted on: {!! $article->postDate !!}</span>
                    </div>

                    <a href="{{!is_null($article->url()) ? $article->url : route($view_route_name, $article->slug)}}" {{isset($article->url) ? "target='_blank'" : ''}} class="desktop-link"></a>
                </article>

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
        "name": "{{Route::currentRouteName() === 'articles' ? 'Articles' : 'Passions'}}",
        "item": "{{route(Route::currentRouteName())}}"
      }]
    }
    </script>
@endsection

@section('footer')

    @include('blocks.mailchimp_form')

    @include('blocks.navigation', ['is_external' => true])

@endsection
