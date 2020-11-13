<footer class="bg-theme-lightest text-theme-darkest p-8 mt-8 text-white">

    <div class="container mx-auto">

        <strong class="text-center mb-8 text-3xl block">{{__('footer.title')}}</strong>

        <section class="flex flex-col md:flex-row">

            <div class="flex-1">
                <h4 class="mb-4 text-xl font-bold">{{__('footer.social_media')}}</h4>

                <ul class="list-none text-lg m-0">
                    <li class="mb-2">
                        <a href="https://twitter.com/RJElsinga"
                           target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                    </li>
                    <li class="mb-2">
                        <a href="https://medium.com/@roelofjanelsinga"
                           target="_blank"><i class="fab fa-medium"></i> Medium</a>
                    </li>
                    <li class="mb-2">
                        <a href="https://dev.to/roelofjanelsinga"
                           target="_blank"><i class="fab fa-dev"></i> Dev.to</a>
                    </li>
                    <li class="mb-2">
                        <a href="https://github.com/roelofjan-elsinga"
                           target="_blank"><i class="fab fa-github"></i> GitHub</a>
                    </li>
                    <li class="mb-2">
                        <a href="https://www.linkedin.com/in/roelofjanelsinga/"
                           target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
                    </li>
                </ul>

            </div>

            <div class="flex-1">
                <h4 class="mb-4 text-xl font-bold mt-8 md:mt-0">{{__('footer.business')}}</h4>

                <ul class="list-none lext-lg m-0">
                    <li class="mb-2">
                        <a href="mailto:hello@roelofjanelsinga.com?subject=Hi%20Roelof Jan!"
                        ><i class="fas fa-envelope"></i> {{__('footer.send_an_email')}}</a>
                    </li>
                    <li class="mb-2">
                        KvK: 64377962
                    </li>
                    <li class="mb-2">
                        BTW: NL003051282B11
                    </li>
                </ul>
            </div>

            <div class="flex-1">
                <h4 class="mb-4 text-xl font-bold mt-8 md:mt-0">{{__('footer.pages')}}</h4>

                <ul class="list-none lext-lg m-0">
                    <li class="mb-2">
                        <a href="{{route('articles')}}">Blog</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{route('public.work')}}">Portfolio</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{route('resume.show_dutch')}}"
                        ><i class="fas fa-id-card"></i> Mijn CV (NL)</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{route('resume.show')}}"
                        ><i class="fas fa-id-card"></i> My resume (EN)</a>
                    </li>
                </ul>
            </div>

            <div class="flex-1">
                <h4 class="mb-4 text-xl font-bold hidden md:block">{{__('footer.pages')}}</h4>

                <ul class="list-none lext-lg m-0 md:mt-4">
                    <li class="mb-2">
                        <a href="{{url('/about-me')}}">{{__('footer.about_me')}}</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{url('/my-tech-stack')}}">{{__('home.my_tech_stack')}}</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{route('public.open_source')}}">{{__('footer.oss_contributions')}}</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{url('/how-i-built-this-website')}}">{{__('footer.how_i_built')}}</a>
                    </li>
                </ul>
            </div>

        </section>

        <div class="flex flex-col md:flex-row text-lg border-t pt-8 mt-8 border-blue-300">
            <div class="flex-1 mb-2 md:mb-0">
                &copy; {{date('Y')}} Roelof Jan Elsinga
            </div>

            <a href="{{route('page', 'algemene-voorwaarden')}}">
                Algemene voorwaarden
            </a>
        </div>

    </div>

</footer>
