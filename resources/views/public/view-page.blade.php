@extends($page->templateName())

@section('navigation')

    @include('blocks.navigation', ['is_external' => true])

@endsection

@section('content')

    <main class="paragraph-spacing">
        {!! $page->content() !!}
    </main>

@endsection