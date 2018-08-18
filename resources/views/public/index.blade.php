@extends('public')

@section('content')
    <div class="cd-fixed-bg cd-bg-1 section" id="home">
        <div class="color-overlay overlay-1">
            <div class="bg-txt-home">
                <h1>Hello, I'm Roelof</h1>
            </div>
        </div>
    </div> 

    <div class="cd-scrolling-bg cd-color-1 section" id="work">
        <div class="cd-container work-panel">
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

    <div class="section contact" id="contact">
        {!! $contact !!}
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
                    {!! Form::submit('Send', ['class' => 'btn btn-default pull-right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection