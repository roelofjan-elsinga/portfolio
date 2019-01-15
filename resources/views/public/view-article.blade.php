@extends('public')

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')
    <div class="articles-page">

        <main class="view-article">

            <article>

                {!! $article->content !!}

                <span class="muted">Posted on: {!! $article->postDate !!}</span>

            </article>

        </main>
    </div>
@endsection

@section('footer')

    @include('blocks.navigation', ['is_external' => true])

@endsection