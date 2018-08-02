@extends('public')

@section('navigation')
    @include('blocks.altnav')
@endsection

@section('content')
    <div class="container work-page" style="padding-top:75px;">
        <div class="row">
            <div class="col-xs-12">
                {!! $content !!}
            </div>
        </div>

        <div class="row">
            @foreach($works as $index => $work)

                <div class="col-md-4">
                    <div class="element work">
                        {!! $work['text'] !!}
                    </div>
                </div>

            @endforeach
        </div>
    </div>
@endsection