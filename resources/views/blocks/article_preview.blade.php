<article>
    <div class="image">
        <img src="{{asset($article->thumbnail())}}" />
    </div>

    <div class="content pt-8">
        <h3 class="pt-4 sm:pt-0 mb-4 font-bold text-theme-dark">
            {{$article->title()}}
        </h3>

        <p class="mb-4 leading-normal">{{$article->description()}}</p>

        <span class="text-grey-dark text-sm">Posted on: {!! $article->getPostDate()->format('F jS, Y') !!}</span>
    </div>

    <a href="{{!is_null($article->externalUrl()) ? $article->externalUrl() : route('articles.view', $article->slug())}}" {{!is_null($article->externalUrl()) ? "target='_blank'" : ''}} class="desktop-link"></a>
</article>