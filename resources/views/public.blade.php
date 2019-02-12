<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @section('meta')
            <meta name="keywords" content="{{ $page->keywords }}">
            <meta name="description" content="{{ $page->description }}">
            <meta name="author" content="{{ $page->author }}">

            <link rel="author" href="https://plus.google.com/u/0/+RoelofJanElsinga"/>

            <meta property="og:title" content="{{ $page->title }}"/>
            <meta property="og:type" content="website"/>
            <meta property="og:image" content="{{ $page->image_small }}"/>
            <meta property="og:url" content="{{ Request::url() }}"/>
            <meta property="og:description" content="{{ $page->description }}"/>

            <meta name="twitter:card" content="summary_large_image">
            <meta name="twitter:url" content="{{ Request::url() }}">
            <meta name="twitter:title" content="{{ $page->title }} | Roelof Jan Elsinga">
            <meta name="twitter:description" content="{{ $page->description }}">
            <meta name="twitter:image" content="{{ $page->image_large  }}">

            <title>{{ $page->title }}</title>
		@show

        @if(\Main\Classes\Canonical::needsLink())
            <link rel="canonical" href="{{\Main\Classes\Canonical::getLink()}}" />
        @endif

		<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/icons/apple-icon-57x57.png') }}">
		<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/icons/apple-icon-60x60.png') }}">
		<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/icons/apple-icon-72x72.png') }}">
		<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/icons/apple-icon-76x76.png') }}">
		<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/icons/apple-icon-114x114.png') }}">
		<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/icons/apple-icon-120x120.png') }}">
		<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/icons/apple-icon-144x144.png') }}">
		<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/icons/apple-icon-152x152.png') }}">
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icons/apple-icon-180x180.png') }}">
		<link rel="icon" type="image/png" sizes="36x36"  href="{{ asset('images/icons/android-icon-36x36.png') }}">
		<link rel="icon" type="image/png" sizes="48x48"  href="{{ asset('images/icons/android-icon-48x48.png') }}">
		<link rel="icon" type="image/png" sizes="72x72"  href="{{ asset('images/icons/android-icon-72x72.png') }}">
		<link rel="icon" type="image/png" sizes="96x96"  href="{{ asset('images/icons/android-icon-96x96.png') }}">
		<link rel="icon" type="image/png" sizes="144x144"  href="{{ asset('images/icons/android-icon-144x144.png') }}">
		<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/icons/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icons/favicon-16x16.png') }}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/icons/favicon-32x32.png') }}">
		<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/icons/favicon-96x96.png') }}">
		<link rel="icon" href="{{ asset('images/icons/favicon.ico') }}">
		<link rel="manifest" href="{{ asset('images/icons/manifest.json') }}">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="{{ asset('images/icons/ms-icon-70x70.png') }}">
		<meta name="msapplication-TileImage" content="{{ asset('images/icons/ms-icon-144x144.png') }}">
		<meta name="msapplication-TileImage" content="{{ asset('images/icons/ms-icon-150x150.png') }}">
		<meta name="msapplication-TileImage" content="{{ asset('images/icons/ms-icon-310x310.png') }}">
		<meta name="theme-color" content="#ffffff">

        <!-- Bootstrap -->
        @section('stylesheets')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link href="{{ mix('css/front.css') }}" rel="stylesheet">
        @show

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="{{isset($customClass) ? $customClass : ''}} container mx-auto text-blue-darkest px-4 lg:px-0">

        @section('navigation')

            @include('blocks.navigation')

        @show

        @yield('content')

        @section('footer')

            @include('blocks.mailchimp_form')

            @include('blocks.navigation')

        @show

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            (function() {
                $('a').click(function () {
                    $('html, body').animate({
                        scrollTop: $($(this).attr('href')).offset().top
                    }, 500);
                    return false;
                });
            })();
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-49160339-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-49160339-1');
        </script>
    </body>
</html>
