@extends('public')

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')
    <div class="section paragraph-spacing">

        {!! $content !!}

        <div class="items mt-12">
            @foreach($works->chunk(2) as $projects)

                <div class="items block md:flex -mx-2">

                    @foreach($projects as $project)

                        <div class="flex-1 border p-4 m-2 rounded shadow flex flex-col">
                            <img src="{{$project['image']['url']}}" alt="{{$project['image']['url']}}" />

                            <h3>{{$project['title']}}</h3>

                            <p class="mb-4 mt-2 flex-auto">{{$project['description']}}</p>

                            <a href="{{$project['url']}}" class="text-blue-darkest font-bold pb-2 no-underline">View project</a>
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
        "name": "My previous projects",
        "item": "{{route('public.work')}}"
      }]
    }
    </script>
@endsection

@section('footer')

    @include('blocks.mailchimp_form')

    @include('blocks.navigation', ['is_external' => true])

@endsection
