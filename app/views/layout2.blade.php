<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Movie Reviewer</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    {{--<link rel="stylesheet" href="{{ asset('css/style.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
</head>
<body>
<header>
    <nav class="col-md-12 top-menu">
    <div class="col-md-6">
        <a class="navbar-brand" href="/">APP Reviewer</a>
        @if (Auth::check())
        <a class="navbar-brand" href="/rated_app">Rated Apps</a>
        @else
        {{ "You must be logged in to view Rated Apps" }}
        @endif
    </div>
    <div class="col-md-6 user-info">
        @if (Auth::check())
        <a href="/profile" class="navbar-brand">Hi! {{ Auth::user()->name }}</a>
        <a href="<?php echo action('UserController@logout')?>" class="navbar-brand">Sign Out</a>

        @else
        <li><a href="{{ action('UserController@loginWithFacebook') }}" class="navbar-brand" >Login With Facebook</a></li>
        @endif
    </div>
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