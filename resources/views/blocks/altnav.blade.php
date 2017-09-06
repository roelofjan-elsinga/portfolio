<nav class="navbar navbar-default navbar-fixed-top" style="background-color:rgba(44, 62, 80,1.0)">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"><span class="glyphicon glyphicon-th-large"></span></button>
            <a class="navbar-brand" id="brand_btn" href="{{ route('home') }}">Roelof Jan Elsinga</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a class="home_btn active" href="{{ route('home') }}#home">Home</a></li>
                <li><a class="work_btn" href="{{ route('home') }}#work">Work</a></li>
                <li><a class="services_btn" href="{{ route('home') }}#services">Services</a></li>
                <li><a class="about_btn" href="{{ route('home') }}#about">About me</a></li>
                <li><a class="contact_btn" href="{{ route('home') }}#contact">Contact</a></li>
                @if(!Auth::guest())
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>