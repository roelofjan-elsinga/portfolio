@extends('dashboard')

@section('content')
    @if(!isset($service))
        {!! Form::open(['route' => 'service.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
    @else
        {!! Form::model($service, ['route' => ['service.update', $service->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
    @endif

    <h3>{{ isset($service) ? 'Edit' : 'Create' }} a service</h3>

    <div class="form-group">
        {!! Form::label('title', 'Title', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-11">
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('icon', 'Icon', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-11">
            {!! Form::text('icon', null, ['class' => 'form-control', 'placeholder' => 'Icon']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            {!! Form::textarea('content', null, ['class' => 'ckeditor', 'placeholder' => 'Content']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            {!! Form::submit('Save', ['class' => 'btn btn-info pull-right']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection