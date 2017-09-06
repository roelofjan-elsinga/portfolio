@extends('dashboard')

@section('content')
    @if(!isset($work))
        {!! Form::open(['route' => 'work.store', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
    @else
        {!! Form::model($work, ['route' => ['work.update', $work->id], 'method' => 'put', 'class' => 'form-horizontal', 'files' => true]) !!}
    @endif

    <h3>{{ isset($work) ? 'Edit' : 'Create' }} a portfolio item</h3>

    <div class="form-group">
        {!! Form::label('title', 'Title', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-11">
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('slug', 'Slug', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-11">
            {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('summary', 'Summary', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-11">
            {!! Form::text('summary', null, ['class' => 'form-control', 'placeholder' => 'Summary', 'maxlength' => 160]) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            {!! Form::textarea('content', null, ['class' => 'ckeditor', 'placeholder' => 'Content']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('link', 'URL', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-11">
            @if(isset($work))
            {!! Form::text('link', str_replace('http://', '', $work->link), ['class' => 'form-control', 'placeholder' => 'URL']) !!}
            @else
                {!! Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'URL']) !!}
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Browse {!! Form::input('file', 'image', null) !!}
                    </span>
                </span>
                <input type="text" class="form-control" readonly="" id="work-upload">
            </div>
        </div>
    </div>

    @if(isset($work))
        @if($work->image_large != null)
            <div class="form-group">
                <div class="col-md-3">
                    <img src="{{ asset('images/work/'.$work->image_large) }}" class="img-responsive"/>
                </div>
            </div>
        @endif
    @endif

    <div class="form-group">
        <div class="col-md-12">
            {!! Form::submit('Save', ['class' => 'btn btn-info pull-right']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection