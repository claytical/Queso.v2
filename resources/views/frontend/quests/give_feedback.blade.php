@extends('frontend.layouts.master')

@section('content')
<h2>Peer Feedback</h2>
<h3>Quest Name</h3>
<h4>Student Name</h4>

        <div class="col-lg-12">
            <div class="row">
                <iframe src="https://player.vimeo.com/video/171365895?title=0&byline=0&portrait=0" width="64" height="36" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>

<h5>What did you like?</h5>
            <div class="row">
                {!! Form::open(array('url' => 'foo/bar')) !!}
        
                {!! Form::textarea('liked', null, ['class' => 'field', 'files' => true]) !!}

            </div>


<h4>What could be improved?</h4>
            <div class="row">
        
                {!! Form::textarea('suggestions', null, ['class' => 'field', 'files' => true]) !!}
                {!! Form::submit('Submit') !!}
                {!! Form::close() !!}
            </div>
 
         </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop