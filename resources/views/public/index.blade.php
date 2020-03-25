@extends('public')

@section('content')
    <div class="section min-h-full sm:min-h-0 sm:h-3/4 flex flex-col justify-center text-blue-darkest border-blue-darkest">
        <h1 class="font-bold text-4xl sm:text-5xl md:text-6xl mb-12">Full-stack web developer <br /> & Scrum master</h1>
        <p class="text-lg sm:text-xl leading-loose">
            I specialize in: <br />
            ⚡ Building lighting fast web applications <br />
            🔒 Making them secure <br />
            🔥 And making them scalable
        </p>

        <p class="pt-8">
            <span class="text-lg sm:text-xl inline-block mb-4">Send me a message: </span> <a href="mailto:hello@roelofjanelsinga.com?subject=Hi%20Roelof Jan!"
               class="text-lg sm:text-xl font-bold link link--underline inline-block">hello@roelofjanelsinga.com</a>

            @include('blocks.contact_confirmation')
        </p>
    </div> 

    <div class="section" id="work">

        {!! Block::get('work') !!}

        <div class="mt-12">

            @foreach($works->chunk(2) as $items)

                <div class="items block md:flex -mx-2">

                    @foreach($items as $project)

                        <div class="flex-1 border p-4 m-2 rounded shadow flex flex-col">
                            <img src="{{$project->image_url}}" alt="{{$project->image_alt}}" />

                            <h3 class="pt-4">{{$project->title}}</h3>

                            <p class="mb-4 mt-2 flex-auto leading-loose">{{$project->description}}</p>

                            <a href="{{$project->url}}" class="text-blue-darkest font-bold pb-2 no-underline">View project</a>
                        </div>

                    @endforeach

                </div>

            @endforeach

        </div>

        <a href="{{ route('public.work') }}"
           class="text-xl font-bold pt-8 link link--underline inline-block">View more projects</a>
    </div>

    <div class="section view-article paragraph-spacing my-32 text-lg">
        {!! Block::get('about') !!}
    </div>

    <div class="section">
        <div class="items paragraph-spacing my-32 text-lg bg-theme-dark text-white rounded p-4">

            {!! Block::get('my_tech_stack') !!}

        </div>
    </div>

    <section class="section mt-32 articles">

        {!! Block::get('articles_homepage') !!}

        <div class="mt-12">
            @foreach($blog_posts as $article)

                @include('blocks.article_preview', ['article' => $article])

            @endforeach
        </div>

        <a href="{{ route('articles') }}"
           class="text-xl font-bold pt-8 link link--underline inline-block">View more blog posts</a>

    </section>

    <section class="section mt-32">

        {!! Block::get('open_source_contributions') !!}

        <div class="mt-12">

            @foreach($projects->chunk(2) as $items)

                <div class="items block md:flex -mx-2">

                    @foreach($items as $project)

                        <div class="flex-1 border p-4 m-2 rounded shadow flex flex-col">
                            <h3>{{$project->name}}</h3>

                            <p class="mb-4 mt-2 flex-auto leading-loose">{{$project->description}}</p>

                            <a href="{{$project->github_url}}" target="_blank" class="text-blue-darkest font-bold pb-2 no-underline">View project</a>
                        </div>

                    @endforeach

                </div>

            @endforeach

        </div>

        <a href="{{ route('public.open_source') }}"
           class="text-xl font-bold pt-8 link link--underline inline-block">View more open source contributions</a>
    </section>

    <div class="section">
        <div class="items paragraph-spacing my-32 text-lg bg-theme-dark text-white rounded p-4">

            {!! Block::get('site_techniques') !!}

        </div>
    </div>

    <div class="section social" id="social">

        <div class="items paragraph-spacing my-32 text-xl">

            {!! Block::get('social') !!}

            {!! Block::get('social_links') !!}

            <div class="mt-8">
                {!! Block::get('contact') !!}

                @include('blocks.contact_confirmation')

                @include('blocks.contact_form')
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
      }]
    }
    </script>
@endsection
