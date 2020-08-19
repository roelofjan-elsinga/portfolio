<h3 class="text-2xl mb-4">Download or view my CV</h3>

<p>
    You can view my CV in your browser or download a PDF version of it for later.
</p>

<section class="flex space-x-4">

    <div class="flex-1">
        <h4 class="mb-4">English</h4>

        <div>
            <a href="{{route('resume.show')}}" class="mr-4 inline-block hover:underline mb-2">
                <span class="fas fa-eye"></span> View
            </a>
            <a href="{{url('/files/roelofjanelsinga-resume-en.pdf')}}" class="inline-block hover:underline mb-2">
                <span class="fas fa-download"></span> Download
            </a>
        </div>

    </div>

    <div class="flex-1">
        <h4 class="mb-4">Dutch</h4>

        <div>
            <a href="{{route('resume.show_dutch')}}" class="mr-4 inline-block hover:underline mb-2">
                <span class="fas fa-eye"></span> View
            </a>
            <a href="{{url('/files/roelofjanelsinga-resume-nl.pdf')}}" class="inline-block hover:underline mb-2">
                <span class="fas fa-download"></span> Download
            </a>
        </div>

    </div>

</section>