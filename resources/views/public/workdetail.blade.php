@extends('public')

@section('meta')
    <meta name="keywords" content="{{ $page->keywords }}">
    <meta name="description" content="{{ $page->description }}">
    <meta name="author" content="{{ $page->author }}">

    <link rel="author" href="https://plus.google.com/u/0/+RoelofJanElsinga"/>

    <meta property="og:title" content="{{ $work->title }} | Roelof Jan Elsinga"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{ asset('images/meta/'.$work->image_small) }}"/>
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:description" content="{{ $work->summary }}"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ Request::url() }}">
    <meta name="twitter:title" content="{{ $work->title }} | Roelof Jan Elsinga">
    <meta name="twitter:description" content="{{ $work->summary }}">
    <meta name="twitter:image" content="{{ asset('images/meta/'.$work->image_large) }}">

    <title>{{ $work->title }} | Roelof Jan Elsinga</title>
@endsection

@section('navigation')
    @include('blocks.altnav')
@endsection

@section('content')
    <div class="container" style="padding-top:75px;">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $work->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="{{ asset('images/work/'.$work->image_full) }}" data-lightbox="{{ $work->title }}">
                    <img src="{{ asset('images/work/'.$work->image_full) }}" class="img-responsive img-thumbnail"/>
                </a>
            </div>
            <div class="col-md-6">
                {!! $work->content !!}
                <a href="{{ $work->link }}" class="btn btn-primary" target="_blank">View the website</a>
            </div>
        </div>
    </div>
@endsection