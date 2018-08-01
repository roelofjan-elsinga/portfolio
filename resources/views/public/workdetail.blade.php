@extends('public')

@section('meta')
    <meta name="keywords" content="{{ $page->keywords }}">
    <meta name="description" content="{{ $page->description }}">
    <meta name="author" content="{{ $page->author }}">

    <link rel="author" href="https://plus.google.com/u/0/+RoelofJanElsinga"/>

    <meta property="og:title" content="{{ $title }} | Roelof Jan Elsinga"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ Request::url() }}"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ Request::url() }}">
    <meta name="twitter:title" content="{{ $title }} | Roelof Jan Elsinga">

    <title>{{ $title }} | Roelof Jan Elsinga</title>
@endsection

@section('navigation')
    @include('blocks.altnav')
@endsection

@section('content')
    <div class="container" style="padding-top:75px;">
        <div class="row">
            {!! $work !!}
        </div>
    </div>
@endsection