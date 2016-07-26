@extends('frontend.layouts.master')

@section('content')
<h2>Quest Name</h2>
        <div class="col-lg-12">
            <div class="row">
                <iframe src="https://player.vimeo.com/video/171365895?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
            <div class="row">
                {!! Form::open(array('url' => 'quest/watched')) !!}
                {!! Form::submit('Get Points') !!}
                {!! Form::close() !!}
            </div>
        </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop