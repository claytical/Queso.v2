@extends('frontend.layouts.master')

@section('content')
<h2>Feedback Received</h2>

        <div class="col-lg-12">
            <div class="row">
                @foreach($feedback_received as $received)
                    @if($received->fulfilled > 0)
                        <h4>{{ link_to('quest/'.$received->quest_id.'/feedback', $received->quest_name) }}</h4>
                        @if($received->fulfilled == 1)
                            <p>{!! $received->fulfilled !!} peer has submitted feedback!</p>
                        @else
                            <p>{!! $received->fulfilled !!} peers have submitted feedback!</p>
                        @endif
                    @else
                        <h4>{!! $received->quest_name) !!}</h4>
                        <p>No one has submitted feedback yet.</p>
                    @endif

                    @if($received->pending > 0)
                        <h5>Waiting On</h5>
                            <ul class="unstyled-list">
                            @foreach($received->requests as $request)
                                <li>{!! $request->sender->name!!}</li>                                
                            @endforeach
                            </ul>
                    @endif
                @endforeach
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