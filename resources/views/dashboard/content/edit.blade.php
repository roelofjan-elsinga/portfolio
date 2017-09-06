@extends('dashboard')

@section('content')
    {!! Form::model($page, ['route' => ['page.update', $page->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
    <h3>{{ $page->title }}</h3>
    <div class="form-group">
        {!! Form::label('title', 'Title', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-11">
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            {!! Form::textarea('content', null, ['class' => 'ckeditor', 'placeholder' => 'Content']) !!}
        </div>
    </div>

    {!! Form::submit('Save', ['class' => 'btn btn-info pull-right']) !!}
    {!! Form::close() !!}
@endsection