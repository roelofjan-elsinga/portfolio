@extends('public', ['customClass' => 'dark-background'])

@section('navigation')
    @include('blocks.altnav')
@endsection

@section('content')
    <div class="container" style="padding-top:75px;">
        <div class="articles-page">

            {!! $content !!}

            <div class="row">
                <div class="col-md-12">

                    <main class="articles">

                        @foreach($articles as $article)

                            <article>
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

                                <div class="content">
                                    @isset($article->title)
                                        <h3>
                                            {{$article->title}}
                                        </h3>
                                    @endisset

                                    <span class="muted">Posted on: {!! $article->postDate !!}</span>
                                </div>

                                <a href="{{route('articles.view', $article->slug)}}" class="desktop-link"></a>
                            </article>

                        @endforeach

                    </main>

                </div>
            </div>
        </div>
    </div>
@endsection