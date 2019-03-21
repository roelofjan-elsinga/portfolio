<nav class="menu block w-full" id="home">
    <div class="flex h-16 md:h-32">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="block flex-1 flex items-center text-blue-darkest no-underline text-2xl font-bold"
           href="{{ isset($is_external) ? route('home') : '' }}#home">
            Roelof Jan
        </a>

        <ul class="block flex-1 flex items-center justify-end">
            <li class="mx-2 hidden sm:inline-block"><a class="link" href="{{ isset($is_external) ? route('home') : '' }}#work">Work</a></li>
            <li class="mx-2 hidden sm:inline-block"><a class="link" href="{{ isset($is_external) ? route('home') : '' }}#social">Social</a></li>
            <li class="inline-block mx-2"><a class="link" href="{{route('articles.index')}}">Blog</a></li>
            <li class="inline-block mx-2">
                <a class="link" href="{{route('feed')}}">
                    <img src="{{asset('images/icons/rss-feed.svg')}}" class="h-4" />
                </a>
            </li>
        </ul>
    </div><!-- /.container-fluid -->
</nav>
