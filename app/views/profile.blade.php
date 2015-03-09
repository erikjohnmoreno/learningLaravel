@extends('layout')
@section('content')
    <div class="section-padding">
        <br/>
        <div class="col-lg-5" style="word-break: break-word;">
            <strong>Name:</strong> &nbsp;{{ $name }}<br/>
            <strong>Description:</strong> &nbsp;{{ $about }}<br/>
            {{--{{ Form::label('name', "Name: $name") }}<br/>--}}
            {{--{{ Form::label('about', "Description: $about") }}--}}
        </div>
        <div class="col-lg-10">
            <div class="col-md-6">
            @if ($image == null)
                {{ HTML::image('/img/avatar/default.png') }}
            @else
                {{ HTML::image('/img/avatar/'. $personal_folder. '/'. $image) }}
            @endif
                {{ Form::open(array('url' => '/upload', 'files' => true)) }}
                {{ Form::file('image') }}
                {{ Form::submit('Upload Image', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            </div>

            <div class="col-md-6">
                {{ Form::open(['url' => '/profile']) }}
                {{ Form::label('describe', "Describe Yourself") }}
                {{ Form::textarea('about', null, ['class' => 'form-control', 'rows' => 4]) }}<br/>
                {{ Form::submit('Save Changes',['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop