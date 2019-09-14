@extends('public')

@section('content')
    <div class="section min-h-full sm:min-h-0 sm:h-3/4 flex flex-col justify-center text-blue-darkest border-blue-darkest">
        <h1 class="font-bold text-4xl sm:text-5xl md:text-6xl mb-12">Hello, I'm Roelof Jan. <br/> Full-stack web developer <br /> & Scrum master</h1>
        <p class="text-lg sm:text-xl leading-loose">
            I love building products people can't wait to interact with. <br/>
            I get my motivation from building for and with actual users, <br />
            finding their likes and dislikes, and constantly improving. <br />
            I can help you with developing web applications.
        </p>

        <p>
            <a href="mailto:roelofjanelsinga@gmail.com?subject=Hi%20Roelof Jan!"
               class="text-xl font-bold pt-8 link link--underline inline-block">roelofjanelsinga@gmail.com</a>
        </p>
    </div> 

    <div class="section" id="work">

        {!! Block::get('work') !!}

        <div class="mt-12">

            @foreach($works->chunk(2) as $items)

                <div class="items block md:flex -mx-2">

                    @foreach($items as $project)

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

        <a href="{{ route('public.work') }}"
           class="text-xl font-bold pt-8 link link--underline inline-block">View more projects</a>
    </div>

    <div class="section">
        <div class="items paragraph-spacing my-32 text-lg bg-blue-darkest text-white rounded p-4">

            {!! Block::get('my_tech_stack') !!}

        </div>
    </div>

    <section class="section mt-32 articles">

        {!! Block::get('articles_homepage') !!}

        <div class="mt-12">
            @foreach($blog_posts as $article)

                <article>
                    <div class="image">
                        <img src="{{asset($article->thumbnail)}}" />
                    </div>

                    <div class="content pt-8">
                        <h3 class="pt-4 sm:pt-0">
                            {{$article->title}}
                        </h3>

                        <span class="muted">Posted on: {!! $article->postDate !!}</span>
                    </div>

                    <a href="{{!is_null($article->url()) ? $article->url : route('articles.view', $article->slug)}}" {{isset($article->url) ? "target='_blank'" : ''}} class="desktop-link"></a>
                </article>

            @endforeach
        </div>

        <a href="{{ route('articles.index') }}"
           class="text-xl font-bold pt-8 link link--underline inline-block">View more blog posts</a>

    </section>

    <section class="section mt-32">

        {!! Block::get('open_source_contributions') !!}

        <div class="mt-12">

            @foreach($projects->chunk(2) as $items)

                <div class="items block md:flex -mx-2">

                    @foreach($items as $project)

                        <div class="flex-1 border p-4 m-2 rounded shadow flex flex-col">
                            <h3>{{$project['name']}}</h3>

                            <p class="mb-4 mt-2 flex-auto">{{$project['description']}}</p>

                            <a href="{{$project['github_url']}}" target="_blank" class="text-blue-darkest font-bold pb-2 no-underline">View project</a>
                        </div>

                    @endforeach

                </div>

            @endforeach

        </div>

        <a href="{{ route('public.open_source') }}"
           class="text-xl font-bold pt-8 link link--underline inline-block">View more open source contributions</a>
    </section>

    <div class="section">
        <div class="items paragraph-spacing my-32 text-lg bg-blue-darkest text-white rounded p-4">

            {!! Block::get('site_techniques') !!}

        </div>
    </div>

    <div class="section social" id="social">

        <div class="items paragraph-spacing my-32 text-xl">

            {!! Block::get('social') !!}

            {!! Block::get('social_links') !!}
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
