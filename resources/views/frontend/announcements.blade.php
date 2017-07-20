@extends('frontend.layouts.master')

@section('content')
<section class="content" id="announcements">
    <div class="container is-fluid">        
        <h1 class="title">Announcements</h1>
        @if($announcements->isEmpty())
            <h2 class="subtitle">There are no announcements!</h2>
        @endif
        @foreach($announcements as $announcement)

                <h2 class="subtitle">{!! $announcement->title !!} <span class="is-pulled-right">{!! date('m/d/Y', strtotime($announcement->created_at)) !!}</span></h2>
                {!! $announcement->body !!}
                <hr/>
        @endforeach


    </div>
</section>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop