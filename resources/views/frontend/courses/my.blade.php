@extends('frontend.layouts.master')

@section('content')
    <div class="col-lg-12">
        <h2>Your Courses</h2>
        @if($courses->isEmpty())
            <p class="lead">You aren't in any courses!</p>
        @endif
        @foreach($courses as $course)
                <h4>{!! link_to('course/switch/'.$class->id, $class->name) !!}</h4>
        @endforeach

    </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop