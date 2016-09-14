@extends('frontend.layouts.master')

@section('content')
    <div class="col-lg-12">
        <h2>Announcements</h2>
        @if($announcements->isEmpty())
            <p class="lead">There are no announcements!</p>
        @endif
        @foreach($announcements as $announcement)

                <h4>{!! $announcement->title !!}</h4>
                <h5>{!! date('m-d-Y', strtotime($announcement->created_at)) !!}</h5>
                {!! $announcement->body !!}
                <hr/>
        @endforeach

    </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop