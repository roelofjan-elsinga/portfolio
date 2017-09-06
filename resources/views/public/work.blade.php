@extends('public')

@section('navigation')
    @include('blocks.altnav')
@endsection

@section('content')
    <div class="container" style="padding-top:75px;">
        <div class="row">
            @if(count($works) > 0)
                @foreach($works as $work)
                    <div class="col-md-3 element work">
                        <a href="{{ route('public.workDetail', $work->slug) }}">
                            <div class="work-item">
                                <div class="work-image">
                                    <img src="{{ asset('images/work/'.$work->image_large)  }}" class="img" alt="{{ $work->title }}">
                                    <div class="work-info">
                                        <div class="work-title">
                                            <p>{{ $work->title }}</p>
                                        </div>
                                        <div class="work-summary">
                                            <p>{{ $work->summary }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection