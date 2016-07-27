@extends('frontend.layouts.master')

@section('content')
<h2>Peer Feedback</h2>
<h3>Quest Name, Student Name</h3>
    <div class="col-lg-12">
        <div class="row">
            <iframe src="https://player.vimeo.com/video/171365895?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
        <div class="row">

            <h4>What did you like?</h4>
            <p>Aenean lacinia bibendum nulla sed consectetur. Nullam quis risus eget urna mollis ornare vel eu leo. Etiam porta sem malesuada magna mollis euismod.</p>
        </div>
        <div class="row">
            {!! Form::open(array('url' => 'quest/feedback')) !!}
    
            {!! Form::textarea('liked', null, ['class' => 'field', 'files' => true]) !!}

        </div>

        <div class="row">
            <h4>What could be improved?</h4>
            <p>Aenean lacinia bibendum nulla sed consectetur. Nullam quis risus eget urna mollis ornare vel eu leo. Etiam porta sem malesuada magna mollis euismod.</p>
        </div>
        <div class="row">
            {!! Form::textarea('suggestions', null, ['class' => 'field', 'files' => true]) !!}
            {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-lg']) !!}
            {!! Form::close() !!}
        </div>
 
    </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop