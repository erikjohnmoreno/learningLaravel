@extends('layout')
@section('content')
<div class="container col-md-6">
    {{ Form::label('comment', 'Comments',['class' => 'jumbotron']) }}
    <ul>
        <h1 style="color: black; background-color: lightblue">{{ $app_title }}</h1>
        @foreach ($itunes_app as $app)
            @if ($app['trackName'] == $app_title)
                <li><strong>By:</strong> {{ $app['artistName'] }}</li>
                <li><strong>Category:</strong> {{ $app['genres'][0] }}</li>
                <li><strong>Average Rating:</strong> {{ round($rates,2) }}</li>
            @if (Auth::check())
                @if (!$check_rate)
                    {{ Form::open(['url' => '/rate', 'class' => 'form']) }}
                    {{ Form::hidden('app_title', $app_title) }}
                    {{ Form::label('one','1') }}
                    {{ Form::radio('rating', 'one') }}&nbsp;
                    {{ Form::label('two', '2') }}
                    {{ Form::radio('rating', 'two') }}&nbsp;
                    {{ Form::label('three', '3') }}
                    {{ Form::radio('rating', 'three') }}&nbsp;
                    {{ Form::label('four', '4') }}
                    {{ Form::radio('rating', 'four') }}&nbsp;
                    {{ Form::label('five', '5') }}
                    {{ Form::radio('rating', 'five') }}&nbsp;
                    {{ Form::submit('Submit Rating', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                @elseif ($check_rate)
                    {{ "You already rate this app" }}
                    {{ Form::open(['url' => '/delete_rating', 'class' => 'form']) }}
                    {{ Form::hidden('app_title', $app_title) }}
                    {{ Form::submit('Delete Rating',['class'=> 'btn btn-primary']) }}
                    {{ Form::close() }}
                @endif
            @endif
            <br/>
                <div style="white-space: nowrap; overflow: scroll" class="col-md-12">
                @for ($i = 0; $i < count($app['screenshotUrls']); $i++)
                       <a href="{{ $app['screenshotUrls'][$i] }}"> <img src="{{ $app['screenshotUrls'][$i] }}" height="300px" width="240px"></a>
                @endfor
                </div>
                <div>
                    <ul>
                        <li><strong>Description:</strong> <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $app['description'] }}</li>
                    </ul>
                </div>
            @endif
        @endforeach
    </ul>
</div>
@if (Auth::check() )
    <div class="section-padding">
        <br/>
        <ul>
        </ul>
    </div>

    <div class="container col-md-6">
        <section class="section-padding">
            <div class="jumbotron text-center">

                <div>
                        <div style="text-align: left">
                        <strong style="font-size: larger; color: #000000">Comments:</strong><br/>
                        @foreach ($comments as $comment)
                                {{ HTML::image('/img/avatar/'. $comment->email. '/'. $comment->image,'alt', array('width' => 40, 'height' => 40)) }}&nbsp;<strong style="color: #660066">{{ $comment->name}}</strong><br/>&nbsp;&nbsp;&nbsp;{{ $comment->body }}<br/>
                        @endforeach
                        </div>
                    @if (!$check_comment)
                        {{ Form::open(['url'=> '/comment', 'class' => 'form']) }}
                        {{ Form::hidden('app_title', $app_title) }}
                    {{ Form::label('body', 'Comment:') }}
                    {{ Form::textarea('body', null, ['class'=>'form-control']) }}
                        <div class="form-group">
                            {{ Form::submit('Submit Comment', ['class'=> 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    @else
                        {{ "You already Comment on this application" }}<br/>
                        {{ Form::open(['url' => '/comment_delete', 'class' => 'form']) }}
                        {{ Form::hidden('app_title', $app_title) }}
                        {{ Form::submit('Delete Comment', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    @endif
                </div>

                {{ Form::close() }}
            </div>
        </section>
    </div>
@else
    <div class="section-padding">
    {{ "login to Comment/Rate this app" }}
    </div>
@endif
@stop

