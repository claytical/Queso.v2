@extends('frontend.layouts.master')

@section('content')
<h2>Feedback Received</h2>

        <div class="col-lg-12">
        {!! var_dump($feedback_received) !!}
            <div class="row">
                <h4>{{ link_to('quest/1/feedback', 'Quest Name') }}</h4>
                <p>2 peers have submitted feedback!</p>
                <p>Still waiting on x and y</p>
            </div>  
        </div>

<h2>Feedback Requested</h2>
        <div class="col-lg-12">
        {!! var_dump($feedback_requested) !!}
            <div class="row">
                <h4>Quest #1</h4>
                <ul class="list-unstyled">
                    <li>{{ link_to('review/1', 'Edward Sharp') }}</li>
                    <li>{{ link_to('review/2', 'Dolly Dawkins') }}</li>
                </ul>
                
                
            </div>  
            <div class="row">
                <h4>Quest #2</h4>
                <ul class="list-unstyled">
                    <li>{{ link_to('review/1', 'Edward Sharp') }}</li>
                    <li>{{ link_to('review/2', 'Dolly Dawkins') }}</li>
                </ul>
            </div>  

        </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop