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

            <div class="grid md:grid-cols-2 gap-4">

                @foreach($works as $project)

                    @include('blocks.project_block', ['project' => $project])

                @endforeach

            </div>

        </div>

        <div class="flex justify-center mt-8">
            <a href="{{ route('public.work') }}"
               class="text-lg sm:text-xl inline-block bg-theme-dark text-white p-4 rounded hover:bg-blue-700 duration-300">
                View more projects
            </a>
        </div>

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
            <div class="items block grid md:grid-cols-2 md:gap-4 -mx-2">

                @foreach($blog_posts as $article)

                    @include('blocks.article_preview', ['article' => $article])

                @endforeach

            </div>
        </div>

        <div class="flex justify-center mt-8">
            <a href="{{ route('articles') }}"
               class="text-lg sm:text-xl inline-block bg-theme-dark text-white p-4 rounded hover:bg-blue-700 duration-300">
                View more blog posts
            </a>
        </div>

    </section>

    <section class="mt-32">

        {!! Block::get('open_source_contributions') !!}

        <div class="mt-12">

            <div class="grid md:grid-cols-2 md:grid-rows-2 gap-4">

                @foreach($projects as $project)

                    @include('blocks.open_source_block', ['project' => $project])

                @endforeach

            </div>

        </div>

        <div class="flex justify-center mt-8">
            <a href="{{ route('public.open_source') }}"
               class="text-lg sm:text-xl inline-block bg-theme-dark text-white p-4 rounded hover:bg-blue-700 duration-300">
                View more open source contributions
            </a>
        </div>
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