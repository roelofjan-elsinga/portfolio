@extends('public')

@section('content')
    <div class="h-3/4 flex flex-col justify-center text-theme-darkest border-theme-darkest">
        <h1 class="font-bold text-4xl sm:text-5xl md:text-6xl mb-12 leading-snug">Full-stack web developer <br /> & Scrum master</h1>

        <h4 class="text-xl mb-4">I specialize in</h4>
        <p class="text-lg sm:text-xl leading-loose">
            ⚡ Building lighting fast web applications <br />
            🔒 Making them secure <br />
            🔥 And making them scalable
        </p>

        <p class="pt-8">
            <a href="mailto:hello@roelofjanelsinga.com?subject=Hi%20Roelof Jan!"
               class="text-lg sm:text-xl inline-block bg-theme-dark text-white p-4 rounded hover:bg-blue-700 duration-300">
                <span class="fas fa-envelope"></span>
                Contact me
            </a>

            @include('blocks.contact_confirmation')
        </p>
    </div> 

    <div id="work">

        {!! Block::get('work') !!}

        <div class="mt-12">

            @foreach($works->chunk(2) as $items)

                <div class="items block md:flex -mx-2">

                    @foreach($items as $project)

                        @include('blocks.project_block', ['project' => $project])

                    @endforeach

                </div>

            @endforeach

        </div>

        <a href="{{ route('public.work') }}"
           class="text-xl font-bold pt-8 link link--underline inline-block">View more projects</a>
    </div>

    <div class="view-article paragraph-spacing my-32 text-lg">

        {!! Block::get('about') !!}

    </div>

    <div class="items paragraph-spacing my-32 text-lg bg-theme-dark text-white rounded p-4">

        {!! Block::get('my_tech_stack') !!}

    </div>

    <section class="mt-32 articles">

        {!! Block::get('articles_homepage') !!}

        <div class="mt-12">
            @foreach($blog_posts as $article)

                @include('blocks.article_preview', ['article' => $article])

            @endforeach
        </div>

        <a href="{{ route('articles') }}"
           class="text-xl font-bold pt-8 link link--underline inline-block">View more blog posts</a>

    </section>

    <section class="mt-32">

        {!! Block::get('open_source_contributions') !!}

        <div class="mt-12">

            @foreach($projects->chunk(2) as $items)

                <div class="items block md:flex -mx-2">

                    @foreach($items as $project)

                        @include('blocks.open_source_block', ['project' => $project])

                    @endforeach

                </div>

            @endforeach

        </div>

        <a href="{{ route('public.open_source') }}"
           class="text-xl font-bold pt-8 link link--underline inline-block">View more open source contributions</a>
    </section>

    <div class="items paragraph-spacing my-32 text-lg bg-theme-dark text-white rounded p-4">

        {!! Block::get('site_techniques') !!}

    </div>

    <div class="social" id="social">

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