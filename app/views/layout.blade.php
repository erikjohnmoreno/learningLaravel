<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Movie Reviewer</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
</head>
<body>
<header>
    <nav class="navbar navbar-default" role="navigation">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">APP Reviewer</a>
            @if (Auth::check())
            <a class="navbar-brand" href="/rated_app">Rated Apps</a>
            @else
                {{ "You must be logged in to view Rated Apps" }}
            @endif
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">


                @if(Auth::check())
                    <li> <a href="/profile">Hi! {{ Auth::user()->name }}</a></li>
                    <li><a href="<?php echo action('UserController@logout')?>" class="navbar-brand">Sign Out</a></li>

                @else
                    <li><a href="{{ action('UserController@loginWithFacebook') }}" class="navbar-brand" >Login With Facebook</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</header>
    @yield('content')

    <div class="bottom-menu col-md-12">
        <div class="container">
            <div class="row">
                <div class="col-md-2 navbar-brand">
                    <a href="/">APP Reviewer</a>
                </div>

                <div clas="col-md-10">
                    <ul class="bottom-links">
                    </ul>
                </div>
            </div>
        </div>
    </div>


<script src="https://codes.jquery.com/jquery.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</body>
</html>