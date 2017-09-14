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
                            <a href="{{ $work->link }}">
                                <div class="work-item">
                                    <div class="work-image row">
                                        @if($index % 2 == 0)
                                            <div class="work-info col-xs-6 uneven">
                                                <h3 class="work-title">{{ $work->title }}</h3>
                                                <div class="work-summary">
                                                    <p>{{ $work->summary }}</p>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <img src="{{ asset('images/work/'.$work->image_large)  }}"
                                                     class="img-responsive" alt="{{ $work->title }}">
                                            </div>
                                        @else
                                            <div class="col-xs-6">
                                                <img src="{{ asset('images/work/'.$work->image_large)  }}"
                                                     class="img-responsive" alt="{{ $work->title }}">
                                            </div>
                                            <div class="work-info col-xs-6 even">
                                                <h3 class="work-title">{{ $work->title }}</h3>
                                                <div class="work-summary">
                                                    <p>{{ $work->summary }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection