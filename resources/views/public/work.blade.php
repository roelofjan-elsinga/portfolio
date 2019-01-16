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
                        {!! $project['text'] !!}
                    </div>
                </div>

            @endforeach
        </div>

    </div>
@endsection

@section('footer')

    @include('blocks.navigation', ['is_external' => true])

@endsection