<article class="shadow mb-4 rounded hover:shadow-md duration-200 bg-white" style="transition-duration: 0.2s">
    <a
        href="{{!is_null($article->externalUrl()) ? $article->externalUrl() : route('articles.view', $article->slug())}}"
        {{!is_null($article->externalUrl()) ? "target='_blank'" : ''}}
        class="flex text-theme-darkest no-underline flex-col md:flex-row">

        <img src="{{asset($article->thumbnail())}}" class="w-full md:max-w-350"/>

        <div class="flex-1 pt-6 pb-4 px-4 flex flex-col">
            <h3 class="mb-4 font-bold">
                {{$article->title()}}
            </h3>

            <p class="mb-4 leading-loose flex-grow">{{$article->description()}}</p>

            <span class="text-gray-600 text-sm">Posted on: {!! $article->getPostDate()->format('F jS, Y') !!}</span>
        </div>

    </a>
</article>