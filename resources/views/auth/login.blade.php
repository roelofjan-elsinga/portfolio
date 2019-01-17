@extends('public')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (isset($activated))
        <div class="alert alert-success">
            <strong>Success!</strong> Your account as been activated and you can now log in
        </div>
    @endif

    {!! Form::open(['route' => 'auth.postLogin', 'method' => 'post', 'class' => 'form-signin', 'id' => 'login']) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'Email address', 'autofocus', 'required' => 'required']) !!}
    {!! Form::input('password', 'password', null, ['class' => 'form-control', 'id' => 'inputPassword', 'placeholder' => 'Password', 'required' => 'required']) !!}
    <div class="checkbox">
        <label>
            {!! Form::checkbox('remember') !!} Keep me logged in
        </label>
    </div>

    {!! Form::submit('Log in', ['class' => 'btn btn-lg btn-property-primary btn-block']) !!}

    {!! Form::close() !!}
@endsection