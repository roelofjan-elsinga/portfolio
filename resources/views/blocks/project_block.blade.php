<div class="border rounded shadow flex flex-col hover:shadow-md" style="transition-duration: 0.2s">
    <a class="text-theme-darkest no-underline" href="{{$project->url}}">
        <img src="{{$project->thumbnail_url ?? $project->image_url}}" alt="{{$project->image_alt}}" class="mt-4" />

        <section class="p-4">

            <h3 class="pt-4">{{$project->title}}</h3>

            <p class="mb-4 mt-2 flex-auto leading-loose">{{$project->description}}</p>

            <span class="text-theme-darkest font-bold pb-2 link">View project</span>

        </section>
    </a>
</div>