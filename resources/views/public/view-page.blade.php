@extends('public')

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')

    <div class="articles-page">
        <main class="view-article paragraph-spacing">
            {!! $page->body() !!}
        </main>
    </div>

@endsection