<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @section('meta')
            <meta name="description" content="{{ $page->description ?? $page->description() }}">
            <meta name="author" content="{{ $page->author ?? $page->author() }}">

            <link rel="author" href="https://plus.google.com/u/0/+RoelofJanElsinga"/>

            <meta property="og:title" content="{{ $page->title ?? $page->title() }}"/>
            <meta property="og:type" content="website"/>
            <meta property="og:image" content="{{ $page->image_url ?? $page->thumbnail()}}"/>
            <meta property="og:url" content="{{ Request::url() }}"/>
            <meta property="og:description" content="{{ $page->description ?? $page->description() }}"/>

            <meta name="twitter:card" content="summary_large_image">
            <meta name="twitter:url" content="{{ Request::url() }}">
            <meta name="twitter:title" content="{{ $page->title ?? $page->title() }}">
            <meta name="twitter:description" content="{{ $page->description ?? $page->description() }}">
            <meta name="twitter:image" content="{{ $page->image_url ?? $page->image()  }}">

            @if((isset($page->canonical) && !is_null($page->canonical)))
                <link rel="canonical" href="{{$page->canonical}}" />
            @endif

            @if((method_exists($page, 'canonicalLink') && !is_null($page->canonicalLink())))
                <link rel="canonical" href="{{$page->canonicalLink()}}" />
            @endif

            <title>{{ $page->title ?? $page->title() }} - Roelof Jan Elsinga</title>
		@show

        <link rel="dns-prefetch" href="https://www.google-analytics.com">

        {{-- These are prev and next links for pagination --}}

        @if(isset($pagination_tags['prev']) && !is_null($pagination_tags['prev']))
            <link rel="prev" href="{{url($pagination_tags['prev'])}}" />
        @endif

        @if(isset($pagination_tags['next']) && !is_null($pagination_tags['next']))
            <link rel="next" href="{{url($pagination_tags['next'])}}" />
        @endif

        {{-- If there is pagination, display the canonical link --}}

        @if(isset($pagination_tags))
            <link rel="canonical" href="{{\Main\Classes\Canonical::getLink()}}" />
        @endif

        {{-- Display the canonical URL if necessary and if it's not already included --}}

        @if(!isset($pagination_tags))
            <link rel="canonical" href="{{\Main\Classes\Canonical::getLink()}}" />
        @endif

        <link rel="alternate" href="https://roelofjanelsinga.com{{request()->getPathInfo()}}" hreflang="en">
        <link rel="alternate" href="https://roelofjanelsinga.nl{{request()->getPathInfo()}}" hreflang="nl">
        <link rel="alternate" href="https://roelofjanelsinga.com{{request()->getPathInfo()}}" hreflang="x-default">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/icons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icons/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('images/icons/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('images/icons/safari-pinned-tab.svg') }}" color="#4fabfe">
        <link rel="shortcut icon" href="{{ asset('images/icons/favicon_sm.ico') }}">
        <meta name="msapplication-TileColor" content="#4fabfe">
        <meta name="msapplication-config" content="{{ asset('images/icons/browserconfig.xml') }}">
        <meta name="theme-color" content="#ffffff">

        <meta name="monetization" content="$ilp.uphold.com/e477riXGedj9">

        <link rel="preload" href="https://rsms.me/inter/font-files/Inter-roman.var.woff2?v=3.13" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin>

        <!-- Bootstrap -->
        @section('stylesheets')
            <link rel="preload" href="{{ mix('css/front.css') }}" as="style">
            <link href="{{ mix('css/front.css') }}" rel="stylesheet" defer>
        @show

        <link rel="preload" href="{{mix('css/fontawesome.css')}}" as="style">
        <link rel="stylesheet" href="{{mix('css/fontawesome.css')}}" />
        @stack('styles')

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-W8JVB6T');</script>
        <!-- End Google Tag Manager -->
    </head>
    <body class="{{isset($customClass) ? $customClass : ''}} text-theme-darkest">

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W8JVB6T"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        @section('navigation')

            @include('blocks.navigation')

        @show

        <div class="container mx-auto px-4 lg:px-0">
            @yield('content')
        </div>

        @section('footer')

            @include('blocks.mailchimp_form')

            @include('blocks.footer')

        @show

        @include('blocks.service_worker')

        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "url": "https://www.roelofjanelsinga.com",
          "logo": "{{asset('images/logo/logo_avatar.jpg')}}",
          "name": "Roelof Jan Elsinga",
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+31-6-2232-4113",
            "contactType": "Customer service"
          }
        }
        </script>

        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Person",
          "name": "Roelof Jan Elsinga",
          "url": "https://roelofjanelsinga.com",
          "sameAs": [
            "https://twitter.com/RJElsinga",
            "https://medium.com/@roelofjanelsinga",
            "https://github.com/roelofjan-elsinga",
            "https://www.linkedin.com/in/roelofjanelsinga/"
          ]
        }
        </script>

        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "url": "https://roelofjanelsinga.com/",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://roelofjanelsinga.com/articles?q={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        }
        </script>
    </body>
</html>
