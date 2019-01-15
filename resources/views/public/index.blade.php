@extends('public')

@section('content')
    <div class="section h-3/4 flex flex-col justify-center text-blue-darkest border-blue-darkest" id="home">
        <h1 class="font-bold text-6xl mb-12">Hello, I'm Roelof Jan. <br/> Full-stack web developer <br /> & Scrum master</h1>
        <p class="text-xl leading-loose">
            I love building products people can't wait to interact with. <br/>
            I get my motivation from building for and with actual users, <br />
            finding their likes and dislikes, and constantly improving. <br />
            I can help you with developing & designing the platform.
        </p>

        <p>
            <a href="mailto:roelofjanelsinga@gmail.com?subject=Hi%20Roelof Jan!"
               class="text-xl font-bold pt-8 link link--underline inline-block">roelofjanelsinga@gmail.com</a>
        </p>
    </div> 

    <div class="section text-center" id="work">

        {!! $work !!}

        <div class="items">
            @foreach($works as $index => $project)

                <div class="col-md-3 element work">
                    <div class="work-item">
                        {!! $project['text'] !!}
                    </div>
                </div>

            @endforeach
        </div>

        <a href="{{ route('public.work') }}" class="more-link">Click here for all my work</a>
    </div>

    <div class="section about" id="about">
        <div class="about-me-block">
            <div class="image-block">
                <img src="{{asset('images/image_bw.jpg')}}" alt="Roelof Jan Elsinga" title="This is me">
            </div>

            <div class="about-me-content">
                {!! $about !!}
            </div>
        </div>
    </div>

    <div class="section social" id="blog">

        <div class="row">
            <div class="col-md-12">
                {!! $social !!}
            </div>
        </div>

        <div class="row">

            <div class="col-xs-3">
                <a href="https://twitter.com/RJElsinga" class="twitter">
                    <span class="fa fa-twitter fa-4x"></span>
                </a>
            </div>
            <div class="col-xs-3">
                <a href="https://medium.com/@roelofjanelsinga" class="medium">
                    <span class="fa fa-medium fa-4x"></span>
                </a>
            </div>
            <div class="col-xs-3">
                <a href="https://github.com/roelofjan-elsinga" class="github">
                    <span class="fa fa-github fa-4x"></span>
                </a>
            </div>
            <div class="col-xs-3">
                <a href="https://www.linkedin.com/in/roelofjanelsinga/" class="linkedin">
                    <span class="fa fa-linkedin fa-4x"></span>
                </a>
            </div>


        </div>

    </div>

    <div class="section" id="contact">
        <h2>Let’s work together on your next project.</h2>

        <p>
            <a href="mailto:roelofjanelsinga@gmail.com?subject=Hi%20Roelof Jan!"
               class="link link--underline">roelofjanelsinga@gmail.com</a>
        </p>
    </div>
@endsection