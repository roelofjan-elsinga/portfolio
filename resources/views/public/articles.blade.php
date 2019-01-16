@extends('public')

@section('navigation')
    @include('blocks.navigation', ['is_external' => true])
@endsection

@section('content')
    <div class="articles-page items paragraph-spacing pt-8 sm:pt-0">

        {!! $content !!}

        <main class="articles my-8">

            @foreach($articles as $article)

                <article class="inline-block">
                    <div class="image">
                        @isset($article->thumbnail)
                            <img src="{{asset($article->thumbnail)}}" />
                        @endisset

                        <div class="read-box">
                            <a href="{{route('articles.view', $article->slug)}}" class="read-link">
                                <i class="fa fa-angle-right fa-2x"></i>
                            </a>
                        </div>
                    </div>

                    <div class="content pt-8">
                        @isset($article->title)
                            <h3 class="pt-4 sm:pt-0">
                                {{$article->title}}
                            </h3>
                        @endisset

                        <span class="muted">Posted on: {!! $article->postDate !!}</span>
                    </div>

                    <a href="{{isset($article->url) ? $article->url : route('articles.view', $article->slug)}}" {{isset($article->url) ? "target='_blank'" : ''}} class="desktop-link"></a>
                </article>

            @endforeach

        </main>
    </div>
@endsection

@section('footer')

    @include('blocks.navigation', ['is_external' => true])

@endsection