<html>
<head>
    <title>
        CV Roelof Jan Elsinga
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{mix('css/resume.css')}}" rel="stylesheet"/>
</head>

<body class="container mx-auto pt-8 text-blue-darkest">

    <main class="bg-white p-8">

        <div class="flex flex-col md:flex-row">

            <div class="flex-1 leading-loose">
                <h1 class="text-4xl">{{$resume['name']}}</h1>

                <h2 class="text-2xl text-blue-dark mb-4">{{$resume['current_title']}}</h2>

                <p><strong>E-mail:</strong> <a href="mailto:roelofjanelsinga.com" class="text-blue-darkest underline">roelofjanelsinga@gmail.com</a></p>
                <p><strong>Portfolio:</strong> <a href="https://roelofjanelsinga.com" class="text-blue-darkest underline">https://roelofjanelsinga.com</a></p>
            </div>

            <div class="flex-1 md:text-right">
                <img src="{{asset($resume['photo_url'])}}" class="my-4 w-auto h-48" />
            </div>

        </div>

        <div class="flex flex-col md:flex-row my-8">

            <div class="flex-1">
                <h2>
                    Experience
                </h2>

                @foreach($resume['experiences'] as $experience)

                    <div class="flex flex-col lg:flex-row mt-8">
                        <div class="w-48">
                            <div class="bg-blue-darkest text-white rounded p-2 inline-block mb-4 lg:mb-0">
                                {{$experience['dates']}}
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg text-blue-dark font-black">
                                {{$experience['company']}}
                            </h3>
                            <p class="mt-2 text-grey-dark italic">
                                {{$experience['location']}}
                            </p>
                            <p class="mt-2 text-lg">
                                {{$experience['job_title']}}
                            </p>
                            <div class="mt-2">
                                <strong>Key activities</strong>

                                <ul class="block mt-2">
                                    @foreach($experience['key_activities'] as $activity)
                                        <li>{{$activity}}</li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

            <div class="flex-1">

                <h2>Education</h2>

                @foreach($resume['education'] as $education)

                    <div class="flex flex-col lg:flex-row mt-8">
                        <div class="w-48">
                            <div class="bg-blue-darkest text-white rounded p-2 inline-block mb-4 lg:mb-0">
                                {{$education['dates']}}
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg text-blue-dark font-black">
                                {{$education['school']}}
                            </h3>
                            <p class="mt-2 text-grey-dark italic">
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
            <h2 class="mt-8 mb-4">Skills</h2>

            <ul class="list-reset -m-1">
                @foreach($resume['skills'] as $skill)

                    <li class="m-1 inline-block bg-blue-lighter rounded p-2">
                        {{$skill}}
                    </li>

                @endforeach
            </ul>
        </div>
    </main>
</body>
</html>


