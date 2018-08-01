@extends('public')

@section('navigation')
    @include('blocks.altnav')
@endsection

@section('content')
    <div class="container" style="padding-top:75px;">
        <div class="row">
            <div class="work-panel">
                <div class="items">
                    @foreach($works as $index => $work)

                        <div class="col-md-6 element work">
                            {!! $work['text'] !!}
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection