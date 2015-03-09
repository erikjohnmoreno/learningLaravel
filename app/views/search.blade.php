@extends('layout')
@section('content')
<div class="section-padding">
    <div class="col-md-12">
    {{ $itunes_search->appends(array('search' => $to_search))->links() }}
    </div>
    <div class="col-md-12">
    Search Result
    </div>

    @foreach ($itunes_search as $app)
        <div class="col-md-4">
        <ul>
            <li><a href="{{ action('MovieController@movie', $app['trackName']) }}"> {{ $app['trackName'] }}</a></li>
            <img src="{{ $app['artworkUrl60'] }}">
        </ul>
        </div>
    @endforeach
</div>
    @stop