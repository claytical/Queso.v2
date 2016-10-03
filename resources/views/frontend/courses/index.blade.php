@extends('frontend.layouts.master')

@section('content')
    <div class="col-lg-12">
        <h2>Courses</h2>
        @if($courses->isEmpty())
            <p class="lead">There are no courses!</p>
        @endif
        @foreach($courses as $course)

                <h4>{!! $course->name !!}</h4>
                <h5>{!! $course->instructor_display_name !!}</h5>
                <h6>{!! $course->meeting_location !!}, {!! $course->meeting !!}</h6>
                <p>{!! $course->description !!}</p>
                <hr/>
        @endforeach

    </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop