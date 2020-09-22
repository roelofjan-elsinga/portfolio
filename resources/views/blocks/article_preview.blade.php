<article class="shadow mb-4 rounded duration-200 bg-white flex text-theme-darkest no-underline flex-col border">

    @if(!empty($article->image()))
        <img src="{{asset($article->image())}}"
             alt="{{$article->title()}}"
             title="{{$article->title()}}"
             class="w-full h-48 object-cover px-4 pt-4" loading="lazy"/>
    @endif

    <div class="flex-1 pt-6 pb-4 px-4">
        <a
            href="{{!is_null($article->externalUrl()) ? $article->externalUrl() : route('articles.view', $article->slug())}}"
            {{!is_null($article->externalUrl()) ? "target='_blank'" : ''}} class="hover:underline"
        >
            <h3 class="mb-4 font-bold leading-normal">
                {{$article->title()}}
            </h3>
        </a>

        <p class="mb-4 leading-normal">{{$article->description()}}</p>

        <span class="text-gray-600 text-sm">Posted on: {!! $article->getPostDate()->format('F jS, Y') !!}</span>
    </div>

</article>