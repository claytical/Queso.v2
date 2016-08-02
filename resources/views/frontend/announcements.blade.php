@extends('frontend.layouts.master')

@section('content')
<h2>Announcements</h2>
    <div class="col-lg-12">
        @if(is_empty($announcements))
            <p class="lead">There are no announcements!</p>
        @endif
        <ul class="list-unstyled list">
        @foreach($announcements as $announcement)
            <li>
                <h4>{!! $announcement->title !!}</h4>
                <h5>{!! $announcement->created_at !!}</h5>
                <div>
                {!! $announcement->body !!}
                </div>
            </li>
        @endforeach

        </ul>

    </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop