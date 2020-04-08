<article class="flex-1 border p-4 m-2 rounded shadow flex flex-col hover:shadow-md duration-200" style="transition-duration: 0.2s">

    <a href="{{$project->github_url}}" target="_blank" class="text-theme-darkest no-underline">

        <h3>{{$project->name}}</h3>

        <p class="mb-4 mt-2 flex-auto leading-loose">{{$project->description}}</p>

        <span class="text-theme-darkest font-bold pb-2 link">View project</span>

    </a>

</article>