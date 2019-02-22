@extends('public')

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')
    <div class="section paragraph-spacing">

        {!! $content !!}

        <div class="items mt-12">
            @foreach($works as $index => $project)

                <div class="element work">
                    <div class="work-item">
                        <img src="{{$project['image']['url']}}" alt="{{$project['image']['url']}}" />

                        <h3>{{$project['title']}}</h3>

                        <p class="mb-4">{{$project['description']}}</p>

                        <a href="{{$project['url']}}" class="link">Read more</a>
                    </div>
                </div>

            @endforeach
        </div>

    </div>
@endsection

@section('footer')

    @include('blocks.mailchimp_form')

    @include('blocks.navigation', ['is_external' => true])

@endsection
