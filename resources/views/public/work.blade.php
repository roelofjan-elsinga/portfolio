@extends('public')

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')
    <div class="section">

        @include('blocks.breadcrumbs', ['pages' => [['url' => route('public.work'), 'title' => 'Portfolio']]])

        <div class="paragraph-spacing mb-4">
            {!! Block::get('work-page') !!}
        </div>

        <div class="items">
            @foreach($works->chunk(2) as $items)

                <div class="items block md:flex -mx-2">

                    @foreach($items as $project)

                        @include('blocks.project_block', ['project' => $project])

                    @endforeach

                </div>

            @endforeach
        </div>

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
        "name": "Portfolio",
        "item": "{{route('public.work')}}"
      }]
    }
    </script>
@endsection
