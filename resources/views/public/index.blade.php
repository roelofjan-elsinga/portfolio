@extends('public')

@section('content')
    <div class="section h-full sm:h-3/4 flex flex-col justify-center text-blue-darkest border-blue-darkest">
        <h1 class="font-bold text-4xl sm:text-6xl mb-12">Hello, I'm Roelof Jan. <br/> Full-stack web developer <br /> & Scrum master</h1>
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

        {!! $work !!}

        <div class="items mt-12">
            @foreach($works as $index => $project)

                <div class="col-md-3 element work">
                    <div class="work-item">
                        <img src="{{$project['image']['url']}}" alt="{{$project['image']['url']}}" />

                        <h3>{{$project['title']}}</h3>

                        <p class="mb-4">{{$project['description']}}</p>

                        <a href="{{$project['url']}}" class="link">Read more</a>
                    </div>
                </div>

            @endforeach
        </div>

        <a href="{{ route('public.work') }}"
           class="text-xl font-bold pt-8 link link--underline inline-block">Click here for all my work</a>

        <div class="items paragraph-spacing my-32 text-xl">

            {!! $site_techniques !!}

        </div>
    </div>

    <div class="section social" id="social">

        <div class="items paragraph-spacing my-32 text-xl">

            {!! $social !!}

            <p class="mt-8">
                Email address
                <a href="mailto:roelofjanelsinga@gmail.com?subject=Hi%20Roelof Jan!"
                   class="link link--underline">roelofjanelsinga@gmail.com</a>
            </p>

            <p>
                Twitter
                <a href="https://twitter.com/RJElsinga"
                   class="link link--underline" target="_blank">RJElsinga</a>
            </p>

            <p>
                Medium
                <a href="https://medium.com/@roelofjanelsinga"
                   class="link link--underline" target="_blank">@roelofjanelsinga</a>
            </p>

            <p>
                Github
                <a href="https://github.com/roelofjan-elsinga"
                   class="link link--underline" target="_blank">roelofjan-elsinga</a>
            </p>

            <p>
                LinkedIn
                <a href="https://www.linkedin.com/in/roelofjanelsinga/"
                   class="link link--underline" target="_blank">roelofjanelsinga</a>
            </p>
        </div>

    </div>
@endsection
