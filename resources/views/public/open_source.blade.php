@extends('public')

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')
    <div class="section">

        @include('blocks.breadcrumbs', ['pages' => [['url' => route('public.open_source'), 'title' => 'Open source contributions']]])

        <div class="paragraph-spacing mb-4">
            {!! Block::get('open_source_page') !!}
        </div>

        @foreach($projects->chunk(2) as $items)

            <div class="items block md:flex -mx-2">

                @foreach($items as $project)

                    @include('blocks.open_source_block', ['project' => $project])

                @endforeach

            </div>

        @endforeach

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
        "name": "Open source contributions",
        "item": "{{route('public.open_source')}}"
      }]
    }
    </script>
@endsection