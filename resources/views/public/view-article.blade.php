@extends('public')

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')
    <div class="articles-page py-8 sm:py-0">

        <main class="view-article paragraph-spacing">

            <article>

                {!! $article->content !!}

                <span class="text-sm text-grey-dark">Posted on: {!! $article->postDate !!}</span>

            </article>

        </main>
    </div>
@endsection

@section('footer')

    @include('blocks.navigation', ['is_external' => true])

@endsection