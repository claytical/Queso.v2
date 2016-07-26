@extends('frontend.layouts.master')

@section('content')
<h2>Feedback Received</h2>

        <div class="col-lg-12">
            <div class="row">
                <h4>Quest Name</h4>
                <p>2 peers have submitted feedback!</p>
                <p>Still waiting on x and y</p>
                {{ link_to('quest/1/feedback', 'View') }}
            </div>  
        </div>

<h2>Feedback Requested</h2>
        <div class="col-lg-12">
            <div class="row">
                <h4>Quest #1</h4>
                {{ link_to('review/1', 'Edward Sharp') }}
                {{ link_to('review/2', 'Dolly Dawkins') }}
            </div>  
            <div class="row">
                <h4>Quest #2</h4>
                {{ link_to('review/1', 'Billy Bob') }}
                {{ link_to('review/2', 'Joan Hawkins') }}
            </div>  

        </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop