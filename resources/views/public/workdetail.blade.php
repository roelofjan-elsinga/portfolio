@extends('public')

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