@php
    $pages = $pages ?? [];
@endphp

<section class="mb-8 text-grey-darker">
    <a href="{{route('home')}}" class="hover:underline">Home</a>
    @foreach($pages as $page)
        <span class="mx-2 md:mx-4">
            <i class="fas fa-angle-right"></i>
        </span>
        <a href="{{$page['url']}}" class="hover:underline">{{$page['title']}}</a>
    @endforeach
</section>