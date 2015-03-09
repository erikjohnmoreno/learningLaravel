@extends('layout')
@section('content')
    <div class="section-padding">
        {{ $paginator->links(); }}
        @if ($rated)
        Rated Applications:<br/><br/>
        @foreach ($paginator as $rated_app)
            <ul>
                <li><a href="{{ action('MovieController@movie',array($rated_app->app_title)) }}">{{ $rated_app->app_title }}</a></li>
            </ul>
        @endforeach
        @else
            {{ "No Rated Apps"  }}
        @endif
    </div>
@stop