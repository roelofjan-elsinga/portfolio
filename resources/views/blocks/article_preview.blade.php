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
            <h3 class="mb-4 font-bold leading-normal text-3xl">
                {{$article->title()}}
            </h3>
        </a>

        <p class="mb-4 leading-loose">{{$article->description()}}</p>

        <span class="text-gray-600 text-sm">{{__('article.posted_on')}}: {!! $article->getPostDate()->format('F jS, Y') !!}</span>

        <div class="flex space-x-2 mt-4">
            @foreach($article->get('tags') as $tag)
                <a href="{{route('articles.tags', $tag)}}" class="bg-blue-200 hover:bg-blue-300 rounded p-2">
                    {{$tag}}
                </a>
            @endforeach
        </div>

    </div>

</article>