@extends('public')

@section('navigation')
    @include('blocks.altnav')
@endsection

@section('content')
    <div class="container" style="padding-top:75px;">
        <div class="articles-page">

            <div class="row">
                <div class="col-md-12">

                    <main class="view-article">

                        <article>

                            {!! $article->content !!}

                            <span class="muted">Posted on: {!! $article->postDate !!}</span>

                        </article>

                    </main>

                </div>
            </div>
        </div>
    </div>
@endsection