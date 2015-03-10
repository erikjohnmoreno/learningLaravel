@extends('layout')
@section('content')
    <div class="section-padding">
<br/>
        {{ $paginator->links() }}
        {{ Form::open(array('url' => '/search','method'=>'get')) }}
        {{ Form::text('search',null, array('placeholder' => 'Search')) }}
        <button type="submit" class="btn btn-primary"><i class="fa fa-search" ></i></button>
        {{--{{ Form::submit('Search', ['class' => 'btn btn-primary']) }}--}}
        {{ Form::close() }}

       @foreach ($paginator as $app)
           <div class="col-md-4">
            <ul>
               <li><a href="{{ action('MovieController@movie', $app['trackName']) }}"> {{ $app['trackName'] }}</a></li>
               </a><img src="{{ $app['artworkUrl60'] }}">
           </ul>
           </div>
       @endforeach


    </div>
@stop


