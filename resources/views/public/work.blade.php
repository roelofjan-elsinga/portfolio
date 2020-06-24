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
            <div class="grid md:grid-cols-2 gap-4">

                @foreach($works as $project)

                    @include('blocks.project_block', ['project' => $project])

                @endforeach

            </div>
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
