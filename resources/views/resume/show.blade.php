<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="resume">
    <meta name="description" content="Are you wondering what my skills are and what I've worked on before? You'll read all about it on my CV.">
    <meta name="author" content="Roelof Jan Elsinga">

    <link rel="author" href="https://plus.google.com/u/0/+RoelofJanElsinga"/>

    <meta property="og:title" content="My CV - Roelof Jan Elsinga"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{asset($resume['photo_url'])}}"/>
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:description" content="Are you wondering what my skills are and what I've worked on before? You'll read all about it on my CV."/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ Request::url() }}">
    <meta name="twitter:title" content="My CV - Roelof Jan Elsinga">
    <meta name="twitter:description" content="Are you wondering what my skills are and what I've worked on before? You'll read all about it on my CV.">
    <meta name="twitter:image" content="{{asset($resume['photo_url'])}}">

    <title>@lang('resume.title') - Roelof Jan Elsinga</title>

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

    <link href="{{mix('css/resume.css')}}" rel="preload" as="style"/>
    <link href="{{mix('css/resume.css')}}" rel="stylesheet"/>
</head>

<body class="container mx-auto md:pt-8 text-black">

    <main class="bg-white p-8">

        <div class="flex flex-col md:flex-row">

            <div class="flex-1 leading-loose">
                <h1 class="text-4xl leading-tight mb-4 print:text-2xl print:mb-2">{{$resume['name']}}</h1>

                <h2 class="text-2xl text-theme mb-4 print:text-xl print:mb-2">{{$resume['current_title']}}</h2>

                <p><strong>E-mail:</strong> <a href="mailto:roelofjanelsinga.com" class="text-theme-darkest underline">roelof.jan@hey.com</a></p>
                <p><strong>Portfolio:</strong> <a href="https://roelofjanelsinga.com" class="text-theme-darkest underline">https://roelofjanelsinga.com</a></p>
                <p><strong>Resume (English):</strong> <a href="{{route('resume.show')}}" class="text-theme-darkest underline">{{route('resume.show')}}</a></p>
                <p><strong>CV (Nederlands):</strong> <a href="{{route('resume.show_dutch')}}" class="text-theme-darkest underline">{{route('resume.show_dutch')}}</a></p>
            </div>

            <div class="flex-1 md:text-right">
                <img src="{{asset($resume['photo_url'])}}" alt="Roelof Jan Elsinga" class="my-4 w-auto h-32 md:h-48" />
            </div>

        </div>

        <div class="flex flex-col md:flex-row my-4 sm:my-8">

            <div class="flex-1">
                <h2>
                    {{__('resume.experience', [], $lang)}}
                </h2>

            @foreach($resume['experiences'] as $experience)

                <div class="flex flex-col lg:flex-row mt-8 print:mt-4">
                    <div class="w-48">
                        <div class="bg-theme-darker text-white rounded p-2 inline-block mb-4 lg:mb-0">
                            {{$experience['dates']}}
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg text-theme font-black w-full md:w-auto">
                                {{$experience['company']}}
                            </h3>
                            <p class="mt-2 text-gray-600 italic">
                                {{$experience['location']}}
                            </p>
                            <p class="mt-2 text-lg">
                                {{$experience['job_title']}}
                            </p>
                            <div class="mt-2 pr-2">
                                <strong>{{__('resume.key_activities', [], $lang)}}</strong>

                                <ul class="block mt-2 ml-4 list-disc">
                                    @foreach($experience['key_activities'] as $activity)
                                        <li>{{$activity}}</li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

            <div class="flex-1 my-8 md:my-0">

                <h2>{{__('resume.education', [], $lang)}}</h2>

                @foreach($resume['education'] as $education)

                    <div class="flex flex-col lg:flex-row mt-8 print:mt-4">
                        <div class="w-32">
                            <div class="bg-theme-darker text-white rounded p-2 inline-block mb-4 lg:mb-0">
                                {{$education['dates']}}
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg text-theme font-black">
                                {{$education['school']}}
                            </h3>
                            <p class="mt-2 text-gray-600 italic">
                                {{$education['location']}}
                            </p>
                            <p class="mt-2 text-lg">
                                {{$education['degree']}}
                            </p>
                            <p class="mt-2 text-lg">
                                {{$education['field_of_study']}}
                            </p>
                        </div>
                    </div>

                @endforeach

            </div>

        </div>

        <div>
            <h2 class="mt-4 md:mt-8 mb-4">{{__('resume.skills', [], $lang)}}</h2>

            <ul class="-m-1">
                @foreach($resume['skills'] as $skill)

                    <li class="m-1 inline-block bg-blue-200 rounded p-2">
                        {{$skill}}
                    </li>

                @endforeach
            </ul>
        </div>
    </main>
</body>
</html>


