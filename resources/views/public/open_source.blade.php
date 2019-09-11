@extends('public')

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')
    <div class="section paragraph-spacing">

        {!! Block::get('open_source_page') !!}

        <div class="mt-12">

            @foreach($projects->chunk(2) as $items)

                <div class="items block md:flex -mx-4">

                    @foreach($items as $project)

                        <div class="flex-1 border p-4 m-4 rounded shadow flex flex-col">
                            <h3>{{$project['name']}}</h3>

                            <p class="mb-4 mt-2 flex-auto">{{$project['description']}}</p>

                            <a href="{{$project['github_url']}}" target="_blank" class="text-blue-darkest font-bold pb-2 no-underline">View project</a>
                        </div>

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
        "name": "Open source contributions",
        "item": "{{route('public.open_source')}}"
      }]
    }
    </script>
@endsection

@section('footer')

    @include('blocks.mailchimp_form')

    @include('blocks.navigation', ['is_external' => true])

@endsection
