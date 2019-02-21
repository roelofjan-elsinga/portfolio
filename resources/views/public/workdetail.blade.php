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

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')
    <div class="section paragraph-spacing py-8 sm:py-0">

        {!! $work !!}

    </div>
@endsection

@section('footer')

    @include('blocks.mailchimp_form')

    @include('blocks.navigation', ['is_external' => true])

@endsection
