@extends('public')

@section('navigation')
    @include('blocks.navigation', ['is_external' => true])
@endsection

@section('content')
    <div class="articles-page items pt-8 mx-auto flex flex-col md:flex-row md:space-x-4">

        <main class="articles mb-8 max-w-md mx-auto">

            @include('blocks.breadcrumbs', ['pages' => [['url' => route('articles.tags', $tag_name), 'title' => $page->title]]])

            <div class="paragraph-spacing mb-8">
                {!! Block::get('articles') !!}
            </div>

            @foreach($articles as $article)

                @include('blocks.article_preview', ['article' => $article])

            @endforeach

            <aside class="mt-8">
                <div class="bg-theme-lightest rounded p-8 sticky" style="top: 16px;">
                    <h3 class="mb-4">Tags</h3>

                    <a href="{{route('articles')}}" class="block my-4 underline">
                        Back to all blog posts
                    </a>

                    <ul class="list-none column-count-2 lg:column-count-3" style="margin-left:0;">
                        @foreach($tags as $tag)
                            @if(count($tag->get("articles")) > 0)
                                <li class="mb-2">
                                    <a href="{{route('articles.tags', $tag->get("name"))}}" class="hover:underline {{$tag->get("name") === $tag_name ? 'font-bold underline' : ''}}">
                                        {{$tag->get("name")}} ({{count($tag->get("articles"))}})
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </aside>

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
        "name": "{{$page->title}}",
        "item": "{{route('articles.tags', $tag_name)}}"
      }]
    }
    </script>
@endsection

@push('styles')
    <script data-ad-client="ca-pub-6555141565377417" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endpush