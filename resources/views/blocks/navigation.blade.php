<nav class="menu block w-full" id="home">
    <div class="flex h-16 md:h-32">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="block flex-1 flex items-center text-blue-darkest no-underline text-2xl font-bold"
           href="{{ isset($is_external) ? route('home') : '' }}#home">
            <img src="{{asset('images/logo/logo_small.png')}}" class="w-32 md:w-48" alt="Logo Roelof Jan Elsinga" />
        </a>

        <ul class="block flex-1 flex items-center justify-end">
            <li class="mx-2 inline-block"><a class="link" href="{{route('resume.show')}}">My CV</a></li>
            <li class="inline-block mx-2"><a class="link" href="{{route('articles')}}">Blog</a></li>
            <li class="inline-block mx-2">
                <a class="link" href="{{route('feed')}}">
                    <img src="{{asset('images/icons/rss-feed.svg')}}" class="h-4" alt="RSS Feed logo" />
                </a>
            </li>
        </ul>
    </div><!-- /.container-fluid -->
</nav>
