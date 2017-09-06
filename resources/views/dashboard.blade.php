<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $pagetitle }} | Roelof Jan Elsinga</title>

    @section('stylesheets')
    <link href="{{ asset('css/darkly.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/sweet-alert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fileinput.min.css') }}">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @show

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@section('navigation')
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"><span class="glyphicon glyphicon-th-large"></span></button>
            <a class="navbar-brand" id="brand_btn">Dashboard</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar">
            <div class="nav navbar-nav">
                <li><a href="{{ route('work.index') }}">Work</a></li>
                <li><a href="{{ route('page.index') }}">Content</a></li>
                <li><a href="{{ route('service.index') }}">Services</a></li>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('home') }}">View Website</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('auth.getLogout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@show

<div class="container">
    @yield('content')
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/canvas-to-blob.min.js') }}"></script>
<script src="{{ asset('js/fileinput.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/grids.min.js') }}"></script>
<script src="{{ asset('js/sweet-alert.min.js') }}"></script>
<script src="{{ asset('js/roelof.js') }}"></script>
</body>
</html>