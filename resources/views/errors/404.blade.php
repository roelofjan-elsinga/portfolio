@extends('public', ['page' => FlatFileCms\TagsParser::instance()->getTagsForPageName('404')])

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')

    <div class="section h-3/4">

        <h1 class="text-5xl py-8">Oops! I can't show you this page!</h1>
        <h3 class="text-2xl mb-4">Did you find a page I still have to create?</h3>
        <a href="{{route('home')}}" class="link link--underline">I'll take you back to the content</a>

    </div>


@endsection

@section('footer')

@endsection