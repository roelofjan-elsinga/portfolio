@extends('public')

@section('content')
    <div class="cd-fixed-bg cd-bg-1 section" id="home">
        <div class="color-overlay overlay-1">
            <div class="bg-txt-home">
                <h1>{{ $home->title }}</h1>
                <h2>{!! $home->content !!}</h2>
            </div>
        </div>
    </div> 

    <div class="cd-scrolling-bg cd-color-1 section" id="work">
        <div class="cd-container work-panel">
            <h2>{{ $work->title }}</h2>
            <p>{!! $work->content !!}</p>
            <div class="row">
                @if(count($works) > 0)
                    @foreach($works->take(4) as $work)
                        <div class="col-sm-6 col-md-3 element work">
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
                @if(count($works) > 4)
                    <div class="col-md-12">
                        <a href="{{ route('public.work') }}">Click here for all my work ({{ count($works) - 4 }} item{{(count($works) - 4) > 1 ? 's' : ''}} not displayed here)</a>
                    </div>
                @endif
            </div>
        </div> 
    </div>

    <div class="cd-fixed-bg cd-bg-2 section" id="services">
        <div class="color-overlay overlay-1">
            <div class="bg-txt-services">
                <div id="services-intro">
                    <h2>{{ $service->title }}</h2>
                    {!! $service->content !!}
                </div>
                @if($services != null)
                    @foreach($services as $serv)
                        <div class="col-md-4">
                            <div class="section">
                                <span style="font-size:48px;"><i class="fa fa-{{ $serv->icon }} hidden-xs"></i></span>
                                <h3 style="margin-top:5px;" class="section-header">{{ $serv->title }}</h3>
                                {!! $serv->content !!}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div> 

    <div class="cd-scrolling-bg cd-color-1 section" id="about">
        <div class="cd-container about-panel">
            <h2>{{ $about->title }}</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        {!! $about->content !!}
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('images/about.jpg') }}" alt="profile_picture" class="img-circle img-responsive">
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