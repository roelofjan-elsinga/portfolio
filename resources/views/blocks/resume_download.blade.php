<h3 class="text-2xl mb-4">{{__('resume.view_or_download_title')}}</h3>

<p>
    {{__('resume.view_or_download_intro')}}
</p>

<section class="flex space-x-4">

    <div class="flex-1">
        <h4 class="mb-4">{{__('resume.english')}}</h4>

        <div>
            <a href="{{route('resume.show')}}" class="mr-4 inline-block hover:underline mb-2">
                <span class="fas fa-eye"></span> {{__('resume.view')}}
            </a>
            <a href="{{url('/files/roelofjanelsinga-resume-en.pdf')}}" class="inline-block hover:underline mb-2">
                <span class="fas fa-download"></span> {{__('resume.download')}}
            </a>
        </div>

    </div>

    <div class="flex-1">
        <h4 class="mb-4">{{__('resume.dutch')}}</h4>

        <div>
            <a href="{{route('resume.show_dutch')}}" class="mr-4 inline-block hover:underline mb-2">
                <span class="fas fa-eye"></span> {{__('resume.view')}}
            </a>
            <a href="{{url('/files/roelofjanelsinga-resume-nl.pdf')}}" class="inline-block hover:underline mb-2">
                <span class="fas fa-download"></span> {{__('resume.download')}}
            </a>
        </div>

    </div>

</section>