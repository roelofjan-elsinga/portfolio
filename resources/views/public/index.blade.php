@extends('public')

@section('content')
    <div class="cd-fixed-bg cd-bg-1 section" id="home">
        <div class="color-overlay overlay-1">
            <div class="bg-txt-home">
                <h1>Hello, I'm Roelof</h1>
                <p>
                    Follow me on <a href="https://twitter.com/RJElsinga" target="_blank">Twitter</a> and
                    <a href="https://medium.com/@roelofjanelsinga" target="_blank">Medium</a>
                </p>
            </div>
        </div>
    </div> 

    <div class="cd-scrolling-bg cd-color-1 section" id="work">
        <div class="cd-container work-panel">
            <h2>{{ $work->title }}</h2>
            <p>{!! $work->content !!}</p>
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
                                            <img src="{{ asset('images/work/'.$work->image_large)  }}" class="img-responsive" alt="{{ $work->title }}">
                                        </div>
                                    @else
                                        <div class="col-xs-6">
                                            <img src="{{ asset('images/work/'.$work->image_large)  }}" class="img-responsive" alt="{{ $work->title }}">
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
                @if($worksCount > 4)
                    <div class="col-md-12">
                        <a href="{{ route('public.work') }}" class="more-link">Click here for all my work ({{ $worksCount - 4 }} item{{$worksCount - 4 > 1 ? 's' : ''}} not displayed here)</a>
                    </div>
                @endif
            </div>
        </div> 
    </div>

    <div class="cd-fixed-bg cd-bg-2 section" id="blog">
        <div class="color-overlay overlay-1">
            <div class="bg-txt-home">
                <div id="services-intro">
                    <h2>{{ $service->title }}</h2>
                    {!! $service->content !!}
                </div>
                @if($services != null)
                    @foreach($services as $serv)
                        <div class="section">
                            <span style="font-size:48px;"><i class="fa fa-{{ $serv->icon }} hidden-xs"></i></span>
                            <h3 style="margin-top:5px;" class="section-header">{{ $serv->title }}</h3>
                            {!! $serv->content !!}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div> 

    <div class="cd-scrolling-bg cd-color-1 section" id="about">
        <div class="cd-container about-panel">
            <h2>{{ $about->title }}</h2>

            <img src="{{ asset('images/image_bw.png') }}" alt="profile_picture">

            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        {!! $about->content !!}
                    </div>
                </div>
            </div>
        </div> 
    </div> 

    <div class="cd-fixed-bg cd-bg-2 section" id="contact">
        <div class="color-overlay overlay-1">
            <div class="bg-txt">
                <h2>{{ $contact->title }}</h2>
                <p>{!! $contact->content !!}</p>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['route' => 'contact', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                <div class="form-group">
                                    {!! Form::label('name', 'Name', ['class' => 'col-sm-2']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('email', 'Email', ['class' => 'col-sm-2']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => 'required']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('message', 'Message', ['class' => 'col-sm-2']) !!}
                                    <div class="col-md-10">
                                        {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Type your message here...', 'required' => 'required', 'rows' => 3]) !!}
                                    </div>
                                </div>
								<div class="form-group">
                                    {!! Form::label('validation', 'Validation', ['class' => 'col-sm-2']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('validation', null, ['class' => 'form-control', 'placeholder' => 'Type any 3 numbers', 'required' => 'required', 'max-length' => 3]) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('Send', ['class' => 'btn btn-info pull-right']) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cd-scrolling-bg cd-color-1 section" id="footer">
        <div class="cd-container">
            <h2>{{ $footer->title }}</h2>
            <p>{!! $footer->content !!}</p>
        </div>
    </div>
@endsection